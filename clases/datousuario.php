<?php
//conexion a base de datos
require("conectar.php");
$linked = new conectar();
$link = $linked->conectarbd();

//funcion para mostrar los componentes del formulario al iniciar 
function mostrar(){
    print "<input type='text' id='dir' name='empresa[]' value='0' style='display:none' >
            <div class='form-group col-lg-6'>
                <label>Cargo</label>
                <input type='text' id='dir' name='cargo[]' class='form-control'required>
            </div>
            <div class='form-group col-lg-6'>
                <label>Nombres Completos</label>
                <input class='form-control' name='nombre[]' required>
            </div>
            <div class='form-group col-lg-6'>
                <label>Apellidos Completos</label>
                <input class='form-control' name='apellido[]' required>
            </div>
            <div class='form-group col-lg-6'>
                <label>Correo Electronico</label>
                <input class='form-control' name='correo[]' required>
            </div>
            <div class='form-group col-lg-4'>
                <label>Telefono</label>
                <input class='form-control' name='telefono[]' required>
            </div>
            <div class='form-group col-lg-2'>
                <label>Ext</label>
                <input class='form-control' name='ext[]'>
            </div>
            <div class='form-group col-lg-6'>
                <label>Celular</label>
                <input class='form-control' name='cel[]' required>
            </div>
            <div class='form-group col-lg-6'>
                <label>Municipio</label>
                <select class='form-control' name='municipio[]' >
                    <option></option>
                    <option>CALDAS</option>
                    <option>ENVIGADO</option>
                    <option>ITAGUI</option>
                    <option>LA ESTRELLA</option>
                    <option>SABANETA</option>
                    <option>MEDELLIN</option>
                </select>
            </div>";
}

function datos($cliente){
    while($resultado = $cliente->fetch_array()){
        $cargo = $resultado['cargo'];
        $nom = $resultado['nombres'];
        $ape = $resultado['apellidos'];
        $correo = $resultado['email'];
        $tel = $resultado['tel'];
        $ext = $resultado['ext'];
        $cel = $resultado['cel'];
        $muni = $resultado['municipio'];
        $comen = $resultado['comentario'];
        print "<input type='text' id='dir' name='empresa[]' value='1' style='display:none' > 
            <div class='form-group col-lg-6'>
                <label>Cargo</label>
                <input type='text' id='dir' class='form-control' name='cargo[]'  value='$cargo' required>
            </div>
            <div class='form-group col-lg-6'>
                <label>Nombres Completos</label>
                <input class='form-control' name='nombre[]' value='$nom' required>
            </div>
            <div class='form-group col-lg-6'>
                <label>Apellidos Completos</label>
                <input class='form-control' name='apellido[]' value='$ape' required>
            </div>
            <div class='form-group col-lg-6'>
                <label>Correo Electronico</label>
                <input class='form-control' name='correo[]' value='$correo' required>
            </div>
            <div class='form-group col-lg-4'>
                <label>Telefono</label>
                <input class='form-control' name='telefono[]' value='$tel' required>
            </div>
            <div class='form-group col-lg-2'>
                <label>Ext</label>
                <input class='form-control' name='ext[]' value='$ext'>
            </div>
            <div class='form-group col-lg-6'>
                <label>Celular</label>
                <input class='form-control' name='cel[]' value='$cel' required>
            </div>
            <div class='form-group col-lg-6'>
                <label>Municipio</label>
                <select class='form-control' name='municipio[]' >
                    <option> </option>
                    <option>CALDAS</option>
                    <option>ENVIGADO</option>
                    <option>ITAGUI</option>
                    <option>LA ESTRELLA</option>
                    <option>SABANETA</option>
                    <option>MEDELLIN</option>
                </select>
            </div>";
    }
  
}

function fexiste($id,$nEvento,$link){
    $query = "SELECT * FROM  `event_asist`WHERE  `idevent` = '$nEvento' AND  `cedula`='$id'";
    if($resultado = $link->query($query) or trigger_error(mysqli_error($link))){}
    $columnas = mysqli_num_rows($resultado);
    if($columnas == 0){
        $valor = true;
    }else{
        $valor = false;
    }
    return $valor;
}


function buscar($id,$link){
      $query = "SELECT * FROM `asistentes` WHERE `cedula` = '$id'";
    if($resultado = $link->query($query) or trigger_error(mysqli_error($link))){}
return$resultado;
}
//se traen los parametros del js por metodo get
$id  = $_GET["id"];
$nEvento = $_GET['evento'];


if ($id == ''){
   mostrar();
}
else if(fexiste($id,$nEvento,$link)) {
    $cliente = buscar($id, $link);
    $numerocol = mysqli_num_rows($cliente);
    if($numerocol == 0){
        mostrar();
    }else{
    datos($cliente);
    }
    print "<input type='text' id='cExiste' name='empresa[]' value='1' style='display:none' >";
}else{
    print "<input type='text' id='cExiste' name='empresa[]' value='0' style='display:none' >";
     mostrar();
}
$link->close(); 