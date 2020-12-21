@extends('main')

@section('tabname','MRBS | Profile')

@section('page-title','Profile')

@section('main-content')
<h5 class="mb-0" ><strong>@yield('page-title')</strong></h5>
                @foreach($profiles as $profile)
                <div class="row mt-3">
                    <div class="col-sm-12">
                        <!--User profile header-->
                        <div class="mt-1 mb-3 button-container bg-white border shadow-sm">
                            <div class="profile-bg p-5">
                                <img src="{{ URL::asset('/img/user.jpg') }}" height="125px" width="125px" class="rounded-circle shadow profile-img" />
                            </div>
                            <div class="profile-bio-main container-fluid">
                                <div class="row">
                                    <div class="col-md-5 offset-md-3 col-sm-12 offset-sm-0 col-12 bio-header">
                                        <h3 class="mt-4">{{ $profile->name }}</h3>
                                        <span class="text-muted mt-0 bio-request">{{ $profile->designation }}</span>
                                    </div>
                                    <div class="col-md-4 col-sm-12 col-12 px-5 text-right pt-4 bio-comment">
                                        <button type="button" class="btn btn-default">
                                            <i class="far fa-comment"></i>
                                        </button>
                                        <button type="button" onclick="update()" class="btn btn-warning">UPDATE</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--/User profile header-->

                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-sm-12">
                        <!--Default elements-->
                        <div class="mt-1 mb-3 p-3 button-container bg-white border shadow-sm">
                            <h6 class="mb-2"></h6>
                            
                            <form class="form-horizontal mt-4 mb-5">
                                <div class="form-group row">
                                    <label class="control-label col-sm-2" for="input-1">Full Name</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="input-1" placeholder="John Doe" value="{{ $profile->name }}"/>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label col-sm-2" for="input-2">Email</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="input-2" placeholder="johndoe@gmail.com"  value="{{ $profile->eamil }}"/>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label col-sm-2" for="input-4">Mobile No</label>
                                    <div class="col-sm-10">
                                        <input type="number" id="input-4" class="form-control" placeholder="number"  value="{{ $profile->mobile }}"/>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label col-sm-2" for="input-3">Staff ID</label>
                                    <div class="col-sm-10">
                                        <input type="number" class="form-control" id="input-3" placeholder="Search keywords"  value="{{ $profile->staffid }}"/>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label col-sm-2" for="input-4">Designation</label>
                                    <div class="col-sm-10">
                                        <input type="text" id="input-4" class="form-control" placeholder="number"  value="{{ $profile->designation }}"/>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label col-sm-2" for="input-5">Department</label>
                                    <div class="col-sm-10">
                                        <input type="text" id="input-4" class="form-control" placeholder="number"  value="{{ $profile->department }}"/>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label col-sm-2" for="input-7">Password*</label>
                                    <div class="col-sm-10">
                                        <input type="password" class="form-control" id="input-7" placeholder="" />
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label col-sm-2" for="input-7">New Password</label>
                                    <div class="col-sm-10">
                                        <input type="password" class="form-control" id="input-7" placeholder="" />
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label col-sm-2" for="exampleFormControlFile1">Image Upload</label>
                                    <div class="col-sm-10">
                                        <input type="file" class="form-control" id="exampleFormControlFile1">
                                    </div>
                                </div>
                            </form>
                        </div>
                        <!--/Default elements-->
                    </div>
                </div>
                @endforeach
@stop

@section('head')
@include('section.head')
@stop

@section('loader')
@include('section.loader')
@stop

@section('logo')
@include('section.logo')
@stop

@section('header')
@include('section.header')
@stop

@section('sidebar')
@include('section.sidebar')
@stop

@section('footer')
@include('section.footer')
@stop

@section('bottom')
@include('section.bottom')
<script>
    function update(){
        swal('Coming Soon!'," profile update not available now", "error");
    }
</script>
@stop