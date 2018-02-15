<?php
require("./class.conexion.php");

$db = new conn();

$sql = $db->consulta("select max(cedula) 'consecu' from asistentes where cedula< 200");

$row = $db->fetch_array($sql);

echo "Consecutivo Cedulas: ".$row['consecu'];

?>