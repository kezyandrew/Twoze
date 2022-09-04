@extends('layouts.app')
@section('content')

@include('layouts.breadcrumb', [
        'title' => __('Send Notification'),
        'class' => 'col-lg-7'
    ])



<div class="container-fluid mt--6 mb-5">
    <div class="row">
      <div class="col">
        <div class="card">
          <!-- Card header -->
          <div class="card-header border-0">
            <span class="h3">{{__('Message')}}</span>
            <form class="form-horizontal form" id="checkForm" action="{{url('/admin/notification/store')}}" method="post">
                @csrf

                <div class="form-group mt-4">
                  <label class="form-control-label" for="title">{{__('Title')}}</label>
                  <input type="text" name="title" id="title" class="form-control" placeholder="{{__('Notification Title')}}">
                  @error('title')                                    
                      <div class="invalid-div">{{ $message }}</div>
                  @enderror
                </div>

                <div class="form-group mt--3">
                    <label class="form-control-label" for="msg">{{__('Message')}}</label>
                    <textarea class="form-control " name="msg" id="msg" rows="7" placeholder="{{__('Notification Message')}}"></textarea>
                    @error('msg')                                    
                        <div class="invalid-div">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label class="form-control-label">{{__('Users')}}</label>
                    <select class="form-control select2" dir="{{ session()->has('direction')&& session('direction') == 'rtl'? 'rtl':''}}" multiple="multiple" name="user_id[]" id="select2" data-placeholder='{{ __("-- Select Users --")}}' placeholder='{{ __("-- Select Users --")}}'>
                        @foreach ($users as $user)
                            <option value={{$user->id}} {{ (collect(old('user_id'))->contains($user->id)) ? 'selected':'' }}>{{$user->name}}</option>
                        @endforeach
                    </select>
                    <div class="invalid-div"><span class="user_id"></span></div>
                </div>
                
                <div class="border-top">
                  <div class="card-body text-center">
                      <input type="submit" class="btn btn-primary" id="create_btn" value="{{__('Send Notification')}}">
                  </div>
              </div>
            <form>
        </div>
      </div>
    </div>
</div>
@endsection