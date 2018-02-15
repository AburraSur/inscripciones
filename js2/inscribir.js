/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
var counter = 1;
var contador = 2;
var nEvento = '';

function inicial(evento){
    nEvento = evento;
    consultas('',"1",'','');
}

function consultas(id,tipo,cupo) {
  var xhttp;
  xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (xhttp.readyState === 4 && xhttp.status === 200) {
      document.getElementById("txtHint").innerHTML = xhttp.responseText;
      var cuposmax = document.getElementById('maximo').value;
      if (cuposmax <= 0){
          document.getElementById('adicion').disabled=true;
          document.getElementById('idpersona').disabled=true;
          document.getElementById('guardar').disabled=true;
          window.alert("La empresa ya tiene el máximo de cupos disponibles");
          }else{
                document.getElementById('adicion').disabled=false;
                document.getElementById('guardar').disabled=false;
                document.getElementById('idpersona').disabled=false;
          }
    }
  };
  xhttp.open("GET", "../clases/consulta.php?tipo="+tipo+"&nit="+id+"&cupo="+cupo+"&nEvento="+nEvento, true);
  xhttp.send(); 
}

function leer(id){
    var cuposmax = document.getElementById('cuposmax').value;
    if (cuposmax <= 11){
        var num = counter;
        var xhttp;
        xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (xhttp.readyState === 4 && xhttp.status === 200) {
                document.getElementById("txtusuarios"+num).innerHTML = xhttp.responseText;
                var existeCedula = document.getElementById('cExiste').value;
      if (existeCedula == 0){
          document.getElementById('adicion').disabled=true;
          document.getElementById('guardar').disabled=true;
          window.alert("La empresa ya esta inscrita para este evento");
          }else{
                document.getElementById('adicion').disabled=false;
                document.getElementById('guardar').disabled=false;
          }
            }
        };
        xhttp.open("GET", "../clases/datousuario.php?id="+id+"&evento="+nEvento, true);
        xhttp.send(); 
    }else{
        alert("Numero maximo de Inscripciones a cursos completas"); 
        document.getElementById('adicion').disabled=true;
        document.getElementById('guardar').disabled=true;
        
    }
    
}

function addmas(divName){
    var maximo = document.getElementById('maximo').value;
    var num = counter;
    
    if (num < maximo){
    var xhttp;
    
    xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (xhttp.readyState === 4 && xhttp.status === 200) {
            var newdiv = document.createElement('child');
            newdiv.innerHTML = xhttp.responseText;
            document.getElementById(divName).appendChild(newdiv);
            counter++;
            contador++;
        }
        };
        xhttp.open("GET", "../clases/addmas.php?cod="+contador, true);
        xhttp.send(); 
        }else {
            alert("Numero maximo de Inscripciones completas"); 
            document.getElementById('adicion').disabled=true;
    }
}
function borrar(){
    counter--;
    contador--;
    var child = document.getElementById("child"+counter);
    child.remove();
    
}
function prueba(){
    var nuevo = document.getElementById('maximo').value;
          if(nuevo === '5'){
              alert("Empresa Nueva");
          }else{
              alert("Empresa Nueva2");
          }
}