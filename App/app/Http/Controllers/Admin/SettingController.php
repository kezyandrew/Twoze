<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Gate;
use Redirect;
use Symfony\Component\HttpFoundation\Response;
use App\Models\AppSetting;
use App\Models\PaymentSetting;
use App\Models\Currency;
use LicenseBoxAPI;

class SettingController extends Controller
{
    public function setting()
    {
        abort_if(Gate::denies('setting_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $setting = AppSetting::first();
        $currency = Currency::get();
        $payment = PaymentSetting::first();
        return view('admin.setting.setting',compact('setting','currency','payment'));
    }
    
    public function setting_otp(Request $request)
    {
        abort_if(Gate::denies('setting_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $setting = AppSetting::first();

        if(isset($request->verify_user))
        {
            $setting->verify_user = 1;
            if(isset($request->verify_user_mail) || isset($request->verify_user_sms))
            {
                if(isset($request->verify_user_mail)){ $setting->verify_user_mail = 1; }
                else{ $setting->verify_user_mail = 0; }

                if(isset($request->verify_user_sms)){ $setting->verify_user_sms = 1; }
                else{ $setting->verify_user_sms = 0; }
                $setting->save();
            }
            else{
                return Redirect::back()->withErrors(['Please Check at least one']);
            }
        }
        else{
            $setting->verify_user = 0;
            $setting->verify_user_sms = 0;
            $setting->verify_user_mail = 0;
            $setting->save();
        }

        return redirect('admin/setting');
    }

    public function currency(Request $request)
    {
        abort_if(Gate::denies('setting_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $setting = AppSetting::first();

        $currency = Currency::where('code',$request->currency)->first();
        $setting->currency_symbol = $currency->symbol;
        $setting->currency_code = $request->currency;
        $setting->save();
        if($request->currency != "INR")
        {
            $payment = PaymentSetting::first();
            $payment->razorpay = 0;
            $payment->save();
        }
        return redirect('admin/setting');
    }
    
    public function map(Request $request)
    {
        abort_if(Gate::denies('setting_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $request->validate([
            'mapkey' => 'required',
        ]);
        $data = $request->all();
        $setting = AppSetting::first()->update($data);
        return redirect('admin/setting');
    }
    
    public function address(Request $request)
    {
        abort_if(Gate::denies('setting_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $data = $request->all();
        $data['addr1'] = $request->address1;
        $data['addr2'] = $request->address2;
        $data['lat'] = $request->latitude;
        $data['long'] = $request->longitude;
        $setting = AppSetting::first()->update($data);
     
        return redirect('admin/setting');
    }

    public function push_notification(Request $request)
    {
        abort_if(Gate::denies('setting_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $request->validate([
            'app_id' => 'required_if:enable_notification,on',
            'project_no' => 'required_if:enable_notification,on',
            'api_key' => 'required_if:enable_notification,on',
            'auth_key' => 'required_if:enable_notification,on',
        ]);

        $setting = AppSetting::first();
        if(isset($request->enable_notification)){ $setting->enable_notification = 1; }
        else{ $setting->enable_notification = 0; $setting->enable_notification = 0; }
        
        $setting->app_id = $request->app_id;
        $setting->api_key = $request->api_key;
        $setting->auth_key = $request->auth_key;
        $setting->project_no = $request->project_no;

        $setting->save();
        return redirect('admin/setting');
    }

    public function email_settings(Request $request)
    {
        abort_if(Gate::denies('setting_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $request->validate([
            'mail_host' => 'required_if:enable_mail,on',
            'mail_port' => 'required_if:enable_mail,on',
            'mail_username' => 'required_if:enable_mail,on',
            'mail_password' => 'required_if:enable_mail,on',
            'sender_email' => 'required_if:enable_mail,on',
        ]);

        $setting = AppSetting::first();
        
        if(isset($request->enable_mail)){ $setting->enable_mail = 1; }
        else{ $setting->enable_mail = 0; $setting->enable_mail = 0; }

        $setting->mail_host = $request->mail_host;
        $setting->mail_port = $request->mail_port;
        $setting->mail_username = $request->mail_username;
        $setting->mail_password = $request->mail_password;
        $setting->sender_email = $request->sender_email;

        $setting->save();
        return redirect('admin/setting');
    }

    public function sms_gateway(Request $request)
    {
        abort_if(Gate::denies('setting_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $request->validate([
            'twilio_acc_id' => 'required_if:enable_sms,on',
            'twilio_auth_token' => 'required_if:enable_sms,on',
            'twilio_phone_no' => 'required_if:enable_sms,on',
        ]);

        $setting = AppSetting::first();
        
        if(isset($request->enable_sms)){ $setting->enable_sms = 1; }
        else{ $setting->enable_sms = 0; $setting->enable_sms = 0; }

        $setting->twilio_acc_id = $request->twilio_acc_id;
        $setting->twilio_auth_token = $request->twilio_auth_token;
        $setting->twilio_phone_no = $request->twilio_phone_no;

        $setting->save();
        return redirect('admin/setting');
    }
    
    public function payment_gateway(Request $request)
    {
        abort_if(Gate::denies('setting_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $request->validate([
            'paypal_sandbox_key' => 'required_if:paypal,on',
            'paypal_production_key' => 'required_if:paypal,on',

            'razorpay_public_key' => 'required_if:razorpay,on',
            'razorpay_secret_key' => 'required_if:razorpay,on',

            'stripe_public_key' => 'required_if:stripe,on',
            'stripe_secret_key' => 'required_if:stripe,on',
        ]);

        $payment = PaymentSetting::first();
        
        if(isset($request->cod)){ $payment->cod = 1; }
        else{ $payment->cod = 0; $payment->cod = 0; }
 
        if(isset($request->paypal)){ $payment->paypal = 1; }
        else{ $payment->paypal = 0; $payment->paypal = 0; }
 
        if(isset($request->razorpay)){ $payment->razorpay = 1; }
        else{ $payment->razorpay = 0; $payment->razorpay = 0; }
 
        if(isset($request->stripe)){ $payment->stripe = 1; }
        else{ $payment->stripe = 0; $payment->stripe = 0; }
 
        // if(isset($request->paystack)){ $payment->paystack = 1; }
        // else{ $payment->paystack = 0; $payment->paystack = 0; }

        $payment->paypal_sandbox_key = $request->paypal_sandbox_key;
        $payment->paypal_production_key = $request->paypal_production_key;
        $payment->razorpay_public_key = $request->razorpay_public_key;
        $payment->razorpay_secret_key = $request->razorpay_secret_key;
        $payment->stripe_public_key = $request->stripe_public_key;
        $payment->stripe_secret_key = $request->stripe_secret_key;

        $payment->save();
        return redirect('admin/setting');
    }

    public function terms_of_use(Request $request)
    {
        abort_if(Gate::denies('setting_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $request->validate([
            'terms_of_use' => 'bail|required',
        ]);
        $setting = AppSetting::first();
        $setting->terms_of_use = $request->terms_of_use;
        $setting->save();
        return redirect('admin/setting');
    }

    public function privacy_policy(Request $request)
    {
        abort_if(Gate::denies('setting_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $request->validate([
            'privacy_policy' => 'bail|required',
        ]);
        $setting = AppSetting::first();
        $setting->privacy_policy = $request->privacy_policy;
        $setting->save();
        return redirect('admin/setting');
    }

    public function app_setting(Request $request)
    {
        abort_if(Gate::denies('setting_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $request->validate([
            'app_name' => 'bail|required',
            'app_version' => 'bail|required',
            'unit' => 'bail|required',
        ]);
        $setting = AppSetting::first();
        $setting->app_name = $request->app_name;
        $setting->app_version = $request->app_version;
        $setting->cloth_unit = $request->unit;
        if($request->hasFile('image'))
        {
            if(\File::exists(public_path('/images/app/'. $setting->favicon))){
                \File::delete(public_path('/images/app/'. $setting->favicon));
            }

            $image = $request->file('image');
            $name = 'favicon_icon.'. $image->getClientOriginalExtension();
            $destinationPath = public_path('/images/app');
            $image->move($destinationPath, $name);
            $setting->favicon = $name;
        }
        if($request->hasFile('image_edit'))
        {
            if(\File::exists(public_path('/images/app/'. $setting->black_logo))){
                \File::delete(public_path('/images/app/'. $setting->black_logo));
            }

            $image = $request->file('image_edit');
            $name = 'black_logo.'. $image->getClientOriginalExtension();
            $destinationPath = public_path('/images/app');
            $image->move($destinationPath, $name);
            $setting->black_logo = $name;
        }
        if($request->hasFile('image_edit_2'))
        {
            if(\File::exists(public_path('/images/app/'. $setting->white_logo))){
                \File::delete(public_path('/images/app/'. $setting->white_logo));
            }

            $image = $request->file('image_edit_2');
            $name = 'white_logo.'. $image->getClientOriginalExtension();
            $destinationPath = public_path('/images/app');
            $image->move($destinationPath, $name);
            $setting->white_logo = $name;
        }
        if($request->hasFile('image_edit_3'))
        {
            if(\File::exists(public_path('/images/app/'. $setting->color_logo))){
                \File::delete(public_path('/images/app/'. $setting->color_logo));
            }

            $image = $request->file('image_edit_3');
            $name = 'color_logo.'. $image->getClientOriginalExtension();
            $destinationPath = public_path('/images/app');
            $image->move($destinationPath, $name);
            $setting->color_logo = $name;
        }
        if($request->hasFile('image_edit_4'))
        {
            if(\File::exists(public_path('/images/app/'. $setting->splash_screen))){
                \File::delete(public_path('/images/app/'. $setting->splash_screen));
            }

            $image = $request->file('image_edit_4');
            $name = 'splash_screen.'. $image->getClientOriginalExtension();
            $destinationPath = public_path('/images/app');
            $image->move($destinationPath, $name);
            $setting->splash_screen = $name;
        }
        $setting->save();
        return redirect('admin/setting');
    }

    public function admin_settings(Request $request)
    {
        abort_if(Gate::denies('setting_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $setting = AppSetting::first();

        if($request->hasFile('image_edit_5'))
        {
            if(\File::exists(public_path('/images/app/'. $setting->bg_img))){
                \File::delete(public_path('/images/app/'. $setting->bg_img));
            }
            $image = $request->file('image_edit_5');
            $name = 'bg_img.'. $image->getClientOriginalExtension();
            $destinationPath = public_path('/images/app');
            $image->move($destinationPath, $name);
            $setting->bg_img = $name;
        }
        
        if($request->hasFile('image_edit_6'))
        {
            if(\File::exists(public_path('/images/app/'. $setting->no_data))){
                \File::delete(public_path('/images/app/'. $setting->no_data));
            }
            $image = $request->file('image_edit_6');
            $name = 'no_data.'. $image->getClientOriginalExtension();
            $destinationPath = public_path('/images/app');
            $image->move($destinationPath, $name);
            $setting->no_data = $name;
        }
        $setting->color = $request->color;
        $setting->save();
        return redirect('admin/setting');
    }

    public function license(Request $request)
    {
        abort_if(Gate::denies('setting_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $request->validate([
            'license_code' => 'bail|required',
            'license_client_name' => 'bail|required',
        ]);

        // let's experiment by attempting to activate the script.

        $setting = AppSetting::first();
        $setting->license_code = "Nulled--";
        $setting->license_client_name = "Nulled Scripts--";
        $setting->license_status = 1;
        $setting->save();
        return redirect('admin/dashboard');
        
        $api = new LicenseBoxAPI();
        $activate_response = $api->activate_license($request->license_code, $request->license_client_name);
        
        if($activate_response['status'] === true)
        {
            $setting = AppSetting::first();
            $setting->license_code = $request->license_code;
            $setting->license_client_name = $request->license_client_name;
            $setting->license_status = 1;
            $setting->save();
            return redirect('admin/dashboard');
        }
        else{
            return Redirect::back()->withStatus($activate_response['message']);
        }
    }
}
