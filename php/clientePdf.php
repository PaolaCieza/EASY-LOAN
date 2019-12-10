<?php
define('FPDF_FONTPATH','font/');
require_once "fpdf.php";

require_once "conexion.php";
$cliente = $_GET["cliente"];
$sql="select * from cliente where = $cliente";
$result = $cnx->query($sql);

$pdf=new FPDF();

$pdf->AddPage(); 
$pdf->SetFont('Arial','B',16);
$pdf->Cell(180,10,'Catalogo de libros',0,1,'C');
$pdf->Ln();
$pdf->Ln();
$pdf->SetFont('Arial','B',10);
$pdf->Cell(10,6,"Id",1);
$pdf->Cell(80,6,"Titutlo",1);
$pdf->Cell(40,6,"Autor",1);
$pdf->Cell(40,6,"Portada",1);
$pdf->Ln();
$pdf->SetFont('Arial','',10);
while($registro=$result->fetchObject())
{
	$pdf->Cell(10,50,$registro->id,0);
	$pdf->Cell(80,50,$registro->titulo,0);
	$pdf->Cell(40,50,$registro->autor,0);
	$imagen = "$registro->foto";
	$pdf->Cell(40,50,$pdf->Image("$imagen", $pdf->GetX(), $pdf->GetY(),30,'','',"$registro->link"),0);
	//$pdf->Cell(40,5,$registro->foto,0);
	$pdf->Ln();
}
$pdf->Output();
?>