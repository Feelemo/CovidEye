<?php
session_start();

$username = $_POST["login_ManagerUsername"];
$password = $_POST["login_ManagerPassword"];

//connect to Database
$conn = new mysqli("localhost","root","","covideye");
if ($conn->connect_error){
	die("Connection failure");
}

//check username and password from database
$sql = " select * from centreofficer where username = '$username' and password = '$password' and Position = 'Test Centre Manager' ";
$result = $conn->query($sql);
if ($result->num_rows > 0){
	$_SESSION['username'] = $username;
	
	echo "<script type='text/javascript'>
		window.location = '/Assignment/assets/php/registerTestCentre.php'; </script>";
		
} else {
	
	$sql = " select * from centreofficer where username = '$username' and password = '$password' and Position = 'Tester' ";
	$result = $conn->query($sql);
	if ($result->num_rows > 0){
		$_SESSION['tester_username'] = $username;
		
		echo "<script type='text/javascript'>
		window.location = '/Assignment/assets/php/recordNewTest.php'; </script>";
	}
	
	else {
		$sql2 = " select * from patient where PatientUsername = '$username' and PatientPassword = '$password' ";
		$resultInner = $conn->query($sql2);
		
		if ($resultInner->num_rows > 0){
			$_SESSION['username'] = $username;
			
			echo "<script type='text/javascript'>
			window.location = '/Assignment/assets/php/viewTestingHistory.php'; </script>";
		}
		
		else {
			echo "<script type='text/javascript'>
			alert('Invalid username or password!');
			window.location = '/Assignment/index.html'; </script>";
		}
	}
}

?>
