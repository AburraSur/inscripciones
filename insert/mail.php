<?php

$ideve=$_GET['cod'];

//$ideve=389;

include("../class.conexion.php");  
 $db = new conn();  
  $consulta = $db->consulta("select * from evento where idevento=$ideve ;");  
  $row=$db->fetch_array($consulta);
  
$correo="<p style='font-family:Arial;font-size:12px;line-height:16px;'>
	<center><strong>INFORMACION DEL EVENTO</strong></center><br /><br />
	<strong>Nombre del Evento: </strong> $row[nom_evento]<br /><br />
	<strong>Fecha Inicio de Inscripciones:</strong> $row[fec_inicio]<br /><br />
	<strong>Fecha Cierre de Inscripciones:</strong> $row[fec_fin]<br /><br />
	<strong>Link del Formulario de Inscripcion:</strong> http://apps.ccas.org.co/inscripciones/maestro/confor3.php?cod=$ideve<br /><br />";
	require_once('class.phpmailer.php');
	$mail = new PHPMailer();
	$mail->IsSMTP();
	$mail->SMTPAuth = true;
	$mail->SMTPSecure = "tls";
	$mail->Host       = "host273.hostmonster.com";
	//$mail->Host       = "192.168.1.20";
	$mail->Port       = 25;
	//$mail->Username = "inscripciones@ccas.co";
	$mail->Username = "inscripciones@ccas.org.co";
	//$mail->Password = "Ccas2010";
	$mail->Password = "ccas2010";
	$body = "<html><head><style>p{font-family:Arial;font-size:12px}</style></head><body>$correo</body>";
	$mail->SetFrom("inscripciones@ccas.co","Inscripciones Aburra Sur");
	
	if( $row['respon'] == 1 ){
	$mail->AddCC("auditorios@ccas.org.co", "Inscripcions a Eventos");
	$mail->AddCC("eventos@ccas.org.co", "Inscripcions a Eventos");
	
	}else{	
		$mail->AddAddress("$row[mailresp]", "Zeiky CCAS");
	}
	
	$mail->Subject = "Inscripciones Evento:";
	$mail->MsgHTML($body);
	$mail->Send();



?>