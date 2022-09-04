<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\User;

class CalendarController extends Controller
{
    public function index()
    {
        $orders = Order::get();
        $event = [];
        foreach ($orders as $row)
        {
            if ($row->order_status == "Cancel")
            {
                $bgColor = "#fdd1da";
                $textColor = "#f80031";
            }
            else if($row->order_status == "Pending")
            {
                $bgColor = "#eaecfb";
                $textColor = "#2643e9";
            }
            else if($row->order_status == "Completed")
            {
                $bgColor = "#c0ffe4";
                $textColor = "#108c57";
            }
            else{
                $bgColor = "rgba(11, 11, 11, .5)";
                $textColor = "#111111";
            }

            $events[] = \Calendar::event(
                $row->user->name,
                false,
                $row->date,
                $row->date,
                1,
                [
                    'color' => $bgColor,
                    'textColor' => $textColor,
                    'url' => url('admin/order/invoice/'.$row->id)
                ]
            );
        }

        $calendar = \Calendar::addEvents($events);
        return view('admin.calendar.calendar', compact('calendar','orders'));
    }
}
