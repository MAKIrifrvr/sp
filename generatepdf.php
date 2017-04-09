<?php
	session_start();	
	require('fpdf/fpdf.php');
	$connection = mysqli_connect("localhost", "root", "","red_gloves"); // Establishing Connection with Server
if(mysqli_connect_error()) echo "Connection Fail";

if(isset($_POST['print_pdf'])){
	$pdf = new FPDF('P', 'pt', 'Letter');
	$pdf->SetTitle("Inventory Form For Red Gloves Boxing Gym"); 

	$startdate = $_SESSION['startdate'];
	$enddate = $_SESSION['enddate'];
	$sql = "SELECT * FROM inventory WHERE category='revenue' AND date BETWEEN '$startdate' AND '$enddate'";
	$data= mysqli_query($connection,$sql);

	$pdf->AddPage();
	//$pdf->SetFillColor(239, 75, 38);
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
	$sql = "SELECT * FROM inventory WHERE category='expenses' AND date BETWEEN '$startdate' AND '$enddate'";
	$data= mysqli_query($connection,$sql);	
	$pdf->Cell(450,25,'EXPENSES','LTR',1,'C',0);
	
	$pdf->SetFont('Arial','',11);
	$pdf->Cell(100,20,'DATE',1,0,'C',0);
	$pdf->Cell(250,20,'DESCRIPTION',1,0,'C',0);
	$pdf->Cell(100,20,'AMOUNT',1,1,'C',0);
	$pdf->SetFont('Arial','',8.5);
	$totalExpenses = 0;
	while($row = mysqli_fetch_array($data)){ 
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

	$pdf->Output("inventory.pdf", "I");
}else{
	header("Location:adminInventory.php");
	exit;

}
?>

<!-- PDF Generator used: FPDF (http://www.fpdf.org/) -->