@extends('main')

@section('tabname','MRBS | Quick Booking')

@section('page-title','Quick Booking')

@section('main-content')
<h5 class="mb-0"><strong>@yield('page-title')</strong></h5>
<!-- <span class="text-secondary">Booking <i class="fa fa-angle-right"></i> @yield('page-title')</span> -->

<div class="row mt-3">
    <div class="col-sm-12">
        <!--Default elements-->
        <div class="mt-1 mb-3 p-3 button-container bg-white border shadow-sm">
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
                        <input type="text" onblur="Purpose()" id="purpose" name="purpose" class="form-control"
                            id="input-1" placeholder="Write down pupose of meeting"  />
                        <p id="alertPurpose" style="display:none;color:red;margin-top:5px;margin-left:2px;">please write
                            about your meeting goal</p>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="exampleFormControlSelect1" class="control-label col-sm-2">Choose Room</label>
                    <div class="col-sm-10">
                        <select name="room" onblur="myRoom()" class="form-control room" id="exampleFormControlSelect1"
                            >
                            <option value="">Choose Room</option>
                            @foreach($rooms as $room)
                            <option value="{{ $room->id }}">{{ $room->name }}</option>
                            @endforeach
                        </select>
                        <p id="alertRoom" style="display:none;color:red;margin-top:5px;margin-left:2px;">please write
                            about your meeting goal</p>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="control-label col-sm-2" for="input-2">Meeting Date</label>
                    <div class="col-sm-10">
                        <input type="date" onblur="meetingDate()" id="date" value="<?php echo date('Y-m-d');?>"
                            name="meetingdate" class="form-control" id="input-2"  />
                        <p id="alertDate" style="display:none;color:red;margin-top:5px;margin-left:2px;">please write
                            about your meeting goal</p>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="control-label col-sm-2" for="input-3">Start Time</label>
                    <div class="col-sm-10">
                        <input type="time" onblur="startTime()" name="starttime" id="starttime" min="08:00" max="22:00"
                            class="form-control start" id="input-3" placeholder="pick the time here"  />
                        <p id="alertStart" style="display:none;color:red;margin-top:5px;margin-left:2px;">please write
                            about your meeting goal</p>
                            <p id="alertDbStart" style="display:none;color:red;margin-top:5px;margin-left:2px;">please write
                                about your meeting goal</p>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="control-label col-sm-2" for="input-3">Finish Time</label>
                    <div class="col-sm-10">
                        <input type="time" onblur="finishTime()" name="endtime" id="endtime" min="08:00" max="22:00"
                            class="form-control finish" id="input-3" placeholder="pick the time here"  />
                        <p id="alertFinish" style="display:none;color:red;margin-top:5px;margin-left:2px;">please write
                            about your meeting goal</p>
                            <p id="alertDbFinish" style="display:none;color:red;margin-top:5px;margin-left:2px;">please write
                                about your meeting goal</p>
                    </div>
                </div>
                <!-- <div class="form-group row">
                    <label for="exampleFormControlSelect1" class="control-label col-sm-2">Duration</label>
                    <div class="col-sm-10">
                        <select class="form-control" name="duration" id="exampleFormControlSelect1" >
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
                </div> -->
                <div class="form-group row">
                    <label class="control-label col-sm-2" for="input-3">Total People</label>
                    <div class="col-sm-10">
                        <input type="number" onblur="people()" name="total" min="2" class="form-control people"
                            id="input-3" placeholder="Number of people"  />
                        <p id="alertPeople" style="display:none;color:red;margin-top:5px;margin-left:2px;">please write
                            about your meeting goal</p>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="exampleFormControlSelect1" class="control-label col-sm-2">Meeting Category</label>
                    <div class="col-sm-10">
                        <select name="category" onblur="myCategory()" class="form-control category" id="exampleFormControlSelect1" >
                            <option value="">Select Category</option>
                            @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                        <p id="alertCategory" style="display:none;color:red;margin-top:5px;margin-left:2px;">please
                            write about your meeting goal</p>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="exampleFormControlSelect1" class="control-label col-sm-2">Meeting Type</label>
                    <div class="col-sm-10">
                        <select name="meetingtype" onblur="meetingType()" class="form-control meetingtype" id="exampleFormControlSelect1"
                            >
                            <option value="">Select Type</option>
                            <option value="Internal">Internal</option>
                            <option value="External">External</option>
                        </select>
                        <p id="alertType" style="display:none;color:red;margin-top:5px;margin-left:2px;">please write
                            about your meeting goal</p>
                    </div>
                </div>
                <!-- <div class="form-group row">
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
                </div> -->
                <div class="form-group row">
                    <label class="control-label col-sm-2" for="input-6"></label>
                    <div class="col-sm-10">
                        <button class="btn btn-primary" type="button" onclick="addpost()">Submit</button>
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
    $('#purpose').focus();
    function Purpose() {
        if ($('#purpose').val() == '') {
            $('#purpose').focus();
            $('#alertPurpose').html('write down purpose of meeting');
            $('#alertPurpose').show();
        } else if ($('#purpose').val().trim().length == 0) {
            $('#purpose').focus();
            $('#alertPurpose').html('space character not allowed');
            $('#alertPurpose').show();
        } else if ($('#purpose').val().trim().length < 10) {
            $('#purpose').focus();
            $('#alertPurpose').html('please use minimum 10 character');
            $('#alertPurpose').show();
        }
        else {
            $('#alertPurpose').hide();
        }
    }

    function meetingType(){
        if ($('.meetingtype').val() == '') {
            $('.meetingtype').focus();
            $('#alertType').html('please select meeting type');
            $('#alertType').show();
        }else{
            $('#alertType').hide();
        }
    }

    function myRoom(){
        if ($('.room').val() == '') {
            $('.room').focus();
            $('#alertRoom').html('please select room for meeting');
            $('#alertRoom').show();
        }else{
            $('#alertRoom').hide();
            var id=$('.room').val();
            $.ajax({
            type: "GET",
            url: "{{ URL::to('/setMaxCapacity') }}",
            data: {
                id: id,
            },
            success: function (response) {
                $('.people').attr({
                    "max" : response,
                    "min" : 2
                });
                console.log(response);
            },
            error: function (error) {
                console.log('error');
            }
        });
        }
    }

    function myCategory(){
        if ($('.category').val() == '') {
            $('.category').focus();
            $('#alertCategory').html('please select meeting category');
            $('#alertCategory').show();
        }else{
            $('#alertCategory').hide();
        }
    }

    function meetingDate() {
        var UserDate = document.getElementById("date").value;
        var today = new Date();
        var hours = today.getHours();
        var currentdate = currentDate();
        if ($('#date').val() == '') {
            $('#date').focus();
            $('#alertDate').html('meeting date must be fillup here');
            $('#alertDate').show();
        } else if (UserDate < currentdate) {
            $('#date').focus();
            $('#alertDate').html('Meeting Date must be greater than or equal to today');
            $('#alertDate').show();
        }
        else if(UserDate == currentdate){
            if (hours > 22) {
                $('#date').focus();
                $('#alertDate').html('allocated time of this day is over');
                $('#alertDate').show();
            } else {
                $('#alertDate').hide();
            }
        }else{
            $('#alertDate').hide();
        }
    }
    function startTime() {
        var today = new Date();
        var hours = today.getHours();
        var minutes = today.getMinutes();
        var starttime = $('.start').val().split(':');
        var endtime = $('.finish').val().split(':');
        var starthours = parseInt(starttime[0]);
        var startmins = parseInt(starttime[1]);
        var endhours = parseInt(endtime[0]);
        var endmins = parseInt(endtime[1]);
        var startampm = starthours >= 12 ? 'pm' : 'am';
        var endampm = endhours >= 12 ? 'pm' : 'am';
        var UserDate = document.getElementById("date").value;
        var currentdate = currentDate();
        if ($('.start').val() == '') {
            $('.start').focus();
            $('#alertStart').html('please input meeting start time');
            $('#alertStart').show();
            $('#alertDbFinish').hide();
        } else {
            if (UserDate == currentdate) {
                console.log('match');
                if (hours <= starthours) {
                    console.log(hours);
                    if (starthours < 8) {
                        $('.start').focus();
                        $('#alertStart').html('you dont create meeting before 8 AM');
                        $('#alertStart').show();
                    }
                    else if (starthours > 22) {
                        $('.start').focus();
                        $('#alertStart').html('you dont create meeting after 8 PM');
                        $('#alertStart').show();
                    }
                    else {
                        $('#alertStart').hide();
                        
                    }
                } else {
                    $('.start').focus();
                    $('#alertStart').html('allocated time of this day is over');
                    $('#alertStart').show();
                }
                hasbookedstart($('.start').val());
            } else {
                if (starthours < 8) {
                    $('.start').focus();
                    $('#alertStart').html('you dont create meeting before 8 AM');
                    $('#alertStart').show();
                }
                else if (starthours > 22) {
                    $('.start').focus();
                    $('#alertStart').html('you dont create meeting after 8 PM');
                    $('#alertStart').show();
                }
                else {
                    $('#alertStart').hide();
                    hasbookedstart($('.start').val());
                }
            }
        }
    }

    function finishTime() {
        var today = new Date();
        var hours = today.getHours();
        var minutes = today.getMinutes();
        var starttime = $('.start').val().split(':');
        var endtime = $('.finish').val().split(':');
        var starthours = parseInt(starttime[0]);
        var startmins = parseInt(starttime[1]);
        var endhours = parseInt(endtime[0]);
        var endmins = parseInt(endtime[1]);
        var startampm = starthours >= 12 ? 'pm' : 'am';
        var endampm = endhours >= 12 ? 'pm' : 'am';
        var UserDate = document.getElementById("date").value;
        var currentdate = currentDate();
        if ($('.finish').val() == '') {
            $('.finish').focus();
            $('#alertFinish').html('please input meeting finish time');
            $('#alertFinish').show();
        } else {
            if (isNaN(starthours) || isNaN(startmins)) {
                $('#alertFinish').html('please input start time');
                $('#alertDbFinish').hide();
            } else {
                if (UserDate == currentdate) {
                    if (hours <= endhours) {
                        if (endhours < 8) {
                            $('.finish').focus();
                            $('#alertFinish').html('you dont create meeting before 8 AM');
                            $('#alertFinish').show();
                        } else if (endhours > 22) {
                            $('.finish').focus();
                            $('#alertFinish').html('you dont create meeting after 8 PM');
                            $('#alertFinish').show();
                        }
                        else if (startampm == 'pm' && endampm == 'pm') {
                            if (endhours > starthours) {
                                var mins = (60 - startmins) + endmins;
                                var minsdif = mins >= 30 ? 'YES' : 'NO';
                            } else {
                                var minsdif = endmins >= startmins + 30 ? 'YES' : 'NO';
                            }
                            if (starthours > endhours) {
                                $('.finish').focus();
                                $('#alertFinish').html('finish time can not less than start time');
                                $('#alertFinish').show();
                            } else if (minsdif != 'YES') {
                                $('.finish').focus();
                                $('#alertFinish').html('meeting duration minimum 30 minutes');
                                $('#alertFinish').show();
                            } else {
                                $('#alertFinish').hide();
                            }
                        } else if (startampm == 'am' && endampm == 'am') {
                            if (endhours > starthours) {
                                var mins = (60 - startmins) + endmins;
                                var minsdif = mins > 30 ? 'YES' : 'NO';
                            } else {
                                var minsdif = endmins >= startmins + 30 ? 'YES' : 'NO';
                            }
                            if (starthours > endhours) {
                                $('.finish').focus();
                                $('#alertFinish').html('finish time can not less than start time');
                                $('#alertFinish').show();
                            } else if (minsdif != 'YES') {
                                $('.finish').focus();
                                $('#alertFinish').html('meeting duration minimum 30 minutes');
                                $('#alertFinish').show();
                            } else {
                                $('#alertFinish').hide();
                            }
                        } else if (startampm == 'pm' && endampm == 'am') {
                            $('.finish').focus();
                            $('#alertFinish').html('please change AM to PM');
                            $('#alertFinish').show();
                        } else if (startampm == 'am' && endampm == 'pm') {
                            var mins = (60 - startmins) + endmins;
                            var minsdif = mins > 30 ? 'YES' : 'NO';
                            console.log(mins);
                            if (minsdif != 'YES') {
                                $('.finish').focus();
                                $('#alertFinish').html('meeting duration minimum 30 minutes');
                                $('#alertFinish').show();
                            } else {
                                $('#alertFinish').hide();
                            }
                        }
                        else {
                            $('#alertFinish').hide();
                        }
                    } else {
                        $('.finish').focus();
                        $('#alertFinish').html('allocated time of this day is over');
                        $('#alertFinish').show();
                    }
                    hasbookedend($('.finish').val());
                } else {
                    if (endhours < 8) {
                        $('.finish').focus();
                        $('#alertFinish').html('you dont create meeting before 8 AM');
                        $('#alertFinish').show();
                    } else if (endhours > 22) {
                        $('.finish').focus();
                        $('#alertFinish').html('you dont create meeting after 8 PM');
                        $('#alertFinish').show();
                    }
                    else if (startampm == 'pm' && endampm == 'pm') {
                        if (endhours > starthours) {
                            var mins = (60 - startmins) + endmins;
                            var minsdif = mins >= 30 ? 'YES' : 'NO';
                        } else {
                            var minsdif = endmins >= startmins + 30 ? 'YES' : 'NO';
                        }
                        if (starthours > endhours) {
                            $('.finish').focus();
                            $('#alertFinish').html('finish time can not less than start time');
                            $('#alertFinish').show();
                        } else if (minsdif != 'YES') {
                            $('.finish').focus();
                            $('#alertFinish').html('meeting duration minimum 30 minutes');
                            $('#alertFinish').show();
                        } else {
                            $('#alertFinish').hide();
                        }
                    } else if (startampm == 'am' && endampm == 'am') {
                        if (endhours > starthours) {
                            var mins = (60 - startmins) + endmins;
                            var minsdif = mins > 30 ? 'YES' : 'NO';
                        } else {
                            var minsdif = endmins >= startmins + 30 ? 'YES' : 'NO';
                        }
                        if (starthours > endhours) {
                            $('.finish').focus();
                            $('#alertFinish').html('finish time can not less than start time');
                            $('#alertFinish').show();
                        } else if (minsdif != 'YES') {
                            $('.finish').focus();
                            $('#alertFinish').html('meeting duration minimum 30 minutes');
                            $('#alertFinish').show();
                        } else {
                            $('#alertFinish').hide();
                        }
                    } else if (startampm == 'pm' && endampm == 'am') {
                        $('.finish').focus();
                        $('#alertFinish').html('please change AM to PM');
                        $('#alertFinish').show();
                    } else if (startampm == 'am' && endampm == 'pm') {
                        var mins = (60 - startmins) + endmins;
                        var minsdif = mins > 30 ? 'YES' : 'NO';
                        console.log(mins);
                        if (minsdif != 'YES') {
                            $('.finish').focus();
                            $('#alertFinish').html('meeting duration minimum 30 minutes');
                            $('#alertFinish').show();
                        } else {
                            $('#alertFinish').hide();
                        }
                    }
                    else {
                        $('#alertFinish').hide();
                    }
                    hasbookedend($('.finish').val());
                }
            }
        }
    }
    function people() {
        if ($('.people').val() < 2 || $('.people').val() == "") {
            $('.people').focus();
            $('#alertPeople').html('please input number of people');
            $('#alertPeople').show();
        } else {
            $('#alertPeople').hide();
        }
    }

    function addpost() {
        var i=0;
        if ($('#purpose').val() == '') {
            $('#purpose').focus();
            $('#alertPurpose').html('write down purpose of meeting');
            $('#alertPurpose').show();
            i++;
        } else if ($('#purpose').val().trim().length == 0) {
            $('#purpose').focus();
            $('#alertPurpose').html('space character not allowed');
            $('#alertPurpose').show();
            i++;
        } else if ($('#purpose').val().trim().length < 10) {
            $('#purpose').focus();
            $('#alertPurpose').html('please use minimum 10 character');
            $('#alertPurpose').show();
            i++;
        } else {
            $('#alertPurpose').hide();
        }
        if ($('.meetingtype').val() == '') {
            $('.meetingtype').focus();
            $('#alertType').html('please select meeting type');
            $('#alertType').show();
            i++;
        } else {
            $('#alertType').hide();
        }
        if ($('.room').val() == '') {
            $('.room').focus();
            $('#alertRoom').html('please select room for meeting');
            $('#alertRoom').show();
            i++;
        } else {
            $('#alertRoom').hide();
        }
        if ($('.category').val() == '') {
            $('.category').focus();
            $('#alertCategory').html('please select meeting category');
            $('#alertCategory').show();
            i++;
        } else {
            $('#alertCategory').hide();
        }
        if ($('.people').val() < 2 || $('.people').val() == "") {
            $('.people').focus();
            $('#alertPeople').html('please input number of people');
            $('#alertPeople').show();
            i++;
        } else {
            $('#alertPeople').hide();
        }

        var today = new Date();
        var hours = today.getHours();
        var minutes = today.getMinutes();
        var starttime = $('.start').val().split(':');
        var endtime = $('.finish').val().split(':');
        var starthours = parseInt(starttime[0]);
        var startmins = parseInt(starttime[1]);
        var endhours = parseInt(endtime[0]);
        var endmins = parseInt(endtime[1]);
        var startampm = starthours >= 12 ? 'pm' : 'am';
        var endampm = endhours >= 12 ? 'pm' : 'am';
        var UserDate = document.getElementById("date").value;
        var currentdate = currentDate();
        if ($('.start').val() == '') {
            $('.start').focus();
            $('#alertStart').html('please input meeting start time');
            $('#alertStart').show();
            $('#alertDbFinish').hide();
            i++;
        } else {
            if (UserDate == currentdate) {
                console.log('match');
                if (hours <= starthours) {
                    console.log(hours);
                    if (starthours < 8) {
                        $('.start').focus();
                        $('#alertStart').html('you dont create meeting before 8 AM');
                        $('#alertStart').show();
                        i++;
                    }
                    else if (starthours > 22) {
                        $('.start').focus();
                        $('#alertStart').html('you dont create meeting after 8 PM');
                        $('#alertStart').show();
                        i++;
                    }
                    else {
                        $('#alertStart').hide();
                        
                    }
                } else {
                    $('.start').focus();
                    $('#alertStart').html('allocated time of this day is over');
                    $('#alertStart').show();
                    i++;
                }
                hasbookedstart($('.start').val());
            } else {
                if (starthours < 8) {
                    $('.start').focus();
                    $('#alertStart').html('you dont create meeting before 8 AM');
                    $('#alertStart').show();
                    i++;
                }
                else if (starthours > 22) {
                    $('.start').focus();
                    $('#alertStart').html('you dont create meeting after 8 PM');
                    $('#alertStart').show();
                    i++;
                }
                else {
                    $('#alertStart').hide();
                    hasbookedstart($('.start').val());
                }
            }
        }

        var today = new Date();
        var hours = today.getHours();
        var minutes = today.getMinutes();
        var starttime = $('.start').val().split(':');
        var endtime = $('.finish').val().split(':');
        var starthours = parseInt(starttime[0]);
        var startmins = parseInt(starttime[1]);
        var endhours = parseInt(endtime[0]);
        var endmins = parseInt(endtime[1]);
        var startampm = starthours >= 12 ? 'pm' : 'am';
        var endampm = endhours >= 12 ? 'pm' : 'am';
        var UserDate = document.getElementById("date").value;
        var currentdate = currentDate();
        if ($('.finish').val() == '') {
            $('.finish').focus();
            $('#alertFinish').html('please input meeting finish time');
            $('#alertFinish').show();
            i++;
        } else {
            if (isNaN(starthours) || isNaN(startmins)) {
                $('#alertFinish').html('please input start time');
                $('#alertDbFinish').hide();
                i++;
            } else {
                if (UserDate == currentdate) {
                    if (hours <= endhours) {
                        if (endhours < 8) {
                            $('.finish').focus();
                            $('#alertFinish').html('you dont create meeting before 8 AM');
                            $('#alertFinish').show();
                            i++;
                        } else if (endhours > 22) {
                            $('.finish').focus();
                            $('#alertFinish').html('you dont create meeting after 8 PM');
                            $('#alertFinish').show();
                            i++;
                        }
                        else if (startampm == 'pm' && endampm == 'pm') {
                            if (endhours > starthours) {
                                var mins = (60 - startmins) + endmins;
                                var minsdif = mins >= 30 ? 'YES' : 'NO';
                            } else {
                                var minsdif = endmins >= startmins + 30 ? 'YES' : 'NO';
                            }
                            if (starthours > endhours) {
                                $('.finish').focus();
                                $('#alertFinish').html('finish time can not less than start time');
                                $('#alertFinish').show();
                                i++;
                            } else if (minsdif != 'YES') {
                                $('.finish').focus();
                                $('#alertFinish').html('meeting duration minimum 30 minutes');
                                $('#alertFinish').show();
                                i++;
                            } else {
                                $('#alertFinish').hide();
                            }
                        } else if (startampm == 'am' && endampm == 'am') {
                            if (endhours > starthours) {
                                var mins = (60 - startmins) + endmins;
                                var minsdif = mins > 30 ? 'YES' : 'NO';
                            } else {
                                var minsdif = endmins >= startmins + 30 ? 'YES' : 'NO';
                            }
                            if (starthours > endhours) {
                                $('.finish').focus();
                                $('#alertFinish').html('finish time can not less than start time');
                                $('#alertFinish').show();
                                i++;
                            } else if (minsdif != 'YES') {
                                $('.finish').focus();
                                $('#alertFinish').html('meeting duration minimum 30 minutes');
                                $('#alertFinish').show();
                                i++;
                            } else {
                                $('#alertFinish').hide();
                            }
                        } else if (startampm == 'pm' && endampm == 'am') {
                            $('.finish').focus();
                            $('#alertFinish').html('please change AM to PM');
                            $('#alertFinish').show();
                            i++;
                        } else if (startampm == 'am' && endampm == 'pm') {
                            var mins = (60 - startmins) + endmins;
                            var minsdif = mins > 30 ? 'YES' : 'NO';
                            console.log(mins);
                            if (minsdif != 'YES') {
                                $('.finish').focus();
                                $('#alertFinish').html('meeting duration minimum 30 minutes');
                                $('#alertFinish').show();
                                i++;
                            } else {
                                $('#alertFinish').hide();
                            }
                        }
                        else {
                            $('#alertFinish').hide();
                        }
                    } else {
                        $('.finish').focus();
                        $('#alertFinish').html('allocated time of this day is over');
                        $('#alertFinish').show();
                        i++;
                    }
                    hasbookedend($('.finish').val());
                } else {
                    if (endhours < 8) {
                        $('.finish').focus();
                        $('#alertFinish').html('you dont create meeting before 8 AM');
                        $('#alertFinish').show();
                        i++;
                    } else if (endhours > 22) {
                        $('.finish').focus();
                        $('#alertFinish').html('you dont create meeting after 8 PM');
                        $('#alertFinish').show();
                        i++;
                    }
                    else if (startampm == 'pm' && endampm == 'pm') {
                        if (endhours > starthours) {
                            var mins = (60 - startmins) + endmins;
                            var minsdif = mins >= 30 ? 'YES' : 'NO';
                        } else {
                            var minsdif = endmins >= startmins + 30 ? 'YES' : 'NO';
                        }
                        if (starthours > endhours) {
                            $('.finish').focus();
                            $('#alertFinish').html('finish time can not less than start time');
                            $('#alertFinish').show();
                            i++;
                        } else if (minsdif != 'YES') {
                            $('.finish').focus();
                            $('#alertFinish').html('meeting duration minimum 30 minutes');
                            $('#alertFinish').show();
                            i++;
                        } else {
                            $('#alertFinish').hide();
                        }
                    } else if (startampm == 'am' && endampm == 'am') {
                        if (endhours > starthours) {
                            var mins = (60 - startmins) + endmins;
                            var minsdif = mins > 30 ? 'YES' : 'NO';
                        } else {
                            var minsdif = endmins >= startmins + 30 ? 'YES' : 'NO';
                        }
                        if (starthours > endhours) {
                            $('.finish').focus();
                            $('#alertFinish').html('finish time can not less than start time');
                            $('#alertFinish').show();
                            i++;
                        } else if (minsdif != 'YES') {
                            $('.finish').focus();
                            $('#alertFinish').html('meeting duration minimum 30 minutes');
                            $('#alertFinish').show();
                            i++;
                        } else {
                            $('#alertFinish').hide();
                        }
                    } else if (startampm == 'pm' && endampm == 'am') {
                        $('.finish').focus();
                        $('#alertFinish').html('please change AM to PM');
                        $('#alertFinish').show();
                        i++;
                    } else if (startampm == 'am' && endampm == 'pm') {
                        var mins = (60 - startmins) + endmins;
                        var minsdif = mins > 30 ? 'YES' : 'NO';
                        console.log(mins);
                        if (minsdif != 'YES') {
                            $('.finish').focus();
                            $('#alertFinish').html('meeting duration minimum 30 minutes');
                            $('#alertFinish').show();
                            i++;
                        } else {
                            $('#alertFinish').hide();
                        }
                    }
                    else {
                        $('#alertFinish').hide();
                    }
                    hasbookedend($('.finish').val());
                }
            }
        }
        if(i==0){
            $.ajax({
                type: "POST",
                url: "{{ URL::to('/booking') }}",
                data: $("#addbooking").serialize(),
                success: function (response) {
                    swal('Done!', "Congratulation! Reserved Successfully", "success");
                    $("#addbooking").trigger('reset');
                    console.log(response);
                },
                error: function (error) {
                    swal('Error!', "Something went Wrong, Please Try Again.", "error");
                    console.log('error');
                }
            });
        }
    }

    function currentDate() {
        var today = new Date();
        var dd = today.getDate();

        var mm = today.getMonth() + 1;
        var yyyy = today.getFullYear();
        if (dd < 10) {
            dd = '0' + dd;
        }

        if (mm < 10) {
            mm = '0' + mm;
        }
        today = yyyy + '-' + mm + '-' + dd;
        console.log(today);
        return today;
    }

    function hasbookedstart(time) {
        var room = $('.room').val();
        var date = $('#date').val();
        $.ajax({
            type: "GET",
            url: "{{ URL::to('/hasbooked') }}",
            data: {
                date: date,
                room: room,
                time: time
            },
            success: function (response) {
                if (response != 'not booked') {
                    $('#alertDbStart').html(response);
                    $('#alertDbStart').show();
                    $('.start').focus();
                } else {
                    $('#alertDbStart').hide();
                }
            },
            error: function (error) {
                swal('Error!', "Something went Wrong, Please Try Again.", "error");
                console.log('error');
            }
        });
    }
    function hasbookedend(time) {
        var room = $('.room').val();
        var date = $('#date').val();
        $.ajax({
            type: "GET",
            url: "{{ URL::to('/hasbooked') }}",
            data: {
                date: date,
                room: room,
                time: time
            },
            success: function (response) {
                if (response != 'not booked') {
                    $('#alertDbFinish').html(response);
                    $('#alertDbFinish').show();
                    $('.finish').focus();
                } else {
                    $('#alertDbFinish').hide();
                }
            },
            error: function (error) {
                swal('Error!', "Something went Wrong, Please Try Again.", "error");
                console.log('error');
            }
        });
    }
</script>
@stop