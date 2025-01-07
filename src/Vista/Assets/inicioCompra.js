    
    $(document).ready(function() {
        $.ajax({
            url: 'action.php',
            type: 'get',
            dataType: 'json',
            beforeSend: function(){
                console.log('trayendo datos');
            },
            success: function(response){
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
            
            console.log('datos cargados');
            },
            error: function(xhr, status, error) {
                console.error('Error en la solicitud AJAX:', status, error);
            }
        });
        
    });
    
    /** crear el finalizar compra en action.php */
    function pago(){
        $.ajax({
            url: './actionIniciarCompra.php',
            type: 'post',
            data: { productos: datos },
            beforeSend: function(){
                console.log('enviando datos al servidor');
            },
            success: function(response){
                console.log(response);
                $.ajax({
                    url: './actionMandarCorreo.php',
                    type: 'post',
                    data: {estado: 'iniciado',
                         productos: datos},

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

