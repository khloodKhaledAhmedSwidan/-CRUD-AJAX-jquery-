<?php
include("db.php");
$search = $_POST['search'];
if (!empty($search)) {
    $query = "SELECT * FROM cars WHERE cars LIKE '$search%'";
    $search_query = mysqli_query($connection, $query);
    $count = mysqli_num_rows($search_query);
    if (!$search_query) {
        die('query failed' . mysqli_error($connection));
    }
    if($count <= 0){
        echo "sorry we do not have a car";
    }else{
        while ($row = mysqli_fetch_array($search_query)) {
            $brand = $row['cars'];
            ?>
            <ul class="list-unstyled">
                <?php
                echo "<li>{$brand} in stock</li>";
                ?>
            </ul>
            <?php
        }


    }


}
?>