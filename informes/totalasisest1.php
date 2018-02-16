<?php

require_once("excel.php");
require_once("excel-ext.php");



$conEmp = mysql_connect("localhost", "root", "Ccas1992");
mysql_select_db("ccasco_promo", $conEmp);

/*$conEmp = mysql_connect("localhost", "root", "Ccas1992");
mysql_select_db("promo", $conEmp);*/
$sql = "SELECT ev.idevento 'Cod.Evento', ev.nom_evento 'EVENTO', em.nit 'NIT', em.rsocial 'RSOCIAL', at.cedula 'CEDULA', at.nombres 'NOMBRES', at.apellidos 'APELLIDOS', at.email 'e-mail', at.tel 'TEL',at.ext 'EXT',at.cel 'CEL',at.municipio 'MUNICIPIO',at.cargo 'CARGO',ea.e_asistio 'ASISTIO'
FROM evento ev
INNER JOIN empresa em
INNER JOIN asistentes at
INNER JOIN event_asist ea
WHERE ea.cedula = at.cedula
AND ea.nit = em.nit
AND ea.idevent = ev.idevento
AND ea.e_asistio=1
ORDER BY ev.idevento ASC ";

$resEmp = mysql_query($sql, $conEmp) or die(mysql_error());
$totEmp = mysql_num_rows($resEmp);
$eve = mysql_fetch_array($resEmp);

while($datatmp = mysql_fetch_assoc($resEmp)) {
   $data[] = $datatmp;
}
mysql_close($link);

createExcel("TotalAsistentes.xls", $data);
exit;


?>