<?php
require("../class.conexion.php");

$db = new conn();

$id = $_GET[id];
$idev = $_GET[idev];



if ( $_GET[type] == 1 ){
	
	$sql = $db->consulta("select e.rsocial from empresa e inner join event_asist ea where e.nit=ea.nit and ea.nit=$id and ea.idevent=$idev ");
	$sql2 = $db->consulta("select p.cedula,p.nombres,p.apellidos from empresa e inner join asistentes p inner join event_asist ea where e.nit=ea.nit and p.cedula=ea.cedula and ea.nit=$id and ea.idevent=$idev ");
	
	$numrow = $db->num_rows($sql);
	
	if( $numrow == 0 ){
		echo "
		<center><br>
		<font face=Verdana size=5 ><i><b>No se Encuentran Empresas Registradas con el NIT $id</font>
		";
	}else{
	
	$rowemp = $db->fetch_array($sql);
	
	echo "<center><br>
		<font face=Verdana size=4 ><i><b>Empresa:</font><br>
		<font face=Verdana size=2 ><i><b> $rowemp[rsocial]</font><br><br>
		<font face=Verdana size=4 ><i><b>Participantes:</font><br>
	";
	
	while( $row = $db->fetch_array($sql2)){
		echo "
			<font face=Verdana size=2 ><i><b>$row[cedula] - $row[nombres] $row[apellidos]</font><br>
		";
	}
	}
}else{

$sql = $db->consulta("select e.rsocial,p.cedula,p.nombres,p.apellidos from empresa e inner join asistentes p inner join event_asist ea where e.nit=ea.nit and p.cedula=ea.cedula and ea.cedula=$id and ea.idevent=$idev");
	
	$rowemp = $db->fetch_array($sql);
	
	echo "<center><br>
		<font face=Verdana size=4 ><i><b>Empresa:</font><br>
		<font face=Verdana size=2 ><i><b> $rowemp[rsocial]</font><br><br>
		<font face=Verdana size=4 ><i><b>Participantes:</font><br>
		<font face=Verdana size=2 ><i><b>$rowemp[cedula] - $rowemp[nombres] $rowemp[apellidos]</font><br>
	";
	
	

}

?>