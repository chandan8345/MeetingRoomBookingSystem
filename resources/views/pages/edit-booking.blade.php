@extends('main')

@section('tabname','MRBS | Update')

@section('page-title','Quick Update')

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
            <br>
            <form id="editbooking">
                @foreach($posts as $post)
                {{ csrf_field() }}
                <input type="hidden" name="id" value="{{ $post->id }}">
                <div class="form-group row">
                    <label class="control-label col-sm-2" for="input-1">Purpose of Meeting</label>
                    <div class="col-sm-10">
                        <input type="text" value="{{ $post->purpose }}" onblur="Purpose()" name="purpose"
                            class="form-control" id="purpose" placeholder="write down someting" required
                            @if(Session::get("role")=='admin' ) disabled @endif />
                        <p id="alertPurpose" style="display:none;color:red;margin-top:5px;margin-left:2px;">please write
                            about your meeting goal</p>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="exampleFormControlSelect1" class="control-label col-sm-2">Choose Room</label>
                    <div class="col-sm-10">
                        <select name="room" onblur="myRoom()" class="form-control room" id="exampleFormControlSelect1"
                            required>
                            <option value="">Choose Room</option>
                            @foreach($rooms as $room)
                            <option value="{{ $room->id }}" @if($post->room == $room->name) selected @endif
                                >{{ $room->name }}</option>
                            @endforeach
                        </select>
                        <p id="alertRoom" style="display:none;color:red;margin-top:5px;margin-left:2px;">please write
                            about your meeting goal</p>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="control-label col-sm-2" for="input-2">Meeting Date</label>
                    <div class="col-sm-10">
                        <input type="date" id="date" onblur="meetingDate()" value="{{ $post->meetingdate }}" name="meetingdate"
                            min="<?php echo date('m-d-Y');?>" class="form-control" id="input-2"
                            placeholder="pick the date here" required />
                            <p id="alertDate" style="display:none;color:red;margin-top:5px;margin-left:2px;">please write
                                about your meeting goal</p>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="control-label col-sm-2" for="input-3">Start Time</label>
                    <div class="col-sm-10">
                        <input type="time" onblur="startTime()" value="{{ date('h:i', strtotime($post->starttime))}}"
                            name="starttime" min="09:00" max="18:00" class="form-control start"
                            placeholder="pick the time here" required />
                            <p id="alertStart" style="display:none;color:red;margin-top:5px;margin-left:2px;">please write
                                about your meeting goal</p>
                            <p id="alertDbStart" style="display:none;color:red;margin-top:5px;margin-left:2px;">please write
                                about your meeting goal</p>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="control-label col-sm-2" for="input-3">Finish Time</label>
                    <div class="col-sm-10">
                        <input type="time" onblur="finishTime()" value="{{ date('h:i', strtotime($post->endtime))}}"
                            name="endtime" min="09:00" max="18:00" class="form-control finish"
                            placeholder="pick the time here" required />
                            <p id="alertFinish" style="display:none;color:red;margin-top:5px;margin-left:2px;">please write
                                about your meeting goal</p>
                            <p id="alertDbStart" style="display:none;color:red;margin-top:5px;margin-left:2px;">please write
                                about your meeting goal</p>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="control-label col-sm-2" for="input-3">Total People</label>
                    <div class="col-sm-10">
                        <input type="number" onchange="people()" name="total" min="2" class="form-control people"
                            id="input-3" placeholder="Number of people" value="{{ $post->total }}" required />
                        <p id="alertPeople" style="display:none;color:red;margin-top:5px;margin-left:2px;">please write
                            about your meeting goal</p>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="exampleFormControlSelect1" class="control-label col-sm-2">Meeting Category</label>
                    <div class="col-sm-10">
                        <select name="category" onblur="myCategory()" class="form-control category"
                            id="exampleFormControlSelect1" required>
                            <option value="">Select Category</option>
                            @foreach($categories as $row)
                            <option value="{{ $row->id }}" @if($post->category == $row->name) selected @endif
                                >{{ $row->name }}</option>
                            @endforeach
                        </select>
                        <p id="alertCategory" style="display:none;color:red;margin-top:5px;margin-left:2px;">please
                            write
                            about your meeting goal</p>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="exampleFormControlSelect1" class="control-label col-sm-2">Meeting Type</label>
                    <div class="col-sm-10">
                        <select name="meetingtype" onblur="meetingType()" class="form-control meetingtype"
                            id="exampleFormControlSelect1" required>
                            <option value="">Select Type</option>
                            <option value="Internal" @if($post->meetingtype == 'Internal') selected @endif >Internal
                            </option>
                            <option value="External" @if($post->meetingtype == 'External') selected @endif >External
                            </option>
                        </select>
                        <p id="alertType" style="display:none;color:red;margin-top:5px;margin-left:2px;">please write
                            about your meeting goal</p>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="control-label col-sm-2" for="input-6"></label>
                    <div class="col-sm-4">
                        
                        @if($post->status != 'postponed' && $post->status != 'booked' && $post->status != 'rejected')
                        <button class="btn btn-primary" onclick="updatepost()" type="button">Update</button>
                        <button class="btn btn-danger" onclick="postponed()" type="button">Postponed</button>
                        @elseif($post->status == 'booked')
                        <button class="btn btn-success" onclick="updatepost()" type="button">Update</button>
                        <button class="btn btn-danger" onclick="postponed()" type="button">Postponed</button>

                        @endif

                        @if($post->status == 'postponed')
                        <button class="btn btn-success" onclick="updatepost()" type="button">Update</button>
                        <button class="btn btn-primary" onclick="bookagain()" type="button">Book Again</button>
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
                        hasbookedstart($('.start').val());
                    }
                } else {
                    $('.start').focus();
                    $('#alertStart').html('allocated time of this day is over');
                    $('#alertStart').show();
                }
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
        myRoom();
        if ($('.people').val() < 2 || $('.people').val() == "") {
            $('.people').focus();
            $('#alertPeople').html('please input number of people');
            $('#alertPeople').show();
        } else {
            $('#alertPeople').hide();
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

    function userhasbookedstart(time) {
        var room = $('.room').val();
        var date = $('#date').val();
        var id = $('#id').val();
        $.ajax({
            type: "GET",
            url: "{{ URL::to('/userhasbooked') }}",
            data: {
                id: id,
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
    function userhasbookedend(time) {
        var room = $('.room').val();
        var date = $('#date').val();
        var id = $('#id').val();
        $.ajax({
            type: "GET",
            url: "{{ URL::to('/userhasbooked') }}",
            data: {
                id: id,
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
   //

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
    function bookagain() {
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
    function postponed() {
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
    function updatepost() {
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
        } else {
            $('#alertPurpose').hide();
        }
        if ($('.meetingtype').val() == '') {
            $('.meetingtype').focus();
            $('#alertType').html('please select meeting type');
            $('#alertType').show();
        } else {
            $('#alertType').hide();
        }
        if ($('.room').val() == '') {
            $('.room').focus();
            $('#alertRoom').html('please select room for meeting');
            $('#alertRoom').show();
        } else {
            $('#alertRoom').hide();
        }
        if ($('.category').val() == '') {
            $('.category').focus();
            $('#alertCategory').html('please select meeting category');
            $('#alertCategory').show();
        } else {
            $('#alertCategory').hide();
        }
        if ($('.people').val() < 2 || $('.people').val() == "") {
            $('.people').focus();
            $('#alertPeople').html('please input number of people');
            $('#alertPeople').show();
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
                }
                hasbookedstart($('.start').val());
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
            url: "{{ URL::to('/userhasbooked') }}",
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
            url: "{{ URL::to('/userhasbooked') }}",
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
        $.ajax({
            type: "POST",
            data: $("#editbooking").serialize(),
            url: "{{ URL::to('/updatepost') }}",
            success: function (response) {
                swal('Done!', "Update successfully", "success");
                //window.location =  "{{ URL::to('/dashboard') }}";
            },
            error: function (error) {
                //swal('Error!', "Something went Wrong, Please Try Again.", "error");
                console.log('error');
            }
        }); 
    }
</script>
@stop