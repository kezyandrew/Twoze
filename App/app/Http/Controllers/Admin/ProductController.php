<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Gate;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Product;
use App\Models\AppSetting;
use App\Models\Service;


class ProductController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('product_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $products = Product::orderBy('created_at','DESC')
        ->get();
        $currency_symbol = AppSetting::first()->currency_symbol;
        $cloth_unit = AppSetting::first()->cloth_unit;
        $services = Service::where('status',1)->get();

        return view('admin.product.productTable', compact('products','currency_symbol','services','cloth_unit'));
    }

    public function create()
    {

    }

    public function store(Request $request)
    {
        $request->validate([
            'image' => 'bail|required',
            'name' => 'bail|required',
            'service_id' => 'bail|required',
            'price' => 'bail|required|numeric',
            'status' => 'bail|required',
        ]);

        $product = new Product();
        $product->name = $request->name;
        $product->price = $request->price;
        $product->service_id = json_encode($request->service_id);
        $product->status = $request->status;
        
        if($request->hasFile('image'))
        {
            $image = $request->file('image');
            $name = 'Product_'.time().'.'. $image->getClientOriginalExtension();
            $destinationPath = public_path('/images/product');
            $image->move($destinationPath, $name);
            $product->image = $name;
        }
        $product->save();

        return response()->json(['success' => true,'data' => $product, 'msg' => 'Product created successfully..!!'], 200); 
    }

    public function show($id)
    {
        $data['product'] = Product::find($id);
        $data['currency_symbol'] = AppSetting::first()->currency_symbol;
        $data['cloth_unit'] = AppSetting::first()->cloth_unit;
        return response()->json(['success' => true,'data' => $data, 'msg' => 'View Product'], 200);
    }

    public function edit($id)
    {
        abort_if(Gate::denies('product_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $data['product'] = Product::find($id);

        $data['services'] = Service::get();
        return response()->json(['success' => true,'data' => $data], 200);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'bail|required',
            'service_id' => 'bail|required',
            'price' => 'bail|required|numeric',
            'status' => 'bail|required',
        ]);

        $product = Product::find($id);
        $product->name = $request->name;
        $product->price = $request->price;
        $product->service_id = json_encode($request->service_id);
        $product->status = $request->status;
        
        if($request->hasFile('image_edit'))
        {
            if(\File::exists(public_path('/images/product/'. $product->image))){
                \File::delete(public_path('/images/product/'. $product->image));
            }

            $image = $request->file('image_edit');
            $name = 'Product_'.time().'.'. $image->getClientOriginalExtension();
            $destinationPath = public_path('/images/product');
            $image->move($destinationPath, $name);
            $product->image = $name;
        }
        $product->save();

        return response()->json(['success' => true,'data' => $product, 'msg' => 'Product edited successfully..!!'], 200); 
    }

    public function destroy($id)
    {
        //
    }
}
