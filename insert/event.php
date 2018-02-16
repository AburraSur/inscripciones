<?php
/*
$conexion = mysql_connect("localhost", "root", "Ccas1992");
mysql_select_db("promo", $conexion);
*/
session_start();

include("../class.conexion.php");

$db = new conn();

$sw=0;

$date = date("Y-m-d");



if($_POST['namevent'] != null && $_POST['finicio'] != null && $_POST['fcierre'] != null && $_POST['cupo'] != null){
 
$event = utf8_decode(mb_strtoupper($_POST['namevent'], 'UTF-8'));
$lugar = utf8_decode(mb_strtoupper($_POST['lugar'], 'UTF-8'));
$var_cert = utf8_decode($_POST[certvar]);
$place = utf8_decode($_POST[place_exp]);
$consulta = $db->consulta("insert into evento (nom_evento,fec_event,fec_pago,fec_inicio,fec_fin,fec_exp,hora,lugar,place_exp,estado,image,cupo,respon,mailresp,modulos,total_asist_certifica,pago,var_certi,tipo_evento,ct_evento,fuente,firma,sendEmail) values ('$event','$_POST[fecevent]','$_POST[fecpago]','$_POST[finicio]','$_POST[fcierre]','$_POST[fec_exp]','$_POST[hevent]','$lugar','$place','ACTIVO','$_POST[nomf]',$_POST[cupo],'$_POST[respon]','$_POST[mailresp]','$_POST[modulo]','$_POST[totalasistcert]',$_POST[pago],'$var_cert',$_POST[tpevento],$_POST[ctevento],18,'$_POST[nomfir]','$_POST[sendEmail]]');");

$sqleve = $db->consulta("select * from evento where nom_evento='$event' AND fec_event='$_POST[fecevent]' ");
$roweve = $db->fetch_array($sqleve);

if($consulta && $_POST['pago']){
    $db->consulta("insert into tarifas_evento (idevento,categoria,valor) values (".$roweve['idevento'].",'Afiliado',".$_POST['tarifaAfiliados']." )");
    $db->consulta("insert into tarifas_evento (idevento,categoria,valor) values (".$roweve['idevento'].",'Matriculado',".$_POST['tarifaMatriculados']." )");
    $db->consulta("insert into tarifas_evento (idevento,categoria,valor) values (".$roweve['idevento'].",'Particular',".$_POST['tarifaParticulares']." )");
}

if( $_POST['modulo'] == 'SI' ){
	$ctrlmod = $_POST['ctrlmod'];
	
	
	
	
	
	for($i=1;$i<=$ctrlmod;$i++){
		$db->consulta("insert into modulos (modulo,fec_mod,idevento) values ('".$_POST["modu$i"]."','".$_POST["fmod$i"]."',".$roweve['idevento'].") ");
	}
	
}

$db->consulta("insert into log (fechalog,descripcion) values ('$date','El Usuario $_SESSION[iduser] creo el Evento $event ')");

$sqlmax = $db->consulta("SELECT idevento as idevent FROM `evento` where nom_evento='$event' AND fec_event='$_POST[fecevent]' ;");
  $row = $db->fetch_array($sqlmax);
$sw=1;

}


if($sw == 1){
$array = array ( "enviar" => 1 , "capa" => "$row[idevent]" , "mysql" => $consulta );
$arrayj = json_encode($array);
echo $arrayj;
}else{
$array = array ( "enviar" => 2 , "capa" => 2 );
$arrayj = json_encode($array);
echo $arrayj;
}



$db->cerrar();
//mysql_close($conexion);

?>