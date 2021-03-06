@extends('main')

@section('tabname','MRBS | Generate Report')

@section('page-title','Generate Report')

@section('main-content')
<h5 class="mb-0"><strong>@yield('page-title')</strong></h5>
<!--Tags-->
<div class="row mt-3">
    <div class="col-sm-12">
        <div class="mt-1 mb-3 p-3 button-container bg-white border shadow-sm">
            <div id="message" class="alert alert-warning" role="alert">
                End Date cannot come before Start Date
            </div>
            <form id="report-form" action="">
                <div class="form-group row">
                    <div class="col-sm-4">
                        <label for="">Meeting Date from*</label>
                        <input class="form-control" name="datefrom" id="datefrom" type="date" value="<?php echo date('Y-m-d');?>" placeholder="" required>
                    </div>
                    <div class="col-sm-4">
                        <label for="">Meeting Date to*</label>
                        <input class="form-control" value="<?php echo date('Y-m-d');?>" name="dateto" id="dateto" type="date" placeholder="" required>
                    </div>
                    <div class="col-sm-2">
                        <div class="pull-right mr-3 btn-order-bulk">
                            <label for="">Status</label>
                            <select id="status" name="status" onchange="" class="shadow bg-dark bulk-actions">
                                <option value="">Select Status</option>
                                <option value="booked">Booked</option>
                                <!-- <option value="waiting">Waiting</option> -->
                                <option value="postponed">Postponed</option>
                                <option value="completed">Completed</option>
                                <!--<option value="rejected">Rejected</option> -->
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-2">
                        <button type="submit" class="btn btn-primary">Search</button>
                    </div>
                </div>
            </form>
        </div>
        <!--Content right-->
        <!--Datatable-->
        <div class="mt-1 mb-3 p-3 button-container bg-white border shadow-sm" id="mytable">
            <!-- <h6 class="mb-2">Datatable</h6> -->

            <div class="table-responsive">
                <table id="example" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Category</th>
                            <th>purpose</th>
                            <th>Date</th>
                            <th>Start</th>
                            <th>Finish</th>
                            <th>Person</th>
                            <th>Room</th>
                            <th>Type</th>
                            <th>Proposed</th>
                            <th>Post Date</th>
                            <th>Status</th>
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
    $('#example').DataTable({});
    $('#mytable').hide();
    $('#message').hide();
    $('#report-form').on('submit', function (e) {
        e.preventDefault();
        if ($('#datefrom').val() <= $('#dateto').val()) {
            $("#message").hide();
            $.ajax({
                type: "GET",
                data: $("#report-form").serialize(),
                url: "{{ URL::to('/search') }}",
                success: function (response) {
                    if(response != 0){
                    $('#mytable').show();
                    $('#example').DataTable().destroy();
                    $('#example tbody').html(response);
                    $('#example').DataTable({
                        dom: 'Bfrtip',
                        buttons: [
                            {
                                "extend": 'csv',
                                "className": 'btn btn-info btn-sm bg-dark',
                                title: 'Meeting Room Booking System',
                                message: ' ',
                                customize: function (win) {
                                    $(win.document.header).prepend('<h3>Guardian Life Insurance</h3>'); 
                                    $(win.document.header).append('<h3>Guardian Life Insurance</h3>'); 
                                }
                            },
                            { "extend": 'excel', "className": 'btn btn-info btn-sm  bg-dark', title: ''},
                            { "extend": 'pdf', "className": 'btn btn-info btn-sm  bg-dark', title: '',},
                            { "extend": 'print', "className": 'btn btn-info btn-sm  bg-dark', title: '',},
                        ]
                    });
                    }else{
                        swal('Sorry!'," Data not found", "error");
                    }
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