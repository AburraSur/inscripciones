<?php

require_once("excel.php");
require_once("excel-ext.php");



$conEmp = mysql_connect("localhost", "root", "Ccas1992");
mysql_select_db("ccasco_promo", $conEmp);

$sql = "
	SELECT e.rsocial,a.tel,a.nombres,a.apellidos,p.vlrpago,p.formapago,p.nrotran,p.fectrans,p.nrorecibo,p.fecrecibo,p.tarifa,p.observa 
	FROM  `empresa` e
INNER JOIN asistentes a
INNER JOIN pagos p
INNER JOIN event_asist ea
WHERE p.nit = e.nit
AND p.cedula=ea.cedula
AND a.cedula=p.cedula
AND p.tarifa <> 'Invitado'
AND ea.e_asistio <> 3
AND p.idevento=ea.idevent
AND p.idevento =$_GET[idev]
ORDER BY e.`rsocial` ASC ";

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