@extends('layouts.app')
@section('content')

    @include('layouts.breadcrumb', [
            'title' => __('Languages'),
            'class' => 'col-lg-7'
        ])

    
    <!-- Page content -->
    <div class="container-fluid mt--6">
        <div class="row">
            <div class="col">
                <div class="card">
                    <!-- Card header -->
                    <div class="card-header">
                        <h3 class="mb-0">{{__('Languages Table')}}</h3>
                        @can('language_create')
                            <button class="btn btn-sm btn-primary float-right add_language mt--4" id="add_language"><i class="fa fa-plus mr-1"></i> {{__('New')}}</button>
                        @endcan
                    </div>
                    <!-- Light table -->
                    <div class="table-responsive">
                        <table class="table align-items-center table-flush"  id="dataTableReport">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col" class="sort">{{__('#')}}</th>
                                    <th scope="col" class="sort">{{__('Image')}}</th>
                                    <th scope="col" class="sort">{{__('Name')}}</th>
                                    <th scope="col" class="sort">{{__('Direction')}}</th>
                                    <th scope="col" class="sort">{{__('Status')}}</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody class="list">
                                @if (count($languages) != 0)
                                    @foreach ($languages as $language)
                                        <tr>
                                            <th> {{$loop->iteration}} </th>
                                            <td>
                                                <img alt="Image placeholder" class="lang_table_flag" src="{{asset('/images/language/'.$language->image)}}">
                                            </td>
                                            <td> {{$language->name}} </td>
                                            <td>
                                                @if ($language->direction == "ltr")
                                                    LTR
                                                @else
                                                    RTL
                                                @endif
                                            </td>
                                            <td>
                                                @if ($language->status == 1)
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
                                                @can('language_edit')
                                                    <button class="btn-white btn shadow-none p-0 m-0 table-action text-info bg-white" onclick="edit_language({{$language->id}})">
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
    @include('admin.language.languageCreate')
    @include('admin.language.languageEdit')
@endsection