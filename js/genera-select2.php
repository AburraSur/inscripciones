<?php

$dbh = mysql_connect("localhost", "root", "Ccas1992");
$db = mysql_select_db("pedidos");

$consulta = "SELECT idarticulo, nombre from articulo WHERE tipo='MERK' order by nombre";
$query = mysql_query($consulta);
echo "<option value=\"\" selected>Seleccione</option>";
while ($fila = mysql_fetch_array($query)) {
     echo '<option value="'.$fila['idarticulo'].'" >'.$fila['nombre'].'</option>';
	 
}

?>