<?php

include("../conexion.php");

$idevent=$_GET[cod];
					$sql=mysql_query("select nom_evento,estado,fec_inicio,fec_fin,image from evento where idevento=$idevent ");
					$row=mysql_fetch_array($sql);
					
					$fec_ini=(strtotime("$row[fec_inicio]"))/86400;
					$fec_fin=(strtotime("$row[fec_fin]"))/86400;
					$fec_act=(strtotime(date("Y-m-d")))/86400;
					$fecha=date("Y-m-d");
					$hora=date("H:i");
					$h="18:00";
					
					
?>
<html>
<head><title>Inscripciones</title>
<link rel="icon" type="image/gif" href="../img/shopping.ico" /> 
 <LINK href="../estilo/divestilo.css" rel="stylesheet" type="text/css">
<LINK href="../estilo/button.css" rel="stylesheet" type="text/css">
<script src="../js/jquery-1.4.2.min.js"></script>
<script src="../js/jquery.blockUI-validate.js"></script>
<script type="text/javascript" src="js/jquery-1.4.2.js"></script>
<script  language="JavaScript" type="text/javascript"> 
  $(document).ready(function(){
  $("#idd").load("./cupo.php?id=<?php echo $idevent; ?>");
  
  $.blockUI({ message: '<img src=../img/welcome.png /><br><h3>Bienvenido al Formulario de Inscripción.</h3><p align=justify >Señor Usuario, tenga en cuenta que los datos personales suministrados en este formulario son los utilizados para la respectiva certificación, por lo tanto le agradecemos revisar la gramática y ortografía del mismo antes de enviarlo.</p><input type="image" src="../img/salir.png" id="boton2" />'  });
	
	$("#boton2").click(function(){
				 $.blockUI({ 
					fadeIn: 1000, 
					timeout:   2000, 
					onBlock: function() { 
						
					} 
					}); 
				
				
				});	

		$("#add").click(function(event){
		
			/*$.ajax({
				url: './cupo.php?id=<?php echo $idevent; ?>',
				success: function (data) {
					var id = eval ( "(" + data + ")" );
					
				}
				
			})
			return false;*/
			
				
				var cupo = $("#idd").html();
			
			
					var numtr = ($('#cuerpoins >tbody >tr').length/4)+1;
					
					
					if(numtr <= cupo){
					
					//alert(numtr);
					var tds = '<tr class='+numtr+'><td><br><br><font face="Verdana" size="2"  ><b><i>Nombres<br>completos:</i></b></font></td><td><br><br><br><input type="text" name=nombres'+numtr+' size="32" class="required" id="es" /><font color=red >*</font></td><td><br><br><font face="Verdana" size="2"  ><b><i>Apellidos<br>completos:</i></b></font></td><td><br><br><br><input type="text" name=apellidos'+numtr+' size="32" id="es" /><font color=red >*</font></td></tr><tr class='+numtr+'><td><font face="Verdana" size="2"  ><b><i>Documento<br>de Identidad:</i></b></font></td><td><br><input type="text" name=docid'+numtr+' size="32" class="required number" id="es" /><font color=red >*</font></td><td><font face="Verdana" size="2"  ><b><i>Cargo:</i></b></font></td><td><input type="text" name=cargo'+numtr+' size="32" id="es" /></td></tr><tr class='+numtr+'><td><font face="Verdana" size="2"  ><b><i>E-mail:</i></b></font></td><td><input type="text" name=mail'+numtr+' size="32" class="required mail" id="es" /></td><td><font face="Verdana" size="2"  ><b><i>Tel&eacute;fono:</i></b></font></td><td><input type="text" name=tel'+numtr+' size="32" class="required number" id="es" /><font color=red >*</font></td></tr><tr class='+numtr+'><td><font face="Verdana" size="2"  ><b><i>Celular:</i></b></font></td><td><input type="text" name=cel'+numtr+' size="32" id="es" /></td><td><font face="Verdana" size="2"  ><b><i>Municipio:</i></b></font></td><td><select name=muni'+numtr+' id="es" ><option>---Seleccione---</option><option>Caldas</option><option>Envigado</option><option>Itagui</option><option>La Estrella</option><option>Sabaneta</option><option>Medellin</option></td></tr>';
					
					$("#cuerpoins").append(tds); 
					$("#ctrl").attr('value',numtr);
					
							$('input').bind('blur', function() {
      
								$(this).val(function(i, val) {
								return val.toUpperCase();
								});
    
							});
							
							  $('.mail').bind('blur', function() {
      
									$(this).val(function(i, val) {
									return val.toLowerCase();
									});
									
									var mail = $(this).val();
		var filter = /[\w-\.]{3,}@([\w-]{2,}\.)*([\w-]{2,}\.)[\w-]{2,4}/;
		//alert(mail);
		if (filter.test(mail)){
                 $(".note").remove();
				 $(".falta2").removeClass();
				}
        else{
              
				 $(this).addClass("falta2").after("<br class=note ><span class=note >Correo Invalido</span>");
				}
    
								});
					}else{
						$.blockUI({ message: '<h3><img src=../img/bad.png width=50 height=50 /><br>Para este evento usted puede registrar maximo 3 participantes.</h3>' });
						setTimeout($.unblockUI, 3000); 
					}
					
					});	

		$("#delete").click(function(){
			var del = $("#ctrl").val();
			if( del != 1){
			$('.'+del+'').remove();
			var ctrm = del-1;
			$("#ctrl").attr('value',ctrm);
			}
		});
				
 $('input').bind('blur', function() {
      
    $(this).val(function(i, val) {
      return val.toUpperCase();
    });
    
  });
  $('textarea').bind('blur', function() {
      
    $(this).val(function(i, val) {
      return val.toUpperCase();
    });
    
  });
  
  $('.mail').bind('blur', function() {
      
    $(this).val(function(i, val) {
      return val.toLowerCase();
    });
	
	var mail = $(this).val();
		var filter = /[\w-\.]{3,}@([\w-]{2,}\.)*([\w-]{2,}\.)[\w-]{2,4}/;
		//alert(mail);
		if (filter.test(mail)){
                 $(".note").remove();
				 $(".falta2").removeClass();
				}
        else{
              
				 $(this).addClass("falta2").after("<br class=note ><span class=note >Correo Invalido</span>");
				}
		
    
  });
  
 
  
  $("#boton").mouseover(function(){
	$(this).attr("src","../img/button-2.png");
	});
	
	$("#boton").mouseout(function(){
	$(this).attr("src","../img/button-1.png");
	});
  
  
    $("#form1").validate();
	});
	
	
	
	$(document).ready(function(){	
		
	
	$("#form1").submit(function(){
		
		$.blockUI({ message: '<h3><img src=../img/check2.png width=50 height=50 /><img src=../img/wait.gif /><b><i>Por Favor Espere...</h3><br>' });
		$.ajax({
			url: "../insert/inscrip2.php",
			type: "POST",
			data: $("#form1").serialize(),
			success: function ( data ){
			
				 var obj = eval( "(" + data + ")" );
				 
				 
			if(obj.enviar == 1){
			
			$.blockUI({ message: '<h3><img src=../img/check2.png width=50 height=50 />Inscripción Exitosa.<br>Un correo de confirmación ha sido enviado<br>a cada una de las personas inscritas!</h3><br><input type="image" src="../img/salir.png" id="salida" />' });
				
				//setTimeout($.unblockUI, 4000); 
				$("#salida").click(function(){
				
					$('#form1').each (function(){
					this.reset();
					$("#boton").remove();
					
					})
					
					window.location="http://www.ccas.org.co";
					
				});
				
				
			}
			if(obj.enviar == 2){
			$.blockUI({ message: '<h3><img src=../img/bad.png /><br>'+obj.mensaje+'.</h3>' });
			setTimeout($.unblockUI, 5000); 
			
			
			}
			
			}
		})
		return false;
		
	})
	
	$("#logout").click(function(){
		alert("Gracias por Visitarnos.");
		window.location="http://www.ccas.org.co";
	});
	
	});
	
	
 </script> 
 <script language="javascript">

function validarNro(e) {

var key;

if(window.event) // IE

{

key = e.keyCode;

}

else if(e.which) // Netscape/Firefox/Opera

{

key = e.which;

}

if (key < 48 || key > 57)

{
if(key != 08){
return false;
}
}

return true;

}

</script>
 <style>
 #shot{
 position:absolute;
 top:50;
 right:200;
 
}
#shot2{
 position:absolute;
 top:50;
 right:300;
 
}

 #tcenter {background: url("../img/fachacentro1.jpg") fixed center no-repeat;} 
 </style>
</head>

	<body background="../img/bg2.jpg" ><div id="idd" style="display:none" ></div>
		<table width="85%" height="100%" align="center"  >
		<tr>
			<td>
				<div> 
				<b class="spiffy"> 
				<b class="spiffy1"><b></b></b>
				<b class="spiffy2"><b></b></b>
				<b class="spiffy3"></b>
				<b class="spiffy4"></b>
				<b class="spiffy5"></b> 
				</b> <div class="spiffy_content">
<fieldset>
<?php
if(($fec_act >= $fec_ini) && ($fec_act <= $fec_fin) && ($row[estado] == 'ACTIVO')){
		if(($fec_act == $fec_fin) && ( $hora >= $h)){ ?>
			<table width="100%" align="center">
		<tr>
			<td>
				<center>
					<?php
					mysql_query("update evento set estado='CERRADO' where idevento=$idevent ");
					echo "<img src=../uploads/$row[image] height=250 width=1000  id=sede />	";
					?>
								
				</center>			
			</td>
		</tr>
		<tr>
			<td>
				<center>
					<?php
					
					echo "<font face=Verdana size=6  ><b><i>$row[nom_evento]</i></b></font>	";
					?>
								
				</center>			
			</td>
		</tr>		
		
		<tr>
			<td>
				<center>
					<font face="Verdana" size="6"  ><b><i>Las Inscripciones para este Evento<br>se Encuentran Cerradas</i></b></font>
							
				</center>			
			</td>
		</tr>
		<tr>
			<td>
				<center>
					<a href="http://www.ccas.org.co" ><img src="../img/exit.png" /><br><font face="Verdana" size="2"  ><b><i>Salir</i></b></font></a>			
				</center>			
			</td>
		</tr>
<?php		
		}else{				
?>
	<table  align="center" id="tcenter" >
				
		<tr>
			<td>
				<center>
					<?php
					
					echo "<img src=../uploads/$row[image]  id=sede />";
					?>
								
				</center>			
			</td>
		</tr>
		<tr>
			<td>
				<table width="100%" >
					<tr><td align="left" ><font size="2" color="red" ><i><b>Los campos marcados con * son obligatorios</b></i></font></td><td align="right" ><a href="#" id="logout" ><b><i>Salida Segura</i></b><img src="../img/logout.png" /></a>		</td></tr></table>
			</td>
		</tr>
		
				 
				
		<tr>
			<td>
				
				
				<form id="form1" action="#" >
				
				<?php
				
				echo "<input type=hidden name=idevent value=$idevent />";
				?>
				<fieldset><legend><b><i>Empresa</i></b></legend>
						<table width="90%" align="center"	>
							<tr>
								<td>
									<font face="Verdana" size="2"  ><b><i>NIT:</i></b></font>
								</td>
								<td>
									&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
									<input type="text" name="nit" size="15" class="required" id="es" onkeypress="javascript:return validarNro(event)" />
									&nbsp;
									<font face="Verdana" size="2"  ><b><i>D.V:</i></b></font>
								
									
									<input type="text" name="dv" size="1" class="required" id="es" onkeypress="javascript:return validarNro(event)" /> <font color="red" >*</font>
								</td>
								<td>
									<font face="Verdana" size="2"  ><b><i>Nombre:</i></b></font>
								</td>
								<td>
									
									<input type="text" name="nomemp" size="32" class="required" id="es" /> <font color="red" >*</font>
									
								</td>
								
							</tr>
							<tr>
								
								
							
								<td>
									<font face="Verdana" size="2"  ><b><i>Direcci&oacute;n:</i></b></font>
								</td>
								<td>
									&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
									<input type="text" name="diremp" size="32" id="es" />
									
								</td>
								<td>
									
								</td>
								<td>
									
								</td>
							</tr>
						</table>
						</fieldset>
					<fieldset><legend><b><i>Datos Personales del Participante</i></b></legend>
						<table width="90%" align="center" id="cuerpoins"	>
							<tbody>
							<tr>
								<td>
									<font face="Verdana" size="2"  ><b><i>Nombres<br>completos:</i></b></font>
								</td>
								<td>
									<br><input type="text" name="nombres1" size="32" class="required" id="es" /><font color="red" >*</font>
							
								</td>
								<td>
									<font face="Verdana" size="2"  ><b><i>Apellidos<br>completos:</i></b></font>
								</td>
								<td>
									<br><input type="text" name="apellidos1" size="32" id="es" /><font color="red" >*</font>
									
								</td>
							</tr>	
							<tr>
								<td>
									<font face="Verdana" size="2"  ><b><i>Documento<br>de Identidad:</i></b></font>
								</td>
								<td>
									<br>
									<input type="text" name="docid1" size="32" class="required number" id="es" /><font color="red" >*</font>
									
								</td>
								
								<td>
									<font face="Verdana" size="2"  ><b><i>Cargo:</i></b></font>
								</td>
								<td>
									
									<input type="text" name="cargo1" size="32" id="es" />
								</td>
							</tr>
							<tr>
								<td>
									<font face="Verdana" size="2"  ><b><i>E-mail:</i></b></font>
								</td>
								<td>
									
									<input type="text" name="mail1" size="32" class="required mail" id="es" />
									
								</td>
								<td>
									<font face="Verdana" size="2"  ><b><i>Tel&eacute;fono:</i></b></font>
								</td>
								<td>
									
									<input type="text" name="tel1" size="32" class="required number" id="es" /><font color="red" >*</font>
									
								</td>
							</tr>
							<tr>
								
								<td>
									<font face="Verdana" size="2"  ><b><i>Celular:</i></b></font>
								</td>
								<td>
									
									<input type="text" name="cel1" size="32" id="es" />
									
								</td>
								<td>
									<font face="Verdana" size="2"  ><b><i>Municipio:</i></b></font>
								</td>
								<td>
									<!--<input type="text" name="muni1" size="32" id="es" />-->
									<select name="muni1" id="es" >
										<option>---Seleccione---</option>
										<option>Caldas</option>
										<option>Envigado</option>
										<option>Itagui</option>
										<option>La Estrella</option>
										<option>Sabaneta</option>
										<option>Medellin</option>
									</select>
								</td>
							</tr>
							</table>
							<br>
							<table width="90%" align="center">
							<tr>
								
								<td>
									<a href="#" id="add" ><img src="../img/add.png" ><font face="Verdana" size="1"  ><b><i>&nbsp;Adicionar Inscripci&oacute;n</i></b></font></a>
								</td>
								<td>
									
									
									
								</td>
								<td>
									
								</td>
								<td>
									
									<a href="#" id="delete" ><img src="../img/cancel.png" ><font face="Verdana" size="1"  ><b><i>&nbsp;Eliminar Inscripci&oacute;n</i></b></font></a>
								</td>
							</tr>	
														
						</table>
						<input type="hidden" name="ctrl" id="ctrl" value="1" />
						
						
					</fieldset>
					
						<center>
						
							<fieldset><legend><b><i>Comentario:</i></b></legend>
									<textarea name="coment" rows="2" cols="80" id="es" > </textarea>
							</fieldset>
						</center>								
					
					<center><input type="image" src="../img/button-1.png" id="boton" /></center>
				</form>
				<div id="exit" ></div>
			</td>
		</tr>
		


	</table>
	<?php }
	}elseif($fec_act < $fec_ini){ ?>
	<table width="100%" align="center">
				
		<tr>
			<td>
				<center>
					<?php
					
					echo "<img src=../uploads/$row[image] height=250 width=1000  id=sede />	";
					?>
								
				</center>			
			</td>
		</tr>
		<tr>
			<td>
				<center>
					<?php
					
					echo "<font face=Verdana size=6  ><b><i>$row[nom_evento]</i></b></font>	";
					?>
								
				</center>			
			</td>
		</tr>
		<tr>
			<td>
				<center>
					<font face=Verdana size=6  ><b><i>Las Inscripciones para este Evento<br>Inician el: <?php echo $row[fec_inicio];  ?></i></b></font>
							
				</center>			
			</td>
		</tr>
		<tr>
			<td>
				<center>
					<a href="http://www.ccas.org.co" ><img src="../img/exit.png" /><br><font face="Verdana" size="2"  ><b><i>Salir</i></b></font></a>			
				</center>			
			</td>
		</tr>
		
	<?php }else{ ?>
	<table width="100%" align="center">
		<tr>
			<td>
				<center>
					<?php
					mysql_query("update evento set estado='CERRADO' where idevento=$idevent ");
					echo "<img src=../uploads/$row[image] height=250 width=1000  id=sede />	";
					?>
								
				</center>			
			</td>
		</tr>
		<tr>
			<td>
				<center>
					<?php
					
					echo "<font face=Verdana size=6  ><b><i>$row[nom_evento]</i></b></font>	";
					?>
								
				</center>			
			</td>
		</tr>		
		
		<tr>
			<td>
				<center>
					<font face=Verdana size=6  ><b><i>Las Inscripciones para este Evento<br>se Encuentran Cerradas</i></b></font>
							
				</center>			
			</td>
		</tr>
		<tr>
			<td>
				<center>
					<a href="http://www.ccas.org.co" ><img src="../img/exit.png" /><br><font face="Verdana" size="2"  ><b><i>Salir</i></b></font></a>			
				</center>			
			</td>
		</tr>
		<?php } ?>


				</div>
				<b class="spiffy"> 
				<b class="spiffy5"></b>
				<b class="spiffy4"></b>
				<b class="spiffy3"></b>
				<b class="spiffy2"><b></b></b>
				<b class="spiffy1"><b></b></b> 
				</b> 
				</div> 
			</td>
		</tr>


		</table>

	</body>

</html>