<?php

$dbh = mysql_connect("localhost", "root", "Ccas1992");
$db = mysql_select_db("pedidos");

$sqlt=mysql_query("select tipo from proveedor where idproveedor='$_GET[id]' ");
$rowt=mysql_fetch_array($sqlt);


$consulta = "SELECT idarticulo, nombre from articulo WHERE tipo ='$rowt[tipo]'";
$query = mysql_query($consulta);
echo "<option value=\"\">seleccione</option>";
while ($fila = mysql_fetch_array($query)) {
    echo '<option value="'.$fila['idarticulo'].'">'.$fila['nombre'].'</option>';
	 
};

?>