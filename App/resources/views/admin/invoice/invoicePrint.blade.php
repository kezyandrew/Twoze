<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="base_url" content="{{ url('/') }}">
    
    <!-- Dynamic color -->
    <?php $color = \App\Models\AppSetting::first()->color; ?>
    <style>
        :root{
            --primary_color : <?php echo $color ?>;
            --primary_color_hover : <?php echo $color.'cc' ?>;
        }
    </style>

    <!-- Title -->
    <?php $app_name = \App\Models\AppSetting::first()->app_name; ?>
    <title>{{ $app_name }}</title>

    <!-- Favicon -->
    <?php $favicon = \App\Models\AppSetting::first()->favicon; ?>
    <link href="{{asset('/images/app/'.$favicon)}}" rel="icon" type="image/png">

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">

    <!-- Argon CSS -->
    <link rel="stylesheet" href="{{ asset('admin/css/argon.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('admin/css/mystyle.css') }}" type="text/css">

    @if (session('direction') == "rtl")
        <link href="{{ asset('admin/css/rtl.css')}}" rel="stylesheet">
    @endif
    <script>
        window.print();
    </script>
</head>
<body class="{{ $class ?? '' }}">
    <div class="page"> 
        <div class="row">
            <div class="col">
                <div class="card shadow">
                    <div class="card-body">
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
                            <div class="col-6 text-right rtl-align-left">
                                <img src="{{asset('images/app/'.$setting->color_logo)}}"  id="black_logo_output" class="mt-2 logo_size rtl-float-left">
                            </div>
                        </div>
                        
                        <hr class="my-4" />

                       
                        <div class="row">
                            <div class="col-6 text-left">
                                <h3>{{__('Invoice to')}}</h3>
                                <div class="font-weight-bold">{{$order->user->name}}</div>
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

</body>
</html>
