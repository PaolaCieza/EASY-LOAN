function inicio(){
	$("#msg-capt").hide();
	listarPrestamos(1);
}

var montoPagar;

function iniciarSesion(a){
	if(a==0){
		var user = $("#txtusuario").val();
		$.ajax({
		  url: '../php/login.php',
		  type: 'post',
		  data: {"txtuser":user, "a":1},
		  success: function( data ){
			if(data == 1){
				window.location.href="../html/iniciarsesion2.php" ;
			}
			else{
				Swal.fire({
					title: '¡Usuario no encontrado!',
					text: "Revisa bien tus datos o registrate",
					type: 'error',
					showCancelButton: false,
					confirmButtonColor: '#FF4242',
					//cancelButtonColor: '#d33',
					confirmButtonText: 'Volver a intentar'
				  }).then((result) => {
					if (result.value) {
					  //location.reload();
					}
					else{
					  //window.location.href="login.html";
					}
				  })  
			}
		  },
		  error: function( jqXhr, textStatus, error ){
			  console.log( error );
		  }
	  });
	}
	else{
		var pass = $("#txtcontraseña").val();
		$.ajax({
		  url: '../php/login.php',
		  type: 'post',
		  data: {"txtpass":pass,"a":2},
		  success: function( data ){
			if(data == 1){
				Swal.fire({
					title: '¡Bienvenido!',
					text: "Disfruta de tu estadia",
					type: 'success',
					showCancelButton: false,
					confirmButtonColor: '#3085d6',
					//cancelButtonColor: '#d33',
					confirmButtonText: 'Aceptar'
				  }).then((result) => {
					if (result.value) {
					  window.location.href="../index.html";
					}
					else{
					  window.location.href="../index.html";
					}
				  }) 
			}
			else{
				Swal.fire({
					title: '¡Error al iniciar sesion!',
					text: "Revisa bien tus datos",
					type: 'error',
					showCancelButton: false,
					confirmButtonColor: '#FF4242',
					//cancelButtonColor: '#d33',
					confirmButtonText: 'Volver a intentar'
				  }).then((result) => {
					if (result.value) {
						//window.location.href="persona.php";
					}
					else{
					  //window.location.href="login.html";
					}
				  })  
			}
		  },
		  error: function( jqXhr, textStatus, error ){
			  console.log( error );
		  }
	  });
	}
  }


function solonumeros(e,id,cant){
	var numero = $(id).val();
	var key = e.keyCode;
	if (key < 48 || key > 57 || numero.length>=cant) {
		e.preventDefault();
	}
	
}

function soloDecimales(e,id,cant){
	var numero = $(id).val();
	var key = e.keyCode;
	
	if ((key < 48 && key > 46) || key > 57 || key==190 || key < 46 || numero.length>=cant) {
		e.preventDefault();
	}
	
}
function sinespacios(e){
	var key = e.keyCode;
	if (key == 32) {
		e.preventDefault();
	}
	
}
function validar(){
    var forms = document.getElementsByClassName('needs-validation');
    var validation = Array.prototype.filter.call(forms, function(form) {
        if (form.checkValidity() == false) {
          event.preventDefault();
          event.stopPropagation();
          //console.log(valuser());
		  captcha();
		  valuser();
        }
        else{
		  var response = grecaptcha.getResponse();
		  //console.log(valuser());
          if(response.length != 0 && valuser()){
			registrar();
		  }
		  else{
			captcha();
			//valuser();
			//console.log(valuser());
		  }  
        }
        form.classList.add('was-validated');
        });
}

function captcha(){
    setInterval(function(){
      var response = grecaptcha.getResponse();
      if(response.length == 0){
        $("#msg-capt").show();
      } else {
        $("#msg-capt").hide();
      }

    },100);
}

var valid;
function valuser(){
	var usuario = $("#txtusuario").val();
	if(usuario !== ""){
		$.ajax({
			url: '../php/registrar.php',
			type: 'post',
			data: {"validar": 1,"txtusuario":usuario},
			success: function( data ){
			  //console.log(data);
			  if(data == 1){
				$("#msg-e2").show();
				$("#msg-e1").hide();
				$("#msg-s").hide();
				$("#txtusuario").toggleClass("is-invalid", true);
				$("#txtusuario").toggleClass("is-valid",false);
				valid = false;
			  }else{
				$("#msg-s").show();
				$("#msg-e1").hide();
				$("#msg-e2").hide();
				$("#txtusuario").toggleClass("is-valid",true);
				$("#txtusuario").toggleClass("is-invalid", false);
				valid = true;
			  }
			 
			},
			error: function( jqXhr, textStatus, error ){
				console.log( error );
			}
		});
	}
	else{
		$("#msg-e1").show();
		$("#msg-s").hide();
		$("#msg-e2").hide();
		$("#txtusuario").toggleClass("is-invalid", true);
		$("#txtusuario").toggleClass("is-valid",false);
		valid = false;
	}
	return valid;
}


function registrar(){
		var nombre = $("#txtnombre").val();
		var apellidos = $("#txtapellidos").val();
		var dni = $("#txtdni").val();
		var fecha = $("#txtfecha").val();
		var sexo = $("input:radio[name=txtsexo]:checked").val();
		var correo = $("#txtcorreo").val();
		var usuario = $("#txtusuario").val();
		var contraseña = $("#txtcontraseña").val();
		$.ajax({
		  url: '../php/registrar.php',
		  type: 'post',
		  data: {"validar": 0 ,"txtnombre":nombre, "txtapellidos":apellidos, "txtdni":dni, 
		  "txtfecha":fecha, "txtsexo":sexo,"txtcorreo":correo, "txtusuario":usuario,
		   "txtcontraseña":contraseña},
		  success: function( data ){
			console.log(data);
			if(data == 1){
				Swal.fire({
					title: '¡REGISTRADO CORRECTAMENTE!',
					text: "Felicidades te acabas de unir a la familia de EASY LOAN, ya puedes uniciar sesión",
					type: 'success',
					showCancelButton: false,
					confirmButtonColor: '#3085d6',
					confirmButtonText: 'OK'
				  }).then((result) => {
					if (result.value) {
						window.location.href="../html/iniciarsesion.php";
					}
					else{
						window.location.href="../html/registrarse.php";
					}
				  })  
			}else{
				Swal.fire({
					title: '¡ERROR AL REGISTRAR!',
					text: "No se pueden registrar personas menores de 18 años",
					type: 'error',
					showCancelButton: false,
					confirmButtonColor: '#FF4242',
					confirmButtonText: 'OK NO LOS VUELVO A JODER POBRES'
				  }).then((result) => {
					if (result.value) {
						// window.location.href="../index.html";
					}
					else{
						// window.location.href="../index.html";
					}
				  })  
			}
			//Limpiar();
		  },
		  error: function( jqXhr, textStatus, error ){
			  console.log( error );
		  }
	  });
	
}


function Limpiar()
{
    $("#txtnombre").val("");
    $("#txtapellidos").val("");
    $("#txtdni").val("");
    $("#txtfecha").val("");
    $("#txtsexo").val("");
    $("#txtcorreo").val("");
    $("#txtusuario").val("");
    $("#txtcontraseña").val("");
}


function editarPerfil(){
    $.ajax({
        url: 'editarUsuario.php',
        dataType: 'text',
        type: 'post',
        data: {'id': id },
        success: function( data ){
            var datos = JSON.parse(data);
            // $("#divform").modal("toggle");
            $("#idproducto").val(datos.idproducto);
            $("#txtnombre").val(datos.nombre);
            $("#txtprecio").val(datos.precio);
            $("#txtfecha").val(datos.fecha_vencimiento);
            $("#cbopresentacion").val(datos.idpresentacion);
            $("#cbocategoria").val(datos.idcategoria);

            console.log(data);
        },
        error: function( jqXhr, textStatus, errorThrown ){
            console.log( errorThrown );
        }
    });
}

function listarPrestamos(pag){
	$.ajax({
        url: '../php/listarPrestamos.php',
        type: 'post',
        data: {'pag':pag},
        success: function( data ){
        	$("#registros").html(data);
        },
        error: function( jqXhr, textStatus, error ){
            console.log( error );
        }
    });
    paginacion();
}

function paginacion(){
	$.ajax({
        url: '../php/paginacionPrestamos.php',
        type: 'post',
        data: {},
        success: function( data ){
        	$("#divpaginas").html(data);
        },
        error: function( jqXhr, textStatus, error ){
            console.log( error );
        }
    });
}

function listarRespuestas(){
	$.ajax({
        url: '../php/listarRespuestas.php',
        type: 'post',
        data: {},
        success: function( data ){
        	$("#respuestas").html(data);
        },
        error: function( jqXhr, textStatus, error ){
            console.log( error );
        }
    });
}

function mostrarNivel(){
	$.ajax({
        url: '../php/mostrarNivel.php',
        type: 'post',
        data: {},
        success: function( data ){
        	$("#nivel").html(data);
        },
        error: function( jqXhr, textStatus, error ){
            console.log( error );
        }
    });
}

function aceptarRespuesta(id){
	Swal.fire({
		title: '¿Estás seguro?',
		text: "Al aceptar se registrará el prestamo",
		type: 'warning',
		showCancelButton: true,
		confirmButtonColor: '#328FE1',
		cancelButtonColor: '#d33',
		confirmButtonText: 'Aceptar',
		cancelButtonText: 'Cancelar'
	  }).then((result) => {
		if (result.value) {
			$.ajax({
				url: '../php/aceptarRespuesta.php',
				type: 'post',
				data: {'id':id},
				success: function( data ){
					console.log( data );
					if(data==1){
						Swal.fire({
							title: '¡Registrado corectamente!',
							type: 'success',
							showCancelButton: false,
							confirmButtonColor: '#328FE1',
							confirmButtonText: 'Ok'
						  }).then((result) => {
							if (result.value) {
								location.reload();
							}
							else{
								location.reload();
							}
						  })  
						
					}
					else{
						Swal.fire({
							type: 'error',
							title: 'Ocurrio un error',
							text: 'Algo salió mal',
						  })
					}
				},
				error: function( jqXhr, textStatus, error ){
					console.log( error );
				}
			});
		}
	  })
	
}

function datosSolicitar(){
	$.ajax({
        url: '../php/datosSolicitarPrestamo.php',
        type: 'post',
        data: {},
        success: function( data ){
			datos = JSON.parse(data);
        	$("#recipient-name").val(datos[0]);
        	$("#message-text").val(datos[1]);
        },
        error: function( jqXhr, textStatus, error ){
            console.log( error );
        }
    });
}

function validarSolicitud(){
	var monto = $("#txtmonto").val();
	var periodo = $("select[name=periodo]").val();
	var cuotas = $("select[name=cuotas]").val();
	if(monto != ''){
		if(periodo != null){
			if(cuotas != null){
				$.ajax({
					url: '../php/validarSolicitud.php',
					type: 'post',
					data: {},
					success: function( data ){
						//console.log(data);
						//console.log(monto);
						if( parseFloat(monto)>=20.0 && parseFloat(monto)<=data){
							resgistrarSolicitud(monto,periodo,cuotas);
						}
						else{
							Swal.fire({
								type: 'warning',
								title: 'Cuidado',
								text: 'Monto no permitido',
							});
						}
					},
					error: function( jqXhr, textStatus, error ){
						console.log( error );
					}
				});
			}
			else{
				Swal.fire({
					type: 'warning',
					title: 'Cuidado',
					text: 'Seleccione la cantidad de cuotas',
				});
			};
		}
		else{
			Swal.fire({
				type: 'warning',
				title: 'Cuidado',
				text: 'Seleccione un periodo',
			});
		};
	}
	else{
		Swal.fire({
			type: 'warning',
			title: 'Cuidado',
			text: 'Complete el monto',
		  });
	}
}

function permitirSolicitud(){
	$.ajax({
        url: '../php/permitirSolicitud.php',
        type: 'post',
        data: {},
        success: function( data ){
			if(data == 1){
				$('#modalPrestamoSoli').modal('show');
				datosSolicitar();
			}
        	else{
				Swal.fire({
					type: 'error',
					title: 'Vaya :(',
					text: 'No puedes realizar solicitudes en este momento',
				  });
			}
        },
        error: function( jqXhr, textStatus, error ){
            console.log( error );
        }
    });
	
}

function resgistrarSolicitud(m,p,c){
	$.ajax({
        url: '../php/registrarSolicitud.php',
        type: 'post',
        data: {'monto':m,'periodo':p,'cuotas':c},
        success: function( data ){
			if(data==1){
				Swal.fire({
					title: '¡Solicitud enviada!',
					type: 'success',
					showCancelButton: false,
					confirmButtonColor: '#328FE1',
					confirmButtonText: 'Ok'
				  }).then((result) => {
					if (result.value) {
						location.reload();
					}
					else{
						location.reload();
					}
				  })  
				
			}
			else{
				Swal.fire({
					type: 'error',
					title: 'Ocurrio un error',
					text: 'Algo salió mal',
				  })
			}
        },
        error: function( jqXhr, textStatus, error ){
            console.log( error );
        }
    });
}

function listarCuotas(idprestamo){
	$.ajax({
        url: '../php/listarCuotas.php',
        type: 'post',
        data: {'idprestamo':idprestamo},
        success: function( data ){
        	$("#listacuotas").html(data);
        },
        error: function( jqXhr, textStatus, error ){
            console.log( error );
        }
    });
}
function datosCuota(idPrestamo){
	$.ajax({
		url: '../php/datosCuota.php',
		type: 'post',
		data: {'idprestamo':idPrestamo},
		success: function( data ){
			$("#pagarcuota").html(data);
		},
		error: function( jqXhr, textStatus, error ){
			console.log( error );
		}
	});
}

function validarVacio(id){
	var cont = $(id).val();
	if(cont == ""){
		return false;
	}
	else{
		return true;
	}
}


function procesarPago(){
	var monto = $("#cmonto").val();
	var mora = $("#cmora").val();
	montoPagar = (parseFloat(monto)+parseFloat(mora))*100;
	console.log(montoPagar);
	Culqi.publicKey = 'pk_test_3kjZ9masp6u8AYBU';
	// Configura tu Culqi Checkout
    Culqi.settings({
        title: 'EASYLOAN',
        currency: 'PEN',
        description: 'Pago de cuotas',
        amount: montoPagar,
    });
	Culqi.open();
   
}


function culqi() {
	if (Culqi.token) { // ¡Objeto Token creado exitosamente!
		var token = Culqi.token.id;
		var email = Culqi.token.email;
		var idcuota = $("#idcuota").val();
		let timerInterval
		Swal.fire({
			title: 'Espera',
			type: 'warning',
			html: 'Estamos procesando el pago',
			timer: 10000,
			timerProgressBar: true,
			onBeforeOpen: () => {
				Swal.showLoading()
				timerInterval = setInterval(() => {
				Swal.getContent().querySelector('b')
					.textContent = Swal.getTimerLeft()
				}, 100)
			},
			onClose: () => {
				clearInterval(timerInterval)
			}
			}).then((result) => {
			if (
				/* Read more about handling dismissals below */
				result.dismiss === Swal.DismissReason.timer
			) {
				console.log('I was closed by the timer') // eslint-disable-line
			}
		})
		$.ajax({
			url: '../php/pagarCuota.php',
			type: 'post',
			data: {'token':token,'monto':montoPagar,'email':email,'idcuota':idcuota},
			dataType: 'JSON',
			success: function( data ){
				if(data.capture==true){
					console.log(data.outcome.type);
					if(data.outcome.type="venta_exitosa"){
						Swal.fire({
							title: '¡Cuota pagada correctamente!',
							type: 'success',
							showCancelButton: false,
							confirmButtonColor: '#328FE1',
							confirmButtonText: 'Ok'
						  }).then((result) => {
							if (result.value) {
								location.reload();
							}
							else{
								location.reload();
							}
						  }) 
					}
					else{
						Swal.fire({
							type: 'error',
							title: 'Ocurrió un error',
							text: 'Algo salió mal',
						});
					}	
				}
				else{
					data = JSON.parse(data);
					console.log(data.merchant_message);
					Swal.fire({
						type: 'error',
						title: 'Ocurrió un error',
						text: data.merchant_message,
					});
				}
			},
			error: function( jqXhr, textStatus, error ){
				console.log( error );
			}
		});
		//alert('Se ha creado un token:' + token);
		//En esta linea de codigo debemos enviar el "Culqi.token.id"
		//hacia tu servidor con Ajax
	} else { // ¡Hubo algún problema!
		// Mostramos JSON de objeto error en consola
		console.log(Culqi.error);
		Swal.fire({
			type: 'error',
			title: 'Ocurrio un error',
			text: 'Algo salió mal',
		});
	}
  }

  /*
 function pagarCuota(){
	 var idcuota = $("#idcuota").val();
	 console.log(idcuota);
	$.ajax({
        url: '../php/pagarCuota.php',
        type: 'post',
        data: {'idcuota':idcuota},
        success: function( data ){
        	if(data==1){
				Swal.fire({
					title: '¡Cuota pagada correctamente!',
					type: 'success',
					showCancelButton: false,
					confirmButtonColor: '#328FE1',
					confirmButtonText: 'Ok'
				  }).then((result) => {
					if (result.value) {
						location.reload();
					}
					else{
						location.reload();
					}
				  })  
				
			}
			else{
				Swal.fire({
					type: 'error',
					title: 'Ocurrio un error',
					text: 'Algo salió mal',
				  })
			}
        },
        error: function( jqXhr, textStatus, error ){
            console.log( error );
        }
    });
}
*/
