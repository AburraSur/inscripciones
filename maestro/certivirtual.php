<?php
require('./class.phpmailer.php');
require('../class.conexion.php');

$db = new conn();

$id = $_GET['id'];
$ideve = $_GET['ideve'];

$rowmail = $db->consulta2("select nom_evento from evento where idevento=$ideve ");
$participante = $db->consulta2("select nombres,apellidos,email from asistentes where cedula=$id ");

$correo="<p style='font-family:Arial;font-size:12px;line-height:16px;align:justify'>Se&ntilde;or Usuario, su certificado de asistencia al evento $rowmail[nom_evento], se encuentra disponible para su descarga en el siguiente link: http://inscripciones.ccas.co/certificados/virtuales/?ideve=$ideve&idasis=$id 
<br><br>
</p>
<p><b><i>Por favor no contestar a este mensaje, ha sido enviado desde una cuenta autom&aacute;tica y no recibir&aacute; respuesta.</i></b></p>";
					$i = 1;
					
					$mail = new PHPMailer();
					$mail->IsSMTP();
					$mail->SMTPAuth = true;
					$mail->SMTPSecure = "tls";
					//$mail->Host       = "190.248.151.10";
					$mail->Host       = "host416.hostmonster.com";
					//$mail->Host       = "192.168.1.20";
					$mail->Port       = 25;
					$mail->Username = "inscripciones@ccas.co";
					$mail->Password = "Ccas2010";
					$body = "<html><head><style>p{font-family:Arial;font-size:12px}</style></head><body>$correo</body>";
					$mail->SetFrom("inscripciones@ccas.co","Inscripciones Eventos Aburra Sur");
					
						$nom = utf8_decode(mb_strtoupper($participante["nombres"], 'UTF-8'));
						$ape = utf8_decode(mb_strtoupper($participante["apellidos"], 'UTF-8'));
						$compl="$nom $ape";
						
					$mail->AddAddress("$participante[email]", "$compl");
					$mail->AddAddress("inscripciones@ccas.org.co", "Inscripciones");
					$mail->Subject = "Certificado Virtual";
					$mail->MsgHTML($body);
					//$mail->Send();
					if(!$mail->Send()){
							$sw = 2;
							$mensaje = "Ocurrio un Problema Durante El Envio de el certificado. Favor Verificar en su Bandeja de Correo ";
							$db->consulta("update event_asist set certifica=2 where cedula=$id AND idevent=$ideve ");
						}else{
							$sw = 1;
							$mensaje = "Envio Exitoso";
							
						}
		echo json_encode(array("sw" => $sw , "msn" => $mensaje));
					
					
?>