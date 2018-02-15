<?php

$dbh = mysql_connect("localhost", "root", "Ccas1992");
$db = mysql_select_db("pedidos");

$consulta = "SELECT * from articulos WHERE idproveedor = ".$_GET['id'];
$query = mysql_query($consulta);
echo "<option value=\"\">seleccione</option>";
while ($fila = mysql_fetch_array($query)) {
    echo '<option value="'.$fila['codmuni'].'">'.$fila['municipio'].'</option>';
	 
};

?>