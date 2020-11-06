@extends('main')

@section('tabname','MRBS | Quick Booking')

@section('username','CK BISWAS')

@section('designation','Assistant Officer')

@section('page-title','Quick Booking')

@section('main-content')
<h5 class="mb-0" ><strong>@yield('page-title')</strong></h5>
                <span class="text-secondary">Booking <i class="fa fa-angle-right"></i> @yield('page-title')</span>
                
                <div class="row mt-3">
                    <div class="col-sm-12">
                        <!--Default elements-->
                        <div class="mt-1 mb-3 p-3 button-container bg-white border shadow-sm">
                            <h6 class="mb-2">Basic input types</h6>
                            <p>use class <span class="text-danger">.form-control</span> with input</p>
                            
                            <form class="form-horizontal mt-4 mb-5">
                                <div class="form-group row">
                                    <label class="control-label col-sm-2" for="input-1">Default Input</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="input-1" placeholder="John Doe" />
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label col-sm-2" for="input-2">Email</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="input-2" placeholder="johndoe@gmail.com" />
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label col-sm-2" for="input-3">Search</label>
                                    <div class="col-sm-10">
                                        <input type="search" class="form-control" id="input-3" placeholder="Search keywords" />
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label col-sm-2" for="input-4">Number</label>
                                    <div class="col-sm-10">
                                        <input type="number" value="34" id="input-4" class="form-control" placeholder="number" />
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label col-sm-2" for="input-5">Date</label>
                                    <div class="col-sm-10">
                                        <input type="date" class="form-control" id="input-5" placeholder="11/11/2019" />
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label col-sm-2" for="input-6">Max Characters</label>
                                    <div class="col-sm-10">
                                        <input type="text" maxlength="5" class="form-control" id="input-6" placeholder="Maximum characters allowed is 5" />
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label col-sm-2" for="input-7">Password</label>
                                    <div class="col-sm-10">
                                        <input type="password" class="form-control" id="input-7" placeholder="*********" />
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label col-sm-2" for="input-8">Predefined Value</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="input-8" value="Predefined set value" placeholder="" />
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="exampleFormControlSelect1" class="control-label col-sm-2">Example select</label>
                                    <div class="col-sm-10">
                                        <select class="form-control" id="exampleFormControlSelect1">
                                            <option>Choose ...</option>
                                            <option>2</option>
                                            <option>3</option>
                                            <option>4</option>
                                            <option>5</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label col-sm-2" for="exampleFormControlFile1">File input</label>
                                    <div class="col-sm-10">
                                        <input type="file" class="form-control" id="exampleFormControlFile1">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label col-sm-2" for="input-9">Read Only Field</label>
                                    <div class="col-sm-10">
                                        <input type="text" readonly class="form-control" id="input-9" placeholder="read only" />
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label col-sm-2" for="input-10">Disabled Field</label>
                                    <div class="col-sm-10">
                                        <input type="text" disabled class="form-control" id="input-10" placeholder="Disabled" />
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label col-sm-2" for="input-11">Textarea</label>
                                    <div class="col-sm-10">
                                        <textarea rows="5" class="form-control" id="input-11" placeholder="Default Textarea"></textarea>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <!--/Default elements-->
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