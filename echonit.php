<?php
require_once 'clases/conectar.php';
//conexion Promo
$linked = new conectar();
$link = $linked->conectarbd();
//conexion SII
$servidor = "192.168.1.63";
$usuario = "desarrollo";
$clave = "d3s4rr0ll0";
$baseDatos = "sii_55";

$conn = new mysqli($servidor, $usuario, $clave,  $baseDatos);
// Verificar Conexion a SII
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$eventoid = $_GET['cod'];
$sqlpagos = "select matricula from esal";
if($resultadopago = $link->query($sqlpagos) or trigger_error(mysqli_error($link))){}
while($rowpago = $resultadopago->fetch_array()){

//echo $tabla;
if($resEmp = $link->query($sql) or trigger_error(mysqli_error($link))){}

    while($row = $resEmp->fetch_array()){
    $nit = $row['matricula'];
    $activos = "SELECT idereplegal, nomreplegal FROM `mreg_est_matriculados` WHERE  `matricula` = '%$nit%'";
    if ($datosA = $conn->query($activos) or trigger_error(mysqli_error($conn))){}
    $datosActivos = $datosA->fetch_array();
    $cedula = $datosActivos['idereplegal'];
    $nombreRlegal = $datosActivos['nomreplegal'];
    $query = "UPDATE `esal` SET `cedularlegal`='$cedula',`rLegal`='$nombreRlegal' WHERE matricula = '$nit'";
    
}
    
}
mysqli_close($link);
echo $tabla;
?>