@extends('layouts.app')
@section('content')

    @include('layouts.breadcrumb', [
            'title' => __('Revenue Report'),
            'class' => 'col-lg-7'
        ])

    
    <!-- Page content -->
    <div class="container-fluid mt--6">
        <div class="row">
            <div class="col">
                <div class="card">
                    <!-- Card header -->
                    <div class="card-header">
                        <h3 class="mb-0">{{__('Revenue Report')}}</h3>
                    </div>
                    
                    <form action="{{url('/admin/report/revenueReport/filter')}}" method="post" class="ml-4" id="filter_revenu_form">
                        @csrf
                        <div class="row rtl-date-filter-row">
                            <div class="form-group col-3">
                                <input type="text" id="filter_report_date" value="{{$pass}}" name="filter_date" class="form-control" placeholder="{{__('-- Select Date --')}}">
                                @if($errors->any())
                                    <h4 class="text-center text-red mt-2">{{$errors->first()}}</h4>
                                @endif
                            </div>
                            <div class="form-group col-3">
                                <button type="submit" id="filter_btn" class="btn btn-primary rtl-date-filter-btn">{{ __('Apply') }}</button>
                            </div>
                        </div>
                    </form>
                    <!-- Light table -->
                    <div class="table-responsive">
                        <div class="btn-group export-btns">
                            <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="fas fa-download"></i> Export </button>
                            <div class="dropdown-menu"> 
                                <a class="dropdown-item"  id="export_print">
                                    <span class="navi-icon">
                                        <i class="fa fa-print"></i>
                                    </span>
                                    <span class="navi-text ml-2">{{__('Print')}}</span>
                                </a>
                                
                                <a class="dropdown-item"  id="export_copy">
                                    <span class="navi-icon">
                                        <i class="fa fa-copy"></i>
                                    </span>
                                    <span class="navi-text ml-2">{{__('Copy')}}</span>
                                </a>
                                
                                <a class="dropdown-item"  id="export_excel">
                                    <span class="navi-icon">
                                        <i class="fa fa-file-excel"></i>
                                    </span>
                                    <span class="navi-text ml-2">{{__('Excel')}}</span>
                                </a>
                                
                                <a class="dropdown-item"  id="export_csv">
                                    <span class="navi-icon">
                                        <i class="fas fa-file-csv"></i>
                                    </span>
                                    <span class="navi-text ml-2">{{__('CSV')}}</span>
                                </a>
                                
                                <a class="dropdown-item"  id="export_pdf">
                                    <span class="navi-icon">
                                        <i class="fa fa-file-pdf"></i>
                                    </span>
                                    <span class="navi-text ml-2">{{__('PDF')}}</span>
                                </a>
                            </div>
                        </div>
                       
                        <table class="table align-items-center table-flush" id="dataTableRevenueReport">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col" class="sort">{{__('#')}}</th>
                                    <th scope="col" class="sort">{{__('Order ID')}}</th>
                                    <th scope="col" class="sort">{{__('User Name')}}</th>
                                    <th scope="col" class="sort">{{__('Discount')}}</th>
                                    <th scope="col" class="sort">{{__('Income')}}</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody class="list">
                                @foreach ($orders as $order)
                                    <tr>
                                        <th> {{$loop->iteration}} </th>
                                        <td> {{$order->order_id}} </td>
                                        <td> {{$order->user->name}} </td>
                                        <td> {{$currency_symbol}}{{$order->discount}} </td>
                                        <td> {{$currency_symbol}}{{$order->payment}} </td>
                                        <td class="table-actions">
                                            <a href="{{url('/admin/order/invoice/'.$order->id)}}" class="text-blue cursor table-action">
                                                <i class="fas fa-file-invoice"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection