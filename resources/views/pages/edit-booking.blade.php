@extends('main')

@section('tabname','MRBS | Update')

@section('page-title','Quick Update')

@section('main-content')
<h5 class="mb-0" ><strong>@yield('page-title')</strong></h5>
                <!-- <span class="text-secondary">Booking <i class="fa fa-angle-right"></i> @yield('page-title')</span> -->
                <div class="row mt-3">
                    <div class="col-sm-12">
                        <!--Default elements-->
                        <div class="mt-1 mb-3 p-3 button-container bg-white border shadow-sm">
                            <!-- <h6 class="mb-2">Basic input types</h6>
                            <p>use class <span class="text-danger">.form-control</span> with input</p>
                             -->
                             <br>
                             <form id="editbooking">
                             @foreach($posts as $post)
                            {{ csrf_field() }}
                            <input type="hidden" name="id" value="{{ $post->id }}">
                                <div class="form-group row">
                                    <label class="control-label col-sm-2" for="input-1">Purpose of Meeting</label>
                                    <div class="col-sm-10">
                                        <input type="text" value="{{ $post->purpose }}" name="purpose" class="form-control" id="input-1" placeholder="write down someting" required @if(Session::get("role") == 'admin') disabled @endif/>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="exampleFormControlSelect1" class="control-label col-sm-2">Choose Room</label>
                                    <div class="col-sm-10">
                                        <select name="room" class="form-control" id="exampleFormControlSelect1" required>
                                            <option value="">Choose Room</option>
                                            @foreach($rooms as $room)
                                            <option value="{{ $room->id }}" @if($post->room == $room->name) selected @endif >{{ $room->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label col-sm-2" for="input-2">Meeting Date</label>
                                    <div class="col-sm-10">
                                        <input type="date"  value="{{ $post->meetingdate }}" name="meetingdate" min="<?php echo date('m-d-Y');?>" class="form-control" id="input-2" placeholder="pick the date here" required/>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label col-sm-2" for="input-3">Start Time</label>
                                    <div class="col-sm-10">
                                        <input type="time" value="{{ date('h:i', strtotime($post->starttime))}}" name="starttime" min="09:00" max="18:00" class="form-control" placeholder="pick the time here" required/>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label col-sm-2" for="input-3">Finish Time</label>
                                    <div class="col-sm-10">
                                        <input type="time" value="{{ date('h:i', strtotime($post->endtime))}}" name="endtime" min="09:00" max="18:00" class="form-control" placeholder="pick the time here" required/>
                                    </div>
                                </div>
                                <!-- <div class="form-group row">
                                    <label for="exampleFormControlSelect1" class="control-label col-sm-2">Meeting Type</label>
                                    <div class="col-sm-10">
                                        <select name="meetingtype" class="form-control" id="exampleFormControlSelect1" required>
                                            <option value="0">Select Type</option>
                                            <option value="Internal">Internal</option>
                                            <option value="External">External</option>
                                        </select>
                                    </div>
                                </div> -->
                                
                                <div class="form-group row">
                                    <label class="control-label col-sm-2" for="input-6"></label>
                                    <div class="col-sm-4">
                                    @if(Session::get('role') == 'user')
                                    @if($post->status != 'postponed' && $post->status != 'booked' && $post->status != 'rejected')
                                    <button class="btn btn-primary" onclick="updatepost()" type="button">Update</button>
                                    <button class="btn btn-danger" onclick="postponed()" type="button">Postponed</button>
                                    @elseif($post->status == 'booked')
                                    <button class="btn btn-danger" onclick="postponed()" type="button">Postponed</button>
                                    
                                    @endif
                                    
                                    @if($post->status == 'postponed')
                                    <button class="btn btn-primary" onclick="bookagain()" type="button">Book Again</button>
                                    @endif
                                    @endif
                                    @if(Session::get('role') == 'admin')
                                        @if($post->status != 'booked' && $post->status != 'rejected' && $post->status != 'postponed')
                                            <button class="btn btn-primary" type="submit">Booked</button>
                                        @endif
                                    @endif
                                    </div>
                                </div>
                            
                            @endforeach
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
            $('#editbooking').on('submit', function (e) {
            e.preventDefault();
            $.ajax({
                type: "POST",
                data: $("#editbooking").serialize(),
                url: "{{ URL::to('/book') }}",
                success: function (response) {
                    swal('Done!', "Booked confirmed successfully", "success");
                    //window.location =  "{{ URL::to('/dashboard') }}";
                },
                error: function (error) {
                    swal('Error!', "Something went Wrong, Please Try Again.", "error");
                    console.log('error');
                }
            });
        });
        function bookagain(){
            $.ajax({
                type: "POST",
                data: $("#editbooking").serialize(),
                url: "{{ URL::to('/rebook') }}",
                success: function (response) {
                    swal('Done!', "Rebooking successfully", "success");
                    //window.location =  "{{ URL::to('/dashboard') }}";
                },
                error: function (error) {
                    swal('Error!', "Something went Wrong, Please Try Again.", "error");
                    console.log('error');
                }
            }); 
        }
        function postponed(){
            $.ajax({
                type: "POST",
                data: $("#editbooking").serialize(),
                url: "{{ URL::to('/setpostponed') }}",
                success: function (response) {
                    swal('Done!', "Postponed successfully", "success");
                    //window.location =  "{{ URL::to('/dashboard') }}";
                },
                error: function (error) {
                    swal('Error!', "Something went Wrong, Please Try Again.", "error");
                    console.log('error');
                }
            }); 
        }
        function updatepost(){
            $.ajax({
                type: "POST",
                data: $("#editbooking").serialize(),
                url: "{{ URL::to('/updatepost') }}",
                success: function (response) {
                    swal('Done!', "Update successfully", "success");
                    //window.location =  "{{ URL::to('/dashboard') }}";
                },
                error: function (error) {
                    swal('Error!', "Something went Wrong, Please Try Again.", "error");
                    console.log('error');
                }
            }); 
        }
</script>
@stop