<?php

require_once("../../class.conexion.php");
require_once('tcpdf_include.php');


$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);
$pdf->SetMargins(25, 10, 25, true);

$db = new conn();
$ideve = $_GET['ideve'];
$idasis = $_GET['idasis'];

$sqleve = $db->consulta("select * from evento where idevento=$ideve ");
$roweve = $db->fetch_array($sqleve);

if ( $_GET['tp'] == 1 ){
	$sqlasis = $db->consulta("select a.cedula,a.nombres,a.apellidos,a.email from asistentes a inner join event_asist ea where a.cedula=ea.cedula and ea.idevent=$ideve and ea.cedula='$idasis' ");
}else{
	$sqlasis = $db->consulta("select a.cedula,a.nombres,a.apellidos,a.email from asistentes a inner join mod_asis ma where a.cedula=ma.cedula and ma.idmod=$idmod  and ma.idevento=$ideve and ma.cedula='$idasis' ");
}
$rowasis = $db->fetch_array($sqlasis);


$defau = array(
				'shadeCol'=>array(0.9,0.9,0.9),
				'xOrientation'=>'center',
				'justification'=>'center',
				'width'=>98
			);	

			$arrf = array ("01" => "Enero" ,"02" => "Febrero" ,"03" => "Marzo" ,"04" => "Abril" ,"05" => "Mayo" ,"06" => "Junio" ,"07" => "Julio" ,"08" => "Agosto" ,"09" => "Septiembre" ,"10" => "Octubre" ,"11" => "Noviembre" ,"12" => "Diciembre" );
			
			$fec = explode("-",$roweve[fec_event]);
			$mes = $arrf[$fec[1]];
	
$titulo = "CÁMARA DE COMERCIO ABURRÁ SUR";
$cert = "Certifica que:";
$asistent = "$rowasis[nombres] $rowasis[apellidos]";
$asistente = utf8_encode($asistent);
$id2 = number_format($_GET['idasis'],0,'','.');
$id = "Identificación: $id2";
//$id = "Identificación:";
// $dia = ($fec[2]+1); //dia adicional para fecha compuesta
//$fechaeve = "$fec[2] y $dia de $mes del $fec[0]"; //fecha compuesta
$fechaeve = "$fec[2] de $mes del $fec[0]"; 
//$fechaevefoot = "Itagüí - Colombia, $mes $dia de $fec[0]"; //fecha footer compuesta
$fechaevefoot = "Itagüí - Colombia, $mes $fec[2] de $fec[0]"; 

$a = strlen($asistente);

$nombree = utf8_encode($roweve[nom_evento]);
$certi =  utf8_encode($roweve[var_certi]);

//$cotiza[] = array( 'titulo'=>'Responsable Cotización: '.$rowres[nombre], 'numero'=>' ');
//$txtcertifica = "Participó en el $nombree realizado los días $fechaeve, $certi ";
$txtcertifica = "Participó en el $nombree realizado el día $fechaeve, con una duración de 4 horas, que incluyó temas como: $certi ";
//$txtcertifica[] = array( 'titulo'=>"Participó en el $roweve[nom_evento] realizado el día $fechaeve, $roweve[var_certi]");
$titlecot = array('titulo'=>'');
$optioncot= array('shaded'=>0,'showLines'=>0,'xOrientation'=>'center','justification'=>'justify','width'=>600);
//$txtcertifica = "$roweve[var_certi]";
$firma = "\n\n\n__________________________________\nLILLYAM MESA ARANGO\nPresidenta Ejecutiva\nCámara de Comercio Aburrá Sur";
$img = "../img/FIRMAS105.jpg";

$pdf->AddPage('L');

// set font
$pdf->SetFont('helvetica', 'B', 26);
$pdf->Ln(30);
$pdf->Write(0, $titulo, '', 0, 'C', true, 0, false, false, 0);
$pdf->Ln(10);
$pdf->SetFont('helvetica', 'B', 14);
$pdf->Write(0, $cert, '', 0, 'C', true, 0, false, false, 0);
$pdf->Ln(2);
$pdf->SetFont('helvetica', 'B', 20);
$pdf->Write(0, $asistente, '', 0, 'C', true, 0, false, false, 0);
$pdf->Ln(2);
$pdf->SetFont('helvetica', 'B', 16);
$pdf->Write(0, $id, '', 0, 'C', true, 0, false, false, 0);
$pdf->Ln(8);//borrar al poner id normal
// create some HTML content
$html = '<p><span style="text-align:justify;">'.$txtcertifica.'</span></p>';
//$pdf->Ln(4);
// set core font
$pdf->SetFont('helvetica', 'B', 14);
//$pdf->SetFont('helvetica', 'B', 12);

// output the HTML content
$pdf->writeHTML($html, true, 0, true, true);
$pdf->Ln(10);
$img = '<span style="text-align:justify;"><img src="../../img/firmaml.jpg" /></span>';
$pdf->writeHTML($img, true,0, true, true);

$pdf->SetFont('helvetica', 'I', 10);
$pdf->Write(0,$fechaevefoot, '', 0, 'C', true, 0, false, false, 0);
// reset pointer to the last page
$pdf->lastPage();

// ---------------------------------------------------------
ob_end_clean();
//Close and output PDF document
$pdf->Output('example_039.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+
