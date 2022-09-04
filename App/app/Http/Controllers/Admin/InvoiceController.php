<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderChild;
use App\Models\Address;
use App\Models\Product;
use App\Models\AppSetting;

class InvoiceController extends Controller
{
    public function invoice($id)
    {
        $order = Order::find($id);
        $address = Address::where('id',$order->addr_id)->first();
        $child = OrderChild::where('order_id',$order->id)->get();
        $symbol = AppSetting::first()->currency_symbol;
        $setting = AppSetting::first();
        return view('admin.invoice.invoice', compact('order','symbol','setting','child','address'));
    }

    public function invoice_print($id)
    {
      $order = Order::find($id);
      $child = OrderChild::where('order_id',$order->id)->get();
      $symbol = AppSetting::first()->currency_symbol;
      $setting = AppSetting::first();
      return view('admin.invoice.invoicePrint', compact('order','symbol','setting','child'));
    }
}
