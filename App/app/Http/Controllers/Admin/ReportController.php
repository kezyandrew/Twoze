<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Gate;
use Symfony\Component\HttpFoundation\Response;
use App\Models\User;
use App\Models\Order;
use OneSignal;
use App\Models\AppSetting;

class ReportController extends Controller
{
    public function users()
    {
        abort_if(Gate::denies('report_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $pass = '';
        $users = array();
        $all_users = User::where('status',1)->orderBy('id', 'DESC')->get();
        foreach($all_users as $client)
        {
            if($client->roles->contains('title','Client'))
            {
                $tot_orders = Order::where('user_id',$client->id)->count();
                $tot_payment = Order::where('user_id',$client->id)->sum('payment');
                $client->tot_order = $tot_orders;
                $client->tot_payment = $tot_payment;
                array_push($users,$client);
            }
        }
        $currency_symbol = AppSetting::first()->currency_symbol;
        return view('admin.report.usersReport', compact('users','currency_symbol','tot_orders','pass'));
    }

    public function usersFilter(Request $request)
    {
        abort_if(Gate::denies('report_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        if($request->filter_date != null)
        {
            $pass = $request->filter_date;
            $dates = explode(' to ', $request->filter_date);
            $from = $dates[0];
            $to = $dates[1];

            $users = array();
            $all_users = User::where('status',1)
            ->whereBetween('created_at', [$from, $to])
            ->orderBy('id', 'DESC')->get();
            foreach($all_users as $client)
            {
                if($client->roles->contains('title','Client'))
                {
                    $tot_orders = Order::where('user_id',$client->id)->count();
                    $tot_payment = Order::where('user_id',$client->id)->sum('payment');
                    $client->tot_order = $tot_orders;
                    $client->tot_payment = $tot_payment;
                    array_push($users,$client);
                }
            }

            $currency_symbol = AppSetting::first()->currency_symbol;
            return view('admin.report.usersReport',compact('users','currency_symbol','tot_orders','pass'));
        }
        else{
            return redirect('/admin/report/usersReport')->withErrors(['Select Date In Range']);
        }
    }

    public function revenueReport()
    {
        abort_if(Gate::denies('report_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $pass = '';
        $orders = Order::where('payment_status',1)->orderBy('id','DESC')->get();
        $currency_symbol = AppSetting::first()->currency_symbol;
        return view('admin.report.revenueReport', compact('currency_symbol','orders','pass'));

    }

    public function revenueReportFilter(Request $request)
    {
        abort_if(Gate::denies('report_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        if($request->filter_date != null)
        {
            $pass = $request->filter_date;
            $dates = explode(' to ', $request->filter_date);
            $from = $dates[0];
            $to = $dates[1];
            $orders = Order::where('payment_status',1)
            ->whereBetween('created_at', [$from, $to])
            ->orderBy('date', 'DESC')
            ->get();
            $currency_symbol = AppSetting::first()->currency_symbol;
            return view('admin.report.revenueReport',compact('orders','currency_symbol','pass'));
        }
        else{
            return redirect('/admin/report/revenueReport')->withErrors(['Select Date In Range']);
        }

    }

}
