@extends('main')

@section('tabname','MRBS | Dashboard')

@section('page-title','Dashboard')

@section('head')
@include('section.head')
<style>
    #blink {
        font-size: 16px;
        font-weight: bold;
        color: red;
        transition: 0.1s;
    }
</style>
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

@section('main-content')
<h5 class="mb-3"><strong>@yield('page-title')</strong></h5>

<!--Dashboard widget-->
<div class="mt-1 mb-3 button-container">
    <div class="row pl-0">
        <div class="col-lg-3 col-md-3 col-sm-6 col-12 mb-3">
            <div class="bg-white border shadow" id="ongoing" onclick="ongoing()">
                <div class="media p-4">
                    <div class="align-self-center mr-3 rounded-circle notify-icon bg-theme" id="ongoingIconBack">
                        <i class="fa fa-users faa-tada animated" id="ongoingIcon"></i>
                    </div>
                    <div class="media-body pl-2">
                        <h3 class="mt-0 mb-0"><strong id="countongoing">0</strong></h3>
                        <p><small class="text-muted bc-description" id="ongoingText">Today</small></p>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-3 col-sm-6 col-12 mb-3">
            <div class="bg-white border shadow" id="postponed" onclick="postponed()">
                <div class="media p-4">
                    <div class="align-self-center mr-3 rounded-circle notify-icon bg-warning" id="postponedIconBack">
                        <i class="fas fa-spinner fa-pulse" id="postponedIcon"></i>
                    </div>
                    <div class="media-body pl-2">
                        <h3 class="mt-0 mb-0"><strong id="countpostponed">0</strong></h3>
                        <p><small class="text-muted bc-description" id="postponedText">Postponed</small></p>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-3 col-sm-6 col-12 mb-3">
            <div class="bg-white border shadow" id="reserved" onclick="reserved()">
                <div class="media p-4">
                    <div class="align-self-center mr-3 rounded-circle notify-icon bg-danger" id="reservedIconBack">
                        <i class="fa fa-tags faa-flash animated" id="reservedIcon"></i>
                    </div>
                    <div class="media-body pl-2">
                        <h3 class="mt-0 mb-0"><strong id="countbooked">0</strong></h3>
                        <p><small class="text-muted bc-description" id="reservedText">Reserved</small></p>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-3 col-sm-6 col-12 mb-3">
            <div class="bg-white border shadow" id="completed" onclick="completed()">
                <div class="media p-4">
                    <div class="align-self-center mr-3 rounded-circle notify-icon bg-success" id="completedIconBack">
                        <i class="far fa-handshake faa-vertical animated" id="completedIcon"></i>
                    </div>
                    <div class="media-body pl-2">
                        <h3 class="mt-0 mb-0"><strong id="countcompleted">0</strong></h3>
                        <p><small class="bc-description text-muted" id="completedText">Completed</small></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--/Dashboard widget-->

<!--Datatable-->
<div class="mt-1 mb-3 p-3 button-container bg-white border shadow-sm">
    <!-- <h6 class="mb-2">Manage Booking</h6> -->
    <div class="row border-bottom mb-4">
        <div class="col-sm-10 pt-2">
            <h6 class="mb-4 bc-header">MANAGE BOOKING</h6>
        </div>
        <!-- <div class="form-group col-sm-3">
                    <input type="date" name="" id="date" class="form-control">
                </div> -->
        <div class="col-sm-2 text-right pb-2">
            <div class="pull-right mr-3 btn-order-bulk">
                <!-- <select id="status" onchange="state()" class="shadow bg-warning bulk-actions">
                    <option value="today"><strong>On Going Today</strong></option>
                    <option value="booked"><strong>Booked</strong></option>
                    <option value="postponed"><strong>Postponed</strong></option>
                    <option value="completed"><strong>Completed</strong></option>
                </select> -->
                <a href="{{ url('/quickbooking') }}" type="button" class="btn btn-warning icon-round shadow pull-right">
                    <i class="fas fa-plus"></i>
                </a>
            </div>

            <div class="clearfix"></div>
        </div>
    </div>
    <!--<h5 id="data">Meeting Rooms are not booked yet, So Hurry Up !!!</h5>-->
    <div id="data" class="col-lg-12">
        <h5 class="text-center" id="blink">Meeting rooms were not booked today !</h5>
        <!-- <img class="img-responsive center-block d-block mx-auto" src="{{ URL::asset('img/animation.gif') }}"> -->
    </div>
    <div class="table-responsive">
        <table id="example" class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>Category</th>
                    <th>Date</th>
                    <th>Start</th>
                    <th>Finish</th>
                    <th>Person</th>
                    <th>Room</th>
                    <th>Type</th>
                    <th>BY</th>
                    <th>Status</th>
                    <th width="15%">Action</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
</div>
<!--/Datatable-->
@stop

@section('footer')
@include('section.footer')
@stop

@section('bottom')
@include('section.bottom')
<script>
        var lang = "{{ Session::get('language') }}";
        console.log(lang);
        switch (lang) {
            case 'en':
                $('#lang').prop('href', 'locale/bn');
                // $.ajax({
                //     type: "GET",
                //     url: "{{ URL::to('/locale/bn') }}",
                //     success: function (response) {
                //         console.log('language changed to bangla');
                //     },
                //     error: function (error) {
                //         console.log('Error');
                //     }
                // });
                break;
            case 'bn':
                $('#lang').prop('href', 'locale/en');
                // $.ajax({
                //     type: "GET",
                //     url: "{{ URL::to('/locale/en') }}",
                //     success: function (response) {
                //         console.log('language changed to english');
                //     },
                //     error: function (error) {
                //         console.log('Error');
                //     }
                // });
                break;
        }
</script>
<script type="text/javascript">
    var blink = document.getElementById('blink');
    setInterval(function () {
        blink.style.opacity = (blink.style.opacity == 0 ? 1 : 0);
    }, 1200);
</script>
<script>
    var url;
    $('.current').css({ 'font-weight': 'bold' });
    $('#example').hide();
    $('#data').hide();
    countongoing();
    countcompleted();
    countbooked();
    countpostponed();
    ongoingHoverIn();
    $.ajax({
        type: "GET",
        url: "{{ URL::to('/') }}" + '/' + 'today',
        success: function (response) {
            console.log(response);
            if (response.length != 0) {
                $('#example').show();
                $('#data').hide();
                $('#example tbody').html(response);
                $('#example').DataTable({});
            } else {
                $('#data').show();
                $('#example').hide();
            }
        },
        error: function (error) {
            console.log('Error');
        }
    });

    function state(status) {
        var todayMessage = "Meeting rooms were not booked today !";
        var postponedMessage = "You were not postpone any meeting !";
        var bookedMessage = "You have not book any room !";
        var completedMessage = "You have not completed any meeting !";
        $.ajax({
            type: "GET",
            url: "{{ URL::to('/') }}" + '/' + status,
            success: function (response) {
                if (response.length != 0) {
                    $('#data').hide();
                    $('#example').show();
                    $('#example').DataTable().destroy();
                    $('#example tbody').html(response);
                    $('#example').DataTable({});
                } else {
                    if (status == 'postponed') {
                        $('#blink').text(postponedMessage);
                    } else if (status == 'booked') {
                        $('#blink').text(bookedMessage);
                    } else if (status == 'completed') {
                        $('#blink').text(completedMessage);
                    } else {
                        $('#blink').text(todayMessage);
                    }
                    $('#example').hide();
                    $('#example').DataTable().destroy();
                    //swal(" Data not found");
                    $('#data').show();
                }
            },
            error: function (error) {
                swal('Error!', "Something went Wrong, Please Try Again.", "error");
                console.log('Error');
            }
        });
    }
    function reject(id) {
        $.ajax({
            type: "GET",
            url: "{{ URL::to('/reject') }}" + '/' + id,
            success: function (response) {
                state();
                swal('Done!', "Reject successfully", "success");
                console.log('reject');
                countcompleted();
                countbooked();
                countpostponed();
                countongoing();
            },
            error: function (error) {
                swal('Error!', "Something went Wrong, Please Try Again.", "error");
                console.log('Error');
            }
        });
    }
    function remove(id) {
        $.ajax({
            type: "GET",
            url: "{{ URL::to('/delete') }}" + '/' + id,
            success: function (response) {
                state(url);
                swal('Done!', "Removed successfully", "success");
                console.log('delete');
                countcompleted();
                countbooked();
                countpostponed();
            },
            error: function (error) {
                swal('Error!', "Something went Wrong, Please Try Again.", "error");
                console.log('Error');
            }
        });
    }
    function countongoing() {
        $.ajax({
            type: "GET",
            url: "{{ URL::to('/countongoing') }}",
            success: function (response) {
                $('#countongoing').html(response);
            },
            error: function (error) {
                console.log('Error');
            }
        });
    }
    function countbooked() {
        $.ajax({
            type: "GET",
            url: "{{ URL::to('/countbooked') }}",
            success: function (response) {
                $('#countbooked').html(response);
            },
            error: function (error) {
                console.log('Error');
            }
        });
    }
    function countpostponed() {
        $.ajax({
            type: "GET",
            url: "{{ URL::to('/countpostponed') }}",
            success: function (response) {
                $('#countpostponed').html(response);
            },
            error: function (error) {
                console.log('Error');
            }
        });
    }
    function countcompleted() {
        $.ajax({
            type: "GET",
            url: "{{ URL::to('/countcompleted') }}",
            success: function (response) {
                $('#countcompleted').html(response);
            },
            error: function (error) {
                console.log('Error');
            }
        });
    }
    function ongoing() {
        ongoingHoverIn();
        postponedHoverOut();
        reservedHoverOut();
        completedHoverOut();
        url = 'today';
        state('today');
    }
    function postponed() {
        ongoingHoverOut();
        postponedHoverIn();
        reservedHoverOut();
        completedHoverOut();
        url = 'postponed';
        state('postponed');
    }
    function reserved() {
        ongoingHoverOut();
        postponedHoverOut();
        reservedHoverIn();
        completedHoverOut();
        url = 'booked';
        state('booked');
    }
    function completed() {
        ongoingHoverOut();
        postponedHoverOut();
        reservedHoverOut();
        completedHoverIn();
        url = 'completed';
        state('completed');
    }
    function ongoingHoverIn() {
        $("#ongoing").addClass("bg-theme");
        $("#ongoing").removeClass("bg-white");
        $("#ongoingIcon").addClass("text-theme");
        $("#ongoingIconBack").addClass("bg-white");
        $("#ongoingIconBack").removeClass("bg-theme");
        $("#countongoing").addClass("text-white");
        $("#ongoingText").addClass("text-white");
        $("#ongoingText").removeClass("text-muted");
    }
    function ongoingHoverOut() {
        $("#ongoing").addClass("bg-white");
        $("#ongoing").removeClass("bg-theme");
        $("#ongoingIcon").removeClass("text-theme");
        $("#ongoingIconBack").removeClass("bg-white");
        $("#ongoingIconBack").addClass("bg-theme");
        $("#countongoing").removeClass("text-white");
        $("#ongoingText").removeClass("text-white");
        $("#ongoingText").addClass("text-muted");
    }
    function postponedHoverIn() {
        $("#postponed").addClass("bg-theme");
        $("#postponed").removeClass("bg-white");
        $("#postponedIcon").addClass("text-theme");
        $("#postponedIconBack").addClass("bg-white");
        $("#postponedIconBack").removeClass("bg-warning");
        $("#countpostponed").addClass("text-white");
        $("#postponedText").addClass("text-white");
        $("#postponedText").removeClass("text-muted");
    }
    function postponedHoverOut() {
        $("#postponed").addClass("bg-white");
        $("#postponed").removeClass("bg-theme");
        $("#postponedIcon").removeClass("text-theme");
        $("#postponedIconBack").removeClass("bg-white");
        $("#postponedIconBack").addClass("bg-warning");
        $("#countpostponed").removeClass("text-white");
        $("#postponedText").removeClass("text-white");
        $("#postponedText").addClass("text-muted");
    }
    function reservedHoverIn() {
        $("#reserved").addClass("bg-theme");
        $("#reserved").removeClass("bg-white");
        $("#reservedIcon").addClass("text-theme");
        $("#reservedIconBack").addClass("bg-white");
        $("#reservedIconBack").removeClass("bg-danger");
        $("#countreserved").addClass("text-white");
        $("#reservedText").addClass("text-white");
        $("#reservedText").removeClass("text-muted");
    }
    function reservedHoverOut() {
        $("#reserved").addClass("bg-white");
        $("#reserved").removeClass("bg-theme");
        $("#reservedIcon").removeClass("text-theme");
        $("#reservedIconBack").removeClass("bg-white");
        $("#reservedIconBack").addClass("bg-danger");
        $("#countreserved").removeClass("text-white");
        $("#reservedText").removeClass("text-white");
        $("#reservedText").addClass("text-muted");
    }
    function completedHoverIn() {
        $("#completed").addClass("bg-theme");
        $("#completed").removeClass("bg-white");
        $("#completedIcon").addClass("text-theme");
        $("#completedIconBack").addClass("bg-white");
        $("#completedIconBack").removeClass("bg-success");
        $("#countcompleted").addClass("text-white");
        $("#completedText").addClass("text-white");
        $("#completedText").removeClass("text-muted");
    }
    function completedHoverOut() {
        $("#completed").addClass("bg-white");
        $("#completed").removeClass("bg-theme");
        $("#completedIcon").removeClass("text-theme");
        $("#completedIconBack").removeClass("bg-white");
        $("#completedIconBack").addClass("bg-success");
        $("#countcompleted").removeClass("text-white");
        $("#completedText").removeClass("text-white");
        $("#completedText").addClass("text-muted");
    }
</script>
@stop