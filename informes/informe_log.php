<?php
require_once 'paginador.php';

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
if (!empty($_POST['cedula'])){
    $cedula = $_POST['cedula'];
}else{
    $cedula ="";
}
if (!empty($_POST['fecha1'])){
    $fecha1 = $_POST['fecha1'];
}else{
    $fecha1 ="";
}
if (!empty($_POST['fecha2'])){
    $fecha2 = $_POST['fecha2'];
}else{
    $fecha2 ="";
}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Informe desde el Log</title>

<link href="../css/bootstrap.css" rel="stylesheet" type="text/css"/>
<link href="../css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
<link href="../css/estilo.css" rel="stylesheet" type="text/css"/>
<script src="../js/jquery-1.11.3.min.js" type="text/javascript"></script>
<LINK href="../estilo/divestilo.css" rel="stylesheet" type="text/css">
<script src="../js/ajax.js" type="text/javascript"></script>
<script src="../js/bootstrap-datepicker.js" type="text/javascript"></script>
 <script>
        $(function(){
            $('.datepicker').datepicker({
            format:'yyyy/mm/dd',
            autoclose:true,
            startDate: '1d'});
        });
        
</script>	
</head>

<body>
    <div class="informe">
        <div class="titulo">
        Informe de Actividades 
        </div>
        <div class="formulario">
            <form role="form" method="POST" action="">
                      
                <div class="form-superior">
                    <label>Identificación</label>
                    <input class="form-control" type="text" size="20" name="cedula" ><br>
                </div>
                <div class="form-superior">
                    <label>Fecha Inicial</label>
                    <input type="text" size="20" name="fecha1" class="form-control datepicker"  ><br>
                </div>
                <div class="form-superior">
                    <label>Fecha Final</label>
                    <input type="text" size="20" name="fecha2" class="form-control datepicker"  ><br>
                </div>
                <br><br>
                <button type="submit">Buscar</button>
                   
            </form>
        </div>
        <div class="tabla">
            <h2>Actividad</h2>
            <div id="contenido">
                <?php paginador($cedula,$fecha1,$fecha2);?>
            </div>

        </div>
    </div>
            

</body>

</html>
