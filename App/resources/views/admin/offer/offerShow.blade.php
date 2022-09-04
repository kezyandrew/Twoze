<div class="container-fluid sidebar_open @if($errors->any()) show_sidebar @endif" id="show_offer_sidebar">
    <div class="row">
        <div class="col">
            <div class="card py-3 border-0">
                <!-- Card header -->
                <div class="border_bottom_primary pb-3 pt-2 mb-4">
                    <span class="h3">{{__('View Offer')}}</span>
                    <button type="button" class="show_offer_close close">&times;</button>
                </div>
                
                <div class="card card-profile shadow ">
                    <div class="card-body p-2">
                        <div class="text-center">
                            
                            <img src="" class="my-3 offer_img">
                            <div id="offer_title1"></div>
                            <div>Upto <span id="offer_type_amount"></span><span id="offer_discount"></span><span id="offer_type_percentage"></span> </div>
                            <div id="offer_title2"></div>
                            <div class="mt-3">{{__('Status :')}} <span id="offer_status"></span></div>
                            @can('offer_edit')
                                <div class="text-center">
                                    <button type="button" id="edit_btn" onclick="" class="btn edit_offer_btn btn-primary mt-4 mb-5">{{ __('Edit Offer') }}</button>
                                </div>
                            @endcan
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>