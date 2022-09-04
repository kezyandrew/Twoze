@extends('layouts.app')
@section('content')

    @include('layouts.breadcrumb', [
            'title' => __('Services'),
            'class' => 'col-lg-7'
        ])

    
    <!-- Page content -->
    <div class="container-fluid mt--6">
        <div class="row">
            <div class="col">
                <div class="card">
                    <!-- Card header -->
                    <div class="card-header">
                        <h3 class="mb-0">{{__('Services Table')}}</h3>
                        @can('service_create')
                            <button class="btn btn-sm btn-primary float-right add_service mt--4" id="add_service"><i class="fa fa-plus mr-1"></i> {{__('New')}}</button>
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
                                @if (count($services) != 0)
                                    @foreach ($services as $service)
                                        <tr>
                                            <th> {{$loop->iteration}} </th>
                                            <td>
                                                <div class="avatar imageBox imageBoxService mr-3">
                                                    <img alt="Image placeholder imageBoxImg" src="{{asset('/images/service/'.$service->image)}}">
                                                </div>
                                            </td>
                                            <td> {{$service->name}} </td>
                                            <td> {{$currency_symbol}}{{$service->price}} / {{$cloth_unit}} </td>
                                            <td>
                                                @if ($service->status == 1)
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
                                                @can('service_access')
                                                    <button class="btn-white btn shadow-none p-0 m-0 table-action text-warning bg-white" onclick="show_service({{$service->id}})">
                                                        <i class="fas fa-eye"></i>
                                                    </button>
                                                @endcan
                                                @can('service_edit')
                                                    <button class="btn-white btn shadow-none p-0 m-0 table-action text-info bg-white" onclick="edit_service({{$service->id}})">
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
    @include('admin.service.serviceCreate')
    @include('admin.service.serviceShow')
    @include('admin.service.serviceEdit')
@endsection