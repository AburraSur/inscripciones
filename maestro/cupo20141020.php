<?php

require("../class.conexion.php");

$id = $_GET['id'];

$db = new conn();

$ideve = $db->consulta("select * from evento where idevento=$id ");

$row = $db->fetch_array($ideve);


echo $row['cupo'];
?>