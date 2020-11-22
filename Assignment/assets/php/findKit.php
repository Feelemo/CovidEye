<?php
session_start();

$testkitID = $_POST["testkitID"];
//connect to Database
$conn = new mysqli("localhost","root","","covideye");
if ($conn->connect_error){
	die("Connection failure");
}

//find testkit from database
$sql = " select * from testkit where kitID = '$testkitID'";
$result = $conn->query($sql);
if ($result->num_rows > 0){
	$_SESSION["testkitID"] = $testkitID;
	$_SESSION["testkitname"] = $result["testKitName"];
	$_SESSION["availablestock"] = $result["availableStock"];
	echo "<script type='text/javascript'>
		window.location = '/Assignment/updatetestkit.html';
		</script>";
} else {
	echo "<script type='text/javascript'>
		alert('Test Kit ID called '$testkitID' not found!');
		window.location = '/Assignment/createnewtestkit.html';
		</script>";
}
?>