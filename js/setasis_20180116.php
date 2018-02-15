<?php
require("../class.conexion.php");

$db = new conn();
$ced = $_POST['ced'];
$ideve = $_POST['ideve'];
$n = $_POST['n'];
$p = $_POST['objet'];
$id = $_POST['id'];
$nit = $_POST['nit'];

$varobj = array('asistentes','empresa','evento');
$varid = array('cedula','nit','idevento');
$varnom = array('nombres','rsocial','evento');

if( isset($ced)){
	
	$sql = $db->consulta("select * from asistentes where cedula=$ced ");
	$num = $db->num_rows($sql);
	$row = $db->fetch_array($sql);
	if( isset($ideve)){
	$sqlnit = $db->consulta("SELECT nit
FROM event_asist
WHERE cedula =$ced
AND idevent =$ideve ");
	$rownit = $db->fetch_array($sqlnit);	
	$sqlemp = $db->consulta("select * from empresa where nit='$rownit[nit]' ");
	$rowemp = $db->fetch_array($sqlemp);
}
if( $num == 0 ){
	$array = array("sw" => 2);
}else{

	$array = array("sw" => 1,"ced" => $ced,
					"nom" => utf8_encode($row['nombres']),
					"ape" => utf8_encode($row['apellidos']),
					"mail" => $row['email'],
					"tel" => $row['tel'],
					"ext" => $row['ext'],
					"cel" => $row['cel'],
					"mun" => $row['municipio'],
					"car" => utf8_encode($row['cargo']),
					"coment" => utf8_encode($row['comentario']),
					"habeas" => $row['habeas'],
					"nit" => $rowemp['nit'],
					"rsocial" => $rowemp['rsocial'],
					"dir" => $rowemp['dir'],
					"habeas" => $row['habeas'],
					"ctrl" => $_POST['v']);
					
	}

}elseif( isset($nit)){
	$sqlemp = $db->consulta("select * from empresa where nit='$nit' ");
	$rowemp = $db->fetch_array($sqlemp);
	$num = $db->num_rows($sqlemp);
	
	$rsoc = utf8_encode($rowemp['rsocial']);
	
	$array = array("sw" => $num,"nit" => $nit,
					"rsocial" => $rsoc,
					"dir" => $rowemp['dir']);
}else{
	$array = array("sw" => 2);
}

/*$array = array("sw" => $sw, "nom" => $nom);*/
$arrayj = json_encode($array);
echo $arrayj;

?>