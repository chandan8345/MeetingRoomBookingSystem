@extends('main')

@section('tabname','MRBS | Update')

@section('username','CK BISWAS')

@section('designation','Assistant Officer')

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
                                    <label class="control-label col-sm-2" for="input-2">Meeting Date</label>
                                    <div class="col-sm-10">
                                        <input type="date"  value="{{ $post->meetingdate }}" name="meetingdate" min="<?php echo date('m-d-Y');?>" class="form-control" id="input-2" placeholder="pick the date here" required/>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label col-sm-2" for="input-3">Meeting Time</label>
                                    <div class="col-sm-10">
                                        <input type="time" value="{{ date('h:i', strtotime($post->meetingtime))}}" name="meetingtime" min="09:00" max="18:00" class="form-control" placeholder="pick the time here" required/>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="exampleFormControlSelect1" class="control-label col-sm-2">Duration</label>
                                    <div class="col-sm-10">
                                        <select class="form-control" name="duration" id="exampleFormControlSelect1" required>
                                            <option value="">Choose Duration</option>
                                            <option value="30 Mins" @if($post->duration == "30 Mins") selected @endif >30 Mins</option>
                                            <option value="1 Hour" @if($post->duration == "1 Hour") selected @endif >1 Hour</option>
                                            <option value="2 Hour" @if($post->duration == "3 Hour") selected @endif >2 Hour</option>
                                            <option value="3 Hour" @if($post->duration == "3 Hour") selected @endif >3 Hour</option>
                                            <option value="4 Hour" @if($post->duration == "4 Hour") selected  @endif >4 Hour</option>
                                            <option value="5 Hour" @if($post->duration == "5 Hour") selected  @endif >5 Hour</option>
                                            <option value="6 Hour" @if($post->duration == "6 Hour") selected  @endif >6 Hour</option>
                                            <option value="Full Day" @if($post->duration == "Full Day") selected @endif >Full Day</option>
                                        </select>
                                    </div>
                                </div>
                                <!-- <div class="form-group row">
                                    <label class="control-label col-sm-2" for="input-3">Total People</label>
                                    <div class="col-sm-10">
                                        <input type="number" name="total" min="0" class="form-control" id="input-3" placeholder="How many people concern here" required/>
                                    </div>
                                </div> -->
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
                                <!-- <div class="form-group row">
                                    <label for="exampleFormControlSelect1" class="control-label col-sm-2">Meeting Category</label>
                                    <div class="col-sm-10">
                                        <select name="category" class="form-control" id="exampleFormControlSelect1" required>
                                            <option value="">Select Category</option>
                                            @foreach($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div> -->
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
                                    <label class="control-label col-sm-2" for="input-6">Remarks</label>
                                    <div class="col-sm-10">
                                        <textarea @if(Session::get('role') == 'admin') disabled @endif rows="2" value="" name="remarks" class="form-control" id="input-11" placeholder="write down the requirments of your meeting">{{ $post->remarks }}</textarea>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label col-sm-2" for="input-6">Comments</label>
                                    <div class="col-sm-10">
                                        <textarea @if(Session::get('role') == 'user') disabled @endif rows="2" name="comments" class="form-control disabled" id="input-11" placeholder="administration comments" required>{{ $post->comments }}</textarea>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label col-sm-2" for="input-6">Other Requests</label>
                                    <div class="col-sm-10">
                                        <div class="row">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" name="coffee" value="Yes" class="custom-control-input" id="customCheck1" @if($post->coffee == "Yes") checked @endif>
                                            <label class="custom-control-label" for="customCheck1">Coffee</label>
                                        </div>
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" value="Yes" name="snacks" class="custom-control-input" id="customCheck2" @if($post->snacks == "Yes") checked @endif>
                                            <label class="custom-control-label" for="customCheck2">Snacks</label>
                                        </div>
                                        </div>
 
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label col-sm-2" for="input-6"></label>
                                    <div class="col-sm-4">
                                    @if(Session::get('role') == 'user')
                                    @if($post->status != 'postponed')
                                    <button class="btn btn-success" onclick="updatepost()" type="button">Update</button>
                                    <button class="btn btn-primary" onclick="postponed()" type="button">Postponed</button>
                                    @endif
                                    @if($post->status == 'postponed')
                                    <button class="btn btn-primary" onclick="bookagain()" type="button">Book Again</button>
                                    @endif
                                    @endif
                                    @if(Session::get('role') == 'admin')
                                        @if($post->status != 'booked')
                                            <button class="btn btn-primary" type="submit">Booked</button>
                                        @endif
                                        @if($post->status == 'booked')
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
                    window.location =  "{{ URL::to('/dashboard') }}";
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
                    window.location =  "{{ URL::to('/dashboard') }}";
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
                    window.location =  "{{ URL::to('/dashboard') }}";
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
                    window.location =  "{{ URL::to('/dashboard') }}";
                },
                error: function (error) {
                    swal('Error!', "Something went Wrong, Please Try Again.", "error");
                    console.log('error');
                }
            }); 
        }
</script>
@stop