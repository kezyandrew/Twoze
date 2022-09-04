@extends('layouts.app')
@section('content')

@include('layouts.breadcrumb', [
    'title' => __('Profile') ,
    'class' => 'col-lg-7'
])

<div class="container-fluid mt--6">
    <div class="row">
        <div class="col-xl-4 order-xl-2 mb-5 mb-xl-0">
            <div class="card card-profile shadow">
                <div class="row justify-content-center">
                    <div class="col-lg-3 order-lg-2">
                        <div class="card-profile-image">
                            <a href="#">
                                <img src="{{asset('/images/user/'.$user->image)}}" class="rounded-circle salon_round">
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-header text-center border-0 pt-8 pt-md-4 pb-0 pb-md-4">
                    <div class="d-flex justify-content-between">
                    </div>
                </div>
                <div class="card-body pt-0 pt-md-4">
                    <div class="row">
                        <div class="col">
                            <div class="card-profile-stats d-flex justify-content-center mt-md-5">
                                <div>
                                    <span class="heading">{{$user_count}}</span>
                                    <span class="description">{{__('Users')}}</span>
                                </div>
                                <div>
                                    <span class="heading">{{$services}}</span>
                                    <span class="description">{{__('Services')}}</span>
                                </div>
                                <div>
                                    <span class="heading">{{$products}}</span>
                                    <span class="description">{{__('Products')}}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="text-center">
                        <h3>
                            {{ $user->name }}<span class="font-weight-light"></span>   
                        </h3>
                        <div>
                            {{__('Phone :')}} {{$user->code}}{{$user->phone}}<br>
                            {{__('Email :')}} {{$user->email}}
                        </div>
                        <hr class="my-4" />
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-8 order-xl-1">
            <div class="card shadow">
                <div class="card-header bg-white border-0">
                    <div class="row align-items-center">
                        <h3 class="ml-3">{{ __('Edit Profile') }}</h3>
                    </div>
                </div>
                <div class="card-body">
                    <form class="form-horizontal" action="{{url('/admin/profile/update/'.$user->id)}}" enctype="multipart/form-data" method="post">
                        @csrf
                        <h6 class="heading-small text-muted mb-4">{{__('Admin Information')}}</h6>

                        <div class="pl-lg-4">
                            <div class="form-group">
                                <label class="form-control-label" for="image">{{__('Change Profile Photo')}}</label><br>
                            </div>
                             
                            <div class="avatar-upload avatar-box">
                                <div class="avatar-edit">
                                    <input type='file' id="image" name="image" accept=".png, .jpg, .jpeg" />
                                    <label for="image"></label>
                                </div>
                                <div class="avatar-preview">
                                    <div id="imagePreview" style="background-image: url({{url('/images/user/'.$user->image)}});">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="form-control-label" for="name">{{__('Name')}}</label>
                                <input type="text"  value="{{old('name', $user->name)}}" class="form-control" name="name" id="name" placeholder="{{__('Name')}}">
                                @error('name')                                    
                                    <div class="invalid-div">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label class="form-control-label" for="email">{{__('Email')}}</label>
                                <input type="text"  value="{{old('email', $user->email)}}" class="form-control" name="email" id="email" placeholder="{{__('Email')}}" >
                                @error('email')                                    
                                    <div class="invalid-div">{{ $message }}</div>
                                @enderror
                            </div>

                            @php
                                $default_code = ltrim($user->code, '+');
                            @endphp
                            <div class="form-group">
                                <label class="form-control-label" for="country_code">{{__('Country Code')}}</label>
                                <select class="form-control select2" dir="{{ session()->has('direction')&& session('direction') == 'rtl'? 'rtl':''}}" name="country_code"  value="{{ old('country_code') }}"  data-placeholder='{{ __("-- Select Country Code --")}}'>
                                    @foreach ($country_code as $code)
                                        <option value={{$code->phonecode}} <?php if( $code->phonecode == $default_code){ echo "selected"; } ?>>{{$code->nicename}} ({{$code->iso3}}) - {{$code->phonecode}}</option>
                                    @endforeach
                                </select>
                                <div class="invalid-div "><span class="country_code"></span></div>
                            </div>
    
                            
                            <div class="form-group">
                                <label for="phone" class="form-control-label">{{__('Phone No')}}</label>
                                <input type="phone" class="form-control" value="{{old('phone', $user->phone)}}" name="phone" id="phone" placeholder="{{__('Phone number')}}">
                                @error('phone')                                    
                                    <div class="invalid-div">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="text-center">
                                <button type="submit" class="btn btn-primary mt-4">{{ __('Save') }}</button>
                            </div>
                        </div>
                    </form>
                    <hr class="my-4" />
                    <form class="form-horizontal" action="{{url('/admin/profile/changepassword/'.$user->id)}}" enctype="multipart/form-data" method="post">
                        @csrf
                        <input id="userName" type="hidden" name="username" autocomplete="username" value="">
                        <h6 class="heading-small text-muted mb-4">{{ __('Password') }}</h6>
                        <div class="pl-lg-4">
                            <div class="form-group">
                                <label class="form-control-label" for="current_password">{{__('Current Password')}}</label>
                                <input type="password" class="form-control" name="current_password" id="current_password" autocomplete="current-password" placeholder="{{__('Current Password')}}">
                                @error('current_password')                                    
                                    <div class="invalid-div">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label class="form-control-label" for="new_password">{{__('New Password')}}</label>
                                <input type="password" class="form-control" name="new_password" id="new_password" autocomplete="new-password" placeholder="{{__('New Password')}}">
                                @error('new_password')                                    
                                    <div class="invalid-div">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label class="form-control-label" for="confirm_password">{{__('Confirm New Password')}}</label>
                                <input type="password" class="form-control" name="confirm_password" id="confirm_password" autocomplete="new-password" placeholder="{{__('Confirm New Password')}}">
                                @error('confirm_password')                                    
                                    <div class="invalid-div">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="text-center">
                                <button type="submit" class="btn btn-primary mt-4">{{ __('Change password') }}</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
</div>
@endsection