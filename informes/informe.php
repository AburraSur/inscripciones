<?php

 
header('Content-type: application/vnd.ms-excel');

header("Content-Disposition: attachment; filename=encuesta.xls");

header("Pragma: no-cache");

header("Expires: 0");


require("../class.conexion.php");
$db = new conn();

 echo "
<table cellspacing=0 cellpadding=0 border=1>
 <tr>
	<th>EVENTO</th>
	<th>CEDULA</th>
	<th>CODIGO</th>
	<th>NOMBRES</th>
	<th>APELLIDOS</th>
	<th>CORREO ELECTRONICO</th>
	<th>TELEFONO</th>
	<th>EXT</th>
	<th>CELULAR</th>
	<th>MUNICIPIO</th>
	<th>CARGO</th>
	<th>NIT</th>
	<th>EMPRESA</th>
	<th>DIRECCION EMPRESA</th>
	<th>COMENTARIO</th>
	<th>ASISTIO</th>
 </tr>
";

echo "
		<tr>";
			
			$sql1 = $db->consulta("SELECT ev.nom_evento ,a.cedula ,ea.id ,a.nombres ,a.apellidos ,a.email ,a.tel ,a.ext ,a.cel ,a.municipio ,a.cargo ,e.nit ,e.rsocial ,e.dir ,e.comentario 
FROM asistentes a inner join empresa e inner join event_asist ea inner join evento ev
WHERE ea.nit=e.nit
AND ea.cedula=a.cedula
AND ea.idevent=ev.idevento
AND ea.idevent=$_GET[cod] ");

while($row1 = $db->fetch_assoc($sql1)){
	echo "<tr>";
	foreach( $row1 as $dato ){
			echo "<td>$dato</td>";			
	}
	$sql2 = $db->consulta("select * from mod_asis where idevento=$_GET[cod] and cedula='$row1[cedula]'");
	while($row2 = $db->fetch_array($sql2)){
		$asis.="$row2[asistio]-";
	}
	$asist = trim($asis,"-");
	$asis='';
	echo "<td>$asist</td></tr>";
}
		echo "</table>";
	
	
?>