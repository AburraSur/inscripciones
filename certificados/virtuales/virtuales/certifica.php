<?php

$conexion = mysql_connect("localhost","root","Ccas1992");  
  mysql_select_db("ccasco_promo",$conexion) or die(mysql_error());  
  
  
$ideve = $_GET['ideve'];
$idasis = $_GET['idasis'];

$sqleve = mysql_query("select * from evento where idevento=$ideve " , $conexion) or die(mysql_error());
$roweve = mysql_fetch_array($sqleve);
$size = $roweve['fuente']."px";
//if ( $_GET['tp'] == 1 ){
	$sqlasis = mysql_query("select a.cedula,a.nombres,a.apellidos,a.email from asistentes a inner join event_asist ea where a.cedula=ea.cedula and ea.idevent=$ideve and ea.cedula='$idasis' " , $conexion) or die(mysql_error());
/*}else{
	$sqlasis = mysql_query("select a.cedula,a.nombres,a.apellidos,a.email from asistentes a inner join mod_asis ma where a.cedula=ma.cedula and ma.idmod=$idmod  and ma.idevento=$ideve and ma.cedula='$idasis' " , $conexion) or die(mysql_error());
}*/
$rowasis = mysql_fetch_array($sqlasis);
$asist = "$rowasis[nombres] $rowasis[apellidos]";
$asistente = utf8_encode($asist);
$id = number_format($idasis,0,'','.');
$arrf = array ("01" => "Enero" ,"02" => "Febrero" ,"03" => "Marzo" ,"04" => "Abril" ,"05" => "Mayo" ,"06" => "Junio" ,"07" => "Julio" ,"08" => "Agosto" ,"09" => "Septiembre" ,"10" => "Octubre" ,"11" => "Noviembre" ,"12" => "Diciembre" );
			
			$fec = explode("-",$roweve[fec_event]);
			$mes = $arrf[$fec[1]];
			
			$fecExp = explode("-",$roweve[fec_exp]);
			$mesExp = $arrf[$fecExp[1]];
$fechaevefoot = "$roweve[place_exp], $mesExp $fecExp[2] de $fecExp[0]";
$nomevento = utf8_encode($roweve['nom_evento']);
$descripcio = utf8_encode($roweve['var_certi']);
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Certificados</title>
<link href="../../css/certivirtual.css" rel="stylesheet" type="text/css"/>
<style>
	.ppal{
		position: absolute;
		z-index:0;
		<?php 
			if($roweve['respon']==2){
				echo "background-image: url(../../img/fondoccaspdf3.png);";
			}else{
				echo "background-image: url(../../img/fondopdf3.png);";
			}
		?>
		background-repeat: no-repeat;
		height:800px;
		width: 1050px;
	}
	
	#footer{
		position: absolute;
		text-align: center;
		bottom: 40px;
		font-size: 12px;
		font-family:Helvetica;
	}
</style>
</head>

<body>
    <div class="cuerpo">
            <div class="ppal"></div>
            <div class="titulo"><b>CÁMARA DE COMERCIO ABURRÁ SUR</b></div>
            <div class="normal">Certifica que:</div>
            <div class="nombre"><p><b><?php echo $asistente; ?></b></p> Identificación: <?php echo $id; ?> 
				<p><b>Particip&oacute; en el evento</b></p>
				<p><b><?php echo $nomevento; ?></b></p>
				<p><b><?php echo $descripcio; ?></b></p>
			</div>	
            <div class="firma"><img src='../../img/firmavirtual.png' /></div>
	
	<h4 id="footer" style="text-align: center;" ><?php echo utf8_encode($fechaevefoot); ?></h4>
	</div>
	
</body>
</html>
