<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Laravel CRUD with ajax & SQL</title>
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href={{ asset('css/style.css') }}>
	<meta name="csrf-token" content="{{ csrf_token() }}" />
</head>

<body>
	<div class="container-xl">
		<div class="table-responsive">
			<div class="table-wrapper">
				<div class="table-title">
					<div class="row">
						<div class="col-sm-6">
							<h2>Manage <b>Employees</b></h2>
						</div>
						<div class="col-sm-6">
							<a href="#addEmployeeModal" class="btn btn-success" data-toggle="modal"><i
									class="material-icons">&#xE147;</i> <span>Add New Employee</span></a>
							<!-- <a href="#deleteEmployeeModal" class="btn btn-danger" data-toggle="modal"><i class="material-icons">&#xE15C;</i> <span>Delete</span></a>						 -->
						</div>
					</div>
				</div>
				<table class="table table-striped table-hover" id="mytable">
					<thead>
						<tr>
							<th>Serial No</th>
							<th>Name</th>
							<th>Email</th>
							<th>Address</th>
							<th>Phone</th>
							<th>Actions</th>
						</tr>
					</thead>
					<tbody>
					</tbody>
				</table>
				<div class="clearfix">
					<div class="hint-text">Showing <b>5</b> out of <b>25</b> entries</div>
					<ul class="pagination">
						<li class="page-item disabled"><a href="#">Previous</a></li>
						<li class="page-item"><a href="#" class="page-link">1</a></li>
						<li class="page-item"><a href="#" class="page-link">2</a></li>
						<li class="page-item active"><a href="#" class="page-link">3</a></li>
						<li class="page-item"><a href="#" class="page-link">4</a></li>
						<li class="page-item"><a href="#" class="page-link">5</a></li>
						<li class="page-item"><a href="#" class="page-link">Next</a></li>
					</ul>
				</div>
			</div>
		</div>
	</div>
	<!-- Edit Modal HTML -->
	<div id="addEmployeeModal" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title">Add Employee</h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				</div>
				<form id="create-form">
					{{ csrf_field() }}
					<div class="modal-body">
						<div class="form-group">
							<label>Name</label>
							<input type="text" name="name" class="form-control" required>
						</div>
						<div class="form-group">
							<label>Email</label>
							<input type="email" name="email" class="form-control" required>
						</div>
						<div class="form-group">
							<label>Phone</label>
							<input type="text" name="phone" class="form-control" required>
						</div>
						<div class="form-group">
							<label>Address</label>
							<textarea class="form-control" name="address" required></textarea>
						</div>
					</div>
					<div class="modal-footer">
						<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
						<input type="submit" class="btn btn-success create" value="Add">
					</div>
			</div>
			</form>
		</div>
	</div>
	<!-- Edit Modal HTML -->
	<div id="editEmployeeModal" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<form>
					<div class="modal-header">
						<h4 class="modal-title">Edit Employee</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					</div>
					<div class="modal-body">
						<div class="form-group">
							<label>Name</label>
							<input type="text" class="form-control" required>
						</div>
						<div class="form-group">
							<label>Email</label>
							<input type="email" class="form-control" required>
						</div>
						<div class="form-group">
							<label>Address</label>
							<textarea class="form-control" required></textarea>
						</div>
						<div class="form-group">
							<label>Phone</label>
							<input type="text" class="form-control" required>
						</div>
					</div>
					<div class="modal-footer">
						<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
						<input type="submit" class="btn btn-info" value="Save">
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
						<h4 class="modal-title">Delete All Employees</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					</div>
					<div class="modal-body">
						<p>Are you sure you want to delete these Employees Data Records?</p>
						<p class="text-warning"><small>This action cannot be undone.</small></p>
					</div>
					<div class="modal-footer">
						<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
						<input type="button" class="btn btn-danger removeAll" value="Delete">
					</div>
				</form>
			</div>
		</div>
	</div>
</body>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
<script>
    //USERLIST
    $.ajax({
        type: "GET",
        url: '/Laravel-Ajax-SQL-Crud/crud/public/userlist',
        success: function (response) {
            $('#mytable tbody').html(response);
        },
        error: function (error) {
            alert('error');
        }
    });
    //USERLIST WITH FUNCTION CALL
    function userlist() {
        $.ajax({
            type: "GET",
            url: '/Laravel-Ajax-SQL-Crud/crud/public/userlist',
            success: function (response) {
                $('#mytable tbody').html(response);
            },
            error: function (error) {
                alert('error');
            }
        });
    }
    //REMOVE
    function remove(id) {
        var id = id;
        $.ajax({
            type: "GET",
            data: {
                id: id,
            },
            url: '/Laravel-Ajax-SQL-Crud/crud/public/remove/'+id,
            success: function (response) {
                console.log(response);
                userlist();
            },
            error: function (error) {
                console.log('Error');
            }
        });
    }
    //CREATE
    $('#create-form').on('submit', function (e) {
        e.preventDefault();
        $.ajax({
            type: 'POST',
            url: '/Laravel-Ajax-SQL-Crud/crud/public/create',
            data: $("#create-form").serialize(),
            success: function (response) {
                $("#create-form").trigger('reset');
                $("#addEmployeeModal").modal('hide');
                userlist();
                console.log(response);
            },
            error: function (error) {
                $("#addEmployeeModal").modal('hide');
                console.log('error');
            }
        });
	});

	function updateName(id){
		var name = $('#name'+id).html();
        $.ajax({
            type: "GET",
            data: {
				name:name,
            },
            url: '/Laravel-Ajax-SQL-Crud/crud/public/update/'+id,
            success: function (response) {
                console.log(response);
                userlist();
            },
            error: function (error) {
                console.log('Error');
            }
        });
	}
	function updateEmail(id){
		var email = $('#email'+id).html();
        $.ajax({
            type: "GET",
            data: {
				email:email,
            },
            url: '/Laravel-Ajax-SQL-Crud/crud/public/update/'+id,
            success: function (response) {
                console.log(response);
                userlist();
            },
            error: function (error) {
                console.log('Error');
            }
        });
	}
	function updatePhone(id){
		var phone = $('#phone'+id).html();
        $.ajax({
            type: "GET",
            data: {
				phone:phone,
            },
            url: '/Laravel-Ajax-SQL-Crud/crud/public/update/'+id,
            success: function (response) {
                console.log(response);
                userlist();
            },
            error: function (error) {
                console.log('Error');
            }
        });
	}
	function updateAddress(id){
		var address = $('#address'+id).html();
        $.ajax({
            type: "GET",
            data: {
				address:address,
            },
            url: '/Laravel-Ajax-SQL-Crud/crud/public/update/'+id,
            success: function (response) {
                console.log(response);
                userlist();
            },
            error: function (error) {
                console.log('Error');
            }
        });
	}
</script>
</html>