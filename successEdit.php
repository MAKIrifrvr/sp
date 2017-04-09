<?php
session_start();
$connection = mysqli_connect("localhost", "root", "","red_gloves"); // Establishing Connection with Server
if(mysqli_connect_error()) echo "Connection Fail";

		$oldusername = $_SESSION['username'];
		$newusername = $_POST['username'];
		$password = $_POST['newpassword'];		
		$fullname = $_POST['fullname'];
		$address = $_POST['address'];
		$occupation = $_POST['occupation'];
		$telephone = $_POST['telephone'];
		$birthdayArray = explode('/', $_POST['birthday']);
		$birthday = $birthdayArray[2].'-'.$birthdayArray[0].'-'.$birthdayArray[1];
		$age = $_POST['age'];
		$sex = $_POST['sex'];
		$weight = $_POST['weight'];
		$height = $_POST['height'];
		$emergency_name = $_POST['emergency_name'];
		$emergency_relationship = $_POST['emergency_relationship'];
		$emergency_address = $_POST['emergency_address'];
		$health_problem = $_POST['radioGroup1'];
		$blood_pressure = $_POST['radioGroup2'];
		$chronic_illness = $_POST['radioGroup3'];
		$physical_exercise = $_POST['radioGroup4'];
		$advise_doctor_exercise = $_POST['radioGroup5'];
		$surgery = $_POST['radioGroup6'];
		$muscle_pain = $_POST['radioGroup7'];
		$diabetes = $_POST['radioGroup8'];
		$pregnancy = $_POST['radioGroup9'];
		$asthma = $_POST['radioGroup10'];
		$blood_cholesterol = $_POST['radioGroup11'];
		$hernia = $_POST['radioGroup12'];
		$family_problem = $_POST['radioGroup13'];
		$relationship = $_POST['emergency'];
		$sql = "UPDATE clients SET username='$newusername',password='$password',fullname='$fullname' WHERE username='$oldusername'";		
		mysqli_query($connection, $sql);
		$sql = "UPDATE attendance_log SET username='$newusername' WHERE username='$oldusername'";		
		mysqli_query($connection, $sql);
		
		$_SESSION['username'] = $newusername;
		header("Location: profile.php");
		exit;
?>