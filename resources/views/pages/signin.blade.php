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

    <!--Bootstrap CSS-->
    <link rel="stylesheet" href="{{ URL::asset('template/assets/css/bootstrap.min.css') }}">
    <!--Custom style.css-->
    <link rel="stylesheet" href="{{ URL::asset('template/assets/css/quicksand.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('template/assets/css/style.css') }}">
    <!--Font Awesome-->
    <link rel="stylesheet" href="{{ URL::asset('template/assets/css/fontawesome-all.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('template/assets/css/fontawesome.css') }}">
    
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
            <h1 class="text-center mb-5"><i class="fa fa-handshake-o " aria-hidden="true"></i> Meeting Room Booking System</h1>    
            <div class="row">
                <div class="col-md-6 col-sm-6 col-12 login-box-info">
                    <br><br>
                    <p></p><p></p>
                    <img class="text-center" src="{{ URL::asset('template/assets/img/guardian.png') }}" width="240" height="80" alt="">
                    <!-- <p class="mb-4">Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch.</p>
                    <p class="text-center"><a href="" class="btn btn-light">Register here</a></p> -->
                </div>
                <div class="col-md-6 col-sm-6 col-12 login-box-form p-4">
                    <h3 class="mb-2">Login</h3>
                    
                    <small class="text-muted bc-description">Sign in with your credentials</small>
                    <form action="" class="mt-2">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><i class="fa fa-envelope-o"></i></span>
                            </div>
                            <input type="text" class="form-control mt-0" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1">
                        </div>

                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><i class="fa fa-lock"></i></span>
                            </div>
                            <input type="text" class="form-control mt-0" placeholder="Password" aria-label="Password" aria-describedby="basic-addon1">
                        </div>

                        <div class="form-group">
                            <button class="btn btn-theme btn-block p-2 mb-1">Login</button>
                            <!-- <a href="#">
                                <small class="text-theme"><strong>Forgot password?</strong></small>
                            </a> -->
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
  </body>
</html>