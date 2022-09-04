<div class="container-fluid  sidebar_open @if($errors->any()) show_sidebar_edit @endif" id="edit_user_sidebar">
    <div class="row">
        <div class="col">
            <div class="card py-3 border-0">
                <!-- Card header -->
                <div class="border_bottom_primary pb-3 pt-2 mb-4">
                    <span class="h3">{{__('Edit User')}}</span>
                    <button type="button" class="edit_user_close close">&times;</button>
                </div>
                <form class="form-horizontal"  id="edit_user_form" method="post" enctype="multipart/form-data" action="#">
                    @method('put')
                    @csrf
                    
                    <div class="my-0">
                        
                        <div class="avatar-upload">
                            <div class="avatar-edit">
                                <input type='file' id="image_edit" name="image_edit" accept=".png, .jpg, .jpeg" />
                                <label for="image_edit"></label>
                            </div>
                            <div class="avatar-preview">
                                <div id="imagePreview_edit" style="background-color: #f0f3f6;">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="form-control-label" for="name">{{__('Name')}}</label>
                            <input type="text" value="{{ old('name') }}" name="name" id="name" class="form-control" placeholder="{{__('User Name')}}" autofocus>
                            <div class="invalid-div "><span class="name"></span></div>
                        </div>
                        
                        <div class="form-group">
                            <label class="form-control-label" for="email">{{__('Email')}}</label>
                            <input type="text" value="{{ old('email') }}" name="email" id="email" class="form-control" placeholder="{{__('Email Address')}}" disabled>
                            <div class="invalid-div "><span class="email"></span></div>
                        </div>

                        <div class="form-group">
                            <label class="form-control-label" for="country_code">{{__('Country Code')}}</label>
                            <select class="form-control select2" dir="{{ session()->has('direction')&& session('direction') == 'rtl'? 'rtl':''}}" name="country_code"  value="{{ old('country_code') }}"  data-placeholder='{{ __("-- Select Country Code --")}}'>
                                @foreach ($country_code as $code)
                                    <option value={{$code->phonecode}}>{{$code->nicename}} ({{$code->iso3}}) - {{$code->phonecode}}</option>
                                @endforeach
                            </select>
                            <div class="invalid-div "><span class="country_code"></span></div>
                        </div>

                        <div class="form-group">
                            <label class="form-control-label" for="phone">{{__('Phone')}}</label>
                            <input type="text" value="{{ old('phone') }}" name="phone" id="phone" class="form-control" placeholder="{{__('Phone Number')}}">
                            <div class="invalid-div "><span class="phone"></span></div>
                        </div>
                        
                        
                        <div class="form-group">
                            <label class="form-control-label" for="role">{{__('Select Role')}}</label>
                            <select class="form-control select2" dir="{{ session()->has('direction')&& session('direction') == 'rtl'? 'rtl':''}}" multiple="multiple" name="roles[]" data-placeholder='{{ __("-- Select role --")}}'>
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
                        
                        <input type="hidden" name="id">
                        
                        <div class="text-center">
                            <button type="button" id="edit_btn" onclick="all_edit('edit_user_form','user')" class="btn btn-primary mt-4 mb-5">{{ __('Save Changes') }}</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>