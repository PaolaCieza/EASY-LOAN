function inicio(){
    listaproductos(1);
}

function listaproductos(columna){
    $.ajax({
        url: 'php/listar.php',
        type: 'post',
        data: {'columna': columna},
        success: function( data ){
        	$("#listaproductos").html(data);
        },
        error: function( jqXhr, textStatus, error ){
            console.log( error );
        }
    });
}

function editar(id){
    $.ajax({
        url: 'php/modificar.php',
        type: 'post',
        data: {'id': id},
        success: function( data ){
            data = JSON.parse(data);
            $('#idproducto').val(id);
            $('#txtnombres').val(data.nombre);
            $('#txtcantidad').val(data.autor);
            $('#txtdescripcion').val(data.descripcion);
            $('#txtusuario').val(data.usuario);
        },
        error: function( jqXhr, textStatus, error ){
            console.log( error );
        }
    });
}

function buscar(letras){
    $.ajax({
        url: 'php/buscar.php',
        type: 'post',
        data: {'letras': letras},
        success: function( data ){
        	$("#listaproductos").html(data);
        },
        error: function( jqXhr, textStatus, error ){
            console.log( error );
        }
    });
}

$('#buscarxnombre').keyup(function (e) { 
    buscar(e.target.value);
    
});

function eliminar(id){
	$.ajax({
        url: 'php/eliminar.php',
        type: 'post',
        data: {'idproducto':id},
        success: function( data ){
        	if(data==1){
        		$("#divmsg").html("Registro eliminado");
        		listaproductos(1);
        	} else {
        		$("#divmsg").html("Error al eliminar el registro");
        	}
			console.log(data);
        },
        error: function( jqXhr, textStatus, error ){
            console.log( error );
        }
    });
}


function iniciarSesion(a){
	if(a==0){
		var user = $("#txtusuario").val();
		$.ajax({
		  url: 'login.php',
		  type: 'post',
		  data: {"txtuser":user, "a":1},
		  success: function( data ){
			if(data == 1){
				window.location.href="index_pass.php";
			}
			else{
				Swal.fire({
					title: '¡Eror al iniciar sesion!',
					text: "Revisa bien tus datos",
					type: 'error',
					showCancelButton: false,
					confirmButtonColor: '#FF4242',
					//cancelButtonColor: '#d33',
					confirmButtonText: 'Volver a intentar'
				  }).then((result) => {
					if (result.value) {
					  location.reload();
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
		var pass = $("#txtpassw").val();
		$.ajax({
		  url: 'login.php',
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
					  window.location.href="persona.php";
					}
					else{
					  window.location.href="persona.php";
					}
				  }) 
			}
			else{
				Swal.fire({
					title: '¡Eror al iniciar sesion!',
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


  function validar(){

    var forms = document.getElementsByClassName('needs-validation');
    var validation = Array.prototype.filter.call(forms, function(form) {
        if (form.checkValidity() === false) {
          event.preventDefault();
          event.stopPropagation();
          console.log("Error al validar");
          captcha();
        }
        else{
          var response = grecaptcha.getResponse();
          if(response.length !== 0){
            registrar();
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

