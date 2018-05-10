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
$varobj = array('asistentes','empresa','evento','modulos');
$varid = array('cedula','nit','idevento','idmod');
$varnom = array('nombres','rsocial','nom_evento','modulo');

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
			
			$array = array("sw" => $sw , "dt1" => $id , "dt2" => $nom , "dt3" => $lugar , "dt4" => $row['cupo'] , "dt5" => $row['fec_event'] , "dt6" => $row['hora'] , "dt7" => $vcerti , "dt8" => $row['fec_exp'] , "dt9" => $place , "dt10" => $row['fec_inicio'] , "dt11" => $row['fec_fin'] , "dt12" =>  $row['image'] , "dt13" => $row['firma'] , "dt14" => $row['fuente'] , "dt15" => $row['estado'] ); 
			
			 
		}elseif($p == 3){
			$nom = utf8_encode($row['modulo']);
			$fec_mod = $row['fec_mod'];
			$array = array("sw" => $sw , "dt1" => $nom , "dt2" => $fec_mod , "dt3" => $id ); 			 
		}
	}else{
		//echo "<center><img src=./img/find.png /><font size=5 ><b><i>La Identificacion($varid[$p]): $id No Se Encuentra Registrada en el Sistema";
	}	
}elseif($n == 4){
	$sql = $db->consulta("select * from $varobj[$p] where $varnom[$p] like'%$id%' ");
			$html = "<table width=80% align=center id=tbs >";
		$sqltext = 	"select * from $varobj[$p] where $varnom[$p] like'%$id%' ";
			if($p==0){
				$html.="<thead bgcolor=gray >
					<th><font face=Verdana size=4 ><b><i>Cedula</b></font></th>
					<th><font face=Verdana size=4 ><b><i>Nombres</b></font></th>
					<th><font face=Verdana size=4 ><b><i>Apellidos</b></font></th>
					<th><font face=Verdana size=4 ><b><i>e-mail</b></font></th>
					<th><font face=Verdana size=4 ><b><i>Acciones</b></font></th>
				</thead>
				<tbody>";
				while($row = $db->fetch_array($sql)){
				$html.= "<tr>
						<td><font face=Verdana size=2 >$row[cedula]</font></td>
						<td><font face=Verdana size=2 >".utf8_encode($row[nombres])."</font></td>
						<td><font face=Verdana size=2 >".utf8_encode($row[apellidos])."</font></td>
						<td><font face=Verdana size=2 >$row[email]</font></td>
						<td>
							<img src=./img/edit.png title='Editar Inscripcion' width=20 class='lapiz' value='$row[cedula]' />
							
						</td>
					</tr>";
				}
				
			}elseif($p==1){
				$html.="<thead bgcolor=gray >
					<th><font face=Verdana size=4 ><b><i>NIT</b></font></th>
					<th><font face=Verdana size=4 ><b><i>Nombre</b></font></th>
					<th><font face=Verdana size=4 ><b><i>Direcci&oacute;n</b></font></th>
					<th><font face=Verdana size=4 ><b><i>Acciones</b></font></th>
				</thead>
				<tbody>";
				while($row = $db->fetch_array($sql)){
				$html.= "<tr>
						<td><font face=Verdana size=2 >$row[nit]</font></td>
						<td><font face=Verdana size=2 >".utf8_encode($row['rsocial'])."</font></td>
						<td><font face=Verdana size=2 >".utf8_encode($row['dir'])."</font></td>
						<td>
							<img src=./img/edit.png title='Editar Inscripcion' width=20 class='lapiz' value='$row[nit]' />
							
						</td>
					</tr>";
				}
			}elseif($p==2){
				$html.="<thead bgcolor=gray >
					<th><font face=Verdana size=4 ><b><i>ID.Evento</b></font></th>
					<th><font face=Verdana size=4 ><b><i>Nombre Evento</b></font></th>
					<th><font face=Verdana size=4 ><b><i>Fecha Evento</b></font></th>
					<th><font face=Verdana size=4 ><b><i>Acciones</b></font></th>
				</thead>
				<tbody>";
				while($row = $db->fetch_array($sql)){
				$html.= "<tr>
						<td><font face=Verdana size=2 >$row[idevento]</font></td>
						<td><font face=Verdana size=2 >".utf8_decode($row[nom_evento])."</font></td>
						<td><font face=Verdana size=2 >$row[fec_event]</font></td>
						<td>
							<img src=./img/edit.png title='Editar Inscripcion' width=20 class='lapiz' value='$row[idevento]' />
							
						</td>
					</tr>";
				}
			}elseif($p==3){
				$html.="<thead bgcolor=gray >
					<th><font face=Verdana size=4 ><b><i>ID.Modulo</b></font></th>
					<th><font face=Verdana size=4 ><b><i>Nombre Modulo</b></font></th>
					<th><font face=Verdana size=4 ><b><i>Fecha Modulo</b></font></th>
					<th><font face=Verdana size=4 ><b><i>Acciones</b></font></th>
				</thead>
				<tbody>";
				while($row = $db->fetch_array($sql)){
				$html.= "<tr>
						<td><font face=Verdana size=2 >$row[idmod]</font></td>
						<td><font face=Verdana size=2 >".utf8_decode($row[modulo])."</font></td>
						<td><font face=Verdana size=2 >$row[fec_mod]</font></td>
						<td>
							<img src=./img/edit.png title='Editar Inscripcion' width=20 class='lapiz' value='$row[idmod]' />
							
						</td>
					</tr>";
				}
			}
			$html.= "</tbody></table>";
					
					$array = array("sw" => 1 , "html" => $html , "p" => $sqltext);
}elseif($n==5){
	$sqlrel = $db->consulta("select * from event_asist where idevent='$_GET[idevent]' and cedula='$_GET[idpart]'");
	$num = $db->num_rows($sqlrel);
	
	if($num>0){
		$rowrel = $db->consulta2("SELECT * 
								  FROM  `event_asist` ea
								  INNER JOIN asistentes a
								  INNER JOIN empresa em
								  WHERE a.cedula = ea.cedula
								  AND ea.nit = em.nit
								  AND ea.cedula ='$_GET[idpart]'
								  AND ea.idevent ='$_GET[idevent]'");
		$nompart = "$rowrel[nombres] $rowrel[apellidos] ";
		$part = utf8_encode($nompart);
		$rsoc = utf8_encode($rowrel['rsocial']);						  
		$array = array("sw" => 1 , "part" => $part , "rsoc" => $rsoc , "nit" => $rowrel['nit']);
	}else{
		$array = array("sw" => 2 , "error" => $sqlrel , "num" => $num);
	}
}elseif($n==6){
//	$sqlrel = $db->consulta("select * from pagos where idevent='$_GET[idevent]' and cedula='$_GET[idpart]'");
        $sqlrel = $db->consulta("SELECT DISTINCT a.nombres, a.apellidos, pg.tarifa  
                                    FROM  `event_asist` ea
                                    INNER JOIN asistentes a ON a.cedula=ea.cedula
                                    INNER JOIN pagos pg ON pg.cedula=ea.cedula
                                    WHERE ea.idevent=pg.idevento
                                    AND ea.cedula ='$_GET[idpart]'
                                    AND ea.idevent ='$_GET[idevent]'");
	$num = $db->num_rows($sqlrel);
	
	if($num>0){
		$rowrel = $db->fetch_array($sqlrel);
		$nompart = "$rowrel[nombres] $rowrel[apellidos] ";
		$part = utf8_encode($nompart);
		$tarifa = utf8_encode($rowrel['tarifa']);						  
		$array = array("sw" => 1 , "part" => $part , "tarifa" => $tarifa );
	}else{
		$array = array("sw" => 2 , "error" => $sqlrel , "num" => $num);
	}
}elseif($n==7){
//	$sqlrel = $db->consulta("select * from pagos where idevent='$_GET[idevent]' and cedula='$_GET[idpart]'");
        $sqlrel = $db->consulta("SELECT * from tarifas_evento where idevento='$_GET[idevent]'");
	$num = $db->num_rows($sqlrel);
	
	if($num>0){
		
                while($rowrel = $db->fetch_array($sqlrel)){
                    $tarifas[$rowrel['categoria']] = $rowrel['valor'];
                }
                
                $tarifasEvento = json_encode($tarifas);
		$array = array("sw" => 1 , "tarifasEvento" => $tarifasEvento );
	}else{
		$array = array("sw" => 2 , "error" => $sqlrel , "num" => $num);
	}
}


	//$array = array("sw" => 1 , "dt1" => $n );
	$arrayj = json_encode($array);
	echo $arrayj;

?>