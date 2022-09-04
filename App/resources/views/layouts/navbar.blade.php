<nav class="navbar navbar-top navbar-expand navbar-dark">
    <div class="container-fluid">
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        
        <!-- Navbar links -->
        <ul class="navbar-nav align-items-center ml-md-auto ">
          <li class="nav-item d-xl-none">
            <!-- Sidenav toggler -->
            <div class="pr-3 sidenav-toggler sidenav-toggler-dark" data-action="sidenav-pin" data-target="#sidenav-main">
              <div class="sidenav-toggler-inner">
                <i class="sidenav-toggler-line"></i>
                <i class="sidenav-toggler-line"></i>
                <i class="sidenav-toggler-line"></i>
              </div>
            </div>
          </li>
          <li class="nav-item d-sm-none">
            <a class="nav-link" href="#" data-action="search-show" data-target="#navbar-search-main">
              <i class="ni ni-zoom-split-in"></i>
            </a>
          </li>
        </ul>
        <?php
        $langs = \App\Models\Language::where('status',1)->get();
        $icon = \App\Models\Language::where('name',session('locale'))->first();
        if($icon){
          $lang_image="/images/language/".$icon->image;
        }
        else{
          $lang_image="/images/language/English.jpg";
        }
      ?>
       <ul class="navbar-nav align-items-center  ml-auto ml-md-0 flag-ul mt-3">
        <li class="nav-item dropdown rtl-flag">
          <a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <div class="media align-items-center">
              <span class="avatar avatar-sm">
                <img class="small_round flag" src="{{asset($lang_image)}}">
              </span>
            </div>
          </a>
          <div class="dropdown-menu  dropdown-menu-right dropdown-menu-flag ">
            <div class="dropdown-header noti-title">
              <h6 class="text-overflow m-0">{{__('Language')}}</h6>
            </div>
              @foreach ($langs as $lang)
              <a href="{{url('/admin/language/'.$lang->name)}}" class="dropdown-item">
                <span class="avatar avatar-sm">
                  <img class="small_round flag" src="{{asset('images/language/'.$lang->image)}}">
                </span>
                <span>{{$lang->name}}</span>
              </a>
              @endforeach
          </div>
        </li>
      </ul>

        <ul class="navbar-nav align-items-center ml-auto ml-md-0 ">
          <li class="nav-item dropdown">
            <a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <div class="media align-items-center">
                <span class="avatar avatar-sm rounded-circle rtl-avatar">
                  <img class="small_round" src="{{asset('/images/user/'.Auth()->user()->image)}}">
                </span>
                <div class="media-body  ml-2  d-none d-lg-block">
                  <span class="mb-0 text-sm  font-weight-bold"> {{ Auth()->user()->name }} </span>
                </div>
              </div>
            </a>
            <div class="dropdown-menu  dropdown-menu-right ">
              <div class="dropdown-header noti-title">
                <h6 class="text-overflow m-0">{{__('Welcome!')}}</h6>
              </div>
                <a href="{{url('/admin/profile/'.Auth::user()->id)}}" class="dropdown-item">
                  <i class="ni ni-single-02"></i>
                  <span>{{__('My profile')}}</span>
                </a>
              
              <div class="dropdown-divider"></div>
                  <a href="{{url('/admin/logout/')}}" class="dropdown-item">
                    <i class="ni ni-user-run"></i>
                    <span>{{ __('Logout') }}</span>
                  </a>
            </div>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  