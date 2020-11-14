@extends('main')

@section('tabname','MRBS | Manage Booking')

@section('page-title','Manage Booking')

@section('main-content')
<!-- <h5 class="mb-0" ><strong>@yield('page-title')</strong></h5> -->
<!-- <span class="text-secondary">Booking <i class="fa fa-angle-right"></i> @yield('page-title')</span> -->

<div class="row mt-3">
    <div class="col-sm-12">
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
                            <option value="postponed">Postponed</option>
                            <option value="booked">Booked</option>
                            <option value="completed">Completed</option>
                        </select>
                    </div>

                    <div class="clearfix"></div>
                </div>
            </div>
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
                $('#example tbody').html(response);
            } else {
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
                    $('#example tbody').html(response);
                } else {
                    $('#example').hide();
                }
            },
            error: function (error) {
                console.log('Error');
            }
        });
    }
</script>
@stop