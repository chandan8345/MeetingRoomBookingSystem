<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="description" content="" >
    <meta name="author" content="">
    <meta name="keywords" content="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <!--Meta Responsive tag-->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="shortcut icon" type="image/x-icon" href="{{ URL::asset('template/assets/img/guardian_logo.png') }}" />
    <!--Bootstrap CSS-->
    <link rel="stylesheet" href="{{ URL::asset('template/assets/css/bootstrap.min.css') }}">
    <!--Custom style.css-->
    <link rel="stylesheet" href="{{ URL::asset('template/assets/css/quicksand.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('template/assets/css/style.css') }}">
    <!--Font Awesome-->
    <link rel="stylesheet" href="{{ URL::asset('template/assets/css/fontawesome-all.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('template/assets/css/fontawesome.css') }}">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/font-awesome-animation/0.3.0/font-awesome-animation.min.css">
    
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <title>GLIL - MRBS</title>
  </head>

  <body class="login-body">
    
    <!--Login Wrapper-->

    <div class="container-fluid login-wrapper">
        <div class="login-box">
            <h2 class="text-center mb-5 signin"></i> Meeting Room Booking System</h2>
            <h1 class="text-center mb-0 welcomeTxt"></i> Guardian Life Insurance Ltd.</h1> 
            <h5 class="text-center mb-0 welcomeTxt"></i> Meeting Room Booking System</h5>
            <div  class="container-fluid welcomeTxt" style="padding-top:10px;">
            <div class="row justify-content-center">
            <button type="button" onclick="loginform()" class="btn btn-primary btn-sm" style="width: 50px; height: 50px; padding: 7px 10px; border-radius: 25px; font-size: 20px; 
            text-align: center;"><i class="fa fa-sign-in faa-horizontal animated"></i></button>
            </div>
            </div>
            <!-- <img class="text-center" src="{{ URL::asset('template/assets/img/guardian.png') }}" width="240" height="80" alt="">   -->
            <div class="row">
                <div class="col-md-6 col-sm-6 col-12 login-box-info signin">
                    <br><br><br>
                    <p></p><p></p>
                    <img class="text-center" src="{{ URL::asset('template/assets/img/guardian.png') }}" width="240" height="80" alt="">
                    <!-- <p class="mb-4">Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch.</p>
                    <p class="text-center"><a href="" class="btn btn-light">Register here</a></p> -->
                </div>
                <div class="col-md-6 col-sm-6 col-12 login-box-form p-4  signin">
                    <h3 class="mb-2">Login</h3>
                    
                    <small class="text-muted bc-description">Sign in with your credentials</small>
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><i class="fa fa-envelope-o"></i></span>
                            </div>
                            <input type="email" name="email" class="form-control mt-0" placeholder="Email" aria-label="Email"  value="{{ old('email') }}" aria-describedby="basic-addon1" required>
                        </div>

                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><i class="fa fa-lock"></i></span>
                            </div>
                            <input type="password" name="password" class="form-control mt-0" placeholder="Password" aria-label="Password" aria-describedby="basic-addon1" required>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-theme btn-block p-2 mb-1">{{ __('Login') }}</button>
                            <!-- <a href="#">
                                <small id="one" class="text-danger"><strong>Your email or password was incorrect</strong></small>
                                <small id="both" class="text-danger"><strong>Your email and password was incorrect</strong></small>
                            </a> -->
                            @error('email')
                            <small class="text-danger" style="padding-top:2px;"><strong>{{ $message }}</small>
                            @enderror
                            @error('password')
                            <small class="text-danger" style="padding-top:2px;"><strong>{{ $message }}</small>
                            @enderror
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>    

    <!--Login Wrapper-->

    <!-- Page JavaScript Files-->
    <script src="{{ URL::asset('template/assets/js/jquery.min.js') }}"></script>
    <script src="{{ URL::asset('template/assets/js/jquery-1.12.4.min.js') }}"></script>
    <!--Popper JS-->
    <script src="{{ URL::asset('template/assets/js/popper.min.js') }}"></script>
    <!--Bootstrap-->
    <script src="{{ URL::asset('template/assets/js/bootstrap.min.js') }}"></script>

    <!--Custom Js Script-->
    <script src="{{ URL::asset('template/assets/js/custom.js') }}"></script>
    <!--Custom Js Script-->
    <script>
        $('.signin').hide();
        $('.welcomeTxt').show();
        $('#one').hide();
        $('#both').hide();
        $('#login-form').on('submit', function (e) {
        e.preventDefault();
        $.ajax({
            type: 'POST',
            url: '{{ url('/login') }}',
            data: $("#login-form").serialize(),
            success: function (response) {
                if(response == 2){
                    window.location.href = "{{ url('/dashboard') }}";
                }else if(response == 1){
                    $('#one').show(50);
                    $('#both').hide();
                }else{
                    $('#one').hide();
                    $('#both').show(50);
                }
            },
            error: function (error) {
                console.log('error');
            }
        });
	});

    function loginform(){
        $('.signin').show();
        $('.welcomeTxt').hide();
    }
    </script>
  </body>
</html>