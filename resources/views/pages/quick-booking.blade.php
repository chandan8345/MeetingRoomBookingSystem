@extends('main')

@section('tabname','MRBS | Quick Booking')

@section('username','CK BISWAS')

@section('designation','Assistant Officer')

@section('page-title','Quick Booking')

@section('main-content')
<h5 class="mb-0"><strong>@yield('page-title')</strong></h5>
<!-- <span class="text-secondary">Booking <i class="fa fa-angle-right"></i> @yield('page-title')</span> -->

<div class="row mt-3">
    <div class="col-sm-12">
        <!--Default elements-->
        <div class="mt-1 mb-3 p-3 button-container bg-white border shadow-sm">
            <div id="message" class="alert alert-danger" role="alert">
                Meeting Date cannot can not be before Today
            </div>
            <!-- <h6 class="mb-2">Basic input types</h6>
                            <p>use class <span class="text-danger">.form-control</span> with input</p>
                             -->
            <form id="addbooking">
                {{ csrf_field() }}
                <input type="hidden" value="{{ date('Y-m-d') }}" name="" id="today">
                <br>
                <div class="form-group row">
                    <label class="control-label col-sm-2" for="input-1">Purpose of Meeting</label>
                    <div class="col-sm-10">
                        <input type="text" name="purpose" class="form-control" id="input-1"
                            placeholder="write down someting" required />
                    </div>
                </div>
                <div class="form-group row">
                    <label class="control-label col-sm-2" for="input-2">Meeting Date</label>
                    <div class="col-sm-10">
                        <input type="date" id="date" min="<?php echo date('m-d-Y');?>" name="meetingdate"
                            class="form-control" id="input-2" placeholder="pick the date here" required />
                    </div>
                </div>
                <div class="form-group row">
                    <label class="control-label col-sm-2" for="input-3">Meeting Time</label>
                    <div class="col-sm-10">
                        <input type="time" name="meetingtime" min="09:00" max="18:00" class="form-control" id="input-3"
                            placeholder="pick the time here" required />
                    </div>
                </div>
                <div class="form-group row">
                    <label for="exampleFormControlSelect1" class="control-label col-sm-2">Duration</label>
                    <div class="col-sm-10">
                        <select class="form-control" name="duration" id="exampleFormControlSelect1" required>
                            <option value="">Choose Duration</option>
                            <option value="30 Mins">30 Mins</option>
                            <option value="1 Hour">1 Hour</option>
                            <option value="2 Hour">2 Hour</option>
                            <option value="3 Hour">3 Hour</option>
                            <option value="4 Hour">4 Hour</option>
                            <option value="5 Hour">5 Hour</option>
                            <option value="6 Hour">6 Hour</option>
                            <option value="Full Day">Full Day</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="control-label col-sm-2" for="input-3">Total People</label>
                    <div class="col-sm-10">
                        <input type="number" name="total" min="2" class="form-control" id="input-3"
                            placeholder="How many people concern here" required />
                    </div>
                </div>
                <div class="form-group row">
                    <label for="exampleFormControlSelect1" class="control-label col-sm-2">Choose Room</label>
                    <div class="col-sm-10">
                        <select name="room" class="form-control" id="exampleFormControlSelect1" required>
                            <option value="">Choose Room</option>
                            @foreach($rooms as $room)
                            <option value="{{ $room->id }}">{{ $room->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="exampleFormControlSelect1" class="control-label col-sm-2">Meeting Category</label>
                    <div class="col-sm-10">
                        <select name="category" class="form-control" id="exampleFormControlSelect1" required>
                            <option value="">Select Category</option>
                            @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="exampleFormControlSelect1" class="control-label col-sm-2">Meeting Type</label>
                    <div class="col-sm-10">
                        <select name="meetingtype" class="form-control" id="exampleFormControlSelect1" required>
                            <option value="0">Select Type</option>
                            <option value="Internal">Internal</option>
                            <option value="External">External</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="control-label col-sm-2" for="input-6"> Remarks</label>
                    <div class="col-sm-10">
                        <textarea rows="2" name="remarks" class="form-control" id="input-11"
                            placeholder="write down the requirments of your meeting"></textarea>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="control-label col-sm-2" for="input-6">Other Requests</label>
                    <div class="col-sm-10">
                        <div class="row">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" name="coffee" value="Yes" class="custom-control-input"
                                    id="customCheck1">
                                <label class="custom-control-label" for="customCheck1">Coffee</label>
                            </div>
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" name="snacks" value="Yes" class="custom-control-input"
                                    id="customCheck2">
                                <label class="custom-control-label" for="customCheck2">Snacks</label>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="form-group row">
                    <label class="control-label col-sm-2" for="input-6"></label>
                    <div class="col-sm-10">
                        <button class="btn btn-primary" type="submit">Save</button>
                    </div>
                </div>
            </form>
        </div>
        <!--/Default elements-->
    </div>
</div>
@stop

@section('head')
<meta name="csrf-token" content="{{ csrf_token() }}">
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
    $("#message").hide();
    $('#addbooking').on('submit', function (e) {
        e.preventDefault();
        if ($('#date').val() >= $('#today').val()) {
            $("#message").hide();
                    $.ajax({
                        type: "POST",
                        url: "{{ URL::to('/booking') }}",
                        data: $("#addbooking").serialize(),
                        success: function (response) {
                            swal('Done!', "Booking Request placed successfully", "success");
                            $("#addbooking").trigger('reset');
                            console.log(response);
                        },
                        error: function (error) {
                            swal('Error!', "Something went Wrong, Please Try Again.", "error");
                            console.log('error');
                        }
                    });
        } else {
            e.preventDefault();
            $("#message").show(1);
        }
    });
</script>
@stop