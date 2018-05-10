<?php
//include('./conexion.php');
require("./class.conexion.php");

$db = new conn();
$cod=0;
session_start();




?>
<html>
<head>
<title>Area Administrativa</title>
<link rel="icon" type="image/gif" href="img/users.ico" /> 
 <LINK HREF="./estilo/tagest.css" REL="stylesheet" TYPE="text/css">
<LINK HREF="./estilo/button.css" REL="stylesheet" TYPE="text/css">
<LINK HREF="./estilo/uploadfile.min.css" REL="stylesheet" TYPE="text/css">
<LINK href="./estilo/divestilo.css" rel="stylesheet" type="text/css">
<LINK href="./estilo/style.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="./js/jquery.min.js"></script>
<script type="text/javascript" src="./js/jquery.uploadfile.min.js"></script>
<script src="./js/jquery.js"></script>
  <script type="text/javascript" src="./js/jquery-validate.js"></script>
  <script src="./js/jquery-1.4.2.min.js"></script>
  <script language="javascript" src="./js/jquery-1.3.1.min.js"></script>
<script language="javascript" src="./js/AjaxUpload.2.0.min.js"></script>
<script>
$(document).ready(function(){
	$("#ifirma").hide("fast");
	$("#cancelf").hide("fast");
	$("#chfirm").click(function(){
		$("#ifirma").show('fast');
		$("#cancelf").show("fast");
		$(this).hide("fast");
		return false;
	});	
	$("#cancelf").click(function(){
		$("#ifirma").hide('fast');
		$("#imgf").attr('src','./img/uploads/blank.png');
		$("#chfirm").show("fast");
		$(this).hide("fast");
		return false;
	});	
	
	
var refreshId = setInterval(refrescar, 12000);
	$.ajaxSetup({ cache: false });
	
	function refrescar(){
		var pass = $("#divpass").val();
		var user = $("#divuser").val();
		
		$.ajax({
			url: "./js/login.php",
			type: "POST",
			data: {pass:pass,user:user,ext:1},
			success: function ( data ){
				var obj = eval ( "(" + data + ")" );
				$("#divperf").attr('value',obj.perfil);
				$("#divuser").attr('value',obj.user);
				
			}
		})
		return false;
			
			
	}
	
	
});
</script>
<script src="./js/jquery.blockUI-validate.js"></script>
<?php
if( $_SESSION['perfil']==2){
	echo "<script type='text/javascript'> 
$(document).ready(function() {
	$('.user2').remove();
});
</script>";
}

if( isset($_SESSION['iduser'])){
		echo "<script type='text/javascript'> 
				$(document).ready(function() {
					$('.work').attr('style','display:block');
					$('.workadmin').attr('style','display:block');
					$('#login').attr('style','display:none');
				});
			</script>";
}
?>
<script type="text/javascript" src="./js/jquery.index.js"></script> 
  <link rel="stylesheet" type="text/css" href="./estilo/stylesheet.css" media="screen" />
	<link rel="stylesheet" type="text/css" href="./estilo/ui.core.css" media="screen" />
	<link rel="stylesheet" type="text/css" href="./estilo/ui.theme.css" media="screen" />
	<link rel="stylesheet" type="text/css" href="./estilo/jquery-ui-1.7.1.custom.css" media="screen" />
	
	
	<link rel="stylesheet" type="text/css" href="./js/jquery.ptTimeSelect.css" media="screen" />
	<script type="text/javascript" language="JavaScript" src="./js/jquery.ptTimeSelect.js"></script>

<link type="text/css" href="./js/jquery-ui-1.8.1.custom.css" rel="Stylesheet" />   
   <script type="text/javascript" src="./js/jquery-ui-1.8.1.custom.min.js"></script>
   <script type="text/javascript" src="./js/jquery.ui.datepicker-es.js"></script>
   <script src="./js/jquery.blockUI-validate.js" ></script>
   <script>
   $(document).ready(function(){
	$(".tab_content").hide(); 
	$("ul.tabs li:first").addClass("active").show(); 
	$(".tab_content:first").show(); 
	
	
		
	});
</script>
<style>
body{
background-attachment: fixed;

}

.shot{
 position:fixed;
 top:10;
 right:5;
 
}
.closed{
 position:absolute;
 top:120;
 left:35% ;
 
}

.list22{
 position:absolute;
 top:55%;
 left:48% ;
 
}

</style>


</head>

	<body background="./img/bg2.jpg" >
	
	<a href='./cerrar.php' id='sht' ><img src='./img/shutdown.png' class='shot' width='80' height='80'   /></a>
		<table width="90%" height="100%" align="center">
		<tr>
			<td>
				
	
    <ul class="tabs">
        <li class="user2" ><a href="#tab1"><font face="Verdana" size="2" color="#475B70" align="center"><i><B>Crear Evento</B></i></font></a></li>
        <li class="user2" ><a href="#tab2"><font face="Verdana" size="2" color="#475B70" align="center"><i><B>Cerrar Evento</B></i></font></a></li>
        <li><a href="#tab3"><font face="Verdana" size="2" color="#475B70" align="center"><i><B>Ver Inscripciones</B></i></font></a></li>
		<li><a href="#tab4"><font face="Verdana" size="2" color="#475B70" align="center"><i><B>Eventos Cerrados</B></i></font></a></li>
		<li class="user2" ><a href="#tab5"><font face="Verdana" size="2" color="#475B70" align="center"><i><B>Pagos</B></i></font></a></li>	
		<li class="user2" ><a href="#tab6"><font face="Verdana" size="2" color="#475B70" align="center"><i><B>Asistencia</B></i></font></a></li>
		<li class="user2" ><a href="#tab7"><font face="Verdana" size="2" color="#475B70" align="center"><i><B>Certificados</B></i></font></a></li>	
		<li class="user2" ><a href="#tab8"><font face="Verdana" size="2" color="#475B70" align="center"><i><B>Edici&oacute;n</B></i></font></a></li>	
		<li class="user2" ><a href="#tab9"><font face="Verdana" size="2" color="#475B70" align="center"><i><B>Estados</B></i></font></a></li>		
		<li class="user2" ><a href="#tab10"><font face="Verdana" size="2" color="#475B70" align="center"><i><B>Avanzadas</B></i></font></a></li>
    </ul>
    <div class="tab_container">
	
        <div id="tab1" class="tab_content user2">
		<div id="work" class="workadmin" style='display:none' >
		<img src="./img/addevent.png" />
		<font face="Verdana" size="6" ><b><i>NUEVO EVENTO</i></b></font>
		
		<br><br>
       
			
		  <form name="form1" id="form1">
		  
			<table width="90%">
			
			<tr>
				<td colspan="4" >
					<!--	<div id="upload_button"></div>-->
					<iframe src="./js/upload.html" width="100%" height="100%" ></iframe>
					<input type="hidden" name="nomf" id="nomf" value="blank.png" />
				<!--	<div id="loadf" ></div>-->
				</td>
			</tr>
			<tr>
				<td colspan="4" ><img src="./img/uploads/blank.png" id="img" /></td>
			</tr>
			<tr>
				<td>
					<font face="Verdana" size="3" ><b><i>Nombre del Evento: </i></b></font>
				</td>
				<td>
					<input type="text" name="namevent" size="32" class="required" />
				</td>
			
				<td>
					<font face="Verdana" size="3" ><b><i>Lugar del Evento: </i></b></font>
				</td>
				<td>
					<input type="text" name="lugar" size="32" class="required" />
				</td>
			</tr>
			<tr>
				<td>
					<font face="Verdana" size="3" ><b><i>Cupo de Inscripciones: </i></b></font>
				</td>
				<td>
					<input type="text" name="cupo" size="32" class="required" />
				</td>
			
				<td>
					<font face="Verdana" size="3" ><b><i>Fecha del Evento: </i></b></font>
				</td>
				<!--<td>
					
					<a href="javascript:doNothing()" onClick="setDateField(document.form1.fecevent);top.newWin=window.open('./js/calendar.html','cal','dependent=yes,width=210,height=230,screenX=400,screenY=200,titlebar=yes')"><input type="text" name="fecevent" size="15" class="required" /></a>
				</td>-->
				<td>
					<input type="text" name="fecevent" class="fecha required" size="32" />
				</td>
			</tr>
			<tr>
				<td>
					<font face="Verdana" size="3" ><b><i>Hora del Evento: </i></b></font>
				</td>
				<td>
					<div class="sample2">
					<div><input type="text" name="hevent" size="32" class="required" /></div>
					
					</div>
				</td>
			
				<td>
					<font face="Verdana" size="3" ><b><i>Responsable del Evento: </i></b></font>
				</td>
				<td>
					<input type="text" name="respon" id="resp" size="32" />
				</td>
			</tr>
			<tr>
				<td>
					<font face="Verdana" size="3" ><b><i>Evento con Modulos: </i></b></font>
				</td>
				<td>
					<table>
						<tr>
							<td><font face="Verdana" size="3" ><b><i>SI</i></b></font></td>
							<td><input type="radio" name="modulo" value="SI" class="modulo" /></td>
							<td><font face="Verdana" size="3" ><b><i>NO</i></b></font></td>
							<td><input type="radio" name="modulo" value="NO" checked class="modulo"  /></td>
						</tr>
					</table>
				</td>	
				<td>
					<font face="Verdana" size="3" class="mailresp"  ><b><i>Correo del Responsable: </i></b></font>
				</td>
				<td>
					<input type="text" name="mailresp" size="32" class="mailresp"  />
				</td>
							
			</tr>
			<tr>
                            <td><font face="Verdana" size="3" ><b><i>Enviar Notificaci&oacute;n email</i></b></font></td>
                            <td>
                                <table>
                                        <tr>							
                                                <td><font face="Verdana" size="3" ><b><i>SI</i></b></font></td>
                                                <td><input type="radio" name="sendEmail" value="1"  checked="true"/></td>	
                                                <td><font face="Verdana" size="3" ><b><i>NO</i></b></font></td>
                                                <td><input type="radio" name="sendEmail" value="0"  /></td>						
                                        </tr>
                                </table>
                            </td>				
                            <td><font face="Verdana" size="3" ><b><i>Este Evento Requiere Certificados</i></b></font></td>
                            <td>
                                    <table>
                                            <tr>
                                                    <td><font face="Verdana" size="3" class="certi" ><b><i>SI</i></b></font></td>
                                                    <td><input type="radio" name="certi" value="1" class="certi" /></td>
                                                    <td><font face="Verdana" size="3" class="certi" ><b><i>NO</i></b></font></td>
                                                    <td><input type="radio" name="certi" value="2" checked class="certi"  /></td>
                                            </tr>
                                    </table>
                            </td>
			</tr>                  
                            
			<tr>
				<td><font face="Verdana" size="3" ><b><i>Evento Tipo Curso</i></b></font></td>
				<td>
					<table>
						<tr>							
							<td><font face="Verdana" size="3" ><b><i>SI</i></b></font></td>
							<td><input type="radio" name="tpevento" value="1"  /></td>	
							<td><font face="Verdana" size="3" ><b><i>NO</i></b></font></td>
							<td><input type="radio" name="tpevento" value="0" checked /></td>						
						</tr>
					</table>
				</td>
				<td><font face="Verdana" size="3" ><b><i>Categor&iacute;a</i></b></font></td>
				<td>
					<table>
						<tr>							
							<td><font face="Verdana" size="3" ><b><i>CCAS</i></b></font></td>
							<td><input type="radio" name="ctevento" value="1" checked /></td>	
							<td><font face="Verdana" size="3" ><b><i>EMFORMA</i></b></font></td>
							<td><input type="radio" name="ctevento" value="2" /></td>						
						</tr>
					</table>
				</td>
			</tr>
                        <tr>
                            <td><font face="Verdana" size="3" ><b><i>Este Evento Requiere Pago</i></b></font></td>
                            <td>
                                    <table>
                                            <tr>
                                                    <td><font face="Verdana" size="3" class="pago" ><b><i>SI</i></b></font></td>
                                                    <td><input type="radio" name="pago" value="1" class="pago limitpay" /></td>
                                                    <td><font face="Verdana" size="3" class="pago" ><b><i>NO</i></b></font></td>
                                                    <td><input type="radio" name="pago" value="2" checked class="pago limitpay"  /></td>
                                            </tr>
                                    </table>
                            </td>
			</tr>
			</table>
			<fieldset id="mod" style="display:none" ><legend ><i><b>Modulos</b></i></legend>
			<table align="center" id="tabmod" cellpadding="5" >
			<thead bgcolor="gray" >
				<th><i>Fecha</i></th><th><i>Modulo</i></th>
			</thead>
			<tbody>
			<tr>
				<td><input type="text" name="fmod1" size="15" class="fecha" /></td><td><input type="text" name="modu1" class="required" size="80" /></td>
			</tr>
			</tbody>
			</table>
			<input type="hidden" name="ctrlmod" id="ctrlmod" value="1"  />
			<img src="./img/add.png" id="add" />
			<br><font face="Verdana" size="3" ><b><i>Total Asistencias para Certificaci&oacute;n</i></b></font>&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="totalasistcert" class="required" size="10" value="1" />
			</fieldset>
			<input type="hidden" name="list" id="lista">
			<br>
			<div id="cert" style="display:none" >
			<fieldset><legend><b><i>Variable de Certificaci&oacute;n</i></b></legend>
			<center>
				<textarea name="certvar" rows="4" cols="100" ></textarea>
			
			<br>
			<font face="Verdana" size="3" ><b><i>Fecha de Certificaci&oacute;n</i></b></font>&nbsp;&nbsp;<input type="text" name="fec_exp" size="15" class="fecha"  />
			<br>
			<font face="Verdana" size="3" ><b><i>Lugar de Certificaci&oacute;n</i></b></font>&nbsp;<input type="text" name="place_exp" size="15"  />
			</center>
			<br>
			<a href="#" class="boton" id="chfirm" >Cambiar Firma</a>&nbsp;&nbsp;<a href="#" class="boton" id="cancelf" >Cancelar</a>
			<div>
				<iframe src="./js/uploadfirm.html" width="100%" id="ifirma" ></iframe>
			</div>
					<input type="hidden" name="nomfir" id="nomfir" value="firma1.png" />
			
			<img src="./img/uploads/firma1.png" id="imgf" />
			
			</fieldset>
			</div>
                        <fieldset id="paylimit" style="display:none" ><legend><b><i>Informaci&oacute;n del pago</i></b></legend>
                            <table align="center" width="70%" >
                                <tr>
                                    <td><font face="Verdana" size="3" ><b><i>Fecha Limite de Pago</i></b></font></td>
                                    <td>
                                            <input type="text" name="fecpago" class="fecha required" size="32" />
                                    </td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td><font face="Verdana" size="3" ><b><i>Tarifa Afiliados</i></b></font></td>
                                    <td>
                                            <input type="text" name="tarifaAfiliados" class="required" size="32" />
                                    </td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td><font face="Verdana" size="3" ><b><i>Tarifa Matriculados</i></b></font></td>
                                    <td>
                                            <input type="text" name="tarifaMatriculados" class="required" size="32" />
                                    </td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td><font face="Verdana" size="3" ><b><i>Tarifa Particulares</i></b></font></td>
                                    <td>
                                            <input type="text" name="tarifaParticulares" class="required" size="32" />
                                    </td>
                                    <td></td>
                                    <td></td>
                                </tr>
                            </table>    
                        </fieldset>
			<br>
			<fieldset><legend><b><i>Fechas de Inscripciones </i></b></legend>
			<br>
			<table align="center" width="70%" >
			<tr>
			<td>
				<font face="Verdana" size="3" ><b><i>Fecha Inicio: </i></b></font>
			</td>
			<td>
				<input type="text" name="finicio" class="fecha" size="32" />
			</td>
			<td>
				<font face="Verdana" size="3" ><b><i>Fecha Cierre: </i></b></font>
			</td>
			<td>
				<input type="text" name="fcierre" class="fecha" size="32" />
			</td>
			</tr>
			</table>
			</fieldset>
			<br>
			<center><input type="image" src="./img/button-4.png" id="boton" /></center>
		  </form>
		  <div id="mail2" ></div>
		  <div id="mail" ></div>
		  <div id="exit" ></div>
		  </div>
		  
			
		<div id="login" >
		<img src="./img/login.png" />
		<font face="Verdana" size="6" ><b><i>INICIAR SESI&Oacute;N</i></b></font>
		
		<br><br>
       
			
		  <form name="form2" id="form2">
		  
			
			<br><br><br><br>
			<fieldset><legend><b><i>Login</i></b></legend>
			<br>
			<center>
			<table>
			<tr>
			<td>
			<font face="Verdana" size="3" ><b><i>Usuario: </i></b></font>
			
			<input type="text" name="user" size="15" id="es" class="required" />
			</td>
			<td>
			<font face="Verdana" size="3" ><b><i>Contrase&ntilde;a: </i></b></font>
			<input type="password" name="pass" size="15" id="es" class="required dateISO" />
			</td>
			</tr>
			</table>
			</center>
			<br>
			<center><input type="image" src="./img/button-log.png" id="boton2" /></center>
		  </form>
		  </fieldset>
		  
        </div>
		
		</div>
		
        <div id="tab2" class="tab_content user2">
		<div id="work2" class="workadmin" style='display:none' >
		<img src="./img/locked.png" />
		<font face="Verdana" size="6" ><b><i>CERRAR EVENTO</i></b></font>
		
		<br><br><br><br><br>
       
			
		  <form name="form3" id="form3">
		  <fieldset>
		  <center>
		 <font face="Verdana" size="3" ><b><i>Seleccione Evento</i></b></font><br>
			<select name="closed" id="select1" >
		
			</select>
		<br><br>
		<input type="image" src="./img/button-close.png" id="boton3" /></center>
		<br><br><br>
		</fieldset>
		</form>
	
        </div>
		</div>
        <div id="tab3" class="tab_content">
            <div id="work3" class="work" style='display:none' >
                   
                <font face="Verdana" size="6" ><b><i>Inscripciones</i></b></font>
                <div>
                    <img src="./img/search.png" width="30" />
                    <img src="./img/refresh.png" id="refresh" width="30" />
				<?php 
				
					if($_SESSION['perfil'] != 2){
						echo '<img src="./img/drop_all.png" id="all" width="30" />';
					}
                ?>    
                    <select name="year2" id="year2" ><option value="all" >Todos</option>
                        <?php
                           $yy = date("Y");
                           echo "";
                           for($i=0;$i<=10;$i++){
                                   $year = ($yy-$i);
                                   echo "<option>$year</option>";
                           }
                        ?>
                    </select>
                </div>        
                <div class="form-group col-lg-8 ">
                    <form action="maestro/inscripciones.php" method="GET" target="_blank" >
                        <label>Inscribir a Evento</label>
                        <input type="text" name="cod" class="form-control" required value="">
                        <input type="submit" id="dir" class="form-control" required value="enviar">
                    </form>
                </div>
                <fieldset id="tb" >

                </fieldset>
                <br>
			
            </div>
       </div>
		
		<div id="tab4" class="tab_content">
            <div id="work4" class="work" style='display:none; margin-top: 12px;' >
                
                <img src="./img/closed.png" width="100" />
                <div>
                    <font face="Verdana" size="3" ><b><i>Seleccione el a&ntilde;o en cual se realizo el evento Evento</i></b></font><br>
                    <select name="year" id="year" >
                        <?php
                               $yy = date("Y");
                               echo "<option>--Seleccione--</option>";
                               for($i=0;$i<=10;$i++){
                                       $year = ($yy-$i);
                                       echo "<option>$year</option>";
                               }
                        ?>
                    </select>
                </div>    
                <div id="wait" style="display:none;width:200px;height:89px;position:absolute;top:50%;left:50%;padding:2px;"><img src='./img/ajax-loader.gif'  /><br><font size="2" >Cargando..</font></div>
                <fieldset id="select2" >

                </fieldset>
		
            </div>
	</div>
		
		<div id="tab5" class="tab_content">
		<div id="work5" class="workadmin" style='display:none' >
		<img src="./img/money.png" style='border:1' />
		<font face="Verdana" size="6" ><b><i>Eventos con Pago</i></b></font>
		<br><br>
		<font face="Verdana" size="3" ><b><i>Seleccione a&ntilde;o del evento</i></b></font>
		 <select name="year" id="year2" >
		 <?php
			$yy = date("Y");
			//$yy = "2013";
			for($i=0;$i<=10;$i++){
				$year = ($yy-$i);
				echo "<option>$year</option>";
			}
		
		echo " </select>
		<br><br>
		 <font face=Verdana size=3 ><b><i>Seleccione Evento</i></b></font>
		<select name=payevent id=payevent class=selectboxes />
		<option>---Seleccione---</option>";
		
		
		$sqlemp = $db->consulta("select * from evento where pago=1 and year(fec_event)='$yy' ");
		while( $rowemp = $db->fetch_array($sqlemp)){
			echo "<option value=$rowemp[idevento] >$rowemp[idevento] - ".utf8_decode($rowemp['nom_evento'])."</option>";
		}
		
			
		?>
		</select>
		<br><br>
		<form id="divpay" >
		
		
		</form>
		
		
        </div>
		</div>
		<div id="tab6" class="tab_content">
		<div id="work6" class="workadmin" style='display:none' >
		<div>
		<img src="./img/lists.png" id="asis" />
		<img src="./img/refresh.png" id="arefresh" /> 
		<font face="Verdana" size="6" ><b><i>Asistencia por Evento</i></b></font>
		<br>
		 <font face="Verdana" size="3" ><b><i>Seleccione Evento</i></b></font><br>
		<select name="asiseve" id="asiseve" class="selectboxes" />
		<option value="0" >---Seleccione---</option>
		<?php
		$fecact = date("Y-m-d");
		//$sqlev = $db->consulta("select * from evento where `fec_fin` > '$fecact' and `fec_event` >= '$fecact'");
		$sqlev = $db->consulta("select * from evento where estado='ACTIVO' ORDER BY  `evento`.`idevento` DESC  ");
		while( $rowev = $db->fetch_array($sqlev)){
			echo "<option value=$rowev[idevento] >$rowev[idevento] - $rowev[nom_evento]</option>";
		}
		
			
		?>
		</select>
		<input type="hidden" name="pago" id="pago"  />
		<font face="Verdana" size="3" class="asismod" style="display:none" ><b><i>Seleccione Modulo</i></b></font>
		<select name="asismod" id="asismod" class="selectboxes asismod" style="display:none" >
		
		</select>
		</div>
							<font size="4" face="Verdana"  ><i><b>Buscar</b></i></font><br>
							
							
							<table>
							<tr><form>
								<td>
									<font face="Verdana" size="2" ><i><b>Codigo:</font>
								</td>
								<td>
									<input type="text" name="id" id="s5" value="Codigo" class="idsearch lett" />
									<input type="hidden" name="n" class="formcod" value="5" />
									<input type="hidden" class="ideve" name="ideve" />
									<input type="hidden" class="idmod" name="idmod" />
									<input type="hidden" class="typ" name="type" value="1" />
								</td>
								<td>
									<input type="image" src="./img/search.png" width="35" class="searchnit" value="5" title="Buscar Asistente" />
								</td>
								<td></td>
								</form>
							</tr>
							<tr><form>
								<td>
									<font face="Verdana" size="2" ><i><b>Nombre:</font>
								</td>
								<td>
									<input type="text" name="id" id="s2" value="Nombre" class="idsearch lett" />
									<input type="hidden" name="n" class="formnom" value="2" />
									<input type="hidden" class="ideve" name="ideve" />
									<input type="hidden" class="idmod" name="idmod" />
									<input type="hidden" class="typ" name="type" value="1" />
								</td>
								<td>
									<input type="image" src="./img/search.png" width="35" class="searchnit" value="2" title="Buscar Asistente" />
								</td>
								<td></td>
								</form>
							</tr>
							<tr><form>
								<td>
									<font face="Verdana" size="2" ><i><b>Apellidos:</font>
								</td>
								<td>
									<input type="text" name="id" id="s6" value="Apellidos" class="idsearch lett" />
									<input type="hidden" name="n" class="formnom" value="6" />
									<input type="hidden" class="ideve" name="ideve" />
									<input type="hidden" class="idmod" name="idmod" />
									<input type="hidden" class="typ" name="type" value="1" />
								</td>
								<td>
									<input type="image" src="./img/search.png" width="35" class="searchnit" value="6" title="Buscar Asistente" />
								</td>
								<td></td>
								</form>
							</tr>
							<tr><form>
								<td>
									<font face="Verdana" size="2" ><i><b>Identificacion:</font>
								</td>
								<td>
									<input type="text" name="id" id="s1" value="Identificacion" class="idsearch lett" />
									<input type="hidden" name="n" class="formnom" value="1" />
									<input type="hidden" class="ideve" name="ideve" />
									<input type="hidden" class="idmod" name="idmod" />
									<input type="hidden" class="typ" name="type" value="1" />
								</td>
								<td>
									<input type="image" src="./img/search.png" width="35" class="searchnit" value="1" title="Buscar Asistente" />
								</td>
								<td>
									<img src="./img/escarapela.png" width="35" id="searchesc" value="1" title="Recuperar Escarapela" />
								</td>
								<td></td>
								</form>
							</tr>							
							</table>
							
						
						<div id="divasist"	>
		
						</div>
						<form id="divasis" name="divasis" >
		
		
						</form>
        </div>
		</div>
		<div id="tab7" class="tab_content">
		<div id="work7" class="workadmin" style='display:none' >
		<img src="./img/certifica.png" id="asis" />
		<img src="./img/refresh.png" id="arefresh2" />
		<font face="Verdana" size="6" ><b><i>Certificados</i></b></font>
		<br>
		 <font face="Verdana" size="3" ><b><i>Seleccione Evento</i></b></font><br>
		<select name="asiseve" id="asiseve2" class="selectboxes" />
		<option value="0" >---Seleccione---</option>
		<?php
		
		$sqlev = $db->consulta("select * from evento where estado='ACTIVO' ");
		while( $rowev = $db->fetch_array($sqlev)){
			echo "<option value=$rowev[idevento] >$rowev[idevento] - $rowev[nom_evento]</option>";
		}
		
			
		?>
		</select>
		<font face="Verdana" size="3" class="asismod" style="display:none" ><b><i>Seleccione Modulo</i></b></font>
		<select name="asismod" id="asismod2" class="selectboxes asismod" style="display:none" >
		
		</select>
		
		
		<div id="find" >
			
			<input type="text" name="idcert" id="idcert" value="Identificacion" class="idsearch lett" />&nbsp;<a href="#" id="search" class="boton" >Recuperar Certificado</a><br><br>
		</div>
		<form id="divasis2" name="divasis2" >
		
		
		</form>
		
		
        </div>
		</div>
		<div id="tab8" class="tab_content">
		<div id="work8" class="workadmin" style='display:none' >
			<table width="80%" align="left" >
				<tr align="center" >
					<td><img src="./img/edit_user.png" id="editusr" /><font face="Verdana" size="6" ><b><i>Edici&oacute;n</i></b></font></td>
				</tr>
			</table>		
			<table width="40%" align="center" >
				<tr align="center" >
					<td><font face="Verdana" size="2" ><i><b>Objeto</font><br></td>
					<td>
						<select name="objet" id="objet" >
							<option value="5" >--Seleccione--</option>
							<option value="0" >Persona</option>
							<option value="1" >Empresa</option>
							<option value="2" >Evento</option>
							<option value="3" >Modulo</option>
						</select><br>
					</td><td></td>
				</tr>
				<tr align="center" >
					<td><font face="Verdana" size="2" ><i><b>Identificacion:&nbsp;&nbsp;</font></td><td><input type="text" name="idsearch" id="s3" class="idsearch lett" value="Identificacion" /></td><td><img src="./img/search.png" width="35" class="searchnit" value="3" title="Buscar Asistente" /></td>
				</tr>
				<tr align="center">
					<td><font face="Verdana" size="2" ><i><b>Nombre:</font></td><td><input type="text" name="nomsearch" id="s4" value="Nombre" class="idsearch lett" /></td><td><img src="./img/search.png" width="35" class="searchnit" value="4" title="Buscar Asistente" /></td>
				</tr>
			</table>
			<form class="searchresult" id="formedit0" >
				<fieldset>
			<legend><i>Asistente</i></legend>
				<table width="90%" align="center" id="cuerpoins"	>
				<tbody>
				<tr>
					<td><font face="Verdana" size="2"  ><b><i>Documento<br>de Identidad:</i></b></font></td>
					<td><br><input type="text" name="docid1" id="docid1" size="32" class="required" /><font color="red" >*</font></td>
				</tr>				
				<tr>
					<td><font face="Verdana" size="2"  ><b><i>Nombres<br>completos:</i></b></font></td>
					<td><br><input type="text" name="nombres1" id="nombres1" size="32" class="required"    /><font color="red" >*</font><input type="hidden" name="oldid" id="oldid"   /></td>
					<td><font face="Verdana" size="2"  ><b><i>Apellidos<br>completos:</i></b></font></td>
					<td><br><input type="text" name="apellidos1" id="apellidos1" size="32"  /><font color="red" >*</font></td>
				</tr>
				<tr>
					<td><font face="Verdana" size="2"  ><b><i>E-mail:</i></b></font></td>
					<td><input type="text" name="mail1" id="mail1" size="32" class="required mail"  />	</td>
					<td><font face="Verdana" size="2"  ><b><i>Tel&eacute;fono:</i></b></font></td>
					<td><input type="text" name="tel1" id="tel1" size="25" class="required number" /><font color="red" >*</font>&nbsp;<font face="Verdana" size="2"  ><b><i>Ext.</i></b></font><input type="text" name="ext1" id="ext1" size="4" /></td>
				</tr>
				<tr>
					<td><font face="Verdana" size="2"><b><i>Celular:</i></b></font></td>
					<td><input type="text" name="cel1" id="cel1" size="32" /></td>
					<td><font face="Verdana" size="2"  ><b><i>Municipio:</i></b></font></td>
					<td><select name="muni1" id="muni1"  ><option>CALDAS</option><option>ENVIGADO</option><option>ITAGUI</option><option>LA ESTRELLA</option><option>SABANETA</option><option>MEDELLIN</option></select></td>
				</tr>
				<tr>
					<td><font face="Verdana" size="2"  ><b><i>Cargo:</i></b></font></td>
					<td><input type="text" name="cargo1" id="cargo1" size="32" /></td>
				
					<td><font face="Verdana" size="2"  ><b><i>Habeas Data:</i></b></font></td>
					<td><font face="Verdana" size="2"  >SI</font><input type="radio" name="habeas1" id="habeasSI" value="SI" />
						<font face="Verdana" size="2"  >NO</font><input type="radio" name="habeas1" id="habeasNO" value="NO" />
						<font face="Verdana" size="2"  >NS/NR</font><input type="radio" name="habeas1" id="habeasNR" value="NR" />
					</td>
					</tr>
				<tr>
					<td colspan="4" ><center><font face="Verdana" size="2"  ><b><i>Comentario</i></b></font><br><textarea name="comentario" id="comentario" cols="150" rows="4" ></textarea></center></td>
				</tr>	
			</table>
			<br><center><input type="hidden" name="typ" value="1" /><input type="hidden" name="opcion" value="0" /><input type="image" src="./img/acpt.png" id="acpt" /></center>
			</fieldset>
			</form>
			<div class="searchresult" id="divedit0" ></div>
			<form class="searchresult" id="formedit1" >
				<fieldset><legend><i>Empresa</i></legend><table width="70%" align="center"	>
							<tr>
								<td>
									<font face="Verdana" size="2" ><b><i>NIT:</i></b></font>
								</td>
								<td>	
									<input type="text" name="docid1" id="docid2" size="15" />
									<input type="hidden" name="oldid" id="oldid2" />
								</td>
								<td>
									<font face="Verdana" size="2"  ><b><i>Nombre:</i></b></font>
								</td>
								<td>									
									<input type="text" name="nombres1" id="nombres2" size="32" /> 									
								</td>								
							</tr>
							<tr>					
								<td>
									<font face="Verdana" size="2"  ><b><i>Direcci&oacute;n:</i></b></font>
								</td>
								<td>									
									<input type="text" name="diremp" id="diremp" size="32" />
									<input type="hidden" name="typ" value="1" /><input type="hidden" name="opcion" value="1" />
								</td>
								<td>
									<font face="Verdana" size="2"  ><b><i>Tarifa:</i></b></font>
								</td>
								<td><select name="tarifa" id="tarifa" >
											<option>--Seleccione--</option>
											<option>Afiliado</option>
											<option>Estudiante</option>
											<option>Invitado</option>
											<option>Matriculado</option>
											<option>Particular</option>
										</select>
								</td>
							</tr>
						</table><br><input type="image" src="./img/acpt.png" id="acpt" />
					</fieldset>
			</form>
			<div class="searchresult" id="divedit1" ></div>
			<form class="searchresult" id="formedit2" >
				<fieldset><legend><b>Evento</b></legend><table width="90%">
			
			<tr>
				
				<td colspan="4" >
					<iframe src="./js/upload2.html" width="100%" height="100%" ></iframe>
					<input type="hidden" name="nomfc" id="nomfch" value="blank.png" />
				</td>
			</tr>
			<tr>
				<td colspan="4" >
					<img src="./img/uploads/" id="imgch" />
				</td>
			</tr>
					<input type="hidden" name="ideve" id="ideve" />
					<input type="hidden" name="typ" value="1" /><input type="hidden" name="opcion" value="2" />
				
			<tr>
				<td>
					<font face="Verdana" size="3" ><b><i>Nombre del Evento: </i></b></font>
				</td>
				<td>
					<input type="text" name="nombres1" id="nomevent" size="32" />
				</td>
			
				<td>
					<font face="Verdana" size="3" ><b><i>Lugar del Evento: </i></b></font>
				</td>
				<td>
					<input type="text" name="apellidos1" id="placevent" size="32" />
				</td>
			</tr>
			<tr>
				<td>
					<font face="Verdana" size="3" ><b><i>Cupo de Inscripciones: </i></b></font>
				</td>
				<td>
					<input type="text" name="cupo" id="cupo" size="15" />
				</td>
			
				<td>
					<font face="Verdana" size="3" ><b><i>Fecha del Evento: </i></b></font>
				</td>
				<!--<td>
					
					<a href="javascript:doNothing()" onClick="setDateField(document.form1.fecevent);top.newWin=window.open("./js/calendar.html","cal","dependent=yes,width=210,height=230,screenX=400,screenY=200,titlebar=yes")"><input type="text" name="fecevent" size="15" class="required" /></a>
				</td>-->
				<td>
					<input type="text" name="fecevent" id="fecevent" class="fecha required" size="15" />
				</td>
			</tr>
			<tr>
				<td>
					<font face="Verdana" size="3" ><b><i>Hora del Evento: </i></b></font>
				</td>
				<td>
					<div class="sample2">
					<div><input type="text" id="hevent" name="hevent" size="15" /></div>
					
					</div>
				</td>	
				<td>
					<font face="Verdana" size="3" ><b><i>Estado: </i></b></font>
				</td>
				<td>
					<select id="estevent" name="estevent" >
						<option>--Seleccione--</option>
						<option>ACTIVO</option>
						<option>CERRADO</option>
				</td>
			</tr>
			<tr>
				<td><font face="Verdana" size="3" ><b><i>Este Evento Requiere Certificados</i></b></font></td>
				<td>
					<table>
						<tr>
							<td><font face="Verdana" size="3" ><b><i>SI</i></b></font></td>
							<td><input type="radio" name="certi" value="1" id="chcerts" class="certi2" /></td>
							<td><font face="Verdana" size="3" ><b><i>NO</i></b></font></td>
							<td><input type="radio" name="certi" value="2" id="chcertn" class="certi2"  /></td>
							
						</tr>
					</table></td>
			</tr>
			</table>
			<br>
			<div id="cert2" >
				<fieldset><legend><b><i>Variable de Certificaci&oacute;n</i></b></legend>
					<center>
						<textarea name="certvar" id="varcert" rows="4" cols="100" ></textarea>
					<br>
					<font face="Verdana" size="3" ><b><i>Fuente</i></b></font>&nbsp;&nbsp;<input type="text" name="fuecert" size="15" id="fuecert" />
					<br>
					<font face="Verdana" size="3" ><b><i>Fecha de Certificaci&oacute;n</i></b></font>&nbsp;&nbsp;<input type="text" name="fec_exp" size="15" id="fec_exp" class="fecha" />
					<br>
					<font face="Verdana" size="3" ><b><i>Lugar de Certificaci&oacute;n</i></b></font>&nbsp;<input type="text" name="place_exp" id="place_exp" size="15" />
					<br>
					<iframe src="./js/editfirm.html" width="100%" height="100%" ></iframe>
					<input type="hidden" name="firma" id="firma" size="15" />
					<br>
					<img id="imgfirm" />
					</center>
				</fieldset>
			</div>
			<br>
			<fieldset><legend><b><i>Fechas de Inscripciones </i></b></legend>
			<br>
			<table align="center" width="70%" >
			<tr>
			<td>
				<font face="Verdana" size="3" ><b><i>Fecha Inicio: </i></b></font>
			</td>
			<td>
				<input type="text" name="finicio" id="finicio" class="fecha" size="15" />
			</td>
			<td>
				<font face="Verdana" size="3" ><b><i>Fecha Cierre: </i></b></font>
			</td>
			<td>
				<input type="text" name="fcierre" id="fcierre" class="fecha" size="15" />
			</td>
			</tr>
			</table>
			</fieldset>
			<br>
			<center><input type="image" src="./img/acpt.png" id="acpt" /></center>
			</fieldset>
			</form>
			<div class="searchresult" id="divedit2" ></div>
			<form class="searchresult" id="formedit3" >
				<fieldset><legend ><i><b>Modulos</b></i></legend>
					<table align="center" id="tabmodedit" cellpadding="5" >
					<thead bgcolor="gray" >
						<th><i>Fecha</i></th><th><i>Modulo</i></th>
					</thead>
					<tbody>
					<tr>
						<td><input type="text" name="fmod1" id="fmod1" size="15" class="fecha" /></td><td><input type="text" name="modu1" id="modu1" class="required" size="80" /></td>
					</tr>
					</tbody>
					</table>
					<input type="hidden" name="typ" value="1" /><input type="hidden" name="opcion" value="3" /><input type="hidden" name="idmod" id="idmod" />
					<center><input type="image" src="./img/acpt.png" id="acpt" /></center>
				</fieldset>
			</form>
			<div class="searchresult" id="divedit3" ></div>
        </div>
		</div>
		<div id="tab9" class="tab_content">
			<div id="work9" class="workadmin" style='display:none' >
				<img src="./img/persona.png" style='border:1' />
				<font face="Verdana" size="6" ><b><i>Estados de Asistencia</i></b></font>
				<br><br><br>
				<form id="estados" >
					<font face="Verdana" size="3" ><b><i>Seleccione Evento</i></b></font>
						<select name="asisest" id="asisest" class="selectboxes" />
						<option value="0" >---Seleccione---</option>
						<?php
							$fecact = date("Y-m-d");
							//$sqlev = $db->consulta("select * from evento where `fec_fin` > '$fecact' and `fec_event` >= '$fecact'");
							$sqlev = $db->consulta("SELECT * FROM  `evento` WHERE  `fec_event` >=  '2016-01-01' ORDER BY  `evento`.`idevento` DESC ");
							while( $rowev = $db->fetch_array($sqlev)){
								echo "<option value=$rowev[idevento] >$rowev[idevento] - $rowev[nom_evento]</option>";
							}
						?>
						</select>
							<br>
							<font face="Verdana" size="3" ><b><i>Ingrese el Documento</i></b></font>
						<input type="text" name="cedest" id="cedest"  /><input type="image" src="./img/search.png" width="35" value="4" title="Buscar Asistente" />
						
						</form>
						
						<div id="resulestado" style="display:none" >
							<table width="70%" align="center">
								<thead>
									<tr bgcolor="silver" color="#FFFFFF">
										<th>Participante</th><th>Estado</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td id="nom" align="center" ></td><td id="est" align="center" ></td>
									</tr>
								</tbody>
							</table>
							<br>
							<center><a href="#" id="inscrito" class="boton botonest" value="0" >Inscrito</a><a href="#" id="asistio" class="boton botonest" value="1" >Asistio</a><a href="#" id="cancelado" class="boton botonest" value="3" >Cancelado</a><a href="#" id="eliminado" class="boton" value="4" >Eliminar</a></center>
						</div>
					</div>
		</div>
			<div id="tab10" class="tab_content">
			<div id="work10" class="workadmin" style='display:none' >
				<aside id="listopcion" >
					<img src="./img/options.png" /><br>
					<a href="#" class="button advc" value="regper" >Registrar Persona</a>
					<a href="#" class="button advc" value="regemp" >Registrar Empresa</a>
					<a href="#" class="button advc" value="chgemp" >Cambiar Relaci&oacute;n</a>
					<a href="#" class="button advc" value="newuser" >Crear Usuario</a>
					<a href="#" class="button advc" value="aduser" >Administrar Usuarios</a>
                                        <a href="#" class="button advc" value="chTarifa" >Cambiar tarifa de asistente</a>
                                        <a href="#" class="button advc" value="chTarifaEvento" >Cambiar tarifas de evento</a>
					
				</aside>
				<section id="listavanza" >
				<font face="Verdana" size="6" ><b><i>Opciones Avanzadas</i></b></font>
				<br><br><br>
				<form id="regper" style="display:none" class="hideform" >

					<fieldset><legend><b><i>Datos Personales del Participante</i></b></legend>
					<br>
					<table width="90%" align="center" id="cuerpoins"	>
						
							<tr>
								<td>
									<font face="Verdana" size="2"  ><b><i>Documento<br>de Identidad:</i></b></font>
								</td>
								<td>
									<br>
									<input type="text" name="docid1" id="docid1" size="32" class="required number" onkeypress="javascript:return validarNro(event)" /><font color="red" >*</font><input type="hidden" class="docid1" value="1" />
									
								</td>
								
								<td>
									<font face="Verdana" size="2"  ><b><i>Cargo:</i></b></font>
								</td>
								<td>
									
									<input type="text" name="cargo1" id="cargo1" size="32" class="cl1" />
								</td>
							</tr>
							<tr>
								<td>
									<font face="Verdana" size="2"  ><b><i>Nombres<br>completos:</i></b></font>
								</td>
								<td>
									<br><input type="text" name="nombres1" id="nombres1" size="32" class="required cl1" /><font color="red" >*</font>
							
								</td>
								<td>
									<font face="Verdana" size="2"  ><b><i>Apellidos<br>completos:</i></b></font>
								</td>
								<td>
									<br><input type="text" name="apellidos1" id="apellidos1" size="32" class="cl1" /><font color="red" >*</font>
									
								</td>
							</tr>	
							<tr>
								<td>
									<font face="Verdana" size="2"  ><b><i>E-mail:</i></b></font>
								</td>
								<td>
									
									<input type="text" name="mail1" id="mail1" size="32" class="required mail cl1" />
									
								</td>
								<td>
									<font face="Verdana" size="2"  ><b><i>Tel&eacute;fono:</i></b></font>
								</td>
								<td>
									
									<input type="text" name="tel1" id="tel1" size="25" class="required cl1" onkeypress="javascript:return validarNro(event)" /><font color="red" >*</font>
									&nbsp;
									<font face="Verdana" size="2"  ><b><i>Ext.</i></b></font>
									<input type="text" name="ext1" id="ext1" size="4" class="cl1" />
									
								</td>
							</tr>
							<tr>
								
								<td>
									<font face="Verdana" size="2"  ><b><i>Celular:</i></b></font>
								</td>
								<td>
									
									<input type="text" name="cel1" id="cel1" size="32" class="cl1" />
									
								</td>
								<td>
									<font face="Verdana" size="2"  ><b><i>Municipio:</i></b></font>
								</td>
								<td>
									<!--<input type="text" name="muni1" size="32" id="es" />-->
									<select name="muni1" id="muni1" class="cl1" >
										<option>---Seleccione---</option>
										<option>CALDAS</option>
										<option>ENVIGADO</option>
										<option>ITAGUI</option>
										<option>LA ESTRELLA</option>
										<option>SABANETA</option>
										<option>MEDELLIN</option>
									</select>
								</td>
							</tr>
							<tr>
								<td><font face="Verdana" size="2"  ><b><i>Comentario:</i></b></font></td>
								<td colspan="3" ><textarea name="coment1" id="coment1" rows="2" cols="120" ></textarea></td> 
							</tr>
							<tr>
								<td colspan="4" >
									<fieldset>
										<p>
											<font face="Verdana" size="1"  ><b><i>Dando cumplimiento a la Ley 1581 y a su Decreto Reglamentario 1377 de 2013, le informamos que Usted puede ejercer sus derechos a conocer, actualizar, rectificar y solicitar la supresi&oacute;n de los datos personales en cualquier momento.</i></b></font>
										</p>
										<p>
											<font face="Verdana" size="1"  ><b><i>La informaci&oacute;n de sus datos  la utilizaremos para: informar sobre nuestros servicios, enviar informaci&oacute;n de los eventos  y capacitaciones  ofrecidas por nuestra entidad y/o en convenio con otras organizaciones, o para realizar  estudios  sectoriales o investigaciones.</i></b></font>
										</p>
										<table width="90%" align="center" cellpadding="8" >
											<tr>
												<td><input type="radio" name="habeas1" value="SI" id="SI1" />&nbsp;<font face="Verdana" size="2"  ><b><i>Si Autorizo recibir Informaci&oacute;n</i></b></font> </td>
												<td><input type="radio" name="habeas1" value="NO" id="NO1" />&nbsp;<font face="Verdana" size="2"  ><b><i>NO Autorizo recibir Informaci&oacute;n</i></b></font> </td>
												<td><input type="radio" name="habeas1" value="NSNR" id="NR1" />&nbsp;<font face="Verdana" size="2"  ><b><i>NO Sabe / No Responde</i></b></font> </td>
											</tr>
											<tr>
												<td><font face="Verdana" size="2"  ><b><i>Quien autoriza el envio de informacion:</i></b></font></td>
												<td colspan="2" ><input type="text" name="who1" size="70" /></td>
											</tr>
										</table>
									</fieldset>
								</td>
							</tr>
							</table>
							<input type="hidden" name="tp" value="1" />
							<a href="#" class="button subreg" value="regper" >Aceptar</a>
				</fieldset>
				</form>
				<form id="regemp" style="display:none" class="hideform" >
					
					<fieldset><legend><b><i>Empresa o Persona Natural</i></b></legend>
						<table width="90%" align="center"	>
							<tr>
								<td>
									<font face="Verdana" size="2"  ><b><i>Identificaci&oacute;n:</i></b></font>
								</td>
								<td><input type="text" name="nit" size="32" class="required nit" onkeypress="javascript:return validarNro(event)" /> <font color="red" >*</font>
								</td>
								<td>
									<font face="Verdana" size="2"  ><b><i>Nombre:</i></b></font>
								</td>
								<td>									
									<input type="text" name="nomemp" id="nomemp" size="32" class="required" /> <font color="red" >*</font>									
								</td>								
							</tr>
							<tr>						
								<td>
									<font face="Verdana" size="2"  ><b><i>Direcci&oacute;n:</i></b></font>
								</td>
								<td>
									
									<input type="text" name="diremp" id="diremp" size="32" />
									
								</td>
								<td>
									<font face="Verdana" size="2"  ><b><i>Observaci&oacute;n:</i></b></font>
								</td>
								<td>
									
									<input type="text" name="observa" id="observa" size="32" />
									
								</td>
								<!--<td>
									<font face="Verdana" size="2"  ><b><i>Tarifa:</i></b></font>
								</td>
								<td><input type="hidden" name="pago" value="1" />
									<select name="tar" >
										<option>---Seleccione---</option>
										<option>Afiliado</option>
										<option>Estudiante</option>
										<option>Invitado</option>
										<option>Matriculado</option>
										<option>Particular</option>
									</select>
								</td>-->							
							</tr>
						</table>
						<br>
						<input type="hidden" name="tp" value="2" />
					<a href="#" class="button subreg" value="regemp" >Aceptar</a>
						</fieldset>
					
				</form>
				<form id="newuser" style="display:none" class="hideform" >
					
					<fieldset><legend><b><i>Crear Usuarios</i></b></legend>
						<table width="90%" align="center"	>
							<tr>
								<td>
									<font face="Verdana" size="2"  ><b><i>Identificaci&oacute;n:</i></b></font>
								</td>
								<td><input type="text" name="iduser" size="32" class="required" onkeypress="javascript:return validarNro(event)" /> <font color="red" >*</font>
								</td>
								<td>
									<font face="Verdana" size="2"  ><b><i>Nombre:</i></b></font>
								</td>
								<td>									
									<input type="text" name="nomuser" id="nomuser" size="32" class="required" /> <font color="red" >*</font>									
								</td>								
							</tr>
							<tr>						
								<td>
									<font face="Verdana" size="2"  ><b><i>Usuario</i></b></font>
								</td>
								<td>
									
									<input type="text" name="user" id="user" size="32" /> <font color="red" >*</font>
									
								</td>
								<td>
									<font face="Verdana" size="2"  ><b><i>Perfil</i></b></font>
								</td>
								<td>
									<select name="perfil" >
										<option value="5" >---Seleccione---</option>
										<option value="2" >Consulta</option>
										<option value="1" >Administrador</option>
										<option value="0" >Super Usuario</option>
									</select> <font color="red" >*</font>
								</td>							
							</tr>
							<tr>
								<td>
									<font face="Verdana" size="2"  ><b><i>Contrase&ntilde;a</i></b></font>
								</td>
								<td><input type="password" name="newpass" size="32" class="required" /> <font color="red" >*</font>
								</td>
								<td>
									<font face="Verdana" size="2"  ><b><i>Repetir Contrase&ntilde;a:</i></b></font>
								</td>
								<td>									
									<input type="password" name="rnewpass" size="32" class="required" /> <font color="red" >*</font>									
								</td>								
							</tr>
						</table>
						<br>
						<input type="hidden" name="tp" value="4" />
					<a href="#" class="button subreg" value="newuser" >Aceptar</a>
						</fieldset>
					
				</form>
				
				<form id="aduser" style="display:none" class="hideform" >
					<fieldset><legend><b><i>Administraci&oacute;n de Usuarios</i></b></legend>
					<div id="loaduser" >
					
					</div>
					</fieldset>
				</form>
                                <div id="chTarifa" style="display:none" class="hideform" >
                                    <fieldset><legend><b><i>Cambiar Tarifa Participante</i></b></legend>
                                     <font face="Verdana" size="3" ><b><i>Seleccione Evento</i></b></font><br>
                                    <select name="eventch" id="eventchTarifa" class="selectboxes" />
                                    <option value="0" >---Seleccione---</option>
                                    <?php

                                    $sqlev = $db->consulta("select * from evento where estado='ACTIVO' and pago='1'");
                                    while( $rowev = $db->fetch_array($sqlev)){
                                            echo "<option value=$rowev[idevento] >$rowev[idevento] - $rowev[nom_evento]</option>";
                                    }		
                                    ?>
                                    </select><br>
                                     <font face="Verdana" size="3" ><b><i>Cedula del Participante</i></b></font>&nbsp;
                                     <input type="text" name="cedpart"  id="cedpartTarifa" /><a href="#" class="button" id="findpartTarifa" >Consultar</a><br><br>
                                     <form name="changeTarifa" id="changeTarifa" style="display:none" >
                                        <font face="Verdana" size="3" ><b><i><span id="inscritoTarifa"></span></i></b></font>&nbsp;
                                        <input type="hidden" name="idpartTarifa" id="idpartTarifa" value="" />
                                        <input type="hidden" name="eventoTarifa" id="eventoTarifa" value="" />
                                        <input type="hidden" name="tp" value="5" />
                                        <select name="tarifaEvento" id="tarifaEvento" >
                                            <option>--Seleccione--</option>
                                            <option>Afiliado</option>
                                            <option>Estudiante</option>
                                            <option>Invitado</option>
                                            <option>Matriculado</option>
                                            <option>Particular</option>
                                        </select>
                                        <a href="#" class="button subreg" value="changeTarifa" >Aceptar</a>
                                     </form> 
				</div>
                                <div id="chTarifaEvento" style="display:none" class="hideform" >
                                    <fieldset><legend><b><i>Cambiar Tarifas de evento</i></b></legend>
                                     <font face="Verdana" size="3" ><b><i>Seleccione Evento</i></b></font><br>
                                    <select name="selectCambiarTarifaEvento" id="selectCambiarTarifaEvento" class="selectboxes" />
                                    <option value="0" >---Seleccione---</option>
                                    <?php

                                    $sqlev = $db->consulta("select * from evento where estado='ACTIVO' and pago='1'");
                                    while( $rowev = $db->fetch_array($sqlev)){
                                            echo "<option value=$rowev[idevento] >$rowev[idevento] - $rowev[nom_evento]</option>";
                                    }		
                                    ?>
                                    </select><br>                                    
                                     <form name="changeTarifaEvento" id="changeTarifaEvento" style="display:none" >
                                         <input type="hidden" name="tp" value="6" />
                                         <input type="hidden" name="idEventotarifa" id="idEventotarifa"  />
                                         <table>
                                            <tr><td><label>Afiliado</td><td><input type="text" name="tar1Afiliado" id="tarAfiliado" /><input type="hidden" name="tar1" value="Afiliado" /></td></tr>
                                            <tr><td><label>Matriculado</td><td><input type="text" name="tar2Matriculado" id="tarMatriculado" /><input type="hidden" name="tar2" value="Matriculado" /></td></tr>
                                            <tr><td><label>Particular</td><td><input type="text" name="tar3Particular" id="tarParticular" /><input type="hidden" name="tar3" value="Particular" /></td></tr>
                                        </table>    
                                        <a href="#" class="button subreg" value="changeTarifaEvento" >Aceptar</a>
                                     </form> 
				</div>
				<form id="chgemp" style="display:none" class="hideform" >
					<fieldset><legend><b><i>Cambiar Relaci&oacute;n Empresa-Participante</i></b></legend>
						 <font face="Verdana" size="3" ><b><i>Seleccione Evento</i></b></font><br>
						<select name="eventch" id="eventch" class="selectboxes" />
						<option value="0" >---Seleccione---</option>
						<?php
						
						$sqlev = $db->consulta("select * from evento where estado='ACTIVO' ");
						while( $rowev = $db->fetch_array($sqlev)){
							echo "<option value=$rowev[idevento] >$rowev[idevento] - $rowev[nom_evento]</option>";
						}		
						?>
						</select><br>
						 <font face="Verdana" size="3" ><b><i>Cedula del Participante</i></b></font>&nbsp;<input type="text" name="cedpart"  id="cedpart" /><a href="#" class="button" id="findpart" >Consultar</a><br><br>
						 <div id="relacion" style="display:none" >
							<font face="Verdana" size="3" ><b><i>La relaci&oacute;n Empresarial Actual de <br><span id="spart" ></span> <br><br>es con la Empresa:<br> <span id="sempr" ></span></i></b></font>
							<br><br>
						<fieldset>
							<font face="Verdana" size="3" ><b><i>NIT Nueva Relaci&oacute;n</font>&nbsp;<input type="text" name="newnit" />
							<br><br>
							<input type="hidden" name="tp" value="3" />
							<input type="hidden" name="nit" id="actnit" />
						<a href="#" class="button subreg" value="chgemp" >Cambiar Relaci&oacute;n</a>
						</fieldset>
						 </div>
						 <br>
						
					</fieldset>
				</form>
				</section>
			</div>
		</div>
    </div>
	
		
		
		
		
    </div>




			
			</td>
		</tr>


		</table>
<div style="display:none" ><input type="text" id="divpass" /><input type="text" id="divuser" /><input type="text" id="divperf" /></div>
	</body>

</html>