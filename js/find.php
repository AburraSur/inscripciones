<!--
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
</script>-->
<?php
require("../class.conexion.php");

$db = new conn();

$n = $_GET['n'];
$p = $_GET['objet'];
$id = $_GET['id'];

if($p == 5 ){
	/*echo "
		<script>
			$.blockUI({ message: '<h3><img src=./img/bad.png width=25 /><br>Debe Seleccionar un Evento para ser Evaluado.</h3>' });
			setTimeout($.unblockUI, 2000); 
			$('#objet').focus();
		</script>
					
	";
	exit;*/
	$msn = "<h3><img src=./img/bad.png width=25 /><br>Debe Seleccionar un Evento para ser Evaluado.</h3>";
	$array  = array("sw" => 2 , "dt1" => 2 );
	
}
$varobj = array('asistentes','empresa','evento');
$varid = array('cedula','nit','idevento');
$varnom = array('nombres','rsocial','nom_evento');

if($n == 3){
	if($id == 'Identificacion' ){
	/*echo "
		<script>
			$.blockUI({ message: '<h3><img src=./img/bad.png width=25 /><br>Por Favor Ingrese el Numero de Identificacion.</h3>' });
			setTimeout($.unblockUI, 2000); 
			$('#s3').focus();
		</script>
					
	";
	exit;*/
	
	$msn = "<h3><img src=./img/bad.png width=25 /><br>Por Favor Ingrese el Numero de Identificacion.</h3>";
	$array = array("sw" => 2 , "dt1" => 2 );
	}
		$sql = $db->consulta("select * from $varobj[$p] where $varid[$p]='$id' ");
		$row = $db->fetch_array($sql);
	if($row == true){
		if($p == 0){
			//json para edicion de asistente
			$nom = utf8_encode($row['nombres']);
			$ape = utf8_encode($row['apellidos']);
			$carg = utf8_encode($row['cargo']);
			$array = array("sw" => 1 , "dt1" => $id , "dt2" => $nom , "dt3" => $ape , "dt4" => $row['email'] , "dt5" => $row['tel'] , "dt6" => $row['ext'] , "dt7" => $row['cel'] , "dt8" => $row['municipio'] , "dt9" => $carg , "dt10" => $row['habeas']);
		}elseif($p == 1){
			//json para edicion de empresa
		}elseif($p == 2){
			//json para edicion de evento
		}
	}else{
		//echo "<center><img src=./img/find.png /><font size=5 ><b><i>La Identificacion($varid[$p]): $id No Se Encuentra Registrada en el Sistema";
	}	
}else{
		/*$sql = $db->consulta("select * from $varobj[$p] where $varnom[$p] like'%$id%' ");
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
			
		
		*/
	}

	$arrayj = json_encode($array);
	echo $arrayj;

?>