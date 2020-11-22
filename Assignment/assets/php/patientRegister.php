<?php
session_start();
//declare error count for checking the existing of user/email
$errors = array();

//get the data from register as applicant page
$patientUsername = $_POST["patient_username"];
$patientPassword = $_POST["patient_password"];
$patientName = $_POST["patient_fullname"];
$patientType = $_POST["patient_type"];
$patientSymptoms = $_POST["patient_symptoms"];
$kitName = $_POST["testkit_name"];
$tester = $_SESSION['tester_username'];


//connect to mysql
$conn = new mysqli("localhost","root","", "covideye");
if ($conn->connect_error){
	die("Connection failure");
}


$kitIDSQL = "Select kitID from testkit where TestName = '$kitName'";
$kitIDRun = $conn->query($kitIDSQL);
while($record = mysqli_fetch_array($kitIDRun))
{
	$kitID = $record['kitID'];
}



//check user/email already exist or not
$user_check_query = "SELECT * FROM patient WHERE PatientUsername = '$patientUsername' LIMIT 1";
$result = $conn->query($user_check_query);
$user = mysqli_fetch_assoc($result);
if ($user) {
	if ($user['PatientUsername'] === $patientUsername) {
	  array_push($errors, "Patient's username already exists");
	  echo "<script type='text/javascript'>
		alert('The username of this patient already exists. Please enter another username.');
		window.location = '/Assignment/assets/php/recordNewTest.php'; </script>";

	}
}

$user_check_query = "SELECT * FROM centreofficer WHERE Username = '$patientUsername' LIMIT 1";
$result = $conn->query($user_check_query);
$user = mysqli_fetch_assoc($result);
if ($user) {
	if ($user['Username'] === $patientUsername) {
	  array_push($errors, "Patient's username already exists");
	  echo "<script type='text/javascript'>
		alert('The username of this patient already exists. Please enter another username.');
		window.location = '/Assignment/assets/php/recordNewTest.php'; </script>";

	}
}

$sql = "SELECT AvailableStock FROM testkit WHERE TestName = '$kitName' LIMIT 1";
$result = mysqli_query($conn, $sql);
$sqlp = "select * from patient";
$resultp = mysqli_query($conn, $sqlp);
$intPatient = mysqli_num_rows($resultp) + 1;

if (mysqli_num_rows($result) > 0) {
	while($row = mysqli_fetch_assoc($result)) {
		 
		if ($row["AvailableStock"] >= 1) {
	
			if (count($errors) == 0) {
				$insertData = "insert into patient(PatientUsername, PatientPassword, PatientName, PatientType, PatientSymptoms )
					values ('$patientUsername', '$patientPassword', '$patientName', '$patientType', '$patientSymptoms');";
				if ($conn->query($insertData)==TRUE){
					$sql = "UPDATE testkit SET AvailableStock = AvailableStock - 1 WHERE TestName = '$kitName'";
			
					if ($conn->query($sql) === TRUE) {
						$insertTest = "insert into CovidTest (PatientID , TesterUsername , TestKitID , TestDate)
						values($intPatient,'$tester',$kitID,current_date())";
						if($conn->query($insertTest) ===TRUE){
							
						}
						else {
						echo "Error updating record: " . $conn->error;
						}
					} 
				}
				echo "<script type='text/javascript'>
				alert('This patient has been recorded successfully!');
				window.location = '/Assignment/assets/php/recordNewTest.php';</script>";
			}
		} else {
			echo "<script type='text/javascript'>
			alert('This test kit is out of stock! Please select another test kit.');
			window.location = '/Assignment/assets/php/recordNewTest.php';</script>";	
		}
	}
}


?>
