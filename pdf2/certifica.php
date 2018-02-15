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
$asist = utf8_encode("$rowasis[nombres] $rowasis[apellidos]");
if($idasis == 'blank'){
	$asistente = "<br><br>";
	$id = "<br>";
}else{
	$asistente = $asist;
	$id = number_format($idasis,0,'','.');
}
//$id = $idasis;

$arrf = array ("01" => "Enero" ,"02" => "Febrero" ,"03" => "Marzo" ,"04" => "Abril" ,"05" => "Mayo" ,"06" => "Junio" ,"07" => "Julio" ,"08" => "Agosto" ,"09" => "Septiembre" ,"10" => "Octubre" ,"11" => "Noviembre" ,"12" => "Diciembre" );
			
			$fec = explode("-",$roweve[fec_exp]);
			$mes = $arrf[$fec[1]];
$fechaevefoot = "$roweve[place_exp], $mes $fec[2] de $fec[0]"; 
$html = '
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<style>

html{
	margin-top: 155px;
}

.titulo{
	font: 22px helvetica;
}

.normal{
	font: 18px helvetica;
}

.nombre{
	font: 22px helvetica;
}

.nombre2{
	font: 26px helvetica;
}

.footer{
	font: 14px helvetica;
	
}

#footer{
	position: absolute;
	left: 380px;
	bottom: 25px;
	text-align: center;
	background-color: silver;
	width: 900px;
}

#subfooter{
	position: absolute;
	bottom: 40px;
	
}

@page {
    margin-left: 0em;
	margin-right: 0.6em;
        }

p{
	text-align: justify;
	font: 10px helvetica;
	font-size: '.$size.';
}

.firma{
	font-size: 18;
	font: helvetica;
}
</style>
</head>

<body>
	<table align="center" width="90%" cellspacing="10"  >
	<tr>
			<td align="center" ><font class="nombre2" ><b>CÁMARA DE COMERCIO ABURRÁ SUR</b></font></td>
		</tr>
		<tr>
			<td align="center" ><font class="nombre2" ><b>C&Aacute;MARA DE COMERCIO ABURR&Aacute; SUR</b></font></td>
		</tr>
		<tr>
			<td align="center" ><font class="nombre" >Certifica que:</font></td>
		</tr>
		<tr>'."
			<td align='center' ><font class='nombre2' ><b>$asistente</b></font></td>
		</tr>
		<tr>
			<td align='center' ><font class='nombre' >C.C: $id</font></td>
		</tr>";
		/*<tr>
			<td align='center' ><font class='nombre' >Particip&oacute; en:</font></td>
		</tr>
		<tr>
			<td align='center' ><font class='nombre' >".utf8_encode($roweve['nom_evento'])."</font></td>
		</tr>*/
		$html.="<tr>
			<td align='center' ><font class='nombre' >".utf8_encode($roweve['var_certi'])."</font></td>
		</tr>
		<tr>";
			/* linea para firmas digitales */
			$html.='<td align="center" ><img src="../img/uploads/'.$roweve['firma'].'"  /></td>';
			
			
			/*Linea para firmas manuales
		<td align="center" >
				<table align="center" width="100%" >
					<tr><td colspan="2" ><br><br><br><br><br><br></td></tr>
					<tr>
						<td align="center" valign="top" ><font class="firma" ><b>______________________________________<br>RA&Uacute;L ALBERTO MENCO VARGAS<br>Expositor</b></font></td>
						<td align="center" valign="top" ><font class="firma" ><b>______________________________________<br>LILLYAM MESA ARANGO<br>Presidenta Ejecutica<br>C&aacute;mara de Comercio Aburr&aacute; Sur</b></font></td>
					</tr>
				</table>
			</td>*/			
		$html.='</tr>
		<tr>
			<td align="center" ><font class="footer" >'.utf8_encode($fechaevefoot).'</font></td>
		</tr>
	</table>
	
	
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