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
            				  <li class="active" ><a href="" style="color:white">Profile</a></li>
							  <li ><a href="searchClients.php" style="color:white">Clients</a></li>
							  <?php
								if($_SESSION['role'] == 'admin'){
									echo "<li ><a href='editStaff.php' style='color:white'>Staff</a></li>";
									echo "<li ><a href='adminInventory.php' style='color:white'>Admin</a></li>";
								}else{
									echo "<li ><a href='staffInventory.php' style='color:white'>Inventory</a></li>";
								}
								
							  ?>							  
							  <li ><a href="index.php" style="color:white">Logout</a></li>
            			</ul>
            		</div>
            		<!-- /.Navbar-collapse -->		 
				</div>
			</div>
			<!-- /.container -->
		</nav>
    </div> 
	<div class="panel panel-primary" id="panel1" style=" margin-left: auto; margin-right: auto; width: 8in;background-color: #fdfdfd; margin-top:150px;height:auto">
        <div class="panel-heading"  style="height:50px">
			<div style="margin-top:4px">TODAY'S ATTENDANCE </div>			
		</div>		
		<div class="panel-body">
			<div class="form-group">
				<div class="col-xs-12">
					<table class="table table-hover">
						<thead >
							<tr>
								<th>Count</th>
								<th>username</th>
								<th>Promo</th>
							</tr>
						</thead>
						<tbody>
							<?php
								$sql = "SELECT * FROM attendance_log WHERE 1";
								$data= mysqli_query($connection,$sql);
								$num = 0;
								date_default_timezone_set("Asia/Manila");
								
								while($row = mysqli_fetch_array($data)){
									$timestamp = strtotime($row['attendance_date']);
									$printDate = date('d-m-Y', $timestamp);
									$today = date("d-m-Y");
									if($printDate == $today){
										$num++;
										echo "
											<tr>	
												<td>$num</td>
												<td>".$row['username']."</td>
												<td>".$row['rates']."</td>
											</tr>
										";
									}
								}
							?>
							
						</tbody>
					</table>
				
				
				</div>
			</div>
		</div>
	</div>
	
	<div class="panel panel-primary" id="panel1" style=" margin-left: auto; margin-right: auto; width: 8in;background-color: #fdfdfd; margin-top:50px;height:auto">
        <div class="panel-heading"  style="height:50px">
			<div style="margin-top:4px">TODAY'S INVENTORY </div>			
		</div>		
		<div class="panel-body">
			<div class="form-group">
				<div class="col-xs-12">
					<table class="table table-hover">
						<thead >
							<tr>
								<th>Count</th>
								<th>Staff</th>
								<th>Category</th>
								<th>Amount</th>
								<th>Label</th>
							</tr>
						</thead>
						<tbody>
							<?php
								$sql = "SELECT * FROM inventory WHERE 1";
								$data= mysqli_query($connection,$sql);
								$num = 0;
								date_default_timezone_set("Asia/Manila");
								$_SESSION['revenue']  = 0;
								$_SESSION['expenses'] = 0;
								
								
								while($row = mysqli_fetch_array($data)){
									$timestamp = strtotime($row['date']);
									$printDate = date('d-m-Y', $timestamp);
									$today = date("d-m-Y");
									if($printDate == $today){
										$num++;
										if($row['category'] == 'revenue'){
											$_SESSION['revenue'] = $_SESSION['revenue'] + $row['amount'];
										}else{
											$_SESSION['expenses'] = $_SESSION['expenses'] + $row['amount'];
										}
										echo "
											<tr>	
												<td>$num</td>
												<td>".$row['staff_name']."</td>
												<td>".$row['category']."</td>												
												<td>".$row['amount']."</td>
												<td>".$row['label']."</td>

											</tr>
										";
									}
								}
							?>
							
						</tbody>
					</table>
					
					<table class="table table-hover" style="width:4in;text-align:center;margin-left:150px;margin-top:50px">
						
						<tbody>
							<tr>
							<td>TOTAL REVENUE:</td>
							<td><?php echo $_SESSION['revenue'];?> pesos </td>
							</tr>
							<tr>
							<td>TOTAL EXPENSES: </td>
							<td><?php echo $_SESSION['expenses'];?> pesos </td>
							</tr>
						</tbody>
					</table>
					
				</div>
			</div>
		</div>
	</div>
	
	
	
	
	

	

	
	
	
	
	 <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
</body>

</html>