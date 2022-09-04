<div class="container-fluid sidebar_open @if($errors->any()) show_sidebar_create @endif" id="add_user_sidebar">
    <div class="row">
        <div class="col">
            <div class="card py-3 border-0">
                <!-- Card header -->
                <div class="border_bottom_primary pb-3 pt-2 mb-4">
                    <span class="h3">{{__('Create User')}}</span>
                    <button type="button" class="add_user close">&times;</button>
                </div>
                <form class="form-horizontal"  id="create_user_form" method="post" enctype="multipart/form-data" action="{{url('/admin/user')}}">
                    @csrf
                    <div class="my-0">

                        <div class="avatar-upload">
                            <div class="avatar-edit">
                                <input type='file' id="image" name="image" accept=".png, .jpg, .jpeg" />
                                <label for="image"></label>
                            </div>
                            <div class="avatar-preview">
                                <div id="imagePreview" style="background-color: #f0f3f6;">
                                </div>
                            </div>
                        </div>
                        <div class="invalid-div text-center mt-3"><span class="image"></span></div>

                        <div class="form-group">
                            <label class="form-control-label" for="name_create">{{__('Name')}}</label>
                            <input type="text" value="{{ old('name') }}" name="name" id="name_create" class="form-control" placeholder="{{__('User Name')}}" autocomplete="username" autofocus>
                            <div class="invalid-div "><span class="name"></span></div>
                        </div>
                        
                        <div class="form-group">
                            <label class="form-control-label" for="email_create">{{__('Email')}}</label>
                            <input type="text" value="{{ old('email') }}" name="email" id="email_create" class="form-control" autocomplete="email" placeholder="{{__('Email Address')}}">
                            <div class="invalid-div "><span class="email"></span></div>
                        </div>
                       
                        <div class="form-group">
                            <label class="form-control-label" for="country_code">{{__('Country Code')}}</label>
                            <select class="form-control select2" dir="{{ session()->has('direction')&& session('direction') == 'rtl'? 'rtl':''}}" name="country_code"  value="{{ old('country_code') }}"  data-placeholder='{{ __("-- Select Country Code --")}}'>
                                @foreach ($country_code as $code)
                                    <option value={{$code->phonecode}}>{{$code->nicename}} ({{$code->iso3}}) - {{$code->phonecode}}</option>
                                @endforeach
                            </select>
                            <div class="invalid-div "><span class="roles"></span></div>
                        </div>

                        <div class="form-group">
                            <label class="form-control-label" for="phone_create">{{__('Phone')}}</label>
                            <input type="text" value="{{ old('phone') }}" name="phone" id="phone_create" class="form-control" placeholder="{{__('Phone Number')}}">
                            <div class="invalid-div "><span class="phone"></span></div>
                        </div>
                        
                        <div class="form-group">
                            <label class="form-control-label" for="password">{{__('Password')}}</label>
                            <input type="password" name="password" id="password" class="form-control" placeholder="{{__('Password')}}" autocomplete="current-password">
                            <div class="invalid-div"><span class="password"></span></div>
                        </div>
                        
                        <div class="form-group">
                            <label class="form-control-label" for="role">{{__('Select Role')}}</label>
                            <select class="form-control select2" dir="{{ session()->has('direction')&& session('direction') == 'rtl'? 'rtl':''}}" multiple="multiple" name="roles[]"  value="{{ old('roles') }}"  data-placeholder='{{ __("-- Select role --")}}'>
                                @foreach ($roles as $role)
                                    <option value={{$role->id}}>{{$role->title}}</option>
                                @endforeach
                            </select>
                            <div class="invalid-div "><span class="roles"></span></div>
                        </div>

                        <div class="form-group">
                            <label class="form-control-label" for="status">{{__('Status')}}</label>
                            <select class="form-control" name="status"  value="{{ old('status') }}">
                                <option value='1' selected>{{__('Active')}}</option>
                                <option value='0'>{{__('Inactive')}}</option>
                            </select>
                            <div class="invalid-div "><span class="status"></span></div>
                        </div>
                        
                        <div class="text-center">
                            <button type="button" id="create_btn" onclick="all_create('create_user_form','user')" class="btn btn-primary mt-4 mb-5">{{ __('Create') }}</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>