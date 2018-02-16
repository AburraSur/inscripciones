<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
if(!empty($_GET['pag'])){
    $v1 = $_GET['var1'];
    $v2 = $_GET['var2'];
    $v3 = $_GET['var3'];
    paginador($v1,$v2,$v3);
}
function paginador($var1,$var2,$var3){
$db_con = mysqli_connect ("localhost","root","Ccas1992");
        if (!$db_con){}
        if (!mysqli_select_db ($db_con,"ccasco_promo")){}
 

$RegistrosAMostrar=20;
 //estos valores los recibo por GET
 if(isset($_GET['pag'])){
  $RegistrosAEmpezar=($_GET['pag']-1)*$RegistrosAMostrar;
  $PagAct=$_GET['pag'];
  //caso contrario los iniciamos
 }else{
  $RegistrosAEmpezar=0;
  $PagAct=1;
 }
 if (($var1 == '')&&($var2 == '')&&($var3 == '')){
    $query = "SELECT * FROM `log` ORDER BY fechalog DESC LIMIT $RegistrosAEmpezar, $RegistrosAMostrar";
 }  else if (($var1 != '')&&($var2 == '')&&($var3 == '')){
     $query = "SELECT * FROM `log` WHERE `descripcion` LIKE '%$var1%' ORDER BY fechalog DESC LIMIT $RegistrosAEmpezar, $RegistrosAMostrar";
 } else if (($var1 == '')&&($var2 != '')&&($var3 == '')){
     $query = "SELECT * FROM `log` WHERE `fechalog` >= '$var2' ORDER BY fechalog DESC LIMIT $RegistrosAEmpezar, $RegistrosAMostrar";
 }  else if (($var1 == '')&&($var2 == '')&&($var3 != '')){
     $query = "SELECT * FROM `log` WHERE `fechalog` <= '$var3' ORDER BY fechalog DESC LIMIT $RegistrosAEmpezar, $RegistrosAMostrar";
 }else if (($var1 != '')&&($var2 != '')&&($var3 == '')){
     $query = "SELECT * FROM `log` WHERE `fechalog` >= '$var2' AND `descripcion` LIKE '%$var1%' ORDER BY fechalog DESC LIMIT $RegistrosAEmpezar, $RegistrosAMostrar";
 }else if(($var1 != '')&&($var2 == '')&&($var3 != '')){
     $query = "SELECT * FROM `log` WHERE `fechalog` <= '$var3' AND `descripcion` LIKE '%$var1%' ORDER BY fechalog DESC LIMIT $RegistrosAEmpezar, $RegistrosAMostrar";
 }else if(($var1 == '')&&($var2 != '')&&($var3 != '')){
     $query = "SELECT * FROM `log` WHERE `fechalog` <= '$var3' AND `fechalog` >= '$var2' ORDER BY fechalog DESC LIMIT $RegistrosAEmpezar, $RegistrosAMostrar ";
 }else if(($var1 != '')&&($var2 != '')&&($var3 != '')){
     $query = "SELECT * FROM `log` WHERE `fechalog` <= '$var3' AND `fechalog` >= '$var2' AND `descripcion` LIKE '%$var1%' ORDER BY fechalog DESC LIMIT $RegistrosAEmpezar, $RegistrosAMostrar ";
 }
    //$Resultado=mysql_query("SELECT * FROM empleado ORDER BY nombres LIMIT $RegistrosAEmpezar, $RegistrosAMostrar",$con);
    if($resultado = $db_con->query($query) or trigger_error(mysqli_error($db_con))){}
    
    print "<table width=100% class='tabla-border'>";
    print "<thead>
                    <tr>
                        <th style='width:100px' class='tabla-border'>Fecha</th>
                        <th style='width:80px' class='tabla-border'>Cedula</th>
                        <th style='width:150px' class='tabla-border'>Nombre</th>
                        <th style='width:350px' class='tabla-border'>Acción</th>
                    </tr>
                </thead> "; 
   
    while($tipo = $resultado->fetch_array()){
        $query2 = "SELECT iduser, nombre FROM usuario WHERE estado = 'ACTIVO'";
        if($resultado2 = $db_con->query($query2) or trigger_error(mysqli_error($link))){}
        $user = "";
        $id = "";
        while($usuario = $resultado2->fetch_array()){
            if(stristr($tipo['descripcion'], $usuario['iduser'])) {
             $id =  $usuario['iduser'];
             $user = $usuario['nombre'];
            }
        }
        print "<tr>";
        print "<td style='width:100px' class='tabla-border'>".$tipo['fechalog']."</td>";
        print "<td style='width:80px' class='tabla-border'>$id</td>";
        print "<td style='width:150px' class='tabla-border'>$user</td>";
        print "<td style='width:350px' class='tabla-border'>".$tipo['descripcion']."</td>";
        print "</tr>"; 
    }
print "</table>";
 //******--------determinar las páginas---------******//
if (($var1 == '')&&($var2 == '')&&($var3 == '')){
    $query1 = "SELECT * FROM `log`";
 }  else if (($var1 != '')&&($var2 == '')&&($var3 == '')){
     $query1 = "SELECT * FROM `log` WHERE `descripcion` LIKE '%$var1%'";
 } else if (($var1 == '')&&($var2 != '')&&($var3 == '')){
     $query1 = "SELECT * FROM `log` WHERE `fechalog` >= '$var2'";
 }  else if (($var1 == '')&&($var2 == '')&&($var3 != '')){
     $query1 = "SELECT * FROM `log` WHERE `fechalog` <= '%$var3%'";
 }else if (($var1 != '')&&($var2 != '')&&($var3 == '')){
     $query1 = "SELECT * FROM `log` WHERE `fechalog` >= '$var2' AND `descripcion` LIKE '%$var1%'";
 }else if(($var1 != '')&&($var2 == '')&&($var3 != '')){
     $query1 = "SELECT * FROM `log` WHERE `fechalog` <= '$var3' AND `descripcion` LIKE '%$var1%'";
 }else if(($var1 == '')&&($var2 != '')&&($var3 != '')){
     $query1 = "SELECT * FROM `log` WHERE `fechalog` <= '$var3' AND `fechalog` >= '$var2'";
 }else if(($var1 != '')&&($var2 != '')&&($var3 != '')){
     $query1 = "SELECT * FROM `log` WHERE `fechalog` <= '$var3' AND `fechalog` >= '$var2' AND `descripcion` LIKE '%$var1%'";
 }
 
 $NroRegistros=mysqli_num_rows($db_con->query($query1));
 $PagAnt=$PagAct-1;
 $PagSig=$PagAct+1;
 $PagUlt=$NroRegistros/$RegistrosAMostrar;

 //verificamos residuo para ver si llevará decimales
 $Res=$NroRegistros%$RegistrosAMostrar;
 // si hay residuo usamos funcion floor para que me
 // devuelva la parte entera, SIN REDONDEAR, y le sumamos
 // una unidad para obtener la ultima pagina
 if($Res>0) $PagUlt=floor($PagUlt)+1;
 
 //desplazamiento

 ?>
<table class="table table-bordered table-hover" style="width: 400px">
    <br>  
        <td> <?php echo "<a onclick=\"Pagina('1','$var1','$var2','$var3')\">Primero</a> ";?></td>
        <td> <?php if($PagAct>1) echo "<a onclick=\"Pagina('$PagAnt','$var1','$var2','$var3')\">Anterior</a> "; ?> </td>
        <td> <?php echo "<strong>Pagina ".$PagAct."/".$PagUlt."</strong>"; ?></td>
        <td> <?php  if($PagAct<$PagUlt)  echo " <a onclick=\"Pagina('$PagSig','$var1','$var2','$var3')\">Siguiente</a> "; ?></td>
        <td> <?php   echo "<a onclick=\"Pagina('$PagUlt','$var1','$var2','$var3')\">Ultimo</a>"; ?>
    </br>
 </table>

<?php }?>