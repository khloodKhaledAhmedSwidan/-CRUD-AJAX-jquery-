<?php
include('db.php');
$query = "SELECT * FROM cars";
$query_cars_info = mysqli_query($connection,$query);
if(!$query_cars_info){
    die("query failed" . mysqli_error($connection));
}
 while ($row = mysqli_fetch_array($query_cars_info)){
    echo "<tr>";
    echo "<td>{$row['id']}</td>";
    echo "<td><a class='title-link' rel='".$row['id']."' href='javascript:void(0)'>{$row['cars']}</a></td>";
    echo "</tr>";
 }
?>
<script>
$(document).ready(function () {
    $('.title-link').on('click',function () {
        $('#action-container').show();
        var id = $(this).attr("rel");
        $.post("process.php",{id:id},function (data) {
            $('#action-container').html(data);
        });

    });
});

</script>
