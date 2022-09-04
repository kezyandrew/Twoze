<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use Gate;
use App\Models\Role;
use App\Models\User;
use App\Models\Service;
use App\Models\Product;
use App\Models\Order;
use App\Models\AppSetting;
use Carbon\Carbon;
use Symfony\Component\HttpFoundation\Response;

class DashboardController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('dashboard'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $user_count = 0;
        $table_users = array();
        $all_users = User::where('status',1)->orderBy('id','DESC')->get();
        foreach($all_users as $client)
        {
            if($client->roles->contains('title','Client'))
            {
                $user_count++;
                array_push($table_users,$client);
            }
        }
        $services_count = Service::where('status',1)->count();
        $products_count = Product::where('status',1)->count();
        $currency_symbol = AppSetting::first()->currency_symbol;
        $income = Order::where('payment_status',1)->sum('payment');

        return view('admin.dashboard.dashboard', compact('user_count','services_count','products_count','income','currency_symbol','table_users'));
    }
    // Revenue Chart Start
    public function revenueWeekData()
    {
        $dataWeek = array();
        $labelsWeek = array();

        array_push($dataWeek,ceil(order::where([['payment_status',1],['order_status','!=','Cancel']])
        ->whereDate('created_at', Carbon::today()->format('Y-m-d'))
        ->sum('payment')));
        for ($i=1; $i <= 6 ; $i++)
        { 
            array_push($dataWeek,ceil(order::where([['payment_status',1],['order_status','!=','Cancel']])
            ->whereDate('created_at', Carbon::now()->subDays($i)->format('Y-m-d'))
            ->sum('payment')));
        }

        array_push($labelsWeek,Carbon::now()->format('d-M'));
        for ($i=1; $i <= 6 ; $i++)
        { 
            array_push($labelsWeek,Carbon::now()->subDays($i)->format('d-M'));
        }

        return [$dataWeek,$labelsWeek];
    }
    public function revenueMonthData()
    {
        $dataMonth = array();
        $labelsMonth = array();

        array_push($dataMonth,ceil(order::where([['payment_status',1],['order_status','!=','Cancel']])
        ->whereDate('created_at', Carbon::today()->format('Y-m-d'))
        ->sum('payment')));
        for ($i=1; $i <= 30 ; $i++)
        { 
            array_push($dataMonth,ceil(order::where([['payment_status',1],['order_status','!=','Cancel']])
            ->whereDate('created_at',Carbon::now()->subDays($i)->format('Y-m-d'))
            ->sum('payment')));
        }

        array_push($labelsMonth,Carbon::now()->format('d-M'));
        for ($i=1; $i <= 30 ; $i++)
        { 
            array_push($labelsMonth,Carbon::now()->subDays($i)->format('d-M'));
        }

        return [$dataMonth,$labelsMonth];
    }
    public function revenueYearData()
    {
        $dataYear = array();
        $labelsYear = array();

        array_push($dataYear,ceil(order::where([['payment_status',1],['order_status','!=','Cancel']])
        ->whereMonth('created_at', Carbon::now())
        ->sum('payment')));
        
        for ($i=1; $i <= 11 ; $i++)
        {
            if($i >= Carbon::now()->month) {
                array_push($dataYear,ceil(order::where([['payment_status',1],['order_status','!=','Cancel']])
                ->whereMonth('created_at',Carbon::now()->subMonths($i))
                ->whereYear('created_at', Carbon::now()->subYears(1))
                ->sum('payment')));
            } else {
                array_push($dataYear,ceil(order::where([['payment_status',1],['order_status','!=','Cancel']])
                ->whereMonth('created_at',Carbon::now()->subMonths($i))
                ->whereYear('created_at', Carbon::now()->year)
                ->sum('payment')));
            }
            
        }

        array_push($labelsYear, Carbon::now()->format('M-y'));
        for ($i=1; $i <= 11 ; $i++)
        { 
            array_push($labelsYear, Carbon::now()->subMonths($i)->format('M-y'));
        }

        return [$dataYear,$labelsYear];
    }
    // Revenue Chart End

    // User Chart Start
    public function userData()
    {
        $dataYear = array();
        $labelsYear = array();

        $user_count = 0;
        $table_users = array();
        $all_users = User::where('status',1)->whereMonth('created_at', Carbon::now())->get();
        foreach($all_users as $client)
        {
            if($client->roles->contains('title','Client'))
            {
                $user_count++;
                array_push($table_users,$client);
            }
        }
        array_push($dataYear,$user_count);

        for ($i=1; $i <= 11 ; $i++)
        {
            $user_count = 0;
            $table_users = array();
            $all_users = User::where('status',1)->whereMonth('created_at',Carbon::now()->subMonths($i))->get();
            foreach($all_users as $client)
            {
                if($client->roles->contains('title','Client'))
                {
                    $user_count++;
                    array_push($table_users,$client);
                }
            }
            array_push($dataYear,$user_count);
        }

        array_push($labelsYear, Carbon::now()->format('M-y'));
        for ($i=1; $i <= 11 ; $i++)
        { 
            array_push($labelsYear, Carbon::now()->subMonths($i)->format('M-y'));
        }
        
        return [$dataYear,$labelsYear];
    }
    // User Chart End
}
