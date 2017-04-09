<?php
session_start();
$connection = mysqli_connect("localhost", "root", "","red_gloves"); // Establishing Connection with Server
if(mysqli_connect_error()) echo "Connection Fail";
	date_default_timezone_set("Asia/Manila");
				if(isset($_POST['memberSubmit'])){
					$username = $_SESSION['username'];
					$membershipDate = date("Y-m-d");
					$staff = $_POST['memberStaff'];
					
					$sql1 = "SELECT value FROM promos WHERE promo_name ='membership_fee'";
					$count= mysqli_query($connection,$sql1);
					$membershipFee = mysqli_fetch_array($count)['value'];
					echo $membershipFee;
					
					$sql = "INSERT INTO inventory VALUES ('$membershipDate','revenue','$staff','membership fee of $username','$membershipFee')";
					mysqli_query($connection, $sql);
					mysqli_query($connection, "UPDATE clients SET membership='member', date_of_membership='$membershipDate'");
					
				}header("Location:profile.php");
					exit;
				
			?>