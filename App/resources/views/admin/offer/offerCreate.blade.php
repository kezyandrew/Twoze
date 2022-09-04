<div class="container-fluid sidebar_open @if($errors->any()) show_sidebar_create @endif" id="add_offer_sidebar">
    <div class="row">
        <div class="col">
            <div class="card py-3 border-0">
                <!-- Card header -->
                <div class="border_bottom_primary pb-3 pt-2 mb-4">
                    <span class="h3">{{__('Create Offer')}}</span>
                    <button type="button" class="add_offer close">&times;</button>
                </div>
                <form class="form-horizontal"  id="create_offer_form" method="post" enctype="multipart/form-data" action="{{url('/admin/offer')}}">
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
                            <label class="form-control-label" for="title1">{{__('Title 1')}}</label>
                            <input type="text" value="{{ old('title1') }}" name="title1" id="title1" class="form-control" placeholder="{{__('Title 1')}}" autofocus>
                            <div class="invalid-div "><span class="title1"></span></div>
                        </div>
                        
                        <div class="form-group">
                            <label class="form-control-label" for="title2">{{__('Title 2')}}</label>
                            <input type="text" value="{{ old('title2') }}" name="title2" id="title2" class="form-control" placeholder="{{__('Title 2')}}">
                            <div class="invalid-div "><span class="title2"></span></div>
                        </div>

                        <div class="form-group">
                            <label class="form-control-label" for="type">{{__('Type')}}</label>
                            <select class="form-control" name="type"  value="{{ old('type') }}">
                                <option value='Percentage' selected>{{__('Percentage')}}</option>
                                <option value='Amount'>{{__('Amount')}}</option>
                            </select>
                            <div class="invalid-div "><span class="type"></span></div>
                        </div>
                        
                        <div class="form-group">
                            <label class="form-control-label" for="discount">{{__('Discount')}}</label>
                            <input type="text" name="discount" id="discount" class="form-control" placeholder="{{__('Discount Amount/Percentage')}}">
                            <div class="invalid-div "><span class="discount"></span></div>
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
                            <button type="button" id="create_btn" onclick="all_create('create_offer_form','offer')" class="btn btn-primary mt-4 mb-5">{{ __('Create') }}</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>