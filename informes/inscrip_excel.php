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
$servidorSII = "192.168.1.26";
$usuarioSII = "consulta_sii";
$claveSII = "C0nsult@.123";
$baseDatosSII = "sii_aburra";

$conn = new mysqli($servidorSII, $usuarioSII, $claveSII,  $baseDatosSII);
// Verificar Conexion a SII
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$eventoid = $_GET['cod'];
$sqlpagos = "select * from evento where idevento= $eventoid";
if($resultadopago = $link->query($sqlpagos) or trigger_error(mysqli_error($link))){}
while($rowpago = $resultadopago->fetch_array()){

// si el evento es pago
if($rowpago['pago']==1){
$sql = "SELECT distinct ev.nom_evento 'EVENTO', a.cedula 'CEDULA',ea.id 'CODIGO',a.nombres 'NOMBRES',a.apellidos 'APELLIDOS',a.email 'email',a.tel 'TELEFONO',a.ext 'EXT',a.cel 'CELULAR',a.municipio 'MUNICIPIO',a.cargo 'CARGO',a.habeas  'HABEAS',e.nit 'NIT',e.rsocial 'EMPRESA',e.dir 'DIRECCION',ea.e_asistio 'ASISTIO',p.tarifa 'TARIFA',a.comentario 'COMENTARIO'
FROM asistentes a inner join empresa e inner join event_asist ea inner join evento ev inner join pagos p
WHERE ea.nit=e.nit
AND ea.cedula=a.cedula
AND ea.cedula=p.cedula
AND ea.idevent=ev.idevento
AND ea.idevent=p.idevento
AND ea.idevent=$eventoid";

$tabpago = "<th>TARIFA</th>";

}else{
$sql = "SELECT ev.nom_evento 'EVENTO',a.cedula 'CEDULA',ea.id 'CODIGO',a.nombres 'NOMBRES',a.apellidos 'APELLIDOS',a.email 'email',a.tel 'TELEFONO',a.ext 'EXT',a.cel 'CELULAR',a.municipio 'MUNICIPIO',a.cargo 'CARGO',a.habeas  'HABEAS',e.nit 'NIT',e.rsocial 'EMPRESA',e.dir 'DIRECCION',ea.e_asistio 'ASISTIO',a.comentario 'COMENTARIO'
FROM asistentes a inner join empresa e inner join event_asist ea inner join evento ev
WHERE ea.nit=e.nit
AND ea.cedula=a.cedula
AND ea.idevent=ev.idevento
AND ea.idevent=$eventoid";
$tabpago = "";
}

//manejo de modulos

if($rowpago['modulos'] == 'SI'){
	$sqlmod = "select * from modulos where idevento=$eventoid ORDER BY idmod ASC";
	if($sqlmodu = $link->query($sqlmod) or trigger_error(mysqli_error($link))){}
        while($rowmod = $sqlmodu->fetch_array()){
		$tabmod.= "<th>$rowmod[modulo]</th>";
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
                        <th>HABEAS</th>
			<th>NIT</th>
			<th>EMPRESA</th>
			<th>DIRECCION</th>
                        <th>ACTIVOS</th>
                        <th>FECHA RENOVADO</th>
                        <th>CIIU</th>
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
                        <th>HABEAS</th>
			<th>NIT</th>
			<th>EMPRESA</th>
			<th>DIRECCION</th>
                        <th>ACTIVOS</th>
                        <th>FECHA RENOVADO</th>
                        <th>CIIU</th>
			<th>TARIFA</th>
			<th>COMENTARIO</th>
			<th>ASISTIO</th>
		</tr>";
}			

//echo $tabla;
if($resEmp = $link->query($sql) or trigger_error(mysqli_error($link))){}

    while($row = $resEmp->fetch_array()){
    $nit = $row['NIT'];
    $activos = "SELECT matricula, acttot,ciiu1, fecrenovacion FROM `mreg_est_inscritos` WHERE `organizacion` != 02 and `categoria` != 03 and `categoria` != 02 and ctrestmatricula NOT IN ('NA','NN','MC','IC') and `numid` LIKE  '%$nit%'";
    if ($datosA = $conn->query($activos) or trigger_error(mysqli_error($conn))){}
    $datosActivos = $datosA->fetch_array();
    $activo = $datosActivos['acttot'];
    $fechaR = $datosActivos['fecrenovacion'];
    $ciiu = $datosActivos['ciiu1'];
    //$activo = 0;
    //$fechaR = "";
    
if($rowpago['pago']==1){
	$tdpago = "<td>$row[TARIFA]</td>";
}else{
    $tdpago = '';
}

if($rowpago['modulos'] == 'SI'){
	$sqltdmod = "select * from mod_asis where idevento=$_GET[cod] and cedula=$row[CEDULA] ORDER BY idmod ASC";
	if ($sqltdmodu = $link->query($sqltdmod) or trigger_error(mysqli_error($conn))){}
        //$sqltdmodu = mysql_query($sqltdmod, $conEmp) or die(mysql_error());
	//while( $rowtdmod = mysql_fetch_array($sqltdmodu)){
        while($rowtdmod = $sqltdmodu->fetch_array()){
		$tdmod .= "<td>$rowtdmod[asistio]</td>";
	}
}else{
	$tdmod = "<td>$row[ASISTIO]</td>";
}
if($rowpago['tipo_evento'] == 1){
    $querycupos = "SELECT * FROM event_asist a, evento e WHERE `nit` LIKE '$nit' AND `e_asistio` = 1 AND a.idevent = e.idevento AND e.tipo_evento = 1 AND e.fec_event >= '2016-01-01'";
    if ($cupossql = $link->query($querycupos) or trigger_error(mysqli_error($conn))){}
    //$cupossql = mysql_query($querycupos, $conEmp) or die(mysql_error());
    $cupos = 1 + mysqli_num_rows($cupossql);
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
                        <td>$row[HABEAS]</td>    
			<td>$row[NIT]</td>
			<td>$row[EMPRESA]</td>
			<td>$row[DIRECCION]</td>
                        <td>$activo</td>
                        <td>$fechaR</td> 
                        <td>$ciiu</td>   
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
                        <td>$row[HABEAS]</td>
			<td>$row[NIT]</td>
			<td>$row[EMPRESA]</td>
			<td>$row[DIRECCION]</td>
                        <td>$activo</td>
                        <td>$fechaR</td>
                        <td>$ciiu</td>    
			$tdpago
			<td>$row[COMENTARIO]</td>
			$tdmod
		</tr>";
    
}
}
    
}
mysqli_close($link);
echo $tabla;
?>