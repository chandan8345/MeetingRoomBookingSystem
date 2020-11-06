@extends('main')

@section('tabname','MRBS | Rooms')

@section('username','CK BISWAS')

@section('designation','Assistant Officer')

@section('page-title','Schedule')

@section('main-content')
<h5 class="mb-0" ><strong>@yield('page-title')</strong></h5>
                <span class="text-secondary">Dashboard <i class="fa fa-angle-right"></i> @yield('page-title')</span>
                
<div class="row mt-3">
                    <div class="col-md-12 col-sm-12">
                        <!--Full Calendar-->
                        <div class="mt-1 mb-3 p-3 button-container bg-white border shadow-sm lh-sm">
                            <div class="email-msg">
                                
                                <div class="table-responsive" id="calendarFull"></div>

                            </div>
                        </div>

                    </div>
                </div>

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
@stop