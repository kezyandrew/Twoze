<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Models\AppSetting;
use App\Models\PaymentSetting;
use Carbon\Carbon;
use App\Models\Role;
use App\Models\User;
use App\Models\Offer;
use App\Models\Coupon;
use App\Models\Service;
use App\Models\Product;
use App\Models\Address;
use App\Models\Order;
use App\Models\OrderChild;
use App\Models\Template;
use Twilio\Rest\Client;
use App\Mail\OTP;
use App\Mail\OrderCreate;
use App\Mail\OrderStatus;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use OneSignal;
use Stripe;

class UserApiController extends Controller
{ 
    // Settings // Terms of use // Privacy Policy
    public function settings()
    {
        $settings = AppSetting::first(['cloth_unit','app_name','app_version','white_logo','black_logo','color_logo','splash_screen','currency_code','currency_symbol','terms_of_use','privacy_policy','app_id','api_key','auth_key','project_no']);
        return response()->json(['msg' => 'All Settings', 'data' => $settings, 'success' => true], 200); 
    }
    
    // Login
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'bail|required|email',
            'password' => 'bail|required',
            'device_token' => 'bail|required',
        ]);
        $userdata = array(
            'email' => $request->email,
            'password' => $request->password,
        );
        if (Auth::attempt($userdata)) 
        {
            $user = Auth::user()->load('roles');
            if($user->roles->contains('title','Client'))
            {
                if(Auth::user()->status == 1)
                {
                    if(Auth::user()->verify == 0)
                    {
                        if(isset($request->device_token)){
                            $user->device_token = $request->device_token;
                            $user->save();
                        }
                        $success['token'] =  $user->createToken('laundering')->accessToken;
                        return response()->json(['msg' => "Login successfully", 'data' => $success, 'success' => true], 200);
                    }
                    else{
                        return response()->json(['msg' => "Verify your account", 'success' => false], 200);
                    }
                }
                else{
                    return response()->json(['msg' => "You are blocked", 'success' => false], 200);
                }
            }
            else{
                return response()->json(['msg' => "You are not user", 'success' => false], 200);
            }
        } else {
            return response()->json(['error' => 'Invalid email or password'], 401);
        }
    }

    // Register
    public function register(Request $request) 
    {
        $request->validate([
            'name' => 'bail|required',
            'email' => 'bail|required|email|unique:users',
            'code' => 'bail|required',
            'phone' => 'bail|required|numeric',
            'password' => 'bail|required|min:6|max:15',
            'confirm_password' => 'bail|required|same:password',
        ]);
        $verify_user = AppSetting::first()->verify_user;
        if($verify_user == 0)
        {
            $verify = 1;
        }
        else
        {
            $verify = 0;
        }
        $user = User::create(
            [
                'name' => $request->name,
                'email' => $request->email,
                'code' => $request->code,
                'phone' => $request->phone,
                'verify' => $verify,
                'password' => Hash::make($request->password),
            ]
        );
        if($user) 
        {
            $role = Role::where('title','Client')->orWhere('title','client')->first();
            if($role)
            {
                $user->roles()->sync($role->id);
            }
            if($user->verify == 1)
            {
                $user['token'] = $user->createToken('thebarber')->accessToken;
            }
            return response()->json(['success' => true, 'data' => $user, 'message' => 'User created successfully!']);
        }else {
            return response()->json(['error' => 'User not Created'], 401);
        }
    }

    // send OTP & resend OTP & forgot Password
    public function sendOtp(Request $request)
    {
        $request->validate([
            'email' => 'bail|required|email',
        ]);
        $user = User::where('email',$request->email)->first();
        if($user)
        {
            if($user->roles->contains('title','Client') || $user->roles->contains('title','client'))
            {
                if($user->status == 1)
                {
                    $otp = rand(1111,9999);
                    $user->otp = $otp;
                    $user->save();

                    $mail_content = Template::where('title','User Verification')->first()->mail_content;
                    $msg_content = Template::where('title','User Verification')->first()->msg_content;
                    $detail['UserName'] = $user->name;
                    $detail['OTP'] = $otp;
                    $detail['AdminName'] = AppSetting::first()->app_name;

                    $verify_user_mail = AppSetting::first()->verify_user_mail;
                    $verify_user_sms = AppSetting::first()->verify_user_sms;
                    if($verify_user_mail == 1){
                        try{
                            Mail::to($user->email)->send(new OTP($mail_content,$detail));
                        }
                        catch(\Throwable $th){}
                    }
                    if($verify_user_sms == 1){
                        $sid = AppSetting::first()->twilio_acc_id;
                        $token = AppSetting::first()->twilio_auth_token;
                        $data = ["{{UserName}}", "{{OTP}}","{{AdminName}}"];
                        $message1 = str_replace($data, $detail, $msg_content);
                        try{
                            $client = new Client($sid, $token);
                            
                            $client->messages->create(
                                '+919824871412',
                                array(
                                'from' => AppSetting::first()->twilio_phone_no,
                                'body' => $message1
                                )
                            );
                        }
                        catch(\Throwable $th){}
                    }
                    return response()->json(['msg' => 'OTP sent', 'data' => $user, 'success' => true], 200);
                }
                else
                {
                    return response()->json(['msg' => 'You are blocked by admin', 'data' => null, 'success' => false], 200);
                }
            }
            else{
                return response()->json(['msg' => 'You are not user', 'data' => null, 'success' => false], 200);
            }
        }
        else{
            return response()->json(['msg' => 'User not found', 'data' => null, 'success' => false], 200);
        }
    }

    // Check OTP
    public function checkOtp(Request $request)
    {
        $request->validate([
            'otp' => 'bail|required|digits:4',
            'user_id' => 'bail|required',
        ]);

        $user = User::find($request->user_id);
        if($user->otp == $request->otp)
        {
            $user->verify = 1;
            $user->save();

            $user['token'] =  $user->createToken('thebarber')->accessToken;

            return response()->json(['msg' => 'OTP match', 'data' => $user, 'success' => true], 200);
        }
        else{
            return response()->json(['msg' => 'Wrong OTP', 'data' => null, 'success' => false], 200);
        }
    }

    // Change password
    public function changePassword(Request $request)
    {
        $request->validate([
            'user_id' => 'bail|required',
            'password' => 'bail|required|min:6|max:15',
            'confirm_password' => 'bail|required|same:password',
        ]);

        $user = User::find($request->user_id);
        $user->password = Hash::make($request->password);
        $user->save();
        return response()->json(['msg' => 'Password changed', 'data' => null, 'success' => true], 200); 
    }

    // Offers
    public function offers()
    {
        $offers = Offer::where('status',1)->get();
        return response()->json(['msg' => 'All Offers', 'data' => $offers, 'success' => true], 200); 
    }

    // Coupons
    public function coupons()
    {
        $all_coupons = Coupon::where('status',1)->get();
        $coupons = array();
        foreach($all_coupons as $coupon){
            if ($coupon->max_use > $coupon->use_count) {
                array_push($coupons,$coupon);
            }
        }
        return response()->json(['msg' => 'All Coupons', 'data' => $coupons, 'success' => true], 200); 
    }

     // check coupon
    public function checkCoupon(Request $request)
    {
        $request->validate([
            'code' => 'bail|required',
        ]);

        $coupon = Coupon::where('code',$request->code)->first();
        if(!$coupon)
        {
            return response()->json(['msg' => 'coupon code is incorrect',  'success' => false], 200);
        }
        else
        {
            $last_day = Carbon::parse($coupon->end_date)->addDays(1)->format('Y-m-d');
            $check = Carbon::now()->between($coupon->start_date,$last_day);
            if ($coupon->max_use > $coupon->use_count && $check == 1) {
                return response()->json(['msg' => 'Coupon applied', 'data' => $coupon, 'success' => true], 200);
            }
            else{
                return response()->json(['msg' => 'Coupon not applied', 'data' => null, 'success' => false], 200);
            }
        }
    }

    // Services
    public function services()
    {
        $services = Service::where('status',1)->get();
        return response()->json(['msg' => 'All Services', 'data' => $services, 'success' => true], 200); 
    }

    // Service->array_product
    public function service_product(Request $request)
    {
        $request->validate([
            'service_id' => 'bail|required',
        ]);

        $service = Service::find($request->service_id);
        $products = Product::where('status',1)->get()->each->setAppends(['imagePath']);
        $product_array = array();
        foreach($products as $product)
        {
            $decode_services = json_decode($product->service_id);
            if(in_array($request->service_id, $decode_services))
            {
                $product->service_name = Service::find($request->service_id)->name;
                array_push($product_array,$product);
            }
        }
        return response()->json(['msg' => 'Service vise products', 'data' => $product_array, 'success' => true], 200); 
    }

    // Create Address
    public function add_address(Request $request)
    { 
        $request->validate([
            'label' => 'bail|required',
            'addr1' => 'bail|required',
            'lat' => 'bail|required',
            'long' => 'bail|required',
        ]);
            
        $address = new Address();
        $address->user_id = Auth()->user()->id;
        $address->label = $request->label;
        $address->addr1 = $request->addr1;
        $address->city = $request->city;
        $address->state = $request->state;
        $address->country = $request->country;
        $address->zipcode = $request->zipcode;
        $address->lat = $request->lat;
        $address->long = $request->long;
        $address->save();
        return response()->json(['msg' => 'user address added', 'data' => $address, 'success' => true], 200);
    }

    // All Addresss
    public function all_address()
    {
        $address = Address::where('user_id',Auth::user()->id)->orderBy('id','DESC')->get();
        return response()->json(['msg' => 'All Addresses','data' => $address ,'success' => true], 200);
    }

    // Remove Address
    public function remove_address($id)
    {
        $address = Address::find($id);
        $order = Order::where('addr_id',$id)->get();
        if(count($order) == 0)
        {
            $address->delete();
            return response()->json(['msg' => 'address remove', 'success' => true], 200);
        }
        else{
            return response()->json(['msg' => 'address is in use', 'success' => false], 200);
        }
    }

    // Show Profile
    public function profile()
    {
        $user = User::with('address')->find(Auth::user()->id);
        return response()->json(['msg' => 'User Profile show', 'data' => $user, 'success' => true], 200);
    }
    
    // Edit User profile
    public function profile_edit(Request $request)
    {
        $request->validate([
            'name' => 'bail|required',
            'code' => 'bail|required',
            'phone' => 'bail|required|numeric',
        ]);

        $user = User::find(Auth::user()->id);
        $user->name = $request->name;
        $user->code = $request->code;
        $user->phone = $request->phone;
        $user->save();
        return response()->json(['msg' => 'Edit User successfully', 'data' => $user, 'success' => true], 200);
    }
  
    // Edit User profile
    public function profile_edit_image(Request $request)
    {
        $request->validate([
            'image' => 'bail|required',
        ]);

        $user = User::find(Auth::user()->id);
        if(isset($request->image))
        {
            if($user->image != "noimage.jpg")
            {
                if(\File::exists(public_path('/images/user/'. $user->image))){
                    \File::delete(public_path('/images/user/'. $user->image));
                }
            }
            $img = $request->image;
            $img = str_replace('data:image/png;base64,', '', $img);
            
            $img = str_replace(' ', '+', $img);
            $data1 = base64_decode($img);
            $name = "User_". time() . ".png";
            $file = public_path('/images/user/') . $name;

            $success = file_put_contents($file, $data1);
            $user->image = $name;
        }
        $user->save();
        return response()->json(['msg' => 'Edit Profile Image successfully', 'data' => $user, 'success' => true], 200);
    }

    // Create order
    public function order(Request $request)
    {
        $request->validate([
            'order_id' => '',
            'addr_id' => 'bail|required',
            'user_id' => '',
            'coupon_id' => '',
            'discount' => '',
            'payment' => 'bail|required',
            'payment_type' => 'bail|required',
            'payment_token' => 'required_if:payment_type,STRIPE,RAZORPAY,PAYPAL',
            'payment_status' => '',
            'order_status' => '',
            'products' => 'bail|required',
        ]);

        $order = new Order();
        $permitted_chars = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $order_id = substr(str_shuffle($permitted_chars), 0, 10);
        $order->order_id = '#'.$order_id;
        $order->addr_id = $request->addr_id;
        $order->user_id = Auth::user()->id;
        if(isset($request->coupon_id))
        {
            $order->coupon_id = $request->coupon_id;
            $order->discount = $request->discount;
            $coupon = Coupon::find($request->coupon_id);
            $count = $coupon->use_count;
            $count = $count +1;
            $coupon->use_count = $count;
            $coupon->save();
        }
        else {
            $order->discount = 0;
        }
        if(isset($request->date)) {
            $order->date = Carbon::parse($request->date)->format('Y-m-d');
        }
        else {
            $today = Carbon::now();
            $today = $today->addDays(2);
            $order->date = $today->format('Y-m-d');
        }
        $order->order_status = 'Pending';
        $order->type = AppSetting::first()->cloth_unit;
        $order->payment = $request->payment;
        $order->payment_type = $request->payment_type;

        if($request->payment_type == "STRIPE")
        {
            $paymentSetting = PaymentSetting::first();
            $stripe_sk = $paymentSetting->stripe_secret_key;
    
            $adminSetting = AppSetting::first();
            $currency_code =  $adminSetting->currency_code;

            Stripe\Stripe::setApiKey($stripe_sk);
            $stripeDetail = Stripe\Charge::create ([
                "amount" => $request->payment * 100,
                "currency" => $currency_code,
                "source" => $request->payment_token,
            ]);
            $order->payment_token = $stripeDetail->id;
            $order->payment_status = 1;
        }
        if($request->payment_type == "RAZORPAY" || $request->payment_type == "PAYPAL")
        {
            $order->payment_token = $request->payment_token;
            $order->payment_status = 1;
        }
        $order->save();

        foreach($request->products as $product)
        {
            foreach($product['service'] as $ser)
            {
                $child = new OrderChild();
                $child->order_id = $order->id;
                $child->product_id = $product['id'];
                $child->service_id = $ser['single_service_id'];
                $child->qty = $ser['qty'];
                $child->price = $ser['total'];
                $child->save();
            }
        }

        $order_create = Template::where('title','Order Create')->first();
        
        $enable_notification = AppSetting::first()->enable_notification;
        $enable_mail = AppSetting::first()->enable_mail;
        $currency_symbol = AppSetting::first()->currency_symbol;

        $detail['UserName'] = $order->user->name;
        $detail['CreatedDate'] = Carbon::parse($order->created_at)->format('Y-m-d');
        $detail['Payment'] = $currency_symbol .''.$order->payment;
        $detail['DeliveryDate'] = $order->date;
        $detail['OrderId'] = $order->order_id;
        $detail['AdminName'] = AppSetting::first()->app_name;

        $data = ["{{UserName}}", "{{CreatedDate}}","{{Payment}}","{{DeliveryDate}}","{{OrderId}}","{{AdminName}}"];
        $message = str_replace($data, $detail, $order_create->msg_content);
        $subject = $order_create->title;

        if($enable_mail == 1) {
            try{
                Mail::to($order->user->email)->send(new OrderCreate($order_create->mail_content,$detail));
                // Mail::to('pranali.thirstydevs@gmail.com')->send(new OrderCreate($order_create->mail_content,$detail));
            }
            catch(\Throwable $th){}
        }
        if($enable_notification == 1) {
            try{
                $userId=Auth::user()->device_token;
                OneSignal::sendNotificationToUser(
                    $message,
                    $userId,
                    $url = null,
                    $data = null,
                    $buttons = null,
                    $schedule = null,
                    $subject
                );
            }
            catch (\Exception $th) {}
        }
        
        $order1 = Order::find($order->id);
        return response()->json(['msg' => 'Order Created successfully', 'data' => $order1, 'success' => true], 200);
    }

    // Single Order
    public function singleOrder($id)
    {
        $order = Order::with('address','user','coupon')->find($id)->setAppends([]);
        $orderChild = OrderChild::where('order_id',$id)->groupBy('product_id')->get();
        $single_product = array();
       
        foreach($orderChild as $item) {
            $pro = Product::find($item['product_id']);
            $data['product_id'] = $item->product_id;
            $data['name'] = $pro->name;
            $data['image'] = $pro->image;
            $ser =  OrderChild::where([['order_id',$id],['product_id',$item->product_id]])->get(['service_id','qty','price'])->each->setAppends(['serviceName']);
            $data['service'] = $ser;
            array_push($single_product,$data);
        }
        $order->child = $single_product;
        return response()->json(['msg' => 'Single Order', 'data' => $order, 'success' => true], 200);
    }

    // All Orders
    public function allOrders()
    {
        $master = array();
        $master['past'] = Order::where([['user_id',Auth::user()->id],['order_status','Completed']])
        ->orWhere([['user_id',Auth::user()->id],['order_status','Cancel']])
        ->orderBy('id', 'DESC')->get()->each->setAppends([]);
        foreach($master['past'] as $past){
            $orderChild = OrderChild::where('order_id',$past->id)->groupBy('product_id')->get();
            $single_product = array();
            foreach($orderChild as $item) {
               $pro = Product::find($item['product_id']);
               $data['product_id'] = $item->product_id;
               $data['name'] = $pro->name;
               $data['image'] = $pro->image;
               $ser =  OrderChild::where([['order_id',$past->id],['product_id',$item->product_id]])->get(['service_id','qty','price'])->each->setAppends(['serviceName']);
               $data['service'] = $ser;
               array_push($single_product,$data);
           }
           $past->child = $single_product;
       }

        $master['current'] = Order::where([['user_id',Auth::user()->id],['order_status','Pending']])
        ->orderBy('id', 'DESC')->get()->each->setAppends([]);
        foreach($master['current'] as $past){
            $orderChild = OrderChild::where('order_id',$past->id)->groupBy('product_id')->get();
            $single_product = array();
            foreach($orderChild as $item) {
               $pro = Product::find($item['product_id']);
               $data['product_id'] = $item->product_id;
               $data['name'] = $pro->name;
               $data['image'] = $pro->image;
               $ser =  OrderChild::where([['order_id',$past->id],['product_id',$item->product_id]])->get(['service_id','qty','price'])->each->setAppends(['serviceName']);
               $data['service'] = $ser;
               array_push($single_product,$data);
           }
           $past->child = $single_product;
       }

        return response()->json(['msg' => 'All Orders', 'data' => $master, 'success' => true], 200);
    }

    // Cancel order
    public function cancelOrder($id)
    {
        $order = Order::find($id);
        $order->order_status = 'Cancel';
        $order->save();

        $order_status = Template::where('title','Order Status')->first();
        
        $enable_notification = AppSetting::first()->enable_notification;
        $enable_mail = AppSetting::first()->enable_mail;
        $currency_symbol = AppSetting::first()->currency_symbol;

        $detail['UserName'] = $order->user->name;
        $detail['CreatedDate'] = Carbon::parse($order->created_at)->format('Y-m-d');
        $detail['Payment'] = $currency_symbol .''.$order->payment;
        $detail['DeliveryDate'] = $order->date;
        $detail['OrderId'] = $order->order_id;
        $detail['OrderStatus'] = $order->order_status;
        $detail['AdminName'] = AppSetting::first()->app_name;

        $data = ["{{UserName}}", "{{CreatedDate}}","{{Payment}}","{{DeliveryDate}}","{{OrderId}}","{{OrderStatus}}","{{AdminName}}"];
        $message = str_replace($data, $detail, $order_status->msg_content);

        if($enable_mail == 1) {
            try{
                Mail::to($order->user->email)->send(new OrderStatus($order_status->mail_content,$detail));
                // Mail::to('pranali.thirstydevs@gmail.com')->send(new OrderStatus($order_status->mail_content,$detail));
            }
            catch(\Throwable $th){}
        }

        if($enable_notification == 1) {
            try{
                $userId=Auth::user()->device_token;
                OneSignal::sendNotificationToUser(
                    $message,
                    $userId,
                    $url = null,
                    $data = null,
                    $buttons = null,
                    $schedule = null,
                    "Order Cancel"
                );
            }
            catch (\Exception $th) {}
        }

        return response()->json(['msg' => 'Order Cancel', 'data' => $order, 'success' => true], 200);
    }

    // Home active orders
    public function activeOrder()
    {
        $active = Order::where([['user_id',Auth::user()->id],['order_status','Pending']])
        ->orderBy('id', 'DESC')->get();

        return response()->json(['msg' => 'All Orders', 'data' => $active, 'success' => true], 200);
    }

    public function payment()
    {
        $payment = PaymentSetting::first();
        return response()->json(['msg' => 'Payment Settings', 'data' => $payment, 'success' => true], 200);
    }
    
}