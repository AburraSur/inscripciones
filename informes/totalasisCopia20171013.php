<html>
	<head>
			<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
			<link rel='stylesheet' type='text/css' href='../bootstrap/css/buttons.dataTables.min.css'>
			
			<title>Informe Total Asistentes</title>



	</head>


	<body>
			


<?php
/*
 * si es este
require_once("excel.php");
require_once("excel-ext.php");
*/
/*header('Content-type: application/vnd.ms-excel');

header("Content-Disposition: attachment; filename=resultadoscem.xls");

header("Pragma: no-cache");

header("Expires: 0");*/

//conexion SII
$servidorSII = "192.168.1.26";
$usuarioSII = "consulta_sii";
$claveSII = "C0nsult@.123";
$baseDatosSII = "sii_aburra";

$conn = new mysqli($servidorSII, $usuarioSII, $claveSII,  $baseDatosSII);
// Verificar Conexion a SII

// Verificar Conexion
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
//cambio de caracteres
if (!$conn->set_charset("utf8")) {
    printf("Error cargando el conjunto de caracteres utf8: %s\n", $conn->error);
    exit();
}

$year = 'all';

$conEmp = mysql_connect("localhost", "root", "Ccas1992");
mysql_select_db("ccasco_promo", $conEmp);

if($_GET['year'] === 'all'){
	$wh = "ORDER BY ev.idevento ASC";
}else{
	$wh = "AND year(ev.fec_event) = '$_GET[year]'
		   ORDER BY ev.idevento ASC";
}



/*$conEmp = mysql_connect("localhost", "root", "Ccas1992");
mysql_select_db("promo", $conEmp);*/
$sql = "SELECT ev.fec_event 'FECHAEVENTO', ev.idevento 'CodEvento', ev.nom_evento 'EVENTO', em.nit 'NIT', em.rsocial 'RSOCIAL', em.activos, em.fechaRenovado, em.ultanoren, em.ciiu,  at.cedula 'CEDULA', at.nombres 'NOMBRES', at.apellidos 'APELLIDOS',at.cargo 'CARGO', at.email 'email', at.tel 'TEL',at.ext 'EXT',at.cel 'CEL',at.municipio 'MUNICIPIO',at.habeas 'habeas',ea.e_asistio 'ASISTIO'
FROM evento ev
INNER JOIN empresa em
INNER JOIN asistentes at
INNER JOIN event_asist ea
WHERE ea.cedula = at.cedula
AND ea.nit = em.nit
AND ea.idevent = ev.idevento
$wh  ";

echo "
<div class='table-responsive'>    
	<table id='example' class='table table-striped table-bordered' cellspacing='0' width='100%' >
		<thead>
			<tr>
				<th>FECHA EVENTO</th>
				<th>COD. EVENTO</th>
				<th>EVENTO</th>
				<th>NIT</th>
				<th>RAZON SOCIAL</th>
				<th>CEDULA</th>
				<th>NOMBRES</th>
				<th>APELLIDOS</th>
				<th>CARGO</th>
				<th>e-mail</th>
				<th>TELEFONO</th>
				<th>EXT</th>
				<th>CELULAR</th>
				<th>MUNICIPIO</th>
				<th>ASISTIO</th>
                <th>ACTIVOS</th>
                <th>CIIU</th>
                <th>FECHA RENOVACION</th>
                <th>HABEAS</th>
			</tr>
		</thead>
		<tfoot>
			<tr>
				<th>FECHA EVENTO</th>
				<th>COD. EVENTO</th>
				<th>EVENTO</th>
				<th>NIT</th>
				<th>RAZON SOCIAL</th>
				<th>CEDULA</th>
				<th>NOMBRES</th>
				<th>APELLIDOS</th>
				<th>CARGO</th>
				<th>e-mail</th>
				<th>TELEFONO</th>
				<th>EXT</th>
				<th>CELULAR</th>
				<th>MUNICIPIO</th>
				<th>ASISTIO</th>
                <th>ACTIVOS</th>
                <th>CIIU</th>
                <th>FECHA RENOVACION</th>
                <th>HABEAS</th>
			</tr>
		</tfoot>	";

		
//$sql = "SELECT * FROM empresa";		
$resEmp = mysql_query($sql, $conEmp) or die(mysql_error());


/*$activos = "SELECT matricula, acttot,ciiu1, fecrenovacion, ultanoren FROM `mreg_est_matriculados` WHERE `organizacion` != 02 and `categoria` != 03 and `categoria` != 02 and estmatricula != 'NA' and estmatricula != 'NN' and `numid` LIKE  '%$nit%'";
    if ($datosA = $conn->query($activos) or trigger_error(mysqli_error($conn))){}
   while( $datosActivos = $datosA->fetch_array()){
	$nit = $row['NIT'];
    $activo = $datosActivos['acttot'];
    $fechaR = $datosActivos['fecrenovacion'];
    $ciiu = $datosActivos['ciiu1'];
	$ultanoren = $datosActivos['ultanoren'];
	
	  echo "$activo - $fechaR - $ciiu - $ultanoren <br>"; 
	  $empresa = "UPDATE empresa SET activos='$activo', $fechaRenovado='$fechaR', ciiu='$ciiu', ultanoren='$ultanoren' WHERE nit='$nit' ";
	  mysql_query($empresa, $conEmp) or die(mysql_error());
   }*/

while($row = mysql_fetch_array($resEmp)) {
   /* $nit = $row['NIT'];
    $activos = "SELECT matricula, acttot,ciiu1, fecrenovacion FROM `mreg_est_matriculados` WHERE `organizacion` != 02 and `categoria` != 03 and `categoria` != 02 and estmatricula != 'NA' and estmatricula != 'NN' and `numid` LIKE  '%$nit%'";
    if ($datosA = $conn->query($activos) or trigger_error(mysqli_error($conn))){}
    $datosActivos = $datosA->fetch_array();
    $activo = $datosActivos['acttot'];
    $fechaR = $datosActivos['fecrenovacion'];
    $ciiu = $datosActivos['ciiu1'];
	
	echo "$activo - $fechaR - $ciiu - $ultanoren <br>"; 
	if($nit !=''){
	  $empresa = "UPDATE empresa SET activos='$activo', $fechaRenovado='$fechaR', ciiu='$ciiu', ultanoren='$ultanoren' WHERE nit='$nit' ";
	  mysql_query($empresa, $conEmp) or die(mysql_error());
	}  */
   echo "
		<tr>
			<td><h5>$row[FECHAEVENTO]</h5></td>
			<td><h5>".utf8_encode($row['CodEvento'])."</h5></td>
			<td><h5>".utf8_encode($row['EVENTO'])."</h5></td>
			<td><h5>$row[NIT]</h5></td>
			<td><h5>".utf8_encode($row['RSOCIAL'])."</h5></td>
			<td><h5>$row[CEDULA]</h5></td>
			<td><h5>".utf8_encode($row['NOMBRES'])."</h5></td>
			<td><h5>".utf8_encode($row['APELLIDOS'])."</h5></td>
			<td><h5>".utf8_encode($row['CARGO'])."</h5></td>
			<td><h5>".utf8_encode($row['email'])."</h5></td>
			<td><h5>$row[TEL]</h5></td>
			<td><h5>$row[EXT]</h5></td>
			<td><h5>$row[CEL]</h5></td>
			<td><h5>".utf8_encode($row['MUNICIPIO'])."</h5></td>
			<td><h5>$row[ASISTIO]</h5></td>
                        <td><h5>$row[activos]</h5></td>
                        <td><h5>$row[ciiu]</h5></td>
                        <td><h5>$row[fechaRenovado]</h5></td>
                        <td><h5>$row[habeas]</h5></td>	
		</tr>";

}
mysql_close($conEmp);

//createExcel("TotalAsistentes.xls", $data);
//exit;


?>
	</table>
</div>
<script type='text/javascript' language='javascript' src='../bootstrap/js/jquery-1.12.4.js'>
			</script>
			<script type='text/javascript' language='javascript' src='../bootstrap/js/jquery.dataTables.min.js'>
			</script>
			<script type='text/javascript' language='javascript' src='../bootstrap/js/dataTables.buttons.min.js'>
			</script>
			<script type='text/javascript' language='javascript' src='../bootstrap/js/jszip.min.js'>
			</script>
			<script type='text/javascript' language='javascript' src='../bootstrap/js/pdfmaker.min.js'>
			</script>
			<script type='text/javascript' language='javascript' src='../bootstrap/js/vfs_fonts.js'>
			</script>
			<script type='text/javascript' language='javascript' src='../bootstrap/js/buttons.html5.min.js'>
			</script>
			<script type='text/javascript' language='javascript' src='../bootstrap/js/dataTables.bootstrap.js'>
			</script>
			<script>
				$(document).ready(function(){					
					
					  $('#example').DataTable({
						  dom: 'Bfrtip',
							buttons: [
								'excelHtml5'
							],
							order: [[ 0, "desc" ]],
							language: {
								search:         'Buscar:',
								lengthMenu:     'Mostrando _MENU_ registros por página',
								info:           'Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros',
								infoFiltered:   '(filtrados de un total de _MAX_ registros)',
								InfoEmpty:      'Mostrando registros del 0 al 0 de un total de 0 registros',
								loadingRecords: 'Cargando',
								zeroRecords:    'Búsqueda sin resultados',
								emptyTable:     'Tabla sin información',
								paginate:		{
									first:      'Primera',
									previous:   'Anterior',
									next:       'Siguiente',
									last:       'último',
								}	
							}
					  });
				});
			</script>		
	</body>
</html>			
			