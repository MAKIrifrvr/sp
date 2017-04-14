<?php
session_start();
$connection = mysqli_connect("localhost", "root", "","red_gloves"); // Establishing Connection with Server
if(mysqli_connect_error()) echo "Connection Fail";	
$username = $_SESSION['username'];
$i = 21;
if($username == ''){
	header("Location:index.php");
	exit;

}
$member = '';
	date_default_timezone_set("Asia/Manila");
$sql = "SELECT * FROM clients WHERE username ='$username'";
$data= mysqli_query($connection,$sql);
while($row = mysqli_fetch_array($data)){ 
	$member = $row['membership'];
	$yearr = $row['date_of_membership'];
}
	if($member == 'member'){
		$_SESSION['member'] = 'yes';
	}else{
		$_SESSION['member'] = 'no';
	}
?>

<!DOCTYPE html>

<head>
	<title> Red Gloves Boxing Gym </title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap 101 Template</title>

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
            				  <li class="active" ><a href="index.php" style="color:white">Logout</a></li>
            			</ul>
            		</div>
            		<!-- /.Navbar-collapse -->		 
				</div>
			</div>
			<!-- /.container -->
		</nav>
    </div> 
		
        <div class="panel panel-primary" id="panel1" style=" margin-left: auto; margin-right: auto; width: 8in;background-color: #fdfdfd; margin-top:150px;height:250px">
            <div class="panel-body">
              <div class="form-group">
				<div class="col-xs-12" id= "luh">
					<div class="col-xs-3">
					<img alt="profile" src="img/profile.png" class="img-circle img-responsive" style="margin-left:10px;margin-bottom:10px;"> 
					</div>
					<div class="col-xs-9" style="height:140px; text-align: justify;font-size: 16px; font-family: 'Roboto', sans-serif; font-weight: 500;">
						<b>Hello <?php echo $username;?>!</b> 
						<br>Thank you for being a loyal client of Red Gloves Boxing Gym. We hope that you are satisfied with your experience!
					</div>
					<div class="col-xs-6">
					<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#myModalNorm1" style="width:100%">View Attendance</button>
					</div>
					<div class="col-xs-6">
					<?php
						$username = $_SESSION['username'];
						$sql = "SELECT * FROM clients WHERE username ='$username'";
						$data= mysqli_query($connection,$sql);
						$rates = mysqli_fetch_array($data)['rates'];
					?>
					<form class="form-horizontal" name="buttonprofile" action="" method="post">
						<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#myModalNorm" style="width:100%" >Attend Classes</button>
					</form>
					</div>
					<div id="success_prompt" style="color:blue;font-style:italic;text-align:center;padding-top:50px"></div>			
					
				</div>
			  </div>
			</div>
		
		</div>
		
<div class="modal fade bs-example-modal-sm" id="myModal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"></h4>
      </div>
      <div class="modal-body" id="modal-body">
    
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<?php
	if($member == 'member'){
		$nextYear = date('Y-m-d',strtotime($yearr."+1 year"));
		$dateNow = date('Y-m-d');
		$t = date("H");
		if($dateNow == $nextYear && ($t >="23")){
			$sql1 = "UPDATE clients SET membership='nonmember',date_of_membership=null WHERE username='$username'";
			mysqli_query($connection,$sql1);
			echo "<script> 
					document.getElementById('modal-body').innerHTML = '<b>Your membership subscription expires.</b><br><br>Register again to avail free items <br>and discounts to different promos.';
					window.setTimeout(function() {
						$('#myModal').modal('show');
					},1000);
				</script>";
		}
	}
?>

		<div class="panel panel-primary" id="panel1" style="display:block; margin-left: auto; margin-right: auto; width: 8in;background-color: #fdfdfd; margin-top:50px;">
            <div class="panel-heading"  style="height:53px">
				<div style="float:left;margin-top:5px">PROFILE </div>
				<div class="pull-right">
					<?php
						$username = $_SESSION['username'];
						$sql = "SELECT * FROM clients WHERE username ='$username'";
						$data= mysqli_query($connection,$sql);
						
						while($row = mysqli_fetch_array($data)){ 
							if($row['membership'] == 'nonmember'){
								echo "<button type=\"button\" class=\"btn btn-danger\" data-toggle=\"modal\" data-target=\"#myModalMember\"\">Be a Member</button>";
							}
						}
					?>
					<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#myModalEdit" onclick="updateValue()">Edit Profile</button> 		  					
				</div>
			</div>
			<form class="form-horizontal" name="member" action="beAMember.php" method="post">
				<div class="modal fade" id="myModalMember" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				<div class="modal-dialog" style="color:black">
					<div class="modal-content">
						<!-- Modal Header -->
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal">
							   <span aria-hidden="true">&times;</span>
							   <span class="sr-only">Close</span>
							</button>
							<h4 class="modal-title" id="myModalLabel">Be a member</h4>
						</div>
						<div class="container" style="color:black">
							<div class="col-xs-6" style="text-align:center;padding-bottom:20px;padding-top:20px" id="refreshDiv">
								<div class="panel-body">
									<div class="col-xs-12" style="margin-bottom:20px">
										<label style="color:black; font-size: 16px; font-weight: 600;">
											<?php
												$sql = "SELECT value FROM promos WHERE promo_name='membership_fee'";
												$data= mysqli_query($connection,$sql);
												$membershipFee = mysqli_fetch_row($data)[0];
											?>
											Be a member of Red Gloves Boxing Gym for only <?php echo $membershipFee;?> pesos!<br>
											Freebies includes cheaper promo rates, bottomless water, gloves rental, locker, and more.
										</label>
									</div>
									<div class="col-xs-12">
										<input type="text" class="form-group" placeholder="username of staff" id="memberStaff" name="memberStaff" autocomplete="off" required>
									</div>
									<div class="col-xs-12">
										<label style="color:black; font-size: 12px; font-weight: 500;" id="user-resultt">  </label>
									</div>
								</div>
							</div>
						</div>
						<div class="modal-footer">
							<input class="btn btn-danger" type="submit" value="REGISTER" name="memberSubmit" id="memberSubmit" disabled>
						</div>
					</div>
					
				</div>
				
				</div>
				
			</form>
			
			
			<form class="form-horizontal" name="edit" action="successEdit.php" method="post" >
				<div class="modal fade" id="myModalEdit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				<div class="modal-dialog" style="color:black">
					<div class="modal-content">
						<!-- Modal Header -->
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal">
							   <span aria-hidden="true">&times;</span>
							   <span class="sr-only">Close</span>
							</button>
							<h4 class="modal-title" id="myModalLabel">Edit Information</h4>
						</div>
						<div class="container" style="color:black">
							<div class="col-xs-6" style="text-align:center;padding-bottom:20px;padding-top:20px" id="refreshDiv">
								<div class="panel-body">
								<div class="col-xs-4">Username</div>
								<div class="col-xs-8">
									<input style="text-align:center" type="text" name="username" id="username" class="form-control" value="" autocomplete="off" disabled required>
								</div>
								</div>
								<div class="panel-body">
								<div class="col-xs-4">Old Password</div>
								<div class="col-xs-8">
									<input style="text-align:center" type="password" name="oldpassword" id="oldpassword" class="form-control" value="" autocomplete="off" onblur="checkPassword()" required>
									
								</div>
								</div>
								<div class="panel-body">
								<div class="col-xs-4">New Password</div>
								<div class="col-xs-8">
									<input style="text-align:center" type="password" name="newpassword" id="newpassword" class="form-control"   required>
									
								</div>
								</div>
								<div class="panel-body">
								<div class="col-xs-4">Full Name</div>
								<div class="col-xs-8">
									<input style="text-align:center" type="text" name="fullname" id="fullname" class="form-control" value="" autocomplete="off"  required>
								</div>
								</div>
								<div class="panel-body">
								<div class="col-xs-4">Address</div>
								<div class="col-xs-8">
									<input style="text-align:center" type="text" name="address" id="address" class="form-control" value="" autocomplete="off"  required>
								</div>
								</div>
								<div class="panel-body">
								<div class="col-xs-4">Occupation</div>
								<div class="col-xs-8">
									<input style="text-align:center" type="text" name="occupation" id="occupation" class="form-control" value="" autocomplete="off"  required>
								</div>
								</div>
								<div class="panel-body">
								<div class="col-xs-4">Telephone</div>
								<div class="col-xs-8">
									<input style="text-align:center" type="text" name="telephone" id="telephone" class="form-control" value="" autocomplete="off"  required>
								</div>
								</div>
								<div class="panel-body">
								<div class="col-xs-4">Birhtday</div>
								<div class="col-xs-8">
									<input style="text-align:center" type="date" name="birthday" id="birthday" class="form-control" value="" autocomplete="off"  required>
								</div>
								</div>
								<div class="panel-body">
								<div class="col-xs-4">Age</div>
								<div class="col-xs-8">
									<input style="text-align:center" type="text" name="age" id="age" class="form-control" value="" autocomplete="off"  required>
								</div>
								</div>
								<div class="panel-body">
								<div class="col-xs-4">Sex</div>
								<div class="col-xs-8">
									<select name="sex" id="sex" class = "form-control" required>
										<option selected disabled value >  </option>
										<option value="Male" > Male </option>
										<option value="Female" > Female </option>
									</select>
								</div>
								</div>
								<div class="panel-body">
								<div class="col-xs-4">Weight</div>
								<div class="col-xs-8">
									<input style="text-align:center" type="number" name="weight" id="weight" class="form-control" value="" autocomplete="off"  required>
								</div>
								</div>
								<div class="panel-body">
								<div class="col-xs-4">Height</div>
								<div class="col-xs-8">
									<input style="text-align:center" type="number" name="height" id="height" class="form-control" value="" autocomplete="off"  required>
								</div>
								</div>
								<div class="panel-body">
								<div class="col-xs-4">Emergency Name</div>
								<div class="col-xs-8">
									<input style="text-align:center" type="text" name="emergency_name" id="emergency_name" class="form-control" value="" autocomplete="off"  required>
								</div>
								</div>
								<div class="panel-body">
								<div class="col-xs-4">Emergency Relationship</div>
								<div class="col-xs-8">
									<input style="text-align:center" type="text" name="emergency_relationship" id="emergency_relationship" class="form-control" value="" autocomplete="off"  required>
								</div>
								</div>
								<div class="panel-body">
								<div class="col-xs-4">Emergency Address</div>
								<div class="col-xs-8">
									<input style="text-align:center" type="text" name="emergency_address" id="emergency_address" class="form-control" value="" autocomplete="off"  required>
								</div>
								</div>
								<div class="panel-body">
								<div class="col-xs-7">Health problem, chest, or stroke:</div>
								<div class="col-xs-5">
									<label class="radio-inline">
										<input name="radioGroup1" id="radio1" value="yes" type="radio" required> Yes
									</label>
									<label class="radio-inline">
									  <input name="radioGroup1" id="radio2" value="no" type="radio"> No
									</label>
								</div>
								</div>
								<div class="panel-body">
								<div class="col-xs-7">Increased blood pressure:</div>
								<div class="col-xs-5">
									<label class="radio-inline">
										<input name="radioGroup2" id="radio3" value="yes" type="radio" required> Yes
									</label>
									<label class="radio-inline">
									  <input name="radioGroup2" id="radio4" value="no" type="radio"> No
									</label>
								</div>
								</div>
								<div class="panel-body">
								<div class="col-xs-7">Any chronic illness or condition:</div>
								<div class="col-xs-5">
									<label class="radio-inline">
										<input name="radioGroup3" id="radio5" value="yes" type="radio" required> Yes
									</label>
									<label class="radio-inline">
									  <input name="radioGroup3" id="radio6" value="no" type="radio"> No
									</label>
								</div>
								</div>
								<div class="panel-body">
								<div class="col-xs-7">Difficulty with physical exercise:</div>
								<div class="col-xs-5">
									<label class="radio-inline">
										<input name="radioGroup4" id="radio7" value="yes" type="radio" required> Yes
									</label>
									<label class="radio-inline">
									  <input name="radioGroup4" id="radio8" value="no" type="radio"> No
									</label>
								</div>
								</div>
								<div class="panel-body">
								<div class="col-xs-7">Advice by a doctor not to exercise:</div>
								<div class="col-xs-5">
									<label class="radio-inline">
										<input name="radioGroup5" id="radio9" value="yes" type="radio" required> Yes
									</label>
									<label class="radio-inline">
									  <input name="radioGroup5" id="radio10" value="no" type="radio"> No
									</label>
								</div>
								</div>
								<div class="panel-body">
								<div class="col-xs-7">Surgery during the last 12 months:</div>
								<div class="col-xs-5">
									<label class="radio-inline">
										<input name="radioGroup6" id="radio11" value="yes" type="radio" required> Yes
									</label>
									<label class="radio-inline">
									  <input name="radioGroup6" id="radio12" value="no" type="radio"> No
									</label>
								</div>
								</div>
								<div class="panel-body">
								<div class="col-xs-7">Muscles, joint pain affecting movement:</div>
								<div class="col-xs-5">
									<label class="radio-inline">
										<input name="radioGroup7" id="radio13" value="yes" type="radio" required> Yes
									</label>
									<label class="radio-inline">
									  <input name="radioGroup7" id="radio14" value="no" type="radio"> No
									</label>
								</div>
								</div>
								<div class="panel-body">
								<div class="col-xs-7">Diabetes or thyroid condition:</div>
								<div class="col-xs-5">
									<label class="radio-inline">
										<input name="radioGroup8" id="radio15" value="yes" type="radio" required> Yes
									</label>
									<label class="radio-inline">
									  <input name="radioGroup8" id="radio16" value="no" type="radio"> No
									</label>
								</div>
								</div>
								<div class="panel-body">
								<div class="col-xs-7">Pregnancy:</div>
								<div class="col-xs-5">
									<label class="radio-inline">
										<input name="radioGroup9" id="radio17" value="yes" type="radio" required> Yes
									</label>
									<label class="radio-inline">
									  <input name="radioGroup9" id="radio18" value="no" type="radio"> No
									</label>
								</div>
								</div>
								<div class="panel-body">
								<div class="col-xs-7">Asthma or difficulty:</div>
								<div class="col-xs-5">
									<label class="radio-inline">
										<input name="radioGroup10" id="radio19" value="yes" type="radio" required> Yes
									</label>
									<label class="radio-inline">
									  <input name="radioGroup10" id="radio20" value="no" type="radio"> No
									</label>
								</div>
								</div>
								<div class="panel-body">
								<div class="col-xs-7">Increased blood cholesterol:</div>
								<div class="col-xs-5">
									<label class="radio-inline">
										<input name="radioGroup11" id="radio21" value="yes" type="radio" required> Yes
									</label>
									<label class="radio-inline">
									  <input name="radioGroup11" id="radio22" value="no" type="radio"> No
									</label>
								</div>
								</div>
								<div class="panel-body">
								<div class="col-xs-7">Hernia or any condition affected by lifting weight:</div>
								<div class="col-xs-5">
									<label class="radio-inline">
										<input name="radioGroup12" id="radio23" value="yes" type="radio" required> Yes
									</label>
									<label class="radio-inline">
									  <input name="radioGroup12" id="radio24" value="no" type="radio"> No
									</label>
								</div>
								</div>
								<div class="panel-body">
								<div class="col-xs-7">Family member with heart problems, asthma or diabetes?</div>
								<div class="col-xs-5">
									<label class="radio-inline">
										<input name="radioGroup13" id="radio25" value="yes" type="radio" required> Yes
									</label>
									<label class="radio-inline">
									  <input name="radioGroup13" id="radio26" value="no" type="radio"> No
									</label>
								</div>
								</div>
								<div class="panel-body">
								<div class="col-xs-7">If yes, Relationship:</div>
								<div class="col-xs-5">
									<input type="text" class="form-control" id="emergency" name="emergency" placeholder="If yes, relationship">
								</div>
								</div>
							
							</div>
							<div class="col-xs-12" style="margin-top:20px;margin-bottom:50px;">
								<input class="btn btn-danger" type="submit" value="FINISH" id="finish" style=" width:200px;margin-left:300px;">
							</div>
						</div>
					</div>
				</div>
			</div>
			</form>
			
			<?php
				if($_SESSION['beAMember'] == 1){
					echo "<script> 
						document.getElementById('modal-body').innerHTML = '<b>You are now a member of Red Gloves Boxing Gym.</b>';
						window.setTimeout(function() {
						$('#myModal').modal('show');
						},1000);
					 </script>";
					$_SESSION['beAMember'] = 0;
				}
				if($_SESSION['successEdit'] == 1){
					echo "<script> 
						document.getElementById('modal-body').innerHTML = '<b>Successfully updated your information.</b>';
						window.setTimeout(function() {
						$('#myModal').modal('show');
						},1000);
					 </script>";
					$_SESSION['successEdit'] = 0;
				}
			?>
			
			
            <div class="panel-body">
              <div class="form-group">
				<div class="col-xs-12" style="padding-left:50px;color:black;font-size: 17px; font-family: 'Roboto', sans-serif; font-weight: 500;"> 
					<?php
						$username = $_SESSION['username'];
						$sql = "SELECT * FROM clients WHERE username ='$username'";
						$data= mysqli_query($connection,$sql);
						
						while($row = mysqli_fetch_array($data)){ 
							if($row['rates'] == null){
								$rates = 'no promo';
							}else{ 
								$rates = $row['rates'];
							}							
							echo "	<div class=\"col-xs-12\" style=\"font-weight:bold;margin-top:20px;margin-bottom:15px\"> - PERSONAL DATA:</div>
									<br>
									<div class=\"col-xs-4\">Username:</div>
									<div class=\"col-xs-8\">".$row['username']."</div>
									<br>
									<div class=\"col-xs-4\">Membership:</div>
									<div class=\"col-xs-8\">".$row['membership']."</div>
									<br>
									<div class=\"col-xs-4\">Registered Promo:</div>
									<div class=\"col-xs-8\">$rates</div>
									<br>
									<div class=\"col-xs-4\">Full Name:</div>
									<div class=\"col-xs-8\">".$row['fullname']."</div>
									<br>
									<div class=\"col-xs-4\">Occupation:</div>
									<div class=\"col-xs-8\">".$row['occupation']."</div>
									<br>
									<div class=\"col-xs-4\">Address:</div>
									<div class=\"col-xs-8\">".$row['address']."</div>
									<br>
									<div class=\"col-xs-4\">Telephone:</div>
									<div class=\"col-xs-8\">".$row['telephone']."</div>
									<br>
									<div class=\"col-xs-4\">Birthday:</div>
									<div class=\"col-xs-8\">".$row['birthday']."</div>
									<br>
									<div class=\"col-xs-4\">Age:</div>
									<div class=\"col-xs-8\">".$row['age']."</div>
									<br>
									<div class=\"col-xs-4\">Sex:</div>
									<div class=\"col-xs-8\">".$row['sex']."</div>
									<br>
									<div class=\"col-xs-4\">Weight:</div>
									<div class=\"col-xs-8\">".$row['weight']."</div>
									<br>
									<div class=\"col-xs-4\">Height:</div>
									<div class=\"col-xs-8\">".$row['height']."</div>
									<br>
									<div class=\"col-xs-4\">Emergency Name:</div>
									<div class=\"col-xs-8\">".$row['emergency_name']."</div>
									<br>
									<div class=\"col-xs-4\">Relationship</div>
									<div class=\"col-xs-8\">".$row['emergency_relationship']."</div>
									<br>
									<div class=\"col-xs-4\">His / Her Address</div>
									<div class=\"col-xs-8\">".$row['emergency_address']."</div>
									<br>
									<div class=\"col-xs-12\" style=\"font-weight:bold;margin-top:50px;margin-bottom:15px\"> - HEALTH HISTORY:</div>
									<br>
									<div class=\"col-xs-9\">Health problem, chest, or stroke:</div>
									<div class=\"col-xs-3\">".$row['health_problem']."</div>
									<br>
									<div class=\"col-xs-9\">Increased blood pressure:</div>
									<div class=\"col-xs-3\">".$row['blood_pressure']."</div>
									<br>
									<div class=\"col-xs-9\">Any chronic illness or condition:</div>
									<div class=\"col-xs-3\">".$row['chronic_illness']."</div>
									<br>
									<div class=\"col-xs-9\">Difficulty with physical exercise:</div>
									<div class=\"col-xs-3\">".$row['physical_exercise']."</div>
									<br>
									<div class=\"col-xs-9\">Advice by a doctor not to exercise:</div>
									<div class=\"col-xs-3\">".$row['advise_doctor_exercise']."</div>
									<br>
									<div class=\"col-xs-9\">Surgery during the last 12 months:</div>
									<div class=\"col-xs-3\">".$row['surgery']."</div>
									<br>
									<div class=\"col-xs-9\">Muscles, joint pain affecting movement:</div>
									<div class=\"col-xs-3\">".$row['muscle_pain']."</div>
									<br>
									<div class=\"col-xs-9\">Diabetes or thyroid condition:</div>
									<div class=\"col-xs-3\">".$row['diabetes']."</div>
									<br>
									<div class=\"col-xs-9\">Pregnancy:</div>
									<div class=\"col-xs-3\">".$row['pregnancy']."</div>
									<br>
									<div class=\"col-xs-9\">Asthma or difficulty:</div>
									<div class=\"col-xs-3\">".$row['asthma']."</div>
									<br>
									<div class=\"col-xs-9\">Increased blood cholesterol:</div>
									<div class=\"col-xs-3\">".$row['blood_cholesterol']."</div>
									<br>
									<div class=\"col-xs-9\">Hernia or any condition affected by lifting weight:</div>
									<div class=\"col-xs-3\">".$row['hernia']."</div>
									<br>
									<div class=\"col-xs-9\">Family member with heart problems, asthma or diabetes?</div>
									<div class=\"col-xs-3\">".$row['family_problem']."</div>
									<br>
									<div class=\"col-xs-9\">If yes, relationship:</div>
									<div class=\"col-xs-3\">".$row['relationship']."</div>
									<br>
								";
							
						}
					?>
						  

								

                </div>
              </div>
            </div>
        </div>
     
		
	
	<div class="modal fade" id="myModalNorm1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog" style="color:black">
			<div class="modal-content">
				<!-- Modal Header -->
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">
					   <span aria-hidden="true">&times;</span>
					   <span class="sr-only">Close</span>
					</button>
					<h4 class="modal-title" id="myModalLabel">
						Attendance
					</h4>
				</div>
				<div class="container" style="color:black">
					<div class="col-xs-6" style="text-align:center;padding-bottom:20px;">
								
						<div class="row" style="margin-bottom:15px;margin-top:10px;font-weight:bold;">
							<div class="col-xs-6">DATE OF ATTENDANCE</div>
							<div class="col-xs-6">PROMO REGISTERED</div>
						</div>
							
						<?php
							$username = $_SESSION['username'];
							$sql = "SELECT * FROM attendance_log WHERE username ='$username' ORDER BY attendance_date DESC";
							$data= mysqli_query($connection,$sql);
							
							while ($rows = mysqli_fetch_row($data)){
								$timestamp = strtotime($rows[1]);
								$printDate = date('M-d-Y', $timestamp);									
								print("
									<div class=\"row\">
										<div class=\"col-xs-6\">$printDate</div>
										<div class=\"col-xs-6\">".$rows[2]."</div>
									</div>
								");
							}					
						?>	
					</div>
				</div>
			</div>
		</div>
	</div>
					
	<div class="modal fade" id="myModalNorm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog" style="color:black">
			<div class="modal-content">
				<!-- Modal Header -->
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">
					   <span aria-hidden="true">&times;</span>
					   <span class="sr-only">Close</span>
					</button>
					<h4 class="modal-title" id="myModalLabel">
						Attend Class
					</h4>
				</div>
				<?php
					$username = $_SESSION['username'];
					$sql = "SELECT * FROM clients WHERE username ='$username'";
					$data= mysqli_query($connection,$sql);
					$attendanceCount = "SELECT attendance_count FROM clients WHERE username ='$username'";
					$count= mysqli_query($connection,$attendanceCount);
					$ACount = mysqli_fetch_array($count)['attendance_count'];
					$rates = mysqli_fetch_array($data)['rates'];
					
					$_SESSION['ACount'] = $ACount;
					$_SESSION['rates'] = $rates;
					if($rates == null){
						echo 'You are currently not enrolled in any promo. Choose one promo!';
						$_SESSION['CheckCheck'] = 'new';
						print("
							<form action=\"successattend.php\" method=\"post\">
								<div class=\"container\">
									<div class=\"row\">
										<div  class=\"panel\" role=\"tabpanel\" >
											<label class=\"radio-inline\"  style=\"color:black\">
												<input name=\"promos\" id=\"radio2\" value=\"regular\" type=\"radio\" style=\"color:black\" required> Regular
											</label>											
										</div>
									</div>
									<div class=\"row\">
										<div  class=\"panel\" role=\"tabpanel\" >
											<label class=\"radio-inline\"  style=\"color:black\">
												<input name=\"promos\" id=\"radio2\" value=\"monthly\" type=\"radio\" style=\"color:black\" required> Monthly
											</label>											
										</div>
									</div>
									<div class=\"row\">
										<div  class=\"panel\" role=\"tabpanel\" >
											<label class=\"radio-inline\"  style=\"color:black\">
												<input name=\"promos\" id=\"radio2\" value=\"student monthly\" type=\"radio\" style=\"color:black\" required> Student Monthly
											</label>											
										</div>
									</div>
									<div class=\"row\">
										<div  class=\"panel\" role=\"tabpanel\" >
											<label class=\"radio-inline\"  style=\"color:black\">
												<input name=\"promos\" id=\"radio2\" value=\"8 sessions\" type=\"radio\" style=\"color:black\" required> 8 Sessions
											</label>											
										</div>
									</div>
									<div class=\"row\">
										<div  class=\"panel\" role=\"tabpanel\" >
											<label class=\"radio-inline\"  style=\"color:black\">
												<input name=\"promos\" id=\"radio2\" value=\"12 sessions\" type=\"radio\" style=\"color:black\" required> 12 Sessions
											</label>											
										</div>
									</div>
									<div class=\"row\">
										<div  class=\"panel\" role=\"tabpanel\" >
											<label class=\"radio-inline\"  style=\"color:black\">
												username of staff:
												<input name=\"staff_username\" id=\"staff_username\"  type=\"text\" style=\"color:black\" autocomplete=\"off\" required>
											</label>
											<label style=\"color:black; font-size: 12px; font-weight: 500;\" id=\"user-result\"> </label>
										</div>
									</div>
								</div>
										
								<!-- Modal Footer -->
										<div class=\"modal-footer\">
											<input class=\"btn btn-danger\" type=\"submit\" value=\"REGISTER\" name=\"finish\" id=\"submit_button\" disabled>
										</div>
									</form>
								");
					}else{
						$_SESSION['CheckCheck'] = 'exist';
						
						if($rates == 'monthly' || $rates == 'student monthly'){
							$reg = "SELECT date_of_promos FROM clients WHERE username='$username'";
							$reg1= mysqli_query($connection,$reg);	
							$dateOfPromo = mysqli_fetch_array($reg1)['date_of_promos'];
							$currentDate = date("m",strtotime($dateOfPromo));
							$nextMonth = date("m",strtotime($dateOfPromo." +1 month"));
							
							if($currentDate==$nextMonth-1){
								$expirationDate = date('M/d/Y',strtotime($dateOfPromo." +1 month"));
								$expirationDate1 = date('Y-m-d',strtotime($dateOfPromo." +1 month"));
							}else{
								$expirationDate = date('M/d/Y', strtotime("last day of next month",strtotime($dateOfPromo)));
								$expirationDate1 = date('Y-m-d', strtotime("last day of next month",strtotime($dateOfPromo)));
							}
							
						}else{
							$expirationDate = '';
						}

						print("<form action=\"successattend.php\" method=\"post\">
								<div class=\"container\" >
									<div class=\"col-xs-6\" style=\"color:black;padding:50px\">
 									<table class=\"table table-hover\">
										<tr>	
											<td>'Your are now enrolled in :</td>
											<td>$rates</td>
										</tr>
										<tr>	
											<td>You have attended : </td>
											<td>$ACount session/s</td>
										</tr>
										<tr>	
											<td>Promo expires in : </td>
											<td>$expirationDate</td>
										</tr>
									</table>
									</div>									
								</div>
								
								
								<!-- Modal Footer -->
								<div class=\"modal-footer\">
									<input class=\"btn btn-danger\" type=\"submit\" value=\"PROCEED\" name=\"proceed\" id=\"proceed_button\" >
								</div>
							</form>
						");
					}	if($_SESSION['success'] == 'true'){
							
							if($rates == '8 sessions'){
								if($ACount == 7){
									echo "<script> 
										document.getElementById('modal-body').innerHTML = '<b>You only have 1 session left before your subscription expires.</b><br><br>Register again to a promo/rate <br>to enjoy the services of the gym.';
										window.setTimeout(function() {
											$('#myModal').modal('show');
										},1000);
									  </script>";
									  
								}
							}else if($rates == '12 sessions'){
								if($ACount == 11){
									echo "<script> 
										document.getElementById('modal-body').innerHTML = '<b>You only have 1 session left before your subscription expires.</b><br><br>Register again to a promo/rate <br>to enjoy the services of the gym.';
										window.setTimeout(function() {
											$('#myModal').modal('show');
										},1000);
									  </script>";
								}
							}else if($rates == 'monthly' || $rates == 'student monthly'){
								$dateNow = date('Y-m-d');
								$date = (strtotime($expirationDate1) - strtotime($dateNow)) / (60 * 60 * 24);
								if($date == 0){
									echo "<script> 
										document.getElementById('modal-body').innerHTML = '<b>Your promo subscription will expire today.</b><br><br>Register again to a promo/rate <br>to enjoy the services of the gym.';
										window.setTimeout(function() {
											$('#myModal').modal('show');
										},1000);
									  </script>";
								}else if($date <= 5){
									echo "<script> 
										document.getElementById('modal-body').innerHTML = '<b>Your promo subscription will expire in ".$date." day/s.</b><br><br>Register again to a promo/rate <br>to enjoy the services of the gym.';
										window.setTimeout(function() {
											$('#myModal').modal('show');
										},1000);
									  </script>";
								}
								
							}else if($_SESSION['regular'] != 1){
								echo "<script> 
										document.getElementById('modal-body').innerHTML = '<b>Your promo subscription expires.</b><br><br>Register again to a promo/rate <br>to enjoy the services of the gym.';
										window.setTimeout(function() {
											$('#myModal').modal('show');
										},1000);
									  </script>";
							
							}
						}
						
					
				?>	
						
			</div>
		</div>
	</div>
	
					
	
	 <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
	<?php
		if($_SESSION['success']=='true'){
			echo "
				<script type='text/javascript'>
				document.getElementById('success_prompt').innerHTML = 'successfully attended! Enjoy!';
				$(function() {
					$('#success_prompt').delay(2000).fadeOut(500);
				});
				</script>
				
			";
			
			$_SESSION['success'] = 'false';
		}
		
	?>
	
	<script type="text/javascript">
		
	
		function updateValue(){
			<?php
				$sql = "SELECT * FROM clients WHERE username ='$username'";
				$data= mysqli_query($connection,$sql);
				$row = mysqli_fetch_array($data, MYSQLI_BOTH);
				
			?>
				document.getElementById('newpassword').disabled = true;
				document.getElementById('newpassword').value = "";
				document.getElementById('oldpassword').value = "";
				document.getElementById('username').value = "<?php echo $row['username']; ?>";
				document.getElementById('fullname').value = "<?php echo $row['fullname']; ?>";
				document.getElementById('address').value = "<?php echo $row['address']; ?>";
				document.getElementById('occupation').value = "<?php echo $row['occupation']; ?>";
				document.getElementById('telephone').value = "<?php echo $row['telephone']; ?>";
				document.getElementById('birthday').value = "<?php echo $row['birthday']; ?>";
				document.getElementById('age').value = "<?php echo $row['age']; ?>";
				document.getElementById('sex').value = "<?php echo $row['sex']; ?>";
				document.getElementById('weight').value = "<?php echo $row['weight']; ?>";
				document.getElementById('height').value = "<?php echo $row['height']; ?>";
				document.getElementById('emergency_name').value = "<?php echo $row['emergency_name']; ?>";
				document.getElementById('emergency_relationship').value = "<?php echo $row['emergency_relationship']; ?>";
				document.getElementById('emergency_address').value = "<?php echo $row['emergency_address']; ?>";
				document.getElementById('emergency').value = "<?php echo $row['relationship']; ?>";

				
				<?php 
				$x = 1;
				for($i = 21; $i <= 34 ;$i++){
				//	echo $row[$i];
					if($row[$i] == 'yes'){
						echo "document.getElementById('radio$x').checked = true;";
						$x++;
						$x++;
					}else{
						$x++;
						echo "document.getElementById('radio$x').checked = true;";
						$x++;
					}
				}
				?>
				 
		}
		
		function checkPassword(){
			if(document.getElementById('oldpassword').value == "<?php echo $row['password']; ?>")
			{
				document.getElementById('oldpassword').style.backgroundColor = "white";
				document.getElementById("newpassword").disabled = false; 
			}else{
				document.getElementById('oldpassword').style.backgroundColor = "red";
				
			}
		
		}
		
		$(document).ready(function() {
		
		var x_timer; 
			$("#staff_username").keyup(function (e){
				clearTimeout(x_timer);
				var user_name = $(this).val();
				x_timer = setTimeout(function(){
					check_username_ajax1(user_name);
				}, 1000);
			}); 
			
			function check_username_ajax1(username){
			$.post('checkStaff.php', {'username':username}, function(data) {
				document.getElementById('user-result').style.color = "red";
				$("#user-result").html(data);
				var mac = document.getElementById("user-result").innerHTML;
				if(mac == 'available'){	
					document.getElementById("user-result").innerHTML = "no staff found";
					document.getElementById("submit_button").disabled = true; 
				}else{
					
					document.getElementById('user-result').style.color = "black";
					document.getElementById("submit_button").disabled = false; 
				}
			});
			
		}
			
		});
		
		
		$(document).ready(function() {
		
		var x_timer; 
			$("#memberStaff").keyup(function (e){
				clearTimeout(x_timer);
				var user_name = $(this).val();
				x_timer = setTimeout(function(){
					check_username_ajax1(user_name);
				}, 1000);
			}); 
			
			function check_username_ajax1(username){
			$.post('checkStaff.php', {'username':username}, function(data) {
				document.getElementById('user-resultt').style.color = "red";
				$("#user-resultt").html(data);
				var mac = document.getElementById("user-resultt").innerHTML;
				if(mac == 'available'){	
					document.getElementById("user-resultt").innerHTML = "no staff found";
					document.getElementById("memberSubmit").disabled = true; 
				}else{
					
					document.getElementById('user-resultt').style.color = "black";
					document.getElementById("memberSubmit").disabled = false; 
				}
			});
			
		}
			
		});
		

	</script>
</body>

</html>