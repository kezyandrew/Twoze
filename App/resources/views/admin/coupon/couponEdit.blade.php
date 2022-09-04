<div class="container-fluid sidebar_open @if($errors->any()) show_sidebar_edit @endif" id="edit_coupon_sidebar">
    <div class="row">
        <div class="col">
            <div class="card py-3 border-0">
                <!-- Card header -->
                <div class="border_bottom_primary pb-3 pt-2 mb-4">
                    <span class="h3">{{__('Edit Coupon')}}</span>
                    <button type="button" class="edit_coupon_close close">&times;</button>
                </div>
                <form class="form-horizontal"  id="edit_coupon_form" method="post" enctype="multipart/form-data" action="#">
                    @method('put')
                    @csrf
                    <div class="my-0">
                        <?php
                            $permitted_chars = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
                            $code = substr(str_shuffle($permitted_chars), 0, 11);
                        ?>
                        
                        <div class="form-group">
                            <label class="form-control-label" for="code">{{__('Code')}}</label>
                            <input type="text" name="code" value="{{$code}}" id="code" class="form-control" placeholder="{{__('Coupon Code')}}" readonly>
                            <div class="invalid-div "><span class="code"></span></div>
                        </div>
                        
                        <div class="form-group">
                            <label class="form-control-label" for="max_use">{{__('Maximum Use')}}</label>
                            <input type="text" value="{{ old('max_use') }}" name="max_use" id="max_use" class="form-control" placeholder="{{__('Maximum Use')}}">
                            <div class="invalid-div "><span class="max_use"></span></div>
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
                            <label class="form-control-label" for="duration">{{__('Duration')}}</label>
                            <input type="text" name="duration" id="filter_date_edit" class="form-control" placeholder="{{__('Duration')}}">
                            <div class="invalid-div "><span class="duration"></span></div>
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
                            <button type="button" id="edit_btn" onclick="all_edit('edit_coupon_form','coupon')" class="btn btn-primary mt-4 mb-5">{{ __('Save Changes') }}</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>