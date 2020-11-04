$(document).ready(function () {
    $('.deleteAll').click(function (e) {
        e.preventDefault();
        $.ajax({
            type: "GET",
            url: '/Laravel-Ajax-SQL-Crud/crud/public//removeAll',
            success: function (response) {
                $("#deleteEmployeeModal").modal('hide');
                console.log(response);
            },
            error: function (response) {
                $("#deleteEmployeeModal").modal('hide');
                console.log(response);
            }
        });
    });
});