<?php
session_start();
$connection = mysqli_connect("localhost", "root", "","red_gloves"); // Establishing Connection with Server
if(mysqli_connect_error()) echo "Connection Fail";
	
if (isset($_POST['create'])) {
	$username = $_POST['username'];
	$password = $_POST['password'];
	$name = $_POST['name'];
	$admin = $_POST['admin'];
	
	$sql = "INSERT INTO staff VALUES ('$admin','$username','$password','$name')";
	mysqli_query($connection, $sql);
	$_SESSION['addStaff'] = 1;
}else if (isset($_POST['create1'])) {
	$username = $_POST['deleteUsername'];
	
	$sql = "DELETE FROM staff where username='$username'";
	mysqli_query($connection, $sql);
	$_SESSION['deleteStaff'] = 1;
}
header("Location:editStaff.php");
exit;
	
?>