<?php
session_start();
$connection = mysqli_connect("localhost", "root", "","red_gloves"); // Establishing Connection with Server
if(mysqli_connect_error()) echo "Connection Fail";	
$_SESSION['username'] = '';
$_SESSION['success'] = '';
$_SESSION['beAMember'] = '';
$_SESSION['successEdit'] = '';
$_SESSION['source'] = '';
$_SESSION['regular'] = '';
$_SESSION['addStaff'] = '';
$_SESSION['deleteStaff'] = '';
$_SESSION['addInventory'] = '';
$_SESSION['successEditRates'] = '';
$_SESSION['startdate1'] = '';
$_SESSION['enddate1'] = '';
$_SESSION['daily'] = '';
$_SESSION['startDay'] = '';
$_SESSION['endDay'] = '';
$_SESSION['year'] = '';
$_SESSION['month'] = '';
$_SESSION['date1'] = '';
$_SESSION['date2'] = '';
$_SESSION['annual'] = '';
$_SESSION['fromSignup'] = 'false';
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
	
	
	
	
	
	<section id="login">
    <div class="container">
    	<div class="row">
    	    <div class="col-xs-12">
        	    <div class="form-wrap" style="text-align:center">
                <h1>Login to your account</h1>
                    <form role="form" action="authenticate.php" method="post" id="login-form" >
                        <div class="form-group">
                            <input type="username" name="username" id="username" class="form-control" placeholder="username" autocomplete="off"  required/>
                        </div>
                        <div class="form-group">
                            <input type="password"  name="password" id="password" class="form-control" placeholder="password" autocomplete="off" required/>
                        </div>
						<div id="inc_pass" style=" margin-top:-20px; font-style: italic;height:25px;font-size: 13px; font-family: 'Roboto', sans-serif; font-weight: 600;color:red">
							
						</div>
                        <input type="button" id="btn-login" class="btn btn-danger btn-lg btn-block" value="LOG IN" onclick="Authenticate()">
					</form>
					<a class="signup" href="signup.php">Sign-up</a>
                    <hr>
        	    </div>
    		</div> <!-- /.col-xs-12 -->
    	</div> <!-- /.row -->
    </div> <!-- /.container -->
</section>

	<?php
	date_default_timezone_set("Asia/Manila");
		$query1 = "DELETE FROM promo_almost_expired WHERE 1";
		mysqli_query($connection,$query1);
		$sql = "SELECT * FROM clients WHERE 1";
		$data= mysqli_query($connection,$sql);
								
		while($row = mysqli_fetch_array($data)){
			$rates = $row['rates'];
			$aCount = $row['attendance_count'];
			$username = $row['username'];
			$dateOfPromo = $row['date_of_promos'];
			$currentDate = date("m",strtotime($dateOfPromo));
			$nextMonth = date("m",strtotime($dateOfPromo." +1 month"));
							
			if($currentDate==$nextMonth-1){
				$expirationDate = date('Y-m-d',strtotime($dateOfPromo." +1 month"));
			}else{
				$expirationDate = date('Y-m-d', strtotime("last day of next month",strtotime($dateOfPromo)));
			}
			
			if($rates == '8 sessions'){
				if($aCount == 6){
					$q = "INSERT INTO promo_almost_expired VALUES ('$username','$rates','2 sessions left')";
					$query = mysqli_query($connection,$q);
				}else if($aCount == 7){
					$q = "INSERT INTO promo_almost_expired VALUES ('$username','$rates','1 sessions left')";
					$query = mysqli_query($connection,$q);
				}	
			}else if($rates == '12 sessions'){
			
				if($aCount == 10){
					$q = "INSERT INTO promo_almost_expired VALUES ('$username','$rates','2 sessions left')";
					$query = mysqli_query($connection,$q);
				}else if($aCount == 11){
					$q = "INSERT INTO promo_almost_expired VALUES ('$username','$rates','1 sessions left')";
					$query = mysqli_query($connection,$q);
				}	
			}else if($rates == 'monthly' || $rates == 'student monthly'){
				$dateNow = date('Y-m-d');
				$date = (strtotime($expirationDate) - strtotime($dateNow)) / (60 * 60 * 24);			
					if($date == 0){
				
					$q = "INSERT INTO promo_almost_expired VALUES ('$username','$rates','last day')";
					$query = mysqli_query($connection,$q);
				}else if($date == 1){
					$q = "INSERT INTO promo_almost_expired VALUES ('$username','$rates','1 day left')";
					$query = mysqli_query($connection,$q);
				}else if($date == 2){
					$q = "INSERT INTO promo_almost_expired VALUES ('$username','$rates','2 days left')";
					$query = mysqli_query($connection,$q);
				
				}
			}
			
		}
	
	?>

	
	
	
	
	 <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
</body>


<script>
function Authenticate() {
var username = document.getElementById('username').value;
var password = document.getElementById('password').value;
    $.post("authenticate.php", {username:username, password:password},
	function(data) {
	 if(data== "incorrect username/password"){
		$('#inc_pass').html(data);
	}else{
		window.location = data;
	}
    });
	
}
</script>

</html>