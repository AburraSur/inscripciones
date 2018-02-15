<?php

/*
$conexion = mysql_connect("localhost", "root", "Ccas1992");
mysql_select_db("promo", $conexion);
*/

include("../class.conexion.php");  
 $db = new conn();  
  $consulta = $db->consulta("SELECT * FROM usuario;");  
  $sw=0;
    $user=$_POST['user'];
$pass=$_POST['pass'];
  while($resultados = $db->fetch_array($consulta)){  
	if($resultados['user']==$user && $resultados['pass']==$pass && $resultados['estado']=='ACTIVO' ){
		$codigo= $resultados['iduser'];
		$perfil= $resultados['perfil'];
		session_start ();
		$_SESSION['iduser']=$codigo;
		$_SESSION['perfil']=$perfil;

		$sw=1;
		}
  }  



$array = array ( "enviar" => $sw, "perfil" => $perfil, "user" => $codigo );
$arrayj = json_encode($array);
echo $arrayj;


$db->cerrar();  
//mysql_close($conexion);

?>