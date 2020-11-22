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
	<title>Covideye &#124; Find Test Kit</title>
	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<link rel="stylesheet" href="/Assignment/assets/bootstrap/css/bootstrap-grid.min.css">
    <link rel="stylesheet" href="/Assignment/assets/bootstrap/css/bootstrap-reboot.min.css">
	<script src="https://kit.fontawesome.com/9a924aeb9b.js" crossorigin="anonymous"></script>
	<!-- Libraries CSS Files -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<!-- Main CSS -->
	<link rel="stylesheet" href="/Assignment/assets/css/residence.css" type="text/css" media="screen">
	
	<script src= 
"https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"> 
    </script> 
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

	<!--navigation-->
	<nav class="navbar navbar-expand-md navbar-dark bg-dark sticky-top">
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent">
		<span class="navbar-toggler-icon"></span>
		</button>

		<div class="collapse navbar-collapse" id="navbarSupportedContent">
			<ul class="nav nav-pills" role="tablist">
				<li class="nav-item pill-1">
					<a class="nav-link" href=""><b>Covideye</b></a>
				</li>
				<li class="nav-item pill-2">
					<a class="nav-link" href="/Assignment/assets/php/registerTestCentreb.php">Register Test Centre</a>
				</li>
				<li class="nav-item pill-3">
					<a class="nav-link" href="/Assignment/assets/php/recordTester.php">Record Tester</a>
				</li>
				<li class="nav-item pill-4">
					<a class="nav-link active" href="/Assignment/assets/php/findTestKit.php">Manage Test Kit Stock</a>
				</li>
				<li class="nav-item pill-5">
					<a class="nav-link" href="/Assignment/assets/php/allTestReportManager.php">Generate Test Report</a>
				</li>
				<li class="nav-item pill-6">
					<a class="nav-link" href="viewResidences.php?signout='1'"><i class="fa fa-sign-out"></i> Log Out</a>
				</li>
			</ul>
		</div>
	</nav>


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
		<?php
			//connect to database
			$conn = new mysqli("localhost","root","", "covideye");
			if ($conn->connect_error){
				die("Connection failure: " . mysqli_connect_error());
			}

			//fetch data from three tables in the database
			$query = "SELECT * FROM testkit";
			$result = mysqli_query($conn, $query);

		?>

		<!--register form-->
		<div class="container" id="register">
			<form action="/Assignment/assets/php/displayTestKitStock.php" method="POST" class="needs-validation" enctype="multipart/form-data" novalidate>
			<div class="card card-outline-secondary">
				<div class="card-header">
					<center><h3 class="mb-0" style="color:#3399ff;"><i class="fas fa-laptop-medical"></i> Manage Test Kit Stock</h3></center>
				</div>

				<div class="card-body">
					<div class="form-group row">
						<label for="testcentrename" class="col-sm-6 col-lg-3 col-form-label"><i class="fa fa-medkit"></i> Test Kit Name</label>
						<div class="col-sm-12 col-lg-9">
						<div class="col-sm-12 col-lg-9">
							<select class="form-control" name="testkit_name" id="testKitName">
							
							<?php
										
								if (mysqli_num_rows($result) > 0)
								{
									while($row = mysqli_fetch_array($result))
									{
							?>
							
								<option><?php echo $row['TestName']; ?></option><?php }} else { ?>
								<option>No test kit available!</option><?php } ?>
							</select>
						</div>
						</div>
					</div>
					
					<br><br>
					

					<div class="form-group row">
                         <label class="col-lg-1 col-form-label form-control-label"></label>
						<div class="col-lg-11">
							<input type="submit" id="mySubmit" class="btn btn-primary" name="mySubmit" value="Update">
							&nbsp;&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;
							<a class="btn btn-primary" href="/Assignment/assets/php/createNewTestKitStock.php">Create New Test Kit</a>
							&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp;
							<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">View Test Kits</button>
						</div>
					</div>
					
					<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
						<div class="modal-dialog" role="document">
							<div class="modal-content">
								<div class="modal-header">
									<h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-medkit"></i> Test Kits Info</h5>
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>
								
								<?php
									//connect to database
									$conn = new mysqli("localhost","root","", "covideye");
									if ($conn->connect_error){
										die("Connection failure: " . mysqli_connect_error());
									}

									//fetch data from three tables in the database
									$query = "SELECT * FROM testkit";
									$result = mysqli_query($conn, $query);

								?>
								
								<div class="modal-body">
									<div class="input-group mb-3">
										<div class="input-group-prepend">
											<span class="input-group-text" id="basic-addon1"><i class="fas fa-search"></i></span>
										</div>
										<input type="text" class="form-control" id="gfg" placeholder="Search for test kit..." aria-label="Username" aria-describedby="basic-addon1"><br>
									</div>
									
									<table class="table table-hover table-responsive">
										<thead>
											<tr>
												<th scope="col" class="align-middle">Test Kit ID</th>
												<th scope="col" class="align-middle">Name of Test Kit</th>
												<th scope="col" class="align-middle">Available Stock</th>
											</tr>
										</thead>
									
										<?php
										
										if (mysqli_num_rows($result) > 0)
										{
											while($row = mysqli_fetch_array($result))
											{
										?>
										<tbody id="testKitData">
											<tr>
												<td><?php echo $row['KitID']; ?></td>
												<td><?php echo $row['TestName']; ?></td>
												<td><?php echo $row['AvailableStock']; ?></td>
											</tr>
										</tbody>
										<?php }} ?>
									</table>
									
									<script> 
										$(document).ready(function() { 
											$("#gfg").on("keyup", function() { 
												var value = $(this).val().toLowerCase(); 
												$("#testKitData tr").filter(function() { 
													$(this).toggle($(this).text() 
													.toLowerCase().indexOf(value) > -1) 
												}); 
											}); 
										}); 
									</script> 
								</div>
								
								<div class="modal-footer">
									<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
								</div>
							</div>
						</div>
					</div>
				</div>
			</form>
			</div>
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
