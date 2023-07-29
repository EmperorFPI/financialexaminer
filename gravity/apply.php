<!DOCTYPE html>
<html lang="en-us">

<head>
	<meta charset="utf-8">
	<title>Easy Car Refinance Application</title>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=5">
	<meta name="description" content="Secure Car Refinance Application">
	<meta name="author" content="Financial Examiner">
  <meta name="keywords" content="">
	<link rel="shortcut icon" href="images/favicon.png" type="image/x-icon">
	<link rel="icon" href="images/favicon.png" type="image/x-icon">

	<!-- # Google Fonts -->
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Rubik:wght@400;500;700&display=swap" rel="stylesheet">

	<!-- # CSS Plugins -->
	<link rel="stylesheet" href="plugins/slick/slick.css">
	<link rel="stylesheet" href="plugins/font-awesome/fontawesome.min.css">
	<link rel="stylesheet" href="plugins/font-awesome/brands.css">
	<link rel="stylesheet" href="plugins/font-awesome/solid.css">

	<!-- # Main Style Sheet -->
	<link rel="stylesheet" href="css/style.css">

</head>

<body>

<!-- navigation -->
<header class="navigation bg-tertiary">
	<nav class="navbar navbar-expand-xl navbar-light text-center py-3">
		<div class="container">
			<a class="navbar-brand" href="index.html">
				<img loading="prelaod" decoding="async" class="img-fluid" width="160" src="images/logo.png" alt="Financial Examiner">
			</a>
			<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"> <span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarSupportedContent">
				<ul class="navbar-nav mx-auto mb-2 mb-lg-0">
					<li class="nav-item"> <a class="nav-link" href="index.html">Home</a>
					</li>
					<li class="nav-item "> <a class="nav-link" href="about.html">About</a>
					</li>
					<li class="nav-item "> <a class="nav-link" href="how-it-works.html">How It Works</a>
					</li>
					<li class="nav-item "> <a class="nav-link" href="services.html">Services</a>
					</li>
					<li class="nav-item "> <a class="nav-link" href="contact.html">Contact</a>
					</li>
					<li class="nav-item dropdown"> <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">Pages</a>
						<ul class="dropdown-menu" aria-labelledby="navbarDropdown">
							<li><a class="dropdown-item " href="blog.html">Blog</a>
							</li>
							<li><a class="dropdown-item " href="blog-details.html">Blog Details</a>
							</li>
							<li><a class="dropdown-item " href="service-details.html">Service Details</a>
							</li>
							<li><a class="dropdown-item " href="faq.html">FAQ&#39;s</a>
							</li>
							<li><a class="dropdown-item " href="legal.html">Legal</a>
							</li>
							<li><a class="dropdown-item " href="terms.html">Terms &amp; Condition</a>
							</li>
							<li><a class="dropdown-item " href="privacy-policy.html">Privacy &amp; Policy</a>
							</li>
						</ul>
					</li>
				</ul>
				    <a href="#!" class="btn btn-outline-primary">Log In</a>
				    <a href="#!" class="btn btn-primary ms-2 ms-lg-3">Sign Up</a>
			</div>
		</div>
	</nav>
</header>
<?php
ob_clean();
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


  // Prepare and bind the insert statement
  $stmt = $mysqli->prepare("INSERT INTO applications (first_name, last_name, phone, email, address, city, state, zip, year, make, model) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
  $stmt->bind_param("sssssssssss", $first_name, $last_name, $phone, $email, $address, $city, $state, $zip, $year, $make, $model);

  // Execute the statement and check if it was successful
  if ($stmt->execute()) {
    // Set up the data to be sent to the API
    $data = array(
      "user" => array(
        "name" => "LENDWARD",
        "pass" => "#;2nu55hjU(^Wc)LqqjwJi_%[S+un9ojFEH4YmY^.l|yUvgwlojo>Tmh.AafXwDe",
        "apikey" => "r+7aMx_T+UQcBX;1NLjX*j)xK(B_KFR!2U2,ebMIqR(E9#Wth!maJo7L5T6ZA8fP"
    ),
        'lead' => array(
            'contact' => array(
                'first_name' => $first_name,
                'last_name' => $last_name,
                'phone' => $phone, 
                'email' => $email,
                'address' => $address,
                'city' => $city,
                'state' => $state,
                'zip' => $zip
                ),
              ), 
            'data' => array(
                'vehicle' => array(
                    'year' => $year,
                    'make' => $make,
                    'model' => $model
                )
            )
          );
              

    $data_string = json_encode($data);
    
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "https://wf.gravitylending.dev:8080/autos/leads/submit");
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Content-Type: application/json',
        'Content-Length: ' . strlen($data_string)
    ));
    
    // Send the request
    $response = curl_exec($ch);
    $status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

    // Check the status code
    if ($status_code == 200) {
      // The request was successful
      // Extract the application_id from the response
      $response_data = json_decode($response, true);
      $application_id = $response_data['data']['application_id'];
    
       // Update the record in the database
      $stmt = $mysqli->prepare("UPDATE applications SET application_id = ? WHERE email = ?");
      $stmt->bind_param("ss", $application_id, $email);
      $stmt->execute();
      $stmt->close();

      // Display the response data
// Prepare the SQL query
$sql = "SELECT * FROM applications WHERE application_id = ?";

// Bind the parameter to the statement
$stmt = $mysqli->prepare($sql);
$stmt->bind_param("s", $application_id);

// Execute the statement
$stmt->execute();

// Get the result set
$result = $stmt->get_result();

// Check if any rows were returned
if ($result->num_rows > 0) {
  // Fetch the row data
  $row = $result->fetch_assoc();

  // Display the row data
  echo '<div id="response-data">';
  echo '<h2>Application ID: '.$row['application_id'].'</h2>';
  echo '<p>First Name: '.$row['first_name'].'</p>';
  echo '<p>Last Name: '.$row['last_name'].'</p>';
  echo '<p>Phone: '.$row['phone'].'</p>';
  echo '<p>Email: '.$row['email'].'</p>';
  echo '<p>Address: '.$row['address'].'</p>';
  echo '<p>City: '.$row['city'].'</p>';
  echo '<p>State: '.$row['state'].'</p>';
  echo '<p>Zip: '.$row['zip'].'</p>';
  echo '</div>';
} else {
  // No rows matched the criteria
  echo "No matching records found.";
} 
    } 
} else {
    // There was an error
    // Handle the error
    echo "API request failed with status code " . $status_code;
}

  // Close the statement and connection
  $stmt->close();
  $mysqli->close();
  }
ob_end_flush();
?>
<footer class="section-sm bg-tertiary">
	<div class="container">
		<div class="row justify-content-between">
			<div class="col-lg-2 col-md-4 col-6 mb-4">
				<div class="footer-widget">
					<h5 class="mb-4 text-primary font-secondary">Service</h5>
					<ul class="list-unstyled">
						<li class="mb-2"><a href="service-details.html">Personal loans</a>
						</li>
						<li class="mb-2"><a href="service-details.html">Home Equity Loans</a>
						</li>
						<li class="mb-2"><a href="service-details.html">Student Loans</a>
						</li>
						<li class="mb-2"><a href="service-details.html">Mortgage Loans</a>
						</li>
						<li class="mb-2"><a href="service-details.html">Payday Loans</a>
						</li>
					</ul>
				</div>
			</div>
			<div class="col-lg-2 col-md-4 col-6 mb-4">
				<div class="footer-widget">
					<h5 class="mb-4 text-primary font-secondary">About</h5>
					<ul class="list-unstyled">
						<li class="mb-2"><a href="#!">Benefits</a>
						</li>
						<li class="mb-2"><a href="#!">Careers</a>
						</li>
						<li class="mb-2"><a href="#!">Our Story</a>
						</li>
						<li class="mb-2"><a href="#!">Team</a>
						</li>
					</ul>
				</div>
			</div>
			<div class="col-lg-2 col-md-4 col-6 mb-4">
				<div class="footer-widget">
					<h5 class="mb-4 text-primary font-secondary">Help</h5>
					<ul class="list-unstyled">
						<li class="mb-2"><a href="contact.html">Contact Us</a>
						</li>
						<li class="mb-2"><a href="faq.html">FAQs</a>
						</li>
					</ul>
				</div>
			</div>
			<div class="col-lg-4 col-md-12 newsletter-form">
				<div style="background-color: #F4F4F4; padding: 35px;">
					<h5 class="mb-4 text-primary font-secondary">Subscribe</h5>
					<div class="pe-0 pe-xl-5">
						<form action="#!" method="post" name="mc-embedded-subscribe-form" target="_blank">
							<div class="input-group mb-3">
								<input type="text" class="form-control shadow-none bg-white border-end-0" placeholder="Email address"> <span class="input-group-text border-0 p-0">
                    <button class="input-group-text border-0 bg-primary" type="submit" name="subscribe"
                      aria-label="Subscribe for Newsletter"><i class="fas fa-arrow-right"></i></button>
                  </span>
							</div>
							<div style="position: absolute; left: -5000px;" aria-hidden="true">
								<input type="text" name="b_463ee871f45d2d93748e77cad_a0a2c6d074" tabindex="-1">
							</div>
						</form>
					</div>
					<p class="mb-0">Lorem ipsum dolor sit amet, rdghds consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat</p>
				</div>
			</div>
		</div>
		<div class="row align-items-center mt-5 text-center text-md-start">
			<div class="col-lg-4">
        <a href="index.html">
          <img loading="prelaod" decoding="async" class="img-fluid" width="160" src="images/logo.png" alt="Wallet">
        </a>
			</div>
			<div class="col-lg-4 col-md-6 mt-4 mt-lg-0">
				<ul class="list-unstyled list-inline mb-0 text-lg-center">
					<li class="list-inline-item me-4"><a class="text-black" href="privacy-policy.html">Privacy Policy</a>
					</li>
					<li class="list-inline-item me-4"><a class="text-black" href="terms.html">Terms &amp; Conditions</a>
					</li>
				</ul>
			</div>
			<div class="col-lg-4 col-md-6 text-md-end mt-4 mt-md-0">
				<ul class="list-unstyled list-inline mb-0 social-icons">
					<li class="list-inline-item me-3"><a title="Explorer Facebook Profile" class="text-black" href="https://facebook.com/"><i class="fab fa-facebook-f"></i></a>
					</li>
					<li class="list-inline-item me-3"><a title="Explorer Twitter Profile" class="text-black" href="https://twitter.com/"><i class="fab fa-twitter"></i></a>
					</li>
					<li class="list-inline-item me-3"><a title="Explorer Instagram Profile" class="text-black" href="https://instagram.com/"><i class="fab fa-instagram"></i></a>
					</li>
				</ul>
			</div>
		</div>
	</div>
</footer>


<!-- # JS Plugins -->
<script src="plugins/jquery/jquery.min.js"></script>
<script src="plugins/bootstrap/bootstrap.min.js"></script>
<script src="plugins/slick/slick.min.js"></script>
<script src="plugins/scrollmenu/scrollmenu.min.js"></script>

<!-- Main Script -->
<script src="js/script.js"></script>

</body>
</html>
