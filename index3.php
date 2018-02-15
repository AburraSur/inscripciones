<?php
//include('conexion.php');
	function getBrowser() 
{ 
    $u_agent = $_SERVER['HTTP_USER_AGENT']; 
    $bname = 'Unknown';
  
    if(preg_match('/MSIE/i',$u_agent) && !preg_match('/Opera/i',$u_agent)) 
    { 
        $bname = 'Internet Explorer'; 
        $ub = "MSIE"; 
    } 
    elseif(preg_match('/Firefox/i',$u_agent)) 
    { 
        $bname = 'Mozilla Firefox'; 
        $ub = "Firefox"; 
    } 
    elseif(preg_match('/Chrome/i',$u_agent)) 
    { 
        $bname = 'Google Chrome'; 
        $ub = "Chrome"; 
    } 
    elseif(preg_match('/Safari/i',$u_agent)) 
    { 
        $bname = 'Apple Safari'; 
        $ub = "Safari"; 
    } 
    elseif(preg_match('/Opera/i',$u_agent)) 
    { 
        $bname = 'Opera'; 
        $ub = "Opera"; 
    } 
    elseif(preg_match('/Netscape/i',$u_agent)) 
    { 
        $bname = 'Netscape'; 
        $ub = "Netscape"; 
    } 
        
    return array(
        'userAgent' => $u_agent,
        'name'      => $bname,
        'version'   => $version,
        'platform'  => $platform,
        'pattern'    => $pattern
    );
} 

$ua=getBrowser();
$yourbrowser= $ua['name'];

if($yourbrowser == 'Internet Explorer'){
$mensaje .= '<script name="accion">alert("Estas Utilizando Internet Explorer, Este navegador no Garantiza el Correcto Funcionamiento de este Aplicativo, te Recomendamos utilizar Mozilla FireFox.");
		
 </script>';
 
 echo $mensaje;


}
echo "
<html>
<head><title>Bienvenido</title>
 <LINK href=\"./estilo/divestilo.css\" rel=\"stylesheet\" type=\"text/css\">
<LINK href=\"./estilo/button.css\" rel=\"stylesheet\" type=\"text/css\">
</head>

	<body background=\"./img/bg2.jpg\" >
		<table width=\"50%\" height=100% align=\"center\">
		<tr>
			<td>
				<div> 
				<b class=\"spiffy\"> 
				<b class=\"spiffy1\"><b></b></b>
				<b class=\"spiffy2\"><b></b></b>
				<b class=\"spiffy3\"></b>
				<b class=\"spiffy4\"></b>
				<b class=\"spiffy5\"></b> 
				</b> <div class=\"spiffy_content\">
				<fieldset>
				<table width=\"70%\" align=\"center\">
					<tr>
			<td>
			<center><font face=\"Verdana\" size=\"6\" color=\"#475B70\" align=\"center\"><i>Sitio en Mantenimiento<br>Intentelo Mas Tarde</i></font><br>
			<img src=./img/work.png />
			<br><br>
			<font face=\"Verdana\" size=\"6\" color=\"#475B70\" align=\"center\"><i>Comuniquese con el Administrador del Sitio</i></font>
			
			
			
</td>
		</tr>
				</table>

				</div>
				<b class=\"spiffy\"> 
				<b class=\"spiffy5\"></b>
				<b class=\"spiffy4\"></b>
				<b class=\"spiffy3\"></b>
				<b class=\"spiffy2\"><b></b></b>
				<b class=\"spiffy1\"><b></b></b> 
				</b> 
				</div> 
			</td>
		</tr>


		</table>

	</body>

</html>";


/*
echo "
<html>
<head>
 <title>LOGIN PEDIDOS</title>
 
 
 <style type=\"text/css\"> 

h1 {font-size: 3em; margin: 20px 0;}
.container {width: 500px; margin: 10px auto;}
ul.tabs {
	margin: 0;
	padding: 0;
	float: left;
	list-style: none;
	height: 32px;
	border-bottom: 1px solid #999;
	border-left: 1px solid #999;
	width: 100%;
}
ul.tabs li {
	float: left;
	margin: 0;
	padding: 0;
	height: 31px;
	line-height: 31px;
	border: 1px solid #999;
	border-left: none;
	margin-bottom: -1px;
	background: #e0e0e0;
	overflow: hidden;
	position: relative;
}
ul.tabs li a {
	text-decoration: none;
	color: #000;
	display: block;
	font-size: 1.2em;
	padding: 0 20px;
	border: 1px solid #fff;
	outline: none;
}
ul.tabs li a:hover {
	background: #ccc;
}	
html ul.tabs li.active, html ul.tabs li.active a:hover  {
	background: #fff;
	border-bottom: 1px solid #fff;
}
.tab_container {
	border: 1px solid #999;
	border-top: none;
	clear: both;
	float: left; 
	width: 100%;
	background: #fff;
	-moz-border-radius-bottomright: 5px;
	-khtml-border-radius-bottomright: 5px;
	-webkit-border-bottom-right-radius: 5px;
	-moz-border-radius-bottomleft: 5px;
	-khtml-border-radius-bottomleft: 5px;
	-webkit-border-bottom-left-radius: 5px;
}
.tab_content {
	padding: 20px;
	font-size: 1.2em;
}
.tab_content h2 {
	font-weight: normal;
	padding-bottom: 10px;
	border-bottom: 1px ;
	font-size: 1.8em;
}
.tab_content h3 a{
	color: #254588;
}
.tab_content img {
	float: left;
	margin: 0 20px 20px 0;
	border: 1px solid #ddd;
	padding: 5px;
}


label { width: 10em; float: left; }
label.error { float: none; color: red; padding-left: .5em; vertical-align: top; }
p { clear: both; }

em { font-weight: bold; padding-right: 1em; vertical-align: top; }
#ed{background-color: #FFFFDD; }

</style>
<script type=\"text/javascript\"
src=\"js/jquery.min.js\"></script>
<script type=\"text/javascript\"> 
 
$(document).ready(function() {
 
	//Default Action
	$(\".tab_content\").hide(); //Hide all content
	$(\"ul.tabs li:first\").addClass(\"active\").show(); //Activate first tab
	$(\".tab_content:first\").show(); //Show first tab content
	
	//On Click Event
	$(\"ul.tabs li\").click(function() {
		$(\"ul.tabs li\").removeClass(\"active\"); //Remove any \"active\" class
		$(this).addClass(\"active\"); //Add \"active\" class to selected tab
		$(\".tab_content\").hide(); //Hide all tab content
		var activeTab = $(this).find(\"a\").attr(\"href\"); //Find the rel attribute value to identify the active tab + content
		$(activeTab).fadeIn(); //Fade in the active content
		return false;
	});
 
});


</script>

  

</head>

	<body background=\"images/bg2.jpg\" ><br><br><br><br><br><br><br>
		<table width=\"50%\" align=\"center\">
		<tr>
			<td>
				
	
    <ul class=\"tabs\">
        <li><a href=\"#tab1\"><font face=\"Verdana\" size=\"2\" color=\"#475B70\" align=\"center\"><i><B>Iniciar Sesi&oacute;n</B></i></font></a></li>
        <li><a href=\"#tab2\"><font face=\"Verdana\" size=\"2\" color=\"#475B70\" align=\"center\"><i><B>Cambio de contrase&ntilde;a</B></i></font></a></li>
        
    </ul>
    <div class=\"tab_container\">
	
        <div id=\"tab1\" class=\"tab_content\">
            <font face=\"verdana\" size=\"4\" color=\"000066\"><i>CONTROL DE PEDIDOS Y DESPACHOS - CCAS</i></font><br><br> 
			<font face=\"verdana\" size=\"4\" color=\"000066\"><i>INICIAR SESI&Oacute;N</i></font><br>
	
	<table align=\"center\"  border=\"0\"  >
			<tr>	
				<td align=\"center\"><br></td>
			</tr>	
			<tr>
				<td> <form id=\"form1\" name=\"form1\" method=\"POST\" action=\"maestro/loginT.php\">
				<table align=\"center\"  border=\"0\">
					<tr>
						<td align=\"center\"><img width=\"200\" height=\"150\" src=\"images/llave.jpg\" border=\"0\" complete=\"complete\"/></td>
						<td align=\"left\"><font face=\"Verdana\" size=\"3\" color=\"#475B70\"><i>Usuario :</i></font><br>";
						$consultaem= mysql_query("SELECT * FROM usuario ORDER BY usuario;"); 


echo "<select name=\"usuario\" id=\"ed\" class=\"required\" ><option value=\"\">Seleccione</option>"; 


while ($row=mysql_fetch_array($consultaem)) 
{echo "<option value=\"".$row['usuario']."\">".$row['usuario']; 
 
} 





echo "</select>
						
						<br><br> 
						<font face=\"Verdana\" size=\"3\" color=\"#475B70\"><i>Contrase&ntilde;a :</i><br></font><input type=\"password\" name=\"pass\" id=\"ed\" class=\"required\" minlength=\"4\">  <br><br>  <center> <input type=\"image\" src=\"images/boton.jpg\" width=\"120\" /></center></td>
					</tr>
					
				</table>
						
				</td>
			</tr>
			
		
		</table></form>
        </div>
        <div id=\"tab2\" class=\"tab_content\">
             <font face=\"verdana\" size=\"4\" color=\"000066\"><i>CONTROL DE PEDIDOS Y DESPACHOS - CCAS</i></font><br><br> 
			<font face=\"verdana\" size=\"4\" color=\"000066\"><i>CAMBIO DE CONTRASE&Ntilde;A</i></font><br>
	
	<table align=\"center\"  border=\"0\"  >
			<tr>	
				<td align=\"center\"><br></td>
			</tr>	
			<tr>
				<td> <form id=\"form1\" name=\"form1\" method=\"POST\" action=\"maestro/change.php\">
				<table align=\"center\"  border=\"0\">
					<tr>
						<td align=\"center\"><img width=\"200\" height=\"150\" src=\"images/llave.jpg\" border=\"0\" complete=\"complete\"/></td>
						<td align=\"left\"><font face=\"Verdana\" size=\"3\" color=\"#475B70\"><i>Usuario :</i></font><br>";
						$consultaem= mysql_query("SELECT * FROM usuario ORDER BY usuario;"); 


echo "<select name=\"usuario\" id=\"ed\"><option value=\"\">Seleccione</option>"; 


while ($row=mysql_fetch_array($consultaem)) 
{echo "<option value=\"".$row['usuario']."\">".$row['usuario']; 
 
} 





echo "</select>
						
						<br><br> 
						<font face=\"Verdana\" size=\"3\" color=\"#475B70\"><i>Contrase&ntilde;a Actual:</i><br></font><input type=\"password\" name=\"passact\" id=\"ed\">  <br>
						<font face=\"Verdana\" size=\"3\" color=\"#475B70\"><i>Nueva Contrase&ntilde;a :</i><br></font><input type=\"password\" name=\"newpass\" id=\"ed\" minlength=\"4\">  <br>
						<font face=\"Verdana\" size=\"3\" color=\"#475B70\"><i>Confirmar Contrase&ntilde;a :</i><br></font><input type=\"password\" name=\"newpass2\" id=\"ed\" class=\"required\" minlength=\"4\">  <br><br>     <br><br>  <center> <input type=\"image\" src=\"images/boton.jpg\" width=\"120\" /></td>
					</tr>
					
				</table>
						
				</td>
			</tr>
			
		</form>
		</table>
        </div>
        
    </div>
</div>

				


			
			</td>
		</tr>


		</table>

	</body>

</html>";
	
	
/*	$mensaje .= '<script name="accion">alert("El Sistema se Encuentra en Mantenimiento, Por Favor Intente Mas Tarde Gracias!.");
		
 </script>';
 
 echo $mensaje;	*/	


?>