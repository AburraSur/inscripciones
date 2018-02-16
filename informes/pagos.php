<?php

require_once("excel.php");
require_once("excel-ext.php");



$conEmp = mysql_connect("localhost", "root", "Ccas1992");
mysql_select_db("ccasco_promo", $conEmp);

$sql = "SELECT ev.nom_evento 'EVENTO',e.nit 'NIT',e.rsocial 'EMPRESA',a.cedula 'CEDULA',a.nombres 'NOMBRES',a.apellidos 'APELLIDOS',a.tel 'TELEFONO',p.tarifa 'TARIFA',p.vlrpago 'VALOR PAGO',p.formapago 'FORMA DE PAGO',p.nrotran 'NUMERO DE TRANSACCION',p.fectrans 'FECHA DE TRANSACCION',p.nrorecibo 'Nro RECIBO',p.fecrecibo 'FECHA RECIBO',p.observa 'OBSERVACION'
FROM asistentes a inner join empresa e inner join pagos p inner join evento ev
WHERE p.nit=e.nit
AND p.cedula=a.cedula
AND p.idevento=ev.idevento
AND p.idevento=$_GET[cod]";

$resEmp = mysql_query($sql, $conEmp) or die(mysql_error());
//$resEmp2 = mysql_query($sql, $conEmp) or die(mysql_error());
//$totEmp = mysql_num_rows($resEmp2);
//$eve = mysql_fetch_array($resEmp2);

while($datatmp = mysql_fetch_assoc($resEmp)) {
   $data[] = $datatmp;
}

mysql_close($link);

createExcel("PagosEvento$_GET[cod].xls", $data);

exit;


?>