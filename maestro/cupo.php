<?php

require("../class.conexion.php");

$id = $_GET['idevent'];
$nit = $_GET['nit'];

$db = new conn();

$cupo = $db->consulta2("select cupo from evento where idevento=$id ");
$cupousados = $db->consulta2("select COUNT(id) from event_asist where nit=$nit AND idevent=$id ");

$disponibles = ($cupo[0]-$cupousados[0]);

echo json_encode(array("sw" => $disponibles , "cupo" => $cupo[0] , "usados" => $cupousados[0]));
?>