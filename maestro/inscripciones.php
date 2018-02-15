<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once("../clases/conectar.php");
//require_once ('../clases/addmas.php');
$linked = new conectar();
$db = $linked->conectarbd();
//$db = new conn();
if (empty($_GET['cod'])){
  $idevent = "0";  
}else{
$idevent=$_GET['cod'];
}
if (empty($_GET['guardar'])){
  $guardado = '0';  
}else{
$guardado=$_GET['guardar'];
}

    $sql=$linked->consulta("select * from evento where idevento=$idevent ");
    $row= mysqli_fetch_array($sql);
    $tipo = $row['tipo_evento'];
    $fec_ini=$row['fec_inicio'];
    $fec_fin=$row['fec_fin'];
    $fec_act= date('Y-m-d');
    $fecha=date('Y-m-d');
    $hora=date('H:i');
    $h='18:00';
    $cupo = $row['cupo'];
?>
<!DOCUMENT html>
<html>
<head>
<meta charset="UTF-8"><title>Inscripciones</title>
<link rel="icon" type="image/gif" href="../img/shopping.ico" />
<link href="../css/estilo.css" rel="stylesheet" type="text/css"/>
<link href="../css/bootstrap.css" rel="stylesheet" type="text/css"/>
<script src="../js2/inscribir.js" type="text/javascript"></script>
</head>
<!--Al leer el evento si esta abierto trae los inputs de empresa y usuario ubicados en clases/-->
<body onload="inicial(<?php print $idevent;?>)">
        <div class="col-lg-1"></div>
        <div class="col-lg-10 cuerpo">
        <!--titulo y nombre del evento-->
                <div class="titulo">
                    <table class="tablatitulo">	
                        <tr>
                            <td>
                                <?php
                                    echo "<img src=../img/uploads/$row[image]  id=sede />";
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <td>
				<?php
                                    echo "$row[nom_evento]<br>Lugar: $row[lugar]<br>Fecha: $row[fec_event]";
				?>
                            </td>
                        </tr>
                    </table>
                </div>
                <?php if($guardado != '0'){ ?>
                <div class="alert alert-success">
                    <strong>Inscripción Completa.</strong>
                </div>
               <?php
               }
                if(($fec_act >= $fec_ini) && ($fec_act <= $fec_fin) && ($row['estado'] == 'ACTIVO')){ ?>
                <!--Si el evento esta abierto-->
                <form action="../clases/guardar.php" method="post" >
                    <input type='text' name='idevent' value="<?php print $idevent;?>" style='display:none' >
                    
                    <div class="empresa panel-default">
                        <div class="panel-heading" id="nuevaEm">
                                <h3 class="panel-title"><i class="fa fa-bar-chart-o fa-fw"></i>Datos de Empresa </h3>
                        </div>
                        <div class='alert alert-info' style="display: none">
                            <strong>Ingreso de Participante Nuevo</strong>
                        </div>
                        <div class="row">
                            
                        <br>
                        <div class="form-group col-lg-4 ">
                            <label>Identificación</label>
                            <input type="text" name="id" onchange="consultas(this.value,<?php print $tipo?>,<?php print $cupo?>)"  class="form-control" required>
                        </div>
                        <!--Los inputs para ingresar la empresa se encuentran en clases/consulta.php -->
                        <span id="txtHint"></span>
                        
                       
                    </div>
                    </div>
                    <div class="empresa panel-default">
                        <div class="panel-heading">
                                <h3 class="panel-title"><i class="fa fa-bar-chart-o fa-fw"></i>HABEAS DATA </h3>
                        </div>
                        <br>
                        <div class="row">
                        <div class="form-group col-lg-12 ">
                            Dando cumplimiento a la Ley 1581 y a su Decreto Reglamentario 1377 de 2013, le informamos que Usted puede ejercer sus derechos a conocer, actualizar, rectificar y solicitar la supresión de los datos personales en cualquier momento.
                            <br>
                            La información de sus datos  la utilizaremos para: informar sobre nuestros servicios, enviar información de los eventos  y capacitaciones  ofrecidas por nuestra entidad y/o en convenio con otras organizaciones, o para realizar  estudios  sectoriales o investigaciones.
                            <br><br>
                            <div class="form-group col-lg-4">
                            <input type="radio" name="habeas1" value="SI" />Si Autorizo recibir Información
                            </div>
                            <div class="form-group col-lg-4">
                            <input type="radio" name="habeas1" value="NO" />NO Autorizo recibir Información
                            </div>
                            <div class="form-group col-lg-4">
                            <input type="radio" name="habeas1" value="NSNR" />No sabe/No responde
                            </div>
                            <div class='form-group col-lg-8'>
                                <label>Quien Autoriza</label>
                                <input type='text' name='habeasQ' class='form-control' required>
                            </div>
                        </div>                       
                    </div>
                    </div>
                    <div class="empresa panel-default">
                        <div class="panel-heading">
                                <h3 class="panel-title"><i class="fa fa-bar-chart-o fa-fw"></i>Datos Personales del Participante</h3>
                        </div>
                        <div class="row">
                        <br>
                        <div class='form-group col-lg-6'>
                            <label>Identificación</label>
                            <input class='form-control' name='codigo' id="codigo" value="1" style="display:none">
                            <input class='form-control' name='idpersona[]' id="idpersona" onchange="leer(this.value),<?php print $idevent?>"  required>
                        </div>
                        <!--Los inputs para ingresar la empresa se encuentran en clases/datousuario.php -->
                        <span id="txtusuarios1"></span>
                        </div>
                    </div>
                    <div id="parent">
                    </div>
                <br>
                <button type="submit" id="guardar" class="btn btn-default" >Guardar</button>
                </form>
                <button type="button" class="btn btn-default" id="adicion" onclick="addmas('parent')" value="adicoionarp" >Agregar </button>
                <button type="button" class="btn btn-default" id="borrar" onclick="borrar()" value="adicoionarp" >Borrar Ultimo </button>   
                <?php    }else{ 
                ?>
                <!--Si el evento esta cerrado-->
                        <div class="cerrado">
                           Las Inscripciones para este Evento<br>se Encuentran Cerradas
                           <br>
                           <a href="http://apps.ccas.org.co/inscripciones/" ><img src="../img/exit.png" alt="cerrar"><br><font face="Verdana" size="2"  ><b><i>Salir</i></b></font></a>
                        </div>   
                <?php } ?>
            </div>
        </body>

</html>