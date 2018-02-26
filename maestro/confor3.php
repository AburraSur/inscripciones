<?php
//header('Location:../index.php');
require("../class.conexion.php");
$db = new conn();
$idevent=$_GET['cod'];
					$sql=$db->consulta("select * from evento where idevento=$idevent ");
					$row=$db->fetch_array($sql);
					
					$fec_ini=(strtotime("$row[fec_inicio]"))/86400;
					$fec_fin=(strtotime("$row[fec_fin]"))/86400;
					$fec_act=(strtotime(date("Y-m-d")))/86400;
					$fecha=date("Y-m-d");
					$hora=date("H:i");
					$h="18:00";					
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8"><title>Inscripciones</title>
<link rel="icon" type="image/gif" href="../img/shopping.ico" />
<LINK href="../estilo/divestilo.css" rel="stylesheet" type="text/css">
<LINK href="../estilo/button.css" rel="stylesheet" type="text/css">
<script src="../js/jquery-1.4.2.min.js"></script>
<script src="../js/jquery.blockUI-validate.js"></script>
<script type="text/javascript" src="../js/ready.js"></script>
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
</head>

	<body>
            <input type="hidden" name="tipoEvento" id="tipoEvento" value="<?php echo $row['tipo_evento']; ?>" />
            <?php
                if(isset($_GET['invitado'])){
                    echo '<input type="hidden" name="swInvitado" id="swInvitado" value="'.$_GET['invitado'].'" />';
                }else{
                    echo '<input type="hidden" name="swInvitado" id="swInvitado" value="0" />';
                }
            ?>
        <div class="logout">
            <img src="../img/door.png" id="logout" title="Salida" class="img" />
        </div>
	<div id="idd" style="display:none; alignment-adjust: central;" ><?php echo $row['cupo']; ?></div>
        <div style="text-align: center;" >
        <table style="width: 75%; height: 100%; alignment-adjust: central;">
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
if(($fec_act >= $fec_ini) && ($fec_act <= $fec_fin) && ($row['estado'] == 'ACTIVO')){
		if(($fec_act == $fec_fin) && ( $hora >= $h)){
		//if(($fec_act == $fec_fin)){ ?>
                            <table width="100%" align="center">
                            <tr>
                                <td>
                                        <center>
                                                <?php
                                                $db->consulta("update evento set estado='CERRADO' where idevento=$idevent ");
                                                echo "<img src=../img/uploads/$row[image] height=250 width=1000  id=sede />	";
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
	<table width="90%" align="center" id="tcenter" >
				
		<tr>
			<td>
				<center>
					<?php
					
					echo "<img src=../img/uploads/$row[image]  id=sede />";
					?>
								
				</center>			
			</td>
		</tr>
		<tr>
			<td>
				<center><font size="6" ><b><i>
					<?php
					
					echo "<font size=4 ><b>".utf8_encode($row[nom_evento])."<br>Lugar: ".utf8_encode($row[lugar])."<br>Fecha: $row[fec_event]";
					?>
								
				</i></b></font></center>			
			</td>
		</tr>
		<tr>
			<td>
				<table width="100%" >
					<tr><td align="left" ><font size="2" color="red" ><i><b>Los campos marcados con * son obligatorios</b></i></font></td><td align="right" ><!--<a href="#" id="logout" ><b><i>Salida Segura</i></b><img src="../img/logout.png" /></a>-->		</td></tr></table>
			</td>
		</tr>
		
				 
				
		<tr>
			<td>
				
				
				<form id="form1" action="#" >
				
				<?php
				
				echo "<input type=hidden name=idevent id=idevent value=$idevent />";
				?>
				
				<fieldset><legend><b><i>Empresa o Persona Natural</i></b></legend>
				<div id="newemp" ></div>
                                    <p>
                                            <font face="Verdana" size="1"  ><b><i>Si su registro es de una empresa, en el campo "Identificaci&oacute;n", por favor digite su NIT con digito de verificaci&oacute;n </i></b></font>
                                    </p>
						<table width="90%" align="center"	>
							<tr>
								<td>
									<font face="Verdana" size="2"  ><b><i>Identificaci&oacute;n:</i></b></font>
								</td>
								<td><input type="text" name="nit" id="nit" size="32" class="required nit" onkeypress="javascript:return validarNro(event)" /> <font color="red" >*</font>
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
								<?php
									if( $row['pago'] == 1 ){
									
										echo "
											<td>
												<font face=Verdana size=2  ><b><i>Tarifa:</i></b></font>
											</td>
											<td><input type=hidden name=pago value=1 />";
                                                                                if($_GET['invitado'] == 1){
                                                                                    echo "<select name=tar >
                                                                                            <option>---Seleccione---</option>
                                                                                            <option>Afiliado</option>
                                                                                            <option>Estudiante</option>
                                                                                            <option>Invitado</option>
                                                                                            <option>Matriculado</option>
                                                                                            <option>Particular</option>

                                                                                    </select>";
                                                                                }else{
                                                                                    echo "<input type='text' name='tar' id='tar' readonly/>"
                                                                                    . "<input type='hidden' name='tarifa' id='tarifa' />";
                                                                                }                        
										echo "</td>";
									
									}else{
									
										echo "<td></td><td></td>";
									
									}
								?>                                                                   
							</tr>
                                                        <?php
                                                            if( !isset($_GET['invitado']) && $row['pago'] == 1 ){
                                                                echo '<tr><td colspan="4" ><div id="msntarifa" style="background: red; color: #ffffff; font-size: 18px; padding: 3px; text-align: center; border: 1px solid red; border-radius: 20px;" ></div></td></tr>';
                                                            }
                                                        ?>    
						</table>
						</fieldset>
						
						<?php
							if( $row['modulos'] == 'SI'){
							   if($row['ct_evento']==2){
								echo "
									<script>
										$(document).ready(function(){
											$('#fieldmod').hide('fast');
											$('.allmod').attr('checked',true);
											$('#all').attr('checked',true);
										});
									</script>
								";
								}
								echo "
									<fieldset id=fieldmod ><legend><b><i>Modulos del Evento</i></b></legend>
										<font face=Verdana size=1  ><b><i>Por Favor Seleccione los Modulos en los Cuales Desea Inscribirse</i></b></font><br><br>
										<table width=70% align=center >
											<tr>";
													//<td><input type=checkbox name=complet value=all id=all /></td>
													//<td><font face=Verdana size=2  ><b><i>Evento Completo</i></b></td>
												print "</tr>";
										$sqlmod = $db->consulta("select * from modulos where idevento=$idevent ");
										$i=0;
										while($rowmod = $db->fetch_array($sqlmod)){
											$i++;
											$nomod = $rowmod[modulo];
											echo "
												<tr>
													<td><input type=checkbox name=mod$i value=$rowmod[idmod] class=allmod checked='true' style='margin-right: 10px;' /><font face=Verdana size=2  ><b><i>$rowmod[fec_mod] &nbsp;&nbsp;$nomod </i></b></td>
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
					
						<div id="newasi" ></div>
						<table width="90%" align="center" id="cuerpoins"	>
							<tbody>
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
												<td><input type="radio" name="habeas1" value="SI" id="SI1" />&nbsp;<font face="Verdana" size="2"  ><b><i>S&iacute; Autorizo recibir Informaci&oacute;n</i></b></font> </td>
												<td><input type="radio" name="habeas1" value="NO" id="NO1" />&nbsp;<font face="Verdana" size="2"  ><b><i>NO Autorizo recibir Informaci&oacute;n</i></b></font> </td>
												<td><input type="radio" name="habeas1" value="NSNR" id="NR1" />&nbsp;<font face="Verdana" size="2"  ><b><i>NO Sabe / No Responde</i></b></font> </td>
											</tr>
											<tr>
												<td><font face="Verdana" size="2"  ><b><i>Qui&eacute;n autoriza el envio de informacion:</i></b></font></td>
												<td colspan="2" ><input type="text" name="who1" size="70" /></td>
											</tr>
										</table>
									</fieldset>
								</td>
							</tr>
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
									
									<input type="text" name="cargo1" id="cargo1" size="32" class="cl1 required" />
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
									
									<input type="text" name="mail1" id="mail1" size="32" class="required mail cl1" required />
									
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
									<!--<input type="text" name="muni1" size="32"  />-->
									<select name="muni1" id="muni1" class="cl1 required" required >
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
							<?php
								if($row['var_certi'] != null){
									echo "
										<tr>
								<td colspan=2 ><font face=Verdana size=2  ><b><i>Desea recibir su certificado:</i></b></font>&nbsp;&nbsp;&nbsp;<font face=Verdana size=2  ><b><i>Fisico</i></b></font><input type=radio name=tipocert1 value=0 checked >&nbsp;<font face=Verdana size=2  ><b><i>Virtual</i></b></font><input type=radio name=tipocert1 value=2 ><input type=hidden name=ctrlcert id=ctrlcert value=1 /></td> 
							</tr>
									";
								}
							?>
							<tr>
								<td><font face="Verdana" size="2"  ><b><i>Comentario:</i></b></font></td>
								<td colspan="3" ><textarea name="coment1" id="coment1" rows="2" cols="80" ></textarea></td> 
							</tr>
							</table>
							<br>
							<center>
						
						
							
						</center>	
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
                                            <fieldset><legend><b><i>Comentario General:</i></b></legend>
                                                <textarea name="coment" rows="2" cols="80"  ></textarea>
                                            </fieldset>
                                        </center>
                                <?php
                                    if( !isset($_GET['invitado']) && $row['pago'] == 1 ){
                                ?>    
                                        <fieldset><legend><b><i>Detalles del pago</i></b></legend>
                                            <table width="100%" >
                                                <thead>
                                                    <tr style="text-align: center; background-color: #0275d8; color: #ffffff;" >
                                                        <th>Detalle</th>
                                                        <th>Valor</th>
                                                        <th>Cantidad</th>
                                                        <th>Total a pagar</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr style="text-align: center;" >
                                                        <td>Inscripci&oacute;n al evento</td>
                                                        <td id="vlrUnit"></td>
                                                        <td id="cantIns"></td>
                                                        <td id="totalPago"></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </fieldset>
                                <?php 
                                    }
				?>	
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
					
					echo "<img src=../img/uploads/$row[image] height=250 width=1000  id=sede />	";
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
					echo "<img src=../img/uploads/$row[image] height=250 width=1000  id=sede />	";
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
        </div>

	</body>

</html>