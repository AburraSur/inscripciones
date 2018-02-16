<?php  
class conn{  
 private $conexion;  
 private $conexion2;  
  private $total_consultas;  
 public function conn(){  
  if(!isset($this->conexion)){  
  $this->conexion = (mysql_connect("localhost","root","Ccas1992")) or die(mysql_error());  
  mysql_select_db("ccas_perfilcargo",$this->conexion) or die(mysql_error());  
  }  
  }  
 public function consulta($consulta){  
  $this->total_consultas++;  
  $resultado = mysql_query($consulta,$this->conexion);  
  if(!$resultado){  
  return $error = "MySQL Error: " . mysql_error();  
  exit;  
  }  
  return $resultado;   
  }  
  
  public function consulta2($consulta){  
  $this->total_consultas++;  
  $resultado = mysql_query($consulta,$this->conexion); 
  $resultado2 = mysql_fetch_array($resultado);
  if(!$resultado2){  
   return 0; 
  }  
  return $resultado2;   
  }  
  
  public function consultarow($consulta){  
  $this->total_consultas++;  
  $resultado = mysql_query($consulta,$this->conexion); 
  $resultado2 = mysql_num_rows($resultado);
  if(!$resultado2){  
  echo 'MySQL Error: ' . mysql_error();  
  exit;  
  }  
  return $resultado2;   
  }  
  
 public function fetch_array($consulta){   
  return mysql_fetch_array($consulta);  
  }  
 public function num_rows($consulta){   
  return mysql_num_rows($consulta);  
  } 
  public function fetch_assoc($consulta){   
  return mysql_fetch_assoc($consulta);  
  }  
 public function getTotalConsultas(){  
  return $this->total_consultas;  
  } 

public function cerrar(){

  $conexion2 = (mysql_connect("localhost","root","Ccas1992")) or die(mysql_error());  
  mysql_select_db("ccasco_promo",$conexion2) or die(mysql_error());  
   mysql_close($conexion2) ;  
  
   
}  

public function getRealIP() {
    if (!empty($_SERVER['HTTP_CLIENT_IP']))
        return $_SERVER['HTTP_CLIENT_IP'];
       
    if (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
        return $_SERVER['HTTP_X_FORWARDED_FOR'];
   
    return $_SERVER['REMOTE_ADDR'];
}

}


?>  