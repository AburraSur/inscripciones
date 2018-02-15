<?php
ob_start();
require_once('class.ezpdf.php');
require("../class.conexion.php");
$pdf =& new Cezpdf('B10');
$pdf->selectFont('fonts/Helvetica-Bold.afm');
$pdf->ezSetCmMargins(0,0,0,0);

$db = new conn();

$ideve = $_GET['ideve'];
$idasis = $_GET['idasis'];
$idmod = $_GET['idmod'];

if ( $idmod > 0 ){
	$sqlmod = $db->consulta("select * from modulos where idmod=$idmod ");
	$rowmod = $db->fetch_array($sqlmod);
}

$sqleve = $db->consulta("select * from evento where idevento=$ideve ");
$roweve = $db->fetch_array($sqleve);

if ( $_GET['tp'] == 1 ){
	$sqlasis = $db->consulta("select a.cedula,a.nombres,a.apellidos,a.email from asistentes a inner join event_asist ea where a.cedula=ea.cedula and ea.idevent=$ideve and ea.cedula=$idasis ");
}else{
	$sqlasis = $db->consulta("select a.cedula,a.nombres,a.apellidos,a.email from asistentes a inner join mod_asis ma where a.cedula=ma.cedula and ma.idmod=$idmod  and ma.idevento=$ideve and ma.cedula=$idasis ");
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
	
if ( $idmod > 0 ) {

	$evento = "$roweve[nom_evento] \n $rowmod[modulo]";
}else{			
	$evento = "$roweve[nom_evento]";
}
$vecasis=$asistente = "$rowasis[nombres] $rowasis[apellidos]";
$fechaeve = "$mes $fec[2] de $fec[0]";
//$fechaeve = "$mes $fec[2] del $fec[0]";

$l = strlen($evento);
$a = strlen($asistente);

/*if( $l > 20 ){
	$pdf->ezText($evento,5,$defau);
	//$pdf->ezText("\n", 1);
}else{
	$pdf->ezText($evento,6,$defau);
	$pdf->ezText("\n", 3);
}*/

if( $l > 72 ){
	$pdf->ezText($evento,4,$defau);
}elseif( $l > 60 ){
	$pdf->ezText($evento,4,$defau);
	$pdf->ezText("\n", 3);
}elseif( $l > 20 ){
	//$pdf->ezText("\n", 2);
	$pdf->ezText($evento,4,$defau);
	$pdf->ezText("\n", 5);
}else{
	$pdf->ezText($evento,5,$defau);
	$pdf->ezText("\n\n", 4);
}

if( $a > 20 ){
	$pdf->ezText("\n", 2);
	$nomasi = explode(" ",$asistente);
	if($nomasi[1]=='DE'){
		$vecasis = "$nomasi[0] $nomasi[1] $nomasi[2] \n $nomasi[3] $nomasi[4] $nomasi[5] $nomasi[6]";
	}elseif($nomasi[3]=='DE'){
		$vecasis = "$nomasi[0] $nomasi[1]  \n $nomasi[2] $nomasi[3] $nomasi[4] $nomasi[5] $nomasi[6]";
	}else{	
		//$pdf->ezText("\n", 4);
		$vecasis = "$nomasi[0] $nomasi[1]\n$nomasi[2] $nomasi[3] $nomasi[4] $nomasi[5] $nomasi[6]";
	}
}else{
	$pdf->ezText("\n\n", 3);
}

$pdf->ezText($vecasis,5,$defau);
$pdf->ezText("\n", 4);
$pdf->ezText($fechaeve,5,$defau);
$pdf->ezStream();

?>