<?php
include("./dompdf/dompdf_config.inc.php");

$html = '
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-15">
<style>

html{
	margin-top: 8px;
}
.d { 
  width: 715px; 
  height: 180px; 
  margin: 5pt;
  border-radius: 1em 1em 1em 1em;
   border: 2px solid;
	
}

.d2 { 
  width: 711px; 
  height: 350px; 
  margin: 5pt;
  border-radius: 1em 1em 1em 1em;
   border: 1px solid;
	
}
#user{
	position: absolute;
	top: 50px;
	left: 726px;
	width:30px;
	height: 130px;
	background: #c0c0c0;
}

#descrip{
	position: absolute;
	top: 260px;
	left: 726px;
	width:30px;
	height: 130px;
	background: #c0c0c0;
}
.Rotate-90
{
  -webkit-transform: rotate(90deg);
  -moz-transform: rotate(90deg);
  -ms-transform: rotate(90deg);
  -o-transform: rotate(90deg);
  transform: rotate(90deg);
 
  -webkit-transform-origin: 50% 50%;
  -moz-transform-origin: 50% 50%;
  -ms-transform-origin: 50% 50%;
  -o-transform-origin: 50% 50%;
  transform-origin: 50% 50%;
 
  font-size: 18px;
  width: 50px;
  position: relative;
  top: 40px;
  left: -10px;
}

</style>
</head>

<body>
<div id="user" >
<div class="Rotate-90">Usuario</div>
</div>
<div id="descrip" >
<div class="Rotate-90">Detalle</div>
</div>
<div class="d" > 




	<table cellpadding="6" cellspacing="6" align="center" >
	<tr>
		<td><img src="../images/tviorgijpg.jpg" /></td>
		<td align="right" >Nro. de Factura: 0001</td>
	</tr>
	<tr>
		<td align="left" ><font size="2" >NOMBRE: Roberto Alejandro Restrepo Rivera</font></td>
		<td><font size="2" >BARRIO: BELLO</font></td>
	</tr>
	<tr>
		<td align="left" ><font size="2" >DIRECCIÓN: CRA 50 # 78-16</font></td>
		<td></td>
	</tr>
</table>
</div>

<table border="1"  cellpadding="2" cellspacing="2" align="center" width="710px" >
 <tr nobr="true">
  <th width="20%">TRANSACCION</th><th width="40%">DESCRIPCION</th><th width="10%">%IVA</th><th width="10%">VALOR</th><th width="10%">VALOR IVA</th><th width="10%">TOTAL</th>
 </tr>
 <tr>
  <td aling="center" >
	<table aling="center" >
		<tr>
			<td width="100%" aling="center" >Trans1</td>

		</tr>
		<tr>
			<td width="100%" aling="center" >Trans2</td>

		</tr>
		<tr>
			<td width="100%" aling="center" >Trans3</td>

		</tr>
		<tr>
			<td width="100%" aling="center" >Trans4</td>

		</tr>
	</table>
  </td>
 <td aling="center" >
	<table aling="center" >
		<tr>
			
			<td width="100%" aling="center" >Descrip1</td>
		</tr>
		<tr>
			
			<td width="100%" aling="center" >Descrip2</td>
		</tr>
		<tr>
			
			<td width="100%" aling="center" >Descrip3</td>
		</tr>
		<tr>
			
			<td width="100%" aling="center" >Descrip4</td>
		</tr>
	</table>
  </td>
  <td>
  	<table>
		<tr>
			<td>16</td>
			
		</tr>
		<tr>
			<td>10</td>
			
		</tr>
		<tr>
			<td>16</td>
			
		</tr>
		<tr>
			<td>16</td>
			
		</tr>
	</table>
  </td>
  <td>
	<table>
		<tr>
			<td>100.000</td>
			
		</tr>
		<tr>
			<td>100.000</td>
			
		</tr>
		<tr>
			<td>100.000</td>
			
		</tr>
		<tr>
			<td>100.000</td>
			
		</tr>
	</table>
  </td>
  <td>
	<table>
		<tr>
			<td>16.000</td>
			
		</tr>
		<tr>
			<td>10.000</td>
			
		</tr>
		<tr>
			<td>16.000</td>
			
		</tr>
		<tr>
			<td>16.000</td>
			
		</tr>
	</table>
  </td>
  <td>
	<table>
		<tr>
			<td>116.000</td>
			
		</tr>
		<tr>
			<td>110.000</td>
			
		</tr>
		<tr>
			<td>116.000</td>
			
		</tr>
		<tr>
			<td>116.000</td>
			
		</tr>
	</table>
  </td>
 </tr>
 <tr>
  <td colspan="2" align="left" >
	<font size="2" >RESOLUCIÓN AUTORIZADA DIAN N° 40000176120 DEL 2013/06/17 DEL 101000 AL 401000. ESTA FACTURA DE VENTA SE ASIMILA EN TODOS SUS EFECTOS A UNA LETRA DE CAMBIO SEGÚN EL ARTÍCULO 774 DEL CÓDIGO DE COMERCIO.</font>
  </td>
  <td>TOTALES</td>
  <td>400.000</td>
  <td>58.000</td>
  <td>458.000</td>
 </tr>
 <tr>
  <td colspan="3" align="left" >
	
  </td>
  <td colspan="2" align="left" >
	<table>
		<tr><td><font size="1" >SALDO ANTERIOR SIN PAGAR</font></td></tr>
		<tr><td><font size="3" >TOTAL A PAGAR</font></td></tr>
	</table>
  </td>
 
  <td>
	<table>
		<tr><td>0</td></tr>
		<tr><td>458.000</td></tr>
	</table>
</td>
 </tr>
</table>

</body> </html>
'; 


$dompdf = new DOMPDF(); 
$dompdf->load_html(utf8_decode($html)); 
$dompdf->render(); 

$dompdf->stream("desired_name.pdf",array('Attachment'=>0)); 

//echo $html;
?> 
