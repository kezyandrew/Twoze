<?php $bg_img = \App\Models\AppSetting::first()->bg_img; ?>

<div class="header pt-7" style="background-image: url({{asset('/images/app/'.$bg_img)}}); background-size: cover; background-position: center center;">
    <span class="mask bg-gradient-dark opacity-7"></span>
    <div class="container-fluid">
      <div class="header-body">
        <div class="row align-items-center py-4 pb-7">
          <div class="col-lg-6 col-7">
            <h6 class="h2 text-white d-inline-block mb-0">{{$title}}</h6>
            <nav aria-label="breadcrumb" class="d-none d-md-inline-block">
              <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                  <li class="breadcrumb-item text-white"><a href="{{url('admin/dashboard')}}"><i class="fa fa-home text-primary"></i></a></li>
                
                @if (isset($headerData) && $headerData)
                    <li class="breadcrumb-item text-white"><a href="{{url($url)}}" class="">{{$headerData}}</a></li>
                @endif

                <li class="breadcrumb-item active text-white" aria-current="page"> {{$title}} </li>
              </ol>
            </nav>
          </div>
        </div>
      </div>
    </div>
</div>