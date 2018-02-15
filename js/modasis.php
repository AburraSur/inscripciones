<?php
require("../class.conexion.php");

$db = new conn();

$eve = $_GET['eve'];

$sql = $db->consulta("select * from modulos where idevento=$eve ");
echo "<option value=0 >--Seleccione--</option>";
while ($row = $db->fetch_array($sql)){
	echo "<option value=$row[idmod] >$row[modulo]</option>";
}



?>