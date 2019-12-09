var montoPagar;
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