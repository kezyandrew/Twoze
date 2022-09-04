@extends('layouts.app')
@section('content')

    @include('layouts.breadcrumb', [
            'title' => __('Offers'),
            'class' => 'col-lg-7'
        ])

    
    <!-- Page content -->
    <div class="container-fluid mt--6">
        <div class="row">
            <div class="col">
                <div class="card">
                    <!-- Card header -->
                    <div class="card-header">
                        <h3 class="mb-0">{{__('Offers Table')}}</h3>
                        @can('offer_create')
                            <button class="btn btn-sm btn-primary float-right add_offer mt--4" id="add_offer"><i class="fa fa-plus mr-1"></i> {{__('New')}}</button>
                        @endcan
                    </div>
                    <!-- Light table -->
                    <div class="table-responsive">
                        <table class="table align-items-center table-flush" id="dataTableReport">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col" class="sort">{{__('#')}}</th>
                                    <th scope="col" class="sort">{{__('Image')}}</th>
                                    <th scope="col" class="sort">{{__('Title 1')}}</th>
                                    <th scope="col" class="sort">{{__('Title 2')}}</th>
                                    <th scope="col" class="sort">{{__('Discount')}}</th>
                                    <th scope="col" class="sort">{{__('Status')}}</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody class="list">
                                @if (count($offers) != 0)
                                    @foreach ($offers as $offer)
                                        <tr>
                                            <th> {{$loop->iteration}} </th>
                                            <td>
                                                <div class="avatar imageBox mr-3">
                                                    <img alt="Image placeholder imageBoxImg" src="{{asset('/images/offer/'.$offer->image)}}">
                                                </div>
                                            </td>
                                            <td> {{$offer->title1}} </td>
                                            <td> {{$offer->title2}} </td>
                                            <td>
                                                @if ($offer->type == "Amount")
                                                    {{$currency_symbol}}{{$offer->discount}}
                                                @else
                                                    {{$offer->discount}}{{__('%')}}
                                                @endif
                                            </td>
                                            <td>
                                                @if ($offer->status == 1)
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
                                                @can('offer_access')
                                                    <button class="btn-white btn shadow-none p-0 m-0 table-action text-warning bg-white" onclick="show_offer({{$offer->id}})">
                                                        <i class="fas fa-eye"></i>
                                                    </button>
                                                @endcan
                                                @can('offer_edit')
                                                    <button class="btn-white btn shadow-none p-0 m-0 table-action text-info bg-white" onclick="edit_offer({{$offer->id}})">
                                                        <i class="fa fa-edit"></i>
                                                    </button>
                                                @endcan
                                                @can('offer_delete')
                                                    <button class="btn-white btn shadow-none p-0 m-0 table-action text-danger bg-white" onclick="all_delete('admin/offer',{{$offer->id}})">
                                                        <i class="fas fa-trash"></i>
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
    @include('admin.offer.offerCreate')
    @include('admin.offer.offerShow')
    @include('admin.offer.offerEdit')
@endsection