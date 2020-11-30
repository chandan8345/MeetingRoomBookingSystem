@extends('main')

@section('tabname','MRBS | Dashboard')

@section('page-title','Dashboard')

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

@section('main-content')
<h5 class="mb-3"><strong>@yield('page-title')</strong></h5>

<!--Dashboard widget-->
<div class="mt-1 mb-3 button-container">
    <div class="row pl-0">
        <div class="col-lg-4 col-md-4 col-sm-6 col-12 mb-3">
            <div class="bg-white border shadow">
                <div class="media p-4">
                    <div class="align-self-center mr-3 rounded-circle notify-icon bg-theme">
                        <i class="fa fa-users"></i>
                    </div>
                    <div class="media-body pl-2">
                        <h3 class="mt-0 mb-0"><strong id="countbooked">0</strong></h3>
                        <p><small class="text-muted bc-description">On Going Meeting</small></p>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4 col-md-4 col-sm-6 col-12 mb-3">
            <div class="bg-white border shadow">
                <div class="media p-4">
                    <div class="align-self-center mr-3 rounded-circle notify-icon bg-warning">
                        <i class="fas fa-spinner fa-pulse"></i>
                    </div>
                    <div class="media-body pl-2">
                        <h3 class="mt-0 mb-0"><strong id="countpostponed">0</strong></h3>
                        <p><small class="text-muted bc-description">Meeting Postponed</small></p>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4 col-md-4 col-sm-6 col-12 mb-3">
            <div class="bg-theme border shadow">
                <div class="media p-4">
                    <div class="align-self-center mr-3 rounded-circle notify-icon bg-white">
                        <i class="fa fa-tags text-theme"></i>
                    </div>
                    <div class="media-body pl-2">
                        <h3 class="mt-0 mb-0"><strong id="countcompleted">0</strong></h3>
                        <p><small class="bc-description text-white">Meeting Completed</small></p>
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
            <h6 class="mb-4 bc-header">Manage Booking</h6>
        </div>
        <!-- <div class="form-group col-sm-3">
                    <input type="date" name="" id="date" class="form-control">
                </div> -->
        <div class="col-sm-2 text-right pb-2">
            <div class="pull-right mr-3 btn-order-bulk">
                <select id="status" onchange="state()" class="shadow bg-warning bulk-actions">
                    <!-- <option value="waiting">Waiting</option> -->
                    <option value="today"><b>On Going Today</b></option>
                    <option value="booked">Booked</option>
                    <option value="postponed">Postponed</option>
                    <option value="completed">Completed</option>
                    <!-- <option value="rejected">Rejected</option> -->
                </select>
            </div>

            <div class="clearfix"></div>
        </div>
    </div>
    <h3 id="data">No Data Available</h3>
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
                    <th width="20%">Action</th>
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
    var url = $('#status').val();
    console.log(url);
    countcompleted();
    countbooked();
    countpostponed();
    $.ajax({
        type: "GET",
        url: "{{ URL::to('/') }}" + '/' + url,
        success: function (response) {
            console.log(response);
            if (response.length != 0) {
                $('#example').show();
                $('#data').hide();
                $('#example tbody').html(response);
                $('#example').DataTable({
                });
            } else {
                $('#data').show();
                $('#example').hide();
            }
        },
        error: function (error) {
            console.log('Error');
        }
    });

    function state() {
        var status = $('#status').val();
        console.log(status);
        $.ajax({
            type: "GET",
            url: "{{ URL::to('/') }}" + '/' + status,
            success: function (response) {
                if (response.length != 0) {
                    $('#example').show();
                    $('#data').hide();
                    $('#example').DataTable().destroy();
                    $('#example tbody').html(response);
                    $('#example').DataTable({});
                } else {
                    $('#example').DataTable().destroy();
                    swal('Sorry!', status + " post not found", "error");
                    $('#data').show();
                    $('#example').hide();
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
                state();
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
</script>
@stop