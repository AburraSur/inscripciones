<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of activos
 *
 * @author AuxSistemas
 */
class activos {
private $servidor = "192.168.1.63";
private$usuario = "desarrollo";
private$clave = "d3s4rr0ll0";
private$baseDatos = "sii_55";
private $link;
private $servidor2 = "localhost";
private$usuario2 = "root";
private$clave2 = "Ccas1992";
private$baseDatos2 = "ccasco_promo";
private $link2;

function activos(){
// Crear Conexion
$conn = new mysqli($this->servidor, $this->usuario, $this->clave,  $this->baseDatos);

// Verificar Conexion
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
$this->link = $conn;

$cxn = new mysqli($this->servidor2, $this->usuario2, $this->clave2,  $this->baseDatos2);

// Verificar Conexion
if ($cxn->connect_error) {
    die("Connection failed: " . $cxn->connect_error);
} 
$this->link = $cxn;
print "conexcion lista";
    $empresa = "SELECT * FROM empresa LIMIT 1501 , 2500";
    $datosEmpresa = $cxn->query($empresa);
    while($result = $datosEmpresa->fetch_array()){
          $nit = $result['nit']; 
          $activos = "SELECT matricula, acttot, fecrenovacion FROM `mreg_est_matriculados` WHERE `organizacion` != 02 and `categoria` != 03 and `categoria` != 02 and estmatricula != 'NA' and estmatricula != 'NN' and `nit` LIKE  '%$nit%'";
          $datosA = $conn->query($activos);
          $datosActivos = $datosA->fetch_array();
          $activo = $datosActivos['acttot'];
          $fechaR = $datosActivos['fecrenovacion'];
          $actualizar = "UPDATE `empresa` SET `activos`='$activo',`fechaRenovado`='$fechaR'WHERE nit = '$nit'";
          $cxn->query($actualizar);
          print "$nit, $activo, $fechaR <br>";
      }
}

}
$var = new activos;


