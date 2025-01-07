
$('.deposito-menu').html('');
$('.deposito-title').hide('');

var sourceTitle = document.getElementById('templateMenu').innerHTML;
var templateTitle = Handlebars.compile(sourceTitle);
$('.container-Tittle-volver').html(templateTitle);

$.ajax({
    url: "./verCompras.php",
    type: 'GET',
    dataType: 'json',
    success: function(result) {
        console.log(result);

        if(result == 'No tiene permisos'){
            $('#mensajeOperacion').html('No tiene permisos para ver esta página');
            location.href = '../home/index.php';
            return;
        }

        if (Array.isArray(result)) {
            let row;
            let deposito = $('.deposito-menu').html('');
            let grid = $('.grid').html('');
            var source = document.getElementById('templatePedido').innerHTML;
            var template = Handlebars.compile(source);

            if ($('.deposito-menu').is(':empty')) {
                $('.deposito-menu').html('<div class="alert alert-dark alert-dismissible fade show text-center w-100">No hay nada en el depósito.</div>');
                $('.deposito-menu').css('min-height', '0px');
            }


            result.forEach(function(datos, index) {
                
                if (index % 1 === 0) {
                    row = $('<div class="row mt-3 mb-3"></div>'); 
                    $('.grid').append(row); 
                    $('.grid').addClass('w-100')
                    $('.deposito-menu').html(grid);
                }

                let pedido = template(datos); 
                row.append(pedido);
            });
        } else {
            console.error('La respuesta no es un array:', result);
    }
},
    error: function(xhr, status, error) {
        console.log('Error al cargar los datos del menú dinámico.');
        console.log('Error: ' + error);
    }
});


function verCompra(idcompra) {
$.ajax({
    url: "./actionVerProductosCompra.php",
    type: 'GET',
    data: { idcompra: idcompra },
    dataType: 'json',
    success: function(result) {
        console.log(result);
        
        var source = document.getElementById('templateCompra').innerHTML;
        var template = Handlebars.compile(source);
        let deposito = $('.deposito-menu').html('');
        let card = template(result);
        deposito.append(card);
        let contenidoCompra = $('#contenido-compra');

        var sourceDetalle = document.getElementById('templateDetalleCompra').innerHTML;
        var templateDetalle = Handlebars.compile(sourceDetalle);

        result.forEach(function(datos) {
            let detalle = templateDetalle(datos);
            contenidoCompra.append(detalle);
        });
    },
    error: function(xhr, status, error) {
        console.error('Error en la solicitud AJAX:', error);
    }
});
}

function evaluar(idcompra, estado) {
    $.ajax({
        url: './actionEvaluar.php',
        type: 'POST',
        data: { idcompra: idcompra, estado: estado },
        success: function(response) {
            console.log('Evaluación procesada:', response);

            // Enviar correo según el estado
            $.ajax({
                url: '../buy/actionMandarCorreo.php',
                type: 'POST',
                data: { estado: estado == '1' ? 'aceptado' : 'rechazado', compra: idcompra },
                beforeSend: function() {
                    let mensajeOperacion = $('#mensajeOperacion');
                    mensajeOperacion.addClass('alert alert-info alert-dismissible fade show text-center')
                        .html('Espere 5 segundos a que se procese la acción...');

                    let seconds = 0;
                    let interval = setInterval(function() {
                        seconds++;
                        mensajeOperacion.html(`Espere ${5 - seconds} segundos a que se procese la acción...`);
                        if (seconds >= 5) {
                            clearInterval(interval);
                            mensajeOperacion.removeClass('alert alert-info alert-dismissible fade show text-center')
                                .html('');
                        }
                    }, 1000);
                },
                success: function(response) {
                    console.log('Correo enviado:', response);
                },
                error: function(xhr, status, error) {
                    console.error('Error al enviar el correo:', error);
                }
            });
        },
        error: function(xhr, status, error) {
            console.error('Error en la solicitud AJAX:', error);
        }
    });
}
