<?php

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


$sql = "SELECT ev.fec_event 'FECHAEVENTO', ev.idevento 'CodEvento', ev.nom_evento 'EVENTO', em.nit 'NIT', em.rsocial 'RSOCIAL', em.activos, em.fechaRenovado, em.ultanoren, em.ciiu,  at.cedula 'CEDULA', at.nombres 'NOMBRES', at.apellidos 'APELLIDOS',at.cargo 'CARGO', at.email 'email', at.tel 'TEL',at.ext 'EXT',at.cel 'CEL',at.municipio 'MUNICIPIO',at.habeas 'habeas',ea.e_asistio 'ASISTIO'
FROM evento ev
INNER JOIN empresa em
INNER JOIN asistentes at
INNER JOIN event_asist ea
WHERE ea.cedula = at.cedula
AND ea.nit = em.nit
AND ea.idevent = ev.idevento
ORDER BY ev.idevento  ";

$nestedData = '"FECHA EVENTO";"COD. EVENTO";"EVENTO";"NIT";"RAZON SOCIAL";"CEDULA";"NOMBRES";"APELLIDOS";"CARGO";"e-mail";"TELEFONO";"EXT";"CELULAR";"MUNICIPIO";"ASISTIO";"ACTIVOS";"CIIU";"FECHA RENOVACION";"HABEAS"
';
		
$resEmp = mysql_query($sql, $conEmp) or die(mysql_error());


while($row = mysql_fetch_array($resEmp)) {

        $nestedData .= '"'.$row['FECHAEVENTO'].'";'.'"'.utf8_encode($row['CodEvento']).'";'.'"'.utf8_encode($row['EVENTO']).'";'.'"'.$row['NIT'].'";'.'"'.utf8_encode($row['RSOCIAL']).'";'.'"'.$row['CEDULA'].'";'.'"'.utf8_encode($row['NOMBRES']).'";'.'"'.utf8_encode($row['APELLIDOS']).'";'.'"'.utf8_encode($row['CARGO']).'";'.'"'.utf8_encode($row['email']).'";'.'"'.$row['TEL'].'";'.'"'.$row['EXT'].'";'.'"'.$row['CEL'].'";'.'"'.utf8_encode($row['MUNICIPIO']).'";'.'"'.$row['ASISTIO'].'";'.'"'.$row['activos'].'";'.'"'.$row['ciiu'].'";'.'"'.$row['fechaRenovado'].'";'.'"'.$row['habeas'].'"
		';
		
}
mysql_close($conEmp);

header("Content-type: text/x-csv");
header("Content-Disposition: attachment; filename=totalAsistentes.csv");

echo $nestedData;

?>