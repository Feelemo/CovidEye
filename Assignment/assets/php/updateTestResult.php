<?php
session_start();
//declare error count for checking the existing of user/email
$errors = array();

//get the data from update test
$testID = $_POST["testID"];
$result = $_POST["result"];

//connect to mysql
$conn = new mysqli("localhost","root","", "covideye");
if ($conn->connect_error){
	die("Connection failure");
}

//use database
$useDB = "use covideye";
$resultDB = $conn->query($useDB);

//update data in test and patient by given input
if (count($errors) == 0) {
	$updateDataTest = "update CovidTest set ResultDate = CURRENT_DATE() , Result = '$result' where TestID = '$testID';";
	if ($conn->query($updateDataTest)==TRUE){
		} else {
			echo "Error updating record: " . $conn->error;
		}

		echo "<script type='text/javascript'>
		alert('This test record has been updated successfully!');
		window.location = '/Assignment/assets/php/recordNewTest.php';</script>";
}


?>