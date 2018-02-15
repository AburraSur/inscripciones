<?php
require("../class.conexion.php");
session_start();
$fecha = date("Y-m-d");
$db = new conn();
	$typ = $_POST['typ'];
	$idasi = $_POST['oldid'];
	$idrep = $_POST['docid1'];
	$nom =  utf8_decode(mb_strtoupper($_POST['nombres1'], 'UTF-8'));
	$ape =  utf8_decode(mb_strtoupper($_POST['apellidos1'], 'UTF-8'));
	$car =  utf8_decode(mb_strtoupper($_POST['cargo1'], 'UTF-8'));
	$coment =  utf8_decode(mb_strtoupper($_POST['comentario'], 'UTF-8'));
	$dir =  utf8_decode(mb_strtoupper($_POST['diremp'], 'UTF-8'));
	$tar =  $_POST['tarifa'];
	$mail = mb_strtolower($_POST['mail1'], 'UTF-8');
	$ideve = $_POST['ideve'];
	$sw = 0;
	$ip = $db->getRealIP();
if( $typ == 0 ){
	$s1=$s2=$s3=0;
	$sqlrep = $db->consulta("select * from asistentes where cedula='$idrep' ");
	$sqlrep2 = $db->consulta("select * from evento where idevento='$ideve' ");
	$numrow = $db->num_rows($sqlrep);
	$rowev = $db->fetch_array($sqlrep2);
	$s1 = $db->consulta("update event_asist set cedula='$idrep' where idevent='$ideve' and cedula='$idasi' ");
	$log = "El Usuario $_SESSION[iduser] reemplazo el asistente $idasi por $idrep en el evento $ideve ";
	if( $_POST['idmod'] > 0 ){
		$s2 = $db->consulta("update mod_asis set cedula='$idrep' where idevento='$ideve' and idmod=$_POST[idmod] and cedula='$idasi' ");
		$log.= "El Usuario $_SESSION[iduser] reemplazo el asistente $idasi por $idrep en el modulo $_POST[idmod] ";
	}
		
	if( $numrow == 0 ){
		$s3 = $db->consulta("insert into asistentes (cedula,nombres,apellidos,email,tel,ext,cel,municipio,cargo,habeas) values ('$idrep','$nom','$ape','$mail','$_POST[tel1]','$_POST[ext1]','$_POST[cel1]','$_POST[muni1]','$car','$_POST[habeas1]')");
		$log.="El Usuario $_SESSION[iduser] creo el reemplzo $idrep para el evento $ideve ";
	}
	
	if( $rowev['pago'] == 1 ){
		$db->consulta("update pagos set cedula='$idrep' where idevento='$ideve' and cedula='$idasi' ");
	}
	
	$db->consulta("insert into log (fechalog,descripcion) values ('$fecha','$log')");
	
	// pendiente de determinar la validez de las operaciones para enviar JSON
	if( ($s1 <= 1 )&&($s2 <= 1)&&($s3 <= 1)){
	$sw = 1;
	$msn = "Los Datos Fueron Actualizados Correctamente.$s1 - $s2 - $s3";
	}else{
	$sw = 2;
	$msn = "$s1 - $s2 - $s3";
	}
}elseif($typ == 1){
	if ( $_POST['opcion'] == 0 ){
	$sqlog = $db->consulta("select * from asistentes where cedula='$idasi'");
	$rowlog = $db->fetch_array($sqlog);
	$s1 = $db->consulta("update asistentes set cedula=$idrep,nombres='$nom',apellidos='$ape',email='$mail',tel='$_POST[tel1]',ext='$_POST[ext1]',cel='$_POST[cel1]',municipio='$_POST[muni1]',cargo='$car',comentario='$coment',habeas='$_POST[habeas1]' where cedula='$idasi'");
	if( ($idrep != $idasi) && ($s1 == 1 ) ){
	$db->consulta("update event_asist set cedula='$idrep' where cedula='$idasi' ");
	$db->consulta("update mod_asis set cedula='$idrep' where cedula='$idasi' ");
	}
	$log = "El usuario $_SESSION[iduser] IP $ip cambio los datos del asistente $rowlog[cedula],$rowlog[nombres],$rowlog[apellidos],$rowlog[email],$rowlog[tel],$rowlog[ext],$rowlog[cel],$rowlog[municipio],$rowlog[cargo] por los siguientes datos $idrep,$nom,$ape,$mail,$_POST[tel1],$_POST[ext1],$_POST[cel1],$_POST[muni1],$car ";
	
	$db->consulta("insert into log (fechalog,descripcion) values ('$fecha','$log') ");
	
	
	}elseif( $_POST['opcion'] == 1 ){
	       $sqlog = $db->consulta("select * from empresa where nit='$idasi'");
		$rowlog = $db->fetch_array($sqlog);
		$db->consulta("update pagos set tarifa='$tar' where nit='$idasi' ");
		$s1 = $db->consulta("update empresa set nit='$idrep',rsocial='$nom',dir='$dir' where nit='$idasi'");
		if( $idrep != $idasi ){
		$db->consulta("update event_asist set nit='$idrep' where nit='$idasi' ");
		$db->consulta("update mod_asis set nit='$idrep' where nit='$idasi' ");
		}
		$log = "El usuario $_SESSION[iduser] IP $ip cambio los datos de la empresa $rowlog[nit],$rowlog[rsocial],$rowlog[dir] por los siguientes datos nit=$idrep,rsocial=$nom,dir=$dir ";
		$db->consulta("insert into log (fechalog,descripcion) values ('$fecha','$log') ");
		
	}elseif( $_POST['opcion'] == 2 ){
		$car2 = utf8_decode($_POST['certvar']);
		$place_exp = utf8_decode($_POST['place_exp']);
		$sqlog = $db->consulta("select * from evento where idevento='$ideve'");
		$rowlog = $db->fetch_array($sqlog);
		$s1 = $db->consulta("update evento set  nom_evento='$nom',fec_event='$_POST[fecevent]',fec_inicio='$_POST[finicio]',fec_fin='$_POST[fcierre]',fec_exp='$_POST[fec_exp]',hora='$_POST[hevent]',place_exp='$place_exp',lugar='$ape',estado='$_POST[estevent]',image='$_POST[nomfc]',cupo='$_POST[cupo]',var_certi='$car2',fuente=$_POST[fuecert],firma='$_POST[firma]' where idevento='$_POST[ideve]' ");
		
		$log = "El usuario $_SESSION[iduser] IP $ip cambio los datos de el evento $rowlog[nom_evento],$rowlog[fec_event],$rowlog[fec_inicio],$rowlog[fec_fin],$rowlog[hora],$rowlog[lugar],$rowlog[image],$rowlog[cupo],$rowlog[var_certi] por los datos nom_evento=$nom,fec_event=$_POST[fecevent],fec_inicio=$_POST[finicio],fec_fin=$_POST[fcierre],hora=$_POST[hevent],lugar=$ape,image=$_POST[list],cupo=$_POST[cupo],var_certi=$car2 ";
		$db->consulta("insert into log (fechalog,descripcion) values ('$fecha','$log') ");
	}elseif( $_POST['opcion'] == 3 ){
		$nom = utf8_decode($_POST['modu1']);
		$fec_mod = $_POST['fmod1'];
		$sqlog = $db->consulta("select * from evento where idevento='$ideve'");
		$rowlog = $db->fetch_array($sqlog);
		
		$s1 = $db->consulta("update modulos set  modulo='$nom',fec_mod='$fec_mod' where idmod='$_POST[idmod]' ");
		
		$log = "El usuario $_SESSION[iduser] IP $ip cambio los datos del modulo $rowlog[modulo],$rowlog[fec_mod] por los datos nom_modulo=$nom,fec_mod=$fec_mod";
		$db->consulta("insert into log (fechalog,descripcion) values ('$fecha','$log') ");
	}
	
	if($s1 == 1){
		$sw = 1;
		$msn = "Los Datos Fueron Actualizados Correctamente.";
	}else{
		$sw =2;
		$msn = "Ocurrio un Error Durante la Actualizacion<br>$s1";
	}
}elseif($typ == 2){
	if(isset($_POST['idmod'])){
		$db->consulta("update mod_asis set asistio=3 where cedula='$_POST[idcancel]' and idmod=$_POST[idmod] ");
	}
	
	$s1 = $db->consulta("update event_asist set e_asistio=3, observa_admin='$_POST[mot]' where cedula='$_POST[idcancel]' and idevent=$_POST[ideve] ");
	
	$log ="El Usuario $_SESSION[iduser] IP $ip Cancelo la asistencia de $_POST[idcancel] al Evento $_POST[ideve]";
	$db->consulta("insert into log (fechalog,descripcion) values ('$fecha','$log') ");
	
	if( $s1 == 1){
		$sw = 1;
		$msn = "La Cancelacion se Realizo Correctamente.";
	}else{
		$sw = 2;
		$msn = "Ocurrio un Error Durante la Cancelacion";
	}
	
}elseif($typ == 3){
	$s1 = $db->consulta("update event_asist set idevent=$_POST[evento] where idevent=$ideve and cedula=$idrep ");
	if($s1 == 1){
		$sw = 1;
		$msn = "Los Datos Fueron Actualizados Correctamente.";
	}else{
		$sw = 2;
		$msn = "Ocurrio un Error Durante la Actualizacion<br>$s1";
	}
	
}


/*if(!isset($_SESSION['iduser'])){
$array = array("sw" => 2,"msn" => "Debes Volver a Iniciar Sesion");
$arrayj = json_encode($array);
echo $arrayj;
//exit;
}else{


//$i = $_POST['i'];
$ideve = $_POST['ideve'];
$idmod = $_POST['idmod'];

$nom =  mb_strtoupper($_POST['nombres1'], 'UTF-8');
$ape = mb_strtoupper($_POST['apellidos1'], 'UTF-8');
$car = mb_strtoupper($_POST['cargo1'], 'UTF-8');
$mail = mb_strtolower($_POST['mail1'], 'UTF-8');
$rsoc = mb_strtoupper($_POST['nomemp'], 'UTF-8');
$dir = mb_strtoupper($_POST['diremp'], 'UTF-8');
if( isset($_POST['idcancel']) ){
	if( $idmod != 0 ){
		$sw1 = $db->consulta("update event_asist set e_asistio=3 where cedula='$_POST[idcancel]' and idevent=$ideve ");
		$sw3 = $sw2 = $db->consulta("update mod_asis set asistio=3 where cedula='$_POST[idcancel]' and idevento=$ideve and idmod=$idmod ");
	}else{
		$sw = $db->consulta("update event_asist set e_asistio=3 where cedula='$_POST[idcancel]' and idevent=$ideve ");
	}
	
	$db->consulta("insert into log (fechalog,descripcion) values ('$fecha','El Usuario ".$_SESSION['iduser']." Realiza la cancelacion al evento $ideve del inscrito $_POST[idcancel] ')");
}

if( isset($_POST['docid1']) ){
$sw1 = $db->consulta("update asistentes set cedula='$_POST[docid1]',nombres='$nom',apellidos='$ape',email='$mail',tel='$_POST[tel1]',ext='$_POST[ext1]',cel='$_POST[cel1]',municipio='$_POST[muni1]',cargo='$car' where cedula='$_POST[oldced]' ");
$sw2 = $db->consulta("update empresa set nit='$_POST[idnit]',rsocial='$rsoc',dir='$dir' where nit='$_POST[oldnit]' ");
$sw3 = $db->consulta("update event_asist set cedula='$_POST[docid1]', nit='$_POST[idnit]' where cedula='$_POST[oldced]' ");

if( $idmod != 0 ){
		$sw4 = $db->consulta("update mod_asis set cedula='$_POST[docid1]' where cedula='$_POST[oldced]' ");
	}
	$db->consulta("insert into log (fechalog,descripcion) values ('$fecha','El Usuario ".$_SESSION['iduser']." Actualiza la Informacion del inscrito $_POST[docid1] ')");
}

if( isset($_POST['ced']) ){
	//$db->consulta("update ");
}

if ( $sw1 == 1 && $sw2 == 1 && $sw3 == 1 ){
	$sw = 1;
}


}*/

$array = array("sw" => $sw , "msn" => $msn);
$arrayj = json_encode($array);
echo $arrayj;
?>