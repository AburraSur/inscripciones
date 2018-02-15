<?php
ob_start();
require_once('class.ezpdf.php');
require("../class.conexion.php");

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

$pdf =& new Cezpdf('LETTER','landscape');
$pdf->selectFont('fonts/Helvetica-Bold.afm');
$pdf->ezSetCmMargins(5,0,2,2);

$defau = array(
				'shadeCol'=>array(0.9,0.9,0.9),
				'xOrientation'=>'center',
				'justification'=>'center',
				'width'=>98
			);
			
$fech = array(
				'shadeCol'=>array(0.9,0.9,0.9),
				'xOrientation'=>'left',
				'justification'=>'left',
				'width'=>98
			);	

			$arrf = array ("01" => "Enero" ,"02" => "Febrero" ,"03" => "Marzo" ,"04" => "Abril" ,"05" => "Mayo" ,"06" => "Junio" ,"07" => "Julio" ,"08" => "Agosto" ,"09" => "Septiembre" ,"10" => "Octubre" ,"11" => "Noviembre" ,"12" => "Diciembre" );
			
			$fec = explode("-",$roweve[fec_event]);
			$mes = $arrf[$fec[1]];
	
$titulo = "CÁMARA DE COMERCIO ABURRÁ SUR";
$cert = "Certifica que:";
$asistente = "$rowasis[nombres] $rowasis[apellidos]";
$id2 = number_format($_GET['idasis'],0,'','.');
$id = "Identificación: $id2";
$fechaeve = "$fec[2] de $mes del $fec[0]";
$fechae = "Medellín, Colombia, $fechaeve";


$a = strlen($asistente);





$txtcertifica = "Participó activamente en el Programa $roweve[nom_evento] $roweve[var_certi]";
$firma = "\n\n\n__________________________________\nLILLYAM MESA ARANGO\nPresidenta Ejecutiva\nCámara de Comercio Aburrá Sur";
$img = "../img/firma.jpg";
$img2 = "../img/bancoldexh.jpg";
$img3 = "../img/bancoldex.jpg";

$pdf->ezImage($img2, 0, 700, 'none', 'left' );
//$pdf->ezText($titulo,24,$defau);
$pdf->ezText("\n", 4);
$pdf->ezText($cert,18,$defau);
//$pdf->ezText("\n", 6);
if( $a > 30 ){
	$pdf->ezText($asistente,20,$defau);
}else{
	$pdf->ezText($asistente,20,$defau);
}

$pdf->ezText("\n", 4);
$pdf->ezText($id,20,$defau);
$pdf->ezText("\n", 10);
$pdf->ezText($txtcertifica, 15, array('justification'=>'full'));
$pdf->ezText("\n\n", 10);
//$pdf->ezImage($img, 0, 600, 'none', 'left' );
$pdf->ezImage($img3, 0, 600, 'none', 'left' );
$pdf->ezText("\n", 10);
$pdf->ezText($fechae,12,$fech);
$pdf->ezStream();

?>