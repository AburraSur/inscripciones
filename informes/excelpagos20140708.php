<?php

require_once("excel.php");
require_once("excel-ext.php");



$conEmp = mysql_connect("localhost", "root", "Ccas1992");
mysql_select_db("ccasco_promo2017", $conEmp);

$sql = "SELECT e.rsocial,a.tel,a.nombres,a.apellidos,p.vlrpago,p.formapago,p.nrotran,p.fectrans,p.nrorecibo,p.fecrecibo,p.tarifa,p.observa FROM empresa e inner join asistentes a inner join pagos p WHERE e.nit=p.nit and a.cedula=p.cedula and p.idevento=$_GET[idev] order by rsocial ASC";

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