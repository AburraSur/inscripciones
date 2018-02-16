<?php

header('Content-type: application/vnd.ms-excel');

header("Content-Disposition: attachment; filename=resultadoscem.xls");

header("Pragma: no-cache");

header("Expires: 0");
//conexion SII
$servidor = "192.168.1.63";
$usuario = "desarrollo";
$clave = "d3s4rr0ll0";
$baseDatos = "sii_55";

$conn = new mysqli($servidor, $usuario, $clave,  $baseDatos);
// Verificar Conexion
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

//conexion servidor local
$conEmp = mysql_connect("localhost", "root", "Ccas1992");
mysql_select_db("ccasco_promo", $conEmp);

$sqlpagos = "select * from evento where idevento=$_GET[cod] ";
$sqlp = mysql_query($sqlpagos, $conEmp) or die(mysql_error());
$rowpago = mysql_fetch_array($sqlp);

// si el evento es pago
if($rowpago['pago']==1){
$sql = "SELECT distinct ev.nom_evento 'EVENTO', a.cedula 'CEDULA',ea.id 'CODIGO',a.nombres 'NOMBRES',a.apellidos 'APELLIDOS',a.email 'email',a.tel 'TELEFONO',a.ext 'EXT',a.cel 'CELULAR',a.municipio 'MUNICIPIO',a.cargo 'CARGO',e.nit 'NIT',e.rsocial 'EMPRESA',e.dir 'DIRECCION EMPRESA',e.comentario 'COMENTARIO', ea.e_asistio 'ASISTIO',p.tarifa 'TARIFA',a.comentario 'COMENTARIO'
FROM asistentes a inner join empresa e inner join event_asist ea inner join evento ev inner join pagos p
WHERE ea.nit=e.nit
AND ea.cedula=a.cedula
AND ea.cedula=p.cedula
AND ea.idevent=ev.idevento
AND ea.idevent=p.idevento
AND ea.idevent=$_GET[cod]";

$tabpago = "<th>TARIFA</th>";

}else{
$sql = "SELECT ev.nom_evento 'EVENTO',a.cedula 'CEDULA',ea.id 'CODIGO',a.nombres 'NOMBRES',a.apellidos 'APELLIDOS',a.email 'email',a.tel 'TELEFONO',a.ext 'EXT',a.cel 'CELULAR',a.municipio 'MUNICIPIO',a.cargo 'CARGO',e.nit 'NIT',e.rsocial 'EMPRESA',e.dir 'DIRECCION EMPRESA',e.comentario 'COMENTARIO', ea.e_asistio 'ASISTIO',a.comentario 'COMENTARIO'
FROM asistentes a inner join empresa e inner join event_asist ea inner join evento ev
WHERE ea.nit=e.nit
AND ea.cedula=a.cedula
AND ea.idevent=ev.idevento
AND ea.idevent=$_GET[cod]";
}

//manejo de modulos

if($rowpago['modulos'] == 'SI'){
	$sqlmod = "select * from modulos where idevento=$_GET[cod] ORDER BY idmod ASC";
	$sqlmodu = mysql_query($sqlmod, $conEmp) or die(mysql_error());
	while( $rowmod = mysql_fetch_array($sqlmodu)){
		$tabmod .= "<th>$rowmod[modulo]</th>";
	}
	
}else{
	$tabmod = "<th>ASISTIO</th>";
}

//encabezado de la tabla
if($rowpago['tipo_evento'] == 1){
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
			<th>NIT</th>
			<th>EMPRESA</th>
			<th>DIRECCION</th>
                        <th>ACTIVOS</th>
                        <th>FECHA RENOVADO</th>
                        <th>CURSOS ACTIVOS</th>
			$tabpago
			<th>COMENTARIO</th>
			$tabmod
		</tr>";
}else{
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
			<th>NIT</th>
			<th>EMPRESA</th>
			<th>DIRECCION</th>
                        <th>ACTIVOS</th>
                        <th>FECHA RENOVADO</th>
			$tabpago
			<th>COMENTARIO</th>
			$tabmod
		</tr>";
}			

//echo $tabla;
$resEmp = mysql_query($sql, $conEmp) or die(mysql_error());

while($row = mysql_fetch_array($resEmp)) {
    $nit = $row['NIT'];
    $activos = "SELECT matricula, acttot, fecrenovacion FROM `mreg_est_matriculados` WHERE `organizacion` != 02 and `categoria` != 03 and `categoria` != 02 and estmatricula != 'NA' and estmatricula != 'NN' and `nit` LIKE  '%$nit%'";
    $datosA = $conn->query($activos);
    $datosActivos = $datosA->fetch_array();
    $activo = $datosActivos['acttot'];
    $fechaR = $datosActivos['fecrenovacion'];
    
if($rowpago['pago']==1){
	$tdpago = "<td>$row[TARIFA]</td>";
}

if($rowpago['modulos'] == 'SI'){
	$sqltdmod = "select * from mod_asis where idevento=$_GET[cod] and cedula=$row[CEDULA] ORDER BY idmod ASC";
	$sqltdmodu = mysql_query($sqltdmod, $conEmp) or die(mysql_error());
	while( $rowtdmod = mysql_fetch_array($sqltdmodu)){
		$tdmod .= "<td>$rowtdmod[asistio]</td>";
	}
}else{
	$tdmod = "<td>$row[ASISTIO]</td>";
}
if($rowpago['tipo_evento'] == 1){
    $querycupos = "SELECT * FROM event_asist a, evento e WHERE `nit` LIKE '$nit' AND `e_asistio` = 1 AND a.idevent = e.idevento AND e.tipo_evento = 1 AND e.fec_event >= '2016-01-01'";
    $cupossql = mysql_query($querycupos, $conEmp) or die(mysql_error());
    $cupos = mysql_num_rows($cupossql);
    $tabla .= "
		<tr>
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
			<td>$row[NIT]</td>
			<td>$row[EMPRESA]</td>
			<td>$row[DIRECCION]</td>
                        <td>$activo</td>
                        <td>$fechaR</td>    
                        <td>$cupos</td>
			$tdpago
			<td>$row[COMENTARIO]</td>
			$tdmod
		</tr>";
}else{
    
    $tabla .= "
		<tr>
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
			<td>$row[NIT]</td>
			<td>$row[EMPRESA]</td>
			<td>$row[DIRECCION]</td>
                        <td>$activo</td>
                        <td>$fechaR</td> 
			$tdpago
			<td>$row[COMENTARIO]</td>
			$tdmod
		</tr>";
    
}
}
    

mysql_close($conEmp);
echo $tabla;



?>