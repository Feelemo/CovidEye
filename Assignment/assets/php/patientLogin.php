<?php
session_start();

$username = $_POST["login_patientUsername"];
$password = $_POST["login_patientPassword"];

//connect to Database
$conn = new mysqli("localhost","root","","covideye");
if ($conn->connect_error){
	die("Connection failure");
}

//check username and password from database
$sql = " select * from patient where PatientUsername = '$username' and PatientPassword = '$password' ";
$result = $conn->query($sql);
if ($result->num_rows > 0){
	$_SESSION['patient_username'] = $username;
	echo "<script type='text/javascript'>
		window.location = '/Assignment/index.html'; </script>";
} else {
	echo "<script type='text/javascript'>
		alert('Invalid username or password!');
		window.location = '/Assignment/index.html'; </script>";
}
?>
