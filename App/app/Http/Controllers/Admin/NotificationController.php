<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Gate;
use Redirect;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Template;
use App\Models\User;
use App\Models\AppSetting;
use OneSignal;

class NotificationController extends Controller
{
    public function template()
    {
        abort_if(Gate::denies('notification_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        abort_if(Gate::denies('notification_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $templates = Template::get();
        return view('admin.notification.template',compact('templates'));
    }
    
    public function template_edit($id)
    {
        $template = Template::find($id);
        return response()->json(['msg' => 'Show Template', 'data' => $template, 'success' => true], 200);
    }
    
    public function template_update(Request $request)
    {
        $temp = Template::find($request->id);
        $temp->subject = $request->subject;
        $temp->mail_content = $request->mail_content;
        $temp->msg_content = $request->msg_content;
        $temp->save();

        return Redirect::back();
    }
     
    public function send()
    {
        $users = array();
        $all_users = User::where('status',1)->get();
        foreach($all_users as $client)
        {
            if($client->roles->contains('title','Client'))
            {
                array_push($users,$client);
            }
        }
        return view('admin.notification.send', compact('users'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'bail|required',
            'msg' => 'bail|required',
            'title' => 'bail|required',
        ]);

        $str = json_encode($request->user_id);
        $ids =  str_replace('"', '',$str);
        
        $enable_notification = AppSetting::first()->enable_notification;
        
        if($enable_notification)
        {
            foreach (json_decode($ids) as $key)
            {
                try{
                    $user = User::where('status',1)->find($key);
                    OneSignal::sendNotificationToUser(
                        $request->msg,
                        $user->device_token,
                        $url = null,
                        $data = null,
                        $buttons = null,
                        $schedule = null,
                        $request->title
                    );
                }
                catch (\Throwable $th) {}
            }
        }
        return redirect('admin/notification/send');
    }
}
