
<script type='text/javascript' >
	$(document).ready(function(){
	
	$("#fileuploader").uploadFile({
		url:"./insert/upload.php",
		fileName:"myfile",
		 returnType: "json",
		showDelete: true,
		deleteCallback: function (data, pd) {
			for (var i = 0; i < data.length; i++) {
				$.post("./insert/delete.php", {op: "delete",name: data[i]},
					function (resp,textStatus, jqXHR) {
						//Show Message	
					alert(resp);
				});
			}
			
		},
		uploadsub: function (data, pd) {
			parent.$("#nomfc").attr('value',data[0]);
			parent.$("#imgc").attr('src','./img/uploads/'+data[0]);
		}
		
		
	});
	
	$('#tbs tbody tr:even').css('background-color','silver');
	
	$('.fecha').datepicker({
			//showOn: 'both',
			buttonImage: 'calendar.png',
			buttonImageOnly: true,
			changeYear: true,
			numberOfMonths: 1,
      
		});
		
	
	$('.certi2').click(function(){
		var ch = $(this).attr('value');
		
		if( ch == 1 ){
			$('#cert2').attr('style','display:block');
		}else{
			$('#cert2').attr('style','display:none');
			$('#certvar').attr('value','');
		}
	});
	
		
		
		
				$('.sample2 input').ptTimeSelect();
				
				
				
				$('#delimg').click(function(){
					var unl = $('#unlink').attr('value');
					var dir = $('#lista2').attr('value');
					var ideve = $('#ideve').val();
					$.ajax({
						url: 'upload.php',
						type: 'POST',
						data: {unlink:unl,list:dir,ideve:ideve},
						success: function(data){
							var obj = eval ( "(" + data + ")" );
							if(obj.sw == 1){
								$('#lista2').attr('value','blank.png');
								$('#images2').attr('src','./uploads/blank.png');
								$("#shimg").hide('fast');
								$("#filaimg").show("fast");
								
							}else{
								alert("Ocurrio Un Error Durante La Eliminacion, Por Favor Comuniquese con el Administrador");
							}
						}
					})
				});
			
			
	});
</script>
<script type='text/javascript' >
	$(document).ready(function(){
$('.lapiz').click(function(){
					var id = $(this).attr('value');
					var n = $('#n').attr('value');
					var p = $('#p').attr('value');
					//alert(id+'-'+n+'-'+p);
					$('#searchresult').load('./js/find.php?n=3&objet='+p+'&id='+id);
				});	

	});
</script>
<?php
require("../class.conexion.php");

$db = new conn();

$n = $_GET['n'];
$p = $_GET['objet'];
$id = $_GET['id'];

if($p == 5 ){
	echo "
		<script>
			$.blockUI({ message: '<h3><img src=./img/bad.png width=25 /><br>Debe Seleccionar un Evento para ser Evaluado.</h3>' });
			setTimeout($.unblockUI, 2000); 
			$('#objet').focus();
		</script>
					
	";
	exit;
}
$varobj = array('asistentes','empresa','evento');
$varid = array('cedula','nit','idevento');
$varnom = array('nombres','rsocial','nom_evento');

if($n == 3){
	if($id == 'Identificacion' ){
	echo "
		<script>
			$.blockUI({ message: '<h3><img src=./img/bad.png width=25 /><br>Por Favor Ingrese el Numero de Identificacion.</h3>' });
			setTimeout($.unblockUI, 2000); 
			$('#s3').focus();
		</script>
					
	";
	exit;
	}
		$sql = $db->consulta("select * from $varobj[$p] where $varid[$p]='$id' ");
		$row = $db->fetch_array($sql);
		if($row == true){
		if($p == 0){
			echo '<fieldset>
			<legend><i>Asistente</i></legend>
				<table width=90% align=center id=cuerpoins	>
				<tbody>
				<tr>
					<td><font face=Verdana size=2  ><b><i>Documento<br>de Identidad:</i></b></font></td>
					<td><br><input type=text name=docid1 size=32 class="required" id=es value="'.$id.'"  /><font color=red >*</font></td>
				</tr>				
				<tr>
					<td><font face=Verdana size=2  ><b><i>Nombres<br>completos:</i></b></font></td>
					<td><br><input type=text name=nombres1 size=32 class="required" id=es value="'.utf8_encode($row['nombres']).'"  /><font color=red >*</font><input type=hidden name=oldid value="'.$id.'"  /></td>
					<td><font face=Verdana size=2  ><b><i>Apellidos<br>completos:</i></b></font></td>
					<td><br><input type=text name=apellidos1 size=32 value="'.utf8_encode($row['apellidos']).'" id=es /><font color=red >*</font></td>
				</tr>
				<tr>
					<td><font face=Verdana size=2  ><b><i>E-mail:</i></b></font></td>
					<td><input type=text name=mail1 size=32 class="required mail" id=es value="'.$row['email'].'" />	</td>
					<td><font face=Verdana size=2  ><b><i>Tel&eacute;fono:</i></b></font></td>
					<td><input type=text name=tel1 size=25 class=required number id=es value="'.$row['tel'].'" /><font color=red >*</font>&nbsp;<font face=Verdana size=2  ><b><i>Ext.</i></b></font><input type=text name=ext1 size=4 id=es value="'.$row['ext'].'" /></td>
				</tr>
				<tr>
					<td><font face=Verdana size=2><b><i>Celular:</i></b></font></td>
					<td><input type=text name=cel1 size=32 id=es value="'.$row['cel'].'" /></td>
					<td><font face=Verdana size=2  ><b><i>Municipio:</i></b></font></td>
					<td><select name=muni1 id=es ><option>'.$row['municipio'].'</option><option>CALDAS</option><option>ENVIGADO</option><option>ITAGUI</option><option>LA ESTRELLA</option><option>SABANETA</option><option>MEDELLIN</option></select></td>
				</tr>
				<tr>
					<td><font face=Verdana size=2  ><b><i>Cargo:</i></b></font></td>
					<td><input type=text name=cargo1 size=32 id=es value="'.utf8_encode($row['cargo']).'" /></td>';
					if($row['habeas']=='SI'){
				echo '
					<td><font face=Verdana size=2  ><b><i>Habeas Data:</i></b></font></td>
					<td><font face=Verdana size=2  >SI</font><input type=radio name=habeas1 value=SI checked />
						<font face=Verdana size=2  >NO</font><input type=radio name=habeas1 value=NO />
						<font face=Verdana size=2  >NS/NR</font><input type=radio name=habeas1 value=NR />
					</td>
					';
				}elseif($row['habeas']=='NO'){
					echo '
					<td><font face=Verdana size=2  ><b><i>Cargo:</i></b></font></td>
					<td><font face=Verdana size=2  >SI</font><input type=radio name=habeas1 value=SI />
						<font face=Verdana size=2  >NO</font><input type=radio name=habeas1 value=NO checked />
						<font face=Verdana size=2  >NS/NR</font><input type=radio name=habeas1 value=NR />
					</td>
					';
				}else{
					echo '
					<td><font face=Verdana size=2  ><b><i>Cargo:</i></b></font></td>
					<td><font face=Verdana size=2  >SI</font><input type=radio name=habeas1 value=SI />
						<font face=Verdana size=2  >NO</font><input type=radio name=habeas1 value=NO />
						<font face=Verdana size=2  >NS/NR</font><input type=radio name=habeas1 value=NR checked />
					</td>
					';
				}
				echo'</tr>
				<tr>
					<td colspan=4 ><center><font face=Verdana size=2  ><b><i>Comentario</i></b></font><br><textarea name=comentario cols=150 rows=4 >'.utf8_encode($row['comentario']).'</textarea></center></td>
				</tr>	
			</table>
			<br><center><input type=hidden name=typ value=1 /><input type=hidden name=opcion value=0 /><input type=image src=./img/acpt.png id=acpt /></center>';
		}elseif($p == 1){
			echo "<fieldset><legend><i>Empresa</i></legend><table width=70% align=center	>
							<tr>
								<td>
									<font face=Verdana size=2  ><b><i>NIT:</i></b></font>
								</td>
								<td>	
									<input type=text name=docid1 size=15 value=$id   />
									<input type=hidden name=oldid value=$id   />
								</td>
								<td>
									<font face=Verdana size=2  ><b><i>Nombre:</i></b></font>
								</td>
								<td>									
									<input type=text name=nombres1 size=32 value='".utf8_encode($row[rsocial])."'  /> 									
								</td>								
							</tr>
							<tr>					
								<td>
									<font face=Verdana size=2  ><b><i>Direcci&oacute;n:</i></b></font>
								</td>
								<td>									
									<input type=text name=diremp size=32 value='$row[dir]'  />
									<input type=hidden name=typ value=1 /><input type=hidden name=opcion value=1 />
								</td>
								<td>
									<font face=Verdana size=2  ><b><i>Tarifa:</i></b></font>
								</td>
								<td><select name=tarifa >";
									$sqltar = $db->consulta("select tarifa from pagos where nit=$id limit 1 ");
									$rowtar = $db->fetch_array($sqltar);
									 echo "<option selected >$rowtar[tarifa]</option>
											<option>Afiliado</option>
											<option>Estudiante</option>
											<option>Invitado</option>
											<option>Matriculado</option>
											<option>Particular</option>
								</td>
							</tr>
						</table><br><input type=image src=./img/acpt.png id=acpt />";
		}elseif($p == 2){
			echo '<fieldset><legend><b>Evento</b></legend><table width="90%">
			
			<tr>
				
				<td colspan=4 >
					<div id="fileuploader">Subir Banner</div>
					<input type="hidden" name="nomfc" id="nomfc" value="'.$row['image'].'" />
				</td>
			</tr>
			<tr>
				<td colspan=4 >
					<img src="./img/uploads/'.$row['image'].'" id="imgc" />
				</td>
			</tr>
			
					<input type="hidden" name="list" id="lista2" value='."$row[image]".' >
					<input type=hidden name=unlink id=unlink value=1 />
					<input type=hidden name=ideve id=ideve value='.$id.' />
					<input type=hidden name=typ value=1 /><input type=hidden name=opcion value=2 />
				
			<tr>
				<td>
					<font face="Verdana" size="3" ><b><i>Nombre del Evento: </i></b></font>
				</td>
				<td>
					<input type="text" name="nombres1" size="32" value="'.utf8_encode($row['nom_evento']).'" />
				</td>
			
				<td>
					<font face="Verdana" size="3" ><b><i>Lugar del Evento: </i></b></font>
				</td>
				<td>
					<input type="text" name="apellidos1" size="32" value="'.utf8_encode($row['lugar']).'" />
				</td>
			</tr>
			<tr>
				<td>
					<font face="Verdana" size="3" ><b><i>Cupo de Inscripciones: </i></b></font>
				</td>
				<td>
					<input type="text" name="cupo" size="15" value="'.$row['cupo'].'" />
				</td>
			
				<td>
					<font face="Verdana" size="3" ><b><i>Fecha del Evento: </i></b></font>
				</td>
				<!--<td>
					
					<a href="javascript:doNothing()" onClick="setDateField(document.form1.fecevent);top.newWin=window.open("./js/calendar.html","cal","dependent=yes,width=210,height=230,screenX=400,screenY=200,titlebar=yes")"><input type="text" name="fecevent" size="15" class="required" /></a>
				</td>-->
				<td>
					<input type="text" name="fecevent" class="fecha required" size="15" value="'.$row['fec_event'].'" />
				</td>
			</tr>
			<tr>
				<td>
					<font face="Verdana" size="3" ><b><i>Hora del Evento: </i></b></font>
				</td>
				<td>
					<div class="sample2">
					<div><input type="text" name="hevent" size="15" value="'.$row['hora'].'" /></div>
					
					</div>
				</td>			
			</tr>
			<tr>
				<td><font face="Verdana" size="3" ><b><i>Este Evento Requiere Certificados</i></b></font></td>
				<td>';
					if ($row['var_certi'] != ''){
						echo'<table>
						<tr>
							<td><font face="Verdana" size="3" ><b><i>SI</i></b></font></td>
							<td><input type="radio" name="certi" value="1" checked class="certi2" /></td>
							<td><font face="Verdana" size="3" ><b><i>NO</i></b></font></td>
							<td><input type="radio" name="certi" value="2"  class="certi2"  /></td>
							
						</tr>
					</table></td>
			</tr>
			</table><br>
					<div id="cert2" >
						<fieldset><legend><b><i>Variable de Certificaci&oacute;n</i></b></legend>
						<center>
							<textarea name="certvar" rows="4" cols="100" >'.utf8_encode($row['var_certi']).'</textarea>
						<br>
						<font face="Verdana" size="3" ><b><i>Fecha de Certificaci&oacute;n</i></b></font>&nbsp;&nbsp;<input type="text" name="fec_exp" size="15" class="fecha" value="'.utf8_encode($row['fec_exp']).'" />
						<br>
						<font face="Verdana" size="3" ><b><i>Lugar de Certificaci&oacute;n</i></b></font>&nbsp;<input type="text" name="place_exp" size="15"  value="'.utf8_encode($row['place_exp']).'" />
						</center>
						</fieldset>
						</div>';
					}else{
					echo '
					<table>
						<tr>
							<td><font face="Verdana" size="3" ><b><i>SI</i></b></font></td>
							<td><input type="radio" name="certi" value="1" class="certi2" /></td>
							<td><font face="Verdana" size="3" ><b><i>NO</i></b></font></td>
							<td><input type="radio" name="certi" value="2" checked class="certi2"  /></td>
							
						</tr>
					</table></td>
			</tr>
			</table><br>
					<div id="cert2" style="display:none">
						<fieldset><legend><b><i>Variable de Certificaci&oacute;n</i></b></legend>
						<center>
							<textarea name="certvar" id="certvar" rows="4" cols="100" ></textarea>
						</center>
						</fieldset>
						</div>';
					}
					
				echo'
			
			
			<br>
			<fieldset><legend><b><i>Fechas de Inscripciones </i></b></legend>
			<br>
			<table align="center" width="70%" >
			<tr>
			<td>
				<font face="Verdana" size="3" ><b><i>Fecha Inicio: </i></b></font>
			</td>
			<td>
				<input type="text" name="finicio" class="fecha" size="15" value="'.$row['fec_inicio'].'"  />
			</td>
			<td>
				<font face="Verdana" size="3" ><b><i>Fecha Cierre: </i></b></font>
			</td>
			<td>
				<input type="text" name="fcierre" class="fecha" size="15" value="'.$row['fec_fin'].'" />
			</td>
			</tr>
			</table>
			</fieldset>
			<br>
			<center><input type=image src=./img/acpt.png id=acpt /></center>';
		}
	}else{
		echo "<center><img src=./img/find.png /><font size=5 ><b><i>La Identificacion($varid[$p]): $id No Se Encuentra Registrada en el Sistema";
	}	
	}else{
		$sql = $db->consulta("select * from $varobj[$p] where $varnom[$p] like'%$id%' ");
			echo "<table width=80% align=center id=tbs >";
			
			if($p==0){
				echo"<thead bgcolor=gray >
					<th><font face=Verdana size=4 ><b><i>Cedula</b></font></th>
					<th><font face=Verdana size=4 ><b><i>Nombres</b></font></th>
					<th><font face=Verdana size=4 ><b><i>Apellidos</b></font></th>
					<th><font face=Verdana size=4 ><b><i>e-mail</b></font></th>
					<th><font face=Verdana size=4 ><b><i>Acciones</b></font></th>
				</thead>
				<tbody>";
				while($row = $db->fetch_array($sql)){
				echo "<tr>
						<td><font face=Verdana size=2 >$row[cedula]</font></td>
						<td><font face=Verdana size=2 >".utf8_encode($row[nombres])."</font></td>
						<td><font face=Verdana size=2 >".utf8_encode($row[apellidos])."</font></td>
						<td><font face=Verdana size=2 >$row[email]</font></td>
						<td>
							<img src=./img/edit.png title='Editar Inscripcion' width=20 class='lapiz' value='$row[cedula]' />
							
						</td>
					</tr>";
				}
				
			}elseif($p==1){
				echo"<thead bgcolor=gray >
					<th><font face=Verdana size=4 ><b><i>NIT</b></font></th>
					<th><font face=Verdana size=4 ><b><i>Nombre</b></font></th>
					<th><font face=Verdana size=4 ><b><i>Direcci&oacute;n</b></font></th>
					<th><font face=Verdana size=4 ><b><i>Acciones</b></font></th>
				</thead>
				<tbody>";
				while($row = $db->fetch_array($sql)){
				echo "<tr>
						<td><font face=Verdana size=2 >$row[nit]</font></td>
						<td><font face=Verdana size=2 >".utf8_encode($row['rsocial'])."</font></td>
						<td><font face=Verdana size=2 >".utf8_encode($row['dir'])."</font></td>
						<td>
							<img src=./img/edit.png title='Editar Inscripcion' width=20 class='lapiz' value='$row[nit]' />
							
						</td>
					</tr>";
				}
			}elseif($p==2){
				echo"<thead bgcolor=gray >
					<th><font face=Verdana size=4 ><b><i>ID.Evento</b></font></th>
					<th><font face=Verdana size=4 ><b><i>Nombre Evento</b></font></th>
					<th><font face=Verdana size=4 ><b><i>Fecha Evento</b></font></th>
					<th><font face=Verdana size=4 ><b><i>Acciones</b></font></th>
				</thead>
				<tbody>";
				while($row = $db->fetch_array($sql)){
				echo "<tr>
						<td><font face=Verdana size=2 >$row[idevento]</font></td>
						<td><font face=Verdana size=2 >$row[nom_evento]</font></td>
						<td><font face=Verdana size=2 >$row[fec_event]</font></td>
						<td>
							<img src=./img/edit.png title='Editar Inscripcion' width=20 class='lapiz' value='$row[idevento]' />
							
						</td>
					</tr>";
				}
			}
			echo "</tbody></table>
					<input type=hidden name=n id=n value=$n />
					<input type=hidden name=p id=p value=$p />";
			
		
		
	}


?>