@extends('layouts.app')
@section('content')


<!-- Top 4 cards -->
<?php $bg_img = \App\Models\AppSetting::first()->bg_img; ?>
<div class="header pt-9" style="background-image: url({{asset('images/app/'.$bg_img)}}); background-size: cover; background-position: center center;padding-bottom: 50px;"> 
    <span class="mask bg-gradient-dark opacity-7"></span>
    <div class="container-fluid">
        <div class="header-body mt--4">
            <div class="row align-items-center pb-4">
                <div class="col-lg-6 col-7">
                    <h6 class="h2 text-white d-inline-block">{{__('Dashboard')}}</h6>
                    <nav aria-label="breadcrumb" class="d-none d-md-inline-block">
                        <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                            <li class="breadcrumb-item text-white"><a href="{{url('admin/dashboard')}}"><i class="fa fa-home text-primary"></i></a></li>
                            <li class="breadcrumb-item active text-white" aria-current="page"> {{__('Dashboard')}} </li>
                        </ol>
                    </nav>
                </div>
            </div>
            <!-- Card stats -->
            <div class="row">
                <div class="col-xl-3 col-lg-6">
                    <div class="card card-stats mb-4 mb-xl-0">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <h5 class="card-title text-uppercase text-muted mb-0">{{__('Users')}}</h5>
                                    <span class="h2 font-weight-bold mb-0">{{ $user_count }}</span>
                                </div>
                                <div class="col-auto">
                                    <div class="icon icon-shape bg-danger text-white rounded-circle shadow">
                                        <i class="fa fa-user"></i>
                                    </div>
                                </div>
                            </div>
                            <p class="mt-3 mb-0 text-muted text-sm">
                                <span class="text-nowrap">{{__('Since app launch')}}</span>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-6">
                    <div class="card card-stats mb-4 mb-xl-0">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <h5 class="card-title text-uppercase text-muted mb-0">{{__('Services')}}</h5>
                                    <span class="h2 font-weight-bold mb-0">{{ $services_count }}</span>
                                </div>
                                <div class="col-auto">
                                    <div class="icon icon-shape bg-green text-white rounded-circle shadow">
                                        <i class="fas fa-list"></i>
                                    </div>
                                </div>
                            </div>
                            <p class="mt-3 mb-0 text-muted text-sm">
                                <span class="text-nowrap">{{__('Since app launch')}}</span>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-6">
                    <div class="card card-stats mb-4 mb-xl-0">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <h5 class="card-title text-uppercase text-muted mb-0">{{__('Products')}}</h5>
                                    <span class="h2 font-weight-bold mb-0">{{ $products_count }}</span>
                                </div>
                                <div class="col-auto">
                                    <div class="icon icon-shape bg-warning text-white rounded-circle shadow">
                                        <i class="fa fa-tshirt"></i>
                                    </div>
                                </div>
                            </div>
                            <p class="mt-3 mb-0 text-muted text-sm">
                                <span class="text-nowrap">{{__('Since app launch')}}</span>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-6">
                    <div class="card card-stats mb-4 mb-xl-0">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <h5 class="card-title text-uppercase text-muted mb-0">{{__('Income')}}</h5>
                                    <span class="h2 font-weight-bold mb-0">{{ $currency_symbol }}{{ $income }}</span>
                                </div>
                                <div class="col-auto">
                                    <div class="icon icon-shape bg-info text-white rounded-circle shadow">
                                        <i class="ni ni-money-coins"></i>
                                    </div>
                                </div>
                            </div>
                            <p class="mt-3 mb-0 text-muted text-sm">
                                <span class="text-nowrap">{{__('Since app launch')}}</span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Revenue Charts -->
<div class="container-fluid mt--4">
    <div class="row">
        <div class="col-xl-12 mb-5 mb-xl-0">
            <div class="card shadow">
                <div class="card-header bg-transparent">
                    <div class="row align-items-center">
                        <div class="col">
                            <h6 class="text-uppercase text-muted ls-1 mb-1">{{__('Income')}}</h6>
                            <h2 class="text-default mb-0">{{__('Revenue')}}</h2>
                        </div>
                        <div class="col">
                            <ul class="nav nav-pills justify-content-end">
                                <li class="nav-item ml-2 mr-md-0" data-toggle="chart" data-target="#revenue_chart">
                                    <a href="#" class="nav-link py-2 px-3 active" data-toggle="tab" id="weekRevenue">
                                        <span class="d-none d-md-block">{{__('Week')}}</span>
                                        <span class="d-md-none">{{__('W')}}</span>
                                    </a>
                                </li>
                                                                                                                        
                                <li class="nav-item ml-2 mr-md-0" data-toggle="chart" data-target="#revenue_chart">
                                    <a href="#" class="nav-link py-2 px-3" data-toggle="tab" id="monthRevenue">
                                        <span class="d-none d-md-block">{{__('Month')}}</span>
                                        <span class="d-md-none">{{__('M')}}</span>
                                    </a>
                                </li>
                                
                                <li class="nav-item ml-2 mr-md-0" data-toggle="chart" data-target="#revenue_chart">
                                    <a href="#" class="nav-link py-2 px-3" data-toggle="tab" id="yearRevenue">
                                        <span class="d-none d-md-block">{{__('Year')}}</span>
                                        <span class="d-md-none">{{__('Y')}}</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <!-- Chart -->
                    <div class="chart">
                        <!-- Chart wrapper -->
                        <canvas id="revenue_chart" class="chart-canvas"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Users Charts  &  Users table -->
<div class="container-fluid mt-4 mb-4">
    <div class="row">
        <!-- User Chart -->
        <div class="col-xl-7">
            <div class="card shadow pb-1">
                <div class="card-header bg-transparent">
                    <div class="row align-items-center">
                        <div class="col">
                            <h6 class="text-uppercase text-muted ls-1 mb-1">{{__('Last 12 Months')}}</h6>
                            <h2 class="mb--1">{{__('Users')}}</h2>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="chart mt-6">
                        <canvas id="user_chart" class="chart-canvas"></canvas>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- User Table -->
        @can('user_access')
            <div class="col-xl-5">
                <div class="card shadow">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col">
                                <h6 class="text-uppercase text-muted ls-1 mb-1">{{__('New Registered')}}</h6>
                                <h3 class="mb-0">{{__('Users')}}</h3>
                            </div>
                            <div class="col text-right">
                                <a href="{{url('/admin/user')}}" class="btn btn-sm btn-primary">{{__('See all')}}</a>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table align-items-center table-flush">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col" class="sort">{{__('#')}}</th>
                                <th scope="col" class="sort">{{__('Image')}}</th>
                                <th scope="col" class="sort">{{__('Name')}}</th>
                                <th scope="col" class="sort">{{__('Registered Date')}}</th>
                            </tr>
                        </thead>
                        <tbody class="list">
                            @if (count($table_users) != 0)
                                <?php $num = 1; ?>
                                @foreach ($table_users as $user)
                                    @if ($num == 6)
                                        @break
                                    @endif
                                    <tr>
                                        <th>{{$num}}</th>
                                        <td>
                                            <div class="avatar rounded-circle">
                                                <img alt="Image placeholder" src="{{asset('/images/user/'.$user->image)}}">
                                            </div>
                                        </td>
                                        <td>{{$user->name}}</td>
                                        <td>{{Carbon\Carbon::parse($user->created_at)->format('Y-m-d')}}</td>
                                    </tr>
                                    <?php $num++; ?>
                                @endforeach
                            @else
                                <tr>
                                    <th colspan="3" class="text-center">{{__('No Users')}}</th>
                                </tr>
                            @endif
                        </tbody>
                        </table>
                    </div>
                </div>
            </div>
        @endcan
    </div>
</div>

@endsection