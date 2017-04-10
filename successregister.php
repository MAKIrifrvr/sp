<?php
session_start();
$connection = mysqli_connect("localhost", "root", "","red_gloves"); // Establishing Connection with Server
if(mysqli_connect_error()) echo "Connection Fail";
	date_default_timezone_set("Asia/Manila");
	
if($_SESSION['fromSignup'] != "true"){
	header("Location:index.php");
	exit;

}else{

			$username = $_POST['username'];
			$_SESSION['username'] = $username;
			$password = $_POST['password1'];
			$date_of_application = date('Y-m-d', strtotime($_POST['date_of_application']));
			$fullname = $_POST['fullname'];
			$address = $_POST['address'];
			$occupation = $_POST['occupation'];
			$telephone = $_POST['telephone'];
			$birthday =  date('Y-m-d', strtotime($_POST['birthday']));
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
			$membership = $_POST['membership'];
			$rates = $_POST['promos'];
			$date_of_promos = date("Y-m-d");
			$staff = $_POST['staffRegister'];
			$relationship = $_POST['emergency'];
			
			if($membership == 'member'){
				$date_of_membership = date("Y-m-d");
				$sql = "INSERT INTO inventory VALUES ('$date_of_membership','revenue','$staff','membership fee of $username','2000')";
				mysqli_query($connection, $sql);
				$member = 'yes';
			}else{
				$date_of_membership = NULL;
				$member = 'no';
			}
		
		
		if($rates != 'regular'){
		$sql = "INSERT INTO clients VALUES ('$username','$password','$membership','$date_of_membership','$rates','$date_of_promos','0','$staff','$fullname','$date_of_application','$address','$occupation','$telephone','$birthday',
			'$age','$sex','$weight','$height','$emergency_name','$emergency_relationship','$emergency_address','$health_problem',
			'$blood_pressure','$chronic_illness','$physical_exercise','$advise_doctor_exercise','$surgery','$muscle_pain','$diabetes',
			'$pregnancy','$asthma','$blood_cholesterol','$hernia','$family_problem','$relationship')";
		
		mysqli_query($connection, $sql);
		
		$sql = "SELECT * FROM promos WHERE promo_name ='$rates' AND membership='$member'";
		$data= mysqli_query($connection,$sql);
		$promoRate = mysqli_fetch_array($data)['value'];
		}else if($rates == 'regular'){
			$sql = "INSERT INTO clients VALUES ('$username','$password','$membership','$date_of_membership',null,null,'0',null,'$fullname','$date_of_application','$address','$occupation','$telephone','$birthday',
			'$age','$sex','$weight','$height','$emergency_name','$emergency_relationship','$emergency_address','$health_problem',
			'$blood_pressure','$chronic_illness','$physical_exercise','$advise_doctor_exercise','$surgery','$muscle_pain','$diabetes',
			'$pregnancy','$asthma','$blood_cholesterol','$hernia','$family_problem','$relationship')";
		
			mysqli_query($connection, $sql);
			mysqli_query($connection, "INSERT INTO attendance_log VALUES ('$username',now(),'trial')");	
			$member = 'yes';
			$sql = "SELECT * FROM promos WHERE promo_name ='$rates' AND membership='$member'";
			$data= mysqli_query($connection,$sql);
			$promoRate = mysqli_fetch_array($data)['value'];
			$rates = 'trial session';
		}
	
	$sql = "INSERT INTO inventory VALUES (now(),'revenue','$staff','registration of $username to $rates','$promoRate')";
	mysqli_query($connection, $sql);
	
	
	}
		header("Location: profile.php");
	exit;

?>