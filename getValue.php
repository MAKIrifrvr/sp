<?php
session_start();
$connection = mysqli_connect("localhost", "root", "","red_gloves"); // Establishing Connection with Server
if(mysqli_connect_error()) echo "Connection Fail";	
	
	$date = $_POST['name'];
	$_SESSION['revenue'] = 0;
	$_SESSION['expenses'] = 0;
	$_SESSION['attendanceCount'] = 0;			
				
				$sql = "SELECT * FROM inventory WHERE date = '$date'";
				$data= mysqli_query($connection,$sql);
				$sql1 = "SELECT * FROM attendance_log WHERE attendance_date = '$date'";
				$data1= mysqli_query($connection,$sql1);
				
				while ($row = mysqli_fetch_array($data1)){
					$_SESSION['attendanceCount'] = $_SESSION['attendanceCount'] +1;
				}
				while ($rows = mysqli_fetch_array($data)){
					if($rows['category'] == 'revenue'){
						$_SESSION['revenue'] = $_SESSION['revenue'] + $rows['amount'];
					}else if($rows['category'] == 'expenses'){
						$_SESSION['expenses'] = $_SESSION['expenses'] + $rows['amount'];
					}
					
				}
				echo "<div class=\'col-xs-12' style=\"padding-left:100px;margin-top:40px;margin-bottom:10px\">STATISTICS</div>";
				
				
				
				echo"
							<table class=\"table table-hover\">
						
								<tbody>
									<tr>
									<td>ATTENDANCE:</td>
									<td>".$_SESSION['attendanceCount']."</td>
									</tr>
									<tr>
									<td>REVENUE:</td>
									<td>".$_SESSION['revenue']."</td>
									</tr>
									<tr>
									<td>EXPENSES:</td>
									<td>".$_SESSION['expenses']."</td>
									</tr>
								</TBODY>
							</table>
				";
				
?>