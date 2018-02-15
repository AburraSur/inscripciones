<?php
include("../class.conexion.php");  
 $db = new conn();  
  $consulta = $db->consulta("select * from evento  ;");  
  while($row=$db->fetch_array($consulta)){
	echo"<br>".$row[nom_evento];
  }

?>