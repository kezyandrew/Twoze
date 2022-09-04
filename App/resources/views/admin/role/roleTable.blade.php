@extends('layouts.app')
@section('content')

    @include('layouts.breadcrumb', [
            'title' => __('Roles'),
            'class' => 'col-lg-7'
        ])
    
    <!-- Page content -->
    <div class="container-fluid mt--6">
        <div class="row">
            <div class="col">
                <div class="card">
                    <!-- Card header -->
                    <div class="card-header">
                        <div class="mb-0 h3">{{__('Roles Table')}}</div>
                        @can('role_create')
                            <button class="btn btn-sm btn-primary float-right add_role mt--4" id="add_role"><i class="fa fa-plus mr-1"></i> {{__('New')}}</button>
                        @endcan
                    </div>
                    <!-- Light table -->
                    <div class="table-responsive">
                        <table class="table align-items-center table-flush" id="dataTableReport">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col" class="sort table_num">{{__('#')}}</th>
                                    <th scope="col" class="sort table_title">{{__('Title')}}</th>
                                    <th scope="col" class="sort">{{__('Permission')}}</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody class="list">
                                @if (count($roles) != 0)
                                    @foreach ($roles as $role)
                                        <tr>
                                            <th> {{$loop->iteration}} </th>
                                            <td> {{$role->title}} </td>
                                            <td>
                                                @if(count($role->permissions) != 0)
                                                    @foreach ($role->permissions as $per)
                                                        <span class="badge badge-success">{{$per->title}}</span>
                                                    @endforeach
                                                @else
                                                    <span class="badge badge-danger">No data</span>
                                                @endif
                                            </td>
                                            <td class="table-actions">
                                                @can('role_edit')
                                                    <button class="btn-white btn shadow-none p-0 m-0 table-action text-info bg-white" onclick="edit_role({{$role->id}})">
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
    
@include('admin.role.roleCreate')
@include('admin.role.roleEdit')
@endsection