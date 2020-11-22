<?php
session_start();
//declare error count for checking the existing of user/email
$errors = array();

//get the data from register as applicant page
$testKitName = $_POST["testkit_name"];
$availableStock = $_POST["testkit_stock"];


//connect to mysql
$conn = new mysqli("localhost","root","", "covideye");
if ($conn->connect_error){
	die("Connection failure");
}

//use table
$testKitTable = "use testkit";
$result = $conn->query($testKitTable);

//check user/email already exist or not
$user_check_query = "SELECT * FROM testkit WHERE TestName='$testKitName' LIMIT 1";
$result = $conn->query($user_check_query);
$testKit = mysqli_fetch_assoc($result);
if ($testKit) {
	if ($testKit['TestName'] === $testKitName) {
	  array_push($errors, "Test kit name already exists");
	  echo "<script type='text/javascript'>
		alert('Oops! The test kit stock has been recorded before. Please create another new test kit stock.');
		window.location = '/Assignment/assets/php/createNewTestKitStock.php'; </script>";
	}
}

//register the data inside the database if there are no errors count from check user/email
if (count($errors) == 0) {
	$insertData = "insert into testkit(TestName, AvailableStock)
	values ('$testKitName', '$availableStock');";
	if ($conn->query($insertData)==TRUE){
		$_SESSION['testKitName'] = $testKitName;
		echo "<script type='text/javascript'>
		alert('The test kit stock has been recorded successfully!');
		window.location = '/Assignment/assets/php/displayTestKitStockInfo.php'; </script>";
	}
}
?>
