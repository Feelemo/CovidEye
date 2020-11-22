<?php
session_start();

$centreID = $_POST["testCentreID"];

//connect to Database
$conn = new mysqli("localhost","root","","covideye");
if ($conn->connect_error){
	die("Connection failure");
}

//check username and password from database
$sql = " select * from testcentre where CentreID = '$centreID' ";
$result = $conn->query($sql);
if ($result->num_rows > 0){
	$_SESSION['centreID'] = $centreID;
	echo "<script type='text/javascript'>
		window.location = '/Assignment/assets/php/displayTestCentre.php'; </script>";
} else {
	echo "<script type='text/javascript'>
		alert('The test centre ID is not found!');
		window.location = '/Assignment/assets/php/registerTestCentreb.php'; </script>";
}
?>
