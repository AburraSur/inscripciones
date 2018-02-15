<?php

require("../class.conexion.php");

$db = new conn();

		echo "<option>---Seleccione---</option>";
		$yy = $_GET['y'];
		//$yy = "2013";
		$sqlemp = $db->consulta("select * from evento where pago=1 and year(fec_event)='$yy' ");
		while( $rowemp = $db->fetch_array($sqlemp)){
			echo "<option value=$rowemp[idevento] >$rowemp[idevento] - ".utf8_decode($rowemp[nom_evento])."</option>";
		}
		
			
		?>