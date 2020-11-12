@extends('main')

@section('tabname','MRBS | Reports')

@section('username','CK BISWAS')

@section('designation','Assistant Officer')

@section('page-title','Reports')

@section('main-content')
                        <!--Tags-->
                        <div class="mt-1 mb-3 p-3 button-container bg-white border shadow-sm">
                            <form action="">
                                <div class="form-group row">
                                    <div class="col-sm-5">
                                        <label for="">Date from*</label>
                                        <input class="form-control" type="date" placeholder="col-sm-2">
                                    </div>
                                    <div class="col-sm-5">
                                        <label for="">Date to*</label>
                                        <input class="form-control" type="date" placeholder="col-sm-10">
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="pull-right mr-3 btn-order-bulk">
                                            <label for="">Status</label>
                                            <select id="status" name="status" onchange="" class="shadow bg-primary bulk-actions">
                                                <option value="booked">Booked</option>
                                                <option value="waiting">Waiting</option>
                                                <option value="postponed">Postponed</option>
                                                <option value="completed">Completed</option>
                                                <option value="rejected">Rejected</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-2">
                                        <button class="btn btn-success">Search</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                                    <!--Content right-->
                        <!--Datatable-->
                        <div class="mt-1 mb-3 p-3 button-container bg-white border shadow-sm">
                            <!-- <h6 class="mb-2">Datatable</h6> -->
                            
                            <div class="table-responsive">
                                <table id="example" class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Position</th>
                                            <th>Office</th>
                                            <th>Age</th>
                                            <th>Start date</th>
                                            <th>Salary</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Tiger Nixon</td>
                                            <td>System Architect</td>
                                            <td>Edinburgh</td>
                                            <td>61</td>
                                            <td>2011/04/25</td>
                                            <td>$320,800</td>
                                        </tr>
                                </table>
                            </div>
                        </div>
                        <!--/Datatable-->
                    </div>
                </div>
            </div>
        </div>
                        <!--/Tags-->
                    
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
@stop