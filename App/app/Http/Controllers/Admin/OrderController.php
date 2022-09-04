<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Gate;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Mail;
use App\Models\Order;
use App\Models\User;
use App\Models\Template;
use App\Models\AppSetting;
use App\Mail\OrderStatus;
use Carbon\Carbon;
use OneSignal;


class OrderController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('order_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $orders = Order::orderBy('created_at','DESC')
        ->get();
        $currency_symbol = AppSetting::first()->currency_symbol;

        return view('admin.order.orderTable', compact('orders','currency_symbol'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        abort_if(Gate::denies('order_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $order = Order::find($id);
        $currency_symbol = AppSetting::first()->currency_symbol;
        return view('admin.order.orderShow', compact('order','currency_symbol'));
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
    public function changeStatus(Request $request)
    {
        $order = order::find($request->order_id);   
        $order->order_status = $request->status;
        if($request->status == "Completed")
        {
            $order->payment_status = 1;
        }
        $order->save();
        
        $user = User::find($order->user_id);
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
        
        $title = "Order ".$order->order_status;

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
                $userId = $order->user->device_token;
                OneSignal::sendNotificationToUser(
                    $message,
                    $userId,
                    $url = null,
                    $data = null,
                    $buttons = null,
                    $schedule = null,
                    $title
                );
            }
            catch (\Exception $th) {}
        }
}   }
