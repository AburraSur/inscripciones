<?php
include("./dompdf/dompdf_config.inc.php");
require("../class.conexion.php");

$db = new conn();
$ideve = $_GET['ideve'];
$idasis = $_GET['idasis'];

$sqleve = $db->consulta("select * from evento where idevento=$ideve ");
$roweve = $db->fetch_array($sqleve);
$nomevent = utf8_encode($roweve['nom_evento']);
/*
if ( $_GET['tp'] == 1 ){
	$sqlasis = $db->consulta("select a.cedula,a.nombres,a.apellidos,a.email from asistentes a inner join event_asist ea where a.cedula=ea.cedula and ea.idevent=$ideve and ea.cedula='$idasis' ");
}else{
	$sqlasis = $db->consulta("select a.cedula,a.nombres,a.apellidos,a.email from asistentes a inner join mod_asis ma where a.cedula=ma.cedula and ma.idmod=$idmod  and ma.idevento=$ideve and ma.cedula='$idasis' ");
}
*/
if ( $_GET['tp'] == 1 ){
	$sqlasis = $db->consulta("select a.cedula,a.nombres,a.apellidos,a.email,empresa.rsocial from asistentes a inner join event_asist ea INNER JOIN empresa where a.cedula=ea.cedula and ea.idevent='$ideve' and ea.cedula='$idasis' AND empresa.nit = ea.nit ");
}else{
	$sqlasis = $db->consulta("select a.cedula,a.nombres,a.apellidos,a.email,empresa.rsocial from asistentes a inner join event_asist ea INNER JOIN empresa where a.cedula=ea.cedula and ea.idevent='$ideve' and ea.cedula='$idasis' AND empresa.nit = ea.nit");
}
$rowasis = $db->fetch_array($sqlasis);
$asist = "$rowasis[nombres] $rowasis[apellidos]";
$asistente = utf8_encode($asist);
$id = number_format($idasis,0,'','.');
$arrf = array ("01" => "Enero" ,"02" => "Febrero" ,"03" => "Marzo" ,"04" => "Abril" ,"05" => "Mayo" ,"06" => "Junio" ,"07" => "Julio" ,"08" => "Agosto" ,"09" => "Septiembre" ,"10" => "Octubre" ,"11" => "Noviembre" ,"12" => "Diciembre" );
			
			$fec = explode("-",$roweve[fec_event]);
			$mes = $arrf[$fec[1]];
			//$dias = $fec[2]+1;

//$fechaevefoot = "$mes $fec[2] y $dias de $fec[0]"; 
$fechaevefoot = "$fec[2] de $mes de $fec[0]"; 
$empresa = "$rowasis[rsocial]";
$html = '
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-15">
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
		<td id=pie ><span class=normal ><b>Invitado</b></span></td>
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