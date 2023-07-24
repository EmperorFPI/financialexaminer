<?php  
// Start output buffering
ob_start();
// Set up database connection
if (file_exists('include.php')) {
  require_once('include.php');
} else {
  die("Config file not found");
}
// Connect to MySQL database
$mysqli = new mysqli("$servername","$username","$password","$dbname");
// Check if connection was successful
if ($mysqli->connect_errno) {
  echo "Failed to connect to MySQL: " . $mysqli->connect_error;
  exit();
}
// Check that the form has been submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  // Get the form data
  $first_name = $mysqli->real_escape_string($_POST['first_name']);
  $last_name = $mysqli->real_escape_string($_POST['last_name']);
  $phone = $mysqli->real_escape_string($_POST['phone']);
  $email = $mysqli->real_escape_string($_POST['email']);
  $address = $mysqli->real_escape_string($_POST['address']);
  $city = $mysqli->real_escape_string($_POST['city']);
  $state = $mysqli->real_escape_string($_POST['state']);
  $zip = $mysqli->real_escape_string($_POST['zip']);
  $year = $mysqli->real_escape_string($_POST['year']);
  $make = $mysqli->real_escape_string($_POST['make']);
  $model = $mysqli->real_escape_string($_POST['model']);
  $mileage = $mysqli->real_escape_string($_POST['mileage']);
  $loanbalance = $mysqli->real_escape_string($_POST['loanbalance']);
  // Prepare and bind the insert statement
  $stmt = $mysqli->prepare("INSERT INTO applications (first_name, last_name, phone, email, address, city, state, zip, year, make, model, mileage, loanbalance) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
  $stmt->bind_param("sssssssssssss", $first_name, $last_name, $phone, $email, $address, $city, $state, $zip, $year, $make, $model, $mileage, $loanbalance);
  // Execute the statement and check if it was successful
  if ($stmt->execute()) {
    // Send data to URL
    $query_string = http_build_query([
      'aid' => '267', // set the aid parameter
      'opt_1' => 'feapp',
      // add the rest of the form data as query parameters
      'fname' => $first_name,
      'lname' => $last_name,
      'applicant_cell_phone' => $phone,
      'email' => $email,
      'street' => $address,
      'city' => $city,
      'stateabbr' => $state,
      'zipcode' => $zip,
/*       'year' => $year,
      'make' => $make,
      'model' => $model,
      'mileage' => $mileage,
      'loanbalance' => $loanbalance */
    ]);
    $url = "https://openroadlending.com/applyone/?" . $query_string;
    ob_clean();
    header("Location: $url"); // redirect to the external URL with the form data as query parameters
    exit();
  }
  // Close the statement
  $stmt->close();
}
// Close the connection
$mysqli->close();
// End output buffering and send output to the browser
ob_end_flush();