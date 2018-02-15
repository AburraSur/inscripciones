<?php
require("../class.conexion.php");
session_start();
$db = new conn();
$fec = date("Y-m-d");
if( isset($_GET['cert']) ){
	$var = "certifica";
	$varm = "certifica";
}else{
	$var = "e_asistio";
	$varm = "asistio";
	
}

if( $_GET['mod'] > 0 ){
	$resp = $db->consulta("update mod_asis set ".$varm."=1 where cedula=".$_GET['id']." and idmod=".$_GET['mod']." and idevento=".$_GET['eve']." ");
	$resp2 = $db->consulta("update event_asist set ".$var."=1 	 where cedula=".$_GET['id']." and idevent=".$_GET['eve']." ");
	
}else{
	//$resp = $db->consulta("update event_asist set ".$var."=1 where cedula=".$_GET['id']." and idevent=".$_GET['eve']." ");
	$sqleve = $db->consulta("select * from evento where idevento=$_GET[eve] ");
$roweve = $db->fetch_array($sqleve);

if($roweve['modulos']==='SI'){
	$sqlmod = $db->consulta("select SUM(asistio) 'asistencia' from mod_asis where cedula=".$_GET['id']." and idevento=".$_GET['eve']."");
	$rowmod = $db->fetch_array($sqlmod);
	if($rowmod['asistencia'] >= $roweve['total_asist_certifica']){
		//$resp = 1;
		$resp = $db->consulta("update event_asist set ".$var."=1 where cedula=".$_GET['id']." and idevent=".$_GET['eve']." ");
	}else{
		$resp = 2;
		$msn = "Esta persona no cumple con las asistencias minimas para certificacion.";
	}
}else{
	$resp = $db->consulta("update event_asist set ".$var."=1 where cedula=".$_GET['id']." and idevent=".$_GET['eve']." ");
}

}

//$db->consulta("insert into log (fechalog,descripcion) values ('$fec','El Usuario $_SESSION[iduser] Confirma la Asistencia de $_GET['id'] ') ");
$array = array("resp" => $resp , "msn" => $msn );
$arrayj = json_encode($array);
echo $arrayj;

?>