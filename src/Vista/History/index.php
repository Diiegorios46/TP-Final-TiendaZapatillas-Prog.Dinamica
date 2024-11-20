
<?php include '../estructura/cabeceraSegura.php' ?>

<div id="divHistorial">

</div>

<script>
    $(document).ready(function() {
        $.ajax({
            url: './actionHistorial.php',
            type: 'GET',
            // dataType: 'json', 
            success: function(result) {
                console.log(result);
                $('#divHistorial').html(result);
                //// pronombre, cefechaini, cefechafin, prodetalle, proprecio, cicantidad, idcompra   
            },
            error: function(xhr, status, error) {
                console.log('Error al cargar los datos del menú dinámico.');
                console.log('Error: ' + error);
            }
        });
    });

</script>