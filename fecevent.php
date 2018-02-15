<?php
require("./class.conexion.php");

$db = new conn();

echo $fec = date("Y-m-d");

$sql = $db->consulta("select * from evento where fec_fin >= '$fec' and fec_event >= '$fec' ");

while($row = $db->fetch_array($sql)){
	 echo "$row[nom_evento]<br>";
}


?>