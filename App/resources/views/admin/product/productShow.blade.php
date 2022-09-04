<div class="container-fluid sidebar_open @if($errors->any()) show_sidebar @endif" id="show_product_sidebar">
    <div class="row">
        <div class="col">
            <div class="card py-3 border-0">
                <!-- Card header -->
                <div class="border_bottom_primary pb-3 pt-2 mb-4">
                    <span class="h3">{{__('View Product')}}</span>
                    <button type="button" class="show_product_close close">&times;</button>
                </div>
                
                <div class="card card-profile shadow">
                    <div class="card-body p-2">
                        <div class="text-center">
                            <img src="" class="my-3 product_img">
                            
                            <div class="table1">
                                <div class="row mt-1 mb-1">
                                    <div class="col h4 text-right rtl-align-left">{{__('Name :')}}</div>
                                    <div class="col text-left" id="product_name"></div>
                                </div>  
                                <div class="row mt-1 mb-1">
                                    <div class="col h4 text-right rtl-align-left">{{__('Price :')}}</div>
                                    <div class="col text-left" id="product_price"></div>
                                </div>  
                                <div class="row mt-1 mb-1">
                                    <div class="col h4 text-right rtl-align-left">{{__('Services :')}}</div>
                                    <div class="col text-left" id="all_services"></div>
                                </div>  
                                <div class="row mt-1 mb-1">
                                    <div class="col h4 text-right rtl-align-left">{{__('Status :')}}</div>
                                    <div class="col text-left" id="product_status"></div>
                                </div>
                            </div>
                            @can('product_edit')
                                <div class="text-center">
                                    <button type="button" id="edit_btn" onclick="" class="btn edit_product_btn btn-primary mt-4 mb-5">{{ __('Edit Product') }}</button>
                                </div>
                            @endcan
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>