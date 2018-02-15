<?php
/*
$dbh = mysql_connect("localhost", "root", "Ccas1992");
$db = mysql_select_db("promo");
*/
include("../class.conexion.php");  
 $db = new conn();

session_start(); 
 
?>

  <script>
	$(document).ready(function(){
		
            $(".secun thead tr").css({
            "background":"#5cb85c",
            "color":"#fff"
        });
            
		
	});
  
  </script>
  
  <style>
      .head tr{
            background: #337ab7;
            color: #fff;
        }
        
     
        
    #ppal  tr:nth-child(even) {background: #f1f1f1}
    #ppal tr:nth-child(odd) {background: silver}
    
    .secun thead tr{
            background: #337ab7;
            color: #fff;
        }
    
    .wrap {
        width: 100%;
    }

.wrap table {
    width: 100%;
    table-layout: fixed;
}


.inner_table {
    height: 500px;
    overflow-y: auto;
}


  </style>
<div class="wrap">
    <table class="head" >
        <tr>
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
    </table>
    <div class="inner_table">
        <table id="ppal" >
		<?php
		$estado = $_GET['est'];
		$ano = $_GET['year'];
		$sql2=$db->consulta("select * from evento where estado='$estado' and year(fec_event)=$ano order by idevento  ;");
		$numr=$db->num_rows($sql2);
		
		
		while($row2=$db->fetch_array($sql2)){
                    
                    $resEmp = $db->consulta("SELECT ea.cedula, ea.e_asistio 
                                            FROM asistentes a inner join event_asist ea 
                                            WHERE a.cedula = ea.cedula
                                            AND ea.idevent=$row2[idevento] ");

                    $contInscrip = 0;
                    $contPendientes = 0;
                    $contConfirmados = 0;
                    $contCancelados = 0;
                                        while($datatmp = $db->fetch_array($resEmp)) {
                                           switch ($datatmp['e_asistio']) {
                                                case 0:
                                                    $contPendientes++;
                                                    $estado='Pendiente';
                                                    break;
                                                case 1:
                                                    $contConfirmados++;
                                                    $estado='Confirmado';
                                                    break;
                                                case 3:
                                                    $contCancelados++;
                                                    $estado='Cancelado';
                                                    break;
                                            }
                                            
                                            $contInscrip++;
                                        }

			echo "<tr>
				<td><font face=Verdana size=2 ><b><i>$row2[idevento]</i></b></font></td>
				<td><font face=Verdana size=2 ><b><i>$row2[nom_evento]</i></b></font></td>
				<td><font face=Verdana size=2 ><b><i>$row2[lugar]</i></b></font></td>
				<td><font face=Verdana size=2 ><b><i>$row2[fec_event]</i></b></font></td>
				<td><font face=Verdana size=2 ><b><i>$row2[hora]</i></b></font></td>
				<td><font face=Verdana size=2 ><b><i>$contInscrip</i></b></font></td>
                                <td><font face=Verdana size=2 ><b><i>$contPendientes</i></b></font></td>
				<td><font face=Verdana size=2 ><b><i>$contConfirmados</i></b></font></td>
                                <td><font face=Verdana size=2 ><b><i>$contCancelados</i></b></font></td>
				
				";
                    if( $row2['modulos'] == 'SI' ){
						if($_SESSION['perfil'] != 2){
							echo "<td><a href=./informes/informe.php?cod=$row2[idevento] ><img src='./img/excel.png' width=30 /></a></td>";
						}	
			$sqlmod = $db->consulta("select * from modulos where idevento=$row2[idevento] ");
			$numod = $db->num_rows($sqlmod);
			if( $numod > 0){
                            echo "<tr align=center ><td>&nbsp;</td><td colspan=8 >
				<table width=80% align=center class='secun'  >
                                    <thead>
                                        <tr>
                                            <th><b><i>ID Modulo</i></b></th>
                                            <th><b><i>Modulo</i></b></th>
                                            <th><b><i>Fecha Modulo</i></b></th>
                                            <th><b><i>Inscripciones</i></b></th>
                                            <th><b><i>Pendientes</i></b></th>
                                            <th><b><i>Confirmados</i></b></th>
                                            <th><b><i>Cancelados</i></b></th>
                                            <th><b><i>Ver</i></b></th>
                                        </tr>
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
							
				echo"<tr align=center >
					<td><font face=Verdana size=2 ><b><i>$rowmod[idmod]</i></b></font></td>
					<td><font face=Verdana size=2 ><b><i>$rowmod[modulo]</i></b></font></td>
					<td><font face=Verdana size=2 ><b><i>$rowmod[fec_mod]</i></b></font></td>
					<td><font face=Verdana size=2 ><b><i>$rowmod2[cant2]</i></b></font></td>
					<td><font face=Verdana size=2 ><b><i>$rowmod0[cant0]</i></b></font></td>
                                        <td><font face=Verdana size=2 ><b><i>$rowmod3[cant3]</i></b></font></td>    
                                        <td><font face=Verdana size=2 ><b><i>$rowmodCan[cantCan]</i></b></font></td>";
				if($_SESSION['perfil'] != 2){						
					echo"<td align=center ><a href='./informes/ins_modulos.php?cod=$rowmod[idmod]' ><img src='./img/excel.png' width=30 /></a></td>";
				}
				
                                    echo"</tr>";
                            }
						
                            echo"</tbody></table></td><td>&nbsp;</td></tr>";
			}
                    }else{
                        $tdIcono="<td>";
			if($_SESSION['perfil'] != 2){			
                            $tdIcono.="<a href=./informes/inscrip_excel.php?cod=$row2[idevento] ><img src='./img/excel.png' width=30 /></a>";

                            if($row2['tipo_evento']==1){
                                $tdIcono.="<a href='./informes/pagos.php?cod=$row2[idevento]' ><img src='./img/excel.png' width=30 /></a><a href='./maestro/confor3.php?cod=$row2[idevento]&invitado=1' target='_blank' ><img src='./img/edit_user.png' width=30 /></a>";
                            }
			}
                        $tdIcono.="</td>";
                        echo $tdIcono;
                    }
                    if($row2['pago']==1){

                        $resEmp = $db->consulta("SELECT ea.e_asistio,ev.nom_evento 'EVENTO',e.nit 'NIT',e.rsocial 'EMPRESA',a.cedula 'CEDULA',a.nombres 'NOMBRES',a.apellidos 'APELLIDOS',a.tel 'TELEFONO',p.tarifa 'TARIFA',p.vlrpago 'VALOR PAGO',p.formapago 'FORMA DE PAGO',p.nrotran 'NUMERO DE TRANSACCION',p.fectrans 'FECHA DE TRANSACCION',p.nrorecibo 'Nro RECIBO',p.fecrecibo 'FECHA RECIBO',p.observa 'OBSERVACION',p.tarifa 
                                            FROM asistentes a inner join empresa e inner join pagos p inner join evento ev inner join event_asist ea 
                                            WHERE p.nit=e.nit
                                            AND p.cedula=a.cedula
                                            AND p.cedula=ea.cedula
                                            AND p.idevento=ea.idevent
                                            AND p.idevento=ev.idevento
                                            AND p.idevento=$row2[idevento]");

                        $contCancelados=$contInvitado=$contConfirma=$contPendi=0;        
                        while($datatmp = $db->fetch_array($resEmp)) {
                            if($datatmp['e_asistio']==3){
                                $contCancelados++;
                            }else{
                                if($datatmp['tarifa']=='Invitado'){
                                    $contInvitado++;
                                }else{
                                    if($datatmp['VALOR PAGO'] != 0){
                                       $contConfirma++; 
                                    }else{
                                        $contPendi++;
                                    }
                                }
                            } 

                        }

                        echo "<tr align=center >
                                <td>&nbsp;</td>
                                <td colspan=8 >
                                    <table width=100% align=center class='secun'  >
                                        <thead>
                                            <tr>
                                                <th><b><i>Pagos Pendientes</i></b></th>
                                                <th><b><i>Pagos Confirmados</i></b></th>
                                                <th><b><i>Invitados</i></b></th>
                                                <th><b><i>Cancelados</i></b></th>
                                                <th><b><i>Ver</i></b></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr align=center >
                                                <td><font face=Verdana size=2 ><b><i>$contPendi</i></b></font></td>
                                                <td><font face=Verdana size=2 ><b><i>$contConfirma</i></b></font></td>
                                                <td><font face=Verdana size=2 ><b><i>$contInvitado</i></b></font></td>									    
                                                <td><font face=Verdana size=2 ><b><i>$contCancelados</i></b></font></td>";
											if($_SESSION['perfil'] != 2){	
                                                echo"<td align=center ><a href='./informes/pagos.php?cod=$row2[idevento]' ><img src='./img/excel.png' width=30 /></a><a href='./maestro/confor3.php?cod=$row2[idevento]&invitado=1' target='_blank' ><img src='./img/edit_user.png' width=30 /></a></td>";
											}	
                                            echo"</tr>
                                        </tbody>
                                    </table>
				</td>
                                <td>&nbsp;</td>
                            </tr>";
                    }
				

			$numr-=1;
		}
		
		?>
        </table>
    </div>
</div>

		
		
				