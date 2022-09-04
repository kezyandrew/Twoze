@extends('layouts.app')
@section('content_setting')

    @include('layouts.breadcrumb', [
            'title' => __('Settings'),
            'class' => 'col-lg-7'
        ])

    
    <!-- Page content -->
    <div class="container-fluid mt--6">
        <div class="row">
            <div class="col">
                <div class="card">
                    <!-- Card header -->
                    <div class="card-header">
                        <h3 class="mb-0">{{__('Settings')}}</h3>
                    </div>
                    
                    <div class="row mt-3">
                        <div class="col-3 pl-5">
                            <div class="nav-wrapper settings">
                                <ul class="nav navbar-nav nav-pills setting nav-fill" id="tabs-icons-text" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link text-left {{ $setting->license_status == 0 ? 'pointer-none': '' }} {{ $setting->license_status == 1 ? 'active': '' }}" id="tabs-icons-text-1-tab" data-toggle="tab" href="#tab-1" role="tab" aria-controls="tabs-icons-text-1" aria-selected="true"><i class="fa fa-user mr-2"></i> {{__('OTP Verification')}} </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link text-left {{ $setting->license_status == 0 ? 'pointer-none': '' }}" id="tabs-icons-text-2-tab" data-toggle="tab" href="#tab-2" role="tab" aria-controls="tabs-icons-text-2" aria-selected="false"><i class="fas fa-money-bill-alt mr-2"></i> {{__('Currency')}} </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link text-left {{ $setting->license_status == 0 ? 'pointer-none': '' }}" id="tabs-icons-text-13-tab" data-toggle="tab" href="#tab-13" role="tab" aria-controls="tabs-icons-text-13" aria-selected="false"><i class="fas fa-map-pin mr-2"></i> {{__('Map')}} </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link text-left {{ $setting->license_status == 0 ? 'pointer-none': '' }}" id="tabs-icons-text-12-tab" data-toggle="tab" href="#tab-12" role="tab" aria-controls="tabs-icons-text-12" aria-selected="false"><i class="fa fa-map-marker-alt mr-2"></i> {{__('Address')}} </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link text-left {{ $setting->license_status == 0 ? 'pointer-none': '' }}" id="tabs-icons-text-3-tab" data-toggle="tab" href="#tab-3" role="tab" aria-controls="tabs-icons-text-3" aria-selected="false"><i class="fa fa-bell mr-2"></i> {{__('Push Notification')}} </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link text-left {{ $setting->license_status == 0 ? 'pointer-none': '' }}" id="tabs-icons-text-4-tab" data-toggle="tab" href="#tab-4" role="tab" aria-controls="tabs-icons-text-4" aria-selected="false"><i class="far fa-envelope mr-2"></i> {{__('Email Settings')}} </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link text-left {{ $setting->license_status == 0 ? 'pointer-none': '' }}" id="tabs-icons-text-5-tab" data-toggle="tab" href="#tab-5" role="tab" aria-controls="tabs-icons-text-5" aria-selected="false"><i class="fas fa-sms mr-2"></i> {{__('SMS Gateway')}} </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link text-left {{ $setting->license_status == 0 ? 'pointer-none': '' }}" id="tabs-icons-text-6-tab" data-toggle="tab" href="#tab-6" role="tab" aria-controls="tabs-icons-text-6" aria-selected="false"><i class="far fa-credit-card mr-2"></i> {{__('Payment Gateway')}} </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link text-left {{ $setting->license_status == 0 ? 'pointer-none': '' }}" id="tabs-icons-text-7-tab" data-toggle="tab" href="#tab-7" role="tab" aria-controls="tabs-icons-text-7" aria-selected="false"><i class="fa fa-gavel mr-2"></i> {{__('Terms Of Use')}} </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link text-left {{ $setting->license_status == 0 ? 'pointer-none': '' }}" id="tabs-icons-text-8-tab" data-toggle="tab" href="#tab-8" role="tab" aria-controls="tabs-icons-text-8" aria-selected="false"><i class="fa fa-lock mr-2"></i> {{__('Privacy Policy')}} </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link text-left {{ $setting->license_status == 0 ? 'pointer-none': '' }}" id="tabs-icons-text-9-tab" data-toggle="tab" href="#tab-9" role="tab" aria-controls="tabs-icons-text-9" aria-selected="false"><i class="fa fa-cube mr-2"></i> {{__('App Settings')}} </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link text-left {{ $setting->license_status == 0 ? 'pointer-none': '' }}" id="tabs-icons-text-10-tab" data-toggle="tab" href="#tab-10" role="tab" aria-controls="tabs-icons-text-10" aria-selected="false"><i class="fa fa-image mr-2"></i> {{__('Admin Settings')}} </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link text-left {{ $setting->license_status == 0 ? 'active': '' }}" id="tabs-icons-text-11-tab" data-toggle="tab" href="#tab-11" role="tab" aria-controls="tabs-icons-text-11" aria-selected="false"><i class="fa fa-id-card mr-2"></i> {{__('License')}} </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-9 mt-3 pr-6">
                            @if($errors->any())
                                <div class="alert alert-danger" role="alert">
                                    <strong>{{__('Error!')}}</strong> {{$errors->first()}}
                                </div>
                            @endif
                            @if(session('status'))
                                <div class="alert alert-danger" role="alert">
                                    <strong>{{__('Error!')}}</strong> {{ session('status') }}
                                </div>
                            @endif
                            <div class="card shadow settings-main-body">
                                <div class="card-body">
                                    <div class="tab-content" id="myTabContent">
                                        <!-- OTP Verification --->
                                        <div class="tab-pane fade {{ $setting->license_status == 1 ? 'active show': '' }}" id="tab-1" role="tabpanel" aria-labelledby="tabs-icons-text-1-tab">
                                            <form action="{{url('/admin/setting/otp')}}" method="post">
                                                @csrf
                                                <h3 class="card-title">{{__('OTP Verification')}}</h3>
                                                
                                                <div class="form-group row">
                                                    <label class="col-sm-3 text-right control-label col-form-label" for="verify_user">{{__('Verification')}} </label>
                                                    <div class="col-sm-9 mt-2">
                                                        <label class="custom-toggle">
                                                            <input type="checkbox" id="verify_user" name="verify_user" {{ $setting->verify_user == 1?'checked':'' }}>
                                                            <span class="custom-toggle-slider rounded-circle" data-label-off="No" data-label-on="Yes"></span>
                                                        </label>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="col-sm-3 text-right control-label col-form-label" for="verify_user_sms">{{__('SMS')}} </label>
                                                    <div class="col-sm-9 mt-2">
                                                        <label class="custom-toggle">
                                                            <input type="checkbox" id="verify_user_sms" name="verify_user_sms" {{ $setting->verify_user_sms == 1?'checked':'' }}>
                                                            <span class="custom-toggle-slider rounded-circle" data-label-off="No" data-label-on="Yes"></span>
                                                        </label>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="col-sm-3 text-right control-label col-form-label" for="verify_user_mail">{{__('Email')}} </label>
                                                    <div class="col-sm-9 mt-2">
                                                        <label class="custom-toggle">
                                                            <input type="checkbox" id="verify_user_mail" name="verify_user_mail" {{ $setting->verify_user_mail == 1?'checked':'' }}>
                                                            <span class="custom-toggle-slider rounded-circle" data-label-off="No" data-label-on="Yes"></span>
                                                        </label>
                                                    </div>
                                                </div>
                                                
                                                @can('setting_edit')
                                                    <div class="border-top">
                                                        <div class="card-body text-center">
                                                            <input type="submit" class="btn btn-primary rtl-float-none" value="{{__('Submit')}}">
                                                        </div>
                                                    </div>
                                                @endcan
                                            </form>
                                        </div>

                                        <!-- currency --->
                                        <div class="tab-pane fade" id="tab-2" role="tabpanel" aria-labelledby="tabs-icons-text-2-tab">
                                            <form action="{{url('/admin/setting/currency')}}" method="post">
                                                @csrf
                                                <h3 class="card-title">{{__('Currency')}}</h3>
                                                
                                                <div class="form-group row">
                                                    <label class="col-sm-3 text-right control-label col-form-label">{{__('Select Currency')}}</label>
                                                    <div class="col-sm-9 w-75">
                                                        <select class="form-control select2" dir="{{ session()->has('direction')&& session('direction') == 'rtl'? 'rtl':''}}" name="currency" id="currency" >
                                                            @foreach ($currency as $cur)
                                                                <option value="{{$cur->code}}" {{ (collect(old('currency'))->contains($cur->code)) ? 'selected':'' }} <?php if( $cur->code == $setting->currency_code){ echo "selected"; } ?>>{{$cur->currency}} ({{$cur->symbol}} - {{$cur->code}})</option>
                                                            @endforeach
                                                        </select>
                                                        @if ($setting->currency_code != "INR")
                                                            <div class="mt-3">
                                                                {{__("Rozarpay doesn't support")}} {{ $setting->currency_code }}
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                                
                                                @can('setting_edit')
                                                    <div class="border-top">
                                                        <div class="card-body text-center">
                                                            <input type="submit" class="btn btn-primary rtl-float-none" value="{{__('Submit')}}">
                                                        </div>
                                                    </div>
                                                @endcan
                                            </form>
                                        </div>
                                        
                                        <!-- Map --->
                                        <div class="tab-pane fade" id="tab-13" role="tabpanel" aria-labelledby="tabs-icons-text-13-tab">
                                            <form action="{{url('/admin/setting/map')}}" method="post">
                                                @csrf
                                                <h3 class="card-title">{{__('Map')}}</h3>
                                                
                                                <div class="form-group row">
                                                    <label class="col-sm-3 text-right control-label col-form-label" for="mapkey">{{__('Map Key')}}</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" class="form-control" value="{{old('mapkey', $setting->mapkey)}}" name="mapkey" id="mapkey" placeholder="{{__('Map Key')}}">
                                                        @error('mapkey')                                    
                                                            <div class="invalid-div">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div> 
                                                @can('setting_edit')
                                                    <div class="border-top">
                                                        <div class="card-body text-center">
                                                            <input type="submit" class="btn btn-primary rtl-float-none" value="{{__('Submit')}}">
                                                        </div>
                                                    </div>
                                                @endcan
                                            </form>
                                        </div>
                                        
                                        <!-- Address --->
                                        <div class="tab-pane fade form" id="tab-12" role="tabpanel" aria-labelledby="tabs-icons-text-12-tab">
                                            <form action="{{url('/admin/setting/address')}}" method="post">
                                                @csrf
                                                <h3 class="card-title">{{__('Address')}}</h3>
                                                
                                                <div class="form-group row">
                                                    <label class="col-sm-3 text-right control-label col-form-label" for="address1">{{__('Address 1')}}</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" class="form-control" value="{{old('address1', $setting->addr1)}}" name="address1" id="address1" placeholder="{{__('Address 1')}}">
                                                        @error('address1')                                    
                                                            <div class="invalid-div">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div> 
                                                 
                                                <div class="form-group row">
                                                    <label class="col-sm-3 text-right control-label col-form-label" for="address2">{{__('Address 2')}}</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" class="form-control" value="{{old('address2', $setting->addr2)}}" name="address2" id="address2" placeholder="{{__('Address 2')}}">
                                                        @error('address2')                                    
                                                            <div class="invalid-div">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div> 
                                                 
                                                <div class="form-group row">
                                                    <label class="col-sm-3 text-right control-label col-form-label" for="city">{{__('City')}}</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" class="form-control" value="{{old('city', $setting->city)}}" name="city" id="city" placeholder="{{__('City')}}">
                                                        @error('city')                                    
                                                            <div class="invalid-div">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div> 
                                                 
                                                <div class="form-group row">
                                                    <label class="col-sm-3 text-right control-label col-form-label" for="state">{{__('State')}}</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" class="form-control" value="{{old('state', $setting->state)}}" name="state" id="state" placeholder="{{__('State')}}">
                                                        @error('state')                                    
                                                            <div class="invalid-div">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div> 
                                                 
                                                <div class="form-group row">
                                                    <label class="col-sm-3 text-right control-label col-form-label" for="country">{{__('Country')}}</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" class="form-control" value="{{old('country', $setting->country)}}" name="country" id="country" placeholder="{{__('Country')}}">
                                                        @error('country')                                    
                                                            <div class="invalid-div">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div> 
                                                 
                                                <div class="form-group row">
                                                    <label class="col-sm-3 text-right control-label col-form-label" for="zipcode">{{__('Zipcode')}}</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" class="form-control" value="{{old('zipcode', $setting->zipcode)}}" name="zipcode" id="zipcode" placeholder="{{__('Zipcode')}}">
                                                        @error('zipcode')                                    
                                                            <div class="invalid-div">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                
                                                <div class="form-group row">
                                                    <div class="col-sm-3"></div>
                                                    <div class="col-sm-9 mapsize" id="location_map"></div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="col-sm-3 text-right control-label col-form-label" for="latitude">{{__('Latitude')}}</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" class="form-control" value="{{old('latitude', $setting->lat)}}" name="latitude" id="latitude" placeholder="{{__('Latitude')}}">
                                                        @error('latitude')                                    
                                                            <div class="invalid-div">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>    
                                                <div class="form-group row">
                                                    <label class="col-sm-3 text-right control-label col-form-label" for="longitude">{{__('Longitude')}}</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" class="form-control" value="{{old('longitude', $setting->long)}}" name="longitude" id="longitude" placeholder="{{__('Longitude')}}">
                                                        @error('longitude')                                    
                                                            <div class="invalid-div">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div> 

                                                @can('setting_edit')
                                                    <div class="border-top">
                                                        <div class="card-body text-center">
                                                            <input type="submit" class="btn btn-primary rtl-float-none" value="{{__('Submit')}}">
                                                        </div>
                                                    </div>
                                                @endcan
                                            </form>
                                        </div>

                                        <!-- Push notification --->
                                        <div class="tab-pane fade" id="tab-3" role="tabpanel" aria-labelledby="tabs-icons-text-3-tab">
                                                <form action="{{url('/admin/setting/push_notification')}}" method="post">
                                                @csrf
                                                <h3 class="card-title">{{__('Push Notification')}}</h3>
                                                
                                                <div class="form-group row">
                                                    <label class="col-sm-3 text-right control-label col-form-label" for="enable_notification">{{__('Notification')}} </label>
                                                    <div class="col-sm-9 mt-2">
                                                        <label class="custom-toggle">
                                                            <input type="checkbox" id="enable_notification" name="enable_notification" {{ $setting->enable_notification == 1?'checked':'' }}>
                                                            <span class="custom-toggle-slider rounded-circle" data-label-off="No" data-label-on="Yes"></span>
                                                        </label>
                                                    </div>
                                                </div>  
                                                
                                                <div class="form-group row">
                                                    <label class="col-sm-3 text-right control-label col-form-label" for="app_id">{{__('App ID')}}</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" class="form-control" value="{{old('app_id', $setting->app_id)}}" name="app_id" id="app_id" placeholder="{{__('App ID')}}">
                                                        @error('app_id')                                    
                                                            <div class="invalid-div">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div> 

                                                <div class="form-group row">
                                                    <label class="col-sm-3 text-right control-label col-form-label" for="api_key">{{__('Api key')}}</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" class="form-control" value="{{old('api_key', $setting->api_key)}}" name="api_key" id="api_key" placeholder="{{__('Api key')}}">
                                                        @error('api_key')                                    
                                                            <div class="invalid-div">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div> 

                                                <div class="form-group row">
                                                    <label class="col-sm-3 text-right control-label col-form-label" for="auth_key">{{__('Auth key')}}</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" class="form-control" value="{{old('auth_key', $setting->auth_key)}}" name="auth_key" id="auth_key" placeholder="{{__('Auth key')}}">
                                                        @error('auth_key')                                    
                                                            <div class="invalid-div">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div> 

                                                <div class="form-group row">
                                                    <label class="col-sm-3 text-right control-label col-form-label" for="project_no">{{__('Project number')}}</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" class="form-control" value="{{old('project_no', $setting->project_no)}}" name="project_no" id="project_no" placeholder="{{__('Project number')}}">
                                                        @error('project_no')                                    
                                                            <div class="invalid-div">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                
                                                @can('setting_edit')
                                                    <div class="border-top">
                                                        <div class="card-body text-center">
                                                            <input type="submit" class="btn btn-primary rtl-float-none" value="{{__('Submit')}}">
                                                        </div>
                                                    </div>
                                                @endcan
                                            </form>
                                        </div>
                                        
                                        <!-- Email Settings --->
                                        <div class="tab-pane fade" id="tab-4" role="tabpanel" aria-labelledby="tabs-icons-text-4-tab">
                                            <form action="{{url('/admin/setting/email_settings')}}" method="post">
                                                @csrf
                                                <h3 class="card-title">{{__('Email Settings')}}</h3>
                                                
                                                <div class="form-group row">
                                                    <label class="col-sm-3 text-right control-label col-form-label" for="enable_mail">{{__('Mail')}} </label>
                                                    <div class="col-sm-9 mt-2">
                                                        <label class="custom-toggle">
                                                            <input type="checkbox" id="enable_mail" name="enable_mail" {{ $setting->enable_mail == 1?'checked':'' }}>
                                                            <span class="custom-toggle-slider rounded-circle" data-label-off="No" data-label-on="Yes"></span>
                                                        </label>
                                                    </div>
                                                </div>  
                                                
                                                <div class="form-group row">
                                                    <label class="col-sm-3 text-right control-label col-form-label" for="mail_host">{{__('Mail Host')}}</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" class="form-control" value="{{old('mail_host', $setting->mail_host)}}" name="mail_host" id="mail_host" placeholder="{{__('Mail Host')}}">
                                                        @error('mail_host')                                    
                                                            <div class="invalid-div">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div> 

                                                <div class="form-group row">
                                                    <label class="col-sm-3 text-right control-label col-form-label" for="mail_port">{{__('Mail Port')}}</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" class="form-control" value="{{old('mail_port', $setting->mail_port)}}" name="mail_port" id="mail_port" placeholder="{{__('Mail Port')}}">
                                                        @error('mail_port')                                    
                                                            <div class="invalid-div">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div> 

                                                <div class="form-group row">
                                                    <label class="col-sm-3 text-right control-label col-form-label" for="mail_username">{{__('Mail Username')}}</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" class="form-control" value="{{old('mail_username', $setting->mail_username)}}" name="mail_username" id="mail_username" placeholder="{{__('Mail Username')}}">
                                                        @error('mail_username')                                    
                                                            <div class="invalid-div">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div> 

                                                <div class="form-group row">
                                                    <label class="col-sm-3 text-right control-label col-form-label" for="mail_password">{{__('Mail Password')}}</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" class="form-control" value="{{old('mail_password', $setting->mail_password)}}" name="mail_password" id="mail_password" placeholder="{{__('Mail Password')}}">
                                                        @error('mail_password')                                    
                                                            <div class="invalid-div">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="col-sm-3 text-right control-label col-form-label" for="sender_email">{{__('Sender Email')}}</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" class="form-control" value="{{old('sender_email', $setting->sender_email)}}" name="sender_email" id="sender_email" placeholder="{{__('Sender Email')}}">
                                                        @error('sender_email')                                    
                                                            <div class="invalid-div">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>  
                                                
                                                @can('setting_edit')
                                                    <div class="border-top">
                                                        <div class="card-body text-center">
                                                            <input type="submit" class="btn btn-primary rtl-float-none" value="{{__('Submit')}}">
                                                        </div>
                                                    </div>
                                                @endcan
                                            </form>
                                        </div>

                                        <!-- SMS Gateway --->
                                        <div class="tab-pane fade" id="tab-5" role="tabpanel" aria-labelledby="tabs-icons-text-5-tab">
                                            <form action="{{url('/admin/setting/sms_gateway')}}" method="post">
                                                @csrf
                                                <h3 class="card-title">{{__('SMS Gateway')}}</h3>
                                                
                                                <div class="form-group row">
                                                    <label class="col-sm-3 text-right control-label col-form-label" for="enable_sms">{{__('SMS')}} </label>
                                                    <div class="col-sm-9 mt-2">
                                                        <label class="custom-toggle">
                                                            <input type="checkbox" id="enable_sms" name="enable_sms" {{ $setting->enable_sms == 1?'checked':'' }}>
                                                            <span class="custom-toggle-slider rounded-circle" data-label-off="No" data-label-on="Yes"></span>
                                                        </label>
                                                    </div>
                                                </div>  
                                                
                                                <div class="form-group row">
                                                    <label class="col-sm-3 text-right control-label col-form-label" for="twilio_acc_id">{{__('Twilio Account ID')}}</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" class="form-control" value="{{old('twilio_acc_id', $setting->twilio_acc_id)}}" name="twilio_acc_id" id="twilio_acc_id" placeholder="{{__('Twilio Account ID')}}">
                                                        @error('twilio_acc_id')                                    
                                                            <div class="invalid-div">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div> 

                                                <div class="form-group row">
                                                    <label class="col-sm-3 text-right control-label col-form-label" for="twilio_auth_token">{{__('Twilio Auth Token')}}</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" class="form-control" value="{{old('twilio_auth_token', $setting->twilio_auth_token)}}" name="twilio_auth_token" id="twilio_auth_token" placeholder="{{__('Twilio Auth Token')}}">
                                                        @error('twilio_auth_token')                                    
                                                            <div class="invalid-div">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div> 

                                                <div class="form-group row">
                                                    <label class="col-sm-3 text-right control-label col-form-label" for="twilio_phone_no">{{__('Twilio Phone Number')}}</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" class="form-control" value="{{old('twilio_phone_no', $setting->twilio_phone_no)}}" name="twilio_phone_no" id="twilio_phone_no" placeholder="{{__('Twilio Phone Number')}}">
                                                        @error('twilio_phone_no')                                    
                                                            <div class="invalid-div">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div> 

                                                @can('setting_edit')
                                                    <div class="border-top">
                                                        <div class="card-body text-center">
                                                            <input type="submit" class="btn btn-primary rtl-float-none" value="{{__('Submit')}}">
                                                        </div>
                                                    </div>
                                                @endcan
                                            </form>
                                        </div>

                                        <!-- Payment Gateway --->
                                        <div class="tab-pane fade" id="tab-6" role="tabpanel" aria-labelledby="tabs-icons-text-6-tab">
                                            <form action="{{url('/admin/setting/payment_gateway')}}" method="post">
                                                @csrf
                                                <h3 class="card-title">{{__('Payment Gateway')}}</h3>
                                                
                                                <div class="form-group row">
                                                    <label class="col-sm-3 text-right control-label col-form-label" for="cod">{{__('COD')}} </label>
                                                    <div class="col-sm-9 mt-2">
                                                        <label class="custom-toggle">
                                                            <input type="checkbox" id="cod" name="cod" {{ $payment->cod == 1?'checked':'' }}>
                                                            <span class="custom-toggle-slider rounded-circle" data-label-off="No" data-label-on="Yes"></span>
                                                        </label>
                                                    </div>
                                                </div>
                                                
                                                <div class="form-group row">
                                                    <label class="col-sm-3 text-right control-label col-form-label" for="paypal">{{__('Paypal')}} </label>
                                                    <div class="col-sm-9 mt-2">
                                                        <label class="custom-toggle">
                                                            <input type="checkbox" id="paypal" name="paypal" {{ $payment->paypal == 1?'checked':'' }}>
                                                            <span class="custom-toggle-slider rounded-circle" data-label-off="No" data-label-on="Yes"></span>
                                                        </label>
                                                    </div>
                                                </div>
                                                    
                                                <div class="form-group row">
                                                    <label class="col-sm-3 text-right control-label col-form-label" for="razorpay">{{__('Razorpay')}} </label>
                                                    <div class="col-sm-9 mt-2">
                                                        <label class="custom-toggle">
                                                            <input type="checkbox" id="razorpay" name="razorpay" {{ $payment->razorpay == 1?'checked':'' }} {{ $setting->currency_code != "INR"?'disabled':'' }}>
                                                            <span class="custom-toggle-slider rounded-circle" data-label-off="No" data-label-on="Yes"></span>
                                                        </label>
                                                        @if ($setting->currency_code != "INR")
                                                            <div class="mt-3">
                                                                {{__("Rozarpay doesn't support")}} {{ $setting->currency_code }}
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                            
                                                <div class="form-group row">
                                                    <label class="col-sm-3 text-right control-label col-form-label" for="stripe">{{__('Stripe')}} </label>
                                                    <div class="col-sm-9 mt-2">
                                                        <label class="custom-toggle">
                                                            <input type="checkbox" id="stripe" name="stripe" {{ $payment->stripe == 1?'checked':'' }}>
                                                            <span class="custom-toggle-slider rounded-circle" data-label-off="No" data-label-on="Yes"></span>
                                                        </label>
                                                    </div>
                                                </div>

                                                {{-- <div class="form-group row">
                                                    <label class="col-sm-3 text-right control-label col-form-label" for="paystack">{{__('Paystack')}} </label>
                                                    <div class="col-sm-9 mt-2">
                                                        <label class="custom-toggle">
                                                            <input type="checkbox" id="paystack" name="paystack" {{ $payment->paystack == 1?'checked':'' }}>
                                                            <span class="custom-toggle-slider rounded-circle" data-label-off="No" data-label-on="Yes"></span>
                                                        </label>
                                                    </div>
                                                </div> --}}
                                                
                                                <div class="form-group row">
                                                    <label class="col-sm-3 text-right control-label col-form-label" for="paypal_sandbox_key">{{__('Paypal Sandbox Key')}}</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" class="form-control" value="{{old('paypal_sandbox_key', $payment->paypal_sandbox_key)}}" name="paypal_sandbox_key" id="paypal_sandbox_key" placeholder="{{__('Paypal Sandbox Key')}}">
                                                        @error('paypal_sandbox_key')                                    
                                                            <div class="invalid-div">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div> 

                                                <div class="form-group row">
                                                    <label class="col-sm-3 text-right control-label col-form-label" for="paypal_production_key">{{__('Paypal Production Key')}}</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" class="form-control" value="{{old('paypal_production_key', $payment->paypal_production_key)}}" name="paypal_production_key" id="paypal_production_key" placeholder="{{__('Paypal Production Key')}}">
                                                        @error('paypal_production_key')                                    
                                                            <div class="invalid-div">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div> 
                                                    
                                                <div class="form-group row">
                                                    <label class="col-sm-3 text-right control-label col-form-label" for="razorpay_public_key">{{__('Razorpay Public Key')}}</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" class="form-control" value="{{old('razorpay_public_key', $payment->razorpay_public_key)}}" name="razorpay_public_key" id="razorpay_public_key" placeholder="{{__('Razorpay Public Key')}}">
                                                        @error('razorpay_public_key')                                    
                                                            <div class="invalid-div">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div> 

                                                <div class="form-group row">
                                                    <label class="col-sm-3 text-right control-label col-form-label" for="razorpay_secret_key">{{__('Razorpay Secret Key')}}</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" class="form-control" value="{{old('razorpay_secret_key', $payment->razorpay_secret_key)}}" name="razorpay_secret_key" id="razorpay_secret_key" placeholder="{{__('Razorpay Secret Key')}}">
                                                        @error('razorpay_secret_key')                                    
                                                            <div class="invalid-div">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div> 
                                                    
                                                <div class="form-group row">
                                                    <label class="col-sm-3 text-right control-label col-form-label" for="stripe_public_key">{{__('Stripe Public Key')}}</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" class="form-control" value="{{old('stripe_public_key', $payment->stripe_public_key)}}" name="stripe_public_key" id="stripe_public_key" placeholder="{{__('Stripe Public Key')}}">
                                                        @error('stripe_public_key')                                    
                                                            <div class="invalid-div">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div> 

                                                <div class="form-group row">
                                                    <label class="col-sm-3 text-right control-label col-form-label" for="stripe_secret_key">{{__('Stripe Secret Key')}}</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" class="form-control" value="{{old('stripe_secret_key', $payment->stripe_secret_key)}}" name="stripe_secret_key" id="stripe_secret_key" placeholder="{{__('Stripe Secret Key')}}">
                                                        @error('stripe_secret_key')                                    
                                                            <div class="invalid-div">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div> 

                                                @can('setting_edit')
                                                    <div class="border-top">
                                                        <div class="card-body text-center">
                                                            <input type="submit" class="btn btn-primary rtl-float-none" value="{{__('Submit')}}">
                                                        </div>
                                                    </div>
                                                @endcan
                                            </form>
                                        </div>
                                        
                                        <!-- Terms of use --->
                                        <div class="tab-pane fade" id="tab-7" role="tabpanel" aria-labelledby="tabs-icons-text-7-tab">
                                            <form action="{{url('/admin/setting/terms_of_use')}}" id="terms_form" method="post">
                                                @csrf
                                                <h3 class="card-title">{{__('Terms Of Use')}}</h3>
                                                <textarea class="terms_of_use form-control" rows="10" name="terms_of_use">{{$setting->terms_of_use}}</textarea>

                                                @can('setting_edit')
                                                    <div class="border-top">
                                                        <div class="card-body text-center">
                                                            <input type="submit" class="btn btn-primary rtl-float-none" value="{{__('Submit')}}">
                                                        </div>
                                                    </div>
                                                @endcan
                                            </form>
                                        </div>

                                        <!-- privacy_policy --->
                                        <div class="tab-pane fade" id="tab-8" role="tabpanel" aria-labelledby="tabs-icons-text-8-tab">
                                            <form action="{{url('/admin/setting/privacy_policy')}}" id="privacy_form" method="post">
                                                @csrf
                                                <h3 class="card-title">{{__('Privacy Policy')}}</h3>
                                                <textarea class="privacy_policy form-control" rows="10" name="privacy_policy">{{$setting->privacy_policy}}</textarea>

                                                @can('setting_edit')
                                                    <div class="border-top">
                                                        <div class="card-body text-center">
                                                            <input type="submit" class="btn btn-primary rtl-float-none" value="{{__('Submit')}}">
                                                        </div>
                                                    </div>
                                                @endcan
                                            </form>
                                        </div>

                                        <!-- App Setting --->
                                        <div class="tab-pane fade" id="tab-9" role="tabpanel" aria-labelledby="tabs-icons-text-9-tab">
                                            <form action="{{url('/admin/setting/app_setting')}}" method="post" enctype="multipart/form-data">
                                            @csrf
                                                <h3 class="card-title">{{__('App Setting')}}</h3>
                                                
                                                <div class="form-group row">
                                                    <label class="col-sm-3 text-right control-label col-form-label">{{__('Select Unit')}}</label>
                                                    <div class="col-sm-9 w-75">
                                                        <select class="form-control" dir="{{ session()->has('direction')&& session('direction') == 'rtl'? 'rtl':''}}" name="unit" id="unit" >
                                                            <option value="KG" <?php if($setting->cloth_unit == "KG"){ echo "selected"; } ?>> KG </option>
                                                            <option value="Cloth" <?php if($setting->cloth_unit == "Cloth"){ echo "selected"; } ?>> Cloth </option>
                                                        </select>
                                                    </div>
                                                </div>
                                                
                                                <div class="form-group row">
                                                    <label class="col-sm-3 text-right control-label col-form-label" for="app_name">{{__('App Name')}}</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" class="form-control" value="{{old('app_name', $setting->app_name)}}" name="app_name" id="app_name" placeholder="{{__('App Name')}}">
                                                        @error('app_name')                                    
                                                            <div class="invalid-div">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div> 
                                                
                                                <div class="form-group row">
                                                    <label class="col-sm-3 text-right control-label col-form-label" for="app_name">{{__('Version')}}</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" class="form-control" value="{{old('app_version', $setting->app_version)}}" name="app_version" id="app_version" placeholder="{{__('Version')}}">
                                                        @error('app_version')                                    
                                                            <div class="invalid-div">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div> 

                                                <div class="form-group row">
                                                    <label class="col-sm-3 text-right control-label col-form-label">{{__('Favicon Icon')}}</label>
                                                    <div class="">
                                                        <div class="col-sm-9 avatar-upload avatar-box">
                                                            <div class="avatar-edit">
                                                                <input type='file' id="image" name="image" accept=".png, .jpg, .jpeg" />
                                                                <label for="image"></label>
                                                            </div>
                                                            <div class="avatar-preview">
                                                                <div id="imagePreview" style="background-image: url({{url('/images/app/'.$setting->favicon)}});">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                <div class="form-group row">
                                                    <label class="col-sm-3 text-right control-label col-form-label">{{__('Black Logo')}}</label>
                                                    <div class="">
                                                        <div class="col-sm-9 avatar-upload avatar-box">
                                                            <div class="avatar-edit">
                                                                <input type='file' id="image_edit" name="image_edit" accept=".png, .jpg, .jpeg" />
                                                                <label for="image_edit"></label>
                                                            </div>
                                                            <div class="avatar-preview">
                                                                <div id="imagePreview_edit" style="background-image: url({{url('/images/app/'.$setting->black_logo)}});">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="col-sm-3 text-right control-label col-form-label">{{__('White Logo')}}</label>
                                                    <div class="">
                                                        <div class="col-sm-9 avatar-upload avatar-box">
                                                            <div class="avatar-edit">
                                                                <input type='file' id="image_edit_2" name="image_edit_2" accept=".png, .jpg, .jpeg" />
                                                                <label for="image_edit_2"></label>
                                                            </div>
                                                            <div class="avatar-preview">
                                                                <div id="imagePreview_edit_2" style="background-image: url({{url('/images/app/'.$setting->white_logo)}});">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                <div class="form-group row">
                                                    <label class="col-sm-3 text-right control-label col-form-label">{{__('Color Logo')}}</label>
                                                    <div class="">
                                                        <div class="col-sm-9 avatar-upload avatar-box">
                                                            <div class="avatar-edit">
                                                                <input type='file' id="image_edit_3" name="image_edit_3" accept=".png, .jpg, .jpeg" />
                                                                <label for="image_edit_3"></label>
                                                            </div>
                                                            <div class="avatar-preview">
                                                                <div id="imagePreview_edit_3" style="background-image: url({{url('/images/app/'.$setting->color_logo)}});">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                <div class="form-group row">
                                                    <label class="col-sm-3 text-right control-label col-form-label">{{__('Login Screen')}}</label>
                                                    <div class="">
                                                        <div class="col-sm-9 avatar-upload avatar-box">
                                                            <div class="avatar-edit">
                                                                <input type='file' id="image_edit_4" name="image_edit_4" accept=".png, .jpg, .jpeg" />
                                                                <label for="image_edit_4"></label>
                                                            </div>
                                                            <div class="avatar-preview">
                                                                <div id="imagePreview_edit_4" style="background-image: url({{url('/images/app/'.$setting->splash_screen)}});">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                @can('setting_edit')
                                                    <div class="border-top">
                                                        <div class="card-body text-center">
                                                            <input type="submit" class="btn btn-primary rtl-float-none" value="{{__('Submit')}}">
                                                        </div>
                                                    </div>
                                                @endcan
                                            </form>
                                        </div>
                                        
                                        <!-- Admin Settings --->
                                        <div class="tab-pane fade" id="tab-10" role="tabpanel" aria-labelledby="tabs-icons-text-10-tab">
                                            <form action="{{url('/admin/setting/admin_settings')}}" method="post" enctype="multipart/form-data">
                                            @csrf
                                                <h3 class="card-title">{{__('Admin Settings')}}</h3>

                                                <div class="form-group row">
                                                    <label class="col-sm-3 text-right control-label col-form-label">{{__('Header Image')}}</label>
                                                    <div class="">
                                                        <div class="col-sm-9 avatar-upload avatar-box">
                                                            <div class="avatar-edit">
                                                                <input type='file' id="image_edit_5" name="image_edit_5" accept=".png, .jpg, .jpeg" />
                                                                <label for="image_edit_5"></label>
                                                            </div>
                                                            <div class="avatar-preview">
                                                                <div id="imagePreview_edit_5" style="background-image: url({{url('/images/app/'.$setting->bg_img)}});">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                <div class="form-group row">
                                                    <label class="col-sm-3 text-right control-label col-form-label">{{__('No Data Found Image')}}</label>
                                                    <div class="">
                                                        <div class="col-sm-9 avatar-upload avatar-box">
                                                            <div class="avatar-edit">
                                                                <input type='file' id="image_edit_6" name="image_edit_6" accept=".png, .jpg, .jpeg" />
                                                                <label for="image_edit_6"></label>
                                                            </div>
                                                            <div class="avatar-preview">
                                                                <div id="imagePreview_edit_6" style="background-image: url({{url('/images/app/'.$setting->no_data)}});">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="example-color-input" class="col-sm-3 text-right control-label col-form-label">{{__('Color')}}</label>
                                                    <input type="color" class="col-sm-9 form-control"  value="{{old('color', $setting->color)}}" id="color" name="color" id="example-color-input">
                                                </div>

                                                @can('setting_edit')
                                                    <div class="border-top">
                                                        <div class="card-body text-center">
                                                            <input type="submit" class="btn btn-primary rtl-float-none" value="{{__('Submit')}}">
                                                        </div>
                                                    </div>
                                                @endcan
                                            </form>
                                        </div>
                                        
                                        <!-- License --->
                                        <div class="tab-pane fade {{ $setting->license_status == 0 ? 'active show': '' }}" id="tab-11" role="tabpanel" aria-labelledby="tabs-icons-text-11-tab">
                                            <form action="{{url('/admin/setting/license')}}" method="post">
                                                @csrf
                                                <h3 class="card-title">{{__('License')}}</h3>
                                                
                                                <div class="form-group row">
                                                    <label class="col-sm-3 text-right control-label col-form-label" for="license_code">{{__('License Code')}}</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" class="form-control" value="{{old('license_code', $setting->license_code)}}" name="license_code" id="license_code" placeholder="{{__('License Code')}}" {{ $setting->license_status == 1 ? 'disabled': '' }}>
                                                        @error('license_code')                                    
                                                            <div class="invalid-div">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div> 

                                                <div class="form-group row">
                                                    <label class="col-sm-3 text-right control-label col-form-label" for="license_client_name">{{__('License Client Name')}}</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" class="form-control" value="{{old('license_client_name', $setting->license_client_name)}}" name="license_client_name" id="license_client_name" placeholder="{{__('License Client Name')}}" {{ $setting->license_status == 1 ? 'disabled': '' }}>
                                                        @error('license_client_name')
                                                            <div class="invalid-div">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                @can('setting_edit')
                                                    @if ($setting->license_status == 0)
                                                        <div class="border-top">
                                                            <div class="card-body text-center">
                                                                <input type="submit" class="btn btn-primary rtl-float-none" value="{{__('Submit')}}">
                                                            </div>
                                                        </div>
                                                    @endif
                                                @endcan
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection