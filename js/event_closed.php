<?php
/*
$dbh = mysql_connect("localhost", "root", "Ccas1992");
$db = mysql_select_db("promo");
*/
include("../class.conexion.php");
$db = new conn();

		echo "<option value= >Seleccione</option>";
		$sql=$db->consulta("select idevento,nom_evento from  evento where estado = 'CERRADO' ;");
		while($row=$db->fetch_array($sql)){
			echo "<option value=$row[idevento]>$row[idevento] - $row[nom_evento]</option>";
				  }
	
$db->cerrar();
//mysql_close($conexion);	
?>