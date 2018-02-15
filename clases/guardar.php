<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once 'conectar.php';
$linked = new conectar();
$link = $linked->conectarbd();
session_start();

class guardar{
    private $id;
    private $nomEmp;
    private $dirEmp;
    private $tarifa;
    private $activos;
    private $tipoEmp;
    private $nuevoE;
    private $fechaR;
    private $cedula;
    private $cargo;
    private $nombrep;
    private $apellidop;
    private $correop;
    private $telefon;
    private $ext;
    private $cel;
    private $municipio;
    private $idevent;
    private $habeas;
    private $habeasQ;
    Private $fecha;
    Private $user;
            
    function get_idevent($idevent){
        $this->idevent = $idevent;
    }
    function get_id($id){
        $this->id = $id;
    }
    function get_nomEmp($nomEmp){
        $this->nomEmp = $nomEmp;
    }
    function get_dirEmp($dirEmp){
        $this->dirEmp = $dirEmp;
    }
    function get_tarifa($tarifa){
        $this->tarifa = $tarifa;
    }
    function get_activos($activos){
        $this->activos = $activos;
    }
    function get_tipoEmp($tipoEmp){
        $this->tipoEmp = $tipoEmp;
    }
    function get_nuevoE($nuevo){
        $this->nuevoE = $nuevo;
    }
    function get_fechaR($fechaR){
        $this->fechaR = $fechaR;
    }
    function get_cedula($var){
        $this->cedula = $var;
    }
    function get_cargo($var){
        $this->cargo = $var;
    }
    function get_nombre($var){
        $this->nombrep = $var;
    }
    function get_apellido($var){
        $this->apellidop = $var;
    }
    function get_correo($var){
        $this->correop = $var;
    }
    function get_telefono($var){
        $this->telefon = $var;
    }
    function get_ext($var){
        $this->ext = $var;
    }
    function get_cel($var){
        $this->cel = $var;
    }
    function get_municipio($var){
        $this->municipio = $var;
    }
    function get_habeas($var){
        $this->habeas = $var;
    }
    function get_habeasQ($var){
        $this->habeasQ = $var;
    }
    function get_fechadia($var){
        $this->fecha = $var;
    }
    function get_user($var){
        $this->user = $var;
    }
    
    
    function salvar($link){
        $query = "INSERT INTO `empresa`(`nit`, `rsocial`, `dir`, `activos`, `fechaRenovado`, `comentario`) VALUES ('$this->id','$this->nomEmp','$this->dirEmp','$this->activos','$this->fechaR','$this->tipoEmp')";
        if($resultado = $link->query($query) or trigger_error(mysqli_error($link))){}
        $fecha = date("Y-m-d");
        $descripcion = "El Usuario $this->user inscribio la empresa $this->id en el evento $this->idevent ";
        $queryLog ="INSERT INTO `log`(`fechalog`, `descripcion`) VALUES ('$fecha','$descripcion')";
        if($resultado1 = $link->query($queryLog) or trigger_error(mysqli_error($link))){}
    }
    function salvarP($link){
        $query = "INSERT INTO `asistentes`(`cedula`, `nombres`, `apellidos`, `email`, `tel`, `ext`, `cel`, `municipio`, `cargo`, `comentario`, `habeas`, `who`) VALUES ('$this->cedula','$this->nombrep','$this->apellidop','$this->correop','$this->telefon','$this->ext','$this->cel','$this->municipio','$this->cargo','','$this->habeas','$this->habeasQ')";
        if($resultado = $link->query($query) or trigger_error(mysqli_error($link))){}
        $fecha = date("Y-m-d");
        $descripcion = "El Usuario $this->user inscribio el asistente $this->cedula en el evento $this->idevent ";
        $queryLog ="INSERT INTO `log`(`fechalog`, `descripcion`) VALUES ('$fecha','$descripcion')";
        if($resultado1 = $link->query($queryLog) or trigger_error(mysqli_error($link))){}
    }
    function salvarIns($link){
        $query = "INSERT INTO `event_asist`(`idevent`, `cedula`, `nit`, `e_asistio`, `certifica`, `tipocert`, `observa_admin`) VALUES ('$this->idevent','$this->cedula','$this->id','0','0','0','')";
        if($resultado = $link->query($query) or trigger_error(mysqli_error($link))){}  
    }
    function actualizar($link){
        $query = "UPDATE `empresa` SET `rsocial`='$this->nomEmp',`dir`='$this->dirEmp',`activos`='$this->activos',`fechaRenovado`='$this->fechaR',`comentario`= '$this->tipoEmp' WHERE nit = '$this->id'";
        if($resultado = $link->query($query) or trigger_error(mysqli_error($link))){}
        $fecha = date("Y-m-d");
        $descripcion = "El Usuario $this->user actualizo la empresa $this->id en el evento $this->idevent ";
        $queryLog ="INSERT INTO `log`(`fechalog`, `descripcion`) VALUES ('$fecha','$descripcion')";
        if($resultado1 = $link->query($queryLog) or trigger_error(mysqli_error($link))){}
    }
    function actualizarU($link){
        $query = "UPDATE `asistentes` SET `nombres`='$this->nombrep',`apellidos`='$this->apellidop',`email`='$this->correop',`tel`='$this->telefon',`ext`='$this->ext',`cel`='$this->cel',`municipio`='$this->municipio',`cargo`='$this->cargo',`comentario`='',`habeas`='$this->habeas',`who`= '$this->habeasQ' WHERE cedula = '$this->cedula' ";
        if($resultado = $link->query($query) or trigger_error(mysqli_error($link))){}
        $fecha = date("Y-m-d");
        $descripcion = "El Usuario $this->user actualizo el asistente $this->cedula en el evento $this->idevent ";
        $queryLog ="INSERT INTO `log`(`fechalog`, `descripcion`) VALUES ('$fecha','$descripcion')";
        if($resultado1 = $link->query($queryLog) or trigger_error(mysqli_error($link))){}
    }
}
$user = $_SESSION['iduser'];
$fecha = date("Y-m-d");
$idevent = $_POST['idevent'];
$id = $_POST['id'];
$nomEmp = $_POST['nomEmpresa'];
$dirEmp = $_POST['direccion'];
$tarifa = $_POST['tarifa'];
$activos= $_POST['activo'];
$tipoEmp = $_POST['tamano'];
$nuevo = $_POST['nuevo'];
$fechaR = $_POST['fechaR'];

$empresa = new guardar();
$empresa->get_idevent($idevent);
$empresa ->get_id($id);
$empresa ->get_nomEmp($nomEmp);
$empresa ->get_dirEmp($dirEmp);
$empresa ->get_tarifa($tarifa);
$empresa ->get_tipoEmp($tipoEmp);
$empresa ->get_nuevoE($nuevo);
$empresa ->get_fechaR($fechaR);
$empresa ->get_user($user);
$empresa ->get_fechadia($fecha);

if ($nuevo == 0){
    $empresa->actualizar($link);
}  else {
    $empresa->salvar($link);
}

$cedula = $_POST['idpersona'];
$cargo = $_POST['cargo'];
$nombrep = $_POST['nombre'];
$apellidop = $_POST['apellido'];
$correop = $_POST['correo'];
$telefon = $_POST['telefono'];
$ext = $_POST['ext'];
$cel = $_POST['cel'];
$municipio = $_POST['municipio'];
$nuevoU = $_POST['empresa'];
$empresa->get_habeas($_POST['habeas1']);
$empresa->get_habeasQ($_POST['habeasQ']);

$inscritos = count($cedula);
for ($i=0;$i<$inscritos;$i++){
    $empresa->get_cedula($cedula[$i]);
    $empresa->get_cargo($cargo[$i]);
    $empresa->get_nombre($nombrep[$i]);
    $empresa->get_apellido($apellidop[$i]);
    $empresa->get_correo($correop[$i]);
    $empresa->get_telefono($telefon[$i]);
    $empresa->get_ext('0');
    $empresa->get_cel($cel[$i]);
    $empresa->get_municipio($municipio[$i]);
    $empresa->salvarIns($link);
    if ($nuevoU[$i]== '0'){
    $empresa->salvarP($link);
    }else{
        $empresa->actualizarU($link);
    }
    

}

//header("Location:../maestro/inscripciones.php?cod=$idevent&guardar=1");
