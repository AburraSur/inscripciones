$(document).ready(function(){

$.blockUI({ message: '<img src=../img/welcome.png /><h3>Bienvenido al Formulario de Inscripción.</h3><p align=justify >Apreciado usuario, si el número de identificación de su empresa es NIT, por favor digite los 10 números de su identificación tributaria con el número de verificación sin puntos, comas o guiones. Si por el contrario su identificación es una cedula, omita el digito de verificación<br><br>Señor Usuario, tenga en cuenta que los datos personales suministrados en este formulario son utilizados para la respectiva certificación, por lo tanto le agradecemos revisar la gramática y ortografía del mismo antes de enviarlo.<br></p><input type="image" src="../img/salir.png" id="boton2" />'  });
	
	$("#boton2").click(function(){
				 $.blockUI({ 
					fadeIn: 1000, 
					timeout:   2000, 
					onBlock: function() { 
						
					} 
					}); 
				
				
				});	

		$("#add").click(function(event){
					var numtr = ($('#cuerpoins >tbody >tr').length/6)+1;
					
					var cupo = $("#idd").html();
					
					if(numtr <= cupo){
					
					
					var tds = '<tr><td colspan=4 ><br><br><fieldset><p><font face=Verdana size=1  ><b><i>Dando cumplimiento a la Ley 1581 y a su Decreto Reglamentario 1377 de 2013, le informamos que Usted puede ejercer sus derechos a conocer, actualizar, rectificar y solicitar la supresi&oacute;n de los datos personales en cualquier momento.</i></b></font></p><p><font face=Verdana size=1  ><b><i>La informaci&oacute;n de sus datos  la utilizaremos para: informar sobre nuestros servicios, enviar informaci&oacute;n de los eventos  y capacitaciones  ofrecidas por nuestra entidad y/o en convenio con otras organizaciones, o para realizar  estudios  sectoriales o investigaciones.</i></b></font></p><table width=70% align=center ><tr><td><input type=radio name=habeas'+numtr+' value=SI id=SI'+numtr+' />&nbsp;<font face=Verdana size=2  ><b><i>Si Autorizo recibir Informaci&oacute;n</i></b></font></td><td><input type=radio name=habeas'+numtr+' value=NO id=NO'+numtr+' />&nbsp;<font face=Verdana size=2  ><b><i>NO Autorizo recibir Informaci&oacute;n</i></b></font></td></tr></table></fieldset></td></tr><tr class='+numtr+'><td><font face="Verdana" size="2"  ><b><i>Documento<br>de Identidad:</i></b></font></td><td><br><input type="text" name=docid'+numtr+' id=docid'+numtr+' size="32" class="required number" onkeypress="javascript:return validarNro(event)" /><input type="hidden" class=docid'+numtr+' value="'+numtr+'" /><font color=red >*</font></td><td><br><font face="Verdana" size="2"  ><b><i>Cargo:</i></b></font></td><td><br><input type="text" name=cargo'+numtr+' id=cargo'+numtr+' size="32"  /></td></tr><tr class='+numtr+'><td><font face="Verdana" size="2"  ><b><i>Nombres<br>completos:</i></b></font></td><td><input type="text" name=nombres'+numtr+' id=nombres'+numtr+' size="32" class="required"  /><font color=red >*</font></td><td><font face="Verdana" size="2"  ><b><i>Apellidos<br>completos:</i></b></font></td><td><br><input type="text" name=apellidos'+numtr+' id=apellidos'+numtr+' size="32"  /><font color=red >*</font></td></tr><tr class='+numtr+'><td><font face="Verdana" size="2"  ><b><i>E-mail:</i></b></font></td><td><input type="text" name=mail'+numtr+' id=mail'+numtr+' size="32" class="required mail"  /></td><td><font face="Verdana" size="2"  ><b><i>Tel&eacute;fono:</i></b></font></td><td><input type="text" name=tel'+numtr+' id=tel'+numtr+' size="25" class="required" onkeypress="javascript:return validarNro(event)"  /><font color=red >*</font>&nbsp;<font face="Verdana" size="2"  ><b><i>Ext.</i></b></font><input type="text" name=ext'+numtr+' id=ext'+numtr+' size="4"  /></td></tr><tr class='+numtr+'><td><font face="Verdana" size="2"  ><b><i>Celular:</i></b></font></td><td><input type="text" name=cel'+numtr+' id=cel'+numtr+' size="32"  /></td><td><font face="Verdana" size="2"  ><b><i>Municipio:</i></b></font></td><td><select name=muni'+numtr+' id=muni'+numtr+'  ><option>---Seleccione---</option><option>CALDAS</option><option>ENVIGADO</option><option>ITAGUI</option><option>LA ESTRELLA</option><option>SABANETA</option><option>MEDELLIN</option></td></tr><tr><td><font face="Verdana" size="2"  ><b><i>Comentario:</i></b></font></td><td colspan="3"><textarea name=coment'+numtr+' id=coment'+numtr+' rows="2" cols="80" id="es" ></textarea></td></tr> ';
					
					$("#cuerpoins").append(tds); 
					$("#ctrl").attr('value',numtr);
					
							$('input').bind('blur', function() {
      
								$(this).val(function(i, val) {
								return val.toUpperCase();
								});
    
							});
							
							  $('.mail').bind('blur', function() {
      
									
									
									var mail = $(this).val();
		var filter = /[\w-\.]{3,}@([\w-]{2,}\.)*([\w-]{2,}\.)[\w-]{2,4}/;
		//alert(mail);
		if (filter.test(mail)){
                 $(".note").remove();
				 $(".falta2").removeClass();
				 $(this).val(function(i, val) {
									return val.toLowerCase();
									});
				}
        else{
              
				 $(this).addClass("falta2").after("<br class=note ><span class=note >Correo Invalido</span>");
				}
    
								});
								
					$(".number").bind('blur', function(){
						var id = $(this).val();
						var ctrl = $(this).attr('id');
						//alert(ctrl);
						var v = $('.'+ctrl).val();
						//alert(v);
						$.ajax({
							url: '../js/setasis.php',
							type: 'POST',
							data: {ced:id , v:v},
							success: function( data ){
								var obj = eval ( "(" + data + ")" );
				
									if(obj.sw == 1){
										$('#nombres'+obj.ctrl).attr('value',obj.nom);
										$('#apellidos'+obj.ctrl).attr('value',obj.ape);
										$('#cargo'+obj.ctrl).attr('value',obj.car);
										$('#coment'+obj.ctrl).attr('value',obj.coment);
										$('#'+obj.habeas+obj.ctrl).attr('checked',true);
										$('#mail'+obj.ctrl).attr('value',obj.mail);
										$('#tel'+obj.ctrl).attr('value',obj.tel);
										$('#ext'+obj.ctrl).attr('value',obj.ext);
										$('#cel'+obj.ctrl).attr('value',obj.cel);
										$('#muni'+obj.ctrl).append('<option selected>'+obj.mun+'</option>');
										$("#newasi").html('');
								}else{
									$("#newasi").append('<font size=3 color=red >'+id+' es un Usuario Nuevo, Por favor Ingrese la Informacion Correcta para este Documento<br>');
					                              
					                               // $('.cl'+v).attr('value','');
					                                /*$("#divasi").html('');
						                        $('#docid'+v).attr('value',id);*/
								}
							}
						})
						return false;
					});
					}else{
						$.blockUI({ message: '<h3><img src=../img/bad.png width=50 height=50 /><br>Para este evento usted puede registrar maximo 3 participantes.</h3>' });
						setTimeout($.unblockUI, 3000); 
					}
					
					});	

		$("#delete").click(function(){
			var del = $("#ctrl").val();
			if( del != 1){
			$('.'+del+'').remove();
			var ctrm = del-1;
			$("#ctrl").attr('value',ctrm);
			}
		});
				
 $('input').bind('blur', function() {
      
    $(this).val(function(i, val) {
      return val.toUpperCase();
    });
    
  });
  $('textarea').bind('blur', function() {
      
    $(this).val(function(i, val) {
      return val.toUpperCase();
    });
    
  });
  
  $('.mail').bind('blur', function() {
      
    $(this).val(function(i, val) {
      return val.toLowerCase();
    });
	
	var mail = $(this).val();
		var filter = /[\w-\.]{3,}@([\w-]{2,}\.)*([\w-]{2,}\.)[\w-]{2,4}/;
		//alert(mail);
		if (filter.test(mail)){
                 $(".note").remove();
				 $(".falta2").removeClass();
				}
        else{
              
				 $(this).addClass("falta2").after("<br class=note ><span class=note >Correo Invalido</span>");
				}
		
    
  });
  
 
  
  $("#boton").mouseover(function(){
	$(this).attr("src","../img/button-2.png");
	});
	
	$("#boton").mouseout(function(){
	$(this).attr("src","../img/button-1.png");
	});
  
  
    $("#form1").validate();
	});
	
	
	
	$(document).ready(function(){	
		
	
	$("#form1").submit(function(){
		
		$.blockUI({ message: '<h3><img src=../img/check2.png width=50 height=50 /><img src=../img/wait.gif /><img src=../img/close.png id=cls /><b><i>Por Favor Espere...<br>Estamos Procesando su Solicitud</h3><br>' });
		$('#cls').css({
			'position' : 'absolute',
			'top' : '5px',
			'right' : '5px'
		}).click(function(){
			 setTimeout($.unblockUI, 1000); 
		});
		$.ajax({
			url: "../insert/inscripcrm.php",
			type: "POST",
			data: $("#form1").serialize(),
			success: function ( data ){
			
				 var obj = eval( "(" + data + ")" );
				 
				 
			if(obj.enviar == 1){
			
			$.blockUI({ message: '<h3><img src=../img/check2.png width=50 height=50 />'+obj.mensaje+'</h3><br><input type="image" src="../img/salir.png" id="salida" />' });
				
				//setTimeout($.unblockUI, 4000); 
				$("#salida").click(function(){
				
					$('#form1').each (function(){
					this.reset();
					$("#boton").remove();
					
					})
					
					window.location="http://www.ccas.org.co";
					
				});
				
				
			}
			if(obj.enviar == 2){
			$.blockUI({ message: '<h3><img src=../img/bad.png /><br>'+obj.mensaje+'.</h3>' });
			setTimeout($.unblockUI, 5000); 
			
			
			}
			
			}
		})
		return false;
		
	})
	
	$("#logout").click(function(){
		alert("Gracias por Visitarnos.");
		window.location="http://www.ccas.org.co";
	});
	
	$(".tid").click(function(){
		var type = $(this).val();
		
		if( type == 'nit' ){
			$(".nit").show("fast");
		}else{
			$(".nit").hide("fast");
		}
	});
	
	$("#all").change(function(){
		var ch = $(this).attr('checked');
		
		if( ch == 1 ){
			$(".allmod").attr('checked',ch);
		}else{
			$(".allmod").attr('checked',ch);
		}
	});
	
	//buscador de empresas
	/*
	$(".searchnit").click(function(){
		$("#result").html('');
		var type = $(this).attr('value');
		var id = $("#s"+type).val();
		var idev = $("#idevent").attr('value');
		if( id != '' ){
			$("#result").load('../js/search.php?id='+id+'&idev='+idev+'&type='+type);
		}else{
			alert("Debe Indicar un Identificador");
		}
	});*/
	
	$(".number").bind('blur', function(){
		var id = $(this).val();
		var ctrl = $(this).attr('id');
		var v = $('.'+ctrl).val();
		$.ajax({
			url: '../js/setasis.php',
			type: 'POST',
			data: {ced:id , v:v},
			success: function( data ){
				var obj = eval ( "(" + data + ")" );
				
				if(obj.sw == 1){
					$("#divasi").html('');
					$('#nombres'+obj.ctrl).attr('value',obj.nom);
					$('#apellidos'+obj.ctrl).attr('value',obj.ape);
					$('#cargo'+obj.ctrl).attr('value',obj.car);
					$('#coment'+obj.ctrl).attr('value',obj.coment);
					$('#'+obj.habeas+obj.ctrl).attr('checked',true);
					$('#mail'+obj.ctrl).attr('value',obj.mail);
					$('#tel'+obj.ctrl).attr('value',obj.tel);
					$('#ext'+obj.ctrl).attr('value',obj.ext);
					$('#cel'+obj.ctrl).attr('value',obj.cel);
					$('#muni'+obj.ctrl).append('<option selected>'+obj.mun+'</option>');
					$("#newasi").html('');
				}else{
					$("#newasi").append('<font size=3 color=red >'+id+' es un Usuario Nuevo, Por favor Ingrese la Informacion Correcta para este Documento<br>');
					//$('.cl'+v).attr('value','');
					/*$("#divasi").html('');
						$('#docid'+v).attr('value',id);*/
				}
			}
		})
		return false;
	});
	
	$(".nit").bind('blur', function(){
		var nit = $(this).val();
		$.ajax({
			url: '../js/setasis.php',
			type: 'POST',
			data: {nit:nit},
			success: function( data ){
				var obj = eval ( "(" + data + ")" );
				
				if(obj.sw == 1){
					
					$('#nomemp').attr('value',obj.rsocial);
					$('#diremp').attr('value',obj.dir);
					$("#newemp").html('');
					
				}else{
					$("#newemp").append('<font size=3 color=red >'+nit+' es una Empresa Nueva, Por Favor Ingrese la Informacion Completa<br>');
					
				}
			}
		})
		return false;
	});
	
	});