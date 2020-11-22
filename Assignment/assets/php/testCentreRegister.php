<?php
session_start();
//declare error count for checking the existing of user/email
$errors = array();

//get the data from register as applicant page
$centrename = $_POST["testcentre_name"];
$centreaddress = $_POST["testcentre_address"];
$centrecontact = $_POST["testcentre_contact"];

//connect to mysql
$conn = new mysqli("localhost","root","", "covideye");
if ($conn->connect_error){
	die("Connection failure");
}

//use table
$testCentreTable = "use testcentre";
$result = $conn->query($testCentreTable);

//check user/email already exist or not
$user_check_query = "SELECT * FROM testcentre WHERE CentreName='$centrename' LIMIT 1";
$result = $conn->query($user_check_query);
$user = mysqli_fetch_assoc($result);
if ($user) {
	if ($user['CentreName'] === $centrename) {
	  array_push($errors, "test centre name already exists");
	  echo "<script type='text/javascript'>
		alert('The test centre name already exists. Please enter another test centre name.');
		window.location = '/Assignment/assets/php/registerTestCentre.php'; </script>";

	}
}

//register the data inside the database if there are no errors count from check user/email
if (count($errors) == 0) {
	$insertData = "insert into testcentre(CentreName, CentreAddress, CentreContact)
	values ('$centrename', '$centreaddress', '$centrecontact');";
	if ($conn->query($insertData)==TRUE){
		$_SESSION['centreName'] = $centrename;
		echo "<script type='text/javascript'>
		alert('This test centre has been registered successfully!');
		window.location = '/Assignment/assets/php/displayTestCentreb.php';</script>";
	}
}

?>
