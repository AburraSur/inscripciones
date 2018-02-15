<?php
@mysql_query("SET NAMES 'utf8_decode'");

include("../class.conexion.php");  
 $db = new conn();  


$numins = 0;
$idev=$_POST["idevent"];
$ctrl=$_POST["ctrl"];
$ctrl2=0;
$empl="";
if( $_POST['id'] == 'nit'){
$nit="$_POST[nit]-$_POST[dv]";
}else{
$nit="$_POST[nit]";
}

  $consulta = $db->consulta("SELECT * FROM event_asist ea INNER JOIN asistentes a WHERE ea.cedula = a.cedula AND ea.idevent=$idev AND a.nit = '$nit' ;");  
$inscritos="";
  while($row=$db->fetch_array($consulta)){
	$inscritos.= " $row[nombres] $row[apellidos]";
	$numins += 1; 
  }
  
 
  
    $sql = $db->consulta("select * from evento where idevento=$idev ");
	$rowsql = $db->fetch_array($sql);
	
	 $dispc = ( $rowsql['cupo'] - $numins );
	 
if( $dispc >= $ctrl){
if($numins < $rowsql['cupo'] ){
	for($j=1;$j<=$ctrl;$j++){
	$ced=$_POST["docid$j"];
	$nombres=$_POST["nombres$j"];
	$apellidos=$_POST["apellidos$j"];
		$registro = $db->consulta("select * from event_asist where idevent=$idev and cedula='$ced' ");
		$numrows = $db->num_rows($registro);
		if($numrows > 0){$empl.="$nombres $apellidos, ";}
	}
	
	if($numrows == 0){
		for($i = 1;$i <= $ctrl;$i++){
		if($_POST["docid$i"] != null && $_POST["nombres$i"] != null  && $_POST["apellidos$i"] != null && $_POST["tel$i"] != null && $nit != null && $_POST["nomemp"] != null){
			$ctrl2+=1;
		}
		}
		if($ctrl2 == $ctrl){
		
			$regempresa = $db->consulta("select * from empresa where nit='$nit' ");
			$yaregempre = $db->num_rows($regempresa);
			
			if($yaregempre == 0){
				$empresa = $db->consulta("insert into empresa (nit,rsocial,dir,tarifa,comentario) values ('$nit','$_POST[nomemp]','$_POST[diremp]','$_POST[tar]','$_POST[coment]')");
			}
			
			for($k=1;$k<=$ctrl;$k++){
			$ced=$_POST["docid$k"];
			$nombres=utf8_decode($_POST["nombres$k"]);
			$apellidos=utf8_decode($_POST["apellidos$k"]);
			$mailx=$_POST["mail$k"];
			$tel=$_POST["tel$k"];
			$cel=$_POST["cel$k"];
			$muni=$_POST["muni$k"];
			$cargo=$_POST["cargo$k"];
			
				$reg = $db->consulta("select * from asistentes where cedula='$ced' and nit='$nit' ");
				$yaregistra = $db->num_rows($reg);
				if($yaregistra == 0){
				$asist = $db->consulta("insert into asistentes (cedula,nombres,apellidos,email,tel,cel,municipio,nit,cargo) values ('$ced','$nombres','$apellidos','$mailx','$tel','$cel','$muni','$nit','$cargo')");
				}
				$eventasis= $db->consulta("insert into event_asist (idevent,cedula,nit) values ($idev,'$ced','$nit')");
				if( $rowsql['modulos'] == 'SI' ){
				for($j=1;$j<=$_POST['ctrlmod'];$j++){
					if( $_POST["mod$j"] != null ){
						$db->consulta("insert into mod_asis (idmod,cedula,idevento) values (".$_POST["mod$j"].",'$ced',$idev)");
					}
				}
				}
			}
			
			//bloque de envio de correo a inscritos
			$i = 0;
			while($i <= $_POST["ctrl"]){
						$mailing2.=$_POST["mail$i"];
						
						$i+=1;
					}
			if( $mailing2 != ''){
				$consultamail = $db->consulta("select * from evento where idevento=$idev ;");  
				$rowmail=$db->fetch_array($consultamail);
  
				$correo="<p style='font-family:Arial;font-size:12px;line-height:16px;align:justify'>Señor Usuario, gracias por registrase en el evento $rowmail[nom_evento], programado para el día $rowmail[fec_event] a las $rowmail[hora] en el $rowmail[lugar].
<br><br>
Si el evento al que se ha inscrito tiene costo, una de las Asesoras Empresariales de la Cámara de Comercio Aburrá Sur le contactará para verificar los datos relacionados con el pago de su inscripción.
<br><br>
Recuerde estar en el sitio del evento 15 minutos antes de su inicio.
<br>
Tenga en cuenta que en nuestro Centro de Convenciones tenemos a su disposición el servicio de Parqueadero Cubierto administrado por CORPAUL.
</p>";
							
				require('./class.phpmailer.php');
					$i = 1;
					$todos='';
	
					$mail = new PHPMailer();
					$mail->IsSMTP();
					$mail->SMTPAuth = true;
					$mail->SMTPSecure = "tls";
					//$mail->Host       = "host273.hostmonster.com";
					$mail->Host       = "192.168.1.20";
					$mail->Port       = 25;
					$mail->Username = "inscripciones@ccas.org.co";
					$mail->Password = "ccas2010";
					$body = "<html><head><style>p{font-family:Arial;font-size:12px}</style></head><body>$correo</body>";
					$mail->SetFrom("inscripciones@ccas.co","Inscripciones Eventos Aburra Sur");
					while($i <= $_POST["ctrl"]){
						$mailing=$_POST["mail$i"];
						$nom=$_POST["nombres$i"];
						$ape=$_POST["apellidos$i"];
						$compl="$nom $ape";
						$todos.=$compl."<br>";
						if( $mailing != ''){
						$mail->AddAddress("$mailing", "$compl");
						}
						$i+=1;
					}
					//$mail->AddAddress("inscripciones@ccas.org.co", "Inscripciones");
					$mail->AddAttachment("../uploads/$rowmail[image]", "$rowmail[image]");
					$mail->Subject = "Inscripciones Evento:";
					$mail->MsgHTML($body);
					//$mail->Send();
					
					if(!$mail->Send()) {
						$sw=2;
						$mensaje="El Correo de Confirmacion no pudo ser enviado a uno o mas destinatarios, por favor contactenos para confirmar su inscripcion";
						$db->consulta("delete from event_asist where `cedula` in (select cedula from asistentes where nit='$nit')");
						$db->consulta("delete from asistentes where nit='$nit' ");
						$db->consulta("delete from empresa where nit='$nit' ");
					} else {
						$sw=1;
						
						$mail2 = new PHPMailer();
						$mail2->IsSMTP();
						$mail2->SMTPAuth = true;
						$mail2->SMTPSecure = "tls";
						//$mail2->Host       = "host273.hostmonster.com";
						$mail2->Host       = "192.168.1.20";
						$mail2->Port       = 25;
						$mail2->Username = "inscripciones@ccas.org.co";
						$mail2->Password = "ccas2010";
						$body2 = "<html><head><style>p{font-family:Arial;font-size:12px}</style></head><body>Hay un Nuevo Registro en el Evento $rowmail[nom_evento]<br><br>Empresa: $_POST[nomemp] &nbsp;&nbsp; NIT: $nit<br><br>Inscritos:<br>  $todos </body>";
						$mail2->SetFrom("inscripciones@ccas.co","Inscripciones Eventos Aburra Sur");
					
					if( $rowmail['respon'] == 1){
						$mail2->AddAddress("eventos@ccas.org.co", "Eventos CCAS");
						$mail2->AddAddress("auditorios@ccas.org.co", "Auditorios CCAS");
					}else{
						$mail2->AddAddress("auxiliar.sistemas@ccas.org.co", "UCI");
					}
						$mail2->Subject = "Inscripciones Evento: $rowmail[nom_evento] ";
						$mail2->MsgHTML($body2);
						$mail2->Send();	
						
					}

	
				}else{
					$sqlconf = $db->consulta("select * from event_asist where idevent=$idev and cedula=$ced ");
					$num = $db->num_rows($sqlconf);
					
					if( $num > 0){
						$sw = 1;
					}else{
						$sw=2;
						$mensaje="Se Produjo un Error al Momento de Registrar su Inscripcion. Por Favor Intentelo mas Tarde";
						$db->consulta("delete from event_asist where `cedula` in (select cedula from asistentes where nit='$nit')");
						$db->consulta("delete from asistentes where nit='$nit' ");
						$db->consulta("delete from empresa where nit='$nit' ");
					}
				}
			
		}else{
			$sw=2;
			$mensaje="Los datos son incorrectos, por favor verificarlos.";
		}
	
	}else{
		$sw=2;
		$mensaje="Los usuarios $empl ya estan registrados para este evento.";
	}
}else{
		$sw=2;
		$mensaje="Usted ya realizo la inscripcion de los siguientes usuarios:<br> $inscritos ";
}
}else{
		$sw=2;
		if($dispc == 0){
			$mensaje="Usted ya registro los cupos disponibles para este evento ";
		}else{
			$mensaje="Usted solo tiene $dispc cupos disponibles ";
		}
}

$array = array ( "enviar" => $sw , "mensaje" => $mensaje );
$arrayj = json_encode($array);
echo $arrayj;


?>