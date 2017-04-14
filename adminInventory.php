<?php
session_start();
$connection = mysqli_connect("localhost", "root", "","red_gloves"); // Establishing Connection with Server
if(mysqli_connect_error()) echo "Connection Fail";	
	date_default_timezone_set("Asia/Manila");
	$_SESSION['revenue'] = 0;
	$_SESSION['expenses'] = 0;
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
            				  <li ><a href="staffProfile.php" style="color:white">Home</a></li>
							  <li ><a href="searchClients.php" style="color:white">Clients</a></li>
							  <li ><a href='editStaff.php' style='color:white'>Staff</a></li>
							  <li class="active"><a href="adminInventory.php" style="color:white">Admin</a></li>
							  <li ><a href="index.php" style="color:white">Logout</a></li>
							  
            			</ul>
            		</div>
            		<!-- /.Navbar-collapse -->		 
				</div>
			</div>
			<!-- /.container -->
		</nav>
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
	<div class="panel panel-primary" id="panel1" style=" margin-left: auto; margin-right: auto; width: 8in;background-color: #fdfdfd; margin-top:150px;height:auto">
        <div class="panel-heading" style="height:53px">
			<div style="float:left;margin-top:5px"> INVENTORY </div>
			<div class="pull-right">
				<button class="btn btn-danger" data-toggle="modal" data-target="#addInventory">Add New Inventory</button>		
			</div>
		</div>
		<div class="panel-body">
			<div class="form-group">
			<form action="" method="post">
				<div class="col-xs-12" style="margin-bottom:20px;">
					<select class="form-control" id="seachType" name="seachType" onchange="getSearchValue()">
						<option selected disabled value > select type of search </option>
						<option <?php if(isset($_POST['seachType'])){if($_POST['seachType'] == 'manually'){echo 'selected="selected"';}} ?> value="manually" > Manually </option>
						<option <?php if(isset($_POST['seachType'])){if($_POST['seachType'] == 'daily'){echo 'selected="selected"';}} ?>value="daily" > Daily </option>
						<option <?php if(isset($_POST['seachType'])){if($_POST['seachType'] == 'weekly'){echo 'selected="selected"';}} ?>value="weekly" > Weekly </option>
						<option <?php if(isset($_POST['seachType'])){if($_POST['seachType'] == 'monthly'){echo 'selected="selected"';}} ?>value="monthly" > Monthly </option>
						<option <?php if(isset($_POST['seachType'])){if($_POST['seachType'] == 'quarterly'){echo 'selected="selected"';}} ?>value="quarterly" > Quarterly </option>
						<option <?php if(isset($_POST['seachType'])){if($_POST['seachType'] == 'annually'){echo 'selected="selected"';}} ?>value="annually" > Annually </option>
					</select>
				</div>
				
				<div class="col-xs-12">
					<div class="col-xs-8" id="head1" style="text-align:center;display:none;font-size: 16px;font-family: 'Roboto', sans-serif;font-weight: 600;">
						<div class="col-xs-6">
						START DATE
						</div>
						<div class="col-xs-6">
						END DATE
						</div>	
					</div>
					<div class="col-xs-8" id="head2" style="display:none;font-size: 16px;font-family: 'Roboto', sans-serif;font-weight: 600;">
						DATE
					</div>
					<div class="col-xs-8" id="head3" style="display:none;font-size: 16px;font-family: 'Roboto', sans-serif;font-weight: 600;">
						WEEK
					</div>
					<div class="col-xs-8" id="head4" style="display:none;font-size: 16px;font-family: 'Roboto', sans-serif;font-weight: 600;">
						MONTH
					</div>
					<div class="col-xs-8" id="head5" style="text-align:center;display:none;font-size: 16px;font-family: 'Roboto', sans-serif;font-weight: 600;">
						<div class="col-xs-6">
						QUARTER
						</div>
						<div class="col-xs-6">
						YEAR
						</div>	
					</div>
					<div class="col-xs-8" id="head6" style="display:none;font-size: 16px;font-family: 'Roboto', sans-serif;font-weight: 600;">
						YEAR
					</div>
					
					<div class="col-xs-8" id="manualDiv" style="<?php if(isset($_POST['startdate']) && $_POST['seachType'] == 'manually'){echo 'display:block';}else{echo 'display:none';} ?>">
						<div class="col-xs-6">
						<input type="date" class="form-control" id="startdate" name="startdate" value="<?php if(isset($_POST['startdate']) && $_POST['startdate']!=''){echo $_POST['startdate'];}?>">
						</div>
						<div class="col-xs-6">
						<input type="date" class="form-control"  id="enddate" name="enddate" value="<?php if(isset($_POST['enddate']) && $_POST['enddate']!=''){echo $_POST['enddate'];}?>">
						</div>
					</div>
					<div class="col-xs-8" id="dailyDiv" style="<?php if(isset($_POST['dailyDate']) && $_POST['seachType'] == 'daily'){echo 'display:block';}else{echo 'display:none';} ?>">
					<input type="date" class="form-control" id="dailyDate" name="dailyDate"  value="<?php if(isset($_POST['dailyDate']) && $_POST['dailyDate']!=''){echo $_POST['dailyDate'];}?>">
					</div>
					<div class="col-xs-8" id="weeklyDiv" style="<?php if(isset($_POST['weeklyDate']) && $_POST['seachType'] == 'weekly'){echo 'display:block';}else{echo 'display:none';} ?>">
					<input type="week" class="form-control" id="weeklyDate" name="weeklyDate" value="<?php if(isset($_POST['weeklyDate']) && $_POST['weeklyDate']!=''){echo $_POST['weeklyDate'];}?>">
					</div>
					<div class="col-xs-8" id="monthlyDiv" style="<?php if(isset($_POST['monthlyDate']) && $_POST['seachType'] == 'monthly'){echo 'display:block';}else{echo 'display:none';} ?>">
					<input type="month" class="form-control" id="monthlyDate" name="monthlyDate" value="<?php if(isset($_POST['monthlyDate']) && $_POST['monthlyDate']!=''){echo $_POST['monthlyDate'];}?>">
					</div>
					<div class="col-xs-8" id="quarterlyDiv" style="<?php if(isset($_POST['quarterlyDate2']) && $_POST['seachType'] == 'quarterly'){echo 'display:block';}else{echo 'display:none';} ?>">
						<div class="col-xs-6">
							<select class="form-control" id="quarterlyDate1" name="quarterlyDate1">
								<option selected disabled value >  </option>
								<option <?php if(isset($_POST['quarterlyDate1'])){if($_POST['quarterlyDate1'] == '1st quarter'){echo 'selected="selected"';}} ?> value="1st quarter" > 1st Quarter </option>
								<option <?php if(isset($_POST['quarterlyDate1'])){if($_POST['quarterlyDate1'] == '2nd quarter'){echo 'selected="selected"';}} ?> value="2nd quarter" > 2nd Quarter </option>
								<option <?php if(isset($_POST['quarterlyDate1'])){if($_POST['quarterlyDate1'] == '3rd quarter'){echo 'selected="selected"';}} ?> value="3rd quarter" > 3rd Quarter </option>
								<option <?php if(isset($_POST['quarterlyDate1'])){if($_POST['quarterlyDate1'] == '4th quarter'){echo 'selected="selected"';}} ?> value="4th quarter" > 4th Quarter </option>
							</select>
						</div>
						<div class="col-xs-6">
							<input class="form-control" type="number" id="quarterlyDate2" name="quarterlyDate2" min="2000" max="2099" step="1" value="<?php if(isset($_POST['quarterlyDate2']) && $_POST['quarterlyDate2']!=''){echo $_POST['quarterlyDate2'];}?>" />
						</div>
					</div>
					<div class="col-xs-8" id="annuallyDiv" style="<?php if(isset($_POST['yearlyDate']) && $_POST['seachType'] == 'annually'){echo 'display:block';}else{echo 'display:none';} ?>">
						<input class="form-control" type="number"  id="yearlyDate" name="yearlyDate" min="2000" max="2099" step="1" value="<?php if(isset($_POST['yearlyDate']) && $_POST['yearlyDate']!=''){echo $_POST['yearlyDate'];}?>" />
					</div>
					<div class="col-xs-4" id="searchButton" style="<?php if(isset($_POST['searchInventory'])){echo 'display:block';}else{echo 'display:none';}?>"> 
						<input class='btn btn-danger' type="submit" value="SEARCH INVENTORY" id="searchInventory" name="searchInventory" style="width:100%">
					</div>	
				</form>

				</div>
				<div class="col-xs-12" style="margin-top:50px">
				<table class="table table-hover" >
					<thead >
						<tr>
							<th>Date</th>
							<th>Category</th>
							<th>Staff Name</th>
							<th>Description</th>
							<th>Amount</th>
						</tr>
					</thead>
					<tbody>
						
						<?php
							if(isset($_POST['searchInventory'])){
								$sql = '';
								if($_POST['startdate']!='' && $_POST['enddate']!=''){
									$startdate = date("Y-m-d",strtotime($_POST['startdate']));
									$enddate = date("Y-m-d",strtotime($_POST['enddate']));
									$_SESSION['startdate1'] = $startdate;
									$_SESSION['enddate1'] = $enddate;
									$sql = "SELECT * FROM inventory WHERE date BETWEEN '$startdate' AND '$enddate'";
								}else if($_POST['dailyDate']!=''){
									$startdate = $_POST['dailyDate'];
									$_SESSION['daily'] = $startdate;
									$sql = "SELECT * FROM inventory WHERE date='$startdate'";								
								}else if($_POST['weeklyDate']!=''){
									$startdate = explode('-',$_POST['weeklyDate']);
									$year = $startdate[0];
									$str = $startdate[1];									
									$week = str_replace('W', '', $str);
									$date = date_create();
									date_isodate_set($date, $year, $week);
									$startDay = (date_format($date, 'Y-m-d'));
									$endDay = date('Y-m-d', strtotime("+6 day", strtotime($startDay)));
									$_SESSION['startDay'] = $startDay;
									$_SESSION['endDay'] = $endDay;
									$sql = "SELECT * FROM inventory WHERE date BETWEEN '$startDay' AND '$endDay' ";									
								}else if($_POST['monthlyDate']!=''){

									$startdate = explode('-',$_POST['monthlyDate']);
									$year = $startdate[0];
									$month = $startdate[1];
									$_SESSION['year'] = $year;
									$_SESSION['month'] = $month;								
									$sql = "SELECT * FROM inventory WHERE Year(date) = '$year' and Month(Date) = '$month'";
								}else if($_POST['quarterlyDate2']!='' && $_POST['quarterlyDate1']!=''){
									$date1 = '';
									$date2 = '';
									if($_POST['quarterlyDate1'] == '1st quarter'){
										$date1 = '01';
										$date2 = '03';
									}else if($_POST['quarterlyDate1'] == '2nd quarter'){
										$date1 = '04';
										$date2 = '06';
									}else if($_POST['quarterlyDate1'] == '3rd quarter'){
										$date1 = '07';
										$date2 = '09';
									}else if($_POST['quarterlyDate1'] == '4th quarter'){
										$date1 = '10';
										$date2 = '12';
									}
									$_SESSION['date1'] = $date1;
									$_SESSION['date2'] = $date2;
									$year = $_POST['quarterlyDate2'];
									$_SESSION['year'] = $year;
									$sql = "SELECT * FROM inventory WHERE Year(Date) = '$year' and Month(Date) BETWEEN '$date1' AND '$date2'";
								}else if($_POST['yearlyDate']!=''){
									
									$yearly = $_POST['yearlyDate'];
									$_SESSION['annual'] = $yearly;
									$sql = "SELECT * FROM inventory WHERE YEAR(date)='$yearly'";
								}
								
								if($sql!=''){
									$data= mysqli_query($connection,$sql);
									echo "
										<form action=\"generatepdf.php\" method=\"post\" target=\"_blank\">
											<input type=\"submit\" class=\"btn btn-danger\" name=\"print_pdf\" id=\"print_pdf\" value=\"PRINT\" style=\"width:200px;margin-left:250px;margin-bottom:0px\">		
										</form>";

									while($row = mysqli_fetch_array($data)){
										$date = date("M-d-Y",strtotime($row['date']));
										
										if($row['category'] == 'revenue'){
											$_SESSION['revenue'] = $_SESSION['revenue'] + $row['amount'];
										}else{
											$_SESSION['expenses'] = $_SESSION['expenses'] + $row['amount'];
										}
										
										echo "
											<tr>	
												<td>$date</td>
												<td>".$row['category']."</td>
												<td>".$row['staff_name']."</td>
												<td>".$row['label']."</td>
												<td>".$row['amount']."</td>
											</tr>
										";
									}
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
							<tr>
							<td>NET INCOME: </td>
							<td><?php echo ($_SESSION['revenue'] - $_SESSION['expenses']);?> pesos </td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
	
	<div class="modal fade" id="addInventory" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog" style="color:black">
			<div class="modal-content">
				<!-- Modal Header -->
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">
					   <span aria-hidden="true">&times;</span>
					   <span class="sr-only">Close</span>
					</button>
					<h4 class="modal-title" id="myModalLabel">
						Add Inventory
					</h4>
				</div>
				<div class="container" style="color:black">
					<div class="col-xs-6" style="padding:40px;">
						<form class="form-horizontal" name="buttonprofile" action="successUpdateInventory.php" method="post">
							
							<div class="col-xs-12" style="padding-bottom:20px">
								<label style="color:black">Revenue / Expenses:</label>
								<select id="category" name="category" class = "form-control" required>									
									<option selected value="expenses" > Expenses </option>
									<option value="revenue" > Revenue </option>									
								</select>
							</div>
							<div class="col-xs-12" style="padding-bottom:20px">
								<label style="color:black">Description</label>
								<input style="text-align:center" type="text" class="form-control" id='description' name="description" placeholder="description"  required>
							</div>
							<div class="col-xs-12">
								<label style="color:black">Amount</label>						
								<input style="text-align:center" type="number" step="any" class="form-control" id='amount' name="amount" min="0" placeholder="name"  required>
							</div>
							<div class="pull-right" style="padding:15px">
								<input class="btn btn-warning" type="submit" id="addInventory" name="addInventory" onclick="myFunction()">
							</div>
						</form>
						
						<?php
						if($_SESSION['addInventory'] == 1){
							$_SESSION['addInventory'] = 0;
							echo "<script> 
									document.getElementById('modal-body').innerHTML = '<b>Successfully added an item to the inventory.</b>';
									window.setTimeout(function() {
										$('#myModal').modal('show');
									},1000);
								  </script>";
						}
						?>
					</div>
				</div>
			</div>
		</div>
	</div>
	
	<div class="panel panel-primary" id="panel1" style=" margin-left: auto; margin-right: auto; width: 8in;background-color: #fdfdfd; margin-top:50px;height:auto;margin-bottom:100px">
        <div class="panel-heading" style="height:53px">
			<div style="float:left;margin-top:5px"> EDIT RATES </div> 
		</div>
		<div class="panel-body">
			<div class="form-group">
				<div class="col-xs-12" style="margin-top:10px;">
				<table class="table table-hover" style="margin-bottom:50px;padding:20px">
					<thead >
						<tr>
							<th>Current Promo / Rates</th>
							<th>Membership</th>
							<th>Amount</th>
						</tr>
					</thead>
					<tbody>
						<?php
							$sql = "SELECT * FROM promos WHERE 1";
							$data= mysqli_query($connection,$sql);

								while($row = mysqli_fetch_array($data)){
									if($row['membership'] == 'yes'){
										$membership = 'member';
									}else{
										$membership = 'non-member';
									}
									echo "
										<tr>	
											<td>".$row['promo_name']."</td>											
											<td>$membership</td>
											<td>".$row['value']."</td>
										</tr>
									";
								}								
						
						?>
					</tbody>
				</table>
				<form action="successEditRates.php" method="post">
				<div class="col-xs-4" style="padding-bottom:20px">
								<label style="color:black">Choose promo:</label>
								<select name="promos" id="promos" class = "form-control" required onchange="checkMem()">
									<option selected disabled value >  </option>
									<option value="monthly" > Monthly </option>
									<option value="student monthly" > Student Monthly </option>
									<option value="12 sessions" > 12 sessions </option>
									<option value="8 sessions" > 8 sessions </option>
									<option value="Regular" > Regular </option>
									<option value="membership_fee" > Membership Fee </option>
								</select>
								
							</div>
							<div class="col-xs-4" style="padding-bottom:20px">
							<label style="color:black">Member/Non member:</label>
								<select name="membership" id="membership" class = "form-control" required>
									<option selected disabled value >  </option>
									<option value="yes" > Member </option>
									<option value="no" > Non member </option>
								</select>
							</div>
							<div class="col-xs-4" style="padding-bottom:20px">
								<label style="color:black">New value:</label>
								<input type="number" name="value" id="value" value="" class = "form-control" min="0" required>
							</div>
							<div class="col-xs-12" style="padding-bottom:20px">
								<input class="btn btn-danger" type="submit" name="editrates" id="editrates" value="SUBMIT" style="width:200px;margin-left:240px">
								<label style="color:black"></label>
							</div>
					</form>
					
					<?php
						if($_SESSION['successEditRates'] == 1){
							echo "<script> 
								document.getElementById('modal-body').innerHTML = '<b>Successfully updated the promos.</b>';
								window.setTimeout(function() {
									$('#myModal').modal('show');
								},1000);
							 </script>";
						
						}
					
					?>
			</div>
		</div>
	</div>
	
	
	 <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
	<script src="http://yui.yahooapis.com/3.18.1/build/yui/yui-min.js"></script>


<script>

function checkMem(){
	if(document.getElementById('promos').value == 'membership_fee'){
	document.getElementById('membership').disabled = true;
	}else{
	document.getElementById('membership').disabled = false;
	}


}

function getSearchValue(){
		document.getElementById('searchButton').style.display = 'block';
		document.getElementById('startdate').value = "";
		document.getElementById('enddate').value  = "";
		document.getElementById('dailyDate').value  = "";
		document.getElementById('weeklyDate').value  = "";
		document.getElementById('monthlyDate').value  = "";
		document.getElementById('quarterlyDate1').value  = "";
		document.getElementById('quarterlyDate2').value  = "";
		document.getElementById('yearlyDate').value  = "";
		
	if(document.getElementById('seachType').value == 'daily'){
		document.getElementById('dailyDiv').style.display = 'block';
		document.getElementById('weeklyDiv').style.display = 'none';
		document.getElementById('monthlyDiv').style.display = 'none';
		document.getElementById('quarterlyDiv').style.display = 'none';
		document.getElementById('annuallyDiv').style.display = 'none';
		document.getElementById('manualDiv').style.display = 'none';
		
		document.getElementById('head1').style.display = 'none';
		document.getElementById('head2').style.display = 'block';
		document.getElementById('head3').style.display = 'none';
		document.getElementById('head4').style.display = 'none';
		document.getElementById('head5').style.display = 'none';
		document.getElementById('head6').style.display = 'none';
	}else if(document.getElementById('seachType').value == 'weekly'){
		document.getElementById('dailyDiv').style.display = 'none';
		document.getElementById('weeklyDiv').style.display = 'block';
		document.getElementById('monthlyDiv').style.display = 'none';
		document.getElementById('quarterlyDiv').style.display = 'none';
		document.getElementById('annuallyDiv').style.display = 'none';
		document.getElementById('manualDiv').style.display = 'none';
		
		document.getElementById('head1').style.display = 'none';
		document.getElementById('head2').style.display = 'none';
		document.getElementById('head3').style.display = 'block';
		document.getElementById('head4').style.display = 'none';
		document.getElementById('head5').style.display = 'none';
		document.getElementById('head6').style.display = 'none';
	}else if(document.getElementById('seachType').value == 'monthly'){
		document.getElementById('dailyDiv').style.display = 'none';
		document.getElementById('weeklyDiv').style.display = 'none';
		document.getElementById('monthlyDiv').style.display = 'block';
		document.getElementById('quarterlyDiv').style.display = 'none';
		document.getElementById('annuallyDiv').style.display = 'none';
		document.getElementById('manualDiv').style.display = 'none';
		
		document.getElementById('head1').style.display = 'none';
		document.getElementById('head2').style.display = 'none';
		document.getElementById('head3').style.display = 'none';
		document.getElementById('head4').style.display = 'block';
		document.getElementById('head5').style.display = 'none';
		document.getElementById('head6').style.display = 'none';
	}else if(document.getElementById('seachType').value == 'quarterly'){
		document.getElementById('dailyDiv').style.display = 'none';
		document.getElementById('weeklyDiv').style.display = 'none';
		document.getElementById('monthlyDiv').style.display = 'none';
		document.getElementById('quarterlyDiv').style.display = 'block';
		document.getElementById('annuallyDiv').style.display = 'none';
		document.getElementById('manualDiv').style.display = 'none';
		
		document.getElementById('head1').style.display = 'none';
		document.getElementById('head2').style.display = 'none';
		document.getElementById('head3').style.display = 'none';
		document.getElementById('head4').style.display = 'none';
		document.getElementById('head5').style.display = 'block';
		document.getElementById('head6').style.display = 'none';
	}else if(document.getElementById('seachType').value == 'annually'){
		document.getElementById('dailyDiv').style.display = 'none';
		document.getElementById('weeklyDiv').style.display = 'none';
		document.getElementById('monthlyDiv').style.display = 'none';
		document.getElementById('quarterlyDiv').style.display = 'none';
		document.getElementById('annuallyDiv').style.display = 'block';
		document.getElementById('manualDiv').style.display = 'none';
		
		document.getElementById('head1').style.display = 'none';
		document.getElementById('head2').style.display = 'none';
		document.getElementById('head3').style.display = 'none';
		document.getElementById('head4').style.display = 'none';
		document.getElementById('head5').style.display = 'none';
		document.getElementById('head6').style.display = 'block';
	}else if(document.getElementById('seachType').value == 'manually'){
		document.getElementById('dailyDiv').style.display = 'none';
		document.getElementById('weeklyDiv').style.display = 'none';
		document.getElementById('monthlyDiv').style.display = 'none';
		document.getElementById('quarterlyDiv').style.display = 'none';
		document.getElementById('annuallyDiv').style.display = 'none';
		document.getElementById('manualDiv').style.display = 'block';
		
		document.getElementById('head1').style.display = 'block';
		document.getElementById('head2').style.display = 'none';
		document.getElementById('head3').style.display = 'none';
		document.getElementById('head4').style.display = 'none';
		document.getElementById('head5').style.display = 'none';
		document.getElementById('head6').style.display = 'none';
		
	}


}

</script>

</body>

</html>