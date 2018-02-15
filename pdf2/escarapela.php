<?php
include("./dompdf/dompdf_config.inc.php");
require_once '../clases/conectar.php';

$linked = new conectar();
$link = $linked->conectarbd();

$ideve = $_GET['ideve'];
$idasis = $_GET['idasis'];

$sqleve = "select * from evento where idevento=$ideve";
if($evento = $link->query($sqleve) or trigger_error(mysqli_error($link))){}

$roweve = $evento->fetch_array();
$nomevent = $roweve['nom_evento'];
/*
if ( $_GET['tp'] == 1 ){
	$sqlasis = $db->consulta("select a.cedula,a.nombres,a.apellidos,a.email from asistentes a inner join event_asist ea where a.cedula=ea.cedula and ea.idevent=$ideve and ea.cedula='$idasis' ");
}else{
	$sqlasis = $db->consulta("select a.cedula,a.nombres,a.apellidos,a.email from asistentes a inner join mod_asis ma where a.cedula=ma.cedula and ma.idmod=$idmod  and ma.idevento=$ideve and ma.cedula='$idasis' ");
}
*/
if ( $_GET['tp'] == 1 ){
	$sqlasis =("select a.cedula,a.nombres,a.apellidos,a.email,empresa.rsocial from asistentes a inner join event_asist ea INNER JOIN empresa where a.cedula=ea.cedula and ea.idevent='$ideve' and ea.cedula='$idasis' AND empresa.nit = ea.nit ");
}else{
	$sqlasis =("select a.cedula,a.nombres,a.apellidos,a.email,empresa.rsocial from asistentes a inner join event_asist ea INNER JOIN empresa where a.cedula=ea.cedula and ea.idevent='$ideve' and ea.cedula='$idasis' AND empresa.nit = ea.nit");
}
if($asistente = $link->query($sqlasis) or trigger_error(mysqli_error($link))){}

$rowasis = $asistente->fetch_array();
$asist = "$rowasis[nombres] $rowasis[apellidos]";
$asistente = $asist;
$id = number_format($idasis,0,'','.');
$arrf = array ("01" => "Enero" ,"02" => "Febrero" ,"03" => "Marzo" ,"04" => "Abril" ,"05" => "Mayo" ,"06" => "Junio" ,"07" => "Julio" ,"08" => "Agosto" ,"09" => "Septiembre" ,"10" => "Octubre" ,"11" => "Noviembre" ,"12" => "Diciembre" );
			
			$fec = explode("-",$roweve[fec_event]);
			$mes = $arrf[$fec[1]];
			//$dias = $fec[2]+1;

//$fechaevefoot = "$mes $fec[2] y $dias de $fec[0]"; 
$fechaevefoot = "$fec[2] de $mes de $fec[0]"; 
$empresa = "$rowasis[rsocial]";
$html = '
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<style>

html{
	margin-top: 5px;
	margin-left: 25px;
	margin-right: 5px;
}

.titulo{
	font: 20px helvetica;
	font-weight:bold;
}

.normal{
	font: 16px helvetica;
	font-weigth:bold;
}

.nombre{
	font: 18px helvetica;
	font-weigth:bold;
}

#titulo{
	height: 100px;	
}

#evento{
	height: 95px;
	text-align: center;
}


#nombre{
	height: 60px;
	text-align: center;
}

#pie{
	height: 75px;
	text-align: center;
}

#last{
	height: 95px;
	
}

</style>
</head>

<body>
ñó
<table width="95%" height="100%" >
	<tr>
		<td id=titulo ></td>
	</tr>
	<tr>
		<td id=evento ><span class=titulo >'.$nomevent.'</span></td>
        </tr>
	<tr>
		<td id=nombre ><span class=nombre ><b>'.$asistente.'</b></span></td>
	</tr>
	<tr>
		<td id=pie ><span class=normal ><b>'.$empresa.'</b></span></td>
	</tr>
        <tr>
                <td class=normal style="text-align: center;" ><br>'.$fechaevefoot.'</td>
	</tr>
	<tr>
		<td id=last ></td>
	</tr>
</table>
</body>
</html>
';

$dompdf = new DOMPDF(); 
$dompdf->set_paper("A6", "portrait");
$dompdf->load_html(utf8_decode($html)); 
$dompdf->render(); 

$dompdf->stream("escarapela.pdf",array('Attachment'=>0)); 

?> 