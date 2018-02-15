<?php
/*
$conexion = mysql_connect("localhost", "root", "Ccas1992");
mysql_select_db("promo", $conexion);
*/
session_start();
include("../class.conexion.php");
$db = new conn();


$sw=0;
$date=date("Y-m-d");

$sql=$db->consulta("select nom_evento from evento where idevento=$_POST[closed] ;");
$row=$db->fetch_array($sql);

if($_POST[closed] != null){
//unlink("../img/uploads/$row[image]");
$db->consulta("update evento set estado='CERRADO' where idevento=$_POST[closed] ;");
$db->consulta("insert into log (fechalog,descripcion) values ('$date','El Usuario $_SESSION[iduser] Cerro el Evento $_POST[closed] ')");

$sw=1;

}



if($sw == 1){
$array = array ( "enviar" => 1 , "capa" => "$row[nom_evento]" );
$arrayj = json_encode($array);
echo $arrayj;
}else{
$array = array ( "enviar" => 2 , "capa" => "$row[nom_evento]" );
$arrayj = json_encode($array);
echo $arrayj;
}

mysql_close($conexion);

?>