<?php
session_start();

$username = $_POST["login_testerUsername"];
$password = $_POST["login_testerPassword"];

//connect to Database
$conn = new mysqli("localhost","root","","covideye");
if ($conn->connect_error){
	die("Connection failure");
}

//check username and password from database
$sql = " select * from centreofficer where username = '$username' and password = '$password' ";
$result = $conn->query($sql);
if ($result->num_rows > 0){
	$_SESSION['tester_username'] = $username;
	echo "<script type='text/javascript'>
		window.location = '/Assignment/assets/php/recordNewTest.php'; </script>";
} else {
	echo "<script type='text/javascript'>
		alert('Wrong username or password!');
		window.location = '/Assignment/index.html'; </script>";
}
?>
