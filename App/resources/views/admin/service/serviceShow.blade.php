<div class="container-fluid sidebar_open @if($errors->any()) show_sidebar @endif" id="show_service_sidebar">
    <div class="row">
        <div class="col">
            <div class="card py-3 border-0">
                <!-- Card header -->
                <div class="border_bottom_primary pb-3 pt-2 mb-4">
                    <span class="h3">{{__('View Service')}}</span>
                    <button type="button" class="show_service_close close">&times;</button>
                </div>
                
                <div class="card card-profile shadow">
                    <div class="card-body p-2">
                        <div class="text-center">
                            
                            <img src="" class="my-3 service_img">
                            <div id="service_name" class="mb-3"></div>
                            <div> {{__('Price :')}} <span id="price1"></span></div>
                            <div class="mt-3">{{__('Status :')}} <span id="service_status"></span></div>
                            @can('service_edit')
                                <div class="text-center">
                                    <button type="button" id="edit_btn" onclick="" class="btn edit_service_btn btn-primary mt-4 mb-5">{{ __('Edit Service') }}</button>
                                </div>
                            @endcan
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>