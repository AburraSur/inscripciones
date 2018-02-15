<html> 
<head> 
  
</head> 
<body> 
<?php 
function Conectarse() 
{ 
   if (!($link=mysql_connect("localhost","root","Ccas1992"))) 
   { 
      echo "Error conectando a la base de datos."; 
      exit(); 
   } 
   if (!mysql_select_db("promo",$link)) 
   { 
      echo "Error seleccionando la base de datos."; 
      exit(); 
   } 
   return $link; 
} 

$link=Conectarse(); 
 



?> 
</body> 
</html> 

