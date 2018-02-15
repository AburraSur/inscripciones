<?php
require("../class.conexion.php");

$db = new conn();

for ( $i=1; $i<$_POST['ctrlidev'];$i++){
if( $_POST["idpay$i"] > 0 ){
	$db->consulta("update pagos set vlrpago=".$_POST["vlrpago$i"].", formapago='".$_POST["formapago$i"]."', nrotran='".$_POST["nrotran$i"]."',numeroOperacion='".$_POST["numeroOperacion$i"]."', fectrans='".$_POST["fectrans$i"]."', nrorecibo='".$_POST["nrorecibo$i"]."', fecrecibo='".$_POST["fecrecibo$i"]."',observa='".$_POST["observa$i"]."' where idpago=".$_POST["idpay$i"]." ");
}
if( $_POST["idevento$i"] != null ){
	$db->consulta("insert into pagos (vlrpago,formapago,nrotran,numeroOperacion,fectrans,nrorecibo,fecrecibo,observa,nit,idevento) values (".$_POST["vlrpago$i"].",'".$_POST["formapago$i"]."','".$_POST["nrotran$i"]."','".$_POST["numeroOperacion$i"]."','".$_POST["fectrans$i"]."','".$_POST["nrorecibo$i"]."','".$_POST["fecrecibo$i"]."','".$_POST["observa$i"]."','".$_POST["nit$i"]."',".$_POST["idev"].")");

}

}


$array = array( "idev" => $_POST["idev"] );
$arrayj = json_encode($array);
echo $arrayj;


?>