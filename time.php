<?php
include('./conexion.php');
$cod=0;
session_start();
$cod=$_SESSION['iduser'];


//if($cod == 0 || $perfil != 'ADMIN'){ header("Location: ./index.php");}

?>
<html>
<head>
<title>Area Administrativa</title>


<SCRIPT LANGUAGE="JavaScript" SRC="./js/calendar.js"></SCRIPT>
<script type="text/javascript"
src="./js/jquery.min.js"></script>
<script src="./js/jquery.js"></script>
  <script type="text/javascript" src="./js/jquery-validate.js"></script>
  <script src="./js/jquery-1.4.2.min.js"></script>
  <script language="javascript" src="./js/jquery-1.3.1.min.js"></script>
<script language="javascript" src="./js/AjaxUpload.2.0.min.js"></script>
<script src="./js/jquery.blockUI-validate.js"></script>
<script src="./js/time.js"></script>
<script type="text/javascript"> 
$(document).ready(function() {
 
	$("#select1").load('./js/eventos.php');
	$("#select2").load('./js/event_closed.php');
	$("#tb").load('./js/listados.php');
	
	/*$('#input').bind('blur', function() {
      
    $(this).val(function(i, val) {
      return val.toUpperCase();
    });
    
  });*/
  
  var refreshId = setInterval(function()
{
     $('#tb').fadeOut("slow").load('./js/listados.php').fadeIn("slow");
}, 10000);
  
  $("#boton").mouseover(function(){
	$(this).attr("src","./img/button-3.png");
	});
	
	$("#boton").mouseout(function(){
	$(this).attr("src","./img/button-4.png");
	});
	
	$("#boton2").mouseover(function(){
	$(this).attr("src","./img/button-log2.png");
	});
	
	$("#boton2").mouseout(function(){
	$(this).attr("src","./img/button-log.png");
	});

	$("#boton3").mouseover(function(){
	$(this).attr("src","./img/button-cl2.png");
	});
	
	$("#boton3").mouseout(function(){
	$(this).attr("src","./img/button-close.png");
	});
	
	$("#boton4").mouseover(function(){
	$(this).attr("src","./img/button-c2.png");
	});
	
	$("#boton4").mouseout(function(){
	$(this).attr("src","./img/button-c.png");
	});

	$(".tab_content").hide(); 
	$("ul.tabs li:first").addClass("active").show(); 
	$(".tab_content:first").show(); 
	
	
	$("ul.tabs li").click(function() {
		$("ul.tabs li").removeClass("active"); 
		$(this).addClass("active"); 
		$(".tab_content").hide(); 
		var activeTab = $(this).find("a").attr("href"); 
		$(activeTab).fadeIn(); 
		return false;
	});
	
	$().timepicker({
		hourGrid: 4,
		minuteGrid: 10
	});

 
});

$(document).ready(function(){
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

$(document).ready(function(){

	$("#form1").validate();
	


    $("#form1").submit(function(){
		
		
		$.ajax({
			url: "./insert/event.php",
			type: "POST",
			data: $('#form1').serialize(),
			success: function ( data ){
			
				 var obj = eval( "(" + data + ")" );
			if(obj.enviar == 1){
				
			$.blockUI({ message: '<h3><img src=./img/check2.png /><br>Registro Exitoso.<br>a Continuacion podras visualizar el link del formulario de registro</h3>' });
				/*$("#link").remove();
				$("#mail").append("<input type=text size=100 name=link id=link value='http://192.168.1.32/tools/activos/promocion/maestro/confor3.php?cod="+obj.capa+"'/>");
				 $('#link').focus();*/
				setTimeout($.unblockUI, 4000); 
				
				$("#select1").load('./js/eventos.php');
				$("#tb").load('./js/listados.php');
				$("#mail").load('./insert/mail.php?cod='+obj.capa);
				
				
				$('#form1').each (function(){
					this.reset();
					
				})
				$('#images').attr('src','./img/back.png');
				
				
			}
			if(obj.enviar == 2){
			$.blockUI({ message: '<h3><img src=./img/bad.png /><br>Los Datos Son Incorrectos.<br> Por Favor Verificarlos.</h3>' });
			setTimeout($.unblockUI, 3000); 
			
			
			}
			
			}
		})
		return false;
		
	})
	
	 $("#form2").submit(function(){
	
		$.ajax({
			url: "./insert/login.php",
			type: "POST",
			data: $('#form2').serialize(),
			success: function ( data ){
			
				 var obj = eval( "(" + data + ")" );
			if(obj.enviar == 1){
								
			$.blockUI({ message: '<h3><img src=./img/check2.png />Bienvenido.</h3>' });				
				setTimeout($.unblockUI, 2000); 
				
				$("#work").show("slow");
				$("#work2").show("slow");
				$("#work3").show("slow");
				$("#work4").show("slow");
				$("#sht").show();
				$("#login").remove();
				$(".tab_container").append("<a href=./cerrar.php id=sht ><img src=./img/shutdown.png class=shot width=80 height=80  /></a>");
			}
			if(obj.enviar == 2){
			$.blockUI({ message: '<h3><img src=./img/bad.png /><br>Los Datos Son Incorrectos.<br> Por Favor Verificarlos.</h3>' });
			setTimeout($.unblockUI, 3000); 
			
			
			}
			
			}
		})
		return false;
	
	});
	
	$("#form3").submit(function(){
	
	
	$.ajax({
			url: "./insert/closed.php",
			type: "POST",
			data: $('#form3').serialize(),
			success: function ( data ){
			
				 var obj = eval( "(" + data + ")" );
			if(obj.enviar == 1){
								
			$.blockUI({ message: '<h3><img src=./img/check2.png />Evento '+obj.capa+'<br>Se Cerro Exitosamente.</h3>' });				
				setTimeout($.unblockUI, 2000); 
				
				$("#select1").load('./js/eventos.php');
				$("#select2").load('./js/event_closed.php');
				
			}
			if(obj.enviar == 2){
			$.blockUI({ message: '<h3><img src=./img/bad.png /><br>Se Produjo un Error al Cerrar el Evento Seleccionado.</h3>' });
			setTimeout($.unblockUI, 3000); 
			
			
			}
			
			}
		})
	return false;
	});
	
	$("#select2").change(function(){
				
				$("#list2").remove();
				
				var id=$(this).val();
				
				$("#fl2").append("<div id=imagen><a href=./informes/event_closed.php?cod="+id+" id=list2 ><img src='./img/lists.png' class=list22 title='Ver listado de Asistentes' width=50 /><br>Ver Listado</a></div>");
			
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
 right:320;
 
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

/* css for timepicker */
.ui-timepicker-div .ui-widget-header { margin-bottom: 8px; }
.ui-timepicker-div dl { text-align: left; }
.ui-timepicker-div dl dt { height: 25px; margin-bottom: -25px; }
.ui-timepicker-div dl dd { margin: 0 10px 10px 65px; }
.ui-timepicker-div td { font-size: 90%; }
.ui-tpicker-grid-label { background: none; border: none; margin: 0; padding: 0; }
</style>


</head>

	<body background="./img/bg2.jpg" >
		<table width="60%" height="60%" align="center">
		<tr>
			<td>
				
	
    <ul class="tabs">
        <li><a href="#tab1"><font face="Verdana" size="2" color="#475B70" align="center"><i><B>Crear Evento</B></i></font></a></li>
        <li><a href="#tab2"><font face="Verdana" size="2" color="#475B70" align="center"><i><B>Cerrar Evento</B></i></font></a></li>
        <li><a href="#tab3"><font face="Verdana" size="2" color="#475B70" align="center"><i><B>Ver Inscripciones</B></i></font></a></li>
		<li><a href="#tab4"><font face="Verdana" size="2" color="#475B70" align="center"><i><B>Eventos Cerrados</B></i></font></a></li>
        
		
    </ul>
    <div class="tab_container">
	
        <div id="tab1" class="tab_content">
		<?php
		if(isset($_SESSION['iduser'])){
			echo "<div id=work style='display:block' >";
			}else{
			
			echo "<div id=work style='display:none' >";
			}
		?>
		
		<img src="./img/addevent.png" />
		<font face="Verdana" size="6" ><b><i>NUEVO EVENTO</i></b></font>
		
		<br><br>
       
			
		  <form name="form1" id="form1">
		  
			<table width="60%">
			<tr>
				<td>
					<font face="Verdana" size="3" ><b><i>Nombre del Evento: </i></b></font>
				</td>
				<td>
					<input type="text" name="namevent" size="32" id="input" class="required" />
				</td>
			</tr>
			<tr>
				<td>
					<font face="Verdana" size="3" ><b><i>Fecha del Evento: </i></b></font>
				</td>
				<td>
					<input type="text" name="fecevent" size="15" id="input" class="required" />
					<a href="javascript:doNothing()" onClick="setDateField(document.form1.fecevent);top.newWin=window.open('./js/calendar.html','cal','dependent=yes,width=210,height=230,screenX=200,screenY=300,titlebar=yes')"><img src="./js/calendar.gif" border=0></a>
				</td>
			</tr>
			<tr>
				<td>
					<font face="Verdana" size="3" ><b><i>Hora del Evento: </i></b></font>
				</td>
				<td>
					<input type="text" name="hevent" size="15" id="input2" class="required" />
				</td>
			</tr>
			<tr>
				<td>
					<div id="upload_button"></div>
				</td>
				<td>
					<br><img src="./img/back.png" id="images" width="90%" height="30%" />
				</td>
			</tr>
			</table>
			<input type="hidden" name="list" id="lista">
			<br>
			<fieldset><legend><b><i>Fechas de Inscripciones </i></b></legend>
			<br>
			<table>
			<tr>
			<td>
			<font face="Verdana" size="3" ><b><i>Fecha Inicio: </i></b></font>
			</td>
			<td>
			<input type="text" name="finicio" size="15" id="es" class="required dateISO" />
			</td>
			<td>
			<a href="javascript:doNothing()" onClick="setDateField(document.form1.finicio);top.newWin=window.open('./js/calendar.html','cal','dependent=yes,width=210,height=230,screenX=200,screenY=300,titlebar=yes')"><img src="./js/calendar.gif" border=0></a>
			</td>
			<td>
			<font face="Verdana" size="3" ><b><i>Fecha Cierre: </i></b></font>
			<input type="text" name="fcierre" size="15" id="es" class="required dateISO" />
			</td>
			<td>
			<a href="javascript:doNothing()" onClick="setDateField(document.form1.fcierre);top.newWin=window.open('./js/calendar.html','cal','dependent=yes,width=210,height=230,screenX=200,screenY=300,titlebar=yes')"><img src="./js/calendar.gif" border=0></a>
			</td>
			</tr>
			</table>
			</fieldset>
			<br>
			<center><input type="image" src="./img/button-4.png" id="boton" /></center>
		  </form>
		  <div id="mail" ></div>
		  <div id="exit" ></div>
		  </div>
		  
			<?php
		if(!isset($_SESSION['iduser'])){
			echo "<div id=login style='display:block' >";
			}else{
			
			echo "<div id=login style='display:none' >";
			}
		?>
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
		
        <div id="tab2" class="tab_content">
		<?php
		if(isset($_SESSION['iduser'])){
			echo "<div id=work2 style='display:block' >";
			}else{
			
			echo "<div id=work2 style='display:none' >";
			}
		?>
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
		<?php
		if(isset($_SESSION['iduser'])){
			echo "<div id=work3 style='display:block' >";
			}else{
			
			echo "<div id=work3 style='display:none' >";
			}
		?>
            <img src="./img/search.png" />
			<font face="Verdana" size="6" ><b><i>Inscripciones</i></b></font>
			<br><br><br><br><br>
			<fieldset id="tb" >
			
			</fieldset>
			<br>
			
        </div>
       </div>
		
		<div id="tab4" class="tab_content">
		<?php
		if(isset($_SESSION['iduser'])){
			echo "<div id=work4 style='display:block' >";
			}else{
			
			echo "<div id=work4 style='display:none' >";
			}
		?>
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
		
		
    </div>




			
			</td>
		</tr>


		</table>

	</body>

</html>