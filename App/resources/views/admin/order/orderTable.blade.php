@extends('layouts.app')
@section('content')

    @include('layouts.breadcrumb', [
            'title' => __('Orders'),
            'class' => 'col-lg-7'
        ])

    
    <!-- Page content -->
    <div class="container-fluid mt--6">
        <div class="row">
            <div class="col">
                <div class="card">
                    <!-- Card header -->
                    <div class="card-header">
                        <h3 class="mb-0">{{__('Orders table')}}</h3>
                        {{-- @can('order_create')
                            <button class="btn btn-sm btn-primary float-right add_order mt--4" id="add_order"><i class="fa fa-plus mr-1"></i> {{__('New')}}</button>
                        @endcan --}}
                    </div>
                    <!-- Light table -->
                    <div class="table-responsive">
                        <table class="table align-items-center table-flush" id="dataTableReport">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col" class="sort">{{__('#')}}</th>
                                    <th scope="col" class="sort">{{__('Order ID')}}</th>
                                    <th scope="col" class="sort">{{__('User ID')}}</th>
                                    <th scope="col" class="sort">{{__('Delivery Date')}}</th>
                                    <th scope="col" class="sort">{{__('Discount')}}</th>
                                    <th scope="col" class="sort">{{__('Payment')}}</th>
                                    <th scope="col" class="sort badge-center">{{__('Payment Status')}}</th>
                                    <th scope="col" class="sort">{{__('Order status')}}</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody class="list">
                                @if (count($orders) != 0)
                                    @foreach ($orders as $order)
                                        <tr>
                                            <th> {{$loop->iteration}} </th>
                                            <td> {{$order->order_id}} </td>
                                            <td> {{$order->user->name}} </td>
                                            <td> {{$order->date}} </td>
                                            <td> {{$currency_symbol}}{{$order->discount}} </td>
                                            <td> {{$currency_symbol}}{{$order->payment}} </td>
                                            <td class="badge-center">
                                                @if ($order->payment_status == 0)
                                                    <span class="badge badge-pill badge-warning">{{__('Unpaid')}}</span>
                                                @else
                                                    @if ($order->payment_type == "CASH")
                                                        <span class="badge badge-pill badge-success">{{__('CASH')}}</span>
                                                    @elseif ($order->payment_type == "RAZORPAY")
                                                        <span class="badge badge-pill badge-success">{{__('RAZORPAY')}}</span>
                                                    @elseif ($order->payment_type == "PAYPAL")
                                                        <span class="badge badge-pill badge-success">{{__('PAYPAL')}}</span>
                                                    @elseif ($order->payment_type == "STRIPE")
                                                        <span class="badge badge-pill badge-success">{{__('STRIPE')}}</span>
                                                    @else
                                                        <span class="badge badge-pill badge-success">{{__('Paid')}}</span>
                                                    @endif
                                                @endif
                                            </td>
                                            <td>
                                                @can('order_edit')
                                                    {{-- <select class="form-control statusDD" onchange="changeStatus({{$order->id}})" name="selector" id="selector{{$order->id}}"> --}}
                                                        <select class="form-control statusDD" onchange="changeStatus({{$order->id}})" name="selector" id="selector{{$order->id}}" {{$order->order_status == "Completed" || $order->order_status == "Cancel"?'disabled': ''}} >
                                                        <option value="Pending" {{$order->order_status == "Pending"?'selected': ''}}>Pending</option>
                                                        <option value="Cancel" {{$order->order_status == "Cancel"?'selected': ''}}>Cancel</option>
                                                        <option value="Completed" {{$order->order_status == "Completed"?'selected': ''}}>Completed</option>
                                                    </select>
                                                @endcan
                                                @can(!'order_edit')
                                                    @if ($order->order_status == "Pending")
                                                        <span class="badge badge-dot mr-4">
                                                            <i class="bg-warning"></i>
                                                            <span class="status">Pending</span>
                                                        </span>
                                                    @elseif ($order->order_status == "Cancel")
                                                        <span class="badge badge-dot mr-4">
                                                            <i class="bg-danger"></i>
                                                            <span class="status">Cancel</span>
                                                        </span>
                                                    @elseif ($order->order_status == "Completed")
                                                        <span class="badge badge-dot mr-4">
                                                            <i class="bg-success"></i>
                                                            <span class="status">Completed</span>
                                                        </span>
                                                    @endif
                                                @endcan
                                            </td>
                                            <td class="table-actions">
                                                <a href="{{url('/admin/order/invoice/'.$order->id)}}" class="text-blue cursor table-action">
                                                    <i class="fas fa-file-invoice"></i>
                                                </a>
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
    {{-- @include('admin.offer.offerCreate')
    @include('admin.offer.offerEdit') --}}
@endsection