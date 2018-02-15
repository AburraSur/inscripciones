<?php
require("./class.phpmailer.php");

$mail2 = new phpmailer();	
$mail2 = new enviarmail();	

$mail2->enviar("<h3>Eventos CCAS</h3>" , "auxiliar.sistemas@ccas.org.co");
					
					

?>