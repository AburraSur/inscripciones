<?php

require("../class.conexion.php");



$db = new conn();



$eve = $_POST['event'];



$sql = $db->consulta("select modulos from evento where idevento=$eve ");

$pago = $db->consulta("select pago from evento where idevento=$eve ");

$row = $db->fetch_array($sql);
$rowpay = $db->fetch_array($pago);


$array = array ( "resp" => $row['modulos'] ,"pago" => $rowpay['pago'] );

$arrayj = json_encode($array);

echo $arrayj;



?>