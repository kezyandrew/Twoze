<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="base_url" content="{{ url('/') }}">
    
    <!-- Dynamic color -->
    <?php $color = \App\Models\AppSetting::first()->color; ?>
    <style>
        :root{
            --primary_color : <?php echo $color ?>;
            --primary_color_hover : <?php echo $color.'cc' ?>;
        }
    </style>

    <!-- Title -->
    <?php $app_name = \App\Models\AppSetting::first()->app_name; ?>
    <title>{{ $app_name }}</title>

    <!-- Favicon -->
    <?php $favicon = \App\Models\AppSetting::first()->favicon; ?>
    <link href="{{asset('/images/app/'.$favicon)}}" rel="icon" type="image/png">

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">

    <!-- Argon CSS -->
    <link rel="stylesheet" href="{{ asset('admin/css/nucleo.css')}}">
    <link rel="stylesheet" href="{{ asset('admin/css/bootstrap-wysihtml5.css')}}">
    <link rel="stylesheet" href="{{ asset('admin/css/sweetalert2.scss')}}" type="text/plain">
    

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css" integrity="sha512-1PKOgIY59xJ8Co8+NE6FZ+LOAZKjy+KY8iq0G4B3CyeY6wYHN3yt9PW0XpSriVlkMXe40PTKnXrLnZ9+fkDaog==" crossorigin="anonymous" />
    {{-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous"> --}}
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/jszip-2.5.0/dt-1.10.21/b-1.6.2/b-flash-1.6.2/b-html5-1.6.2/b-print-1.6.2/datatables.min.css" />
    {{-- <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.15/dist/summernote.min.css" rel="stylesheet"> --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.css"/>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('admin/css/argon.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('admin/css/mystyle.css') }}" type="text/css">

    @if (session('direction') == "rtl")
        <link href="{{ asset('admin/css/rtl.css')}}" rel="stylesheet">
    @endif

    <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.js"></script>
    
</head>
<body>
    @if (Request::url() != url('/admin/calendar'))
        <div class="preload">
            <div class="flexbox">
                <div>
                    <div class="reverse-spinner"></div>
                </div>
            </div>          
        </div>
        <div class="for-loader">
    @endif
    @auth()
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
        @include('layouts.sidebar')
    @endauth
    
    <div class="main-content">

        @include('layouts.navbar')
         
        <?php $license_status = \App\Models\AppSetting::first()->license_status; ?>
        @if ($license_status == 1)
            @yield('content')
            @yield('content_setting')
        @else
            <script>
                var base_url = $('meta[name=base_url]').attr("content");
                var curr_url = window.location.href;
                var set_url = base_url+'/admin/setting';
                if (curr_url != set_url)
                {
                    setTimeout(() => {
                        Swal.fire({
                          icon: 'error',
                          title: 'Oops...',
                          text: 'Your License has been deactivated...!!',
                          onClose: () => {
                              window.location.replace(set_url);
                            }
                          })
                    }, 1000);
                }
            </script>
            @yield('content_setting')
        @endif

        @include('layouts.footer')
    </div>

    <script src="{{ asset('admin/js/Chart.min.js') }}"></script>
    <script src="{{ asset('admin/js/Chart.extension.js') }}"></script>
    <script src="{{ asset('admin/js/map.js') }}"></script>
    <?php $mapkey = \App\Models\AppSetting::first()->mapkey; ?>
    <script src="https://maps.googleapis.com/maps/api/js?key={{$mapkey}}" async defer></script>
    {{-- <script src="{{ asset('admin/js/jquery.min.js') }}"></script> --}}
    {{-- <script src="{{ asset('admin/js/jquery.scrollbar.min.js') }}"></script>
    <script src="{{ asset('admin/js/jquery-scrollLock.min.js') }}"></script> --}}
    <script src="{{ asset('admin/js/sweetalert.all.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/js/select2.min.js"></script>
    
    {{-- <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script> --}}
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/jszip-2.5.0/dt-1.10.21/b-1.6.2/b-flash-1.6.2/b-html5-1.6.2/b-print-1.6.2/datatables.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/notify/0.4.2/notify.min.js" integrity="sha512-efUTj3HdSPwWJ9gjfGR71X9cvsrthIA78/Fvd/IN+fttQVy7XWkOAXb295j8B3cmm/kFKVxjiNYzKw9IQJHIuQ==" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://cdn.jsdelivr.net/npm/promise-polyfill@8/dist/polyfill.js"></script>
    

    
    <script src="{{ asset('admin/js/wysihtml5-0.3.0.js') }}"></script>
    <script src="{{ asset('admin/js/bootstrap-wysihtml5.js') }}"></script>

    <script src="{{ asset('admin/js/argon.js') }}"></script>
    <script src="{{ asset('admin/js/myjavascript.js') }}"></script>
    
    @if (Request::url() != url('/admin/calendar'))
        </div>
    @endif
</body>
</html>
