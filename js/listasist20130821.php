<?php
$ideve = $_GET['ideve'];
$id = $_GET['id'];
$n = $_GET['n'];
$pago = $_GET['pago'];
if( isset($_GET['idmod'])  ){
		$idmod = $_GET['idmod'];
	}else{
		$idmod = 0;
	}
$typ = $_GET['type'];
?>
<script>
$(document).ready(function(){
	$('.asist').click(function(){
		var idper =  $(this).attr('value');
		var ans = confirm('confirma la Asistencia de ?');
		if(ans == 1 ){
		$.ajax({
			url: './js/asistio.php',
			type: 'GET',
			data: {id: idper , mod: <?php echo $idmod; ?>, eve: <?php echo $ideve; ?> },
			success: function ( data ) {
				var id = eval ( '(' + data + ')' );
				
				if (id.resp == 1 ){
					//$('#divasis').load('./js/listasist.php?ideve='+<?php echo $ideve; ?>+'&idmod='+<?php echo $idmod; ?>+'&type='+<?php echo $typ; ?>+'');
					$('#divasis').html('<center><font size=6 ><b><i>Asistencia Confirmada</i></b></font></center>');
					var esc = confirm('Desea Imprimir Escarapela?');
					
					if(esc == 1){
						open('./sqlpdf/escarapela.php?ideve='+<?php echo $ideve; ?>+'&tp=1&idasis='+idper, '_blank');
					}
					
				}else{
				
					alert('Ocurrio un Error Por Favor Comuniquese con el Administrador del Sistema');
				
				}
			}
		})
		return false;
		}
	});
	
	$('.required').bind('blur', function() {
		var up = $(this).val().toUpperCase();
		$(this).attr('value',up);
	});
	$('#tabas tbody tr:even').css('background-color','silver');
	
	$('.reemp').click(function(){
		
		var id = $(this).attr('id');
		var ced = $('#ced'+id).attr('value');	
		var nom = $('#nom'+id).attr('value');
		var ape = $('#ape'+id).attr('value');
		
		$("#divasis").html( '<fieldset><legend><i>Reemplazar Asistencia</i></legend><fieldset><legend><i>Inscrito</i></legend><table width="60%" align="center"	><tr><td><font face="Verdana" size="2"  ><b><i>Identificacion:</i></b></font></td>		<td><font face="Verdana" size="2"  ><b>'+ced+'</b><input type=hidden name=oldid value="'+ced+'" /></font></td></tr><tr><td><font face="Verdana" size="2"  ><b><i>Nombres:</i></b></font></td><td>	<font face="Verdana" size="2"  ><b>'+nom+'</b></font> </td>	<td><font face="Verdana" size="2"  ><b><i>Apellidos:</i></b></font></td><td><font face="Verdana" size="2"  ><b>'+ape+'</b></font></td></tr></table></fieldset><fieldset><legend><i>Reemplazo</i></legend><table width=90% align=center id=cuerpoins	><tbody><tr><td><table width=90% align=center id=cuerpoins	><tbody><tr><td><font face=Verdana size=2  ><b><i>Nombres<br>completos:</i></b></font></td><td><br><input type=text name=nombres1 id=nombres1 size=32 class="required"  /><font color=red >*</font><input type=hidden name=oldced /><input type="hidden" class="docid1" value="1" /><input type=hidden name=ideve id=ideve value="'+<?php echo $ideve; ?>+'"  /><input type=hidden name=idmod id=idmod value="'+<?php echo $idmod; ?>+'"  /></td><td><font face=Verdana size=2  ><b><i>Apellidos<br>completos:</i></b></font></td><td><br><input type=text name=apellidos1 id=apellidos1 size=32  /><font color=red >*</font></td></tr><tr><td><font face=Verdana size=2  ><b><i>Documento<br>de Identidad:</i></b></font></td><td><br><input type=text name=docid1 id=docid1 size=32 class="required number" /><font color=red >*</font></td><td><font face=Verdana size=2  ><b><i>Cargo:</i></b></font></td><td><input type=text name=cargo1 id=cargo1 size=32 /></td></tr><tr><td><font face=Verdana size=2  ><b><i>E-mail:</i></b></font></td><td><input type=text name=mail1 id=mail1 size=32 class="required mail" />	</td><td><font face=Verdana size=2  ><b><i>Tel&eacute;fono:</i></b></font></td><td><input type=text name=tel1 size=25 class=required /><font color=red >*</font>&nbsp;<font face=Verdana size=2  ><b><i>Ext.</i></b></font><input type=text name=ext1 id=ext1 size=4 /></td></tr><tr><td><font face=Verdana size=2><b><i>Celular:</i></b></font></td><td><input type=text name=cel1 id=cel1 size=32 /></td><td><font face=Verdana size=2  ><b><i>Municipio:</i></b></font></td><td><select name=muni1 id=muni1 ><option>--Seleccione--</option><option>CALDAS</option><option>ENVIGADO</option><option>ITAGUI</option><option>LA ESTRELLA</option><option>SABANETA</option><option>MEDELLIN</option></select><input type=hidden name=typ value="0" /></td></tr></table><br><center><input type=image src=./img/acpt.png id=acpt /></center></fieldset>');
		
		$(".number").bind('blur', function(){
						var id = $(this).val();
						var ctrl = $(this).attr('id');
						var v = $('.'+ctrl).val();
						$.ajax({
							url: './js/setasis.php',
							type: 'POST',
							data: {ced:id , v:v},
							success: function( data ){
								var obj = eval ( "(" + data + ")" );
				
									if(obj.sw == 1){
										$('#nombres'+obj.ctrl).attr('value',obj.nom).attr('disabled',true);
										$('#apellidos'+obj.ctrl).attr('value',obj.ape).attr('disabled',true);
										$('#cargo'+obj.ctrl).attr('value',obj.car).attr('disabled',true);
										$('#mail'+obj.ctrl).attr('value',obj.mail).attr('disabled',true);
										$('#tel'+obj.ctrl).attr('value',obj.tel).attr('disabled',true);
										$('#ext'+obj.ctrl).attr('value',obj.ext).attr('disabled',true);
										$('#cel'+obj.ctrl).attr('value',obj.cel).attr('disabled',true);
										$('#muni'+obj.ctrl).append('<option selected>'+obj.mun+'</option>').attr('disabled',true);
								}else{
									$("#newasi").append('<font size=3 color=red >'+id+' es un Usuario Nuevo<br>');
									var id2 = $('#docid1').val();
									$("#divasis").each(function(){
									this.reset();
									$("#divasi").html('');									
									$('#docid1').attr('value',id2);
									$('#docid'+v).attr('value',id);
									});
								}
							}
						})
						return false;
					});

		
	});
	
	$(".transfer").click(function(){
		var id = $(this).attr('value');
		var ideve = $("#asiseve").attr('value');
		//alert(ideve);
		$("#divasis").html('<center><br><font size=4 ><b><i>Seleccione el Evento al Cual Desea Trasladar a la persona con <br>identificacion: '+id+'</i></b><br><br><select name=evento id=eventosel class=selectboxes ></select><br><br><input type=hidden name=docid1 value='+id+' /><input type=hidden name=ideve value='+ideve+' /><input type=hidden name=typ value=3 /><input type=image src=./img/acpt.png id=chacpt /></center>');					
		$("#eventosel").load("./js/eventos.php");
		
		$("#eventosel").change(function(){
			var eve = $(this).val();
			var ideve = $("#asiseve").val();
			var idmod = $("#asismod").val();
			alert(ideve+"/"+idmod);
			$.ajax({
			url: './js/eventmod.php',
			type: 'POST',
			data: {event:eve},
			success: function ( data ) {
				var obj = eval ( "(" + data + ")" );
				
				if( obj.resp == 'SI'){
					/*$("#asismod").load('./js/modasis.php?eve='+eve);
					$(".asismod").show('fast');
					$("#divasis").text('');*/
					//alert("Tiene Modulos");
					
				}
				
				
			}
		
		})
		return false;
		});
	});
	
	$(".cancel").click(function(){
		var i = $(this).attr('id');
		var idcancel = $(this).attr('value');
		var ideve = $("#idevec").val();
		var idmod = $("#idmodc").val();
		var ic = $("#i"+i).attr('value');
		alert(idcancel);
                var ans = confirm("Confirma la Cancelacion?");
                if( ans == 1 ){
		$.ajax({
			url: './insert/updateasis.php',
			type: 'POST',
			data: {idcancel: idcancel , ideve: ideve , idmod: idmod , i: ic , typ: 2},
			success: function ( data ) {
				var id = eval ( '(' + data + ')' );
				
				if (id.sw == 1 ){
					$.blockUI({ message: '<h3><img src=./img/check2.png /><br>'+id.msn+'</h3>' });
					$("#divasis").html('');
					setTimeout($.unblockUI, 1000); 
					$("#listado").html('');
				}if(id.sw == 2){
					//alert("Ocurrio un Problema Durante la Cancelacion de la Inscripcion, Por Favor Comuniquese con el Administrador del Sistema");
					$.blockUI({ message: '<h3><img src=./img/bad.png /><br>'+id.msn+'</h3>' });
					setTimeout($.unblockUI, 1000); 
				}
			}
		})
		return false;
               }
	});
	
});
</script>
<?php
require("../class.conexion.php");

$db = new conn();


if($pago == 1){
	$sqlpay = $db->consulta("select a.cedula,a.nombres,a.apellidos,ea.e_asistio 'asis',ea.id 'cod',a.comentario 'coment',p.tarifa 'tarifa' from asistentes a inner join event_asist ea inner join pagos p where ea.e_asistio=0 and a.cedula=ea.cedula and p.vlrpago>0 and p.cedula=ea.cedula and ea.idevent=$ideve");
	
	$sqlinv = $db->consulta("select a.cedula,a.nombres,a.apellidos,ea.e_asistio 'asis',ea.id 'cod',a.comentario 'coment',p.tarifa 'tarifa' from asistentes a inner join event_asist ea inner join pagos p where ea.e_asistio=0 and a.cedula=ea.cedula and p.tarifa='Invitado' and p.cedula=ea.cedula and ea.idevent=$ideve");
	
	echo "<div id=listado >
	<table align=center id=tabas  >
	<thead bgcolor=gray >
		<th><font face=Verdana size=4 ><b><i>Codigo</b></font></th>
                <th><font face=Verdana size=4 ><b><i>Cedula</b></font></th>
		<th><font face=Verdana size=4 ><b><i>Nombres</b></font></th>
		<th><font face=Verdana size=4 ><b><i>Apellidos</b></font></th>
		<th><font face=Verdana size=4 ><b><i>Tarifa</b></font></th>
		<th><font face=Verdana size=4 ><b><i>Comentario</b></font></th>
		<th><font face=Verdana size=4 ><b><i>Asiste</b></font></th>
	</thead>
	<tbody>
";

	while($rowinv = $db->fetch_array($sqlinv)){
		echo "<tr align=center >
                        <td><font face=Verdana size=2 >$rowinv[cod]</font></td>
			<td><font face=Verdana size=2 ><span id=ced$i value=$rowinv[cedula]  >$rowinv[cedula]</span></font></td>
			<td><font face=Verdana size=2 ><span id=nom$i value='$rowinv[nombres]'  >$rowinv[nombres]</span></font></td>
			<td><font face=Verdana size=2 ><span id=ape$i value='$rowinv[apellidos]'  >$rowinv[apellidos]</span></font></td>
			<td><font face=Verdana size=2 ><span id=ape$i value='$rowinv[apellidos]'  >$rowinv[tarifa]</span></font></td>
			<td><font face=Verdana size=2 ><span id=coment$i value=$rowinv[coment]  >$rowinv[coment]</span></font></td>
			<td>
						<img src=./img/persona.png value=$rowinv[cedula] title='Confirmar Asistencia' width=25 class=asist />
						<img src=./img/replace.png title='Reemplazar Asistencia' width=20 class=reemp id=$i value=$rowinv[cedula] />
						<img src=./img/transfer.png title='Transferencia' value=$rowinv[cedula] width=20 class=transfer />
						<img src=./img/close.png title='Cancelar Asistencia' value=$rowinv[cedula] width=20 id=c$i class=cancel />
					
			 </td>
		</tr>";
	}
	
	while($rowpay = $db->fetch_array($sqlpay)){
		echo "<tr align=center >
                        <td><font face=Verdana size=2 >$rowpay[cod]</font></td>
			<td><font face=Verdana size=2 ><span id=ced$i value=$rowpay[cedula]  >$rowpay[cedula]</span></font></td>
			<td><font face=Verdana size=2 ><span id=nom$i value='$rowpay[nombres]'  >$rowpay[nombres]</span></font></td>
			<td><font face=Verdana size=2 ><span id=ape$i value='$rowpay[apellidos]'  >$rowpay[apellidos]</span></font></td>
			<td><font face=Verdana size=2 ><span id=ape$i value='$rowpay[apellidos]'  >$rowpay[tarifa]</span></font></td>
			<td><font face=Verdana size=2 ><span id=coment$i value=$rowpay[coment]  >$rowpay[coment]</span></font></td>
			<td>
				
						<img src=./img/persona.png value=$rowpay[cedula] title='Confirmar Asistencia' width=25 class=asist />
						<img src=./img/replace.png title='Reemplazar Asistencia' width=20 class=reemp id=$i value=$rowpay[cedula] />
						<img src=./img/transfer.png title='Transferencia' value=$rowpay[cedula] width=20 class=transfer />
						<img src=./img/close.png title='Cancelar Asistencia' value=$rowpay[cedula] width=20 id=c$i class=cancel />
					
			 </td>
		</tr>";
	}
	
}else{

if ( $typ == 1 ){
	if( $n == 0){
		$sql = $db->consulta("select a.cedula,a.nombres,a.apellidos,a.email,ea.e_asistio 'asis',ea.id 'cod',a.comentario 'coment' from asistentes a inner join event_asist ea where a.cedula=ea.cedula and ea.idevent=$ideve ");
	}elseif( $n == 1){
		$sql = $db->consulta("select a.cedula,a.nombres,a.apellidos,a.email,ea.e_asistio 'asis',ea.id 'cod',a.comentario 'coment' from asistentes a inner join event_asist ea where a.cedula=ea.cedula and ea.idevent=$ideve and ea.cedula='$id' ");
	}elseif( $n == 2){
		$sql = $db->consulta("select a.cedula,a.nombres,a.apellidos,a.email,ea.e_asistio 'asis',ea.id 'cod',a.comentario 'coment' from asistentes a inner join event_asist ea where a.cedula=ea.cedula and ea.idevent=$ideve and a.nombres like'%$id%' ");
	}elseif( $n == 6){
		$sql = $db->consulta("select a.cedula,a.nombres,a.apellidos,a.email,ea.e_asistio 'asis',ea.id 'cod',a.comentario 'coment' from asistentes a inner join event_asist ea where a.cedula=ea.cedula and ea.idevent=$ideve and a.apellidos like'%$id%' order by apellidos ASC ");
	}else{
		$sql = $db->consulta("select a.cedula,a.nombres,a.apellidos,a.email,ea.e_asistio 'asis',ea.id 'cod',a.comentario 'coment' from asistentes a inner join event_asist ea where a.cedula=ea.cedula and ea.idevent=$ideve and ea.id='$id'");
	}
	
}else{
	
	if( $n == 0){
		$sql = $db->consulta("select a.cedula,a.nombres,a.apellidos,a.email,ma.asistio 'asis',a.comentario 'coment' from asistentes a inner join mod_asis ma where a.cedula=ma.cedula and ma.idmod=$idmod  and ma.idevento=$ideve ");
	}elseif( $n == 1){
		$sql = $db->consulta("select a.cedula,a.nombres,a.apellidos,a.email,ma.asistio 'asis',a.comentario 'coment' from asistentes a inner join mod_asis ma where a.cedula=ma.cedula and ma.idmod=$idmod  and ma.idevento=$ideve and ma.cedula='$id' ");
	}elseif( $n == 2){
		$sql = $db->consulta("select a.cedula,a.nombres,a.apellidos,a.email,ma.asistio 'asis',a.comentario 'coment' from asistentes a inner join mod_asis ma where a.cedula=ma.cedula and ma.idmod=$idmod  and ma.idevento=$ideve and a.nombres like'%$id%' order by apellidos ASC ");
	}else{	
		$sql = $db->consulta("select a.cedula,a.nombres,a.apellidos,a.email,ma.asistio 'asis',a.comentario 'coment' from asistentes a inner join mod_asis ma where a.cedula=ma.cedula and ma.idmod=$idmod  and ma.idevento=$ideve and ma.idmodasis='$id' ");
	}
}

$num = $db->num_rows($sql);

if( $num == 0 ){
	echo "<center><img src=./img/folder.png /><br><font face=Verdana size=6 ><b><i>El Usuario con Identificacion $id no se Encuentra registrado en el Sistema</i></b></font></center>";
}else{
echo "<div id=listado >
	<table width=100% align=center id=tabas  >
	<thead bgcolor=gray >
		<th><font face=Verdana size=4 ><b><i>Codigo</b></font></th>
                <th><font face=Verdana size=4 ><b><i>Cedula</b></font></th>
		<th><font face=Verdana size=4 ><b><i>Nombres</b></font></th>
		<th><font face=Verdana size=4 ><b><i>Apellidos</b></font></th>
		<th><font face=Verdana size=4 ><b><i>Comentario</b></font></th>
		<th><font face=Verdana size=4 ><b><i>Asiste</b></font></th>
	</thead>
	<tbody>
";
$i = 1;
while( $row = $db->fetch_array($sql) ){
	
	if( $row['asis'] != 0 ){
          if($n == 1 || $n == 5){
		if( $row['asis'] == 1){
			echo "<center><img src=./img/folder.png /><br><font face=Verdana size=6 ><b><i>El Usuario con Identificacion $id ya Confirmo Asistencia</i></b></font></center>";
		}else{
			echo "<center><img src=./img/folder.png /><br><font face=Verdana size=6 ><b><i>El Usuario con Identificacion $id Cancelo la  Asistencia al Evento</i></b></font></center>";
		}
          }
	}else{	
	echo "<tr align=center >
                        <td><font face=Verdana size=2 >$row[cod]</font></td>
			<td><font face=Verdana size=2 ><span id=ced$i value=$row[cedula]  >$row[cedula]</span></font></td>
			<td><font face=Verdana size=2 ><span id=nom$i value='$row[nombres]'  >$row[nombres]</span></font></td>
			<td><font face=Verdana size=2 ><span id=ape$i value='$row[apellidos]'  >$row[apellidos]</span></font></td>
			<td><font face=Verdana size=2 ><span id=coment$i value=$row[coment]  >$row[coment]</span></font></td>
			<td>
				
						<img src=./img/persona.png value=$row[cedula] title='Confirmar Asistencia' width=25 class=asist />
						<img src=./img/replace.png title='Reemplazar Asistencia' width=20 class=reemp id=$i value=$row[cedula] />
						<img src=./img/transfer.png title='Transferencia' value=$row[cedula] width=20 class=transfer />
						<img src=./img/close.png title='Cancelar Asistencia' value=$row[cedula] width=20 id=c$i class=cancel />
					
			 </td>
		</tr>";
	}
		$i++;
}

echo "<input type=hidden name=ideve value=$ideve id=idevec />
							<input type=hidden name=idmod value=$idmod id=idmodc />
	</tbody>
	</table>
	</div>
";

}
}
?>