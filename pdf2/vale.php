<?php
include("./dompdf/dompdf_config.inc.php");
require("../class.conexion.php");

$db = new conn();
$ideve = $_GET['ideve'];
$idasis = $_GET['idasis'];

$sqleve = $db->consulta("select * from evento where idevento=$ideve ");
$roweve = $db->fetch_array($sqleve);
$size = $roweve['fuente']."px";
if ( $_GET['tp'] == 1 ){
	$sqlasis = $db->consulta("select a.cedula,a.nombres,a.apellidos,a.email from asistentes a inner join event_asist ea where a.cedula=ea.cedula and ea.idevent=$ideve and ea.cedula='$idasis' ");
}else{
	$sqlasis = $db->consulta("select a.cedula,a.nombres,a.apellidos,a.email from asistentes a inner join mod_asis ma where a.cedula=ma.cedula and ma.idmod=$idmod  and ma.idevento=$ideve and ma.cedula='$idasis' ");
}
$rowasis = $db->fetch_array($sqlasis);
$asist = "$rowasis[nombres] $rowasis[apellidos]";
$asistente = utf8_encode($asist);
$id = number_format($idasis,0,'','.');
$arrf = array ("01" => "Enero" ,"02" => "Febrero" ,"03" => "Marzo" ,"04" => "Abril" ,"05" => "Mayo" ,"06" => "Junio" ,"07" => "Julio" ,"08" => "Agosto" ,"09" => "Septiembre" ,"10" => "Octubre" ,"11" => "Noviembre" ,"12" => "Diciembre" );
			
			$fec = explode("-",$roweve[fec_event]);
			$mes = $arrf[$fec[1]];
$fechaevefoot = "$roweve[place_exp] - Colombia, $mes $fec[2] de $fec[0]"; 
$html = '
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-15">
<style>

html{
	margin-top: 150px;
}

.titulo{
	font: 30px helvetica;
}

.normal{
	font: 18px helvetica;
}

.nombre{
	font: 22px helvetica;
}

.footer{
	font: 10px helvetica;
	
}

#footer{
	position: absolute;
	left: 405px;
	bottom: 5px;
	
	
	
}

#subfooter{
	position: absolute;
	bottom: 30px;
	width: 970px;
	height: 190px;
	background: url("../img/uploads/'.$roweve['firma'].'") no-repeat;
}

p{
	text-align: justify;
	font-size: '.$size.';
}
</style>
</head>

<body>
	<table align="center" width="90%" cellspacing="10" >
		<tr>
			<td align="center" ><font class="titulo" ><b>C&Aacute;MARA DE COMERCIO ABURR&Aacute; SUR</b></font></td>
		</tr>
		<tr>
			<td align="center" ><font class="normal" >Certifica que:</font></td>
		</tr>
		<tr>
			<td align="center" ><font class="nombre" ><b>'.$asistente.'</b></font></td>
		</tr>
		<tr>
			<td align="center" ><font class="nombre" >Identificaci&oacute;n: '.$id.'</font></td>
		</tr>
		<tr>
			<td align="center" ><p><b>'.utf8_encode($roweve['var_certi']).'</b></p></td>
		</tr>
	</table>
	
	<div id="footer" ><font class="footer" >'.utf8_encode($fechaevefoot).'</font></div>
	<div  id="subfooter" ></div>
</body>
</html>
'; 


$dompdf = new DOMPDF(); 
$dompdf->set_paper("letter", "landscape");
$dompdf->load_html(utf8_decode($html)); 
$dompdf->render(); 

$dompdf->stream("certificado.pdf",array('Attachment'=>0)); 

?> 
