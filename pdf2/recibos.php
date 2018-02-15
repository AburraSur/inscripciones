<?php
include("./dompdf/dompdf_config.inc.php");
require("../class.conexion.php");

$db = new conn();

$idrec = $_GET['num'];
$sqlrec = $db->consulta("select * from recibos r inner join beneficiario b where r.id_benef=b.id_benef and r.id_recibo=$idrec ");
$rowrec = $db->fetch_array($sqlrec);
$fecha = explode("-" , $rowrec['fec_recibo']);
if($rowrec['id_recibo'] == null){
	echo "<font size=3 ><b>EL RECIBO Nro.$idrec NO ESTA REGISTRADO EN EL SISTEMA</b></font>";
}else{
$html = '
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-15">
<style>

html{
	margin-top: 10px;
}
.d { 
  width: 715px; 
  height: 90px; 
  border-radius: 1em 1em 1em 1em;
   border: 2px solid;
	
}


.downn{
	float: left;
	border-radius: 1em 1em 1em 1em;
  	border: 2px solid;
	width: 222px; 
	height: 100px;
}

.downn2{
	float: left;
	border-radius: 1em 1em 1em 1em;
  	border: 2px solid;
	width: 232px; 
	height: 45px;
	text-align: center;
}

.concepto { 
  width: 699px; 
  height: 120px; 
  padding: 5pt;
  border-radius: 1em 1em 1em 1em;
  border: 2px solid;
	
}

.paguese { 
  width: 699px; 
  height: 35px; 
  padding: 5pt;
  border-radius: 1em 1em 1em 1em;
  border: 2px solid;
	
}

.anulado{
	position: absolute;
	top: 150px;
	left: 180px;
}


</style>
</head>

<body>';

if($rowrec['est_recibo'] == 3){
	$html.= '<img src="../images/anulado.png" class="anulado" />';
}else{
	$html.= '<img src="../images/cancelado.png" class="anulado" />';
}

$html.= '<div class="d" > 
	<table cellpadding="6" align="center" width="100%" >
	<tr>
		<td valign="top" ><img src="../images/ccas.png" width=210 /></td>
		<td align=center ><font size="4" ><b>COMPROBANTE DE PAGO<br>CAJA MENOR<br>Nro. '.$idrec.' </b></font><br><br></td>
	</tr>
</table>
</div>
<table>
	<tr>
		<td>
			<div class="downn2" ><font size="3" ><b>NIT/C.C.</b></font><br><font size="2" >'.$rowrec['id_benef'].'</font></div>
		</td>
		<td>
			<div class="downn2" >
				<table width=100% align=center >
					<thead>
						<tr>
							<th><font size="2" >D&iacute;a</font></th>
							<th><font size="2" >Mes</font></th>
							<th><font size="2" >A&ntilde;o</font></th>
						</tr>
					</thead>
						<tr>
							<td align=center ><font size="2" >'.$fecha[2].'</font></td>
							<td align=center ><font size="2" >'.$fecha[1].'</font></td>
							<td align=center ><font size="2" >'.$fecha[0].'</font></td>
						</tr>
				</table>
			</div>
		</td>
		<td>
			<div class="downn2" ><font size="3" ><b>LA SUMA DE:</b></font><br><font size="2" >$ '.number_format($rowrec['vlr_recibo']).'</font></div>
		</td>
	</tr>
</table>
<div class="paguese" >
<font size="2" ><b>P&Aacute;GUESE A LA ORDEN DE:</b><br>'.utf8_encode($rowrec['name_benef']).'</font>
</div>
<div class="concepto" >
<font size="2" ><b>POR CONCEPTO DE:</b><br><br>'.utf8_encode($rowrec['concepto']).'</font>
<p></p>

</div>
<table>
<tr>
<td>
<div class="downn" >
<table cellpadding="6" align="center" width="100%" >
	<tr>
		<td align=center ><font size="2" ><b>PARA USO EXCLUSIVO DE CONTABILIDAD</b></font><br><br></td>
	</tr>
	<tr>
		<td align=center ><font size="1" >CTA Nro. '.$rowrec['id_cta'].'</font></td>
	</tr>
</table>
</div>
</td>
<td><div class="downn" >
<table cellpadding="6" align="center" width="100%" >
	<tr>
		<td align=center ><font size="2" ><b>APROBADO POR<b></font>
		</td>
	</tr>
</table>
</div>
</td>
<td><div class="downn" >
<table cellpadding="6" align="center" width="100%" >
	<tr>
		<td align=center ><font size="2" ><b>RECIBI<b><br><br><br></font>
		</td>
	</tr>
	<tr>
		<td align=center ><font size="1" >C.C._______________________</font></td>
	</tr>
</table>
</div>
</td></tr></table>
</body> </html>
'; 


$dompdf = new DOMPDF(); 
$dompdf->load_html(utf8_decode($html)); 
$dompdf->render(); 

$dompdf->stream("desired_name.pdf",array('Attachment'=>0)); 
}
?> 
