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
				<td><font face="Verdana" size="3" ><b><i>Confirmados</i></b></font></td>
				<td><font face="Verdana" size="3" ><b><i>Ver</i></b></font></td>
			</tr>
		<?php
		$estado = $_GET['est'];
		$ano = $_GET['year'];
		$sql2=$db->consulta("select * from evento where estado='$estado' and year(fec_event)=$ano order by idevento  ;");
		$numr=$db->num_rows($sql2);
		
		
		while($row2=$db->fetch_array($sql2)){
		$sql3=$db->consulta("select count(cedula) as 'CANT' from event_asist where e_asistio<>3 and idevent=$row2[idevento] ");
		$sql4=$db->consulta("select count(cedula) as 'CANT' from event_asist where idevent=$row2[idevento] and e_asistio=1 ");
		$row=$db->fetch_array($sql3);
		$rowa=$db->fetch_array($sql4);
		if($numr%2 == 1){
		
			echo "<tr bgcolor=silver align=center >
				<td><font face=Verdana size=2 ><b><i>$row2[idevento]</i></b></font></td>
				<td><font face=Verdana size=2 ><b><i>$row2[nom_evento]</i></b></font></td>
				<td><font face=Verdana size=2 ><b><i>$row2[lugar]</i></b></font></td>
				<td><font face=Verdana size=2 ><b><i>$row2[fec_event]</i></b></font></td>
				<td><font face=Verdana size=2 ><b><i>$row2[hora]</i></b></font></td>
				<td><font face=Verdana size=2 ><b><i>$row[CANT]</i></b></font></td>
				<td><font face=Verdana size=2 ><b><i>$rowa[CANT]</i></b></font></td>
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
							<th><b><i>Confirmados</i></b></th>
							<th><b><i>Ver</i></b></th>
						</thead>
						<tbody>";
						
						
						while($rowmod = $db->fetch_array($sqlmod)){
						
							$sqlmod2 = $db->consulta("select count(cedula) as 'cant2' from mod_asis where idmod=$rowmod[idmod] ");
							$rowmod2 = $db->fetch_array($sqlmod2);
							$sqlmod3 = $db->consulta("select count(cedula) as 'cant3' from mod_asis where idmod=$rowmod[idmod] and asistio=1 ");
							$rowmod3 = $db->fetch_array($sqlmod3);
							echo"
								<tr align=center >
									<td><font face=Verdana size=2 ><b><i>$rowmod[idmod]</i></b></font></td>
									<td><font face=Verdana size=2 ><b><i>$rowmod[modulo]</i></b></font></td>
									<td><font face=Verdana size=2 ><b><i>$rowmod[fec_mod]</i></b></font></td>
									<td><font face=Verdana size=2 ><b><i>$rowmod2[cant2]</i></b></font></td>
									<td><font face=Verdana size=2 ><b><i>$rowmod3[cant3]</i></b></font></td>
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
					$sqlmod2 = $db->consulta("select count(p.cedula) as 'cant2' from pagos p inner join event_asist ea inner join asistentes a where a.cedula=p.cedula and ea.cedula=p.cedula and p.tarifa<>'Invitado' and ea.e_asistio<>3 and p.vlrpago=0 and p.idevento=$row2[idevento] and ea.idevent=$row2[idevento] ");
							$rowmod2 = $db->fetch_array($sqlmod2);
							$sqlmod3 = $db->consulta("select count(p.cedula) as 'cant3' from pagos p inner join asistentes a where p.cedula=a.cedula and p.tarifa='Invitado' and idevento=$row2[idevento] ");
							$rowmod3 = $db->fetch_array($sqlmod3);
							$sqlmod4 = $db->consulta("select count(p.cedula) as 'cant4' from pagos p inner join asistentes a where p.cedula=a.cedula and p.vlrpago>0 and idevento=$row2[idevento] ");
							$rowmod4 = $db->fetch_array($sqlmod4);
							
					echo "<tr align=center ><td colspan=6 >
					<table width=60% align=center class=secun  >
						<thead bgcolor=amber >
							<th><b><i>Pagos Pendientes</i></b></th>
							<th><b><i>Pagos Confirmados</i></b></th>
							<th><b><i>Invitados</i></b></th>
							<th><b><i>Ver</i></b></th>
						</thead>
						<tbody>";
						
					
						
							
							
							echo"
								<tr align=center >
									<td><font face=Verdana size=2 ><b><i>$rowmod2[cant2]</i></b></font></td>
									<td><font face=Verdana size=2 ><b><i>$rowmod4[cant4]</i></b></font></td>
									<td><font face=Verdana size=2 ><b><i>$rowmod3[cant3]</i></b></font></td>
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
				<td><font face=Verdana size=2 ><b><i>$rowa[CANT]</i></b></font></td>
				
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
							<th><b><i>Confirmados</i></b></th>
							<th><b><i>Ver</i></b></th>
						</thead>
						<tbody>";
						
						$sqlmod = $db->consulta("select * from modulos where idevento=$row2[idevento] ");
						while($rowmod = $db->fetch_array($sqlmod)){
						
							$sqlmod2 = $db->consulta("select count(cedula) as 'cant2' from mod_asis where idmod=$rowmod[idmod] ");
							$rowmod2 = $db->fetch_array($sqlmod2);
							$sqlmod3 = $db->consulta("select count(cedula) as 'cant3' from mod_asis where idmod=$rowmod[idmod] and asistio=1 ");
							$rowmod3 = $db->fetch_array($sqlmod3);
							
							echo"
								<tr align=center >
									<td><font face=Verdana size=2 ><b><i>$rowmod[idmod]</i></b></font></td>
									<td><font face=Verdana size=2 ><b><i>$rowmod[modulo]</i></b></font></td>
									<td><font face=Verdana size=2 ><b><i>$rowmod[fec_mod]</i></b></font></td>
									<td><font face=Verdana size=2 ><b><i>$rowmod2[cant2]</i></b></font></td>
									<td><font face=Verdana size=2 ><b><i>$rowmod3[cant3]</i></b></font></td>
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
					$sqlmod2 = $db->consulta("select count(p.cedula) as 'cant2' from pagos p inner join event_asist ea inner join asistentes a where a.cedula=p.cedula and ea.cedula=p.cedula and p.tarifa<>'Invitado' and ea.e_asistio<>3 and p.vlrpago=0 and p.idevento=$row2[idevento] and ea.idevent=$row2[idevento] ");
							$rowmod2 = $db->fetch_array($sqlmod2);
							$sqlmod3 = $db->consulta("select count(p.cedula) as 'cant3' from pagos p inner join asistentes a where p.cedula=a.cedula and p.tarifa='Invitado' and idevento=$row2[idevento] ");
							$rowmod3 = $db->fetch_array($sqlmod3);
							$sqlmod4 = $db->consulta("select count(p.cedula) as 'cant4' from pagos p inner join asistentes a where p.cedula=a.cedula and p.vlrpago>0 and idevento=$row2[idevento] ");
							$rowmod4 = $db->fetch_array($sqlmod4);
					echo "<tr align=center ><td colspan=6 >
					<table width=60% align=center class=secun  >
						<thead bgcolor=amber >
							<th><b><i>Pagos Pendientes</i></b></th>
							<th><b><i>Pagos Confirmados</i></b></th>
							<th><b><i>Invitados</i></b></th>
							<th><b><i>Ver</i></b></th>
						</thead>
						<tbody>";
						
					
						
							
							
							echo"
								<tr align=center >
									<td><font face=Verdana size=2 ><b><i>$rowmod2[cant2]</i></b></font></td>
									<td><font face=Verdana size=2 ><b><i>$rowmod4[cant4]</i></b></font></td>
									<td><font face=Verdana size=2 ><b><i>$rowmod3[cant3]</i></b></font></td>									
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
		
		
				