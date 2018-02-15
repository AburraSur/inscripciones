<?php

 require('./fpdf17/fpdf.php');
 require("../class.conexion.php");



$db = new conn();

$ideve = $_GET['ideve'];
$idasis = $_GET['idasis'];

$sqleve = $db->consulta("select * from evento where idevento=$ideve ");
$roweve = $db->fetch_array($sqleve);

$headerC = utf8_decode('CÁMARA DE COMERCIO ABURRÁ SUR');
		$jump = '';
		
		$id2 = number_format($idasis,0,'','.');
		$id = utf8_decode("Identificación: $id2");
		$txtcertifica = utf8_decode("$roweve[var_certi]");
		
if ( $_GET['tp'] == 1 ){
	$sqlasis = $db->consulta("select a.cedula,a.nombres,a.apellidos,a.email from asistentes a inner join event_asist ea where a.cedula=ea.cedula and ea.idevent=$ideve and ea.cedula='$idasis' ");
}else{
	$sqlasis = $db->consulta("select a.cedula,a.nombres,a.apellidos,a.email from asistentes a inner join mod_asis ma where a.cedula=ma.cedula and ma.idmod=$idmod  and ma.idevento=$ideve and ma.cedula='$idasis' ");
}
$rowasis = $db->fetch_array($sqlasis);
$asistente ="$rowasis[nombres] $rowasis[apellidos]";
		$a = strlen($asistente);
 

        $pdf = new PDF();             //Crea objeto PDF
        $pdf->AddPage('L', 'Letter'); //Vertical, Carta
 
        /*$pdf->SetFont('Arial','B',12); //Arial, negrita, 12 puntos
        $pdf->Cell(0,10,$fecha,0,1,'R'); //Agrega la cadena $fecha*/
		
		$pdf->SetFont('Arial','B',24);
		
		$pdf->Cell(0,18,$jump,0,0,'C');
		$pdf->Ln();$pdf->Ln();
		$pdf->Cell(0,18,$headerC,0,0,'C');
		$pdf->SetFont('Arial','B',14);
		$pdf->Ln(10);
		$pdf->Cell(0,18,'Certifica que:',0,0,'C');
		$pdf->Ln(14);
        /* Se hace un salto de línea
         * y se manda llamar el método de imprimir texto,
         * envíando como parámetro el nombre del archivo
         * que contiene el texto.
        * */
		if( $a > 30 ){
			$pdf->SetFont('Arial','B',18);
		}else{
			$pdf->SetFont('Arial','B',24);
		}
		$pdf->Cell(0,18,$asistente,0,0,'C');
		$pdf->Ln(14);
		$pdf->SetFont('Arial','B',24);
		$pdf->Cell(0,18,$id,0,0,'C');
		$filex = "$roweve[var_certi]";
        $pdf->Ln();
        //$pdf->ImprimirTexto($filex);
		$pdf->SetFont('Arial','B',12);
		$pdf->MultiCell(0,5,$filex);
		$pdf->Ln();
		$pdf->Image('../img/firma.jpg',30,150,230);
        $pdf->Output();               //Salida al navegador
 
?>