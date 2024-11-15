<?php 
include '../estructura/cabecera.php';
/*ACA VA EL COSO PARA LA COMPRA , CAMBPOS DE PAGO FICTICIOS*/

$datos = data_submitted();
?>

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
                console.log('enviando');
            },
            success: function(response){
                //console.log('aaa');
                var datos = <?php echo json_encode($datos['productos']); ?>;
                //console.log(datos);

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
            <button class="btn btn-primary">Confirmar</button>
             </div>
    </div>
</div>

    </section>
    
    <script>
        
        /** crear el finalizar compra en action.php */
        /* */
        function pago(){
            window.location.href = '../buy/action.php'
        }

    </script>


</main>