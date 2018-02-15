<?php
require("../class.conexion.php");

$db = new conn();

$idev = $_GET['idev'];

$sqlpay = $db->consulta("SELECT DISTINCT e.`nit` , e.`rsocial` , a.tel ,a.cedula , a.nombres,a.apellidos, p.`tarifa` 
FROM  `empresa` e
INNER JOIN asistentes a
INNER JOIN pagos p
INNER JOIN event_asist ea
WHERE p.nit = e.nit
AND p.cedula=ea.cedula
AND a.cedula=p.cedula
AND p.tarifa <> 'Invitado'
AND ea.e_asistio <> 3
AND p.idevento=ea.idevent
AND p.idevento =$idev 
ORDER BY e.`rsocial`ASC ");

echo "<script>
	$(document).ready(function(){
		$('table.cruises').css('background-color','#FFFFFF');
		$('table.cruises tr:even').css('background-color','silver');
		$('.paypal').click(function(){
		/*var id = $('#idev').attr('value');
		$.blockUI ({ message: '<form id=paypal	><img src=./img/close.png id=cls /><input type=text name=test /><button>Aceptar</button></form>',css: { top:  ($(window).height()-400)/2 + 'px',left: ($(window).width() - 800) /2 + 'px', width: '800px' }});
		$('#cls').css({'position' : 'absolute','top' : '5px','right' : '5px'}).click(function(){ $.blockUI({ fadeIn: 1000, timeout:   2000, onBlock: function() { $('#payform').each(function(){this.reset();});} });});*/
		
		
			var id = $(this).attr('id');
			$('.dis'+id).removeAttr('disabled');
		
		
		
		
	});
	
	$('.fecha').datepicker({
			//showOn: 'both',
			buttonImage: 'calendar.png',
			buttonImageOnly: true,
			changeYear: true,
			numberOfMonths: 1,
      
		});
	});
	</script>
	
	<style>
		.std{
			width: 0 auto;
margin: 0 auto;
background: silver;
border: 1px solid silver;
padding: 10px 0;
float: left;

		}
	* { padding: 0; margin: 0; }
  table.cruises { 
    font-family: verdana, arial, helvetica, sans-serif;
    font-size: 11px;
    cellspacing: 0; 
    border-collapse: collapse; 
    width: 535px;    
    }
  table.cruises td { 
    border-left: 1px solid #999; 
    border-top: 1px solid #999;  
    padding: 2px 4px;
    }
  table.cruises tr:first-child td {
    border-top: none;
  }
  table.cruises th { 
    border-left: 1px solid #999; 
    padding: 2px 4px;
    background: #6b6164;
    color: white;
    font-variant: small-caps;
    }
  
  
  div.scrollableContainer { 
    position: relative; 
    width: 95%; 
    padding-top: 2em; 
    margin: 40px;    
    border: 1px solid #999;
    background: #6b6164;
    left: 5px;
    }
  div.scrollingArea { 
    height: 240px; 
    overflow: auto; 
    }

  table.scrollable thead tr {
    left: -1px; top: 0;
    position: absolute;
	width: 95%;
    }


  table.cruises .short   div { width: 80px; text-align:center; }
  table.cruises .long   div { width: 100px;  }
  table.cruises .edit   div { width: 45px;  }
  


	</style>
	<a href='./informes/excelpagos.php?idev=$idev' ><img src=./img/informe.png  ></a>
	<br>
	<div class=scrollableContainer >
  <div class=scrollingArea >
	<table class='cruises scrollable' >
	<thead>
  			<tr>
  	      <th class=short ><div>NIT</div></th>
  	      <th class=long ><div>Razon Social</div></th>
  	      <th class=long ><div>Telefono</div></th>
  	      <th class=short ><div>Tarifa</div></th>
  	      <th class=long ><div>Asistente</div></th>
		  <th class=short ><div>Vlor Pago</div></th>
		  <th class=long ><div>Forma Pago</div></th>
		  <th class=short ><div>Nro. Transaccion</div></th>
                  <th class=short ><div>Nro. Operacion</div></th>
		  <th class=long ><div>Fec Transaccion</div></th>
		  <th class=short ><div>Nro. Recibo</div></th>
		  <th class=long ><div>Fec Recibo</div></th>
		  <th class=long ><div>Observacion</div></th>
		  <th class=edit ><div>Editar</div></th>
  			</tr>
  		</thead>
	<tbody class=scrollContent >
";
$i=1;
while( $row = $db->fetch_array($sqlpay)){
	echo "
	<tr>
		<td class=short ><div>$row[nit]&nbsp;</div></td>
		<td class=long ><div>$row[rsocial]</div></td>
		<td class=long ><div>$row[tel]</div></td>
		<td class=short ><div>$row[tarifa]</div></td>
		<td class=long ><div>$row[nombres] $row[apellidos]</div></td>
		";
		
		$sqlas = $db->consulta("select count(cedula) asist from event_asist where idevent=$idev and nit='$row[nit]'");
		$rowas = $db->fetch_array($sqlas);
		
		//echo "<td>$rowas[asist]</td>";
		
		$sql =  $db->consulta("select * from pagos where idevento=$idev and nit='$row[nit]' and cedula='$row[cedula]' and tarifa<>'Invitado' ");
		$nump = $db->num_rows($sql);
		
		if( $nump > 0){
		
		while( $rowe = $db->fetch_array($sql)){
			echo "
				<td class=short ><div><input type=text name=vlrpago$i value='$rowe[vlrpago]' class=dis$i disabled size=8 /><input type=hidden name=idpay$i value=$rowe[idpago] class=dis$i disabled /></div></td>
				<td class=long ><div><input type=text name=formapago$i value='$rowe[formapago]' class=dis$i disabled size=12 /></div></td>
				<td class=short ><div><input type=text name=nrotran$i value='$rowe[nrotran]' class=dis$i disabled size=6 /></div></td>
				<td class=short ><div><input type=text name=numeroOperacion$i value='$rowe[numeroOperacion]' class=dis$i disabled size=6 /></div></td>
                                <td class=long ><div><input type=text name=fectrans$i value='$rowe[fectrans]' class='dis$i fecha' disabled size=10 /></div></td>
				<td class=short ><div><input type=text name=nrorecibo$i value='$rowe[nrorecibo]' class=dis$i disabled size=6 /></div></td>
				<td class=long ><div><input type=text name=fecrecibo$i value='$rowe[fecrecibo]' class='dis$i fecha' disabled size=10 /></div></td>
				<td class=long ><div><input type=text name=observa$i value='$rowe[observa]' class=dis$i disabled size=10 /></div></td>";
		}
		}else{
		echo "
				<td class=short ><div><input type=text name='vlrpago$i' class=dis$i disabled size=8 /></div></td>
				<td class=long ><div><input type=text name='formapago$i' class=dis$i disabled size=12 /></div></td>
				<td class=short ><div><input type=text name=nrotran$i class=dis$i disabled size=6 /></div></td>
				<td class=long ><input type=text name=fectrans$i class='dis$i fecha' disabled size=10 /></div></td>
				<td class=short ><input type=text name=nrorecibo$i class=dis$i disabled size=6 /></div></td>
				<td class=long ><input type=text name=fecrecibo$i class='dis$i fecha' disabled size=10 /></div></td>
				<td class=long ><input type=text name=observa$i  class=dis$i disabled size=15 />
				<input type=hidden name=nit$i value='".$row['nit']."' class=dis$i   />
				<input type=hidden name=cedula$i value='".$row['cedula']."' class=dis$i   />
				<input type=hidden name=idevento$i value=$idev /></div></td>";
		
		}
		
		if( $row['nit'] != null ){
			echo "<td class=edit ><img src=./img/edit.png class=paypal id=$i value=$row[nit] /></div></td>";
		}else{
			echo "<td class=edit ><img src=./img/edit.png class=paypal id=$i value=0 /></div></td>";
		}
		
	echo"</tr>
	";
	$i++;
}

echo "</tbody></table></div></div><input type=hidden name=ctrlidev value=$i /><input type=hidden name=idev id=idev value=$idev /><button>Aceptar</button>";

?>