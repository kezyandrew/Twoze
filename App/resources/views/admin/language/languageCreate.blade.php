<div class="container-fluid sidebar_open @if($errors->any()) show_sidebar_create @endif" id="add_language_sidebar">
    <div class="row">
        <div class="col">
            <div class="card py-3 border-0">
                <!-- Card header -->
                <div class="border_bottom_primary pb-3 pt-2 mb-4">
                    <span class="h3">{{__('Create Language')}}</span>
                    <button type="button" class="add_language close">&times;</button>
                </div>
                <form class="form-horizontal"  id="create_language_form" method="post" enctype="multipart/form-data" action="{{url('/admin/language')}}">
                    @csrf
                    <div class="my-0">
                       
                        <div class="avatar-upload avatar-box">
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
                            <label class="form-control-label" for="name"> {{__('Name')}} {{__('(Not Editable)')}} </label>
                            <input type="text" value="{{ old('name') }}" name="name" id="name" class="form-control" placeholder="{{__('Language Name')}}" autofocus>
                            <div class="invalid-div "><span class="name"></span></div>
                        </div>
                        
                        <label class="form-control-label" for="language_file"> {{__('Language JSON File')}} </label>
                        <div class="custom-file mb-3">
                            <input type="file" value="{{ old('language_file') }}" accept="Application/JSON" name="language_file" id="language_file" class="form-control">
                            <label class="custom-file-label" for="language_file"></label>
                            <div class="invalid-div "><span class="language_file"></span></div>
                        </div>
                        
                        
                        <div class="form-group">
                            <label class="form-control-label" for="direction">{{__('Direction')}}</label>
                            <select class="form-control" name="direction" value="{{ old('direction') }}">
                                <option value='ltr' selected>{{__('LTR')}}</option>
                                <option value='rtl'>{{__('RTL')}}</option>
                            </select>
                            <div class="invalid-div "><span class="direction"></span></div>
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
                            <button type="button" id="create_btn" onclick="all_create('create_language_form','language')" class="btn btn-primary mt-4 mb-5">{{ __('Create') }}</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>