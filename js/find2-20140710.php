<?php
require("../class.conexion.php");

$db = new conn();

$n = $_GET['n'];
$p = $_GET['objet'];
$id = $_GET['id'];

if($p == 5 ){
	/*echo "
		<script>
			$.blockUI({ message: '<h3><img src=./img/bad.png width=25 /><br>Debe Seleccionar un Evento para ser Evaluado.</h3>' });
			setTimeout($.unblockUI, 2000); 
			$('#objet').focus();
		</script>
					
	";
	exit;*/
	$msn = "<h3><img src=./img/bad.png width=25 /><br>Debe Seleccionar un Evento para ser Evaluado.</h3>";
	$array = array("sw" => 2 , "dt1" => $msn );
	
}
$varobj = array('asistentes','empresa','evento');
$varid = array('cedula','nit','idevento');
$varnom = array('nombres','rsocial','nom_evento');

if($n == 3){
	if($id == 'Identificacion' ){
	/*echo "
		<script>
			$.blockUI({ message: '<h3><img src=./img/bad.png width=25 /><br>Por Favor Ingrese el Numero de Identificacion.</h3>' });
			setTimeout($.unblockUI, 2000); 
			$('#s3').focus();
		</script>
					
	";
	exit;*/
	
	$msn = "<h3><img src=./img/bad.png width=25 /><br>Por Favor Ingrese el Numero de Identificacion.</h3>";
	$array = array("sw" => 2 , "dt1" => $msn );
	}
		$sqlvar ="select * from $varobj[$p] where $varid[$p]='$id' ";
		$sql = $db->consulta("select * from $varobj[$p] where $varid[$p]='$id' ");
		$sw = $db->num_rows($sql);
		$row = $db->fetch_array($sql);
		$nom = utf8_encode($row['nombres']);
			$ape = utf8_encode($row['apellidos']);
			$carg = utf8_encode($row['cargo']);
	if($row == true){
		if($p == 0){
			//json para edicion de asistente
			$nom = utf8_encode($row['nombres']);
			$ape = utf8_encode($row['apellidos']);
			$carg = utf8_encode($row['cargo']);
			
			$array = array("sw" => $sw , "dt1" => $id , "dt2" => $nom , "dt3" => $ape , "dt4" => $row['email'] , "dt5" => $row['tel'] , "dt6" => $row['ext'] , "dt7" => $row['cel'] , "dt8" => $row['municipio'] , "dt9" => $carg , "dt10" => $row['habeas'] , "dt11" => $row['comentario']);
		}elseif($p == 1){
			$rsocial = utf8_encode($row['rsocial']);
			$dir = utf8_encode($row['dir']);
			$sqltar = $db->consulta("select tarifa from pagos where nit=$id limit 1 ");
			$rowtar = $db->fetch_array($sqltar);
			$tar = $rowtar['tarifa'];
			$array = array("sw" => $sw , "dt1" => $id , "dt2" => $rsocial , "dt3" => $dir , "dt4" => $tar );
		}elseif($p == 2){
			$nom = utf8_encode($row['nom_evento']);
			$lugar = utf8_encode($row['lugar']);
			$carg = utf8_encode($row['cargo']);
			$place = utf8_encode($row['place_exp']);
			$vcerti = utf8_encode($row['var_certi']);
			
			$array = array("sw" => $sw , "dt1" => $id , "dt2" => $nom , "dt3" => $lugar , "dt4" => $row['cupo'] , "dt5" => $row['fec_event'] , "dt6" => $row['hora'] , "dt7" => $vcerti , "dt8" => $row['fec_exp'] , "dt9" => $place , "dt10" => $row['fec_inicio'] , "dt11" => $row['fec_fin'] , "dt12" =>  $row['image'] , "dt13" => $row['firma'] , "dt14" => $row['fuente'] ); 
			
			 
		}
	}else{
		//echo "<center><img src=./img/find.png /><font size=5 ><b><i>La Identificacion($varid[$p]): $id No Se Encuentra Registrada en el Sistema";
	}	
}


	//$array = array("sw" => 1 , "dt1" => $n );
	$arrayj = json_encode($array);
	echo $arrayj;

?>