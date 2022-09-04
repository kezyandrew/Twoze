<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        
        <!-- Title -->
        <?php $app_name = \App\Models\AppSetting::first()->app_name; ?>
        <title>{{ $app_name }}</title>
        
         <!-- Dynamic color -->
        <?php $color = \App\Models\AppSetting::first()->color; ?>
        <style>
            :root{
                --primary_color : <?php echo $color ?>;
                --primary_color_hover : <?php echo $color.'cc' ?>;
            }
        </style>
            
        <!-- Favicon -->
        <?php $favicon = \App\Models\AppSetting::first()->favicon; ?>
        <link href="{{asset('/images/app/'.$favicon)}}" rel="icon" type="image/png">

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700">

        <!-- Icons -->
        <link rel="stylesheet" href="{{ asset('admin/css/nucleo.css') }}" type="text/css">
        <link rel="stylesheet" href="{{ asset('admin/css/all.min.css') }}" type="text/css">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800&display=swap" rel="stylesheet">

        <!--  CSS -->
        <link rel="stylesheet" href="{{ asset('admin/css/login.css') }}" type="text/css">
    </head>

    
<body class="login">

    <section class="main-area">
        <div class="container-fluid">
            <div class="row h100">
                <?php $bg_img = \App\Models\AppSetting::first()->bg_img; ?>
                <div class="col-md-6 p-0 m-none" style="background: url({{asset('/images/app/'.$bg_img)}}) center center;background-size: cover;background-repeat: no-repeat;">
                    <span class="mask bg-gradient-dark opacity-6"></span>
                </div>

                <div class="col-md-6 p-0">
                    <div class="login">
                        <div class="center-box">
                            <div class="logo">
                                <?php $color_logo = \App\Models\AppSetting::first()->color_logo; ?>
                                <img src="{{asset('/images/app/'.$color_logo)}}" class="logo-img">
                            </div>
                            <div class="title">
                                
                                <h4 class="login_head">{{__('Admin Login')}}</h4>
                                <p class="login-para">{{__('This is a secure system and you will need to provide your')}} <br>
                                    {{__('login details to access the site.')}}</p>
                            </div>
                            <div class="form-wrap">
                                <form role="form" class="pui-form" id="loginform"  method="POST" action="{{url('/admin_login_check')}}">
                                @csrf
                                    <div class="pui-form__element">
                                        <label class="animated-label {{ old('email') != null ? 'moveUp': '' }}">{{__('Email')}}</label>
                                        <input id="inputEmail" name="email" type="email" class="form-control   {{ old('email') != null ? 'outline': '' }} @error('email') is-invalid @enderror"  value="{{ old('email') }}" placeholder="">
                                            
                                    </div>
                                    <div class="pui-form__element">
                                        <label class="animated-label">{{__('Password')}}</label>
                                        <input id="inputPassword" type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="">
                                            
                                    </div>
                                    @if($errors->any())
                                        <br><h4 class="text-center text-red">{{$errors->first()}}</h4><br>
                                    @endif
                                    <div class="pui-form__element">
                                        <button class="btn btn-lg btn-primary btn-block btn-salon" type="submit">{{__('SIGN IN')}}</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
        crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="{{ asset('admin/js/myjavascript.js')}}"></script>
</body>
 
</html>