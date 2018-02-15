<?php
require("./class.conexion.php");

$db = new conn();


$uploaddir = 'uploads/';
$uploadfile = $uploaddir . basename($_FILES['userfile']['name']);
if(isset($_POST['unlink'])){
	$link = "uploads/$_POST[list]";
	if($_POST['list'] == 'blank.png'){
		$sw = 1;
	}else{
		$sw = unlink("$link");
	}
	if ( $sw == true ){
		$db->consulta("update evento set image='blank.png' where idevento=$_POST[ideve] ");
	}
	$array = array("sw" => $sw );
$arrayj = json_encode($array);
echo $arrayj;
}else{
if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile)) {
  echo "success";
} else {
  echo "error";
}

}
?>