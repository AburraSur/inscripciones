<?php

require_once("excel.php");
require_once("excel-ext.php");



$conEmp = mysql_connect("localhost", "root", "Ccas1992");
mysql_select_db("ccasco_promo", $conEmp);

$sql = "SELECT ev.nom_evento 'EVENTO',a.cedula 'CEDULA',ea.id 'CODIGO',a.nombres 'NOMBRES',a.apellidos 'APELLIDOS',a.email 'CORREO ELECTRONICO',a.tel 'TELEFONO',a.ext 'EXT',a.cel 'CELULAR',a.municipio 'MUNICIPIO',a.cargo 'CARGO',e.nit 'NIT',e.rsocial 'EMPRESA',e.dir 'DIRECCION EMPRESA',e.comentario 'COMENTARIO', ea.e_asistio 'ASISTIO',a.comentario 'COMENTARIO'
FROM asistentes a inner join empresa e inner join event_asist ea inner join evento ev
WHERE ea.nit=e.nit
AND ea.cedula=a.cedula
AND ea.idevent=ev.idevento
AND ea.idevent=$_GET[cod]";

$resEmp = mysql_query($sql, $conEmp) or die(mysql_error());
$resEmp2 = mysql_query($sql, $conEmp) or die(mysql_error());
//$totEmp = mysql_num_rows($resEmp2);
$eve = mysql_fetch_array($resEmp2);

while($datatmp = mysql_fetch_assoc($resEmp)) {
   $data[] = $datatmp;
}

mysql_close($link);

createExcel("AsistenciaEvento$_GET[cod].xls", $data);

exit;


?>