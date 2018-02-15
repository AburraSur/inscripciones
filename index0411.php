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
<LINK href="./estilo/divestilo.css" rel="stylesheet" type="text/css">
<LINK href="./estilo/style.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="./js/main.css" media="screen" />
	
<SCRIPT LANGUAGE="JavaScript" SRC="./js/calendar.js"></SCRIPT>
<script type="text/javascript"
src="./js/jquery.min.js"></script>
<script src="./js/jquery.js"></script>
  <script type="text/javascript" src="./js/jquery-validate.js"></script>
  <script src="./js/jquery-1.4.2.min.js"></script>
  <script language="javascript" src="./js/jquery-1.3.1.min.js"></script>
<script language="javascript" src="./js/AjaxUpload.2.0.min.js"></script>
<script>
$(document).ready(function(){
	$(".mailresp").hide("fast");
	var button = $('#upload_button'), interval;
	new AjaxUpload('#upload_button', {
        action: 'upload.php',
		onSubmit : function(file , ext){
		if (! (ext && /^(jpg|png|jpeg|gif)$/.test(ext))){
			// extensiones permitidas
			alert('Error: Solo se permiten imagenes');
			// cancela upload
			return false;
		} else {
			
			this.disable();
		}
		},
		onComplete: function(file, response){
			
			// enable upload button
			this.enable();			
			// Agrega archivo a la lista
			$('#lista').attr('value',file);
			$('#images').attr('src','./uploads/'+file);
			
		}	
	});
	
	
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
	<script type="text/javascript"> 
$(document).ready(
			function () {
				$('#sample2 input').ptTimeSelect();
			}
		);

</script>
<link type="text/css" href="./js/jquery-ui-1.8.1.custom.css" rel="Stylesheet" />   
   <script type="text/javascript" src="./js/jquery-ui-1.8.1.custom.min.js"></script>
   <script type="text/javascript" src="./js/jquery.ui.datepicker-es.js"></script>
   <script src="./js/jquery.blockUI-validate.js" ></script>
   <script>
   $(document).ready(function(){
	
		$(".fecha").datepicker({
			//showOn: 'both',
			buttonImage: 'calendar.png',
			buttonImageOnly: true,
			changeYear: true,
			numberOfMonths: 1,
      
		});
	});
</script>
<style>
body{
background-attachment: fixed;

}

.shot{
 position:absolute;
 top:80;
 right:15%;
 
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
	
	<a href='http://www.ccas.org.co' id='sht' ><img src='./img/shutdown.png' class='shot' width='80' height='80'   /></a>
		<table width="80%" height="100%" align="center">
		<tr>
			<td>
				
	
    <ul class="tabs">
        <li class="user2" ><a href="#tab1"><font face="Verdana" size="2" color="#475B70" align="center"><i><B>Crear Evento</B></i></font></a></li>
        <li class="user2" ><a href="#tab2"><font face="Verdana" size="2" color="#475B70" align="center"><i><B>Cerrar Evento</B></i></font></a></li>
        <li><a href="#tab3"><font face="Verdana" size="2" color="#475B70" align="center"><i><B>Ver Inscripciones</B></i></font></a></li>
		<li><a href="#tab4"><font face="Verdana" size="2" color="#475B70" align="center"><i><B>Eventos Cerrados</B></i></font></a></li>
		<li><a href="#tab5"><font face="Verdana" size="2" color="#475B70" align="center"><i><B>Pagos</B></i></font></a></li>	
		<li><a href="#tab6"><font face="Verdana" size="2" color="#475B70" align="center"><i><B>Asistencia</B></i></font></a></li>	
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
				<td>
					<div id="upload_button"></div>
				</td>
				<td>
					<br><img src="./img/back.png" id="images" width="90%" height="30%" />
				</td>
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
					<input type="text" name="cupo" size="15" class="required" />
				</td>
			
				<td>
					<font face="Verdana" size="3" ><b><i>Fecha del Evento: </i></b></font>
				</td>
				<!--<td>
					
					<a href="javascript:doNothing()" onClick="setDateField(document.form1.fecevent);top.newWin=window.open('./js/calendar.html','cal','dependent=yes,width=210,height=230,screenX=400,screenY=200,titlebar=yes')"><input type="text" name="fecevent" size="15" class="required" /></a>
				</td>-->
				<td>
					<input type="text" name="fecevent" id="fecha" class="fecha required" size="15" />
				</td>
			</tr>
			<tr>
				<td>
					<font face="Verdana" size="3" ><b><i>Hora del Evento: </i></b></font>
				</td>
				<td>
					<div id="sample2">
					<div><input type="text" name="hevent" size="15" class="required" /></div>
					
					</div>
				</td>
			
				<td>
					<font face="Verdana" size="3" ><b><i>Responsable del Evento: </i></b></font>
				</td>
				<td>
					<select name="respon" id="resp" >
						<option>--Seleccione--</option>
						<option value="1" >Promocion</option>
						<option value="2" >UCI</option>
				</td>
			</tr>
			<tr>
				<td>
					<font face="Verdana" size="3" class="mailresp"  ><b><i>Correo del Responsable: </i></b></font>
				</td>
				<td>
					<input type="text" name="mailresp" size="32" class="mailresp"  />
				</td>
				<td>
					<font face="Verdana" size="3" class="mailresp" ><b><i>Evento con Modulos: </i></b></font>
				</td>
				<td>
					<table>
						<tr>
							<td><font face="Verdana" size="3" class="mailresp" ><b><i>SI</i></b></font></td>
							<td><input type="radio" name="modulo" value="SI" class="modulo mailresp" /></td>
							<td><font face="Verdana" size="3" class="mailresp" ><b><i>NO</i></b></font></td>
							<td><input type="radio" name="modulo" value="NO" checked class="modulo mailresp"  /></td>
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
							<td><input type="radio" name="pago" value="1" class="pago" /></td>
							<td><font face="Verdana" size="3" class="pago" ><b><i>NO</i></b></font></td>
							<td><input type="radio" name="pago" value="2" checked class="pago"  /></td>
						</tr>
					</table>
				</td>
				<td></td>
				<td></td>
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
			</fieldset>
			<input type="hidden" name="list" id="lista">
			<br>
			<fieldset><legend><b><i>Fechas de Inscripciones </i></b></legend>
			<br>
			<table align="center" width="70%" >
			<tr>
			<td>
				<font face="Verdana" size="3" ><b><i>Fecha Inicio: </i></b></font>
			</td>
			<td>
				<input type="text" name="finicio" class="fecha" size="15" />
			</td>
			<td>
				<font face="Verdana" size="3" ><b><i>Fecha Cierre: </i></b></font>
			</td>
			<td>
				<input type="text" name="fcierre" class="fecha" size="15" />
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
            <img src="./img/search.png" />
			<font face="Verdana" size="6" ><b><i>Inscripciones</i></b></font>
			<img src="./img/refresh.png" id="refresh" />
			<br><br><br><br><br><br>
			<fieldset id="tb" >
			
			</fieldset>
			<br>
			
        </div>
       </div>
		
		<div id="tab4" class="tab_content">
		<div id="work4" class="work" style='display:none' >
		<br><br>
		<img src="./img/closed.png" class="closed"/>
		<br><br><br><br><br><br><br><br><br><br>
		  <form name="form4" id="form4">
		 
		  <center>
		 <font face="Verdana" size="3" ><b><i>Seleccione Evento</i></b></font><br>
			<select name="event_closed" id="select2" >
		
			</select>
		
		<br><br><br>
		<div id="fl2"></div>
		</center>
		</form>
		
        </div>
		</div>
		
		<div id="tab5" class="tab_content">
		<div id="work5" class="work" style='display:none' >
		<img src="./img/money.png" style='border:1' />
		<font face="Verdana" size="6" ><b><i>Eventos con Pago</i></b></font>
		<br><br><br><br>
		 <font face="Verdana" size="3" ><b><i>Seleccione Evento</i></b></font>
		<select name="payevent" id="payevent" class="selectboxes" />
		<option>---Seleccione---</option>
		<?php
		
		$sqlemp = $db->consulta("select * from evento where pago=1 ");
		while( $rowemp = $db->fetch_array($sqlemp)){
			echo "<option value=$rowemp[idevento] >$rowemp[nom_evento]</option>";
		}
		
			
		?>
		</select>
		<br><br>
		<form id="divpay" >
		
		
		</form>
		
		
        </div>
		</div>
		<div id="tab6" class="tab_content">
		<div id="work6" class="work" style='display:none' >
		<img src="./img/lists.png" id="asis" />
		<div bgcolor="red" >&nbsp;acacaca</div>
		<font face="Verdana" size="6" ><b><i>Asistencia por Evento</i></b></font>
		<br>
		 <font face="Verdana" size="3" ><b><i>Seleccione Evento</i></b></font><br>
		<select name="asiseve" id="asiseve" class="selectboxes" />
		<option>---Seleccione---</option>
		<?php
		
		$sqlev = $db->consulta("select * from evento where estado='ACTIVO' ");
		while( $rowev = $db->fetch_array($sqlev)){
			echo "<option value=$rowev[idevento] >$rowev[nom_evento]</option>";
		}
		
			
		?>
		</select>
		<font face="Verdana" size="3" class="asismod" style="display:none" ><b><i>Seleccione Modulo</i></b></font>
		<select name="asismod" id="asismod" class="selectboxes asismod" style="display:none" >
		
		</select>
		
		<br><br>
		<form id="divasis" >
		
		
		</form>
		
		
        </div>
		</div>
		
		
		
		
    </div>
	
		
		
		
		
    </div>




			
			</td>
		</tr>


		</table>

	</body>

</html>