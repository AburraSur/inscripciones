<?php


//conexion SII
$servidorSII = "192.168.1.26";
$usuarioSII = "consulta_sii";
$claveSII = "C0nsult@.123";
$baseDatosSII = "sii_aburra";

$conn = new mysqli($servidorSII, $usuarioSII, $claveSII,  $baseDatosSII);
// Verificar Conexion a SII

// Verificar Conexion
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
//cambio de caracteres
if (!$conn->set_charset("utf8")) {
    printf("Error cargando el conjunto de caracteres utf8: %s\n", $conn->error);
    exit();
}

$year = 'all';

$conEmp = mysql_connect("localhost", "root", "Ccas1992");
mysql_select_db("ccasco_promo2017", $conEmp);


$actYear = date('Y');

/*$conEmp = mysql_connect("localhost", "root", "Ccas1992");
mysql_select_db("promo", $conEmp);*/
$sql = "SELECT *
FROM empresa 
WHERE ultanoren != '$actYear'";

$resEmp = mysql_query($sql, $conEmp) or die(mysql_error());

/*$activos = "SELECT matricula, acttot,ciiu1, fecrenovacion, ctrafiliacion, estmatricula, ultanoren FROM `mreg_est_matriculados` WHERE  `numid` LIKE  '3524005'";
    $datosA = $conn->query($activos);
	$datosActivos = $datosA->fetch_array();
	echo $ultanoren = $datosActivos['ultanoren'];*/
$contR = 1;
while($row = mysql_fetch_array($resEmp)) {
    $nit = $row['nit'];
    $activos = "SELECT matricula, acttot,ciiu1, fecrenovacion, ctrafiliacion, estmatricula, ultanoren FROM `mreg_est_matriculados` WHERE `organizacion` != 02 and `categoria` != 03 and `categoria` != 02 and estmatricula != 'NA' and estmatricula != 'NN' and `numid` LIKE  '%$nit%'";
    //if ($datosA = $conn->query($activos) or trigger_error(mysqli_error($conn))){}
	$datosA = $conn->query($activos);
    $datosActivos = $datosA->fetch_array();
    $activo = $datosActivos['acttot'];
    $fechaR = $datosActivos['fecrenovacion'];
    $ciiu = $datosActivos['ciiu1'];
	$ultanoren = $datosActivos['ultanoren'];
	$afilia = $datosActivos['ctrafiliacion'];
    if($row['ultanoren'] != $actYear and  $ciiu !=''){
		if($activo == ''){
			$activo='N/A';
		}
		
		if($fechaR == ''){
			$fechaR='N/A';
		}
		if($ciiu == ''){
			$ciiu='N/A';
		}
		if($ultanoren == ''){
			$ultanoren='N/A';
		}
		if($afilia == ''){
			$afilia='9';
		}
		
		$sqlQ = "UPDATE empresa SET activos='$activo', fechaRenovado='$fechaR', ultanoren='$ultanoren', afiliado='$afilia' WHERE nit='$nit' ";
		$upQuery = mysql_query($sqlQ, $conEmp) or die(mysql_error());
		
	echo $datosActivos['ultanoren']."---$nit---ciiu=$ciiu-----$contR<br>";
	}	
	$contR++;
}
mysql_close($conEmp);

?>