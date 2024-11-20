
<?php include '../estructura/cabeceraSegura.php' ?>

<div id="divHistorial" class="container-sm mt-5"></div>


<script>
    $(document).ready(function() {
        let url = './actionHistorial.php'
        $.ajax({
            url: url,
            type: 'GET',
            dataType: 'json', 

            beforeSend: function (result){
                $('#divHistorial').html('<div class="alert alert-warning alert-dismissible fade show text-center">Cargando..</div>');
            },
            success: function(result) {
                let div = $('#divHistorial').html('');
                div.html('<div class="w-100 text-center mb-5"><h1>Historial de Compras.</h1></div>');

                result.forEach(function(datos, index) {
                    if (index % 3 === 0) {
                        row = $('<div class="row mt-3 mb-3 justify-content-between gap"></div>'); 
                        div.append(row); 
                    }
                    let estadoClase = datos.estadotipo === 'iniciada' ? 'badge bg-warning' : datos.estadotipo === 'enviada' ? 'badge bg-primary' : datos.estadotipo === 'cancelada' ? 'badge bg-danger' : 'badge bg-secondary';
                    
                    let historial = `<div class="col-md-3 col-sm-6 mb-3 shadow rounded w-25">  
                                        <div class="d-flex flex-column ">
                                            <div class="text-left"><strong>Estado de compra: </strong><span class="${estadoClase}">${datos.estadotipo}</span></div>
                                            <div class="text-left"><strong>Número de compra: </strong>${datos.idcompra}</div>
                                            <div class="text-left"><strong>Fecha de compra: </strong> ${datos.cefechaini}</div>
                                            <div class="text-left"><strong>Fecha de entrega: </strong> ${datos.cefechafin}</div>
                                            <div class="text-left"><strong>Producto: </strong> ${datos.prodetalle}</div>
                                            <div class="text-left"><strong>precio: </strong>${datos.proprecio}</div>
                                            <div class="text-left"><strong>Cantidad: </strong>${datos.cicantidad}</div>
                                        </div>
                                     </div>`;
                    row.append(historial);
                });
            },
            error: function(xhr, status, error) {
                console.log('Error al cargar los datos del menú dinámico.');
                console.log('Error: ' + error);
            }
        });

    });
</script>

