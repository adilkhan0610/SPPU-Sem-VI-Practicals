<!DOCTYPE html>
<html>

<head>

<title>Employee CRUD AJAX</title>

<link rel="stylesheet" href="style.css">

<link rel="stylesheet"
href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</head>

<body>

<div class="container">

<h1>Employee Management</h1>

<button id="addBtn" class="btn btn-primary">
Add Employee
</button>

<table class="table table-striped">

<thead>

<tr>
<th>ID</th>
<th>Name</th>
<th>City</th>
<th>Actions</th>
</tr>

</thead>

<tbody id="employeeTable"></tbody>

</table>

</div>

<!-- Modal -->

<div class="modal fade" id="employeeModal">

<div class="modal-dialog">

<div class="modal-content">

<div class="modal-header">

<h5 id="modalTitle">
Add Employee
</h5>

<button
type="button"
class="close"
data-dismiss="modal">

&times;

</button>

</div>

<div class="modal-body">

<form id="employeeForm">

<input type="hidden" id="id">

<label>Name</label>

<input
type="text"
id="name"
class="form-control"
required>

<label>City</label>

<input
type="text"
id="city"
class="form-control"
required>

<br>

<button
type="submit"
class="btn btn-primary">

Save

</button>

</form>

</div>

</div>

</div>

</div>

<script>

$(document).ready(function(){

    fetchData();

    $("#addBtn").click(function(){

        $("#employeeForm")[0].reset();

        $("#id").val('');

        $("#modalTitle").text("Add Employee");

        $("#employeeModal").modal("show");

    });

    $("#employeeForm").submit(function(e){

        e.preventDefault();

        var id = $("#id").val();
        var name = $("#name").val();
        var city = $("#city").val();

        var action = id ? "update" : "insert";

        $.ajax({

            url: "ajax.php",

            type: "POST",

            data: {
                action: action,
                id: id,
                name: name,
                city: city
            },

            dataType: "json",

            success: function(res){

                $("#employeeModal").modal("hide");

                fetchData();

            }

        });

    });

    $(document).on("click", ".editBtn", function(){

        $("#id").val($(this).data("id"));

        $("#name").val($(this).data("name"));

        $("#city").val($(this).data("city"));

        $("#modalTitle").text("Update Employee");

        $("#employeeModal").modal("show");

    });

    $(document).on("click", ".deleteBtn", function(){

        var id = $(this).data("id");

        if(confirm("Are you sure?")){

            $.post(
                "ajax.php",
                {
                    action:"delete",
                    id:id
                },

                function(){
                    fetchData();
                },

                "json"
            );

        }

    });

});

function fetchData(){

    $.post(

        "ajax.php",

        {
            action:"fetch"
        },

        function(res){

            var html = "";

            res.data.forEach(function(emp){

                html +=
                "<tr>" +

                "<td>"+emp.id+"</td>" +

                "<td>"+emp.name+"</td>" +

                "<td>"+emp.city+"</td>" +

                "<td>" +

                "<button class='btn btn-warning editBtn' data-id='"
                +emp.id+
                "' data-name='"
                +emp.name+
                "' data-city='"
                +emp.city+
                "'>Edit</button> " +

                "<button class='btn btn-danger deleteBtn' data-id='"
                +emp.id+
                "'>Delete</button>" +

                "</td>" +

                "</tr>";

            });

            $("#employeeTable").html(html);

        },

        "json"
    );
}

</script>

</body>
</html>
