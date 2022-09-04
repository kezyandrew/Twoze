@extends('layouts.app')
@section('content')

    @include('layouts.breadcrumb', [
            'title' => __('View'),
            'headerData' => __('User') ,
            'url' => 'admin/user' ,
            'class' => 'col-lg-7'
        ])


<div class="container-fluid mt--6">
    <div class="row">
        <div class="col-xl-4 order-xl-2 mb-5 mb-xl-0">
            <div class="card card-profile shadow">
                <div class="row justify-content-center">
                    <div class="col-lg-3 order-lg-2">
                        <div class="card-profile-image">
                            <a href="#">
                                <img src="{{asset('/images/user/'.$user->image)}}" class="rounded-circle user_round">
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-header text-center border-0 pt-8 pt-md-4 pb-0 pb-md-4">
                    <div class="d-flex justify-content-between">
                    </div>
                </div>
                <div class="card-body pt-0 pt-md-4">
                    <div class="row">
                        <div class="col">
                            <div class="card-profile-stats d-flex justify-content-center mt-md-5">
                                <div>
                                    <span class="heading">{{count($completed)}}</span>
                                    <span class="description">{{__('Completed')}}</span>
                                </div>
                                <div>
                                    <span class="heading">{{count($pending)}}</span>
                                    <span class="description">{{__('Pending')}}</span>
                                </div>
                                <div>
                                    <span class="heading">{{count($cancel)}}</span>
                                    <span class="description">{{__('Cancel')}}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="text-center">
                        <h3>
                            {{ $user->name }}<span class="font-weight-light"></span>   
                        </h3>
                        <div>
                            {{__('Phone :')}} {{$user->code}}{{$user->phone}}<br>
                            {{__('Email :')}} {{$user->email}}
                        </div>
                        <hr class="my-4" />
                        @foreach ($address as $key => $addr)
                            @if($key == 0)
                                @if (count($address) == 1)
                                    <div class="h3 text-left">{{__('Address :')}}</div>
                                @else
                                    <div class="h3 text-left">{{__('Addresses :')}}</div>
                                @endif
                            @endif
                            <div class="h3 text-left">{{$addr->label}}</div>
                            <div class="text-left">{{$addr->addr1}},</div>
                            <br>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    
        <div class="col-xl-8 order-xl-1">
            <div class="card bg-secondary shadow">
                <div class="card-header border-0">
                    <h3>{{__('View User')}}</h3>
                </div>
                <div class="card-body rtl-icon">
                    <div class="nav-wrapper">
                        <ul class="nav nav-pills nav-fill flex-column flex-md-row" id="tabs-icons-text" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link mb-sm-3 mb-md-0 active" id="tabs-icons-text-1-tab" data-toggle="tab" href="#tabs-icons-text-1" role="tab" aria-controls="tabs-icons-text-1" aria-selected="true"><i class="far fa-check-square mr-2"></i>{{__('Completed')}}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link mb-sm-3 mb-md-0" id="tabs-icons-text-3-tab" data-toggle="tab" href="#tabs-icons-text-3" role="tab" aria-controls="tabs-icons-text-3" aria-selected="false"><i class="far fa-clock mr-2"></i>{{__('Pending')}}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link mb-sm-3 mb-md-0" id="tabs-icons-text-4-tab" data-toggle="tab" href="#tabs-icons-text-4" role="tab" aria-controls="tabs-icons-text-4" aria-selected="false"><i class="fa fa-times mr-2"></i>{{__('Cancel')}}</a>
                            </li>
                        </ul>
                    </div>
                    <div class="card shadow mx-auto my-0">
                        <div class="my-0 mx-auto w-90">
                            <div class="card-body">
                                <div class="tab-content" id="myTabContent">

                                    <div class="tab-pane fade show active" id="tabs-icons-text-1" role="tabpanel" aria-labelledby="tabs-icons-text-1-tab">
                                        @if (count($completed) != 0)
                                            @foreach ($completed as $key)
                                                <div class="card">
                                                    <div class="card-body">
                                                        <div class="row">
                                                            <div class="col-1 ml--2">
                                                                <div class="h2 ml-1">{{$key->created_at->format('d')}}</div>
                                                                <div class="h4 text-muted">{{$key->created_at->format('M')}},</div>
                                                                <div class="h4 text-muted">{{$key->created_at->format('Y')}}</div>
                                                            </div>
                                                            <div class="col">
                                                                @foreach ($key->child as $item)
                                                                @php
                                                                    $pro_price = 0;
                                                                @endphp
                                                                    @foreach ($item['service'] as $ser)
                                                                        @php
                                                                            $pro_price = $pro_price + $ser['price'];
                                                                        @endphp
                                                                    @endforeach
                                                                    <h3>{{$item['name']}} - {{$currency_symbol}}{{$pro_price}}</h3>
                                                                    @foreach ($item['service'] as $ser)
                                                                        <span>{{$ser['serviceName']}} ({{$ser['qty']}})</span><br>
                                                                        @php
                                                                            $pro_price = $pro_price + $ser['price'];
                                                                        @endphp
                                                                    @endforeach
                                                                        <div class="mb-3"></div>
                                                                @endforeach
                                                            </div>
                                                            <div class="col text-right">
                                                                <div class="h3 rtl-align-left">{{$currency_symbol}}{{$key->payment}}</div>
                                                                <a href="{{url('/admin/order/invoice/'.$key->id)}}" class="btn-link text-primary rtl-float-left">{{ __('Invoice') }}</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @else
                                            <div class="text-center">{{__('No Completed Orders')}} </div>
                                        @endif
                                    </div>

                                    <div class="tab-pane fade" id="tabs-icons-text-3" role="tabpanel" aria-labelledby="tabs-icons-text-3-tab">
                                        @if (count($pending) != 0)
                                            @foreach ($pending as $key)
                                                <div class="card">
                                                    <div class="card-body">
                                                        <div class="row">
                                                            <div class="col-1 ml--2">
                                                                <div class="h2 ml-1">{{$key->created_at->format('d')}}</div>
                                                                <div class="h4 text-muted">{{$key->created_at->format('M')}},</div>
                                                                <div class="h4 text-muted">{{$key->created_at->format('Y')}}</div>
                                                            </div>
                                                            <div class="col">
                                                                @foreach ($key->child as $item)
                                                                @php
                                                                    $pro_price = 0;
                                                                @endphp
                                                                    @foreach ($item['service'] as $ser)
                                                                        @php
                                                                            $pro_price = $pro_price + $ser['price'];
                                                                        @endphp
                                                                    @endforeach
                                                                    <h3>{{$item['name']}} - {{$currency_symbol}}{{$pro_price}}</h3>
                                                                    @foreach ($item['service'] as $ser)
                                                                        <span>{{$ser['serviceName']}} ({{$ser['qty']}})</span><br>
                                                                        @php
                                                                            $pro_price = $pro_price + $ser['price'];
                                                                        @endphp
                                                                    @endforeach
                                                                        <div class="mb-3"></div>
                                                                @endforeach
                                                            </div>
                                                            <div class="col text-right">
                                                                <div class="h3 rtl-align-left">{{$currency_symbol}}{{$key->payment}}</div>
                                                                <a href="{{url('/admin/order/invoice/'.$key->id)}}" class="btn-link text-primary rtl-float-left">{{ __('Invoice') }}</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @else
                                            <div class="text-center">{{__('No Pending Orders')}} </div>
                                        @endif
                                    </div>
                                    
                                    <div class="tab-pane fade" id="tabs-icons-text-4" role="tabpanel" aria-labelledby="tabs-icons-text-4-tab">
                                        @if (count($cancel) != 0)
                                            @foreach ($cancel as $key)
                                                <div class="card">
                                                    <div class="card-body">
                                                        <div class="row">
                                                            <div class="col-1 ml--2">
                                                                <div class="h2 ml-1">{{$key->created_at->format('d')}}</div>
                                                                <div class="h4 text-muted">{{$key->created_at->format('M')}},</div>
                                                                <div class="h4 text-muted">{{$key->created_at->format('Y')}}</div>
                                                            </div>
                                                            <div class="col">
                                                                @foreach ($key->child as $item)
                                                                    @php
                                                                        $pro_price = 0;
                                                                    @endphp
                                                                    @foreach ($item['service'] as $ser)
                                                                        @php
                                                                            $pro_price = $pro_price + $ser['price'];
                                                                        @endphp
                                                                    @endforeach
                                                                    <h3>{{$item['name']}} - {{$currency_symbol}}{{$pro_price}}</h3>
                                                                    @foreach ($item['service'] as $ser)
                                                                        <span>{{$ser['serviceName']}} ({{$ser['qty']}})</span><br>
                                                                        @php
                                                                            $pro_price = $pro_price + $ser['price'];
                                                                        @endphp
                                                                    @endforeach
                                                                        <div class="mb-3"></div>
                                                                @endforeach
                                                            </div>
                                                            <div class="col text-right">
                                                                <div class="h3 rtl-align-left">{{$currency_symbol}}{{$key->payment}}</div>
                                                                <a href="{{url('/admin/order/invoice/'.$key->id)}}" class="btn-link text-primary rtl-float-left">{{ __('Invoice') }}</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @else
                                            <div class="text-center">{{__('No Cancelled Orders')}} </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection