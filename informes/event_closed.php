<?php

require_once("excel.php");
require_once("excel-ext.php");



$conEmp = mysql_connect("localhost", "root", "Ccas1992");
mysql_select_db("ccasco_promo", $conEmp);

$sql = "SELECT ev.nom_evento ,a.cedula ,a.nombres ,a.apellidos ,a.email ,a.tel ,a.cel ,a.municipio ,a.cargo ,e.nit ,e.rsocial ,e.dir ,e.comentario ,ea.e_asistio 
FROM asistentes a inner join empresa e inner join event_asist ea inner join evento ev
WHERE ea.nit=e.nit
AND ea.cedula=a.cedula
AND ea.idevent=ev.idevento
AND ea.idevent=$_GET[cod]";

$resEmp = mysql_query($sql, $conEmp) or die(mysql_error());



while($datatmp = mysql_fetch_assoc($resEmp)) {
   $data[] = $datatmp;
}
mysql_close($link);

createExcel("evento53.xls", $data);
exit;


?>