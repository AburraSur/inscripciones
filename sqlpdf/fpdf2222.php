<?php

 require('./fpdf17/fpdf.php');
require("../class.conexion.php");

$db = new conn();

$ideve = $_GET['ideve'];
$idasis = $_GET['idasis'];

$sqleve = $db->consulta("select * from evento where idevento=$ideve ");
$roweve = $db->fetch_array($sqleve);

$headerC = 'CÁMARA DE COMERCIO ABURRÁ SUR';
		$jump = '';
		
		$id2 = number_format($_GET['idasis'],0,'','.');
		$id = "Identificación: $id2";
		$txtcertifica = "$roweve[var_certi]";
		
if ( $_GET['tp'] == 1 ){
	$sqlasis = $db->consulta("select a.cedula,a.nombres,a.apellidos,a.email from asistentes a inner join event_asist ea where a.cedula=ea.cedula and ea.idevent=$ideve and ea.cedula='$idasis' ");
}else{
	$sqlasis = $db->consulta("select a.cedula,a.nombres,a.apellidos,a.email from asistentes a inner join mod_asis ma where a.cedula=ma.cedula and ma.idmod=$idmod  and ma.idevento=$ideve and ma.cedula='$idasis' ");
}
$rowasis = $db->fetch_array($sqlasis);
$asistente = "$rowasis[nombres] $rowasis[apellidos]";
		$a = strlen($asistente);
 class PDF extends FPDF {   
	/*function Footer(){ // Pie de página  {       $this--->SetY(-15);
        $this->SetFont('Arial','I',8);
        $this->Cell(0,10,'Este es el pie de página creado con el método Footer() de la clase creada PDF que hereda de FPDF','T',0,'C');
    }
 
   /* function Header() //Encabezado
    {
        $this->SetFont('Arial','B',9);
 
        $this->Line(10,10,206,10);
        $this->Line(10,35.5,206,35.5);
 
        $this->Cell(30,25,'',0,0,'C',$this->Image('images/logo.png', 152,12, 19));
        $this->Cell(111,25,'ALGÚN TÍTULO DE ALGÚN LUGAR <img src="http://s0.wp.com/wp-includes/images/smilies/icon_biggrin.gif?m=1129645325g" alt=":D" class="wp-smiley"> ',0,0,'C', $this->Image('images/logoIzquierda.png',20,12,20));
        $this->Cell(40,25,'',0,0,'C',$this->Image('images/logoDerecha.png', 175, 12, 19));
 
        $this->Ln(25);
    }*/
 
    function ImprimirTexto($file)
    {
        // Leemos el archivo de texto
        //$txt = file_get_contents($file);
        /*
         * Arial - Fuente
         * '' - cadena vacía significa imrpimir el texto normal o
         *      se puede poner en Negrita 'B', Italico 'I' o Subrayado 'U'
         *      o una combinación de éstos.
         * 12 - tamaño de fuente
         * */
        $this->SetFont('Arial','',12);
        /*
         * 0 - el ancho se ajusta al margen de la hoja
         * 5 - alto de la celda
         * $txt - Texto a imrpimir.
         * NOTA: Los valores para justificar el texto y celda sin borde
         *       no los pasé, porque son valores por defecto del mismo método
         *
         * Pero quedaría así: MutiCell(0, 5, $txt, 0, 'J')
         * No olviden ver y 'jugar' con los parámetros
         **/
        $this->MultiCell(0,5,$file);
 
    }
 }
//fin clase PDF
 
        //$fecha="México D.F. a ".$_POST['dia']." de ". $_POST['mes']. " de ".$_POST['anio'];
		
		
		
        $pdf = new PDF();             //Crea objeto PDF
        $pdf->AddPage('L', 'Letter'); //Vertical, Carta
 
        /*$pdf->SetFont('Arial','B',12); //Arial, negrita, 12 puntos
        $pdf->Cell(0,10,$fecha,0,1,'R'); //Agrega la cadena $fecha*/
		
		$pdf->SetFont('Arial','B',24);
		
		$pdf->Cell(0,18,$jump,0,0,'C');
		$pdf->Ln();$pdf->Ln();
		$pdf->Cell(0,18,$headerC,0,0,'C');
		$pdf->SetFont('Arial','B',14);
		$pdf->Ln(10);
		$pdf->Cell(0,18,'Certifica que:',0,0,'C');
		$pdf->Ln(14);
        /* Se hace un salto de línea
         * y se manda llamar el método de imprimir texto,
         * envíando como parámetro el nombre del archivo
         * que contiene el texto.
        * */
		if( $a > 30 ){
			$pdf->SetFont('Arial','B',18);
		}else{
			$pdf->SetFont('Arial','B',24);
		}
		$pdf->Cell(0,18,$asistente,0,0,'C');
		$pdf->Ln(14);
		$pdf->SetFont('Arial','B',24);
		$pdf->Cell(0,18,$id,0,0,'C');
		$filex = utf8_decode("Participó en el Módulo 'ACTIVACIÓN COMERCIAL' Correspondiente al CICLO DE FORMACIÓN EMPRESARIAL, realizado entre el 23 de Octubre y el 20 Noviembre de 2013, en el marco del Componente de Fortalecimiento del Programa de Emprendimiento, Fortalecimiento y Asociatividad Empresarial EMFORMA. El cual incluyó temas como: Introducción y planeación del norte estratégico, Conocimiento y segmentación del cliente, Mezcla de marketing, Diseño y producción de productos o servicios, Manejo de inventarios, costos y logística. Con una duración de 20 horas.");
        $pdf->Ln();
        //$pdf->ImprimirTexto($filex);
		$pdf->SetFont('Arial','B',12);
		$pdf->MultiCell(0,5,$filex);
		$pdf->Ln();
		$pdf->Image('../img/firma.jpg',30,160,230);
        $pdf->Output();               //Salida al navegador
 
?>