<div class="container-fluid sidebar_open @if($errors->any()) show_sidebar_edit @endif" id="edit_service_sidebar">
    <div class="row">
        <div class="col">
            <div class="card py-3 border-0">
                <!-- Card header -->
                <div class="border_bottom_primary pb-3 pt-2 mb-4">
                    <span class="h3">{{__('Edit Service')}}</span>
                    <button type="button" class="edit_service_close close">&times;</button>
                </div>
                <form class="form-horizontal"  id="edit_service_form" method="post" enctype="multipart/form-data" action="#">
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
                            <label class="form-control-label" for="name">{{__('Name')}}</label>
                            <input type="text" value="{{ old('name') }}" name="name" id="name" class="form-control" placeholder="{{__('Service Name')}}" autofocus>
                            <div class="invalid-div "><span class="name"></span></div>
                        </div>
                    
                        <div class="form-group">
                            <label class="form-control-label" for="price">{{__('Price')}}</label>
                            <input type="text" value="{{ old('price') }}" name="price" id="price" class="form-control" placeholder="{{__('Price')}}">
                            <div class="invalid-div "><span class="price"></span></div>
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
                            <button type="button" id="edit_btn" onclick="all_edit('edit_service_form','service')" class="btn btn-primary mt-4 mb-5">{{ __('Save Changes') }}</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>