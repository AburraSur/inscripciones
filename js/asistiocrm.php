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
	
	/*$sqleve = $db->consulta("select * from evento where idevento=$_GET[eve] ");
	$roweve = $db->fetch_array($sqleve);
	
	$sqlnit = $db->consulta("select nit from event_asist where cedula=$_GET[id] and idevento=$_GET[eve] ");
	$rownit = $db->fetch_array($sqlnit);
	$nit='1036614779';
	
        include('../../crm655/crm/PSGWSTest.php');*/
}

if( $_GET['mod'] > 0 ){
	$resp = $db->consulta("update mod_asis set ".$varm."=1 where cedula=".$_GET['id']." and idmod=".$_GET['mod']." and idevento=".$_GET['eve']." ");
	$resp2 = $db->consulta("update event_asist set ".$var."=1 	 where cedula=".$_GET['id']." and idevent=".$_GET['eve']." ");
	
}else{
	$resp = $db->consulta("update event_asist set ".$var."=1 where cedula=".$_GET['id']." and idevent=".$_GET['eve']." ");
}

//$db->consulta("insert into log (fechalog,descripcion) values ('$fec','El Usuario $_SESSION[iduser] Confirma la Asistencia de $_GET['id'] ') ");
$array = array("resp" => $resp );
$arrayj = json_encode($array);
echo $arrayj;

?>