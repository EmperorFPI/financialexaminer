<?php

    //connect to the database
      include 'config.php';

$conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

    if(!$conn){
      die("Connection failed: " . mysqli_connect_error());
    }
    $year = mysqli_real_escape_string($conn, $_POST['year']);
    $result = mysqli_query($conn,"SELECT DISTINCT `make` FROM `car_db` WHERE `year` = '$year'");
        if (mysqli_num_rows($result) > 0) {
        $makes = array();
        while($row = mysqli_fetch_assoc($result)) {
            array_push($makes, $row['make']);
        }
        echo json_encode($makes);
    } else {
        echo json_encode(array());
    }
    mysqli_close($conn);
    




?>