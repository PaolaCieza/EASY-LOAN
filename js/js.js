$( document ).ready(function() {
	$("#msg-capt").hide();
});

function iniciarSesion(a){
	if(a==0){
		var user = $("#txtusuario").val();
		$.ajax({
		  url: '../php/login.php',
		  type: 'post',
		  data: {"txtuser":user, "a":1},
		  success: function( data ){
			if(data == 1){
				window.location.href="../html/iniciarsesion2.html";
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

function sinespacios(e){
	var key = e.keyCode;
	if (key == 32) {
		e.preventDefault();
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
		  data: {"txtnombre":nombre, "txtapellidos":apellidos, "txtdni":dni, 
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
						window.location.href="../html/iniciarsesion.html";
					}
					else{
						window.location.href="../html/registrarse.html";
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





