<?php
  session_start();

  //if user is not login then will redirect back to homepage, and notify they need to login first
  if (!isset($_SESSION['tester_username'])) {
	echo "<script type='text/javascript'>
	alert('Please login first before using our website!');
	window.location = '/Assignment/index.html';</script>";
  }

  //after clicking the sign out, destroy that session[$username] and return to homepage
  if (isset($_GET['signout'])) {
  	session_destroy();
  	unset($_SESSION['tester_username']);
  	header("location: /Assignment/index.html");
  }
?>

<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Covideye &#124; Record/Update Test</title>
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
					<a class="nav-link active" href="/Assignment/assets/php/recordNewTest.php">Record/Update Test</a>
				</li>
				<li class="nav-item pill-3">
					<a class="nav-link" href="/Assignment/assets/php/allTestReport.php">Generate All Test Reports</a>
				</li>
				<li class="nav-item pill-4">
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
				<h2 class="align-left pb-3 fonts-style display-4">Welcome, <?php echo $_SESSION['tester_username']; ?>!</h2>
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
			<form name="registration" action="/Assignment/assets/php/patientRegister.php" method="POST" class="needs-validation" enctype="multipart/form-data" novalidate>
			<div class="card card-outline-secondary">
				<div class="card-header">
					<center><h3 class="mb-0" style="color:#3399ff;"><i class="fas fa-hospital-user"></i> Record New Test</h3></center>
				</div>

				<div class="card-body">
					<div class="form-group row">
						<label for="username" class="col-sm-6 col-lg-3 col-form-label"><i class="fa fa-user"></i> Username</label>
						<div class="col-sm-12 col-lg-9">
							<input type="username" class="form-control" id="patientUsername" placeholder="Patient's username" name="patient_username" required>
							<div class="invalid-feedback">Please enter patient's username.</div>
						</div>
					</div>

					<div class="form-group row">
						<label for="password" class="col-sm-6 col-lg-3 col-form-label"><i class="fa fa-key"></i> Password</label>
						<div class="col-sm-12 col-lg-9">
							<input type="password" class="form-control" id="password" placeholder="Password" name="patient_password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}" onkeyup='saveValue(this); 'required> &nbsp
							<label style="font-size:14px; color:grey;"><input type="checkbox" style="margin-top:15px;" onclick="showPassword()"> Show Password</label>
							<div class="invalid-feedback">Your password must include at least one number, one upper and lower case letters with 6 or more characters.</div>
						</div>
					</div>
					
					<div class="form-group row">
						<label for="fullname" class="col-sm-6 col-lg-3 col-form-label"><i class="fa fa-users"></i> Full Name (As in NRIC)</label>
						<div class="col-sm-12 col-lg-9">
							<input type="name" class="form-control" id="patientName" placeholder="Eg. MARILYN MICHAUD" name="patient_fullname" pattern="[A-Z\s]+" onkeyup='saveValue(this); 'required>
							<div class="invalid-feedback">Please enter patient's full name in upper case letters.</div>
						</div>
					</div>
					
					<div class="form-group row">
						<label for="patientType" class="col-sm-6 col-lg-3 col-form-label"><i class="fas fa-diagnoses"></i> Patient Type</label>
						<div class="col-sm-12 col-lg-9">
							<select class="form-control" name="patient_type" id="patientType" onkeyup='saveValue(this); '>
								<option>Returnee</option>
								<option>Quarantined</option>
								<option>Close Contact</option>
								<option>Infected</option>
								<option>Suspected</option>
							</select>
						</div>
					</div>
					
					<div class="form-group row">
						<label for="patientSymptoms" class="col-sm-6 col-lg-3 col-form-label"><i class="fas fa-head-side-cough"></i> Symptoms</label>
						<div class="col-sm-12 col-lg-9">
							<input type="name" class="form-control" id="symptoms" placeholder="Patient's Symptoms" name="patient_symptoms" onkeyup='saveValue(this); ' required>
							<div class="invalid-feedback">Please enter patient's symptoms</div>
						</div>
					</div>
					
					<div class="form-group row">
						<label for="testKitName" class="col-sm-6 col-lg-3 col-form-label"><i class="fa fa-medkit"></i> Test Kit to be Used</label>
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
							<script>
								var dropdown = document.getElementById("testKitName");
								dropdown.onchange = function(event){
									var text = dropdown.options[dropdown.selectedIndex].text;
									if(text=="ABC" || text=="Test"){
										alert('This test kit is out of stock! Please select another test kit.');
									}
								}
							</script>
						</div>
					</div>
					
					
					
								
					<br>
					
					<div class="form-group row">
                         <label class="col-lg-3 col-form-label form-control-label"></label>
						<div class="col-lg-9">
							<input type="submit" id="mySubmit" class="btn btn-primary" name="mySubmit" value="Save">
							&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;
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
			</form>
			<br>
			
			<div class="input-group mb-3">
				<div class="input-group-prepend">
					<span class="input-group-text" id="basic-addon1"><i class="fas fa-search"></i></span>
				</div>
				<input type="text" id="findPatient" placeholder="Search for patient here..." aria-label="Username" aria-describedby="basic-addon1">
			</div>
			
				<table class="table table-hover table-responsive">
					<?php
						//connect to database
						$conn = new mysqli("localhost","root","", "covideye");
						if ($conn->connect_error){
						die("Connection failure: " . mysqli_connect_error());
						}

						//fetch data from three tables in the database
						$query = "Select PatientUsername , PatientPassword, PatientName , PatientType,PatientSymptoms,TesterUsername , TestID , TestDate , ResultDate,Result from patient , CovidTest where patient.PatientID = CovidTest.PatientID;";
						$resultInner = mysqli_query($conn, $query);
					?>
				
					<thead>
						<tr>
							<th scope="col" class="align-middle">Test ID</th>
							<th scope="col" class="align-middle">Patient Username</th>
							<th scope="col" class="align-middle">Patient Password</th>
							<th scope="col" class="align-middle">Patient Full Name</th>
							<th scope="col" class="align-middle">Patient Type</th>
							<th scope="col" class="align-middle">Symptoms</th>
							<th scope="col" class="align-middle">Date of Test</th>
							<th scope="col" class="align-middle">Update Patient Type &amp; Symptoms</th>
							<th scope="col" class="align-middle">Date of Result</th>
							<th scope="col" class="align-middle">Test Result</th>
							<th scope="col" class="align-middle">Update Test Result</th>
						</tr>
					</thead>
					
					<?php
						// If the data exist in the table row, loop through the row from the database
						// Print application records
						if (mysqli_num_rows($resultInner) == 0) { ?> 
							<h5 style="color: red;"><center><i class="fas fa-exclamation-circle"></i><b> No test has been recorded...</b></center></h5>
					<?php
						} else {
							while($record = mysqli_fetch_array($resultInner))
							{
					?>

					<tbody id="patientData">
						<tr>
							<td><?php echo $record['TestID']; ?></td>
							<td><?php echo $record['PatientUsername']; ?></td>
							<td><?php echo $record['PatientPassword']; ?></td>
							<td><?php echo $record['PatientName']; ?></td>
							<td><?php echo $record['PatientType']; ?></td>
							<td><?php echo $record['PatientSymptoms']; ?></td>
							<td><?php echo $record['TestDate']; ?></td>
							<td><button type="button" class="btn2 btn-primary" data-toggle="modal" data-target="#createTest<?php echo $record['PatientUsername']; ?>" >Update</button></td>
							<td><?php 
							if($record['ResultDate'] == null){
								echo "Pending";
							}
							else{
							echo $record['ResultDate']; 
							}
							?></td>
							<td><?php 
							if($record['Result'] == null){
								echo "Pending";
							}
							else{
							echo $record['Result']; 
							}
							?></td>
							<td><?php 
							if($record['Result'] == null){
								echo '<button type="button" class="btn2 btn-primary" data-toggle="modal" data-target="#updateTest'.$record['TestID'].'" >Update</button>'; 
							}
							?></td>
						</tr>
					</tbody>
					
					<form action="/Assignment/assets/php/patientRegisterb.php" method="POST" class="needs-validation" novalidate>
					<div class="modal fade" id="createTest<?php echo $record['PatientUsername']; ?>" tabindex="-1" role="dialog">
						<div class="modal-dialog modal-dialog-centered" role="document">
							<div class="modal-content">
								<div class="modal-header">
									<h5 class="modal-title" id="exampleModalLongTitle">Please update the patient type and symptoms for this patient:</h5>
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>
								<div class="modal-body">
									<div class="form-group row">

										<label for="username" class="col-sm-6 col-lg-6 col-form-label"><i class="fa fa-user"></i> Patient's Username</label>
										<div class="col-sm-12 col-lg-6">
											<!--receive the username from SESSION[$username]-->
											<input type="name" class="form-control" value="<?php echo $record['PatientUsername']; ?>" name="patient_username" readonly><br>
										</div>

										<label for="residencename" class="col-sm-6 col-lg-6 col-form-label"><i class="fa fa-key"></i> Password</label>
										<div class="col-sm-12 col-lg-6">
											<!--receive the ResidenceID from the while loop fetching through the triggered apply button-->
											<input type="text" class="form-control" value="<?php echo $record['PatientPassword']; ?>" name="patient_password" readonly><br>
										</div>

										<label for="residenceid" class="col-sm-6 col-lg-6 col-form-label"><i class="fa fa-users"></i> Patient's Full Name</label>
										<div class="col-sm-12 col-lg-6">
											<!--receive the ResidenceName from the while loop fetching through the triggered apply button-->
											<input type="text" class="form-control" value="<?php echo $record['PatientName']; ?>" name="patient_fullname" readonly><br>
										</div>
										
										<label for="residenceid" class="col-sm-6 col-lg-6 col-form-label"><i class="fas fa-diagnoses"></i> Patient Type</label>
										<div class="col-sm-12 col-lg-6">
											<select class="form-control" name="patient_type" id="patientType">
												<option>Returnee</option>
												<option>Quarantined</option>
												<option>Close Contact</option>
												<option>Infected</option>
												<option>Suspected</option>
											</select><br>
										</div>
										
										<label for="residenceid" class="col-sm-6 col-lg-6 col-form-label"><i class="fas fa-head-side-cough"></i> Symptoms</label>
										<div class="col-sm-12 col-lg-6">
											<input type="name" class="form-control" id="symptoms" placeholder="Patient's Symptoms" name="patient_symptoms" required>
											<div class="invalid-feedback">Please enter patient's symptoms</div><br>
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
										
										<label for="residenceid" class="col-sm-6 col-lg-6 col-form-label"><i class="fa fa-medkit"></i> Test Kit's Name</label>
										<div class="col-sm-12 col-lg-6">
											<select class="form-control" name="testkit_name" id="testKitName2">
							
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
									
									<div class="modal-footer">
										<input type="submit" class="btn btn-primary" name="submit" value="Save" >
									</div>
								</div>
							</div>
						</div>
					</div>
					</form>
					
					
					
					
					<form action="/Assignment/assets/php/updateTestResult.php" method="POST" class="needs-validation" novalidate>
					<div class="modal fade" id="updateTest<?php echo $record['TestID']; ?>" tabindex="-1" role="dialog">
						<div class="modal-dialog modal-dialog-centered" role="document">
							<div class="modal-content">
								<div class="modal-header">
									<h5 class="modal-title" id="exampleModalLongTitle">Please update the test result for this patient's test:</h5>
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>
								<div class="modal-body">
									<div class="form-group row">

										<label for="username" class="col-sm-6 col-lg-6 col-form-label"><i class="far fa-id-card"></i> Test ID:</label>
										<div class="col-sm-12 col-lg-6">
											<!--receive the test ID -->
											<input type="name" class="form-control" value="<?php echo $record['TestID']; ?>" name="testID" readonly><br>
										</div>

										<label for="residencename" class="col-sm-6 col-lg-6 col-form-label"><i class="fa fa-user"></i> Patient Username</label>
										<div class="col-sm-12 col-lg-6">
											<!--receive the username-->
											<input type="text" class="form-control" value="<?php echo $record['PatientUsername']; ?>" name="patientUsername" readonly><br>
										</div>

										
										<label for="residenceid" class="col-sm-6 col-lg-6 col-form-label"><i class="fas fa-diagnoses"></i> Patient Type</label>
										<div class="col-sm-12 col-lg-6">
											<!--receive the patient type-->
											<input type="text" class="form-control" value="<?php echo $record['PatientType']; ?>" name="patientType" readonly><br>
										</div>
										
										<label for="residenceid" class="col-sm-6 col-lg-6 col-form-label"><i class="fas fa-head-side-cough"></i> Symptoms</label>
										<div class="col-sm-12 col-lg-6">
											<!--receive the patient symptoms-->
											<input type="text" class="form-control" value="<?php echo $record['PatientSymptoms']; ?>" name="patientSymptoms" readonly><br>
										</div>
										
										<label for="residenceid" class="col-sm-6 col-lg-6 col-form-label"><i class="fas fa-calendar-alt"></i> Date of test</label>
										<div class="col-sm-12 col-lg-6">
											<!--receive the date of test-->
											<input type="text" class="form-control" value="<?php echo $record['TestDate']; ?>" name="testDate" readonly><br>
										</div>

									
										<label for="residenceid" class="col-sm-6 col-lg-6 col-form-label"><i class="fas fa-poll-h"></i> Result</label>
										<div class="col-sm-12 col-lg-6">
										<!--let user choose result-->
											<select class="form-control" name="result" id="result">
												<option value ="Positive">Positive</option>
												<option value ="Negative">Negative</option>
											</select><br>
										</div>
									</div>
									
									<div class="modal-footer">
										<input type="submit" class="btn btn-primary" name="submit" value="Update" >
									</div>
								</div>
							</div>
						</div>
					</div>
					</form>
					<?php }} ?>
					
				</table>
				<script> 
					$(document).ready(function() { 
						$("#findPatient").on("keyup", function() { 
							var value = $(this).val().toLowerCase(); 
							$("#patientData tr").filter(function() { 
								$(this).toggle($(this).text() 
								.toLowerCase().indexOf(value) > -1) 
							}); 
						}); 
					}); 
				</script> 
				</div>	
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
