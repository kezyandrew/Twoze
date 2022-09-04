<div class="container-fluid sidebar_open @if($errors->any()) show_sidebar_create @endif" id="add_coupon_sidebar">
    <div class="row">
        <div class="col">
            <div class="card py-3 border-0">
                <!-- Card header -->
                <div class="border_bottom_primary pb-3 pt-2 mb-4">
                    <span class="h3">{{__('Create Coupon')}}</span>
                    <button type="button" class="add_coupon close">&times;</button>
                </div>
                <form class="form-horizontal"  id="create_coupon_form" method="post" enctype="multipart/form-data" action="{{url('/admin/coupon')}}">
                    @csrf
                    <div class="my-0">
                        <?php
                            $permitted_chars = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
                            $code = substr(str_shuffle($permitted_chars), 0, 11);
                        ?>
                        
                        <div class="form-group">
                            <label class="form-control-label" for="code_create">{{__('Code')}}</label>
                            <input type="text" name="code" value="{{$code}}" id="code_create" class="form-control" placeholder="{{__('Coupon Code')}}" readonly>
                            <div class="invalid-div "><span class="code"></span></div>
                        </div>
                        
                        <div class="form-group">
                            <label class="form-control-label" for="max_use_create">{{__('Maximum Use')}}</label>
                            <input type="text" value="{{ old('max_use') }}" name="max_use" id="max_use_create" class="form-control" placeholder="{{__('Maximum Use')}}">
                            <div class="invalid-div "><span class="max_use"></span></div>
                        </div>

                        <div class="form-group">
                            <label class="form-control-label">{{__('Type')}}</label>
                            <select class="form-control" name="type"  value="{{ old('type') }}">
                                <option value='Percentage' selected>{{__('Percentage')}}</option>
                                <option value='Amount'>{{__('Amount')}}</option>
                            </select>
                            <div class="invalid-div "><span class="type"></span></div>
                        </div>
                        
                        <div class="form-group">
                            <label class="form-control-label" for="discount_create">{{__('Discount')}}</label>
                            <input type="text" name="discount" id="discount_create" class="form-control" placeholder="{{__('Discount Amount/Percentage')}}">
                            <div class="invalid-div "><span class="discount"></span></div>
                        </div>
                        
                        <div class="form-group">
                            <label class="form-control-label" for="filter_date_create">{{__('Duration')}}</label>
                            <input type="text" name="duration" id="filter_date_create" class="form-control" placeholder="{{__('Duration')}}">
                            <div class="invalid-div "><span class="duration"></span></div>
                        </div>

                        <div class="form-group">
                            <label class="form-control-label">{{__('Status')}}</label>
                            <select class="form-control" name="status"  value="{{ old('status') }}">
                                <option value='1' selected>{{__('Active')}}</option>
                                <option value='0'>{{__('Inactive')}}</option>
                            </select>
                            <div class="invalid-div "><span class="status"></span></div>
                        </div>
                        
                        <div class="text-center">
                            <button type="button" id="create_btn" onclick="all_create('create_coupon_form','coupon')" class="btn btn-primary mt-4 mb-5">{{ __('Create') }}</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>