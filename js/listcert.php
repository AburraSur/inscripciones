<?php
$ideve = $_GET['ideve'];

if( isset($_GET['idmod'])  ){
		$idmod = $_GET['idmod'];
	}else{
		$idmod = 0;
	}
$typ = $_GET['type'];

echo "
<script>
$(document).ready(function(){
	$('.certifica').click(function(){
		var idper =  $(this).attr('value');
		
		$.blockUI({message: '<img src=./img/question.png /><br><font face=Verdana size=4  ><i><b>Que desea hacer?</b></i></font><br><br><button id=printcert >Imprimir Certificado</button>&nbsp;&nbsp;<button id=send >Enviar por e-mail</button><img src=./img/close.png id=cls /><br><br> '});
		$('#cls').css({
			'position' : 'absolute',
			'top' : '5px',
			'right' : '5px'
		}).click(function(){
			 setTimeout($.unblockUI, 100); 
		});
		
		$('#printcert').click(function(){
			$.ajax({
			url: './js/asistio.php',
			type: 'GET',
			data: {id: idper , mod: ".$idmod." , eve: ".$ideve.", cert: 1 },
			success: function ( data ) {
				var id = eval ( '(' + data + ')' );
				
				if (id.resp == 1 ){
					$('#divasis2').load('./js/listcert.php?ideve=".$ideve."&idmod=".$idmod."&type=".$typ."');
						setTimeout($.unblockUI, 100); 				
						open('./pdf2/certifica.php?ideve=".$ideve."&idmod=".$idmod."&tp=1&idasis='+idper, '_blank');
					
					
				}else{
					if (id.resp == 2 ){
						alert(id.msn);
						setTimeout($.unblockUI, 100);
					}else{
				
						alert('Ocurrio un Error Por Favor Comuniquese con el Administrador del Sistema');
				
					}
				}
			}
			})
			return false;
		});
		
		$('#send').click(function(){
			$.blockUI({message: '<img src=./img/email.gif /><br><font face=Verdana size=4  ><i><b>Un momento por favor, estamos enviando su certificado...</b></i></font> '});
			$.ajax({
			url: './maestro/certivirtual.php',
			type: 'GET',
			data: {id: idper , ideve: ".$ideve." },
			success: function ( data ) {
				var id = eval ( '(' + data + ')' );
				
				if (id.sw == 1 ){
					
					$.blockUI({message: '<img src=./img/sended.png /><br><font face=Verdana size=4  ><i><b>'+id.msn+'</b></i></font> '});
					setTimeout($.unblockUI, 3000); 	
				}else{
					$.blockUI({message: '<img src=./img/nosended.png /><br><font face=Verdana size=4  ><i><b>'+id.msn+'</b></i></font> '});
					setTimeout($.unblockUI, 3000); 	
				
				}
			}
			})
			return false;
		});
	});
	
	$('#tabas tbody tr:even').css('background-color','#ddd');
	
	
	
});
</script>



";
require("../class.conexion.php");

$db = new conn();



if ( $typ == 1 ){
	$sql = $db->consulta("select a.cedula,a.nombres,a.apellidos,a.email from asistentes a inner join event_asist ea where a.cedula=ea.cedula and ea.idevent=$ideve and ea.e_asistio=1 and certifica=0 order by apellidos ASC ");
}else{
	$sql = $db->consulta("select a.cedula,a.nombres,a.apellidos,a.email from asistentes a inner join mod_asis ma where a.cedula=ma.cedula and ma.idmod=$idmod  and ma.idevento=$ideve and ma.asistio=1 and certifica=0 order by apellidos ASC ");
}

$num = $db->num_rows($sql);

if( $num == 0 ){
	echo "<center><img src=./img/folder.png /><br><font face=Verdana size=6 ><b><i>Este Evento no Tiene Inscritos por Confirmar</i></b></font></center>";
}else{
echo "
	<table width=90% align=center id=tabas  >
	<thead bgcolor=gray >
		<th><font face=Verdana size=4 ><b><i>Cedula</b></font></th>
		<th><font face=Verdana size=4 ><b><i>Nombres</b></font></th>
		<th><font face=Verdana size=4 ><b><i>Apellidos</b></font></th>
		<th><font face=Verdana size=4 ><b><i>e-mail</b></font></th>
		<th><font face=Verdana size=4 ><b><i>Certifica</b></font></th>
	</thead>
	<tbody>
";
$i = 1;
while( $row = $db->fetch_array($sql) ){
	$cedula = $row[cedula];
	echo "<tr>
			<td><font face=Verdana size=2 ><span id=ced$i value=$row[cedula]  >$row[cedula]</span></font></td>
			<td><font face=Verdana size=2 >$row[nombres]</font></td>
			<td><font face=Verdana size=2 >$row[apellidos]</font></td>
			<td><font face=Verdana size=2 >$row[email]</font></td>
			<td><img src=./img/certi.png value=$row[cedula] width=15 class=certifica /></td>
                        <td><font face=Verdana size=2 ><a href='certificados/virtuales/index.php?ideve=$ideve&idasis=$cedula' target='_blank'>Virtual</a></font></td>
			
			
			 
		</tr>";
		$i++;
}

echo "
	</tbody>
	</table>
	
";

}
?>