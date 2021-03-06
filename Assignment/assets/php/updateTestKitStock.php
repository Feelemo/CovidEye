<?php
  session_start();

  //if user is not login then will redirect back to homepage, and notify they need to login first
  if (!isset($_SESSION['username'])) {
	echo "<script type='text/javascript'>
	alert('Please login first before accessing the system.');
	window.location = '/Assignment/index.html';</script>";
  }

  //after clicking the sign out, destroy that session[$username] and return to homepage
  if (isset($_GET['signout'])) {
  	session_destroy();
  	unset($_SESSION['username']);
  	header("location: /Assignment/index.html");
  }
?>

<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title>Covideye &#124; Update Test Kit Stock</title>

	<!-- Bootstrap CSS -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

	<!-- Libraries CSS Files -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

	<!-- Font special for pages-->
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i">

	<!-- Font Icon -->
<link rel="stylesheet" href="fonts/material-icon/css/material-design-iconic-font.min.css">
<script src="https://kit.fontawesome.com/9a924aeb9b.js" crossorigin="anonymous"></script>
	<!-- Main CSS -->
	<link rel="stylesheet" href="/Assignment/assets/css/residence.css" type="text/css" media="screen">

</head>
<body>
	<!--top section-->
	<section id="topbar" class="d-none d-lg-block">
		<div class="container-fluid clearfix">
			<div class="contact-info float-left">
				<i class="fa fa-envelope-o"></i> <a href="mailto:contact@example.com">contactCovideye@hotmail.com</a>
				<i class="fa fa-phone"></i> +6012-345678
			</div>
			<div class="social-links float-right">
				<a href="#" class="facebook"><i class="fa fa-facebook"></i></a>
				<a href="#" class="instagram"><i class="fa fa-instagram"></i></a>
				<a href="#" class="twitter"><i class="fa fa-twitter"></i></a>
			</div>
		</div>
	</section>

    <br><br>
	<!--Residences-->
    <div class="container">
        <div class="row" id="residenceList">
            <!--Titles-->
            <div class="pb-5 col-12">
				<!--retrive the username after login -->
				<h2 class="align-left pb-3 fonts-style display-4">Welcome, <?php echo $_SESSION['username']; ?>!</h2>
				<hr>
            </div>
		</div>
	</div>

	<!--form-->
	<div class="col-md-8 offset-md-2">

		<!--register form-->
		<div class="container" id="register">
			<form action="/Assignment/assets/php/displayTestKitStock.php" method="POST" class="needs-validation" enctype="multipart/form-data" novalidate>
			<div class="card card-outline-secondary">
				<div class="card-header">
					<center><h3 class="mb-0" style="color:#3399ff;"><i class="fas fa-laptop-medical"></i> Update Test Kit Stock</h3></center>
				</div>
				
				<?php
					// Connect to database
					$conn = new mysqli("localhost","root","", "covideye");
					
					if ($conn->connect_error){
						die("Connection failure: " . mysqli_connect_error());
					}

					// Select data
					$kitName = $_SESSION['kitName'];
					$query = "SELECT * FROM testkit WHERE TestName = '$kitName' LIMIT 1";
					$result = mysqli_query($conn, $query);

					$row = mysqli_fetch_array($result);

					// Fetch data
					$kitID = $row[0];
					$testName = $row[1];
					$availableStock = $row[2];
				?>

				<div class="card-body">
					<div class="form-group row">
						<label for="username" class="col-sm-6 col-lg-3 col-form-label font-weight-bold">Test Kit ID:</label>
						<div class="col-sm-12 col-lg-9">
							<input type="text" readonly class="form-control-plaintext" id="applicantNameInput" value="<?php echo "$kitID"; ?>">
						</div>
					</div>

					<div class="form-group row">
						<label for="username" class="col-sm-6 col-lg-3 col-form-label font-weight-bold">Name of Test Kit:</label>
						<div class="col-sm-12 col-lg-9">
							<input type="text" readonly class="form-control-plaintext" id="applicantNameInput" value="<?php echo "$testName"; ?>">
						</div>
					</div>

					<div class="form-group row">
						<label for="username" class="col-sm-6 col-lg-3 col-form-label font-weight-bold">Available Stock:</label>
						<div class="col-sm-12 col-lg-9">
							<input type="text" readonly class="form-control-plaintext" id="applicantNameInput" value="<?php echo "$availableStock"; ?>">
						</div>
					</div>
					
					<br>
			</form>
			
					<p><h5>Please update the available stock for the test kit ID <?php echo "$kitID"; ?>:</h5></p>
					
					<br>
					<form action="/Assignment/assets/php/updateNumberofStock.php" method="POST" class="needs-validation" enctype="multipart/form-data" novalidate>
					<div class="form-group row">
						<label for="testKitStock" class="col-sm-6 col-lg-3 col-form-label">Number of test kit stock:</label>
						<div class="col-sm-12 col-lg-9">
							<input type="number" class="form-control" id="name2" placeholder="" name="testkit_stock" min="1" required>
							<div class="invalid-feedback">Please enter the valid number. The minimum number to be updated is 1.</div>
						</div>
					</div>
					

					<br>
	
					<div class="form-group row">
                        <label class="col-lg-4 col-form-label form-control-label"></label>
						<div class="col-lg-8">
							<input type="submit" class="btn btn-primary" name="register" value="Save">
							&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;
							<a href="/Assignment/assets/php/findTestKit.php" class="btn btn-secondary">Cancel</a>
						</div>
					</div>
				</div>
			</div>
			</form>
		</div>
		<hr class="my-4">
	</div>

	<!-- Footer -->
	<footer class="page-footer font-small pt-4">
		<!-- Footer Links -->
		<div class="container text-center text-md-left">
			<!-- Grid row -->
			<div class="row">
				<!-- Grid column -->
				<div class="col-md-4 mx-auto">
					<!-- Content -->
					<h5 class="font-weight-bold text-uppercase mt-3 mb-4">
						<div id="company_logo" >
							<h1><a href="#" class="company_title">Covid<span>eye</span></a></h1>
						  </div>
					  </h5>
					<p>Keeping track of tests that have been performed at the various test centres.</p>
				</div>
				<!-- Grid column -->
				<hr class="clearfix w-100 d-md-none">
				<!-- Grid column -->
				
				<!-- Grid column -->
				<hr class="clearfix w-100 d-md-none">
				<!-- Grid column -->
				<div class="col-md-2 mx-auto">
					<!-- Links -->
					<h5 class="font-weight-bold text-uppercase mt-3 mb-4">Explore</h5>
					<ul class="list-unstyled">
						<li><a href="#!">Covideye</a></li>
						<li><a href="#!">Feedback</a></li>
						<li><a href="#!">Covid-19 Latest News</a></li>
					</ul>
				</div>
				<!-- Grid column -->
				<hr class="clearfix w-100 d-md-none">
				<!-- Grid column -->
				<div class="col-md-2 mx-auto">
					<!-- Links -->
					<h5 class="font-weight-bold text-uppercase mt-3 mb-4">Policies</h5>
					<ul class="list-unstyled">
						<li><a href="#!">Privacy statement</a></li>
						<li><a href="#!">Terms & Conditions</a></li>
					</ul>
				</div>
				<!-- Grid column -->
			</div>
			<!-- Grid row -->
		</div>
		<!-- Footer Links -->
		<hr>
		<!-- Social buttons -->
		<div id="social-platforms">
			<button type="button" class="btn btn-danger pinterest"><a href="#" class="pinterest_icon"><img src="/Assignment/assets/images/pinterest_icon.png"></a></button>
			<button type="button" class="btn btn-primary facebook"><a href="#" class="facebook_icon"><img src="/Assignment/assets/images/facebook_icon.png"></a></button>
			<button type="button" class="btn btn-info googleplus"><a href="#" class="googleplus_icon"><img src="/Assignment/assets/images/googlePlus_icon.png"></a></button>
		</div>
		<!-- Copyright -->
		<div class="footer-copyright text-center py-3">© 2020 Copyright:
			<a href="https://mdbootstrap.com/education/bootstrap/">Covideye.com</a>
		</div>
		<!-- Copyright -->
	</footer>

<!-- JavaScript Libraries -->
	<script src="/Assignment/lib/jquery/jquery.min.js"></script>
	<script src="/Assignment/lib/owlcarousel/owl.carousel.min.js"></script>
<!-- Template Main Javascript File -->
	<script type="text/javascript" src="/Assignment/assets/javascript/register.js"></script>
<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>
