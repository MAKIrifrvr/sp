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
            				  <li ><a href="staffProfile.php" style="color:white">Profile</a></li>
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
	
	<div class="panel panel-primary" id="panel1" style=" margin-left: auto; margin-right: auto; width: 8in;background-color: #fdfdfd; margin-top:150px;height:auto">
        <div class="panel-heading" style="height:53px">
			<div style="float:left;margin-top:5px"> INVENTORY </div>
			<div class="pull-right">
				<button class="btn btn-danger" data-toggle="modal" data-target="#addInventory">Add New Inventory</button>		
			</div>
		</div>
		<div class="panel-body">
			<div class="form-group">
				<div class="col-xs-12" style="text-align:center;font-size: 16px;font-family: 'Roboto', sans-serif;font-weight: 600;">
					<div class="col-xs-4">
					START DATE
					</div>
					<div class="col-xs-4">
					END DATE
					</div>	
				</div>
				<div class="col-xs-12">
				<form action="" method="post">
					<div class="col-xs-4">
					<input type="date" class="form-control" id="startdate" name="startdate"  value="<?php echo isset($_POST['startdate']) ? $_POST['startdate'] : '' ?>">
					</div>
					<div class="col-xs-4">
					<input type="date" class="form-control"  id="enddate" name="enddate"  value="<?php echo isset($_POST['enddate']) ? $_POST['enddate'] : '' ?>">
					</div>					
					<div class="col-xs-4">
						<input class='btn btn-danger' type="submit" value="SEARCH INVENTORY" id="searchInventory" name="searchInventory" style="width:100%">
					</div>
	<!--			<div class="col-xs-12" style="margin-top:20px;text-align:center;font-size: 16px;font-family: 'Roboto', sans-serif;font-weight: 600;">
					<div class="col-xs-12">
					or
					</div>	
				</div>
				<div class="col-xs-12" style="text-align:center;font-size: 16px;font-family: 'Roboto', sans-serif;font-weight: 600;">
					<div class="col-xs-4">
					DATE RANGE
					</div>
					<div class="col-xs-4">
					YEAR
					</div>	
				</div>
					<div class="col-xs-4">
						<select class="form-control" id="sel1">
							<option>1st Quarter</option>
							<option>2nd Quarter</option>
							<option>3rd Quarter</option>
							<option>4th Quarter</option>
							<option>1st Semi-Annual</option>
							<option>2nd Semi-Annual</option>
							<option>Annual</option>
						</select>
					</div>
					<div class="col-xs-4">
						<input type="text" class="form-control" id="inventoryyear" name="inventoryyear">
					</div>
					<div class="col-xs-4">
						<input class='btn btn-danger' type="submit" value="SEARCH INVENTORY" id="searchInventory" name="searchInventory" style="width:100%">
					</div> -->
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
							if(isset($_POST['searchInventory'])  && $_POST['startdate']!='' && $_POST['enddate']!=''){
								$_SESSION['startdate'] = $_POST['startdate'];
								$_SESSION['enddate'] = $_POST['enddate'];
								$startdate = date("Y-m-d",strtotime($_POST['startdate']));
								$enddate = date("Y-m-d",strtotime($_POST['enddate']));
								$sql = "SELECT * FROM inventory WHERE date BETWEEN '$startdate' AND '$enddate'";
								$data= mysqli_query($connection,$sql);
								
								echo "
									<form action=\"generatepdf.php\" method=\"post\" target=\"_blank\">
										<input type=\"submit\" class=\"btn btn-danger\" name=\"print_pdf\" id=\"print_pdf\" value=\"PRINT\" style=\"width:200px;margin-left:250px;margin-bottom:0px\">		
									</form>";

								while($row = mysqli_fetch_array($data)){
									$date = date("M-d-Y",strtotime($row['date']));
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
						?>
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
								<select name="category" class = "form-control" required>									
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
								<input class="btn btn-warning" type="submit" id="addInventory" name="addInventory">
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
	
	<div class="panel panel-primary" id="panel1" style=" margin-left: auto; margin-right: auto; width: 8in;background-color: #fdfdfd; margin-top:50px;height:auto;">
        <div class="panel-heading" style="height:53px">
			<div style="float:left;margin-top:5px"> CALENDAR </div> 
		</div>
		<div class="panel-body">
			<div class="form-group yui3-skin-sam yui3-g">
				<div class="col-xs-12">
					<div class="col-xs-6 yui3-u">
						 <!-- Container for the calendar -->
						 <div id="mycalendar" class="yui3-skin-sam"></div>
					</div>
					<div class="col-xs-6 yui3-u">
					   <div id="links" style="padding-left:20px;">
							<form name="myForm" id="myForm" method="post">
								<input type="text" id="selecteddate" name="selecteddate" style="display:none"> 
								<input type="button" id="luh" onclick="SubmitFormData()" style="display:none">	
							</form>						
					   </div>
					   
						<div id="maki" style="padding:10px;margin-left:20pxfont-size: 16px;font-family: 'Roboto', sans-serif;font-weight: 600;">
							<!--<div class='col-xs-12' style="padding-left:50px">STATISTICS</div>
							<div class='col-xs-6'>Attendance:</div><div class='col-xs-6'>0</div>
							<div class='col-xs-6'>Revenue:</div><div class='col-xs-6'>0</div>
							<div class='col-xs-6'>Expenses:</div><div class='col-xs-6'>0</div>-->
							<div class='col-xs-12' style="padding-left:100px;margin-top:40px;margin-bottom:10px">STATISTICS</div>
							<table class="table table-hover">
						
								<tbody>
									<tr>
									<td>ATTENDANCE:</td><td>0</td>
									</tr>
									<tr>
									<td>REVENUE:</td><td>0</td>
									</tr>
									<tr>
									<td>EXPENSES:</td><td>0</td>
									</tr>
								</TBODY>
							</table>
						</div>
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
				<form action="successEditRates.php" method="post">
				<div class="col-xs-4" style="padding-bottom:20px">
								<label style="color:black">Choose promo:</label>
								<select name="promos" class = "form-control" required>
									<option selected disabled value >  </option>
									<option value="monthly" > Monthly </option>
									<option value="student monthly" > Student Monthly </option>
									<option value="12 sessions" > 12 sessions </option>
									<option value="8 sessions" > 8 sessions </option>
									<option value="Regular" > Regular </option>
								</select>
								
							</div>
							<div class="col-xs-4" style="padding-bottom:20px">
							<label style="color:black">Member/Non member:</label>
								<select name="membership" class = "form-control" required>
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
								<input class="btn btn-danger" type="submit" name="editrates" id="editrates" value="SUBMIT" style="width:200px;margin-left:250px">
								<label style="color:black"></label>
							</div>
					</form>
			</div>
		</div>
	</div>
	
	
	 <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
	<script src="http://yui.yahooapis.com/3.18.1/build/yui/yui-min.js"></script>
	<script type="text/javascript">



YUI().use('calendar', 'datatype-date', 'cssbutton',  function(Y) {

     var calendar = new Y.Calendar({
      contentBox: "#mycalendar",
      width:'340px',
      showPrevMonth: true,
      showNextMonth: true,
      date: new Date()}).render();

    // Get a reference to Y.DataType.Date
    var dtdate = Y.DataType.Date;

    // Listen to calendar's selectionChange event.
    calendar.on("selectionChange", function (ev) {
      var newDate = ev.newSelection[0];
	  document.getElementById('selecteddate').value = dtdate.format(newDate); 
	  document.getElementById('luh').click();
    });
});

</script>

<script>
function SubmitFormData() {
    var name = document.getElementById('selecteddate').value;
    $.post("getValue.php", { name: name},
	function(data) {
	 $('#maki').html(data);
	 $('#myForm')[0].reset();
    });
}
</script>

</body>

</html>