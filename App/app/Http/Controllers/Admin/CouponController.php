<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Gate;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Coupon;
use App\Models\AppSetting;

class CouponController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('coupon_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $coupons = Coupon::orderBy('created_at','DESC')
        ->get();
        $currency_symbol = AppSetting::first()->currency_symbol;

        return view('admin.coupon.couponTable', compact('coupons','currency_symbol'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $request->validate([
            'code' => 'bail|required',
            'max_use' => 'bail|required|numeric',
            'type' => 'bail|required',
            'discount' => 'bail|required|numeric',
            'duration' => 'bail|required',
            'status' => 'bail|required',
        ]);

        $coupon = new Coupon();
        $coupon->code = $request->code;
        $coupon->max_use = $request->max_use;
        $coupon->type = $request->type;
        $coupon->discount = $request->discount;
        $coupon->status = $request->status;

        $dates = explode(' to ', $request->duration);
        $start = $dates[0];
        $end = $dates[1];

        $coupon->start_date = $start;
        $coupon->end_date = $end;
        $coupon->save();

        return response()->json(['success' => true,'data' => $coupon, 'msg' => 'Coupon created successfully..!!'], 200); 
    }

    public function show($id)
    {
        $data['coupon'] = Coupon::find($id);
        $data['currency_symbol'] = AppSetting::first()->currency_symbol;
        return response()->json(['success' => true,'data' => $data, 'msg' => 'View Coupon'], 200);
    }

    public function edit($id)
    {
        abort_if(Gate::denies('coupon_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $data['coupon'] = Coupon::find($id);
        return response()->json(['success' => true,'data' => $data], 200);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
        'max_use' => 'bail|required|numeric',
        'type' => 'bail|required',
        'discount' => 'bail|required|numeric',
        'duration' => 'bail|required',
        'status' => 'bail|required',
        ]);

        $coupon = Coupon::find($id);
        $coupon->max_use = $request->max_use;
        $coupon->type = $request->type;
        $coupon->discount = $request->discount;
        $coupon->status = $request->status;

        $dates = explode(' to ', $request->duration);
        $start = $dates[0];
        $end = $dates[1];

        $coupon->start_date = $start;
        $coupon->end_date = $end;
        $coupon->save();

        return response()->json(['success' => true,'data' => $coupon, 'msg' => 'Coupon edited successfully..!!'], 200); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
