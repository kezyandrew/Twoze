@extends('layouts.app')
@section('content')

    @include('layouts.breadcrumb', [
            'title' => __('Users'),
            'class' => 'col-lg-7'
        ])

    
    <!-- Page content -->
    <div class="container-fluid mt--6">
        <div class="row">
            <div class="col">
                <div class="card">
                    <!-- Card header -->
                    <div class="card-header">
                        <h3 class="mb-0">{{__('Users Table')}}</h3>
                        @can('user_create')
                            <button class="btn btn-sm btn-primary float-right add_user mt--4" id="add_user"><i class="fa fa-plus mr-1"></i> {{__('New')}}</button>
                        @endcan
                    </div>
                    <!-- Light table -->
                    <div class="table-responsive">
                        <table class="table align-items-center table-flush" id="dataTableReport">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col" class="sort">{{__('#')}}</th>
                                    <th scope="col" class="sort">{{__('Image')}}</th>
                                    <th scope="col" class="sort">{{__('User')}}</th>
                                    <th scope="col" class="sort">{{__('Email')}}</th>
                                    <th scope="col" class="sort">{{__('Phone')}}</th>
                                    <th scope="col" class="sort">{{__('Role')}}</th>
                                    <th scope="col" class="sort">{{__('Status')}}</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody class="list">
                                @if (count($users) != 0)
                                    @foreach ($users as $user)
                                        <tr>
                                            <th> {{$loop->iteration}} </th>
                                            <td>
                                                <div class="avatar rounded-circle mr-3">
                                                    <img alt="Image placeholder" src="{{asset('/images/user/'.$user->image)}}">
                                                </div>
                                            </td>
                                            <td> {{$user->name}}</td>
                                            <td> {{$user->email}} </td>
                                            <td> {{$user->code}}{{$user->phone}} </td>
                                            <td>
                                                @foreach ($user->roles as $role)
                                                    <span class="badge badge-success">{{$role->title}}</span>
                                                @endforeach
                                            </td>
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
                                                @foreach ($user->roles as $role)
                                                    @if ($role->title != "Admin")
                                                        @can('user_access')
                                                            <a href="{{url('admin/user/'.$user->id)}}" class="table-action text-warning">
                                                                <i class="fas fa-eye"></i>
                                                            </a>
                                                        @endcan
                                                        @can('user_edit')
                                                            <button class="btn-white btn shadow-none p-0 m-0 table-action text-info bg-white" onclick="edit_user({{$user->id}})">
                                                                <i class="fa fa-edit"></i>
                                                            </button>
                                                        @endcan
                                                        @can('user_delete')
                                                            <button class="btn-white btn shadow-none p-0 m-0 table-action text-danger bg-white" onclick="all_delete('admin/user',{{$user->id}})">
                                                                <i class="fas fa-trash"></i>
                                                            </button>
                                                        @endcan
                                                    @endif
                                                @endforeach
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
    @include('admin.user.userCreate')
    @include('admin.user.userEdit')
@endsection