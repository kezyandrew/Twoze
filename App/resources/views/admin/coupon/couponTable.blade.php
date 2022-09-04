@extends('layouts.app')
@section('content')

    @include('layouts.breadcrumb', [
            'title' => __('Coupons'),
            'class' => 'col-lg-7'
        ])

    
    <!-- Page content -->
    <div class="container-fluid mt--6">
        <div class="row">
            <div class="col">
                <div class="card">
                    <!-- Card header -->
                    <div class="card-header">
                        <h3 class="mb-0">{{__('Coupons table')}}</h3>
                        @can('coupon_create')
                            <button class="btn btn-sm btn-primary float-right add_coupon mt--4" id="add_coupon"><i class="fa fa-plus mr-1"></i> {{__('New')}}</button>
                        @endcan
                    </div>
                    <!-- Light table -->
                    <div class="table-responsive">
                        <table class="table align-items-center table-flush" id="dataTableReport">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col" class="sort">{{__('#')}}</th>
                                    <th scope="col" class="sort">{{__('Code')}}</th>
                                    <th scope="col" class="sort">{{__('Max_use')}}</th>
                                    <th scope="col" class="sort">{{__('Use_count')}}</th>
                                    <th scope="col" class="sort">{{__('Discount')}}</th>
                                    <th scope="col" class="sort">{{__('Duration')}}</th>
                                    <th scope="col" class="sort">{{__('Status')}}</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody class="list">
                                @if (count($coupons) != 0)
                                    @foreach ($coupons as $coupon)
                                        <tr>
                                            <th> {{$loop->iteration}} </th>
                                            <td> {{$coupon->code}} </td>
                                            <td> {{$coupon->max_use}} </td>
                                            <td> {{$coupon->use_count}} </td>
                                            <td>
                                                @if ($coupon->type == "Amount")
                                                    {{$currency_symbol}}{{$coupon->discount}}
                                                @else
                                                    {{$coupon->discount}}{{__('%')}}
                                                @endif
                                            </td>
                                            <td> {{$coupon->start_date}} {{__('-')}} {{$coupon->end_date}} </td>
                                            <td>
                                                @if ($coupon->status == 1)
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
                                                @can('coupon_access')
                                                    <button class="btn-white btn shadow-none p-0 m-0 table-action text-warning bg-white" onclick="show_coupon({{$coupon->id}})">
                                                        <i class="fas fa-eye"></i>
                                                    </button>
                                                @endcan
                                                @can('coupon_edit')
                                                    <button class="btn-white btn shadow-none p-0 m-0 table-action text-info bg-white" onclick="edit_coupon({{$coupon->id}})">
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
    @include('admin.coupon.couponCreate')
    @include('admin.coupon.couponShow')
    @include('admin.coupon.couponEdit')
@endsection