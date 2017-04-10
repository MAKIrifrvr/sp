<?php
session_start();
$connection = mysqli_connect("localhost", "root", "","red_gloves"); // Establishing Connection with Server
if(mysqli_connect_error()) echo "Connection Fail";	

						
		$username = $_POST['username'];
		$password = $_POST['password'];
		
		$sql = "SELECT password FROM clients WHERE username='$username'";
		$data= mysqli_query($connection,$sql);
		$sql1 = "SELECT * FROM staff WHERE username='$username'";
		$data1= mysqli_query($connection,$sql1);
		
		if($data && mysqli_num_rows($data)!= 0){
			while ($rows = mysqli_fetch_row($data)){
				if($rows[0] == $password){
					// header("Location: profile.php");
					echo "profile.php";
					 $_SESSION['username'] = $username;
					// exit;
				}else{
					echo "incorrect username/password";
				}
			}
		}else if($data1 && mysqli_num_rows($data1)!= 0){
			while ($rows = mysqli_fetch_array($data1)){
				//echo $rows[0];
				if($rows['password'] == $password){
					if($rows['admin'] == 'no'){
					//	header("Location: staffProfile.php");
					echo "staffProfile.php";
						$_SESSION['username'] = $username;
						$_SESSION['role'] = 'staff';
						//exit;
					}else if($rows['admin'] == 'yes'){
					//	header("Location: staffProfile.php");
					echo "staffProfile.php";
						$_SESSION['username'] = $username;
						$_SESSION['role'] = 'admin';
						//exit;
					}					 
				}else{
					echo "incorrect username/password";
					
				}
			}
		}else{
			echo "incorrect username/password";
		}
		
	
	?>
