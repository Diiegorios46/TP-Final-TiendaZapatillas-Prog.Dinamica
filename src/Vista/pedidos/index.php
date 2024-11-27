<?php 
    include '../estructura/cabeceraSegura.php';
?>

<div class="container-sm min-vh-100">  

    <div id='mensajeOperacion'></div>

    <h1 class="deposito-title pt-4">Menu</h1>
    <div class="container-Tittle-volver mt-5"></div>

    <div class="deposito-menu" id="menuDinamico">
        <!--viene el codigo de jquery-->
    </div>
    <div class="grid"></div>

</div>


<script>

        $('.deposito-menu').html('');
        $('.deposito-title').hide('');

        $('.container-Tittle-volver').html(`
        <div class="container-sm d-flex w-75">
            <div class="d-flex w-5">   
                    <a href="../menu/index.php" class="d-flex align-content-center">
                    <div class="w-100"><img src="../Assets/imgs/volver.png" alt="" class="h-100 w-100 p-1 rounded-circle"></div> 
                    </a>
            </div>
            <div class="w-100 d-flex justify-content-center">
                <h1>Ver paquetes</h1>
            </div>
        </div>`);

    $.ajax({
            url: "./actionVerPaquetes.php",
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

                    let deposito = $('.deposito-menu').html('');
                    let grid = $('.grid').html('');
                    let row;

                    if ($('.deposito-menu').is(':empty')) {
                        $('.deposito-menu').html('<div class="alert alert-dark alert-dismissible fade show text-center w-100">No hay nada en el depósito.</div>');
                        $('.deposito-menu').css('min-height', '0px');
                    }


                    result.forEach(function(datos, index) {
                        
                        if (index % 4 === 0) {
                            row = $('<div class="row mt-3 mb-3"></div>'); 
                            $('.grid').append(row); 
                            $('.grid').addClass('w-100')
                            $('.deposito-menu').html(grid);
                        }
                        let pedido = 
                        `<div class="col-md-3 col-sm-6 mb-3 evalua w-25 shadow p-3">  
                            <div class="d-flex flex-column ">
                            <div class="text-center p-1">Pedido numero: ${datos.idcompraitem}</div>
                            <div class="text-center p-1">Id de la Compra: ${datos.idcompra}</div>
                            <div class="text-center p-1">Id del Producto: ${datos.idproducto}</div>
                                <div class="text-center p-1"><strong>Cantidad solicitada: ${datos.cicantidad}</strong></div>
                                <div class="text-center p-1"><strong>Stock: ${datos.cicantstock}</strong></div>
                                <div class="d-flex flex-row justify-content-center gap">
                                    <button class="btn btn-success m-1" onclick="evaluar(this, ${datos.idcompra}, 1)">Aceptar</button>
                                    <button class="btn btn-danger m-1" onclick="evaluar(this, ${datos.idcompra}, 0)">Cancelar</button>
                                </div>
                            </div>
                        </div>`;

                        
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


        function evaluar(boton, idcompra, estado) {
            $.ajax({
                
                url: './actionEvaluar.php',
                type: 'post',
                data: { idcompra: idcompra, estado: estado },

                success: function(response) {
                    console.log('hola');
                    console.log(response);
                    // $('#mensajeOperacion').html(response);
                    $(boton).closest('.evalua').remove();

                    $.ajax({
                        url: '../buy/actionMandarCorreo.php',
                        type: 'post',
                        data: {estado: estado == 1 ? 'aceptado' : 'rechazado', compra: idcompra},
                        beforeSend: function() {
                            $('#mensajeOperacion').addClass('alert alert-info alert-dismissible fade show text-center').html('Espere 5 segundos a que se procese la acción...');
                            let seconds = 0;
                            let interval = setInterval(function() {
                                seconds++;
                                $('#mensajeOperacion').html(`Espere ${5 - seconds} segundos a que se procese la acción...`);
                                if (seconds >= 5) {
                                    clearInterval(interval);
                                    $('#mensajeOperacion').removeClass('alert alert-info alert-dismissible fade show text-center').html('');
                                }
                            }, 1000);    },

                        success: function(response){
                            console.log(response);

                            $.ajax({
                                url: '../buy/actionMandarCorreo.php',
                                type: 'post',
                                data: {estado: response, compra: idcompra},
                                success: function(response){
                                    console.log(response);
                                },
                                error: function(xhr, status, error) {
                                    console.log('Error: ' + error);
                                }
                            })
                        },

                        error: function(xhr, status, error) {
                            console.log('Error: ' + error);
                        }
                    });
                },
                error: function(xhr, status, error) {
                    console.log('Error: ' + error);
                }
            });
            
        }

        



</script>
