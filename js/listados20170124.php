<?php
/*
$dbh = mysql_connect("localhost", "root", "Ccas1992");
$db = mysql_select_db("promo");
*/
include("../class.conexion.php");  
 $db = new conn();  
 
?>

  <script>
	$(document).ready(function(){
		
			$(".secun tbody tr:even").css('background-color','#FFFF99');
		
	});
  
  </script>
<table width="100%" id="ppal" >
			<tr bgcolor="gray" >
				<td><font face="Verdana" size="3" ><b><i>ID Evento</i></b></font></td>
				<td><font face="Verdana" size="3" ><b><i>Evento</i></b></font></td>
				<td><font face="Verdana" size="3" ><b><i>Lugar del Evento</i></b></font></td>
				<td><font face="Verdana" size="3" ><b><i>Fecha Evento</i></b></font></td>
				<td><font face="Verdana" size="3" ><b><i>Hora Evento</i></b></font></td>
				<td><font face="Verdana" size="3" ><b><i>Inscripciones</i></b></font></td>
                                <td><font face="Verdana" size="3" ><b><i>Pendientes</i></b></font></td>
				<td><font face="Verdana" size="3" ><b><i>Confirmados</i></b></font></td>
                                <td><font face="Verdana" size="3" ><b><i>Cancelados</i></b></font></td>
				<td><font face="Verdana" size="3" ><b><i>Ver</i></b></font></td>
			</tr>
		<?php
		$estado = $_GET['est'];
		$ano = $_GET['year'];
		$sql2=$db->consulta("select * from evento where estado='$estado' and year(fec_event)=$ano order by idevento  ;");
		$numr=$db->num_rows($sql2);
		
		
		while($row2=$db->fetch_array($sql2)){
		$sql3=$db->consulta("select count(cedula) as 'CANT' from event_asist where idevent=$row2[idevento] ");                
		$sql0=$db->consulta("select count(cedula) as 'CANT' from event_asist where idevent=$row2[idevento] and e_asistio=0 ");
		$sql4=$db->consulta("select count(cedula) as 'CANT' from event_asist where idevent=$row2[idevento] and e_asistio=1 ");
                $sql5=$db->consulta("select count(cedula) as 'CANT' from event_asist where idevent=$row2[idevento] and e_asistio=3 ");
		$row=$db->fetch_array($sql3);
                $row0=$db->fetch_array($sql0);
		$rowa=$db->fetch_array($sql4);
                $rowc=$db->fetch_array($sql5);
		if($numr%2 == 1){
		
			echo "<tr bgcolor=silver align=center >
				<td><font face=Verdana size=2 ><b><i>$row2[idevento]</i></b></font></td>
				<td><font face=Verdana size=2 ><b><i>$row2[nom_evento]</i></b></font></td>
				<td><font face=Verdana size=2 ><b><i>$row2[lugar]</i></b></font></td>
				<td><font face=Verdana size=2 ><b><i>$row2[fec_event]</i></b></font></td>
				<td><font face=Verdana size=2 ><b><i>$row2[hora]</i></b></font></td>
				<td><font face=Verdana size=2 ><b><i>$row[CANT]</i></b></font></td>
                                <td><font face=Verdana size=2 ><b><i>$row0[CANT]</i></b></font></td>
				<td><font face=Verdana size=2 ><b><i>$rowa[CANT]</i></b></font></td>
                                <td><font face=Verdana size=2 ><b><i>$rowc[CANT]</i></b></font></td>
				<td><a href=./informes/inscrip_excel.php?cod=$row2[idevento] ><img src='./img/excel.png' width=30 /></a></td></tr>";
				if( $row2['modulos'] == 'SI' ){
				$sqlmod = $db->consulta("select * from modulos where idevento=$row2[idevento] ");
				$numod = $db->num_rows($sqlmod);
				if( $numod > 0){
				echo "<tr align=center ><td colspan=6 >
					<table width=90% align=center class=secun >
						<thead bgcolor=amber >
							<th><b><i>ID Modulo</i></b></th>
							<th><b><i>Modulo</i></b></th>
							<th><b><i>Fecha Modulo</i></b></th>
							<th><b><i>Inscripciones</i></b></th>
							<th><b><i>Pendientes</i></b></th>
							<th><b><i>Confirmados</i></b></th>
							<th><b><i>Cancelados</i></b></th>
							<th><b><i>Ver</i></b></th>
						</thead>
						<tbody>";
						
						
						while($rowmod = $db->fetch_array($sqlmod)){
						
							$sqlmod2 = $db->consulta("select count(cedula) as 'cant2' from mod_asis where idmod=$rowmod[idmod] ");
							$rowmod2 = $db->fetch_array($sqlmod2);
                                                        $sqlmod0 = $db->consulta("select count(cedula) as 'cant0' from mod_asis where idmod=$rowmod[idmod] and asistio=0 ");
							$rowmod0 = $db->fetch_array($sqlmod0);
							$sqlmod3 = $db->consulta("select count(cedula) as 'cant3' from mod_asis where idmod=$rowmod[idmod] and asistio=1 ");
							$rowmod3 = $db->fetch_array($sqlmod3);
                                                        $sqlmodCan = $db->consulta("select count(cedula) as 'cant4' from mod_asis where idmod=$rowmod[idmod] and asistio=3 ");
							$rowmodCan = $db->fetch_array($sqlmodCan);
							echo"
								<tr align=center >
									<td><font face=Verdana size=2 ><b><i>$rowmod[idmod]</i></b></font></td>
									<td><font face=Verdana size=2 ><b><i>$rowmod[modulo]</i></b></font></td>
									<td><font face=Verdana size=2 ><b><i>$rowmod[fec_mod]</i></b></font></td>
									<td><font face=Verdana size=2 ><b><i>$rowmod2[cant2]</i></b></font></td>
                                                                        <td><font face=Verdana size=2 ><b><i>$rowmod0[cant0]</i></b></font></td>
									<td><font face=Verdana size=2 ><b><i>$rowmod3[cant3]</i></b></font></td>
                                                                        <td><font face=Verdana size=2 ><b><i>$rowmodCan[cant4]</i></b></font></td>
									<td align=center ><a href='./informes/ins_modulos.php?cod=$rowmod[idmod]' ><img src='./img/excel.png' width=30 /></a></td>
								</tr>
							";
						}
						
					echo"</tbody>
					</table>
				</td></tr>";
				}
				}
				
				if($row2['pago']==1){
					$sqlmod2 = $db->consulta("select count(p.cedula) as 'cant2' from pagos p inner join event_asist ea where p.cedula=ea.cedula and p.idevento=ea.idevent and ea.e_asistio<>3 and p.tarifa<>'Invitado' and p.vlrpago=0 and p.idevento=$row2[idevento] ");
							$rowmod2 = $db->fetch_array($sqlmod2);
							$sqlmod3 = $db->consulta("select count(p.cedula) as 'cant3' from pagos p where p.tarifa='Invitado' and p.idevento=$row2[idevento] ");
							$rowmod3 = $db->fetch_array($sqlmod3);
							$sqlmod4 = $db->consulta("select count(p.cedula) as 'cant4' from pagos p where p.vlrpago>0 and idevento=$row2[idevento] ");
							$rowmod4 = $db->fetch_array($sqlmod4);
							$sqlmodCan = $db->consulta("select count(p.cedula) as 'cantCan' from pagos p inner join event_asist ea inner join asistentes a where a.cedula=p.cedula and ea.cedula=p.cedula and ea.e_asistio=3 and p.idevento=$row2[idevento] and ea.idevent=$row2[idevento] ");
							$rowmodCan = $db->fetch_array($sqlmodCan);
                                                        
					echo "<tr align=center ><td colspan=6 >
					<table width=60% align=center class=secun  >
						<thead bgcolor=amber >
							<th><b><i>Pagos Pendientes</i></b></th>
							<th><b><i>Pagos Confirmados</i></b></th>
							<th><b><i>Invitados</i></b></th>
                                                        <th><b><i>Cancelados</i></b></th>
							<th><b><i>Ver</i></b></th>
						</thead>
						<tbody>";
						
					
						
							
							
							echo"
								<tr align=center >
									<td><font face=Verdana size=2 ><b><i>$rowmod2[cant2]</i></b></font></td>
									<td><font face=Verdana size=2 ><b><i>$rowmod4[cant4]</i></b></font></td>
									<td><font face=Verdana size=2 ><b><i>$rowmod3[cant3]</i></b></font></td>
                                                                        <td><font face=Verdana size=2 ><b><i>$rowmodCan[cantCan]</i></b></font></td>    
									<td align=center ><a href='./informes/pagos.php?cod=$row2[idevento]' ><img src='./img/excel.png' width=30 /></a></td>
								</tr>
							";
						
						
					echo"</tbody>
					</table>
				</td></tr>";
				}
				
			}else{
			echo "<tr align=center bgcolor=gray>
				<td><font face=Verdana size=2 ><b><i>$row2[idevento]</i></b></font></td>
				<td><font face=Verdana size=2 ><b><i>$row2[nom_evento]</i></b></font></td>
				<td><font face=Verdana size=2 ><b><i>$row2[lugar]</i></b></font></td>
				<td><font face=Verdana size=2 ><b><i>$row2[fec_event]</i></b></font></td>
				<td><font face=Verdana size=2 ><b><i>$row2[hora]</i></b></font></td>
				<td><font face=Verdana size=2 ><b><i>$row[CANT]</i></b></font></td>
                                <td><font face=Verdana size=2 ><b><i>$row0[CANT]</i></b></font></td>
				<td><font face=Verdana size=2 ><b><i>$rowa[CANT]</i></b></font></td>
                                <td><font face=Verdana size=2 ><b><i>$rowc[CANT]</i></b></font></td>
				
				";
				if( $row2['modulos'] == 'SI' ){
					echo "<td><a href=./informes/informe.php?cod=$row2[idevento] ><img src='./img/excel.png' width=30 /></a></td>";
				$sqlmod = $db->consulta("select * from modulos where idevento=$row2[idevento] ");
				$numod = $db->num_rows($sqlmod);
				if( $numod > 0){
				echo "<tr align=center ><td colspan=6 >
					<table width=80% align=center class=secun  >
						<thead bgcolor=amber >
							<th><b><i>ID Modulo</i></b></th>
							<th><b><i>Modulo</i></b></th>
							<th><b><i>Fecha Modulo</i></b></th>
							<th><b><i>Inscripciones</i></b></th>
                                                        <th><b><i>Pendientes</i></b></th>
							<th><b><i>Confirmados</i></b></th>
                                                        <th><b><i>Cancelados</i></b></th>
							<th><b><i>Ver</i></b></th>
						</thead>
						<tbody>";
						
						$sqlmod = $db->consulta("select * from modulos where idevento=$row2[idevento] ");
						while($rowmod = $db->fetch_array($sqlmod)){
						
							$sqlmod2 = $db->consulta("select count(cedula) as 'cant2' from mod_asis where idmod=$rowmod[idmod] ");
							$rowmod2 = $db->fetch_array($sqlmod2);
							$sqlmod0 = $db->consulta("select count(cedula) as 'cant0' from mod_asis where idmod=$rowmod[idmod] and asistio=0 ");
							$rowmod0 = $db->fetch_array($sqlmod0);
							$sqlmod3 = $db->consulta("select count(cedula) as 'cant3' from mod_asis where idmod=$rowmod[idmod] and asistio=1 ");
							$rowmod3 = $db->fetch_array($sqlmod3);
                                                        $sqlmodCan = $db->consulta("select count(cedula) as 'cantCan' from mod_asis where idmod=$rowmod[idmod] and asistio=3 ");
							$rowmodCan = $db->fetch_array($sqlmodCan);
							
							echo"
								<tr align=center >
									<td><font face=Verdana size=2 ><b><i>$rowmod[idmod]</i></b></font></td>
									<td><font face=Verdana size=2 ><b><i>$rowmod[modulo]</i></b></font></td>
									<td><font face=Verdana size=2 ><b><i>$rowmod[fec_mod]</i></b></font></td>
									<td><font face=Verdana size=2 ><b><i>$rowmod2[cant2]</i></b></font></td>
									<td><font face=Verdana size=2 ><b><i>$rowmod0[cant0]</i></b></font></td>
                                                                        <td><font face=Verdana size=2 ><b><i>$rowmod3[cant3]</i></b></font></td>    
                                                                        <td><font face=Verdana size=2 ><b><i>$rowmodCan[cantCan]</i></b></font></td>
									<td align=center ><a href='./informes/ins_modulos.php?cod=$rowmod[idmod]' ><img src='./img/excel.png' width=30 /></a></td>
								</tr>
							";
						}
						
					echo"</tbody>
					</table>
				</td></tr>";
				}
				}else{
					echo "<td><a href=./informes/inscrip_excel.php?cod=$row2[idevento] ><img src='./img/excel.png' width=30 /></a></td>";
				}
				if($row2['pago']==1){
					$sqlmod2 = $db->consulta("select count(p.cedula) as 'cant2' from pagos p inner join event_asist ea where p.cedula=ea.cedula and p.idevento=ea.idevent and ea.e_asistio<>3 and p.tarifa<>'Invitado' and p.vlrpago=0 and p.idevento=$row2[idevento] ");
							$rowmod2 = $db->fetch_array($sqlmod2);
							$sqlmod3 = $db->consulta("select count(p.cedula) as 'cant3' from pagos p inner join asistentes a where p.cedula=a.cedula and p.tarifa='Invitado' and idevento=$row2[idevento] ");
							$rowmod3 = $db->fetch_array($sqlmod3);
							$sqlmod4 = $db->consulta("select count(p.cedula) as 'cant4' from pagos p inner join asistentes a where p.cedula=a.cedula and p.vlrpago>0 and idevento=$row2[idevento] ");
							$rowmod4 = $db->fetch_array($sqlmod4);
                                                        $sqlmodCan = $db->consulta("select count(p.cedula) as 'cantCan' from pagos p inner join event_asist ea inner join asistentes a where a.cedula=p.cedula and ea.cedula=p.cedula and ea.e_asistio=3 and p.idevento=$row2[idevento] and ea.idevent=$row2[idevento] ");
							$rowmodCan = $db->fetch_array($sqlmodCan);
					echo "<tr align=center ><td colspan=6 >
					<table width=60% align=center class=secun  >
						<thead bgcolor=amber >
							<th><b><i>Pagos Pendientes</i></b></th>
							<th><b><i>Pagos Confirmados</i></b></th>
							<th><b><i>Invitados</i></b></th>
                                                        <th><b><i>Cancelados</i></b></th>
							<th><b><i>Ver</i></b></th>
						</thead>
						<tbody>";
						
					
						
							
							
							echo"
								<tr align=center >
									<td><font face=Verdana size=2 ><b><i>$rowmod2[cant2]</i></b></font></td>
									<td><font face=Verdana size=2 ><b><i>$rowmod4[cant4]</i></b></font></td>
									<td><font face=Verdana size=2 ><b><i>$rowmod3[cant3]</i></b></font></td>									    
                                                                        <td><font face=Verdana size=2 ><b><i>$rowmodCan[cantCan]</i></b></font></td>
									<td align=center ><a href='./informes/pagos.php?cod=$row2[idevento]' ><img src='./img/excel.png' width=30 /></a></td>
								</tr>
							";
						
						
					echo"</tbody>
					</table>
				</td></tr>";
				}
				
				echo "
				</tr>";
				
				
			
			}
			$numr-=1;
		}
		
		?>
		</table>
		<table width="100%" id="secun" style="display:none" >
			<tr bgcolor="gray" >
				<td><font face="Verdana" size="3" ><b><i>ID Modulo</i></b></font></td>
				<td><font face="Verdana" size="3" ><b><i>Modulo</i></b></font></td>
				<td><font face="Verdana" size="3" ><b><i>Fecha Modulo</i></b></font></td>
				<td><font face="Verdana" size="3" ><b><i>Inscripciones</i></b></font></td>
				<td><font face="Verdana" size="3" ><b><i>Ver</i></b></font></td>
			</tr>
		</table>
		
		
				