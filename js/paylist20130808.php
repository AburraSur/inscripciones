<?php
require("../class.conexion.php");

$db = new conn();

$idev = $_GET['idev'];

$sqlpay = $db->consulta("SELECT DISTINCT e.`nit` , e.`rsocial` , e.`dir` ,a.cedula , a.nombres,a.apellidos, p.`tarifa` 
FROM  `empresa` e
INNER JOIN asistentes a
INNER JOIN pagos p
WHERE p.nit = e.nit
AND a.cedula=p.cedula
AND p.tarifa <> 'Invitado'
AND p.idevento =$idev ");

echo "<script>
	$(document).ready(function(){
		$('#tabpay tbody tr:even').css('background-color','silver');
		$('.paypal').click(function(){
		/*var id = $('#idev').attr('value');
		$.blockUI ({ message: '<form id=paypal	><img src=./img/close.png id=cls /><input type=text name=test /><button>Aceptar</button></form>',css: { top:  ($(window).height()-400)/2 + 'px',left: ($(window).width() - 800) /2 + 'px', width: '800px' }});
		$('#cls').css({'position' : 'absolute','top' : '5px','right' : '5px'}).click(function(){ $.blockUI({ fadeIn: 1000, timeout:   2000, onBlock: function() { $('#payform').each(function(){this.reset();});} });});*/
		
		
			var id = $(this).attr('id');
			$('.dis'+id).removeAttr('disabled');
		
		
		
		
	});
	
	$('.fecha').datepicker({
			//showOn: 'both',
			buttonImage: 'calendar.png',
			buttonImageOnly: true,
			changeYear: true,
			numberOfMonths: 1,
      
		});
	});
	</script>
	<a href='./informes/excelpagos.php?idev=$idev' ><img src=./img/informe.png  ></a>
	<table width=100% align=center id=tabpay >
	<thead bgcolor=gray >
		<th>NIT</th>
		<th>Razon Social</th>
		<th>Direccion</th>
		<th>Tarifa</th>
		<th>Asistente</th>
		<th>Valor Pago</th>
		<th>Forma Pago</th>
		<th>Nro. Transac</th>
		<th>Fecha Transac</th>
		<th>Nro. Recibo</th>
		<th>Fecha Recibo</th>
		<th>Observacion</th>
		<th>Editar</th>
		
	</thead>
	<tbody>
";
$i=1;
while( $row = $db->fetch_array($sqlpay)){
	echo "
	<tr>
		<td><font face=Verdana size=2 >$row[nit]</font></td>
		<td><font face=Verdana size=2 >$row[rsocial]</font></td>
		<td><font face=Verdana size=2 >$row[dir]</font></td>
		<td><font face=Verdana size=2 >$row[tarifa]</font></td>
		<td><font face=Verdana size=2 >$row[nombres] $row[apellidos]</font></td>
		";
		
		$sqlas = $db->consulta("select count(cedula) asist from event_asist where idevent=$idev and nit='$row[nit]'");
		$rowas = $db->fetch_array($sqlas);
		
		//echo "<td>$rowas[asist]</td>";
		
		$sql =  $db->consulta("select * from pagos where idevento=$idev and nit='$row[nit]' and cedula='$row[cedula]' ");
		$nump = $db->num_rows($sql);
		
		if( $nump > 0){
		
		while( $rowe = $db->fetch_array($sql)){
			echo "
				<td><input type=text name=vlrpago$i value='$rowe[vlrpago]' class=dis$i disabled size=10   /><input type=hidden name=idpay$i value=$rowe[idpago] class=dis$i disabled /></td>
				<td><input type=text name=formapago$i value='$rowe[formapago]' class=dis$i disabled  size=15 /></td>
				<td><input type=text name=nrotran$i value='$rowe[nrotran]' class=dis$i disabled size=10  /></td>
				<td><input type=text name=fectrans$i value='$rowe[fectrans]' class='dis$i fecha' disabled size=10  /></td>
				<td><input type=text name=nrorecibo$i value='$rowe[nrorecibo]' class=dis$i disabled size=10  /></td>
				<td><input type=text name=fecrecibo$i value='$rowe[fecrecibo]' class='dis$i fecha' disabled size=10  /></td>
				<td><input type=text name=observa$i value='$rowe[observa]' class=dis$i disabled  size=15 /></td>";
		}
		}else{
		echo "
				<td><input type=text name='vlrpago$i' class=dis$i disabled size=10  /></td>
				<td><input type=text name='formapago$i' class=dis$i disabled  size=15 /></td>
				<td><input type=text name=nrotran$i class=dis$i disabled size=10  /></td>
				<td><input type=text name=fectrans$i class='dis$i fecha' disabled size=10  /></td>
				<td><input type=text name=nrorecibo$i class=dis$i disabled size=10  /></td>
				<td><input type=text name=fecrecibo$i class='dis$i fecha' disabled size=10  /></td>
				<td><input type=text name=observa$i  class=dis$i disabled  size=15 />
				<input type=hidden name=nit$i value='".$row['nit']."' class=dis$i disabled  />
				<input type=hidden name=cedula$i value='".$row['cedula']."' class=dis$i disabled  />
				<input type=hidden name=idevento$i value=$idev /></td>";
		
		}
		
		if( $row['nit'] != null ){
			echo "<td><img src=./img/edit.png class=paypal id=$i value=$row[nit] /></td>";
		}else{
			echo "<td><img src=./img/edit.png class=paypal id=$i value=0 /></td>";
		}
		
	echo"</tr>
	";
	$i++;
}

echo "</tbody></table><input type=hidden name=ctrlidev value=$i /><input type=hidden name=idev id=idev value=$idev /><button>Aceptar</button>";

?>