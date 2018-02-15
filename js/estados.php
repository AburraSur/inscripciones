<?php
require_once("../class.conexion.php");

$db = new conn();

$ideve = $_POST['ideve'];
$idced = $_POST['idced'];

if($_POST['tp'] == 1){
$sql = $db->consulta("select a.nombres,a.apellidos,ea.e_asistio from asistentes a inner join event_asist ea where a.cedula=ea.cedula and a.cedula='$idced' and ea.idevent=$ideve ");
$nr = $db->num_rows($sql);
$row = $db->fetch_array($sql);

$nomm = "$row[nombres] $row[apellidos]";
$nom = utf8_encode($nomm);
if($row['e_asistio'] == 0){
	$est = 'Inscrito';
}elseif($row['e_asistio'] == 1){
	$est = 'Asistio';
}else{
	$est = 'Cancelado';
}


}elseif($_POST['tp'] == 2){
	$est = $_POST['est'];
	$nr = $db->consulta("UPDATE event_asist SET e_asistio=$est WHERE cedula='$idced' AND idevent=$ideve ");
}

$array = array ( "sw" => $nr , "nom" => "$nom" , "est" => "$est" );
$arrayj = json_encode($array);
echo $arrayj;


?>

