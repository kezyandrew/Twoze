<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Service;
use App\Models\Product;
use App\Models\CountryCode;
use Redirect;
use Hash;
use Auth;

class ProfileController extends Controller
{
    // Admin Profile
    public function admin_show($id)
    {
        $user_count = 0;
        $user = User::find($id);
        $country_code = CountryCode::get();
        $all_users = User::where('status',1)->get();
        foreach($all_users as $client)
        {
            if($client->roles->contains('title','Client'))
            {
                $user_count++;
            }
        }
        $services = Service::where('status',1)->count();
        $products = Product::where('status',1)->count();
        return view('admin.profile.profile', compact('user','country_code','services','products','user_count'));
    }
     
    public function admin_update(Request $request, $id)
    {
        $request->validate([
            'email' => 'bail|required|email',
            'name' => 'bail|required',
            'country_code' => 'bail|required',
            'phone' => 'bail|required',
        ]);

        $user = User::find($id);
        if($request->hasFile('image'))
        {
            if($user->image != 'noimage.jpg')
            {
                if(\File::exists(public_path('/images/user/'. $user->image))){
                    \File::delete(public_path('/images/user/'. $user->image));
                }
            }
            $image = $request->file('image');
            $name = 'admin_'.time().'.'. $image->getClientOriginalExtension();
            $destinationPath = public_path('/images/user');
            $image->move($destinationPath, $name);
            $user->image = $name;
        }
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->code = '+'.$request->country_code;
        
        $user->save();
        return Redirect::back();
    }
     
    public function admin_changePassword(Request $request, $id)
    {
        $request->validate([
            'current_password' => ['required', 'string', 'min:6'],
            'new_password' => ['required', 'string', 'min:6'],
            'confirm_password' => ['required', 'string', 'min:6','same:new_password'],
        ]);
        if (Hash::check($request->current_password, Auth::user()->password))
        {
            $password = Hash::make($request->new_password);
            User::find(Auth::user()->id)->update(['password'=>$password]);
        }
        return Redirect::back();
    }
}
