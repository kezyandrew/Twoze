<div class="container-fluid sidebar_open @if($errors->any()) show_sidebar_edit @endif" id="edit_language_sidebar">
    <div class="row">
        <div class="col">
            <div class="card py-3 border-0">
                <!-- Card header -->
                <div class="border_bottom_primary pb-3 pt-2 mb-4">
                    <span class="h3">{{__('Edit Language')}}</span>
                    <button type="button" class="edit_language_close close">&times;</button>
                </div>
                <form class="form-horizontal"  id="edit_language_form" method="post" enctype="multipart/form-data" action="#">
                    @csrf
                    @method('put')

                    <div class="my-0">
                       
                        <div class="avatar-upload avatar-box">
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
                            <label class="form-control-label" for="name"> {{__('Name')}} {{__('(Not Editable)')}} </label>
                            <input type="text" value="{{ old('name') }}" name="name" id="name" class="form-control" placeholder="{{__('Language Name')}}" readonly>
                            <div class="invalid-div "><span class="name"></span></div>
                        </div>
                        
                        <label class="form-control-label" for="language_file_edit"> {{__('Language JSON File')}} </label>
                        <div class="custom-file mb-3">
                            <input type="file" accept="Application/JSON" name="language_file_edit" id="language_file_edit" class="form-control">
                            <label class="custom-file-label" for="language_file_edit"></label>
                        </div>
                        
                        
                        <div class="form-group">
                            <label class="form-control-label" for="direction">{{__('Direction')}}</label>
                            <select class="form-control" name="direction" value="{{ old('direction') }}">
                                <option value='ltr'>{{__('LTR')}}</option>
                                <option value='rtl'>{{__('RTL')}}</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label class="form-control-label" for="status">{{__('Status')}}</label>
                            <select class="form-control" name="status"  value="{{ old('status') }}">
                                <option value='1'>{{__('Active')}}</option>
                                <option value='0'>{{__('Inactive')}}</option>
                            </select>
                        </div>
                        
                        <input type="hidden" name="id">

                        <div class="text-center">
                            <button type="button" id="edit_btn" onclick="all_edit('edit_language_form','language')" class="btn btn-primary mt-4 mb-5">{{ __('Save Changes') }}</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>