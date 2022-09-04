@extends('layouts.app')
@section('content')

    @include('layouts.breadcrumb', [
            'title' => __('Calendar'),
            'class' => 'col-lg-7'
        ])
 
    <!-- Page content -->

    <div class="container-fluid mt--6">
        <div class="row">
            <div class="col">
                <div class="card px-4 pb-4">
                    <!-- Card header -->
                    <div class="card-header">
                        <h3 class="mb-0">{{__('Order Calendar')}}</h3>
                    </div>
                    <div class="row statusRow text-center ml-1 my-2">
                        <div class="col completedBox p-1 mr-3 rounded"><span>{{__('Completed')}}</span></div>
                        <div class="col pendingBox p-1 mr-3 rounded"><span>{{__('Pending')}}</span></div>
                        <div class="col cancelBox p-1 mr-3 rounded"><span>{{__('Cancel')}}</span></div>
                    </div>
                    <div class="mt-3">
                        {!! $calendar->calendar() !!}
                        {!! $calendar->script() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection