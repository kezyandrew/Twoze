@extends('layouts.app')
@section('content')

    @include('layouts.breadcrumb', [
            'title' => __('Products'),
            'class' => 'col-lg-7'
        ])

    
    <!-- Page content -->
    <div class="container-fluid mt--6">
        <div class="row">
            <div class="col">
                <div class="card">
                    <!-- Card header -->
                    <div class="card-header">
                        <h3 class="mb-0">{{__('Products Table')}}</h3>
                        @can('product_create')
                            <button class="btn btn-sm btn-primary float-right add_product mt--4" id="add_product"><i class="fa fa-plus mr-1"></i> {{__('New')}}</button>
                        @endcan
                    </div>
                    <!-- Light table -->
                    <div class="table-responsive">
                        <table class="table align-items-center table-flush" id="dataTableReport">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col" class="sort">{{__('#')}}</th>
                                    <th scope="col" class="sort">{{__('Image')}}</th>
                                    <th scope="col" class="sort">{{__('Name')}}</th>
                                    <th scope="col" class="sort">{{__('Services')}}</th>
                                    @if ($cloth_unit == "KG")
                                        <th scope="col" class="sort">{{__('Price / KG')}}</th>
                                    @else
                                        <th scope="col" class="sort">{{__('Price / Cloth')}}</th>
                                    @endif
                                    <th scope="col" class="sort">{{__('Status')}}</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody class="list">
                                @if (count($products) != 0)
                                    @foreach ($products as $product)
                                        <tr>
                                            <th> {{$loop->iteration}} </th>
                                            <td>
                                                <div class="avatar imageBox mr-3">
                                                    <img alt="Image placeholder imageBoxImg" src="{{asset('/images/product/'.$product->image)}}">
                                                </div>
                                            </td>
                                            <td> {{$product->name}} </td>
                                            <td>
                                                <div class="avatar-group">
                                                    @foreach ($product->services as $service)
                                                        <a href="#" class="avatar avatar-sm rounded-circle" data-toggle="tooltip" data-original-title="{{$service->name}}">
                                                            <img alt="service" class="service_icon" src="{{asset('images/service/'.$service->image)}}">
                                                        </a>
                                                    @endforeach
                                                </div>
                                            </td>
                                            <td> {{$currency_symbol}}{{$product->price}} / {{$cloth_unit}} </td>
                                            <td>
                                                @if ($product->status == 1)
                                                    <span class="badge badge-dot mr-4">
                                                        <i class="bg-success"></i>
                                                        <span class="status">{{__('Active')}}</span>
                                                    </span>
                                                @else
                                                    <span class="badge badge-dot mr-4">
                                                        <i class="bg-danger"></i>
                                                        <span class="status">{{__('Inactive')}}</span>
                                                    </span>
                                                @endif
                                            </td>
                                            <td class="table-actions">
                                                @can('product_access')
                                                    <button class="btn-white btn shadow-none p-0 m-0 table-action text-warning bg-white" onclick="show_product({{$product->id}})">
                                                        <i class="fas fa-eye"></i>
                                                    </button>
                                                @endcan
                                                @can('product_edit')
                                                    <button class="btn-white btn shadow-none p-0 m-0 table-action text-info bg-white" onclick="edit_product({{$product->id}})">
                                                        <i class="fa fa-edit"></i>
                                                    </button>
                                                @endcan
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <?php $no_data = \App\Models\AppSetting::first()->no_data; ?>
                                    <tr>
                                        <td colspan="11" class="text-center">
                                            <img class="nodata-img" src="{{asset('/images/app/'.$no_data)}}" alt="">
                                        </td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('admin.product.productCreate')
    @include('admin.product.productShow')
    @include('admin.product.productEdit')
@endsection