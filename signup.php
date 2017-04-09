<?php 
session_start();
$connection = mysqli_connect("localhost", "root", "","red_gloves"); // Establishing Connection with Server
if(mysqli_connect_error()) echo "Connection Fail";
$_SESSION['fromSignup'] = "true";

$username = $_SESSION['username'];

if($username != ''){
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
            				  <li class="active" ><a href="index.php" style="color:white">Login</a></li>
							  
            			</ul>
            		</div>
            		<!-- /.Navbar-collapse -->		 
				</div>
			</div>
			<!-- /.container -->
		</nav>
    </div> 
	
	
	<form class="form-horizontal" name="profile" action="successregister.php" method="post">
		
		
		<div class="panel panel-primary" id="panel1" style="margin-left: auto; margin-right: auto; width: 9in;background-color: #fdfdfd; margin-top:120px;">
			<div class="panel-heading">LOGIN INFORMATION</div>
			<div class="panel-body">
				<div class="form-group" style="text-align:center;">
					<div class="col-xs-4">
						<label style="color:black">Preferred Username</label>
						<input style="text-align:center" type="text" class="form-control" id='username' name="username" placeholder="username"  autocomplete="off" required>
					</div>
					<div class="col-xs-4">
						<label style="color:black">Preferred Password</label>
						<input style="text-align:center" type="password" class="form-control" id="password1" name="password1" placeholder="password" required>
					</div>
					<div class="col-xs-4">
						<label style="color:black">Retype Password</label>						
						<input style="text-align:center" type="password" class="form-control" id="password2" name="password2" placeholder="retype password" onblur="checkPassword()" required>
					</div>
				</div>
				<div class="form-group" style="text-align:center;margin-top:-50px">
					<div class="col-xs-4">
						<label style="color:black; font-size: 12px; font-weight: 500;" id="user-result">  </label>
					</div>
					<div class="col-xs-4">
					</div>
					<div class="col-xs-4">
						<label style="color:red; font-size: 12px; font-weight: 500;" id="incorrect_password">  </label>
					</div>
				</div>
			</div>
		</div>
		
		<div class="panel panel-primary" id="panel1" style="margin-left: auto; margin-right: auto; width: 9in;background-color: #fdfdfd; margin-top:20px;">
			<div class="panel-heading">BASIC INFORMATION</div>
			<div class="panel-body">	
				<div class="form-group" style="margin-top:10px;">
					<div class="col-xs-8">
						<label style="color:black">Full Name</label>
						<input type="text" class="form-control" name="fullname" placeholder="Full Name"  autocomplete="off" required>
					</div>
					<div class="col-xs-4">
						<label style="color:black">Date</label>
						<input class="form-control" id="date" name="date_of_application" placeholder="mm/dd/yyyy" type="date" required>
					</div>					
				</div>
				<div class="form-group">
					<div class="col-xs-8">
						<label style="color:black">Address</label>
						<input type="text" class="form-control" name="address" placeholder="Address"  autocomplete="off" required>
					</div>
					<div class="col-xs-4">
						<label style="color:black">Occupation</label>
						<input type="text"  class="form-control" name="occupation" placeholder="Occupation"  autocomplete="off" required>
					</div>
					
				</div>
				
				<div class="form-group">	
					<div class="col-xs-4">
						<label style="color:black">Telephone Number</label>
						<input type="text" class="form-control" name="telephone"  placeholder="09xxxxxxxxx"  autocomplete="off" required>
					</div>
					<div class="col-xs-4">
						<label style="color:black">Birthday</label>
						<input class="form-control" id="birthday" name="birthday" placeholder="mm/dd/yyyy" type="date" required>
					</div>
					<div class="col-xs-4">
						<label style="color:black">Age</label>
						<input type="text" class="form-control" name="age"  placeholder="Age"  autocomplete="off" required>
					</div>
				</div>
				
				<div class="form-group">	
					<div class="col-xs-4">
						<label style="color:black">Sex</label>
						<select name="sex" class = "form-control" required>
							<option selected disabled value >  </option>
							<option value="Male" > Male </option>
							<option value="Female" > Female </option>
						</select>
					</div>
					<div class="col-xs-4">
						<label style="color:black">Weight (kg)</label>
						<input type="number" class="form-control" name="weight" placeholder="Weight" min="0" required>
					</div>
					<div class="col-xs-4">
						<label style="color:black">Height (cm)</label>
						<input type="number" class="form-control" name="height"  placeholder="Height" min="0" required>
					</div>
				</div>
					
				<div class="form-group">
					<div class="col-xs-6">
						<label style="color:black">Person to notify in case of emergency</label>
						<input type="text" class="form-control" name="emergency_name" placeholder="Person to notify in case of emergency"  autocomplete="off" required>
					</div>
					<div class="col-xs-6">
						<label style="color:black">Relationship on that person</label>
						<input type="text" class="form-control" name="emergency_relationship" placeholder="Relationship on that person"  autocomplete="off" required>
					</div>
				</div>
				<div class="form-group">
					<div class="col-xs-12">
						<label style="color:black">His/her address</label>
						<input type="text" class="form-control" name="emergency_address"  placeholder="His / Her Address"  autocomplete="off" required>
					</div>
				</div>

			</div>			
		</div>
		
		<div class="panel panel-primary" id="panel2" style="margin-left: auto; margin-right: auto; width: 9in;background-color: #fdfdfd; margin-top:20px;">
			<div class="panel-heading">HEALTH HISTORY</div>
			<div class="panel-body">
				<div class="instruction" style="margin-top:10px;margin-bottom:30px;">
					We would like to know your physical condition.
					Please read carefully the following <br>checklist and answer the same accordingly:
				</div>
				<div class="col-xs-12">
					<table class="table table-striped">
						<tbody>
						<tr>
						  <td>1. Heart problem, chest or stroke</td>
							<td>
								<label class="radio-inline">
									<input name="radioGroup1" id="radio1" value="yes" type="radio" required> Yes
								</label>
								<label class="radio-inline">
								  <input name="radioGroup1" id="radio2" value="no" type="radio"> No
								</label>
							</td>
						</tr>
						<tr>
							<td>2. Increase blood pressure</td>
							<td>
								<label class="radio-inline">
									<input name="radioGroup2" id="radio3" value="yes" type="radio" required> Yes
								</label>
								<label class="radio-inline">
								  <input name="radioGroup2" id="radio4" value="no" type="radio"> No
								</label>
							</td>
						</tr>
						<tr>
							<td>3. Any chronic illness or condition</td>
							<td>
								<label class="radio-inline">
									<input name="radioGroup3" id="radio5" value="yes" type="radio" required> Yes
								</label>
								<label class="radio-inline">
								  <input name="radioGroup3" id="radio6" value="no" type="radio"> No
								</label>
							</td>
						</tr>
						<tr>
							<td>4. Difficulty with physical exercise</td>
							<td>
								<label class="radio-inline">
									<input name="radioGroup4" id="radio7" value="yes" type="radio" required> Yes
								</label>
								<label class="radio-inline">
								  <input name="radioGroup4" id="radio8" value="no" type="radio"> No
								</label>
							</td>
						</tr>
						<tr>
							<td>5. Advice by a doctor not to exercise</td>
							<td>
								<label class="radio-inline">
									<input name="radioGroup5" id="radio9" value="yes" type="radio" required> Yes
								</label>
								<label class="radio-inline">
								  <input name="radioGroup5" id="radio10" value="no" type="radio"> No
								</label>
							</td>
						</tr>
						<tr>
							<td>6. Surgery during the last 12 months</td>
							<td>
								<label class="radio-inline">
									<input name="radioGroup6" id="radio11" value="yes" type="radio" required> Yes
								</label>
								<label class="radio-inline">
								  <input name="radioGroup6" id="radio12" value="no" type="radio"> No
								</label>
							</td>
						</tr>
						<tr style="height:20px">
						  <td>7. Muscles, joint pain affecting movement</td>
							<td>
								<label class="radio-inline">
									<input name="radioGroup7" id="radio13" value="yes" type="radio" required> Yes
								</label>
								<label class="radio-inline">
								  <input name="radioGroup7" id="radio14" value="no" type="radio"> No
								</label>
							</td>
						</tr>
						<tr>
							<td>8. Diabetes or thyroid condition</td>
							<td>
								<label class="radio-inline">
									<input name="radioGroup8" id="radio15" value="yes" type="radio" required> Yes
								</label>
								<label class="radio-inline">
								  <input name="radioGroup8" id="radio16" value="no" type="radio"> No
								</label>
							</td>
						</tr>
						<tr>
							<td>9. Pregnancy</td>
							<td>
								<label class="radio-inline">
									<input name="radioGroup9" id="radio17" value="yes" type="radio" required> Yes
								</label>
								<label class="radio-inline">
								  <input name="radioGroup9" id="radio18" value="no" type="radio"> No
								</label>
							</td>
						</tr>
						<tr>
							<td>10. Asthma or difficulty</td>
							<td>
								<label class="radio-inline">
									<input name="radioGroup10" id="radio19" value="yes" type="radio" required> Yes
								</label>
								<label class="radio-inline">
								  <input name="radioGroup10" id="radio20" value="no" type="radio"> No
								</label>
							</td>
						</tr>
						<tr>
							<td>11. Increased blood cholesterol</td>
							<td>
								<label class="radio-inline">
									<input name="radioGroup11" id="radio21" value="yes" type="radio" required> Yes
								</label>
								<label class="radio-inline">
								  <input name="radioGroup11" id="radio22" value="no" type="radio"> No
								</label>
							</td>
						</tr>
						<tr>
							<td>12. Hernia or any condition affected by lifting weight</td>
							<td>
								<label class="radio-inline">
									<input name="radioGroup12" id="radio23" value="yes" type="radio" required> Yes
								</label>
								<label class="radio-inline">
								  <input name="radioGroup12" id="radio24" value="no" type="radio"> No
								</label>
							</td>
						</tr>
						<tr>
							<td> 13. Do you have a member of your family who has heart problems, asthma, and diabetes?</td>
						
							<td>
								<label class="radio-inline">
									<input name="radioGroup13" id="radio25" value="yes" type="radio" required> Yes
								</label>
								<label class="radio-inline">
									  <input name="radioGroup13" id="radio26" value="no" type="radio"> No
								</label>
							</td>
						</tr>
						
						
					  </tbody>
					</table>
					<div class="col-xs-6">
							<input type="text" class="form-control" name="emergency" placeholder="If yes, relationship"  autocomplete="off">
						</div>
				</div>
			</div>			
		</div>
		
		<div class="panel panel-primary" id="panel4" style="margin-left: auto; margin-right: auto; width: 9in;background-color: #fdfdfd; margin-top:20px;">
			<div class="panel-heading">CHOOSE PROMO</div>
			<div class="panel-body">
				<div class="col-xs-12">
					<?php
										$sql = "SELECT value FROM promos WHERE 1";
										$data= mysqli_query($connection,$sql);
										
										
										$monthly1 = mysqli_fetch_row($data)[0];
										$monthly2 = mysqli_fetch_row($data)[0];
										$studmon1 = mysqli_fetch_row($data)[0];
										$studmon2 = mysqli_fetch_row($data)[0];
										$twelvesession1 = mysqli_fetch_row($data)[0];
										$twelvesession2 = mysqli_fetch_row($data)[0];
										$eightsession1 = mysqli_fetch_row($data)[0];
										$eightsession2 = mysqli_fetch_row($data)[0];
										$regular1 = mysqli_fetch_row($data)[0];
										$regular2 = mysqli_fetch_row($data)[0];
										$membershipFee = mysqli_fetch_row($data)[0];
									?>
						<!-- Button trigger modal -->
						<div class="col-xs-4">
						<select name="membership" class = "form-control" required>
							<option selected disabled value >  </option>
							<option value="member" > Member </option>
							<option value="nonmember" > Non Member </option>
						</select>
						</div>
						


						<!-- Button trigger modal -->
						<div class="col-xs-4">
						<select name="promos" class = "form-control" required>
							<option selected disabled value >  </option>
							<option value="regular" > Regular Session </option>
							<option value="monthly" > Monthly </option>
							<option value="student monthly" > Student Monthly </option>
							<option value="8 sessions" > 8 Sessions </option>
							<option value="12 sessions" > 12 Sessions </option>
						</select>
						</div>
						
								<div class="col-xs-4">
									<div class="form-group">
										<input type="text" class="form-control" id="staffRegister" name="staffRegister" placeholder="username of staff who registered you"  autocomplete="off" required>
										<label style="color:black; font-size: 12px; font-weight: 500;margin-left:80px;" id="user-result1"></label>
									</div>
								</div>
						
					
				</div>
			</div>
		</div>
		
		
		
		<div class="panel panel-primary" id="panel3" style="margin-left: auto; margin-right: auto; width: 9in;background-color: #fdfdfd; margin-top:20px;">
			<div class="panel-heading">UNDERTAKING</div>
			<div class="panel-body">
			<div class="col-xs-12">
				I attest to the truthfulness of my answer to the above statement.
				
				I agree and respect  that all exercise and use of Boxing facilities shall be undertaken at my own risk.
				Further attest that I am in good physical conditions to undertake any all exercise or to be lectured by the
				instructors/trainers.
				
				I do hereby release and discharge to Boxing Gym and all its stockholders and employee from all claims, injuries,
				damage and the likes connected with the use of any of the services, services, and the facilities of the
				Boxing Gym.
				
				I agree, in case of the accident or physical lapses on my part, to be examined by a physician at my expense
				and further undertake to finish Boxing Gym with a copy of the medical report.
				
				I agree to abide with rules, regulation, and policies of the Boxing Gym.
				
				I agree to respect the authority of all the boxers, trainers, and accept any correction which they may give insofar
				as training regimen is concerned.
				
				I have read the forgoing and understood the same.
			</div>
				
			</div>
		</div>	
		
		<div class="col-xs-12" style="margin-top:20px;margin-bottom:50px;">
			<input class="btn btn-danger btn-lg" type="submit" value="FINISH" id="finishSignup" name="finishSignup" style="float: right; width:200px;margin-right:230px;" disabled>
		</div>
		
		
	</form>
		
	

	
	
	
	
	 <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
	<script src="jquery-3.2.0.min.js"></script>
	<script>
		var username1;
		var staff1 ;
		
		function checkPassword(){
			if(document.getElementById("password1").value != document.getElementById("password2").value){
				document.getElementById("incorrect_password").innerHTML = '*password not match';
				document.getElementById("password2").style.backgroundColor = "red";
			}else{
				document.getElementById("incorrect_password").innerHTML = '';
				document.getElementById("password2").style.backgroundColor = "white";
			}
		}
		
		
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
			$.post('checkdata.php', {'username':username}, function(data) {
				document.getElementById('user-result').style.color = "red";
				$("#user-result").html(data);
				var mac = document.getElementById("user-result").innerHTML;
				if(mac == 'available'){
					document.getElementById('user-result').style.color = "black";
					username1 = 'yes';
				}
			});
			
		}			
		});
		
		$(document).ready(function() {
		
			var x_timer; 
			$("#staffRegister").keyup(function (e){
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
						document.getElementById('finishSignup').disabled = true; 
					}else{						
						document.getElementById('user-result1').style.color = "black";
						document.getElementById('finishSignup').disabled = false; 
					}
				});
				
			
			}
			
		});
		
		
		
	</script>
	
</body>

</html>