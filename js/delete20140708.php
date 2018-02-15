<?php
require("../class.conexion.php");

$db = new conn();

$ideve=$_POST['ideve'];
$idced=$_POST['idced'];
$user=$_POST['user'];
$pass=$_POST['pass'];
$fecha = date("Y-m-d");
//mb_strtoupper($_POST['nomemp'], 'UTF-8')
$sqlogin = $db->consulta("select pass from usuario where user='$user' ");
$rowlog = $db->fetch_array($sqlogin);

if($rowlog[0] == $pass){
	$sw = $db->consulta("delete from event_asist WHERE cedula='$idced' AND idevent=$ideve ");
	if($sw==1){
		$msn = "El Registro fue Eliminado Correctamente";
		$db->consulta("insert into log (fechalog,descripcion) values ('$fecha','El Usuario $user Elimino el Asistente $idced del evento $ideve')");
	}else{
		$msn = "Ocurrio un Problema Durante la Eliminacion del Registro. Comuniquese con el Administrador del Sistema";
	}
}else{
	$sw=2;
	$msn = "Usuario o Contraseña Incorrectos";
}

$array = array ( "sw" => $sw , "msn" => "$msn" );
$arrayj = json_encode($array);
echo $arrayj;


?>
