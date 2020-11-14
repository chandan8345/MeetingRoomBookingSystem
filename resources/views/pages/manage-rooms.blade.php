@extends('main')

@section('tabname','MRBS | Manage Rooms')

@section('page-title','Manage Rooms')

@section('main-content')
<h5 class="mb-0"><strong>@yield('page-title')</strong></h5>

<div class="mt-4 mb-4 p-3 bg-white border shadow-sm lh-sm">
    <!--Order Listing-->
    <div class="product-list">

        <div class="row border-bottom mb-4">
            <div class="col-sm-8 pt-2">
                <h6 class="mb-4 bc-header">Enlisted Room</h6>
            </div>
            <div class="col-sm-4 text-right pb-3">
                <button data-toggle="modal" data-target="#addEmployeeModal" type="button"
                    class="btn btn-warning icon-round shadow pull-right">
                    <i class="fas fa-plus"></i>
                </button>

                <div class="clearfix"></div>
            </div>
        </div>

        <div class="table-responsive product-list">

            <table class="table table-bordered table-striped mt-0" id="roomList">
                <thead>
                    <tr>
                        <th class="align-middle text-center">Serial No</th>
                        <th class="align-middle text-center">Room Name</th>
                        <th class="align-middle text-center">Capacity</th>
                        <th class="align-middle text-center">Status</th>
                        <th class="align-middle text-center">Action</th>
                    </tr>
                </thead>
                <tbody>

            </table>
        </div>
    </div>
    <!--/Order Listing-->
    <!--Order Update Modal-->
    <div id="addEmployeeModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="add-room">
                    {{ csrf_field() }}
                    <div class="modal-header">
                        <h4 class="modal-title">Add Room</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Name of Room</label>
                            <input type="text" name="name" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Capacity</label>
                            <input type="number" name="capacity" class="form-control" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                        <input type="submit" class="btn btn-primary" value="Save">
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Delete Modal HTML -->
    <div id="deleteEmployeeModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <form>
                    <div class="modal-header">
                        <h4 class="modal-title">Delete Room</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body">
                        <p>Are you sure you want to delete these Room Data Records?</p>
                        <p class="text-warning"><small>This action cannot be undone.</small></p>
                    </div>
                    <div class="modal-footer">
                        <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                        <input type="button" class="btn btn-danger" value="Delete">
                    </div>
                </form>
            </div>
        </div>
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
        $.ajax({
            type: "GET",
            url: "{{ URL::to('/roomlist') }}",
            success: function (response) {
                if (response.length != 0) {
                    $('#roomList').show();
                    $('#roomList tbody').html(response);
                } else {
                    $('#roomList').hide();
                }
            },
            error: function (error) {
                alert('error');
            }
        });
        //USERLIST WITH FUNCTION CALL
        function roomlist() {
            $.ajax({
                type: "GET",
                url: "{{ URL::to('/roomlist') }}",
                success: function (response) {
                    if (response.length != 0) {
                        $('#roomList').show();
                        $('#roomList tbody').html(response);
                    } else {
                        $('#roomList').hide();
                    }
                },
                error: function (error) {
                    alert('error');
                }
            });
        }
        $('#add-room').on('submit', function (e) {
            e.preventDefault();
            $.ajax({
                type: 'POST',
                url: "{{ URL::to('/addroom') }}",
                data: $("#add-room").serialize(),
                success: function (response) {
                    $("#add-room").trigger('reset');
                    $("#addEmployeeModal").modal('hide');
                    roomlist();
                    swal('Done!', "Room added successfully", "success");
                    console.log(response);
                },
                error: function (error) {
                    $("#addEmployeeModal").modal('hide');
                    swal('Error!', "Something went Wrong, Please Try Again.", "error");
                    console.log('error');
                }
            });
        });
        function remove(id) {
            var id = id;
            $.ajax({
                type: "GET",
                url: "{{ URL::to('/deleteroom') }}" + '/' + id,
                success: function (response) {
                    console.log(response);
                    roomlist();
                    swal('Done!', "Room Delete successfully", "success");
                },
                error: function (error) {
                    swal('Error!', "Something went Wrong, Please Try Again.", "error");
                    console.log('Error');
                }
            });
        }

        function updateName(id){
		var name = $('#name'+id).html();
        $.ajax({
            type: "GET",
            data: {
				name:name,
            },
            url: "{{ URL::to('/updateroom') }}" + '/' + id,
            success: function (response) {
                console.log(response);
                roomlist();
            },
            error: function (error) {
                console.log('Error');
            }
        });
	}
    function updateCapacity(id){
		var capacity = $('#capacity'+id).html();
        $.ajax({
            type: "GET",
            data: {
				capacity:capacity,
            },
            url: "{{ URL::to('/updateroom') }}" + '/' + id,
            success: function (response) {
                console.log(response);
                roomlist();
            },
            error: function (error) {
                console.log('Error');
            }
        });
	}
    function updateStatus(id){
		var status = $('#status'+id).html();
        $.ajax({
            type: "GET",
            data: {
				status:status,
            },
            url: "{{ URL::to('/updateroom') }}" + '/' + id,
            success: function (response) {
                console.log(response);
                roomlist();
            },
            error: function (error) {
                console.log('Error');
            }
        });
	}
    </script>
    @stop