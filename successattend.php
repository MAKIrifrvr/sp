<?php
session_start();
$connection = mysqli_connect("localhost", "root", "","red_gloves"); // Establishing Connection with Server
if(mysqli_connect_error()) echo "Connection Fail";	
	
	$username = $_SESSION['username'];
	date_default_timezone_set("Asia/Manila");
	$date = date("Y-m-d");
	
	if($_SESSION['CheckCheck'] === 'exist'){
		$ACount = $_SESSION['ACount'];
		$rates = $_SESSION['rates'];
		
		if($rates == '8 sessions'){
		$ACount++;
			if($ACount >= 8){
				$attendance = "UPDATE clients SET rates=null, date_of_promos=null, staff_register=null, attendance_count=0 WHERE username='$username'";
				$attendance1= mysqli_query($connection,$attendance);
			}else {			
				$attendance = "UPDATE clients SET attendance_count=$ACount WHERE username='$username'";
				$attendance1= mysqli_query($connection,$attendance);
				$attendance = "INSERT INTO attendance_log VALUES ('$username','$date','$rates')";
				$attendance1= mysqli_query($connection,$attendance);
			}
		
		}else if($rates == '12 sessions'){	
		$ACount++;
			if($ACount >= 12){
				$attendance = "UPDATE clients SET rates=null, date_of_promos=null, staff_register=null, attendance_count=0 WHERE username='$username'";
				$attendance1= mysqli_query($connection,$attendance);
			}else {				
				$attendance = "UPDATE clients SET attendance_count=$ACount WHERE username='$username'";
				$attendance1= mysqli_query($connection,$attendance);
				$attendance = "INSERT INTO attendance_log VALUES ('$username','$date','$rates')";
				$attendance1= mysqli_query($connection,$attendance);
			}
		
		}else if($rates == 'monthly' || $rates == 'student monthly'){
			$reg = "SELECT date_of_promos FROM clients WHERE username='$username'";
			$reg1= mysqli_query($connection,$reg);	
			$ACount++;		
			
			$dateOfPromo = mysqli_fetch_array($reg1)['date_of_promos'];
			$currentDate = date("m",strtotime($dateOfPromo));
			$nextMonth = date("m",strtotime($dateOfPromo." +1 month"));
			
			if($currentDate==$nextMonth-1){
				$at = date('Y-m-d',strtotime($dateOfPromo." +1 month"));
				$_SESSION['expDate'] = date('M/d/Y',strtotime($dateOfPromo." +1 month"));
			}else{
				$at = date('Y-m-d', strtotime("last day of next month",strtotime($dateOfPromo)));
				$_SESSION['expDate'] = date('M/d/Y', strtotime("last day of next month",strtotime($dateOfPromo)));
			}
			
			if(strtotime($at) <= strtotime('today')){
				$attendance = "UPDATE clients SET rates=null, date_of_promos=null, staff_register=null, attendance_count=0  WHERE username='$username'";
				$attendance1= mysqli_query($connection,$attendance);
			}else{
				$attendance = "UPDATE clients SET attendance_count=$ACount WHERE username='$username'";
				$attendance1= mysqli_query($connection,$attendance);
				$attendance = "INSERT INTO attendance_log VALUES ('$username','$date','$rates')";
				$attendance1= mysqli_query($connection,$attendance);
			}
		}
		
	}else if($_SESSION['CheckCheck'] === 'new'){
		$rates = $_POST['promos'];
		$staff_username = $_POST['staff_username'];
		$ACount = '1';
	
		if($rates != 'regular'){
			$reg = "UPDATE clients SET rates='$rates', date_of_membership=null, attendance_count=$ACount, date_of_promos='$date', staff_register='$staff_username' WHERE username='$username'";
			$reg1= mysqli_query($connection,$reg);		
		}
		$attendance = "INSERT INTO attendance_log VALUES ('$username','$date','$rates')";
		$attendance1= mysqli_query($connection,$attendance);
		
		
		
		
		
		$member = $_SESSION['member'];
		
		$sql = "SELECT * FROM promos WHERE promo_name ='$rates' AND membership='$member'";
		$data= mysqli_query($connection,$sql);
		$promoRate = mysqli_fetch_array($data)['value'];
	
	
		$sql = "INSERT INTO inventory VALUES ('$date','revenue','$staff_username','registration of $username to $rates','$promoRate')";
		mysqli_query($connection, $sql);
		
		
		
		
	}
	$_SESSION['success'] = 'true';
	header("Location: profile.php");
	exit;
?>

