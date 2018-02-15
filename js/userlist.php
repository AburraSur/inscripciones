<html>
<head>
	<script src="./js/jquery.js"></script>
  <script src="./js/jquery-1.4.2.min.js"></script>
<script type="text/javascript" src="./js/jquery.min.js"></script>
  <script type="text/javascript" src="./js/jquery-validate.js"></script>
  <script>
  $(document).ready(function(){
	
	$('#admonuser tbody tr:even').css('background-color','silver');
	
		$('.trash').click(function(){
		var id = $(this).attr('value');
		var tp = $(this).attr('title');
		//alert(tp);
		var r = confirm('Desea '+tp+' El Usuario '+id+' ?');
		if(r == true){
		$.ajax({
			url: './maestro/adminuser.php',
			type: 'POST',
			data: {id:id , tp:tp},
			success: function( datatr ){
				var objtr = eval ( '(' + datatr + ')' );
				if(objtr.sw==1){
					/*$.blockUI({message:'<h3>El Usuario Fue Eliminado del Sistema.</h3>'});
					setTimeout($.unblockUI, 3000);
					$.blockUI({ message: '<h3><img src=./img/trash.png /><br>Los Datos Son Incorrectos.<br> Por Favor Verificarlos.</h3>' });
			setTimeout($.unblockUI, 3000); */
			alert('Usuario '+objtr.msn+' del Sistema');
					$('#admonuser').parent().fadeOut('slow').load('./js/userlist.php').fadeIn('fast');
				}
			}
		})
		return false;
		}
	});
  });
  </script>
</head>
<body>
	<table align="center" id="admonuser" >
					<thead>
						<tr>
							<th>Identificaci&oacute;n</th>
							<th>Usuario</th>
							<th>Estado</th>
							<th>Acci&oacute;n</th>
						</tr>
					</thead>
					<tbody>
						<?php
						require('../class.conexion.php');
						
						$db = new conn();
						
						$sqluser = $db->consulta("select * from usuario where estado <>'ELIMINADO' ");
						while( $rowuser = $db->fetch_array($sqluser)){
							echo "<tr>
									<td>$rowuser[iduser]</td><td>$rowuser[nombre]</td><td>$rowuser[estado]</td><td>";
									if($rowuser['estado'] === 'BLOQUEADO'){
										$imgpath = 'unblock.png';
										$title = "desbloquear";
									}else{
										$imgpath = 'block.png';
										$title = "bloquear";
									}
							echo "<img src='./img/$imgpath' class='trash' title='$title' width=25  value=$rowuser[iduser] /><img src='./img/trash.png' class='trash'  title='borrar' width=25 value=$rowuser[iduser] /></td>
								</tr>";
						}		
						?>
					</tbody>
					</table>
</body>
</html>