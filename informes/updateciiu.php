<?php

require_once '../clases/conectar.php';
//conexion promo
$linked = new conectar();
$link = $linked->conectarbdInforme();
//conexion SII
$servidorSII = "192.168.1.26";
$usuarioSII = "consulta_sii";
$claveSII = "C0nsult@.123";
$baseDatosSII = "sii_aburra";

$conn = new mysqli($servidorSII, $usuarioSII, $claveSII,  $baseDatosSII);
// Verificar Conexion a SII
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$sql = "SELECT *
FROM `empresa`
WHERE `ciiu` = ''
OR `ciiu` = NULL ";
//manejo de modulos



		

//echo $tabla;
if($resEmp = $link->query($sql) or trigger_error(mysqli_error($link))){}

    while($row = $resEmp->fetch_array()){
    $nit = $row['nit'];
    $activos = "SELECT matricula, acttot,ciiu1, fecrenovacion FROM `mreg_est_inscritos` WHERE `organizacion` != 02 and `categoria` != 03 and `categoria` != 02 and ctrestmatricula != 'NA' and ctrestmatricula != 'NN' and `numid` LIKE  '%$nit%'";
    if ($datosA = $conn->query($activos) or trigger_error(mysqli_error($conn))){}
    $datosActivos = $datosA->fetch_array();
    $activo = $datosActivos['acttot'];
    $fechaR = $datosActivos['fecrenovacion'];
    $ciiu = $datosActivos['ciiu1'];
    //$activo = 0;
    //$fechaR = "";
    echo "UPDATE empresa SET ciiu='$ciiu' WHERE nit='$nit' NIT $nit CIIU $ciiu<br>";
	$linked->consulta("UPDATE empresa SET ciiu='$ciiu' WHERE nit='$nit'");
    
}

mysqli_close($link);
echo $tabla;
?>