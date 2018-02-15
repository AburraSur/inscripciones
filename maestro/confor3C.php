<?php

require("../class.conexion.php");

$db = new conn();

$idevent=$_GET[cod];
					$sql=$db->consulta("select * from evento where idevento=$idevent ");
					$row=$db->fetch_array($sql);
					
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
<script type="text/javascript" src="../js/ready.js"></script>
<script  language="JavaScript" type="text/javascript"> 
  $(document).ready(function(){
   $("#idd").load("./cupo.php?id=<?php echo $idevent; ?>");
  
  
	
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

	<body background="../img/bg2.jpg" ><div id="idd" style="display:block" ></div>
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
					$db->consulta("update evento set estado='CERRADO' where idevento=$idevent ");
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
	<table width="80%" align="center" id="tcenter" >
				
		<tr>
			<td>
				<center>
					<?php
					
					echo "<img src=../uploads/$row[image]  id=sede />";
					?>
								
				</center>			
			</td>
		</tr>
		<?php
		session_start();
			if(isset($_SESSION['iduser'])){
			
				echo "
				
					<tr>
						<td>
						<center>
						
							<font size=4 face=Verdana  ><i><b>Buscar</b></i></font><br>
							
							<font face=Verdana size=2 ><i><b>Empresa</font>
							
							<input type=text name=idsearch id=s1 /><img src=../img/search.png width=25 class=searchnit value=1 /><br><br>
							
							<font face=Verdana size=2 ><i><b>Participante</font>
							
							<input type=text name=practi id=s2 /><img src=../img/search.png width=25 class=searchnit value=2 />
							
						</center>
						</td>
					</tr>
					<tr>
						<td>
							<div id=result ></div>
						</td>
					</tr>
					
				";
				
			}
		?>
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
				
				echo "<input type=hidden name=idevent id=idevent value=$idevent />";
				?>
				<fieldset><legend><b><i>Empresa o Persona Natural</i></b></legend>
						<table width="100%" align="center"	>
							<tr>
								<td>
									<font face="Verdana" size="2"  ><b><i>NIT:</i></b></font><input type="radio" name="id" value="nit" class="tid" checked />&nbsp;&nbsp;
									<font face="Verdana" size="2"  ><b><i>Cedula:</i></b></font><input type="radio" name="id" value="ced" class="tid" />
								</td>
								<td><input type="text" name="nit" size="15" class="required" id="es" onkeypress="javascript:return validarNro(event)" /><font class="nit" >-<input type="text" name="dv" size="1"  id="es" onkeypress="javascript:return validarNro(event)" /></font> <font color="red" >*</font>
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
								<?php
									if( $row['pago'] == 1 ){
									
										echo "
											<td>
												<font face=Verdana size=2  ><b><i>Tarifa:</i></b></font>
											</td>
											<td>
												<select name=tar >
													<option>---Seleccione---</option>
													<option>Afiliado</option>
													<option>Matriculado</option>
													<option>Particular</option>
													<option>Invitado</option>
												</select>
											</td>
										";
									
									}else{
									
										echo "<td></td><td></";
									
									}
								?>
								
								
							</tr>
						</table>
						</fieldset>
						
						<?php
							if( $row['modulos'] == 'SI'){
								echo "
									<fieldset><legend><b><i>Modulos del Evento</i></b></legend>
										<font face=Verdana size=1  ><b><i>Por Favor Seleccione los Modulos en los Cuales Desea Inscribirse</i></b></font><br><br>
										<table width=90% align=center >
											<tr>
													<td><input type=checkbox name=complet value=all id=all /></td>
													<td><font face=Verdana size=2  ><b><i>Evento Completo</i></b></td>
												</tr>";
										$sqlmod = $db->consulta("select * from modulos where idevento=$idevent ");
										$i=0;
										while($rowmod = $db->fetch_array($sqlmod)){
											$i++;
											echo "
												<tr>
													<td><input type=checkbox name=mod$i value=$rowmod[idmod] class=allmod /></td>
													<td><font face=Verdana size=2  ><b><i>$rowmod[fec_mod] &nbsp;&nbsp; $rowmod[modulo]</i></b></td>
												</tr>
											";
											
										}							
										
										echo"
										</table>
										<input type=hidden name=ctrlmod value=$i />
									</fieldset>
								";
							}
						?>
						
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
									<a href="#" id="add" ><img src="../img/add2.png" ><font face="Verdana" size="1"  ><b><i>&nbsp;Adicionar Inscripci&oacute;n</i></b></font></a>
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
					$db->consulta("update evento set estado='CERRADO' where idevento=$idevent ");
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