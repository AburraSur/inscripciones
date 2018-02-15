<?php
require("./class.conexion.php");
require("./conexionSII.php");

$db = new conn();
$sii = new conexionsii();
$rowemp = $sii->consultasii("SELECT razonsocial, dircom, ctrafiliacion FROM mreg_est_inscritos where nit='1036602268' or numid='1036602268' ");
var_dump($rowemp);
$sqleve = $db->consulta("select * from evento where idevento=23 ");
$roweve = $db->fetch_array($sqleve);

$sqlnit = $db->consulta("select nit from event_asist where idevent=23 and cedula=1036622997 ");
$rownit = $db->fetch_array($sqlnit);


?>
<html>
<head>
<script src="./js/jquery.js"></script>
  <script src="./js/jquery-1.4.2.min.js"></script>
<script>
$(document).ready(function(){
$("#acp").click(function(){
	$.ajax({
		url: 'http://www.crm.ccas.co/PSGWSTestc.php',
		type: 'POST',
		data: {evento:'<?php echo "$roweve[nom_evento]"; ?>',lugar:'<?php echo $roweve['lugar']; ?>',fec:'<?php echo $roweve['fec_event']; ?>',nit:'<?php echo $rownit['nit']; ?>'},
		success: function (data) {
			var obj = eval('('+data+')');
			alert(data);
		}
		})
		return false;
});
});
</script>
</head>
<body>

<button id="acp" >acp</button>
</body>
</html>