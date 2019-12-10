function inicio(){
	$("#msg-capt").hide();
	listarPrestamos(1);
	listarSolicitudes();
}


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
			  console.log(data);
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
					  window.location.href="../index.php";
					}
					else{
					  window.location.href="../index.php";
					}
				  }) 
			}
			else{
				if(data == 0){
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
						  window.location.href="../html/mantenimientoCliente.php";
						}
						else{
						  window.location.href="../html/mantenimientoCliente.php";
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

function listarClientes(){
	$.ajax({
        url: '../php/listarClientes.php',
        type: 'post',
        data: {},
        success: function( data ){
        	$("#clientes").html(data);
        },
        error: function( jqXhr, textStatus, error ){
            console.log( error );
        }
    });
}

function buscarCliente(){
	var opcion = $("select[name=selectorC]").val();
	var buscar = $("#buscar").val();

	$.ajax({
        url: '../php/buscarCliente.php',
        type: 'post',
        data: {'opcion':opcion,'buscar':buscar},
        success: function( data ){
        	$("#clientes").html(data);
        },
        error: function( jqXhr, textStatus, error ){
            console.log( error );
        }
    });
}

function contactarCliente(cliente){
	$.ajax({
        url: '../php/contactarCliente.php',
        type: 'post',
        data: {'cliente':cliente},
        success: function( data ){
        	$("#contacto").html(data);
        },
        error: function( jqXhr, textStatus, error ){
            console.log( error );
        }
    });
}

function bajaCliente(cliente){
	Swal.fire({
		title: '¿Estás seguro de dar de baja?',
		text: "El cliente no podrá hacer uso de los servicios de Easyloan",
		type: 'warning',
		showCancelButton: true,
		confirmButtonColor: '#328FE1',
		cancelButtonColor: '#d33',
		confirmButtonText: 'Aceptar',
		cancelButtonText: 'Cancelar'
	  }).then((result) => {
		if (result.value) {
			$.ajax({
				url: '../php/bajaCliente.php',
				type: 'post',
				data: {'cliente':cliente},
				success: function( data ){
					console.log( data );
					if(data==1){
						Swal.fire({
							title: '¡Dado de baja correctamente!',
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

function listarNiveles(){
	$.ajax({
        url: '../php/listarNiveles.php',
        type: 'post',
        data: {},
        success: function( data ){
        	$("#niveles").html(data);
        },
        error: function( jqXhr, textStatus, error ){
            console.log( error );
        }
    });
}

function cerrarSesion(){
	$.ajax({
        url: '../php/cerrarSesion.php',
        type: 'post',
        data: {},
        success: function( data ){
			if(data==1){
				window.location.href="../html/iniciarsesion.php"
			}
        },
        error: function( jqXhr, textStatus, error ){
            console.log( error );
        }
    });
}

var clienteId;

function listarPrestatario(cliente){
	clienteId = cliente;
	$.ajax({
        url: '../php/listarPrestatario.php',
        type: 'post',
        data: {'cliente':cliente},
        success: function( data ){
        	$("#prestatario").html(data);
        },
        error: function( jqXhr, textStatus, error ){
            console.log( error );
        }
    });
}

function listarPrestamista(cliente){
	clienteId = cliente;
	$.ajax({
        url: '../php/listarPrestamista.php',
        type: 'post',
        data: {'cliente':cliente},
        success: function( data ){
        	$("#prestamista").html(data);
        },
        error: function( jqXhr, textStatus, error ){
            console.log( error );
        }
    });
}

function buscarPrestatario(){
	var nombre = $("#txtPrestamista").val();
	//var cliente = $("#clienteId").val();
	$.ajax({
        url: '../php/buscarPrestatario.php',
        type: 'post',
        data: {'cliente':clienteId, 'nombre':nombre},
        success: function( data ){
        	$("#prestatario").html(data);
        },
        error: function( jqXhr, textStatus, error ){
            console.log( error );
        }
	});
}

function buscarPrestamista(){
	var nombre = $("#txtPrestatario").val();
	//var cliente = $("#clienteId").val();
	$.ajax({
        url: '../php/buscarPrestamista.php',
        type: 'post',
        data: {'cliente':clienteId, 'nombre':nombre},
        success: function( data ){
        	$("#prestamista").html(data);
        },
        error: function( jqXhr, textStatus, error ){
            console.log( error );
        }
	});
}

function listarDadosBaja(){
	$.ajax({
        url: '../php/listarDadosBaja.php',
        type: 'post',
        data: {},
        success: function( data ){
        	$("#listaDadosDeBaja").html(data);
        },
        error: function( jqXhr, textStatus, error ){
            console.log( error );
        }
    });
}

function buscarDadoBaja(){
	var opcion = $("select[name=opcionBaja]").val();
	var buscar = $("#buscarBaja").val();

	$.ajax({
        url: '../php/buscarDadoBaja.php',
        type: 'post',
        data: {'opcion':opcion,'buscar':buscar},
        success: function( data ){
        	$("#listaDadosDeBaja").html(data);
        },
        error: function( jqXhr, textStatus, error ){
            console.log( error );
        }
    });
}

function filtrarPrestatario(opcion){
	//var nombre = $("#txtPrestamista").val();
	//var cliente = $("#clienteId").val();
	$.ajax({
        url: '../php/filtrarPrestatario.php',
        type: 'post',
        data: {'cliente':clienteId, 'opcion':opcion},
        success: function( data ){
        	$("#prestatario").html(data);
        },
        error: function( jqXhr, textStatus, error ){
            console.log( error );
        }
	});
}

function filtrarPrestamista(opcion){
	//var nombre = $("#txtPrestamista").val();
	//var cliente = $("#clienteId").val();
	$.ajax({
        url: '../php/filtrarPrestamista.php',
        type: 'post',
        data: {'cliente':clienteId, 'opcion':opcion},
        success: function( data ){
        	$("#prestamista").html(data);
        },
        error: function( jqXhr, textStatus, error ){
            console.log( error );
        }
	});
}

function validarNivel(){
	var forms = document.getElementsByClassName('needs-validation');
	var uploadFoto = document.getElementById("foto").value;
	var contactAlert = document.getElementById('form_alert');
    var validation = Array.prototype.filter.call(forms, function(form) {
        if (form.checkValidity() == false && uploadFoto =='') {
		  contactAlert.innerHTML = '<p class="errorArchivo">No seleccionó imagen</p>';
		  event.preventDefault();
          event.stopPropagation();
          //console.log(valuser());
        }
        else{
			registrarNivel();
        }
        form.classList.add('was-validated');
        });
}
function registrarNivel(){
	var paqueteDeDatos = new FormData();
	paqueteDeDatos.append('imagen', $('#foto')[0].files[0]);
	paqueteDeDatos.append('nombre', $('#txtNombre').prop('value'));
	paqueteDeDatos.append('descripcion', $('#txtDescripcion').prop('value'));
	paqueteDeDatos.append('montoMax', $('#txtMontoMaximo').prop('value'));

	$.ajax({
	    url: '../php/registrarNivel.php',
		type: 'post',
		contentType: false,
		data: paqueteDeDatos,
		processData: false,
		cache: false, 
	    success: function( data ){
			//console.log(data);
			if(data == 1){
				Swal.fire({
					title: '¡Registrado correctamente!',
					text: "Se agregó el nuevo nivel",
					type: 'success',
					showCancelButton: false,
					confirmButtonColor: '#3085d6',
					//cancelButtonColor: '#d33',
					confirmButtonText: 'Aceptar'
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
					title: '¡Ocurrió un error',
					text: "Revisa bien los datos ingresados",
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

function editarNivel(){
	var paqueteDeDatos = new FormData();
	paqueteDeDatos.append('imagen', $('#foto')[0].files[0]);
	paqueteDeDatos.append('nivel', $('#idnivel').prop('value'));
	paqueteDeDatos.append('nombre', $('#txtNombreE').prop('value'));
	paqueteDeDatos.append('descripcion', $('#txtDescripcionE').prop('value'));
	paqueteDeDatos.append('montoMax', $('#txtMontoMaximoE').prop('value'));

	$.ajax({
	    url: '../php/editarNivel.php',
		type: 'post',
		contentType: false,
		data: paqueteDeDatos,
		processData: false,
		cache: false, 
	    success: function( data ){
			console.log(data);
			if(data == 1){
				Swal.fire({
					title: '¡Actualizado correctamente!',
					text: "Se editó el nivel",
					type: 'success',
					showCancelButton: false,
					confirmButtonColor: '#3085d6',
					//cancelButtonColor: '#d33',
					confirmButtonText: 'Aceptar'
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
					title: '¡Ocurrió un error',
					text: "Revisa bien los datos ingresados",
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

function validarNivelE(){
	var forms = document.getElementsByClassName('needs-validation');
	var uploadFoto = document.getElementById("foto").value;
	var contactAlert = document.getElementById('form_alert');
    var validation = Array.prototype.filter.call(forms, function(form) {
        if (form.checkValidity() == false) {
		  contactAlert.innerHTML = '<p class="errorArchivo">No seleccionó imagen</p>';
		  event.preventDefault();
          event.stopPropagation();
          //console.log(valuser());
        }
        else{
			editarNivel();
        }
        form.classList.add('was-validated');
        });
}

function datosNivel(nivel){
	//var nombre = $("#txtPrestamista").val();
	//var cliente = $("#clienteId").val();
	$.ajax({
        url: '../php/datosNivel.php',
        type: 'post',
        data: {'nivel':nivel},
        success: function( data ){
			var datos = JSON.parse(data);
			$(".imgNivel").remove();
			$(".delPhoto").removeClass('notBlock');
			$('#foto').val('');
        	$("#idnivel").val(nivel);
        	$("#txtNombreE").val(datos.nombre);
        	$("#txtDescripcionE").val(datos.descripcion);
			$("#txtMontoMaximoE").val(datos.montomax);
			$(".prevPhoto").append("<img id='img' class='imgNivel' src='../recursos/niveles/"+datos.imagen+"'>");
			//$("#img").remove();
        },
        error: function( jqXhr, textStatus, error ){
            console.log( error );
        }
	});
}


function formatoFoto(){
	$(document).ready(function(){
		//--------------------- SELECCIONAR FOTO PRODUCTO ---------------------
		  $("#foto").on("change",function(){
			  var uploadFoto = document.getElementById("foto").value;
			  var foto       = document.getElementById("foto").files;
			  var nav = window.URL || window.webkitURL;
			  var contactAlert = document.getElementById('form_alert');
			  
				  if(uploadFoto !='')
				  {
					  var type = foto[0].type;
					  var name = foto[0].name;
					  if(type != 'image/jpeg' && type != 'image/jpg' && type != 'image/png')
					  {
						  contactAlert.innerHTML = '<p class="errorArchivo">El archivo no es válido.</p>';                        
						  $(".imgNivel").remove();
						  $(".delPhoto").addClass('notBlock');
						  $('#foto').val('');
						  return false;
					  }else{  
							  contactAlert.innerHTML='';
							  $(".imgNivel").remove();
							  $(".delPhoto").removeClass('notBlock');
							  var objeto_url = nav.createObjectURL(this.files[0]);
							  $(".prevPhoto").append("<img class='imgNivel' id='img' src="+objeto_url+">");
							  $(".upimg label").remove();
							  
						  }
					}else{
						  contactAlert.innerHTML = '<p class="errorArchivo">No seleccionó imagen</p>';                        
						  $(".imgNivel").remove();
						  $(".delPhoto").addClass('notBlock');
						  $('#foto').val('');
						  return false;
					}              
		  });
	  
		  $('.delPhoto').click(function(){
			  
			  $('#foto').val('');
			  $(".delPhoto").addClass('notBlock');
			  $(".imgNivel").remove();
	  
		  });
	  
	  });
}
var mantenerFoto = true;
function formatoFotoPerfil(){
	$(document).ready(function(){
		  $("#foto").on("change",function(){
			  var uploadFoto = document.getElementById("foto").value;
			  var foto       = document.getElementById("foto").files;
			  var nav = window.URL || window.webkitURL;
			  var contactAlert = document.getElementById('form_alert');
			  
				  if(uploadFoto !='')
				  {
					  var type = foto[0].type;
					  var name = foto[0].name;
					  if(type != 'image/jpeg' && type != 'image/jpg' && type != 'image/png')
					  {
						  contactAlert.innerHTML = '<p class="errorArchivo">El archivo no es válido.</p>';                        
						  $("#img").remove();
						  $(".delPhoto").addClass('notBlock');
						  $('#foto').val('');
						  return false;
					  }else{  
							  contactAlert.innerHTML='';
							  $("#img").remove();
							  $(".delPhoto").removeClass('notBlock');
							  var objeto_url = nav.createObjectURL(this.files[0]);
							  $(".prevPhotoPerfil").append("<img class='imgNivel' id='img' src="+objeto_url+">");
							  $(".upimg label").remove();
							  
						  }
					}else{                      
						  $("#img").remove();
						  $(".delPhoto").addClass('notBlock');
						  $('#foto').val('');
						  contactAlert.innerHTML = '<p class="errorArchivo">No seleccionó imagen</p>';  
						  return false;
					}              
		  });
	  
		  $('.delPhoto').click(function(){
			  var contactAlert = document.getElementById('form_alert');
			  contactAlert.innerHTML = '<p class="errorArchivo">No seleccionó imagen</p>'; 
			  $('#foto').val('');
			  $(".delPhoto").addClass('notBlock');
			  $("#img").remove();
			  mantenerFoto = false;
	  
		  });
	  
	  });
}
function listarSolicitudes(){
	$.ajax({
        url: '../php/listarSolicitudes.php',
        type: 'post',
        data: {},
        success: function( data ){
        	$("#solicitudes").html(data);
        },
        error: function( jqXhr, textStatus, error ){
            console.log( error );
        }
    });
}

function buscarSolicitud(){
	var buscar = $("#buscarSolicitud").val();
	$.ajax({
        url: '../php/buscarSolicitud.php',
        type: 'post',
        data: {'nombre':buscar},
        success: function( data ){
        	$("#solicitudes").html(data);
        },
        error: function( jqXhr, textStatus, error ){
            console.log( error );
        }
    });
}

function listarPrestamosDados(){
	$.ajax({
        url: '../php/listarPrestamosDados.php',
        type: 'post',
        data: {},
        success: function( data ){
        	$("#prestamosDados").html(data);
        },
        error: function( jqXhr, textStatus, error ){
            console.log( error );
        }
    });
}

function filtrarSolicitudes(opcion){
	$.ajax({
        url: '../php/filtrarSolicitudes.php',
        type: 'post',
        data: {'opcion':opcion},
        success: function( data ){
        	$("#solicitudes").html(data);
        },
        error: function( jqXhr, textStatus, error ){
            console.log( error );
        }
	});
}

function validarInteres(){
	var interes = $("#txtinteres").val();
	if(interes.length > 0){
		$("#msg-interes").hide();
		return true;
	}
	else{
		$("#msg-interes").show();
		return false;
	}
}

function datosPersonales(){
	$.ajax({
        url: '../php/datosPersonales.php',
        type: 'post',
        data: {},
        success: function( data ){
        	$("#datosPerfil").html(data);
        },
        error: function( jqXhr, textStatus, error ){
            console.log( error );
        }
	});
}

function datosEditarPerfil(){	
	$.ajax({
        url: '../php/datosPerfilEditar.php',
        type: 'post',
        data: {},
        success: function( data ){
			var datos = JSON.parse(data);
			$("#img").remove();
			$(".delPhoto").removeClass('notBlock');
			$('#foto').val('');
			$(".prevPhotoPerfil").append("<img id='img' src='../recursos/perfiles/"+datos.fotousuario+"'>");
        	$("#txtdni").val(datos.dni);
			$("#txtfecha").val(datos.fechanac);
			if(datos.sexo){$("#rdmasculino").prop("checked",true);}
			else{$("#rdfemenino").prop("checked",true);};
            $("#txtcorreo").val(datos.email);
            $("#txtusuario").val(datos.usuario);

        },
        error: function( jqXhr, textStatus, error ){
            console.log( error );
        }
	});
}

function validarCorreo(){
	var correo = $("#txtcorreo").val()
	if(correo.length > 0){
		$("#txtcorreo").toggleClass("is-valid", true);
		$("#txtcorreo").toggleClass("is-invalid", false);
		return true;
	}
	else{
		$("#txtcorreo").toggleClass("is-invalid", true);
		$("#txtcorreo").toggleClass("is-valid", false);
		return false;
	}
	
	//$("#txtusuario").toggleClass("is-valid",false);
}

function editarPerfil(){
	var paqueteDeDatos = new FormData();
	paqueteDeDatos.append('imagen', $('#foto')[0].files[0]);
	paqueteDeDatos.append('sexo', $("input:radio[name=txtsexo]:checked").val());
	paqueteDeDatos.append('correo', $('#txtcorreo').prop('value'));
	paqueteDeDatos.append('usuario', $('#txtusuario').prop('value'));
	paqueteDeDatos.append('mantenerFoto', mantenerFoto);
	if(validarCorreo() && usuarioEditar ){
		$.ajax({
			url: '../php/editarPerfil.php',
			type: 'post',
			contentType: false,
			data: paqueteDeDatos,
			processData: false,
			cache: false, 
			success: function( data ){
				console.log(data);
				if(data == 1){
					Swal.fire({
						title: '¡Actualizado correctamente!',
						text: "Se editó tu perfil",
						type: 'success',
						showCancelButton: false,
						confirmButtonColor: '#3085d6',
						//cancelButtonColor: '#d33',
						confirmButtonText: 'Aceptar'
					  }).then((result) => {
						if (result.value) {
						  window.location.href="../html/perfil.php" ;
						}
						else{
							window.location.href="../html/perfil.php" ;
						}
					  }) 
				}
				else{
					Swal.fire({
						title: '¡Ocurrió un error',
						text: "Revisa bien los datos ingresados",
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

var usuarioEditar = true;
function userEditar(){
	var usuario = $("#txtusuario").val();
	if(usuario !== ""){
		$.ajax({
			url: '../php/validarUsuario.php',
			type: 'post',
			data: {"txtusuario":usuario},
			success: function( data ){
			  console.log(data);
			  if(data != 0){
				$("#msg-e2").show();
				$("#msg-e1").hide();
				$("#msg-s").hide();
				$("#txtusuario").toggleClass("is-invalid", true);
				$("#txtusuario").toggleClass("is-valid",false);
				usuarioEditar = false;
			  }else{
				$("#msg-s").show();
				$("#msg-e1").hide();
				$("#msg-e2").hide();
				$("#txtusuario").toggleClass("is-valid",true);
				$("#txtusuario").toggleClass("is-invalid", false);
				usuarioEditar = true;
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
		usuarioEditar = false;
	}
}

function infoNiveles(){
	$.ajax({
        url: '../php/infoNiveles.php',
        type: 'post',
        data: {},
        success: function( data ){
        	$("#infoNiveles").html(data);
        },
        error: function( jqXhr, textStatus, error ){
            console.log( error );
        }
    });
}