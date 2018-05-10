<?php
require("../class.conexion.php");

$db = new conn();

$tp = $_POST['tp'];

session_start();

$fecha = date("Y-m-d");

$ip = $db->getRealIP();

if( isset($_SESSION['iduser']) ){
	$varsesion = "$_SESSION[iduser] IP:$ip ";
}else{
	$varsesion = "Externo IP:$ip ";
}


if($tp==1){
	$ced=$_POST["docid1"];
	$regper = $db->consulta("select * from asistentes where cedula='$ced' ");
	$yaregper = $db->num_rows($regper);
	$nombres = utf8_decode(mb_strtoupper($_POST["nombres1"], 'UTF-8'));
	//$nombres=utf8_decode($_POST["nombres1"]);
	$apellidos = utf8_decode(mb_strtoupper($_POST["apellidos1"], 'UTF-8'));
	//$apellidos=utf8_decode($_POST["apellidos1"]);
	$mailx= mb_strtolower($_POST["mail1"], 'UTF-8');
	$tel=$_POST["tel1"];
	$ext=$_POST["ext1"];
	$cel=$_POST["cel1"];
	$muni=$_POST["muni1"];
	$cargo=$_POST["cargo1"];
	$coment = $_POST["coment1"];
	$habeas = $_POST["habeas1"];
	$who = $_POST["who1"];
	if($yaregper==0){
		$sw = $db->consulta("insert into asistentes (cedula,nombres,apellidos,email,tel,ext,cel,municipio,cargo,comentario,habeas,who) values ('$ced','$nombres','$apellidos','$mailx','$tel','$ext','$cel','$muni','$cargo','$coment','$habeas','$who')");
	
		$log = "El Usuario $varsesion creo el asistente $ced desde el modulo de opciones avanzadas";
	}else{
		$sw=2;
	}
	
	
	
}elseif($tp==2){
	$nit="$_POST[nit]";
	$comentg = utf8_decode(mb_strtoupper($_POST['observa'], 'UTF-8'));
	$diremp = utf8_decode(mb_strtoupper($_POST['diremp'], 'UTF-8'));
	$regempresa = $db->consulta("select * from empresa where nit='$nit' ");
	$yaregempre = $db->num_rows($regempresa);
	$nomemp = utf8_decode(mb_strtoupper($_POST['nomemp'], 'UTF-8'));
	if($yaregempre == 0){
		$sw = $db->consulta("insert into empresa (nit,rsocial,dir,comentario) values ('$nit','$nomemp','$diremp','$comentg')");				
		$log = "El Usuario $varsesion creo la empresa $nit desde el modulo de opciones avanzadas ";
	}else{
		$sw=2;
	}
}elseif($tp==3){
	$sqlemp = $db->consulta("select * from empresa where nit='$_POST[nit]'");
	$numepm = $db->num_rows($sqlemp);
	if($numepm>0){
		$sw = $db->consulta("update event_asist set nit='$_POST[newnit]' where nit='$_POST[nit]' and cedula='$_POST[cedpart]' and idevent=$_POST[eventch] ");
		
		$rowpay = $db->consulta2("select pago from evento where idevento=$_POST[eventch] ");
		if($rowpay[0]==1){
			$db->consulta("update pagos set nit='$_POST[newnit]' where nit='$_POST[nit]' and cedula='$_POST[cedpart]' and idevento=$_POST[eventch]");
		}
		$log = "El Usuario $varsesion realiza el cambio de relacion empresarial del participante $_POST[cedpart] de la empresa  $_POST[nit] a la empresa $_POST[newnit] desde el modulo de opciones avanzadas";
		
	}else{
		$sw=3;
		
	}
}elseif($tp==4){
	$user = utf8_decode(mb_strtoupper($_POST['user'], 'UTF-8'));
	$nomuser = utf8_decode(mb_strtoupper($_POST['nomuser'], 'UTF-8'));
	$sqluser = $db->consulta("select * from usuario where iduser=$_POST[iduser]");
	$numuser = $db->num_rows($sqluser);
	if($numuser > 0){
		$sw = 5;
		$msn = "El Usuario con Identificacion $_POST[iduser] ya esta registrado en el sistema.";
	}else{
		if($_POST['newpass'] == $_POST['rnewpass']){
			$sqlus = $db->consulta("select * from usuario where user='$user' ");
			$numus = $db->num_rows($sqlus);
			if($numus > 0){
				$sw = 5;
				$msn = "El Usuario $user esta en uso. ";
			}else{
				if($_POST['perfil'] != 5){
					$sw = $db->consulta("insert into usuario (iduser,user,pass,nombre,estado,perfil) values ('$_POST[iduser]','$user','$_POST[newpass]','$nomuser','ACTIVO','$_POST[perfil]') ");
					$log = "El Usuario $varsesion creo el nuevo usuario $_POST[iduser] - $user ";
				}else{
					$sw = 5;
					$msn = "Debe seleccionar un perfil de usuario";
				}
				
			}
		}else{
			$sw = 5;
			$msn = "Las Contraseñas no Coinciden. Por favor verificarlas";
		}
	}
}elseif($tp==5){
    $sw = $db->consulta("update pagos set tarifa='$_POST[tarifaEvento]' where cedula='$_POST[idpartTarifa]' and idevento=$_POST[eventoTarifa] ");
    $log = "El Usuario $varsesion cambio la tarifa para la cedula='$_POST[idpartTarifa]' and idevent=$_POST[eventoTarifa]";
}elseif($tp==6){
    $log = "El Usuario $varsesion cambio la tarifa ";
    for($i=1;$i<=3;$i++){
        $categoria = $_POST["tar$i"];
        $valorCampo = "tar$i".$_POST["tar$i"];
        $tarifa = $_POST[$valorCampo];
        $sw = $db->consulta("update tarifas_evento set valor=$tarifa where categoria='".$categoria."' and idevento=".$_POST['idEventotarifa']." ");
        $log.= "$categoria = $tarifa para el evento idevent=$_POST[idEventotarifa] - ";
    }
}


if($sw==1){
	$msn = "El Registro fue Exitoso";	
		$db->consulta("insert into log (fechalog,descripcion) values ('$fecha','$log')");
}elseif($sw==2){
	$msn = "Estos Datos ya se Encuentran Registrados en el Sistema";
}elseif($sw==3){
	$msn = "La Empresa con la cual se desea relacionar el participante no esta registrada en el sistema.";
}elseif($sw==5){
	$mm = 1;//relleno
}else{
	$msn = "Ocurrio un Problema durante el registro, por favor comuniquese con el administrador del sistema";
}

$array = array("sw" => $sw , "msn" => $msn);
echo json_encode($array);

?>