<?php
session_start();

$testkitNum = $_POST["testkitNum"];
$testkitID = $_SESSION["testkitID"];
//connect to Database
$conn = new mysqli("localhost","root","","covideye");
if ($conn->connect_error){
	die("Connection failure");
}

//update testkit amount in database
$sql = " update testkit set availableStock ='$testkitNum' where kitID = '$testkitID'";
if ($conn->query($sql) === TRUE) {
  echo "Test kit amount updated successfully";
  echo "<script type='text/javascript'>
		window.location = '/Assignment/manager.html';
		</script>";
} else {
  echo "Error updating record: " . $conn->error;
  echo "<script type='text/javascript'>
		window.location = '/Assignment/managetestkit.html';
		</script>";
}
}
?>