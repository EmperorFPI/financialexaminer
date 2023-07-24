<?php

    //connect to the database
      include 'config.php';

$conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

    if(!$conn){
      die("Connection failed: " . mysqli_connect_error());
    }
    $make = mysqli_real_escape_string($conn, $_POST['make']);
    $result = mysqli_query($conn,"SELECT DISTINCT `model` FROM `car_db` WHERE `make` = '$make'");
        if (mysqli_num_rows($result) > 0) {
        $models = array();
        while($row = mysqli_fetch_assoc($result)) {
            array_push($models, $row['model']);
        }
        echo json_encode($models);
    } else {
        echo json_encode(array());
    }
    mysqli_close($conn);
    




?>