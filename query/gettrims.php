<?php

// Connect to database 
include 'config.php';

$conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

if(!$conn){
  die("Connection failed: " . mysqli_connect_error());
}

$year = mysqli_real_escape_string($conn, $_POST['year']);
$make = mysqli_real_escape_string($conn, $_POST['make']);
$model = mysqli_real_escape_string($conn, $_POST['model']);

$sql = "SELECT DISTINCT `body_styles` FROM `car_db` 
        WHERE `year` = '$year' AND 
              `make` = '$make' AND
              `model` = '$model'";

$result = mysqli_query($conn, $sql);

if(mysqli_num_rows($result) > 0) {

  $body_styles = array();

  while($row = mysqli_fetch_assoc($result)) {
    array_push($body_styles, $row['body_styles']);
  }

  echo json_encode($body_styles);

} else {

  echo json_encode(array());

}

mysqli_close($conn);

?>
