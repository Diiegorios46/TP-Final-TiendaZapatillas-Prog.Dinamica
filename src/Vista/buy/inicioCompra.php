<?php 
include '../estructura/cabeceraSegura.php';
/*ACA VA EL COSO PARA LA COMPRA , CAMBPOS DE PAGO FICTICIOS*/

$datos = data_submitted();
?>
<div id='mensajeOperacion'></div>
<main class="container-sm min-height-50">

    <section class="m-5 d-flex flex-row">
    
        <div class="d-flex flex-column justify-content-between  w-80 mr-1">
            <div id="prueba"></div>
        <script>
            
    $(document).ready(function() {
        $.ajax({
            url: 'action.php',
            type: 'get',
            dataType: 'json',
            beforeSend: function(){
                console.log('trayendo datos');
            },
            success: function(response){
                var datos = <?php echo json_encode($datos['productos']); ?>;

                // Crear la tabla
                var tabla = '<table class="table table-striped text-center fs-3">';
                tabla += '<thead>';
                tabla += '<tr>';
                tabla += '<th>Nombre</th>';
                tabla += '<th>Precio</th>';
                tabla += '<th>Cantidad</th>';
                tabla += '<th>Imagen</th>';
                tabla += '</tr>';
                tabla += '</thead>';
                tabla += '<tbody>';


                // Recorrer el objeto y agregar filas a la tabla
                datos.forEach(function(producto) {
                    tabla += '<tr>';
                    tabla += '<td>' + producto.nombre + '</td>';
                    tabla += '<td> $' + producto.precio + '</td>';
                    tabla += '<td>' + producto.cantidad + '</td>';
                    tabla += '<td><img src="' + producto.img + '" alt="' + producto.nombre + '" width="200" class="img-thumbnail"></td>';
                    tabla += '</tr>';
                });

                tabla += '</tbody></table>';
             
                // Insertar la tabla en el div con id "prueba"
                $('#prueba').html(tabla);
                
                var total = 0;
                datos.forEach(function(producto) {
                    var totalProducto = producto.precio * producto.cantidad;
                    total += totalProducto;
                    
                });
              
                //console.log(total);
                $('#total').html('$' + total.toFixed(2));

                // Crear el formulario fantasma
                var form = $('<form>', {
                    'action': './actionIniciarCompra.php',
                    'method': 'post',
                    'style': 'display: none;',
                    'id': 'formCompra',
                    'class': 'd-none',
                    'target': 'hidden_iframe'
                });

                // Crear un iframe oculto
                var iframe = $('<iframe>', {
                    'name': 'hidden_iframe',
                    'style': 'display: none;'
                });

                // Agregar los datos al formulario
                datos.forEach(function(producto) {
                    form.append($('<input>', {
                        'type': 'hidden',
                        'name': 'productos[]',
                        'value': JSON.stringify(producto)
                    }));
                });

                // Agregar el iframe y el formulario al body y enviarlo
                $('body').append(iframe).append(form);
                form.submit();
            
            console.log('datos cargados');
            },
            error: function(xhr, status, error) {
                console.error('Error en la solicitud AJAX:', status, error);
            }
        });
        
    });
  
</script>    
        </div>

        <div class="w-25 p-3 bg-light">
    <div class="p-3 shadow-sm">
        <h3>Resumen de Compra</h3>
        
        <div class="d-flex justify-content-between mt-3">
            <span class="fs-5">Total:</span>
            <div id="total" class="fs-5">
            </div>
        </div>
        <div class="d-flex justify-content-center mt-3">
            <button class="btn btn-primary" onclick="pago()">Confirmar</button>
        </div>
    </div>
</div>

    </section>
    
    <script>
        
        /** crear el finalizar compra en action.php */
        function pago(){
            $.ajax({
                url: './actionIniciarCompra.php',
                type: 'post',
                data: { productos: <?php echo json_encode($datos['productos']); ?> },
                beforeSend: function(){
                    console.log('enviando datos al servidor');
                },
                success: function(response){
                    // console.log(response);
                    $.ajax({
                        url: './actionMandarCorreo.php',
                        type: 'post',
                        data: {estado: 'iniciado', productos: <?php echo json_encode($datos['productos']); ?>},
                        beforeSend: function(){
                            console.log('enviando correo');
                        },
                        success: function(response){
                            console.log(response);
                            $('#mensajeOperacion').addClass('alert alert-success alert-dismissible fade show text-center').html('El pedido se envio exitosamente.');
                        },
                        error: function(xhr, status, error) {
                            console.error('Error en la solicitud AJAX:', status, error);
                        }
                    });
                },
                error: function(xhr, status, error) {
                    console.error('Error en la solicitud AJAX:', status, error);
                }
            });
        }

    </script>


</main>