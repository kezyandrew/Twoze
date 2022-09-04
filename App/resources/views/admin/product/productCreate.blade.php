<div class="container-fluid sidebar_open @if($errors->any()) show_sidebar_create @endif" id="add_product_sidebar">
    <div class="row">
        <div class="col">
            <div class="card py-3 border-0">
                <!-- Card header -->
                <div class="border_bottom_primary pb-3 pt-2 mb-4">
                    <span class="h3">{{__('Create Product')}}</span>
                    <button type="button" class="add_product close">&times;</button>
                </div>
                <form class="form-horizontal"  id="create_product_form" method="post" enctype="multipart/form-data" action="{{url('/admin/product')}}">
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
                            <label class="form-control-label" for="name">{{__('Name')}}</label>
                            <input type="text" value="{{ old('name') }}" name="name" id="name" class="form-control" placeholder="{{__('Product Name')}}" autofocus>
                            <div class="invalid-div "><span class="name"></span></div>
                        </div>
                    
                        <div class="form-group">
                            @if ($cloth_unit == "KG")
                                <label class="form-control-label" for="price">{{__('Price / KG')}}</label>
                                <input type="text" value="{{ old('price') }}" name="price" id="price" class="form-control" placeholder="{{__('Price / KG')}}">
                            @else
                                <label class="form-control-label" for="price">{{__('Price / Cloth')}}</label>
                                <input type="text" value="{{ old('price') }}" name="price" id="price" class="form-control" placeholder="{{__('Price / Cloth')}}">
                            @endif
                            <div class="invalid-div "><span class="price"></span></div>
                        </div>
                        
                        <div class="form-group">
                            <label class="form-control-label" for="service_id">{{__('Select Services')}}</label>
                            <select class="form-control select2" dir="{{ session()->has('direction')&& session('direction') == 'rtl'? 'rtl':''}}" multiple="multiple" name="service_id[]"  value="{{ old('service_id') }}"  data-placeholder='{{ __("-- Select Services --")}}'>
                                @foreach ($services as $service)
                                    <option value={{$service->id}}>{{$service->name}}</option>
                                @endforeach
                            </select>
                            <div class="invalid-div "><span class="service_id"></span></div>
                        </div>
                        
                        <div class="form-group">
                            <label class="form-control-label" for="status">{{__('Status')}}</label>
                            <select class="form-control" name="status"  value="{{ old('status') }}">
                                <option value='1' selected>Active</option>
                                <option value='0'>Inactive</option>
                            </select>
                            <div class="invalid-div "><span class="status"></span></div>
                        </div>

                        <div class="text-center">
                            <button type="button" id="create_btn" onclick="all_create('create_product_form','product')" class="btn btn-primary mt-4 mb-5">{{ __('Create') }}</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>