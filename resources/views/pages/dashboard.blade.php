@extends('main')

@section('tabname','MRBS | Dashboard')

@section('username','CK BISWAS')

@section('designation','Assistant Officer')

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
<h5 class="mb-3" ><strong>@yield('page-title')</strong></h5>
                
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
                                        <h3 class="mt-0 mb-0"><strong>{{ $book }}</strong></h3>
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
                                        <h3 class="mt-0 mb-0"><strong>{{ $waiting }}</strong></h3>
                                        <p><small class="text-muted bc-description">Waiting for Allocation</small></p>
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
                                        <h3 class="mt-0 mb-0"><strong>{{ $complete }}</strong></h3>
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
                <div class="col-sm-7 pt-2">
                    <h6 class="mb-4 bc-header">Manage Booking</h6>
                </div>
                <div class="form-group col-sm-3">
                    <input type="date" name="" id="date" class="form-control">
                </div>
                <div class="col-sm-2 text-right pb-2">
                    <div class="pull-right mr-3 btn-order-bulk">
                        <select id="status" onchange="state()" class="shadow bg-primary bulk-actions">
                            <option value="waiting">Waiting</option>
                            <option value="booked">Booked</option>
                            <option value="postponed">Postponed</option>
                            <option value="completed">Completed</option>
                            <option value="rejected">Rejected</option>
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
                            <th>Time</th>
                            <th>Duration</th>
                            <th>Person</th>
                            <th>Room</th>
                            <th>Proposed By</th>
                            <th>Meeting Type</th>
                            <th>Action</th>
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
    $.ajax({
        type: "GET",
        url: "{{ URL::to('/') }}" + '/' + url,
        success: function (response) {
            console.log(response);
            if (response.length != 0) {
                $('#example').show();
                $('#data').hide();
                $('#example tbody').html(response);
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
                    $('#example tbody').html(response);
                } else {
                    $('#data').show();
                    $('#example').hide();
                }
            },
            error: function (error) {
                console.log('Error');
            }
        });
    }
    function reject(id){
        $.ajax({
            type: "GET",
            url: "{{ URL::to('/reject') }}"+'/'+ id,
            success: function (response) {
                state();
                console.log('reject');
            },
            error: function (error) {
                console.log('Error');
            }
        });
    }
    function remove(id){
        $.ajax({
            type: "GET",
            url: "{{ URL::to('/delete') }}"+'/'+ id,
            success: function (response) {
                state();
                console.log('delete');
            },
            error: function (error) {
                console.log('Error');
            }
        });
    }
</script>
@stop