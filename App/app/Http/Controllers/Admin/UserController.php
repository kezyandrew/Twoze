<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Gate;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Role;
use App\Models\User;
use App\Models\AppSetting;
use App\Models\Address;
use App\Models\Order;
use App\Models\OrderChild;
use App\Models\Product;
use App\Models\CountryCode;
use Hash;

class UserController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('user_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $users = User::with(['roles','address'])
        ->orderBy('created_at','DESC')
        ->get();

        $roles = Role::get();
        $country_code = CountryCode::get();

        return view('admin.user.userTable', compact('users','roles','country_code'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'bail|required',
            'email' => 'bail|required|unique:users',
            'password' => 'bail|required|min:6|max:15',
            'country_code' => 'bail|required',
            'phone' => 'bail|required',
            'roles' => 'bail|required',
            'status' => 'bail|required',
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->code = '+'.$request->country_code;
        $user->phone = $request->phone;
        $user->status = $request->status;
        $user->verify = 1;
        $user->password = Hash::make($request->password);
        
        if($request->hasFile('image'))
        {
            $image = $request->file('image');
            $name = 'User_'.time().'.'. $image->getClientOriginalExtension();
            $destinationPath = public_path('/images/user');
            $image->move($destinationPath, $name);
            $user->image = $name;
        }
        $user->save();
        $user->roles()->sync($request->input('roles', []));

        return response()->json(['success' => true,'data' => $user, 'msg' => 'User created successfully..!!'], 200);
    }

    public function show($id)
    {
        $user = User::find($id);
        
        $completed = Order::where([['user_id',$user->id],['order_status','Completed']])
        ->orderBy('id', 'DESC')->get()->each->setAppends([]);
        foreach($completed as $past) {
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

       $pending = Order::where([['user_id',$user->id],['order_status','Pending']])
       ->orderBy('id', 'DESC')->get()->each->setAppends([]);
       foreach($pending as $past) {
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

      $cancel = Order::where([['user_id',$user->id],['order_status','Cancel']])
      ->orderBy('id', 'DESC')->get()->each->setAppends([]);
      foreach($cancel as $past) {
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

        $currency_symbol = AppSetting::first()->currency_symbol;
        $address = Address::where('user_id',$user->id)->get();
        return view('admin.user.userShow', compact('user','completed','cancel','pending','currency_symbol','address'));
    }

    public function edit($id)
    {
        abort_if(Gate::denies('user_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $user = User::find($id);
        $data['user'] = $user->load('roles');
        $data['roles'] = Role::get();
        return response()->json(['success' => true,'data' => $data], 200);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'bail|required',
            'roles' => 'bail|required',
            'country_code' => 'bail|required',
            'phone' => 'bail|required',
            'status' => 'bail|required',
        ]);

        $user = User::find($id);
        $user->name = $request->name;
        $user->code = '+'.$request->country_code;
        $user->phone = $request->phone;
        $user->status = $request->status;
        if($request->hasFile('image_edit'))
        {
            if($user->image != "noimage.jpg")
            {
                if(\File::exists(public_path('/images/user/'. $user->image))){
                    \File::delete(public_path('/images/user/'. $user->image));
                }
            }
        
            $image = $request->file('image_edit');
            $name = 'User_'.time().'.'. $image->getClientOriginalExtension();
            $destinationPath = public_path('/images/user');
            $image->move($destinationPath, $name);
            $user->image = $name;
        }
        $user->save();
        
        $user->roles()->sync($request->input('roles', []));
        return response()->json(['success' => true,'data' => $user, 'msg' => 'User edited successfully..!!'], 200);
    }

    public function destroy($id)
    {
        // Delete Address
        $addr = Address::where('user_id',$id)->get();
        foreach ($addr as $item) {
            $item->delete();
        }

        // Delete Order &  OrderChild
        $order = Order::where('user_id',$id)->get();
        foreach ($order as $item) {
            $orderChild = OrderChild::where('order_id',$item->id)->get();
            foreach($orderChild as $childItem) {
                $childItem->delete();
            }
            $item->delete();
        }

        // Delete User
        $user = User::find($id);
        if($user->image != "noimage.jpg") {
            if(\File::exists(public_path('/images/user/'. $user->image))) {
                \File::delete(public_path('/images/user/'. $user->image));
            }
        }
        $user->roles()->sync([]);
        $user->delete();
        
        return response()->json(['success' => true,'data' => $user, 'msg' => 'User deleted successfully..!!'], 200);
    }
}
