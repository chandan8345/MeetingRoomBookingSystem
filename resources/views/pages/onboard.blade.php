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
            <h1 class="text-center mb-0 welcomeTxt"></i> Guardian Life Insurance Ltd.</h1> 
            <h5 class="text-center mb-0 welcomeTxt"></i> Meeting Room Booking System</h5>
            <div  class="container-fluid welcomeTxt" style="padding-top:10px;">
            <div class="row justify-content-center">
            <button type="button" onclick="loginform()" class="btn btn-primary btn-sm" style="width: 50px; height: 50px; padding: 7px 10px; border-radius: 25px; font-size: 20px; 
            text-align: center;"><i class="fa fa-sign-in faa-horizontal animated"></i></button>
            </div>
            </div>
            <!-- <img class="text-center" src="{{ URL::asset('template/assets/img/guardian.png') }}" width="240" height="80" alt="">   -->
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
    $('.welcomeTxt').show();
    function loginform(){
        window.location = "{{ URL::to('/login') }}";
    }
    </script>
  </body>
</html>