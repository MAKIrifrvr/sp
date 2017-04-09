<?php
session_start();
$connection = mysqli_connect("localhost", "root", "","red_gloves"); // Establishing Connection with Server
if(mysqli_connect_error()) echo "Connection Fail";	

$username = $_SESSION['username'];
if($username == ''){
	header("Location:index.php");
	exit;
}


?>

<!DOCTYPE html>

<head>
	<title> Red Gloves Boxing Gym </title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
   
    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/style.css" rel="stylesheet">
	
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body background="img/2.jpg">

	<div id="navigation">
        <nav class="navbar navbar-fixed-top" role="navigation" >
			<div class="container">
				<div class="row">
            		<div class="site-logo">
            			<a href="" class="brand">Red Gloves Boxing Gym</a>
            		</div>

            		
            		<!-- Collect the nav links, forms, and other content for toggling -->
            		<div class="collapse navbar-collapse" id="menu">
            			<ul class="nav navbar-nav navbar-right">
            				  <li><a href="staffProfile.php" style="color:white">Profile</a></li>
							  <li ><a href="searchClients.php" style="color:white">Clients</a></li>
							  <li  class="active" ><a href="editStaff.php" style="color:white">Staff</a></li>
							  <li ><a href="adminInventory.php" style="color:white">Admin</a></li>
							  <li ><a href="index.php" style="color:white">Logout</a></li>
            			</ul>
            		</div>
            		<!-- /.Navbar-collapse -->		 
				</div>
			</div>
			<!-- /.container -->
		</nav>
    </div> 
	

	<div class="container" style="margin-top:150px;margin-left:270px">
    	<div class="row">
			<div class="col-md-8">
				<div class="panel panel-primary" style="width:8in">
					<div class="panel-heading" style="height:53px">
						<div style="float:left;margin-top:5px"> STAFF </div> 
						<div class="pull-right">
							<button class="btn" style="background-color:#E37424" data-toggle="modal" data-target="#addStaff">Add New Staff</button>
						</div>
					</div>
					<table class="table table-hover">
						<thead >
							<tr>
								<th>Count</th>
								<th>username</th>
								<th>password</th>
								<th>Full Name</th>
								<th></th>
							</tr>
						</thead>
						<tbody>
							<?php
								$sql = "SELECT * FROM staff WHERE admin='no'";
								$data= mysqli_query($connection,$sql);
								$num = 0;
								while($row = mysqli_fetch_array($data)){
									$num++;
									$user = $row['username'];
									echo "
										<tr>	
											<td>$num</td>
											<td>".$row['username']."</td>
											<td>".$row['password']."</td>
											<td>".$row['name']."</td>
											<form action=\"successUpdateStaff.php\" method=\"post\">
											<td><input type=\"submit\" class=\"btn btn-warning\" id=\"$user\" name=\"create1\" value=\"delete\"></td>
											<input type=\"hidden\" value=\"$user\" name=\"deleteUsername\">
											</form>
										</tr>
									";
								}								
							?>
							
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
	
	<div class="modal fade" id="addStaff" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog" style="color:black">
			<div class="modal-content">
				<!-- Modal Header -->
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">
					   <span aria-hidden="true">&times;</span>
					   <span class="sr-only">Close</span>
					</button>
					<h4 class="modal-title" id="myModalLabel">
						Add Staff
					</h4>
				</div>
				<div class="container" style="color:black">
					<div class="col-xs-6" style="padding:40px;">
						<form class="form-horizontal" name="buttonprofile" action="successUpdateStaff.php" method="post">
							
							<div class="col-xs-12" style="padding-bottom:20px">
								<label style="color:black">Admin/Staff:</label>
								<select name="admin" class = "form-control" required>
									<option selected disabled value >  </option>
									<option value="yes" > Admin </option>
									<option value="no" > Staff </option>
								</select>
							</div>
							<div class="col-xs-12" style="padding-bottom:20px">
								<label style="color:black">Preferred Username</label>
								<label style="color:black; font-size: 14px; font-weight: 500; float:right" id="user-result"> </label>
								<input style="text-align:center" type="text" class="form-control" id='username' name="username" minlength="6" placeholder="username"  required>
							</div>
							<div class="col-xs-12" style="padding-bottom:20px">
								<label style="color:black">Preferred Password</label>
								<input style="text-align:center" type="password" class="form-control" id="password" name="password" placeholder="password" required>
							</div>
							<div class="col-xs-12">
								<label style="color:black">Name</label>						
								<input style="text-align:center" type="text" class="form-control" id='name' name="name" placeholder="name"  required>
							</div>
							<div class="pull-right" style="padding:15px">
								<input class="btn btn-primary" type="submit" id="create" name="create" disabled>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
	
	
	
	<div class="modal fade" id="deleteStaff" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog" style="color:black">
			<div class="modal-content">
				<!-- Modal Header -->
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">
					   <span aria-hidden="true">&times;</span>
					   <span class="sr-only">Close</span>
					</button>
					<h4 class="modal-title" id="myModalLabel">
						Add Staff
					</h4>
				</div>
				<div class="container" style="color:black">
					<div class="col-xs-6" style="padding:40px;">
						<form class="form-horizontal" name="buttonprofile" action="successUpdateStaff.php" method="post">
							<div class="col-xs-12" style="padding-bottom:20px">
								<label style="color:black">Preferred Username</label>
								<label style="color:black; font-size: 14px; font-weight: 500; float:right" id="user-result1"> </label>
								<input style="text-align:center" type="text" class="form-control" id='username1' name="username1" minlength="6" placeholder="username"  required>
							</div>
							
							<div class="pull-right" style="padding:15px">
								<input class="btn btn-primary" type="submit" id="create1" name="create1" disabled >
							</div>
						
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
	
	
	
	
	
	
	 <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
	<script>
		$(document).ready(function() {
			var x_timer;    
			$("#username").keyup(function (e){
				clearTimeout(x_timer);
				var user_name = $(this).val();
				x_timer = setTimeout(function(){
					check_username_ajax(user_name);
				}, 1000);
			}); 


		function check_username_ajax(username){
			$.post('checkStaff.php', {'username':username}, function(data) {
				document.getElementById('user-result').style.color = "red";
				$("#user-result").html(data);
				var mac = document.getElementById("user-result").innerHTML;
				if(mac == 'available'){
					document.getElementById('user-result').style.color = "black";
					document.getElementById("create").disabled = false; 
				}else{
					document.getElementById("create").disabled = true; 
				}
			});
			
		}
		
		
		var x_timer; 
			$("#username1").keyup(function (e){
				clearTimeout(x_timer);
				var user_name = $(this).val();
				x_timer = setTimeout(function(){
					check_username_ajax1(user_name);
				}, 1000);
			}); 
			
			function check_username_ajax1(username){
			$.post('checkStaff.php', {'username':username}, function(data) {
				document.getElementById('user-result1').style.color = "red";
				$("#user-result1").html(data);
				var mac = document.getElementById("user-result1").innerHTML;
				if(mac == 'available'){	
					document.getElementById("user-result1").innerHTML = "no staff found";
					document.getElementById("create1").disabled = true; 
				}else{
					
					document.getElementById('user-result1').style.color = "black";
					document.getElementById("create1").disabled = false; 
				}
			});
			
		}
			
		});
	</script>

	
</body>

</html>