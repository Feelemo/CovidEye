<?php
session_start();
//declare error count for checking the existing of user/email
$errors = array();

//get the data from register as applicant page
$availableStock = $_POST["testkit_stock"];
$kitName = $_SESSION['kitName'];


//connect to mysql
$conn = new mysqli("localhost","root","", "covideye");
if ($conn->connect_error){
	die("Connection failure");
}

$sql = "UPDATE testkit SET availableStock = availableStock + '$availableStock' where TestName = '$kitName';";

if ($conn->query($sql) === TRUE) {
  echo "<script type='text/javascript'>
		alert('The available stock for the test kit Name $kitName has been updated successfully!');
		window.location = '/Assignment/assets/php/updateTestKitStock.php'; </script>";
} else {
  echo "Error updating record: " . $conn->error;
}

?>
