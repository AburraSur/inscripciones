<?php

include('../conexion.php');
/*
$consulta = "SELECT * FROM articulo WHERE tipo='PAPEL' order by nombre  ";
$query = mysql_query($consulta);
echo "<option value=\"\" selected>Seleccione</option>";
while ($fila = mysql_fetch_array($query)) {
     echo '<option value="'.$fila['idarticulo'].'" >'.$fila['nombre'].'</option>';
	 
}
*/

$tipo=$_GET[id];

if($tipo == 'PAPELERIA'){
echo "<option value=\"\">Seleccione</option>
<option value=\"ADMIN\">ADMINISTRATIVA</option>
<option value=\"JURI\">JURIDICA</option>
<option value=\"PRESI\">PRESIDENCIA</option>
<option value=\"PROMO\">PROMOCION</option>
<option value=\"SISTE\">SISTEMAS</option>";
}else{
$sql=mysql_query("select idusuario, usuario from usuario where perfil='VIV' ");
echo "<option value=\"\">Seleccione</option>";
while($rowv=mysql_fetch_array($sql)){
echo "<option value=$rowv[idusuario] >$rowv[usuario]</option>
";
}
}
?>