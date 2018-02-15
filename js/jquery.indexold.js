$(document).ready(function() {
	
	 var refreshId = setInterval(refrescar, 100000);
	$.ajaxSetup({ cache: false });
	
	function refrescar(){
		var pass = $("#divpass").val();
		var user = $("#divuser").val();
		
		$.ajax({
			url: "./insert/login.php",
			type: "POST",
			data: {pass:pass,user:user},
			success: function ( data ){
				var obj = eval ( "(" + data + ")" );
				$("#divperf").attr('value',obj.perfil);
				
			}
		})
		return false;
			
			
	}
	
	$('.required').bind('blur', function() {
		var up = $(this).val().toUpperCase();
		$(this).attr('value',up);
	});
  
	$("#select1").load('./js/eventos.php');
	$("#select2").load('./js/event_closed.php');
	$("#tb").load('./js/listados.php');
	
	/**/
  $("#refresh").click(function(){
	
		$('#tb').fadeOut("slow").load('./js/listados.php').fadeIn("slow");
	
   });
  
  $("#boton").mouseover(function(){
	$(this).attr("src","./img/button-3.png");
	});
	
	$("#boton").mouseout(function(){
	$(this).attr("src","./img/button-4.png");
	});
	
	$("#boton2").mouseover(function(){
	$(this).attr("src","./img/button-log2.png");
	});
	
	$("#boton2").mouseout(function(){
	$(this).attr("src","./img/button-log.png");
	});

	$("#boton3").mouseover(function(){
	$(this).attr("src","./img/button-cl2.png");
	});
	
	$("#boton3").mouseout(function(){
	$(this).attr("src","./img/button-close.png");
	});
	
	$("#boton4").mouseover(function(){
	$(this).attr("src","./img/button-c2.png");
	});
	
	$("#boton4").mouseout(function(){
	$(this).attr("src","./img/button-c.png");
	});

	
	
	$("ul.tabs li").click(function() {
		$(".selectboxes").attr('selectedIndex',0);
		$('#fl2').text('');
		$('#divpay').text('');
		$('#divasis').text('');
		$("ul.tabs li").removeClass("active"); 
		$(this).addClass("active"); 
		$(".tab_content").hide(); 
		var activeTab = $(this).find("a").attr("href"); 
		$(activeTab).fadeIn(); 
		return false;
		
	});
	
	

 
});



$(document).ready(function(){


	$("#form1").validate();
	


    $("#form1").submit(function(){
		
		
		$.ajax({
			url: "./insert/event.php",
			type: "POST",
			data: $('#form1').serialize(),
			success: function ( data ){
			
				 var obj = eval( "(" + data + ")" );
			if(obj.enviar == 1){
				
			$.blockUI({ message: '<h3><img src=./img/check2.png /><br>Registro Exitoso.<br>a Continuacion podras visualizar el link del formulario de registro</h3>' });
				$("#link").remove();
				$("#mail2").load('./insert/mail.php?cod='+obj.capa);
				$("#mail").append("<input type=text size=100 name=link id=link value='http://inscripciones.ccas.co/maestro/confor3.php?cod="+obj.capa+"'/>");
				 $('#link').focus();
				setTimeout($.unblockUI, 4000); 
				
				$("#select1").load('./js/eventos.php');
				$("#tb").load('./js/listados.php');
				
				
				
				$('#form1').each (function(){
					this.reset();
					
				})
				$('#images').attr('src','./img/back.png');
				
				
			}
			if(obj.enviar == 2){
			$.blockUI({ message: '<h3><img src=./img/bad.png /><br>Los Datos Son Incorrectos.<br> Por Favor Verificarlos.</h3>' });
			setTimeout($.unblockUI, 3000); 
			
			
			}
			
			}
		})
		return false;
		
	})
	
	 $("#form2").submit(function(){
	        var pass = $("#pass").val();
		var user = $("#user").val();
		$("#divpass").attr('value',pass);
		$("#divuser").attr('value',user);
		$.ajax({
			url: "./insert/login.php",
			type: "POST",
			data: $('#form2').serialize(),
			success: function ( data ){
			
				 var obj = eval( "(" + data + ")" );
			if(obj.enviar == 1){
								
			$.blockUI({ message: '<h3><img src=./img/check2.png />Bienvenido.</h3>' });				
				setTimeout($.unblockUI, 2000); 
				
				if( (obj.perfil == 1) || (obj.perfil == 0) ){
					$(".workadmin").attr('style','display:block');
					if(obj.perfil != 0){
						$("select#objet option").filter("[value='2']").remove();
					}
					
				}else{
					$('.user2').remove();
					$(".tab_content").hide(); 
					$("ul.tabs li:first").addClass("active").show(); 
					$(".tab_content:first").show(); 
				}
				
				$(".work").show("slow");
				
				$("#sht").show();
				$("#login").remove();
				$("#sht").attr('href','./cerrar.php');
				
			}
			if(obj.enviar == 0){
			$.blockUI({ message: '<h3><img src=./img/bad2.png /><br>Los Datos Son Incorrectos.<br> Por Favor Verificarlos.</h3>' });
			setTimeout($.unblockUI, 3000); 
			
			
			}
			
			}
		})
		return false;
	
	});
	
	$("#form3").submit(function(){
	
	
	$.ajax({
			url: "./insert/closed.php",
			type: "POST",
			data: $('#form3').serialize(),
			success: function ( data ){
			
				 var obj = eval( "(" + data + ")" );
			if(obj.enviar == 1){
								
			$.blockUI({ message: '<h3><img src=./img/check2.png />Evento '+obj.capa+'<br>Se Cerro Exitosamente.</h3>' });				
				setTimeout($.unblockUI, 2000); 
				
				$("#select1").load('./js/eventos.php');
				$("#select2").load('./js/event_closed.php');
				
			}
			if(obj.enviar == 2){
			$.blockUI({ message: '<h3><img src=./img/bad.png /><br>Se Produjo un Error al Cerrar el Evento Seleccionado.</h3>' });
			setTimeout($.unblockUI, 3000); 
			
			
			}
			
			}
		})
	return false;
	});
	
	$("#select2").change(function(){
				
				$("#list2").remove();
				
				var id=$(this).val();
				
				$("#fl2").append("<div id=imagen><a href=./informes/event_closed.php?cod="+id+" id=list2 ><img src='./img/lists.png' class=list22 title='Ver listado de Asistentes' width=50 /><br>Ver Listado</a></div>");
			
	});
		
	$("#resp").change(function(){
		var id = $(this).val();
		
		if( id == 2){
			$(".mailresp").show("fast");
		}else{
			$(".mailresp").hide("fast");
		}
	});	
	
	$("#add").click(function(){
		var num = ($('#tabmod tbody tr').length)+1;
		//alert(num);
		var tr = "<tr><td><input type=text name=fmod"+num+" size=15 class=fecha /></td><td><input type=text name=modu"+num+" size=80 /></td></tr>";
		$('#tabmod tbody').append(tr);
		$('#tabmod tbody tr:even').css('background-color','#ddd');
		$('#ctrlmod').attr('value',num);
		$(".fecha").datepicker({
			//showOn: 'both',
			buttonImage: 'calendar.png',
			buttonImageOnly: true,
			changeYear: true,
			numberOfMonths: 1,
      
		});
	});
	
	$(".modulo").click(function(){
		var val = $(this).val();
		if( val == 'SI' ){
			$("#mod").show("fast");
		}else{
			$("#mod").hide("fast");
		}
	});
	
	/*$("#paypal").click(function(){
	
		$.blockUI({ message: '<form id=payform ><img src=./img/close.png id=cls /><br><input type=text name=testpay /><button>Aceptar</button>  </form>',
								css: { 
										top:  ($(window).height() - 400) /2 + 'px', 
										left: ($(window).width() - 800) /2 + 'px', 
										width: '800px' 
									} });
		$("#cls").css({
			'position' : 'absolute',
			'top' : '5px',
			'right' : '5px'
		}).click(function(){
			 $.blockUI({ 
					fadeIn: 1000, 
					timeout:   2000, 
					onBlock: function() { 
						$("#payform").each(function(){
							this.reset();
						});
					} 
					});
		});
		
		
	});*/
	
	$("#payevent").change(function(){
		var idev = $(this).val();
		//alert(nit);
		$("#divpay").load("./js/paylist.php?idev="+idev);
		
	});
	
	$("#divpay").submit(function(){
			$.ajax({
				url: './insert/insertpay.php',
				type: 'POST',
				data: $(this).serialize(),
				success: function( data ){
					var pay = eval ( "(" + data + ")" );
					//alert(pay.idev);
					$("#divpay").fadeOut('slow').load("./js/paylist.php?idev="+pay.idev).fadeIn('slow');
				}
			})
			return false;
			
		});
	$("#asiseve").change(function(){
		var eve = $(this).val();
		
		$.ajax({
			url: './js/eventmod.php',
			type: 'POST',
			data: {event:eve},
			success: function ( data ) {
				var obj = eval ( "(" + data + ")" );
				
				if( obj.resp == 'SI'){
					$("#asismod").load('./js/modasis.php?eve='+eve);
					$(".asismod").show('fast');
					$("#divasis").text('');
					
				}else{
					$("#divasis").load('./js/listasist.php?ideve='+eve+'&type=1&n=0&pago='+obj.pago);
					$(".asismod").hide('fast');
				}
				
				
			}
		
		})
		return false;
	});
	
	$("#asismod").change(function(){
		var eve = $("#asiseve").val();
		var mod = $(this).val();
		$("#divasis").load('./js/listasist.php?ideve='+eve+'&idmod='+mod+'&type=2');	
	});
	
	
	//para cambiar al modulo de edicion
	$("#divasis").submit(function(){
		var ideve = $("#ideve").attr('value');
		var idmod = $("#idmod").attr('value');
		$.ajax({
			url: './insert/updateasis.php',
			type: 'POST',
			data: $(this).serialize(),
			success: function ( datos ) {
				var objx = eval ( "(" + datos + ")" );
				
				if( objx.sw == true ){
							
					$.blockUI({ message: '<h3><img src=./img/check2.png /><br>'+objx.msn+'</h3>' });
					setTimeout($.unblockUI, 3000); 
				}else{
					alert("Ocurrio un Problema Durante la Cancelacion de la Inscripcion, Por Favor Comuniquese con el Administrador del Sistema");
					$.blockUI({ message: '<h3><img src=./img/bad.png /><br>'+objx.msn+'</h3><img src=./img/close.png id=cls />' });
					$("#cls").css({
			'position' : 'absolute',
			'top' : '5px',
			'right' : '5px'
		}).click(function(){
			 $.blockUI({ 
					fadeIn: 1000, 
					timeout:   2000, 
					
					});
		});
				}
				
			}
		})
		return false;
	});
	
	
	$("#asiseve2").change(function(){
		var eve = $(this).val();
		
		$.ajax({
			url: './js/eventmod.php',
			type: 'POST',
			data: {event:eve},
			success: function ( data ) {
				var obj = eval ( "(" + data + ")" );
				
				if( obj.resp == 'SI'){
					$("#asismod2").load('./js/modasis.php?eve='+eve);
					$(".asismod").show('fast');
					$("#divasis").text('');
					
				}else{
					$("#divasis2").load('./js/listcert.php?ideve='+eve+'&type=1');
					$(".asismod").hide('fast');
				}
				
				
			}
		
		})
		return false;
	});
	
	$("#asismod2").change(function(){
		var eve = $("#asiseve2").val();
		var mod = $(this).val();
		$("#divasis2").load('./js/listcert.php?ideve='+eve+'&idmod='+mod+'&type=2');	
	});
	
	$("#arefresh").click(function(){
		var eve = $("#asiseve").val();
		var pay = $("#pago").val();
		var mod = $(this).val();
		
		
		if( mod > 0 ){
			$("#divasis").fadeOut('slow').load('./js/listasist.php?ideve='+eve+'&idmod='+mod+'&type=2').fadeIn('slow');
		}else{
			$("#divasis").fadeOut('slow').load('./js/listasist.php?ideve='+eve+'&type=1&pago='+pay).fadeIn('slow');
		}
		
			
	});
	$("#arefresh2").click(function(){
		var eve = $("#asiseve2").val();
		var mod = $(this).val();
		
		
		if( mod > 0 ){
			$("#divasis2").fadeOut('slow').load('./js/listcert.php?ideve='+eve+'&idmod='+mod+'&type=2').fadeIn('slow');
		}else{
			$("#divasis2").fadeOut('slow').load('./js/listcert.php?ideve='+eve+'&type=1').fadeIn('slow');
		}
		
			
	});
	
	/*$("#divasis").submit(function(){
		var id = $('#vlr').attr('value');
		var idced = $('#id'+id).attr('value');
		var nom = $('#nom'+id).attr('value');
		var ape = $('#ape'+id).attr('value');
		var mail = $('#mail'+id).attr('value');
		//alert(idced+nom+ape+mail);
		/*$(this).fadeOut('slow').load('./js/updateasis.php?id='+idced+'&nom='+nom+'&ape='+ape+'&mail='+mail).fadeIn('slow')
		return false;
	});*/
	$("#search").click(function(){
		var id = $("#idcert").attr('value');
		var ideve =  $("#asiseve2").attr('value');
		var idmod =  $("#asismod2").attr('value');
		
		if( ideve != 0 ){
			$.ajax({
			url: './js/eventmod.php',
			type: 'POST',
			data: {event:ideve},
			success: function ( data ) {
				var obj = eval ( "(" + data + ")" );
				
				if( obj.resp == 'SI'){
					if( idmod != 0 ){
						if( id != 'Identificacion' ){
							open('./sqlpdf/certifica.php?ideve='+ideve+'&idmod='+idmod+'&tp=2&idasis='+id, '_blank');
						}else{
							alert("Por Favor Digite una Identificacion");
							$("#idcert").focus();
						}						
					}else{
						alert("Por Favor Seleccione un Modulo");
					}					
				}else{
					if( id != 'Identificacion' ){
							open('./sqlpdf/certifica.php?ideve='+ideve+'&tp=1&idasis='+id, '_blank');
						}else{
							alert("Por Favor Digite una Identificacion");
							$("#idcert").focus();
						}				
					
				}
				
				
			}
		
		})
		return false;
		}else{
			alert("Por Favor Seleccione un Evento");
		}
		
		
	});
	$("#searchesc").click(function(){
		var id = $("#s1").attr('value');
		var ideve =  $("#asiseve").attr('value');
		var idmod =  $("#asismod").attr('value');
		
		if( ideve != 0 ){
			$.ajax({
			url: './js/eventmod.php',
			type: 'POST',
			data: {event:ideve},
			success: function ( data ) {
				var obj = eval ( "(" + data + ")" );
				
				if( obj.resp == 'SI'){
					if( idmod != 0 ){
						if( id != 'Identificacion' ){
							open('./sqlpdf/escarapela.php?ideve='+ideve+'&idmod='+idmod+'&tp=2&idasis='+id, '_blank');
						}else{
							alert("Por Favor Ingrese una Identificacion");
							$("#idcert").focus();
						}						
					}else{
						alert("Por Favor Seleccione un Modulo");
					}					
				}else{
					open('./sqlpdf/escarapela.php?ideve='+ideve+'&tp=1&idasis='+id, '_blank');
				}
				
				
			}
		
		})
		return false;
		}else{
			alert("Por Favor Seleccione un Evento");
		}
		
		
	});
	
	$(".searchnit").click(function(){
		var n = $(this).attr('value');
		var id = $("#s"+n).val();
		var pay = $("#pago").val();
		var objet = $("#objet").attr('value');
		//alert(n);
		var ideve = $("#asiseve").val();
		var idmod = $("#asismod").val();
		if( n == 3 || n == 4 ){
			/*$.ajax({
				url: './js/setasis.php',
				type: 'POST',
				data: {n:n,objet:objet,id:id},
				success: function ( datax ){
					var objt = eval ( "(" + datax + ")" );
					
					if( objt.sw == 1 ){
						$("#searchresult").load('<font size=3 >'+objt.s1+'</font>');
					}else{
					
					}
				}
			})
			return false;*/
			
			$("#searchresult").load('./js/find.php?n='+n+'&objet='+objet+'&id='+id);
			
		}else{
		if ( ideve != 0 ){
			/*if ( idmod != 0 ){
				if( id != 'Identificacion' ){
				$("#divasis").load('./js/listasist.php?ideve='+ideve+'&idmod='+idmod+'&id='+id+'&type=2&pago='+pay);
				}else{
					alert("Por Favor Ingrese una Identificacion");
					$("#s1").focus();
				}
				
			}else{
				$("#divasis").load('./js/listasist.php?ideve='+ideve+'&id='+id+'&type=1&pago='+pay);
			}*/
			$.ajax({
			url: './js/eventmod.php',
			type: 'POST',
			data: {event:ideve},
			success: function ( data ) {
				var obj = eval ( "(" + data + ")" );
				
				if( obj.resp == 'SI'){
					if( idmod != 0 ){
						if( id != 'Identificacion' ){
							$("#divasis").load('./js/listasist.php?ideve='+ideve+'&idmod='+idmod+'&id='+id+'&n='+n+'&type=2');
						}else{
							alert("Por Favor Ingrese una Identificacion");
							$("#s1").focus();
						}						
					}else{
						alert("Por Favor Seleccione un Modulo");
					}					
				}else{
					$("#divasis").load('./js/listasist.php?ideve='+ideve+'&id='+id+'&n='+n+'&type=1');
				}
				
				
			}
		
		})
		return false;
		}else{
			alert("Por Favor Seleccione Un Evento");
		}
		}
	});
	
	$(".idsearch").focus(function(){
		var cont = $(this).val();
		if(cont == 'Identificacion' || cont == 'Nombre' || cont == 'Codigo' || cont == 'Apellidos' ){
		$(this).attr('value','').removeClass('lett');
		$(this).bind('blur' , function(){
		var mtz = $(this).attr('value');
		if( mtz == ''){
			$(this).attr('value',cont).addClass('lett');
		}
		
		});
		}
	});
	
	
	$(".certi").click(function(){
		var ch = $(this).attr('value');
		
		if( ch == 1 ){
			$("#cert").attr('style','display:block');
		}else{
			$("#cert").attr('style','display:none');
		}
	});
	
	$(".certi2").click(function(){
		var ch = $(this).attr('value');
		
		if( ch == 1 ){
			$("#cert2").attr('style','display:block');
		}else{
			$("#cert2").attr('style','display:none');
		}
	});
	
	$(".fecha").datepicker({
			//showOn: 'both',
			buttonImage: 'calendar.png',
			buttonImageOnly: true,
			changeYear: true,
			numberOfMonths: 1,
      
		});
		
		
				$('.sample2 input').ptTimeSelect();
	//Subir formulario para actualizaciones
	
	$("#searchresult").submit(function(){
		$.ajax({
			url: './insert/updateasis.php',
			type: 'POST',
			data: $(this).serialize(),
			success: function( data ){
				var obj = eval ( "(" + data + ")" );
				
				if( obj.sw == true ){
							
					$.blockUI({ message: '<h3><img src=./img/check2.png /><br>'+obj.msn+'</h3>' });
					setTimeout($.unblockUI, 3000); 
					$("#searchresult").html('');
				}else{
					//alert("Ocurrio un Problema Durante la Cancelacion de la Inscripcion, Por Favor Comuniquese con el Administrador del Sistema");
					$.blockUI({ message: '<h3><img src=./img/bad.png /><br>'+obj.msn+'</h3><img src=./img/close.png id=cls />' });
					$("#cls").css({
			'position' : 'absolute',
			'top' : '5px',
			'right' : '5px'
		}).click(function(){
			 $.blockUI({ 
					fadeIn: 1000, 
					timeout:   2000, 
					onBlock: function() { 
						
					} 
					});
		});
				}
			}
		})
		return false;
	});
	
  });