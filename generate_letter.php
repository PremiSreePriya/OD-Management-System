<?php
require('fpdf.php');
include('db.php');

if (!isset($_GET['id'])) {
    die("Invalid request.");
}

$id = intval($_GET['id']);
$result = $conn->query("SELECT * FROM od_requests WHERE id = $id AND status = 'Approved'");

if ($result->num_rows === 0) {
    die("Access denied or record not found.");
}

$row = $result->fetch_assoc();

// Create PDF
$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial','B',16);
$pdf->Cell(0,10,'OD Approval Letter',0,1,'C');
$pdf->Ln(10);

$pdf->SetFont('Arial','',12);
$pdf->Cell(0,10,'Name: ' . $row['name'],0,1);
$pdf->Cell(0,10,'Register No: ' . $row['reg_no'],0,1);
$pdf->Cell(0,10,'Department: ' . $row['department'],0,1);
$pdf->Cell(0,10,'From: ' . $row['from_date'],0,1);
$pdf->Cell(0,10,'To: ' . $row['to_date'],0,1);
$pdf->Cell(0,10,'Reason: ' . $row['reason'],0,1);
$pdf->Cell(0,10,'Status: Approved',0,1);
$pdf->Cell(0,10,'Approved by: College Admin',0,1);

// Send PDF to browser for download
$pdf->Output('D', 'OD_Letter_' . $row['reg_no'] . '.pdf');
exit();
?>
