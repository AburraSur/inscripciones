<?php
require("conectar.php");
$linked = new conectar();
$link = $linked->conectarbd();
function mostrar(){
    print " <div class='form-group col-lg-7'>
                <label>Nombre de la Empresa</label>
                <input class='form-control' id='nombre' name='nomEmpresa' value='' required readonly></div>   
            <div class='form-group col-lg-8'>
                <label>Dirección</label>
                <input type='text' id='dir' class='form-control' required readonly></div>
            <div class='form-group col-lg-3'>
                <label>Tarifa</label>
                <select class='form-control' readonly disabled=true>
                    <option> </option><option>Afiliado</option><option>Estudiante</option>
                    <option>Invitado</option><option>Matriculado</option>
                    <option>Particular </option></select></div>
            <div class='form-group col-lg-3'>
                <label>Tipo Empresa</label>
                <select class='form-control' readonly disabled=true>
                    <option> </option>
                    <option>Micro</option><option>Pequeña</option>
                    <option>Mediana</option><option>Grande</option>
                    </select></div>
                    <input type='text' id='maximo' name='max' value='5' style='display:none' >
                    <input type='text' id='cuposmax' name='maxcursos' value='1' style='display:none' >"; 
}

function mostrarNuevo($cupo,$nit){
    $tamano = tamano($nit);
    print " <div class='form-group col-lg-7'>
                <label>Nombre de la Empresa</label>
                <input class='form-control' id='nombre' name='nomEmpresa' required></div>   
            <div class='form-group col-lg-8'>
                <label>Dirección</label>
                <input type='text' name='direccion' class='form-control' required></div>
            <div class='form-group col-lg-3'>
                <label>Tarifa</label>
                <select class='form-control' name='tarifa'>
                    <option> </option><option value='Afiliado' >Afiliado</option><option value='Estudiante'>Estudiante</option>
                    <option value='Invitado'>Invitado</option><option value='Matriculado'>Matriculado</option>
                    <option value='Particular' >Particular </option></select></div>
            <div class='form-group col-lg-3'>
                <label>Tipo Empresa</label>
                <select class='form-control' name='tamano' >
                    <option "; if($tamano == 0){print "selected";} print" > </option>
                    <option "; if($tamano == 1){print "selected";} print" value='micro'  >Micro</option>
                    <option "; if($tamano == 2){print "selected";} print" value='pequena' >Pequeña</option>
                    <option "; if($tamano == 3){print "selected";} print" value='mediana' >Mediana</option>
                    <option "; if($tamano == 4){print "selected";} print" value='grande' >Grande</option>
                </select>
                </div>
                <input type='text' id='maximo' name='max' value='$cupo' style='display:none' >
                <input type='text' id='cuposmax' name='maxcursos' value='1' style='display:none'>
                <input type='text' name='nuevo' value='1' style='display:none'>
            <div class='form-group col-lg-3'>
                        <label>Cupos disponibles para el evento: $cupo</label>
            </div>"; 
}

function datos($nit ,$resultadoC,$tipo,$cupo,$resultado,$link){
$numeroCuposU = mysqli_num_rows($resultadoC);
$numeroCupos = $cupo - $numeroCuposU;
while($empresa = $resultado->fetch_array()){
    $nombre = $empresa['rsocial'];
    $direccion = $empresa['dir'];
    $tamano = tamano($nit);
    print " <div class='form-group col-lg-7'>
                <label>Nombre de la Empresa</label>
                <input class='form-control' id='nombre' name='nomEmpresa' value='$nombre' required>
            </div>   
            <div class='form-group col-lg-8'>
                <label>Dirección</label>
                <input type='text' id='dir' name='direccion' class='form-control' value='$direccion' required>
            </div>
            <div class='form-group col-lg-3'>
                <label>Tarifa</label>
                <select class='form-control' name='tarifa' >
                    <option> </option>
                    <option value='Invitado'>Afiliado</option>
                    <option value='Estudiante'>Estudiante</option>
                    <option value='Invitado'>Invitado</option>
                    <option value='Matriculado'>Matriculado</option>
                    <option value='Particular'>Particular </option>
                </select>
            </div>
            <div class='form-group col-lg-3'>
                <label>Tipo Empresa</label>
                <select class='form-control' name='tamano' >
                    <option "; if($tamano == 0){print "selected";} print" > </option>
                    <option "; if($tamano == 1){print "selected";} print" value='micro'  >Micro</option>
                    <option "; if($tamano == 2){print "selected";} print" value='pequena' >Pequeña</option>
                    <option "; if($tamano == 3){print "selected";} print" value='mediana' >Mediana</option>
                    <option "; if($tamano == 4){print "selected";} print" value='grande' >Grande</option>
                </select>
            </div>";
            if($tipo == 1){
            $cupos = cupos($nit,$link);
            $cupo1 =  11 - $cupos;
            print "<div class='form-group col-lg-3'>
                <label>Cupos Usados en Cursos: $cupos</label>
                <input type='text' id='cuposmax' name='maxcursos' value='$cupos' style='display:none'>
            </div>";
            
            if($cupo1 > $numeroCupos){
                print"<input type='text' id='maximo' name='max' value='$numeroCupos' style='display:none' >";
            }  else {
             print "<input type='text' id='maximo' name='max' value='$cupo1' style='display:none' > $cupo1";   
            }
            }else{
                print "<input type='text' id='cuposmax' name='maxcursos' value='$numeroCupos' style='display:none' >";
                print "<input type='text' id='maximo' name='max' value='$numeroCupos' style='display:none' >";
            }
                
             print "<div class='form-group col-lg-3'>
                <label>Cupos disponibles para el evento: $numeroCupos</label>
                <input type='text' name='nuevo' value='0' style='display:none'>
            </div>"; 
}
}

function cupos($nit,$link){
    $querycupos = "SELECT * FROM event_asist a, evento e WHERE `nit` = '$nit' AND `e_asistio` = 1 AND a.idevent = e.idevento AND e.tipo_evento = 1 AND e.fec_event >= '2016-01-01'";
    if($cupossql = $link->query($querycupos) or trigger_error(mysqli_error($link))){}
    $cupos = mysqli_num_rows($cupossql);
    return $cupos;
}

function tamano($nit){
    $servidor = "192.168.1.63";
    $usuario = "desarrollo";
    $clave = "d3s4rr0ll0";
    $baseDatos = "sii_55";
    $conn = new mysqli($servidor, $usuario, $clave,  $baseDatos);
// Verificar Conexion
    if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
    $activos = "SELECT matricula, acttot, fecrenovacion FROM `mreg_est_matriculados` WHERE `organizacion` != 02 and `categoria` != 03 and `categoria` != 02 and estmatricula != 'NA' and estmatricula != 'NN' and `nit` = '$nit'";
    $datosA = $conn->query($activos);
    $numerocol = mysqli_num_rows($datosA);
    if ($numerocol == 0){
        $activo = 0;
        $valor = 0;
        $fecharenovado = '';
    }else{
    $datosActivos = $datosA->fetch_array();
    $activo = $datosActivos['acttot'];
    $fecharenovado = $datosActivos['fecrenovacion'];
    if ($activo == ""){             $valor = 0;
    }elseif ($activo < 344727501){  $valor = 1;
    }elseif($activo < 3447275001){  $valor = 2;
    }elseif($activo < 20683650001){ $valor = 3;
    }else{                          $valor = 4;}
    }
    $conn->close();
    print "<input type='text' name='activo' class='form-control' value='$activo' style='display: none'>";
    print "<input type='text' name='fechaR' class='form-control' value='$fecharenovado' style='display: none'>";
    return $valor;
}

function buscarempresa($nit,$link){
      $query = "SELECT * FROM `empresa` WHERE `nit` = '$nit'";
    if($resultado = $link->query($query) or trigger_error(mysqli_error($link))){}
return$resultado;
}

function buscar($nit,$link,$nE){
      $query = "SELECT * FROM `event_asist` WHERE `nit` = '$nit' AND idevent = $nE ";
    if($resultado = $link->query($query) or trigger_error(mysqli_error($link))){}
return$resultado;
}


$nit  = $_GET["nit"];
$tipo = $_GET["tipo"];
$cupo = $_GET["cupo"];
$nEvento = $_GET['nEvento'];
if ($nit == ''){
   mostrar();
}
else {
    $empresa = buscarempresa($nit, $link);
    $numerocol = mysqli_num_rows($empresa);
    $cuposempresa = buscar($nit, $link, $nEvento);
    if($numerocol == 0){
        mostrarNuevo($cupo,$nit);
    }else{
    datos($nit,$cuposempresa,$tipo,$cupo,$empresa,$link);
    }
    
}
$link->close();