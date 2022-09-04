<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Gate;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Offer;
use OneSignal;
use App\Models\AppSetting;

class OfferController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('offer_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $offers = Offer::orderBy('created_at','DESC')
        ->get();
        $currency_symbol = AppSetting::first()->currency_symbol;

        return view('admin.offer.offerTable', compact('offers','currency_symbol'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $request->validate([
            'image' => 'bail|required',
            'title1' => 'bail|required',
            'title2' => 'bail|required',
            'discount' => 'bail|required|numeric',
            'type' => 'bail|required',
            'status' => 'bail|required',
        ]);

        $offer = new Offer();
        $offer->title1 = $request->title1;
        $offer->title2 = $request->title2;
        $offer->discount = $request->discount;
        $offer->type = $request->type;
        $offer->status = $request->status;
        
        if($request->hasFile('image'))
        {
            $image = $request->file('image');
            $name = 'Offer_'.time().'.'. $image->getClientOriginalExtension();
            $destinationPath = public_path('/images/offer');
            $image->move($destinationPath, $name);
            $offer->image = $name;
        }
        $offer->save();

        return response()->json(['success' => true,'data' => $offer, 'msg' => 'Offer created successfully..!!'], 200); 
    }

    public function show($id)
    {
        $data['offer'] = Offer::find($id);
        $data['currency_symbol'] = AppSetting::first()->currency_symbol;
        return response()->json(['success' => true,'data' => $data, 'msg' => 'View Offer'], 200); 
    }

    public function edit($id)
    {
        abort_if(Gate::denies('offer_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $data['offer'] = Offer::find($id);
        return response()->json(['success' => true,'data' => $data], 200);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title1' => 'bail|required',
            'title2' => 'bail|required',
            'discount' => 'bail|required|numeric',
            'type' => 'bail|required',
            'status' => 'bail|required',
        ]);

        $offer = Offer::find($id);
        $offer->title1 = $request->title1;
        $offer->title2 = $request->title2;
        $offer->discount = $request->discount;
        $offer->type = $request->type;
        $offer->status = $request->status;
        
        if($request->hasFile('image_edit'))
        {
            if(\File::exists(public_path('/images/offer/'. $offer->image))){
                \File::delete(public_path('/images/offer/'. $offer->image));
            }

            $image = $request->file('image_edit');
            $name = 'Offer_'.time().'.'. $image->getClientOriginalExtension();
            $destinationPath = public_path('/images/offer');
            $image->move($destinationPath, $name);
            $offer->image = $name;
        }
        $offer->save();

        return response()->json(['success' => true,'data' => $offer, 'msg' => 'Offer edited successfully..!!'], 200); 
    }

    public function destroy($id)
    {
        $offer = Offer::find($id);
        \File::delete(public_path('/images/offer/'. $offer->image));
        $offer->delete();
        return response()->json(['success' => true,'data' => $offer, 'msg' => 'Offer Deleted'], 200);
    }
   
}
