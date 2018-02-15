<?php
require('../class.conexion.php');

$db = new conn();

session_start();

$fecha = date("Y-m-d");

$ip = $db->getRealIP();

if( isset($_SESSION['iduser']) ){
	$varsesion = "$_SESSION[iduser] IP:$ip ";
}else{
	$varsesion = "Externo IP:$ip ";
}


$tp = $_POST['tp'];
$id = $_POST['id'];

if($tp === 'borrar' ){
	$estado = "ELIMINADO";
}elseif($tp === 'bloquear' ){
	$estado = "BLOQUEADO";
}elseif($tp === 'desbloquear' ){
	$estado = "ACTIVO";
}

$sw = $db->consulta("update usuario set estado='$estado' where iduser=$id ");
if($sw == 1){
	$db->consulta("insert into log (fechalog,descripcion) values ('$fecha','El Usuario $varsesion Cambio el estado del usuario $id a $estado')");
}
echo json_encode(array ( "sw" => $sw , "msn" => $estado ));
?>