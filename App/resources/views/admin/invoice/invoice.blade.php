@extends('layouts.app')
@section('content')

    @include('layouts.breadcrumb', [
        'title' => __('Invoice'),
        'class' => 'col-lg-7'
    ])


<div class="container-fluid mt--6">
    <div class="row mb-5">
        <div class="col">
            <div class="card pb-4">
                <!-- Card header -->
                <div class="card-header border-0">
                    <span class="h3">{{__('Invoice')}}</span>
                    <div class="">
                        <a class="btn btn-primary addbtn float-right p-2 px-3"  target="_blank" href="{{url('/admin/order/invoice/print/'.$order->id)}}" id="print_invoice" >{{__('Print')}}</a>
                    </div>
                </div>
                <div class="card shadow mx-auto w-65">
                    <div class="card-body px-5 py-4">
                        <div class="row mb-5">
                            <div class="col text-center center">
                                <h1 class="pt-1 font-size-27">{{__('Invoice')}}</h1>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-6 text-left">
                                <h3>{{__('Details')}}</h3>
                                <div class="font-weight-bold">{{$setting->app_name}}</div>
                                <div>{{$setting->addr1}},</div>
                                <div>{{$setting->addr2}},</div>
                                <div>{{$setting->city}} - <span></span>{{$setting->zipcode}},</div>
                                <div>{{$setting->state}},</div>
                                <div>{{$setting->country}}</div>
                            </div>
                            <div class="col-6 text-right">
                                <img src="{{asset('images/app/'.$setting->color_logo)}}"  id="black_logo_output" class="mt-2 logo_size rtl-float-left">
                            </div>
                        </div>
                        
                        <hr class="my-4" />

                        <div class="row">
                            <div class="col-6 text-left">
                                <h3>{{__('Invoice to')}}</h3>
                                <div class="font-weight-bold">{{$order->user->name}}</div>
                                <div>{{$address->label}}</div>
                                <div>{{$address->addr1}}</div>
                                <div>{{$order->user->email}}</div>
                                <div>{{$order->user->code}}{{$order->user->phone}} </div>
                            </div>
                            <div class="col-6 text-right rtl-p">
                                <p class="strong">{{__('Order ID :')}} <span class="font-weight-normal">{{$order->order_id}}</span> </p>
                                <p class="strong mt--3">{{__('Order Delivery Date :')}} <span class="font-weight-normal">{{$order->date}}</span> </p>
                                <p class="strong mt--3">{{__('Payment Type :')}} <span class="font-weight-normal">{{$order->payment_type}}</span> </p>
                                <p class="strong mt--3">{{__('Order Status :')}} <span class="font-weight-normal">{{$order->order_status}}</span> </p>
                            </div>
                        </div>

                        <div class="table-responsive my-4">
                            <table class="table align-items-center table-flush">
                                <thead class="thead-light">
                                    <tr>
                                        <th scope="col" class="sort">{{__('#')}}</th>
                                        <th scope="col" class="sort">{{__('Product Name')}}</th>
                                        <th scope="col" class="sort">{{__('Service Name')}}</th>
                                        <th scope="col" class="sort">{{__('Qty')}}</th>
                                        <th scope="col" class="sort">{{__('Price')}}</th>
                                    </tr>
                                </thead>
                                <tbody class="list">
                                    @php
                                        $total = 0;
                                    @endphp
                                    @foreach ($child as $item)
                                        <tr>
                                            <th>{{$loop->iteration}}</th>
                                            <td>{{ $item->products->name }}</td>
                                            <td>{{ $item->serviceName }}</td>
                                            <td>{{ $item->qty }}</td>
                                            <td>{{$symbol}}{{ $item->price }}</td>
                                            @php
                                                $total = $total + $item->price;
                                            @endphp
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        @php
                            $discount = $total - $order->payment;
                            $payment = $total - $discount;
                        @endphp

                        <div class="text-right">
                            <p class="strong">{{__('Total :')}} <span class="font-weight-normal">{{$symbol}}{{$total}}</span> </p>
                            <p class="strong mt--3">{{__('Coupon Discount :')}} <span class="font-weight-normal">{{$symbol}}{{$discount}}</span> </p>
                            <p class="strong mt--3">{{__('Total Payment :')}} <span class="font-weight-normal">{{$symbol}}{{$payment}}</span> </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection