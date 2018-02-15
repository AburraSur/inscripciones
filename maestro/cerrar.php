<head>
<title>Area Administrativa</title>
 <LINK HREF="../estilo/tagest.css" REL="stylesheet" TYPE="text/css">
<LINK HREF="../estilo/button.css" REL="stylesheet" TYPE="text/css">
<LINK href="../estilo/divestilo.css" rel="stylesheet" type="text/css">
<SCRIPT LANGUAGE="JavaScript" SRC="./calendar.js"></SCRIPT>
<script type="text/javascript"
src="../js/jquery.min.js"></script>
<script src="../js/jquery.js"></script>
  <script type="text/javascript" src="../js/jquery-validate.js"></script>
  <script src="../js/jquery-1.4.2.min.js"></script>
<script src="../js/jquery.blockUI-validate.js"></script>
<script type="text/javascript"> 
 


$(document).ready(function(){
	$("#select1").load('../js/eventos.php');
	$("#form1").sumbit(function(){
	
	
	$.ajax({
			url: "../insert/closed.php",
			type: "POST",
			data: $('#form1').serialize(),
			success: function ( data ){
			
				 var obj = eval( "(" + data + ")" );
			if(obj.enviar == 1){
								
			$.blockUI({ message: '<h3><img src=../img/check2.png />Evento Se Cerro Exitosamente.</h3>' });				
				setTimeout($.unblockUI, 2000); 
				
				
				
			}
			if(obj.enviar == 2){
			$.blockUI({ message: '<h3><img src=../img/bad.png /><br>Se Produjo un Error al Cerrar.</h3>' });
			setTimeout($.unblockUI, 3000); 
			
			
			}
			
			}
		})
	return false;
	});
		
	
  });
  
  



</script>
<style>
body{
background-attachment: fixed;

}

.shot{
 position:absolute;
 top:180;
 right:280;
 
}
</style>


</head>

	<body background="../img/bg2.jpg" >
	
		<table width="60%" height="60%" align="center">
		<tr>
			<td>
				<div> 
				<b class="spiffy"> 
				<b class="spiffy1"><b></b></b>
				<b class="spiffy2"><b></b></b>
				<b class="spiffy3"></b>
				<b class="spiffy4"></b>
				<b class="spiffy5"></b> 
				</b> <div class="spiffy_content">
	

<img src="../img/locked.png" />
		<font face="Verdana" size="6" ><b><i>CERRAR EVENTO</i></b></font>
		
		<br><br>
       
			
		  <form name="form1" id="form1" >
		  <fieldset><legend><i>Seleccione Evento</i></legend>
		  <center>
			<select name="closed" id="select1" ><option>Seleccione</option>
		
			</select>
		<br><br>
		<input type="image" src="../img/button-close.png" id="boton3" /></center>
		</fieldset>
		</form>
</div>
				<b class="spiffy"> 
				<b class="spiffy5"></b>
				<b class="spiffy4"></b>
				<b class="spiffy3"></b>
				<b class="spiffy2"><b></b></b>
				<b class="spiffy1"><b></b></b> 
				</b> 
				</div> 	
		
		
    




			
			</td>
		</tr>


		</table>
	