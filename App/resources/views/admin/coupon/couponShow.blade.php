<div class="container-fluid sidebar_open @if($errors->any()) show_sidebar @endif" id="show_coupon_sidebar">
    <div class="row">
        <div class="col">
            <div class="card py-3 border-0">
                <!-- Card header -->
                <div class="border_bottom_primary pb-3 pt-2 mb-4">
                    <span class="h3">{{__('View Coupon')}}</span>
                    <button type="button" class="show_coupon_close close">&times;</button>
                </div>
                
                <div class="card card-profile shadow">
                    <div class="card-body p-2">
                        <div class="text-center">

                            <div class="table1">
                                <div class="row mt-3 mb-2">
                                    <div class="col h4 text-right rtl-align-left">{{__('Code :')}}</div>
                                    <div class="col text-left" id="coupon_code"></div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col h4 text-right rtl-align-left">{{__('Maximum use :')}}</div>
                                    <div class="col text-left" id="coupon_max_use"></div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col h4 text-right rtl-align-left">{{__('Used :')}}</div>
                                    <div class="col text-left" id="coupon_use_count"></div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col h4 text-right rtl-align-left">{{__('Type :')}}</div>
                                    <div class="col text-left" id="coupon_type"></div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col h4 text-right rtl-align-left">{{__('Discount :')}}</div>
                                    <div class="col text-left" id="coupon_discount"></div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col h4 text-right rtl-align-left">{{__('Start date :')}}</div>
                                    <div class="col text-left" id="coupon_start_date"></div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col h4 text-right rtl-align-left">{{__('End date :')}}</div>
                                    <div class="col text-left" id="coupon_end_date"></div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col h4 text-right rtl-align-left">{{__('Status :')}}</div>
                                    <div class="col text-left" id="coupon_status"></div>
                                </div>
                            </div>

                            @can('coupon_edit')
                                <div class="text-center">
                                    <button type="button" id="edit_btn" onclick="" class="btn edit_coupon_btn btn-primary mt-4 mb-5">{{ __('Edit Coupon') }}</button>
                                </div>
                            @endcan
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>