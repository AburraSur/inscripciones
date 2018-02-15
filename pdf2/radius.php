<?php
include("./dompdf/dompdf_config.inc.php");

$html = '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-15">
<style>

.d { 
  width: 1in; 
  height: 1in; 
  margin: 5pt;
  border-radius: 1em 80px 40px 80px;
  background: #ccc;
}

.b1 {
  border: 4px solid red;
  background-image: url(images/goldengate.jpg);
  height: 2in;
}

.b3 {
  border: #369 thin dashed;
}

.b4 {
  border: dotted green 2px;
}

.b6 {
  border: orange inset 4pt;
}

.b7 {
  border: 0.5em #0033DD groove;
}

.b8 {
  border: orange ridge 4pt;
}


</style>
</head>

<body>


<div class="d b1"> </div>
<div class="d b3"> </div>
<div class="d b4"> </div>
<div class="d b5"> </div>
<div class="d b6"> </div>
<div class="d b7"> </div>
<div class="d b8"> </div>
</body> </html>'; 


$dompdf = new DOMPDF(); 
$dompdf->load_html(utf8_decode($html)); 
$dompdf->render(); 

$dompdf->stream("desired_name.pdf",array('Attachment'=>0)); 

//echo $html;
?> 
