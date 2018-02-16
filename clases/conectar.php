<?php
class conectar{
private $servidor = "localhost";
private$usuario = "root";
private$clave = "Ccas1992";
private$baseDatos = "ccasco_promo";
private $conexion;

function conectarbd(){
// Crear Conexion
$conn = new mysqli($this->servidor, $this->usuario, $this->clave,  $this->baseDatos);
$conn->set_charset("utf8");
$this->conexion = $conn;
// Verificar Conexion
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
return $conn;
}

function conectarbdInforme(){
// Crear Conexion
$conn = new mysqli($this->servidor, $this->usuario, $this->clave,  $this->baseDatos);
$this->conexion = $conn;
// Verificar Conexion
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
return $conn;
}

public function consulta($consulta){   
  $resultado = mysqli_query($this->conexion,$consulta);  
  if(!$resultado){  
  return $error = 'MySQL Error: ' . mysqli_error();  
  }
  return $resultado;
}
}
?>
