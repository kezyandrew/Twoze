<?php $color_logo = \App\Models\AppSetting::first()->color_logo; ?>

<nav class="navbar navbar-vertical fixed-left navbar-expand-md navbar-light bg-white" id="sidenav-main">
    <div class="container-fluid">
        
        <!-- Toggler -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#sidenav-collapse-main" aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        
        <!-- Brand -->
        <a class="navbar-brand pt-0" href="{{url('admin/dashboard')}}">
            <img src="{{asset('/images/app/'.$color_logo)}}" class="navbar-brand-img" alt="Admin Logo">
        </a>
        
        <!-- User -->
        <ul class="nav align-items-center d-md-none">
            <li class="nav-item dropdown">
                <a class="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <div class="media align-items-center">
                        <span class="avatar avatar-sm rounded-circle">
                        <img alt="Image placeholder" src="{{asset('/images/user/'.Auth()->user()->image)}}">
                        </span>
                    </div>
                </a>
                <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right">
                    <div class=" dropdown-header noti-title">
                        <h6 class="text-overflow m-0">{{ __('Welcome!') }}</h6>
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
        <!-- Collapse -->
        <div class="collapse navbar-collapse" id="sidenav-collapse-main">
            <!-- Collapse header -->
            <div class="navbar-collapse-header d-md-none">
                <div class="row">
                    <div class="col-6 collapse-brand">
                        <a class="navbar-brand pt-0" href="{{url('admin/dashboard')}}">
                            <img src="{{asset('/images/app/'.$color_logo)}}" class="navbar-brand-img" alt="Logo">
                        </a>
                    </div>
                </div>
            </div>

            {{-- Main Admin --}}
            <ul class="navbar-nav">

                @can('dashboard')
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('admin/dashboard*')  ? 'active' : ''}}" href="{{url('admin/dashboard')}}">
                            <i class="ni ni-tv-2 text-teal"></i>
                            <span class="nav-link-text">{{ __('Dashboard') }}</span>
                        </a>
                    </li>
                @endcan
                
                @can('role_access')
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('admin/role*')  ? 'active' : ''}}" href="{{url('admin/role')}}">
                            <i class="fa fa-user-secret text-green"></i>
                            <span class="nav-link-text">{{ __('Roles') }}</span>
                        </a>
                    </li>
                @endcan
                
                @can('user_access')
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('admin/user*')  ? 'active' : ''}}" href="{{url('admin/user')}}">
                            <i class="fa fa-users text-red"></i>
                            <span class="nav-link-text">{{ __('User') }}</span>
                        </a>
                    </li>
                @endcan
                
                @can('offer_access')
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('admin/offer*')  ? 'active' : ''}}" href="{{url('admin/offer')}}">
                            <i class="fa fa-gift text-yellow"></i>
                            <span class="nav-link-text">{{ __('Offer') }}</span>
                        </a>
                    </li>
                @endcan
                
                @can('service_access')
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('admin/service*')  ? 'active' : ''}}" href="{{url('admin/service')}}">
                            <i class="fas fa-list text-pink"></i>
                            <span class="nav-link-text">{{ __('Service') }}</span>
                        </a>
                    </li>
                @endcan
                
                @can('product_access')
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('admin/product*')  ? 'active' : ''}}" href="{{url('admin/product')}}">
                            <i class="fas fa-tshirt text-purple"></i>
                            <span class="nav-link-text">{{ __('Product') }}</span>
                        </a>
                    </li>
                @endcan
                
                @can('coupon_access')
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('admin/coupon*')  ? 'active' : ''}}" href="{{url('admin/coupon')}}">
                            <i class="fas fa-tag text-cyan"></i>
                            <span class="nav-link-text">{{ __('Coupon') }}</span>
                        </a>
                    </li>
                @endcan
                
                @can('order_access')
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('admin/order*')  ? 'active' : ''}}" href="{{url('admin/order')}}">
                            <i class="fa fa-shopping-cart text-orange"></i>
                            <span class="nav-link-text">{{ __('Order') }}</span>
                        </a>
                    </li>
                @endcan
                @can('calendar_access')
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('admin/calendar*')  ? 'active' : ''}}" href="{{url('admin/calendar')}}">
                            <i class="ni ni-calendar-grid-58 text-pink"></i>
                            <span class="nav-link-text">{{ __('Calendar') }}</span>
                        </a>
                    </li>
                @endcan
                
                @can('notification_access')
                @can('notification_edit')
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('admin/notification*')  ? 'active' : ''}}" href="#navbar-examples" data-toggle="collapse"  aria-expanded=" {{ request()->is('admin/notification*')  ? 'true' : ''}}" role="button" aria-controls="navbar-examples">
                            <i class="fa fa-bell text-blue"></i>
                            <span class="nav-link-text">{{__('Notification')}}</span>
                        </a>

                        <div class="collapse  {{ request()->is('admin/notification*')  ? 'show' : ''}}" id="navbar-examples">
                            <ul class="nav nav-sm flex-column">
                                <li class="nav-item">
                                    <a class="nav-link {{ request()->is('admin/notification/template')  ? 'active_text' : ''}}" href="{{url('admin/notification/template')}}">{{__('Template')}}</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ request()->is('admin/notification/send')  ? 'active_text' : ''}}" href="{{url('admin/notification/send')}}">{{__('Send Notification')}}</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                @endcan
                @endcan
                
                @can('report_access')
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('admin/report*')  ? 'active' : ''}}" href="#navbar-examples1" data-toggle="collapse"  aria-expanded=" {{ request()->is('admin/notification*')  ? 'true' : ''}}" role="button" aria-controls="navbar-examples">
                            <i class="fa fa-file text-red"></i>
                            <span class="nav-link-text">{{__('Report')}}</span>
                        </a>

                        <div class="collapse  {{ request()->is('admin/report*')  ? 'show' : ''}}" id="navbar-examples1">
                            <ul class="nav nav-sm flex-column">
                                <li class="nav-item">
                                    <a class="nav-link {{ request()->is('admin/report/usersReport')  ? 'active_text' : ''}}" href="{{url('admin/report/usersReport')}}">{{__('Users Report')}}</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ request()->is('admin/report/revenueReport')  ? 'active_text' : ''}}" href="{{url('admin/report/revenueReport')}}">{{__('Revenue Report')}}</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                @endcan

                @can('language_access')
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('admin/language*')  ? 'active' : ''}}" href="{{url('admin/language')}}">
                            <i class="fas fa-language text-green"></i>
                            <span class="nav-link-text">{{ __('Language') }}</span>
                        </a>
                    </li>
                @endcan
               

                @can('setting_access')
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('admin/setting*')  ? 'active' : ''}}" href="{{url('admin/setting')}}">
                            <i class="fa fa-cogs text-purple"></i>
                            <span class="nav-link-text">{{ __('Settings') }}</span>
                        </a>
                    </li>
                @endcan
                

            </ul>
        </div>
    </div>
</nav>
