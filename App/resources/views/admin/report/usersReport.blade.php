@extends('layouts.app')
@section('content')

    @include('layouts.breadcrumb', [
            'title' => __('Users Report'),
            'class' => 'col-lg-7'
        ])

    
    <!-- Page content -->
    <div class="container-fluid mt--6">
        <div class="row">
            <div class="col">
                <div class="card">
                    <!-- Card header -->
                    <div class="card-header">
                        <h3 class="mb-0">{{__('Users Report')}}</h3>
                    </div>
                    
                    <form action="{{url('/admin/report/usersReport/filter')}}" method="post" class="ml-4" id="filter_revenu_form">
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
                       
                        <table class="table align-items-center table-flush" id="dataTableUsersReport">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col" class="sort">{{__('#')}}</th>
                                    <th scope="col" class="sort">{{__('Image')}}</th>
                                    <th scope="col" class="sort">{{__('User')}}</th>
                                    <th scope="col" class="sort">{{__('Email')}}</th>
                                    <th scope="col" class="sort">{{__('Phone')}}</th>
                                    <th scope="col" class="sort">{{__('Orders')}}</th>
                                    <th scope="col" class="sort">{{__('Payment')}}</th>
                                    <th scope="col" class="sort">{{__('Registerd Date')}}</th>
                                    <th scope="col" class="sort">{{__('Status')}}</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody class="list">
                                @foreach ($users as $user)
                                    <tr>
                                        <th> {{$loop->iteration}} </th>
                                        <td>
                                            <div class="avatar rounded-circle mr-3">
                                                <img alt="Image placeholder" src="{{asset('/images/user/'.$user->image)}}">
                                            </div>
                                        </td>
                                        <td> {{$user->name}} </td>
                                        <td> {{$user->email}} </td>
                                        <td> {{$user->code}}{{$user->phone}} </td>
                                        <td> {{$user->tot_order}} </td>
                                        <td> {{$currency_symbol}}{{$user->tot_payment}} </td>
                                        <td> {{\Carbon\Carbon::parse($user->created_at)->format('Y-m-d')}} </td>
                                        <td>
                                            @if ($user->status == 1)
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
                                            @can('user_access')
                                                <a href="{{url('admin/user/'.$user->id)}}" class="table-action text-warning">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                            @endcan
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