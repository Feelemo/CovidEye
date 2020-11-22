<?php
//declare error count for checking the existing of user/email
session_start();

$errors = array();

//get the data from register as applicant page
$username = $_POST["tester_username"];
$password = $_POST["tester_password"];
$fullname = $_POST["tester_fullname"];
$position = "Tester";

//connect to mysql
$conn = new mysqli("localhost","root","", "covideye");
if ($conn->connect_error){
	die("Connection failure");
}

//use table
$centreOfficerTable = "use centreofficer";
$result = $conn->query($centreOfficerTable);

//check user/email already exist or not
$user_check_query = "SELECT * FROM centreofficer WHERE Username='$username' OR Name='$fullname' LIMIT 1";
$result = $conn->query($user_check_query);
$user = mysqli_fetch_assoc($result);
if ($user) {
	if ($user['Username'] === $username) {
	  array_push($errors, "Username already exists");
	  echo "<script type='text/javascript'>
		alert('The username already exists. Please enter another username.');
		window.location = '/Assignment/assets/php/recordTester.php'; </script>";

	}
}

$user_check_query = "SELECT * FROM patient WHERE PatientUsername='$username' OR PatientName='$fullname' LIMIT 1";
$result = $conn->query($user_check_query);
$user = mysqli_fetch_assoc($result);
if ($user) {
	if ($user['PatientUsername'] === $username) {
	  array_push($errors, "Username already exists");
	  echo "<script type='text/javascript'>
		alert('The username already exists. Please enter another username.');
		window.location = '/Assignment/assets/php/recordTester.php'; </script>";

	}
}

//register the data inside the database if there are no errors count from check user/email
if (count($errors) == 0) {
	$insertData = "insert into centreofficer(Username, Password, Name, Position)
	values ('$username', '$password', '$fullname', '$position');";
	$_SESSION['testerUsername'] = $username;
	if ($conn->query($insertData)==TRUE){
		echo "<script type='text/javascript'>
		alert('The tester has been recorded successfully!');
		window.location = '/Assignment/assets/php/displayTester.php'; </script>";
	}
}

?>
