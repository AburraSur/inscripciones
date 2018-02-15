<?php

header('Content-type: application/vnd.ms-excel');

header("Content-Disposition: attachment; filename=resultadoscem.xls");

header("Pragma: no-cache");

header("Expires: 0");
require_once '../clases/conectar.php';
//conexion promo
$linked = new conectar();
$link = $linked->conectarbdInforme();
//conexion SII
$servidor = "192.168.1.63";
$usuario = "desarrollo";
$clave = "d3s4rr0ll0";
$baseDatos = "sii_55";

/*$conn = new mysqli($servidor, $usuario, $clave,  $baseDatos);
// Verificar Conexion a SII
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}*/
$modulo = $_GET['cod'];
//manejo de modulos
//encabezado de la tabla
$tabla = "
	<table cellspacing=0 cellpadding=0 border=1>
		<tr>
			<th>EVENTO</th>
			<th>CEDULA</th>
			<th>CODIGO</th>
			<th>NOMBRES</th>
			<th>APELLIDOS</th>
			<th>e-mail</th>
			<th>TELEFONO</th>
			<th>EXT</th>
			<th>CELULAR</th>
			<th>MUNICIPIO</th>
			<th>CARGO</th>
                        <th>HABEAS</th>
			<th>NIT</th>
			<th>EMPRESA</th>
			<th>DIRECCION</th>
			<th>COMENTARIO</th>
			<th>ASISTIO</th>
		</tr>";
$sqlmodulo = "select * from mod_asis where idmod= $modulo";
if($resultadoM = $link->query($sqlmodulo) or trigger_error(mysqli_error($link))){}
while($rowModulo = $resultadoM->fetch_array()){ 
$eventoid = $rowModulo['idevento'];
$cedula = $rowModulo['cedula'];
// si el evento es pago
$sql = "SELECT ev.nom_evento 'EVENTO',a.cedula 'CEDULA',ea.id 'CODIGO',a.nombres 'NOMBRES',a.apellidos 'APELLIDOS',a.email 'email',a.tel 'TELEFONO',a.ext 'EXT',a.cel 'CELULAR',a.municipio 'MUNICIPIO',a.cargo 'CARGO',a.habeas  'HABEAS',e.nit 'NIT',e.rsocial 'EMPRESA',e.dir 'DIRECCION',ea.e_asistio 'ASISTIO',a.comentario 'COMENTARIO'
FROM asistentes a inner join empresa e inner join event_asist ea inner join evento ev
WHERE ea.nit=e.nit
AND ea.cedula=a.cedula
AND ea.idevent=ev.idevento
AND ea.idevent= '$eventoid'
AND a.cedula = '$cedula'";

if($resEmp = $link->query($sql) or trigger_error(mysqli_error($link))){}

    while($row = $resEmp->fetch_array()){
    $nit = $row['NIT'];
    $tdmod = "<td>$row[ASISTIO]</td>";    

    $tabla .= "<tr>
			<td>$row[EVENTO]</td>
			<td>$row[CEDULA]</td>
			<td>$row[CODIGO]</td>
			<td>$row[NOMBRES]</td>
			<td>$row[APELLIDOS]</td>
			<td>$row[email]</td>
			<td>$row[TELEFONO]</td>
			<td>$row[EXT]</td>
			<td>$row[CELULAR]</td>
			<td>$row[MUNICIPIO]</td>
			<td>$row[CARGO]</td>
                        <td>$row[HABEAS]</td>
			<td>$row[NIT]</td>
			<td>$row[EMPRESA]</td>
			<td>$row[DIRECCION]</td>
                        <td>$row[COMENTARIO]</td>
			$tdmod
		</tr>";
    
}    
}
mysqli_close($link);
echo $tabla;
?>