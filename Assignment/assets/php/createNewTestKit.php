<?php
session_start();

$testkitName = $_POST["testkitName"];
$testkitNum = $_SESSION["testkitNum"];
//connect to Database
$conn = new mysqli("localhost","root","","covideye");
if ($conn->connect_error){
	die("Connection failure");
}

//insert new testkit into database
$sql = "INSERT INTO testkit (testKitName,availableStock)
VALUES ('$testkitName','$testkitNum')";

if ($conn->query($sql) === TRUE) {
  echo "New test kit created successfully";
  echo "<script type='text/javascript'>
		window.location = '/Assignment/manager.html';
		</script>";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
  echo "<script type='text/javascript'>
		window.location = '/Assignment/managetestkit.html';
		</script>";
}
}
?>