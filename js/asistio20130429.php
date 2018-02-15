<?php
require("../class.conexion.php");

$db = new conn();


if( isset($_GET['mod']) ){
	$resp = $db->consulta("update mod_asis set asistio=1 where cedula=".$_GET['id']." and idmod=".$_GET['mod']." and idevento=".$_GET['eve']." ");
	$resp2 = $db->consulta("update event_asist set e_asistio=1 where cedula=".$_GET['id']." and idevent=".$_GET['eve']." ");
	
}else{
	$resp = $db->consulta("update event_asist set e_asistio=1 where cedula=".$_GET['id']." and idevent=".$_GET['eve']." ");
}
$array = array("resp" => $resp );
$arrayj = json_encode($array);
echo $arrayj;

?>