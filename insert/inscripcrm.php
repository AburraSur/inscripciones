<?php
@mysql_query("SET NAMES 'utf8_decode'");
session_start();

$fecha = date("Y-m-d");

include("../class.conexion.php");  
 $db = new conn();  
$ip = $db->getRealIP();

if( isset($_SESSION['iduser']) ){
	$varsesion = "$_SESSION[iduser] IP:$ip ";
}else{
	$varsesion = "Externo IP:$ip ";
}
$numins = 0;
$idev=$_POST["idevent"];
$ctrl=$_POST["ctrl"];
$ctrl2=0;
$empl="";

$nit="$_POST[nit]";
$comentg = "$_POST[coment]";

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
		$habeas = $_POST["habeas$i"];
		if($habeas == null){
			$sw = 2;
		}
		}
		if($sw == 2){
			$mensaje = "Recuerde Diligenciar Todos Los Campos Relacionados Con La Ley 1581";
		}elseif($ctrl2 == $ctrl){
		
			$regempresa = $db->consulta("select * from empresa where nit='$nit' ");
			$yaregempre = $db->num_rows($regempresa);
			
			if($yaregempre == 0){
				$empresa = $db->consulta("insert into empresa (nit,rsocial,dir,comentario) values ('$nit','$_POST[nomemp]','$_POST[diremp]','$comentg')");				
				$db->consulta("insert into log (fechalog,descripcion) values ('$fecha','El Usuario $varsesion creo la empresa $nit ')");
			}else{
				$db->consulta("update empresa set rsocial='$_POST[nomemp]',dir='$_POST[diremp]' where nit='$nit' ");
			}
			$tarifa=$_POST["tar"];
			for($k=1;$k<=$ctrl;$k++){
			$ced=$_POST["docid$k"];
			$nombres=utf8_decode($_POST["nombres$k"]);
			$apellidos=utf8_decode($_POST["apellidos$k"]);
			$mailx= mb_strtolower($_POST["mail$k"], 'UTF-8');
			$tel=$_POST["tel$k"];
			$ext=$_POST["ext$k"];
			$cel=$_POST["cel$k"];
			$muni=$_POST["muni$k"];
			$cargo=$_POST["cargo$k"];
			$coment = $_POST["coment$k"];
			$habeas = $_POST["habeas$k"];
			
				$reg = $db->consulta("select * from asistentes where cedula='$ced' ");
				$yaregistra = $db->num_rows($reg);
				if($yaregistra == 0){
				$asist = $db->consulta("insert into asistentes (cedula,nombres,apellidos,email,tel,ext,cel,municipio,cargo,comentario,habeas) values ('$ced','$nombres','$apellidos','$mailx','$tel','$ext','$cel','$muni','$cargo','$coment','$habeas')");
				$db->consulta("insert into log (fechalog,descripcion) values ('$fecha','El Usuario $varsesion creo el asistente $ced en el evento $idev ')");
				}else{
					$asist = $db->consulta("update asistentes set nombres='$nombres',apellidos='$apellidos',email='$mailx',tel='$tel',ext='$ext',cel='$cel',municipio='$muni',cargo='$cargo',comentario='$coment',habeas='$habeas' where cedula='$ced'");
					$db->consulta("insert into log (fechalog,descripcion) values ('$fecha','El Usuario $varsesion actualizo el usuario $ced desde la inscripcion para el evento $idev')");
				}
				$eventasis= $db->consulta("insert into event_asist (idevent,cedula,nit) values ($idev,'$ced','$nit')");
				$db->consulta("insert into log (fechalog,descripcion) values ('$fecha','El Usuario $varsesion inscribio a $ced en evento $idev ')");
				
				if( $rowsql['modulos'] == 'SI' ){
				for($j=1;$j<=$_POST['ctrlmod'];$j++){
					if( $_POST["mod$j"] != null ){
						$db->consulta("insert into mod_asis (idmod,cedula,idevento) values (".$_POST["mod$j"].",'$ced',$idev)");
						$db->consulta("insert into log (fechalog,descripcion) values ('$fecha','El Usuario $varsesion inscribio a $ced en modulo ".$_POST["mod$j"]." ')");
					}
				}
				}
				
				if( $rowsql['pago'] == 1 ){
					
					  $db->consulta("insert into pagos (vlrpago,formapago,nrotran,fectrans,nrorecibo,fecrecibo,observa,nit,cedula,tarifa,idevento) values (0,0,0,0,0,0,0,'$nit','$ced','$tarifa','$idev')");
					
				}
				
				$codigo = $db->consulta("select id from event_asist where cedula=$ced and idevent=$idev ");
				$codconfirm = $db->fetch_array($codigo);
				$codd.= "<tr><td>$codconfirm[id]</td><td> $nombres $apellidos </td></tr> ";
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
Señor Usuario, Por Favor Presentar el Codigo de Inscripcion, 
Recuerde estar en el sitio del Evento 15 minutos antes de su inicio.
<br>
<b><i>Su codigo de Inscripcion</i></b>
<table align=center >
<thead>
<tr><th>Codigo</th><th>Inscrito</th></tr>
</thead>
<tbody>	
	$codd
</tbody>
</table>
</p>";

//Si el evento al que se ha inscrito tiene costo, una de las Asesoras Empresariales de la Cámara de Comercio Aburrá Sur le contactará para verificar los datos relacionados con el pago de su inscripción.
							
				require('./class.phpmailer.php');
					$i = 1;
					$todos='';
	
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
					while($i <= $_POST["ctrl"]){
						$mailing=$_POST["mail$i"];
						$nom=$_POST["nombres$i"];
						$ape=$_POST["apellidos$i"];
						$compl="$nom $ape";
						$todos.=$compl."<br>";
						$cmail=0;
						if( $mailing != ''){
						$mail->AddAddress("$mailing", "$compl");
						$cmail++;
						}
						$i+=1;
					}
					//$mail->AddAddress("inscripciones@ccas.org.co", "Inscripciones");
					$mail->AddAttachment("../uploads/$rowmail[image]", "$rowmail[image]");
					$mail->Subject = "Inscripciones Evento:";
					$mail->MsgHTML($body);
					$mail->Send();
					
					//if(!$mail->Send()) {
					if( $eventasis != 1 ) {
						$sw=2;
						$mensaje="El Correo de Confirmacion no pudo ser enviado a uno o mas destinatarios, por favor contactenos para confirmar su inscripcion";
						if( $cmail > 0 ){
						$db->consulta("delete from event_asist where `cedula` in (select cedula from asistentes where nit='$nit') and idevent=$idev ");
						/*$db->consulta("delete from asistentes where nit='$nit' ");
						$db->consulta("delete from empresa where nit='$nit' ");*/
						}
					} else {
						$sw=1;
						$mensaje = "Inscripcion Exitosa<br>Un Correo de Confirmacion ha Sido Enviado a cada uno de los Inscritos";
						require_once("../crm/PSGWSTest.php");
						$mail2 = new PHPMailer();
						$mail2->IsSMTP();
						$mail2->SMTPAuth = true;
						$mail2->SMTPSecure = "tls";
						//$mail->Host       = "190.248.151.10";
						$mail2->Host       = "host416.hostmonster.com";
						//$mail2->Host       = "192.168.1.20";
						$mail2->Port       = 25;
						$mail2->Username = "inscripciones@ccas.co";
						$mail2->Password = "Ccas2010";
						$body2 = "<html><head><style>p{font-family:Arial;font-size:12px}</style></head><body>Hay un Nuevo Registro en el Evento $rowmail[nom_evento]<br><br>Empresa: $_POST[nomemp] &nbsp;&nbsp; NIT: $nit<br><br>Inscritos:<br>  $todos </body>";
						$mail2->SetFrom("inscripciones@ccas.co","Inscripciones Eventos Aburra Sur");
					
					if( $rowmail['respon'] == 1){
						$mail2->AddAddress("eventos@ccas.org.co", "Eventos CCAS");
						$mail2->AddAddress("auditorios@ccas.org.co", "Auditorios CCAS");
						//$mail2->AddAddress("auxiliar.sistemas@ccas.org.co", "Auditorios CCAS");
					}else{
						$mail2->AddAddress("$rowmail[mailresp]", "UCI");
					}
						$mail2->Subject = "Inscripciones Evento: $rowmail[nom_evento] ";
						$mail2->MsgHTML($body2);
						$mail2->Send();
						/*if(!$mail2->Send()){
							$sw = 2;
							$mensaje = "Ocurrio un Problema Durante El Envio de los Correos Por Favor Verificar en su Bandeja de Correo la Confirmacion de Inscripcion ";
						}else{
							$sw = 1;
							$mensaje = "Inscripcion Exitosa<br>Un Correo de Confirmacion ha Sido Enviado a cada uno de los Inscritos";
							
						}*/
						
					}
					
	
				}else{
					$sqlconf = $db->consulta("select * from event_asist where idevent=$idev and cedula=$ced ");
					$num = $db->num_rows($sqlconf);
					
					if( $num > 0){
						$sw = 1;
						$mensaje = "Inscripcion Exitosa";
						
					}else{
						$sw=2;
						$mensaje="Se Produjo un Error al Momento de Registrar su Inscripcion. Por Favor Intentelo mas Tarde";
						$db->consulta("delete from event_asist where `cedula` in (select cedula from asistentes where nit='$nit') and idevent=$idev ");
						/*$db->consulta("delete from asistentes where nit='$nit' ");
						$db->consulta("delete from empresa where nit='$nit' ");*/
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