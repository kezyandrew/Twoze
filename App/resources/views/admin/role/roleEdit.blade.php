<div class="container-fluid sidebar_open @if($errors->any()) show_sidebar_edit @endif" id="edit_role_sidebar">
    <div class="row">
        <div class="col">
            <div class="card py-3 border-0">
                <!-- Card header -->
                <div class="border_bottom_primary pb-3 pt-2 mb-4">
                    <span class="h3">{{__('Edit Role')}}</span>
                    <button type="button" class="edit_role_close close">&times;</button>
                </div>
                <form class="form-horizontal"  id="edit_role_form" method="post" enctype="multipart/form-data" action="#">
                    @csrf
                    @method('put')

                    <div class="my-0">
                        <div class="form-group">
                            <label class="form-control-label" for="title">{{__('Role Title')}}</label>
                            <input type="text" value="{{ old('title') }}" name="title" id="title" class="form-control" placeholder="{{__('Role Title')}}" readonly>
                            <div class="invalid-div "><span class="title"></span></div>
                        </div>
                    
                        
                        <div class="form-group">
                            <label class="form-control-label" for="permission">{{__('Select Permissions')}}</label>
                            <select class="form-control select2" dir="{{ session()->has('direction')&& session('direction') == 'rtl'? 'rtl':''}}" id="select_multiple" multiple="multiple" name="permission[]" data-placeholder='{{ __("-- Select Permissions --")}}'>
                                @foreach ($permissions as $per)
                                    <option value={{$per->id}}>{{$per->title}}</option>
                                @endforeach
                            </select>
                            <div class="invalid-div "><span class="permission"></span></div>
                        </div>
                        
                        <input type="hidden" name="id">
                        
                        <div class="text-center">
                            <button type="button" id="edit_btn" onclick="all_edit('edit_role_form','role')" class="btn btn-primary mt-4 mb-5">{{ __('Save Changes') }}</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>