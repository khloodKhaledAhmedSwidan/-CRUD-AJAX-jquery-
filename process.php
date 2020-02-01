<?php
include('db.php');

//display action box data
if (isset($_POST['id'])) {

    $id = mysqli_real_escape_string($connection, $_POST['id']);

    $query = "SELECT * FROM cars WHERE id ={$id}";
    $query_cars_info = mysqli_query($connection, $query);
    if (!$query_cars_info) {
        die("query failed" . mysqli_error($connection));
    }
    while ($row = mysqli_fetch_array($query_cars_info)) {
        echo ' <p class="bg-success" id="feedback"></p>';
        echo "<input type='text' rel= '" . $row['id'] . "' class='form-control title-input' value='" . $row['cars'] . "'/>";
        echo "<input type='button' class='btn btn-success update' value='UPDATE'/>";
        echo "<input type='button' class='btn btn-danger delete' value='DELETE'/>";
        echo "<input type='button' class='btn btn-dark' value='close'/>";
    }
}
// update data
if (isset($_POST['updateThis'])) {
    $id = mysqli_real_escape_string($connection, $_POST['id']);
    $cars = mysqli_real_escape_string($connection, $_POST['cars']);
    $query = "UPDATE cars SET cars = '{$cars}' WHERE id = $id";
    $updateInfo = mysqli_query($connection, $query);
    if (!$updateInfo) {
        die("query failed");
    }

}


// delete data
if (isset($_POST['deleteThis'])) {

    $id = mysqli_real_escape_string($connection, $_POST['id']);

    $query = " DELETE FROM cars WHERE id = $id ";
    $deleteInfo = mysqli_query($connection, $query);
    if (!$deleteInfo) {
        die("query failed");
    }

}


?>
<script>

    $(document).ready(function () {
        var id;
        var cars;
        var updateThis = 'update';
        var deleteThis = 'delete';

        $(".title-input").on('input', function () {
            id = $(this).attr('rel');
            cars = $(this).val();

            // alert(cars);
        });
        // update button function
        $(".update").on('click', function () {
            $.post("process.php", {id: id, cars: cars, updateThis: updateThis}, function (data) {
                $("#feedback").text('updated successfully');

            });
        });

        // delete function
        $(".delete").on('click', function () {
            if (confirm('Are you sure you want to delete this?')) {
                id = $(".title-input").attr('rel');
                $.post("process.php", {id: id, deleteThis: deleteThis}, function (data) {

                    $("#action-container").hide();

                });
            }
        });
        // close function 
        $(".btn-dark").on('click', function () {
            $("#action-container").hide();
        });
    });

</script>
