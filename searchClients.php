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
							<?php
								if($_SESSION['role'] == 'admin'){
									echo "
										<li><a href=\"staffProfile.php\" style=\"color:white\">Profile</a></li>
										<li class=\"active\" ><a href=\"searchClients.php\" style=\"color:white\">Clients</a></li>
										<li><a href=\"editStaff.php\" style=\"color:white\">Staff</a></li>
										<li><a href=\"adminInventory.php\" style=\"color:white\">Admin</a></li>
									";
								}else{
									echo "
										<li><a href=\"staffProfile.php\" style=\"color:white\">Profile</a></li>
										<li class=\"active\" ><a href=\"searchClients.php\" style=\"color:white\">Clients</a></li>
										<li><a href=\"staffInventory.php\" style=\"color:white\">Inventory</a></li>
									";
								}
							?>
							  <li><a href="index.php" style="color:white">Logout</a></li>
            			</ul>
            		</div>
            		<!-- /.Navbar-collapse -->		 
				</div>
			</div>
			<!-- /.container -->
		</nav>
    </div> 
	
	<form class="form-horizontal" name="seachClient" action="" method="post">
		<div class="col-md-12" style="margin-top:120px">
            <div class="input-group" id="adv-search">
                <input type="text" id="clientValue" name="clientValue" class="form-control" placeholder="enter keyword" />
                <div class="input-group-btn">
                    <div class="btn-group" role="group">
                        <div class="dropdown dropdown-lg">
                            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><span class="caret"></span></button>
                            <div class="dropdown-menu dropdown-menu-right" role="menu" style="color:black">
                                  
                                    <label>Search by</label>
                                        <label class="radio">
											<input name="filter" id="username" value="username" type="radio" checked="checked" <?php if (isset($_POST['filter']) && $_POST['filter'] == 'username') echo ' checked="checked"';?>/> Username
										</label>
										<label class="radio">
										  <input name="filter" id="fullname" value="fullname" type="radio" <?php if (isset($_POST['filter']) && $_POST['filter'] == 'fullname') echo ' checked="checked"';?>> Name
										  
										</label>
										<label class="radio">
										  <input name="filter" id="membership" value="membership" type="radio" <?php if (isset($_POST['filter']) && $_POST['filter'] == 'membership') echo ' checked="checked"';?>> Membership
										</label>
										<label class="radio">
										  <input name="filter" id="rates" value="rates" type="radio" <?php if (isset($_POST['filter']) && $_POST['filter'] == 'rates') echo ' checked="checked"';?>> Promo / Rates
										</label>
										<label class="radio">
										  <input name="filter" id="address" value="address" type="radio" <?php if (isset($_POST['filter']) && $_POST['filter'] == 'address') echo ' checked="checked"';?>> Address
										</label>                                                          
                            </div>
                        </div>
                        <button type="submit" class="btn btn-danger" name="searchh" id="searchh" onclick="displayProfile()"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>
                    </div>
                </div>
            </div>
          </div>
        </div>
	</form>
	
	<div class="panel panel-primary" id="panel1" style="display:block; margin-left: auto; margin-right: auto; width: 8in;background-color: #fdfdfd; margin-top:200px;">
		<div class="panel-heading">SEARCH CLIENTS RESULT</div>
		<div class="panel-body">
		
			 
				
			
			<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
					<?php

						if(isset($_POST['searchh']) && $_POST['clientValue']!=''){
							
							if($_POST['clientValue'] == 'all'){
								$sql = "SELECT * FROM clients WHERE 1";
								$data= mysqli_query($connection,$sql);
							}else{
							
								$search = $_POST['clientValue'];	
								if($search == 'non member' || $search == 'nonmember' || $search == 'non-member'){
									$search = 'nonmember';
								}
								$filter = $_POST['filter'];
								$sql = "SELECT * FROM clients WHERE $filter REGEXP '([[:blank:][:punct:]]|^)$search([[:blank:][:punct:]]|$)'";
								$data= mysqli_query($connection,$sql);
							}
							while($row = mysqli_fetch_array($data)){ 
								$mac = $row['username'];
								if($row['rates'] == null){
									$rates = 'no promo';
								}else{ 
									$rates = $row['rates'];
								}
								echo "					
								<div class=\"panel panel-custom\" style=\"margin-left:80px\">
									<div class=\"panel-heading\" role=\"tab\" id=\"heading.$mac\" >
										<h4 class=\"panel-title\" style=\" text-transform: lowercase\">
											<a class=\"collapsed\" data-toggle=\"collapse\" data-parent=\"#accordion\" href=\"#$mac\" aria-expanded=\"false\" aria-controls=\"$mac\">
												<i class=\"glyphicon glyphicon-plus\"></i>
												 username : ".$row['username']."<br>
												&nbsp&nbsp&nbsp full name : ".$row['fullname']."<br>
											</a>
										</h4>
									</div>
									<div id=\"$mac\" class=\"panel-collapse collapse\" role=\"tabpanel\" aria-labelledby=\"heading.$mac\">
										<div class=\"panel-body\" style=\"color:black; font-size: 15px; font-family: 'Roboto', sans-serif;\">
											
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
											<div class=\"col-xs-12\" style=\"font-weight:bold;margin-top:50px;margin-bottom:15px\">HEALTH ISSUES</div>
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
										</div>
									</div>
								</div>
							
									
								";
							}
						}
					?>
					
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
		
		$(function() {

			function toggleChevron(e) {
				$(e.target)
						.prev('.panel-heading')
						.find("i")
						.toggleClass('rotate-icon');
				$('.panel-body.animated').toggleClass('zoomIn zoomOut');
			}
			
			$('#accordion').on('hide.bs.collapse', toggleChevron);
			$('#accordion').on('show.bs.collapse', toggleChevron);
		});
	</script>
	
</body>

</html>