<?php
require("../class.conexion.php");
session_start();
$db = new conn();
$i = $_POST['i'];
$ideve = $_POST['ideve'];
$idmod = $_POST['idmod'];

$nom = strtoupper($_POST['nombres1']);
$ape = strtoupper($_POST['apellidos1']);
$car = strtoupper($_POST['cargo1']);
$mail = strtolower($_POST['mail1']);
$rsoc = strtoupper($_POST['nomemp']);
$dir = strtoupper($_POST['diremp']);
if( isset($_POST['idcancel']) ){
	if( $idmod != 0 ){
		$sw1 = $db->consulta("update event_asist set e_asistio=3 where cedula='$_POST[idcancel]' and idevent=$ideve ");
		$sw3 = $sw2 = $db->consulta("update mod_asis set asistio=3 where cedula='$_POST[idcancel]' and idevento=$ideve and idmod=$idmod ");
	}else{
		$sw = $db->consulta("update event_asist set e_asistio=3 where cedula='$_POST[idcancel]' and idevent=$ideve ");
	}
}else{
$sw1 = $db->consulta("update asistentes set cedula='$_POST[docid1]',nombres='$nom',apellidos='$ape',email='$mail',tel='$_POST[tel1]',ext='$_POST[ext1]',cel='$_POST[cel1]',municipio='$_POST[muni1]',cargo='$car',nit='$_POST[nit1]' where cedula='$_POST[oldced]' and nit='$_POST[oldnit]' ");
$sw2 = $db->consulta("update empresa set nit='$_POST[idnit]',rsocial='$rsoc',dir='$dir' where nit='$_POST[oldnit]' ");
$sw3 = $db->consulta("update event_asist set cedula='$_POST[docid1]', nit='$_POST[idnit]' where cedula='$_POST[oldced]' ");


}

if ( $sw1 == true && $sw2 == true && $sw3 == true ){
	$sw = 1;
}

$array = array("sw" => $sw);
$arrayj = json_encode($array);
echo $arrayj;

?>