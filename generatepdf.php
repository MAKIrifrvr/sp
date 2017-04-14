<?php
	session_start();	
	require('fpdf/fpdf.php');
	$connection = mysqli_connect("localhost", "root", "","red_gloves"); // Establishing Connection with Server
if(mysqli_connect_error()) echo "Connection Fail";
	date_default_timezone_set("Asia/Manila");
	$sql = '';
	$sql1 = '';
if(isset($_POST['print_pdf'])){
	$pdf = new FPDF('P', 'pt', 'Letter');
	$pdf->SetTitle("Inventory Form For Red Gloves Boxing Gym"); 
	
	if($_SESSION['startdate1']!='' && $_SESSION['enddate1']!=''){
		$startdate = $_SESSION['startdate1'];
		$enddate = $_SESSION['enddate1'];
		$_SESSION['startdate1'] = '';
		$_SESSION['enddate1'] = '';
		$sql = "SELECT * FROM inventory WHERE category='revenue' AND date BETWEEN '$startdate' AND '$enddate'";
		$sql1 = "SELECT * FROM inventory WHERE category='expenses' AND date BETWEEN '$startdate' AND '$enddate'";
		$startdate = date("M-d-Y",strtotime($startdate));
		$enddate = date("M-d-Y",strtotime($enddate));
		$fileName = "inventory from $startdate to $enddate.pdf";
	}else if($_SESSION['daily']!=''){	
		$startdate = $_SESSION['daily'];
		$_SESSION['daily'] = '';
		$sql = "SELECT * FROM inventory WHERE category='revenue' AND date='$startdate'";	
		$sql1 = "SELECT * FROM inventory WHERE category='expenses' AND date='$startdate'";
		$startdate = date("M-d-Y",strtotime($startdate));
		$fileName = "inventory for $startdate.pdf";
	}else if($_SESSION['startDay']!='' && $_SESSION['endDay']!=''){
		$startdate = $_SESSION['startDay'];
		$enddate = $_SESSION['endDay'];
		$_SESSION['startDay'] = '';
		$_SESSION['endDay'] = '';
		$sql = "SELECT * FROM inventory WHERE category='revenue' AND date BETWEEN '$startdate' AND '$enddate'";
		$sql1 = "SELECT * FROM inventory WHERE category='expenses' AND date BETWEEN '$startdate' AND '$enddate'";
		$startdate = date("M-d-Y",strtotime($startdate));
		$enddate = date("M-d-Y",strtotime($enddate));
		$fileName = "inventory from $startdate to $enddate.pdf";
	}else if($_SESSION['year']!='' && $_SESSION['month']!=''){
		$year = $_SESSION['year'];
		$month = $_SESSION['month'];
		$_SESSION['year'] = '';
		$_SESSION['month'] = '';
		$sql = "SELECT * FROM inventory WHERE category='revenue' AND Year(date) = '$year' AND Month(Date) = '$month'";
		$sql1 = "SELECT * FROM inventory WHERE category='expenses' AND Year(date) = '$year' AND Month(Date) = '$month'";
		$monthName = date('F', mktime(0, 0, 0, $month, 10));
		$fileName = "inventory for the month of $monthName,$year.pdf";
	}else if($_SESSION['date1']!='' && $_SESSION['date2']!='' && $_SESSION['year']!=''){
		$year = $_SESSION['year'];
		$date1 = $_SESSION['date1'];
		$date2 = $_SESSION['date2'];
		$_SESSION['year'] = '';
		$_SESSION['date1'] = '';
		$_SESSION['date2'] = '';
		$sql = "SELECT * FROM inventory WHERE category='revenue' AND Year(Date) = '$year' and Month(Date) BETWEEN '$date1' AND '$date2'";
		$sql1 = "SELECT * FROM inventory WHERE category='expenses' AND Year(Date) = '$year' and Month(Date) BETWEEN '$date1' AND '$date2'";
		$month1 = date('F', mktime(0, 0, 0, $date1, 10));
		$month2 = date('F', mktime(0, 0, 0, $date2, 10));
		$fileName = "inventory for $month1 - $month2, $year.pdf";
	}else if($_SESSION['annual']!=''){	
		$startdate = $_SESSION['annual'];
		$_SESSION['annual']!='';
		$sql = "SELECT * FROM inventory WHERE category='revenue' AND YEAR(date)='$startdate'";	
		$sql1 = "SELECT * FROM inventory WHERE category='expenses' AND YEAR(date)='$startdate'";
		$fileName = "inventory for $startdate.pdf";
	}
	
	if($sql!='' && $sql1!=''){
		$data= mysqli_query($connection,$sql);
		$pdf->AddPage();
		$pdf->SetFont('Arial','',14);
		$pdf->Cell(450,25,'REVENUE','LTR',1,'C',0);
		
		$pdf->SetFont('Arial','',11);
		$pdf->Cell(100,20,'DATE',1,0,'C',0);
		$pdf->Cell(250,20,'DESCRIPTION',1,0,'C',0);
		$pdf->Cell(100,20,'AMOUNT',1,1,'C',0);
		$pdf->SetFont('Arial','',8.5);
		$totalRevenue = 0;
		while($row = mysqli_fetch_array($data)){ 
			$timestamp = strtotime($row['date']);
			$printDate = date('M-d-Y', $timestamp);	
			$pdf->Cell(100,15,$printDate,'LBR',0,'C',0);
			$pdf->Cell(250,15,$row['label'],'LBR',0,'C',0);
			$pdf->Cell(100,15,$row['amount'],'LBR',1,'C',0);
			$totalRevenue = $totalRevenue + $row['amount'];
		}
		$pdf->SetFont('Arial','',14);
		$pdf->Cell(350,20,'TOTAL',1,0,'R',0);
		$pdf->Cell(100,20,'P '.$totalRevenue,1,1,'C',0);
		//
			$pdf->Cell(450,50,'','',1,'C',0);
		//
		
		$data1= mysqli_query($connection,$sql1);	
		$pdf->Cell(450,25,'EXPENSES','LTR',1,'C',0);
		
		$pdf->SetFont('Arial','',11);
		$pdf->Cell(100,20,'DATE',1,0,'C',0);
		$pdf->Cell(250,20,'DESCRIPTION',1,0,'C',0);
		$pdf->Cell(100,20,'AMOUNT',1,1,'C',0);
		$pdf->SetFont('Arial','',8.5);
		$totalExpenses = 0;
		while($row = mysqli_fetch_array($data1)){ 
			$timestamp = strtotime($row['date']);
			$printDate = date('M-d-Y', $timestamp);	
			$pdf->Cell(100,15,$printDate,'LBR',0,'C',0);
			$pdf->Cell(250,15,$row['label'],'LBR',0,'C',0);
			$pdf->Cell(100,15,$row['amount'],'LBR',1,'C',0);
			$totalExpenses = $totalExpenses + $row['amount'];
		}
		$pdf->SetFont('Arial','',14);
		$pdf->Cell(350,20,'TOTAL',1,0,'R',0);
		$pdf->Cell(100,20,'P '.$totalExpenses,1,1,'C',0);	
		//
			$pdf->Cell(450,50,'','',1,'C',0);
		//		
		$pdf->Cell(450,25,'SUMMARY','LTR',1,'C',0);
		$pdf->SetFont('Arial','',11);
		$pdf->Cell(300,20,'Gross Income:',1,0,'C',0);
		$pdf->Cell(150,20,$totalRevenue,1,1,'C',0);
		$pdf->Cell(300,20,'Total Expenses:',1,0,'C',0);
		$pdf->Cell(150,20,$totalExpenses,1,1,'C',0);	
		$pdf->Cell(300,20,'Net Income:',1,0,'C',0);
		$pdf->Cell(150,20,$totalRevenue - $totalExpenses,1,1,'C',0);	
		
		
		$pdf->Output("$fileName", "I");
	}else{
		echo 'luh';
	}
}else{
	header("Location:adminInventory.php");
	exit;

}
?>

<!-- PDF Generator used: FPDF (http://www.fpdf.org/) -->