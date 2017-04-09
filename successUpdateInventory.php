<?php
session_start();
$connection = mysqli_connect("localhost", "root", "","red_gloves"); // Establishing Connection with Server
if(mysqli_connect_error()) echo "Connection Fail";
	
if (isset($_POST['addInventory'])) {
	$username = $_SESSION['username'];
	$category = $_POST['category'];
	$description = $_POST['description'];
	$amount = $_POST['amount'];
	date_default_timezone_set("Asia/Manila");
	$date = date("Y-m-d");
	
	
	
	$sql = "INSERT INTO inventory VALUES ('$date','$category','$username','$description','$amount')";
	mysqli_query($connection, $sql);
	
}
if($_SESSION['role'] == 'staff'){
		header("Location:staffInventory.php");
	}else{
		header("Location:adminInventory.php");
	}
	exit;
	
?>