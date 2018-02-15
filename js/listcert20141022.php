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
		var ans = confirm('Desea Imprimir Certificado?');
		if(ans == 1 ){
		$.ajax({
			url: './js/asistio.php',
			type: 'GET',
			data: {id: idper , mod: ".$idmod." , eve: ".$ideve.", cert: 1 },
			success: function ( data ) {
				var id = eval ( '(' + data + ')' );
				
				if (id.resp == 1 ){
					$('#divasis2').load('./js/listcert.php?ideve=".$ideve."&idmod=".$idmod."&type=".$typ."');
										
						open('./pdf2/certifica.php?ideve=".$ideve."&idmod=".$idmod."&tp=1&idasis='+idper, '_blank');
					
					
				}else{
				
					alert('Ocurrio un Error Por Favor Comuniquese con el Administrador del Sistema');
				
				}
			}
		})
		return false;
		}
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
	echo "<tr>
			<td><font face=Verdana size=2 ><span id=ced$i value=$row[cedula]  >$row[cedula]</span></font></td>
			<td><font face=Verdana size=2 >$row[nombres]</font></td>
			<td><font face=Verdana size=2 >$row[apellidos]</font></td>
			<td><font face=Verdana size=2 >$row[email]</font></td>
			<td><img src=./img/certi.png value=$row[cedula] width=15 class=certifica />
			
			
			 </td>
		</tr>";
		$i++;
}

echo "
	</tbody>
	</table>
	
";

}
?>