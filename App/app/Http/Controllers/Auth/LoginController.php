<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\Models\AppSetting;
use Auth;
use LicenseBoxAPI;
use Redirect;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('guest')->except('logout');
    }
    
    public function admin_login()
    {
        return view('admin.loginPages.login');
    }
    
    public function admin_login_check(Request $request)
    {
        $request->validate([
            'email' => 'bail|required|email',
            'password' => 'bail|required',
        ]);

        $userdata = array(
            'email' => $request->email,
            'password' => $request->password,
        );
        if (Auth::attempt($userdata))
        {
            // $license_code = AppSetting::first()->license_code;
            // $client_name = AppSetting::first()->license_client_name;
            // $api = new LicenseBoxAPI();
            // $verify = $api->verify_license();

            // if($verify['status'] == true) {
            //     $set = AppSetting::first();
            //     $set->license_status = 1;
            //     $set->save();
            // }
            // else {
            //     $set = AppSetting::first();
            //     $set->license_status = 0;
            //     $set->save();
            // }
            // $license_status = AppSetting::first()->license_status;
            $user = Auth::user()->load('roles');
            if($user->roles->contains('title','Admin')) {
                // if ($license_status == 1) {
                    return redirect('/admin/dashboard');
                // }
                // else {
                //     return redirect('/admin/setting');
                // }
            }
            else {
                return Redirect::back()->withErrors(['Only Admin Can Login']);
            }
        }
        else
        {
            return Redirect::back()->withErrors(['Invalid Email or Passoword']);
        }
    }
    public function admin_logout()
    {
        Auth::logout();
        return redirect('/admin/login');
    }

    public function saveEnvData(Request $request)
    {
        $data['DB_HOST']=$request->db_host;
        $data['DB_DATABASE']=$request->db_name;
        $data['DB_USERNAME']=$request->db_user;
        $data['DB_PASSWORD']=$request->db_pass;
        
        $envFile = app()->environmentFilePath();
        
        if($envFile){
            $str = file_get_contents($envFile);
            // dd($str);
            if (count($data) > 0) {
                foreach ($data as $envKey => $envValue) {
                    $str .= "\n"; // In case the searched variable is in the last line without \n
                    $keyPosition = strpos($str, "{$envKey}=");
                    $endOfLinePosition = strpos($str, "\n", $keyPosition);
                    $oldLine = substr($str, $keyPosition, $endOfLinePosition - $keyPosition);
                    // If key does not exist, add it
                    if (!$keyPosition || !$endOfLinePosition || !$oldLine) {
                        $str .= "{$envKey}={$envValue}\n";
                    } else {
                        $str = str_replace($oldLine, "{$envKey}={$envValue}", $str);
                    }
                }
            }
            $str = substr($str, 0, -1);
            if (!file_put_contents($envFile, $str)){
                return response()->json(['data' => null,'success'=>false], 200);
            }

            $set = AppSetting::first();
            $set->license_client_name = $request->client_name;
            $set->license_code = $request->license_code;
            $set->license_status = 1;
            $set->save();

            return response()->json([ 'data' => url('admin/login'),'success'=>true], 200);    
        }
    }
}
