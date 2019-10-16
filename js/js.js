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


