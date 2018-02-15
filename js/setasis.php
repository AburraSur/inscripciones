<?php
require("../class.conexion.php");
require("../conexionSII.php");

$db = new conn();
$sii = new conexionsii();
$ced = $_POST['ced'];
$ideve = $_POST['ideve'];
$n = $_POST['n'];
$p = $_POST['objet'];
$id = $_POST['id'];
$nit = $_POST['nit'];

$varobj = array('asistentes','empresa','evento');
$varid = array('cedula','nit','idevento');
$varnom = array('nombres','rsocial','evento');

if( isset($ced)){
	
	$sql = $db->consulta("select * from asistentes where cedula=$ced ");
	$num = $db->num_rows($sql);
	$row = $db->fetch_array($sql);
	if( isset($ideve)){
	$sqlnit = $db->consulta("SELECT nit
FROM event_asist
WHERE cedula =$ced
AND idevent =$ideve ");
	$rownit = $db->fetch_array($sqlnit);	
	$sqlemp = $db->consulta("select * from empresa where nit='$rownit[nit]' ");
	$rowemp = $db->fetch_array($sqlemp);
}
if( $num == 0 ){
	$array = array("sw" => 2);
}else{

	$array = array("sw" => 1,"ced" => $ced,
					"nom" => utf8_encode($row['nombres']),
					"ape" => utf8_encode($row['apellidos']),
					"mail" => $row['email'],
					"tel" => $row['tel'],
					"ext" => $row['ext'],
					"cel" => $row['cel'],
					"mun" => $row['municipio'],
					"car" => utf8_encode($row['cargo']),
					"coment" => utf8_encode($row['comentario']),
					"habeas" => $row['habeas'],
					"nit" => $rowemp['nit'],
					"rsocial" => $rowemp['rsocial'],
					"dir" => $rowemp['dir'],
					"habeas" => $row['habeas'],
					"ctrl" => $_POST['v']);
					
	}

}elseif( isset($nit)){
	   
    $rowemp = $sii->consultasii("SELECT razonsocial, dircom, ctrafiliacion FROM mreg_est_inscritos where nit='$nit' or numid='$nit' ");

    if($rowemp){
        $dir = $rowemp['dircom'];
        $rsoc = utf8_encode($rowemp['razonsocial']);
        $num = 1;
        if($rowemp['ctrafiliacion']){
            $sqlTarifa = $db->consulta("select * from tarifas_evento where idevento='".$_POST['idevento']."' AND categoria='Afiliado' ");            
            $ctrafilia = 'Afiliado';
        }else{
            $sqlTarifa = $db->consulta("select * from tarifas_evento where idevento='".$_POST['idevento']."' AND categoria='Matriculado' ");
            $ctrafilia = 'Matriculado';
        }
        
        $rowTarifa = $db->fetch_array($sqlTarifa);
        $tarifa = $rowTarifa['valor'];
        $msntarifa = utf8_encode('Se&ntilde;or usuario, su tarifa por persona inscrita es de $'). number_format($tarifa);
    }else{
        $sqlemp = $db->consulta("select * from empresa where nit='$nit' ");
        $rowemp = $db->fetch_array($sqlemp);
        $swNum = $db->num_rows($sqlemp);
		if($swNum>0){
			$rsoc = utf8_encode($rowemp['rsocial']);
			$dir = utf8_encode($rowemp['dir']);
                        $num = 3;
		}else{
			$rsoc = '';
			$dir = '';
                        $num = 3;
		}
        
        $ctrafilia = 'Particular';
        $tarifa = '290000';
        $msntarifa = utf8_encode('Se&ntilde;or usuario, su tarifa por persona inscrita es de $290.000');

    }

    $array = array("sw"             => $num,
                    "nit"           => $nit,
                    "rsocial"       => $rsoc,
                    "dir"           => $dir,
                    "ctrafiliacion" => $ctrafilia,
                    "tarifa"        => $tarifa,
                    "msntarifa"     => $msntarifa );
    
}else{
	$array = array("sw" => 2);
}

/*$array = array("sw" => $sw, "nom" => $nom);*/
$arrayj = json_encode($array);
echo $arrayj;

?>