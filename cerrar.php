<?php
session_start();
session_destroy();
$conexion = mysql_connect("localhost", "root", "Ccas1992");
mysql_select_db("ccasco_promo", $conexion);
mysql_close($conexion);
header("Location: ./");
?>