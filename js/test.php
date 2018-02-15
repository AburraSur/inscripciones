<?php
require("../class.conexion.php");

$db = new conn();

$sql = $db->consulta("select * from asistentes where cedula=7129362123 ");
$row = $db->fetch_array($sql);
$arr = array('asistentes','empresa','evento');
//var_dump($arr);
$p = 1;
echo "$arr[$p]";



?>