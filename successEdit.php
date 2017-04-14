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
		$birthday =date('Y-m-d', strtotime( $_POST['birthday']));	
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
		$sql = "UPDATE clients SET username='$oldusername',password='$password',fullname='$fullname',address='$address',occupation='$occupation',
		telephone='$telephone',birthday='$birthday',age='$age',sex='$sex',weight='$weight',height='$height',emergency_name='$emergency_name',emergency_relationship='$emergency_relationship',emergency_address='$emergency_address',health_problem='$health_problem',
			blood_pressure='$blood_pressure',chronic_illness='$chronic_illness',physical_exercise='$physical_exercise',advise_doctor_exercise='$advise_doctor_exercise',surgery='$surgery',muscle_pain='$muscle_pain',diabetes='$diabetes',
			pregnancy='$pregnancy',asthma='$asthma',blood_cholesterol='$blood_cholesterol',hernia='$hernia',family_problem='$family_problem',relationship='$relationship' WHERE username='$oldusername'";	
		
		mysqli_query($connection, $sql);
		$_SESSION['successEdit'] = 1;
		$_SESSION['username'] = $oldusername;
		header("Location: profile.php");
		exit;
?>