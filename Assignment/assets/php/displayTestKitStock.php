<?php
session_start();

$kitName = $_POST["testkit_name"];

//connect to Database
$conn = new mysqli("localhost","root","","covideye");
if ($conn->connect_error){
	die("Connection failure");
}

//check username and password from database
$sql = " select * from testkit where TestName = '$kitName' ";
$result = $conn->query($sql);
if ($result->num_rows > 0){
	$_SESSION['kitName'] = $kitName;
	echo "<script type='text/javascript'>
		window.location = '/Assignment/assets/php/updateTestKitStock.php'; </script>";
} else {
	echo "<script type='text/javascript'>
		alert('The test kit ID is not found! Please record a new test kit stock.');
		window.location = '/Assignment/assets/php/createNewTestKitStock.php'; </script>";
}
?>
