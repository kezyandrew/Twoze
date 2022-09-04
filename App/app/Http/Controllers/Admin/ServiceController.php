<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Gate;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Service;
use App\Models\AppSetting;

class ServiceController extends Controller
{  
    public function index()
    {
        abort_if(Gate::denies('service_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $services = Service::orderBy('created_at','DESC')
        ->get();

        $currency_symbol = AppSetting::first()->currency_symbol;
        $cloth_unit = AppSetting::first()->cloth_unit;

        return view('admin.service.serviceTable', compact('services','currency_symbol','cloth_unit'));
    }

    public function create()
    {
        //
    }

   
    public function store(Request $request)
    {
        $request->validate([
            'image' => 'bail|required',
            'name' => 'bail|required',
            'price' => 'bail|required|numeric',
            'status' => 'bail|required',
        ]);

        $service = new Service();
        $service->name = $request->name;
        $service->price = $request->price;
        $service->status = $request->status;
        
        if($request->hasFile('image'))
        {
            $image = $request->file('image');
            $name = 'Service_'.time().'.'. $image->getClientOriginalExtension();
            $destinationPath = public_path('/images/service');
            $image->move($destinationPath, $name);
            $service->image = $name;
        }
        $service->save();

        return response()->json(['success' => true,'data' => $service, 'msg' => 'Service created successfully..!!'], 200); 
    }

    public function show($id)
    {
        $data['service'] = Service::find($id);
        $data['currency_symbol'] = AppSetting::first()->currency_symbol;
        $data['cloth_unit'] = AppSetting::first()->cloth_unit;
        return response()->json(['success' => true,'data' => $data, 'msg' => 'View Service'], 200);
    }

   
    public function edit($id)
    {
        abort_if(Gate::denies('service_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $data['service'] = Service::find($id);
        return response()->json(['success' => true,'data' => $data], 200);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'bail|required',
            'price' => 'bail|required|numeric',
            'status' => 'bail|required',
        ]);

        $service = Service::find($id);
        $service->name = $request->name;
        $service->price = $request->price;
        $service->status = $request->status;
        
        if($request->hasFile('image_edit'))
        {
            if(\File::exists(public_path('/images/service/'. $service->image))){
                \File::delete(public_path('/images/service/'. $service->image));
            }

            $image = $request->file('image_edit');
            $name = 'Service_'.time().'.'. $image->getClientOriginalExtension();
            $destinationPath = public_path('/images/service');
            $image->move($destinationPath, $name);
            $service->image = $name;
        }
        $service->save();

        return response()->json(['success' => true,'data' => $service, 'msg' => 'Service edited successfully..!!'], 200); 
    }


    public function destroy($id)
    {
        //
    }
}
