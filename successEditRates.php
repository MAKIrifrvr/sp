<?php
session_start();
$connection = mysqli_connect("localhost", "root", "","red_gloves"); // Establishing Connection with Server
if(mysqli_connect_error()) echo "Connection Fail";
	
	if(isset($_POST['editrates'])){
		$rates = $_POST['promos'];
		
		if($rates == 'membership_fee'){
			$membership = 'yes';
		}else{
			$membership = $_POST['membership'];
		}
		$value = $_POST['value'];
		
		$sql = "UPDATE promos SET value='$value' WHERE membership='$membership' AND promo_name='$rates'";
		mysqli_query($connection, $sql);
		
		$_SESSION['successEditRates'] = 1;
	}
	
	header("Location:adminInventory.php");
	exit;
	


?>