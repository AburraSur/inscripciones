<?php
header('Content-type: application/vnd.ms-excel');

header("Content-Disposition: attachment; filename=pagosevento.xls");

header("Pragma: no-cache");

header("Expires: 0");



require("../class.conexion.php");

$db = new conn();

$idev = $_GET['idev'];

$sqlpay = $db->consulta("SELECT DISTINCT e.`nit` , e.`rsocial` , e.`dir`  
FROM  `empresa` e
INNER JOIN event_asist ea
WHERE  e.nit = ea.nit
AND ea.idevent =$idev ");

echo "
	<table width=100% align=center id=tabpay >
	<thead bgcolor=gray >
		<th>NIT</th>
		<th>Razon Social</th>
		<th>Direccion</th>
		<th>Asistentes</th>
		<th>Tarifa</th>
		<th>Valor Pago</th>
		<th>Forma Pago</th>
		<th>Nro. Transac</th>
		<th>Fecha Transac</th>
		<th>Nro. Recibo</th>
		<th>Fecha Recibo</th>
		<th>Observacion</th>		
	</thead>
	<tbody>
";
$i=1;
while( $row = $db->fetch_array($sqlpay)){
	echo "
	<tr>
		<td>$row[nit]</td>
		<td>$row[rsocial]</td>
		<td>$row[dir]</td>
		
		";
		
		$sqlas = $db->consulta("select count(cedula) asist from event_asist where idevent=$idev and nit='$row[nit]'");
		$rowas = $db->fetch_array($sqlas);
		
		echo "<td>$rowas[asist]</td>";
		
		$sql =  $db->consulta("select * from pagos where idevento=$idev and nit='$row[nit]' ");
		$nump = $db->num_rows($sql);
		
		if( $nump > 0){
		
		while( $rowe = $db->fetch_array($sql)){
			echo "
				<td>$rowe[tarifa]</td>
				<td>$rowe[vlrpago]</td>
				<td>$rowe[formapago] </td>
				<td>$rowe[nrotran] </td>
				<td>$rowe[fectrans]</td>
				<td>$rowe[nrorecibo]</td>
				<td>$rowe[fecrecibo]</td>
				<td>$rowe[observa]</td>";
		}
		}else{
		echo "
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>";
		
		}
		
		
		
	echo"</tr>
	";
	$i++;
}

echo "</tbody></table>";

?>