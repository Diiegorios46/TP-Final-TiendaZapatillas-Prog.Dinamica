$(document).ready(function() {
    let url = './actionHistorial.php'
    $.ajax({
        url: url,
        type: 'GET',
        // dataType: 'json', 
        beforeSend: function (result){
            $('#divHistorial').html('<div class="alert alert-warning alert-dismissible fade show text-center">Cargando..</div>');
        },
        success: function(result) {
            let div = $('#divHistorial').html('');

            div.html('<div class="w-100 text-center mb-5"><h1>Historial de Compras.</h1></div>');
            console.log(result);

            let sourceCard = document.getElementById('template-cardHistory').innerHTML;

            Handlebars.registerHelper('estadoClase', function(nombreEstado) {
                if(nombreEstado === 'iniciada') {
                    return  'badge bg-warning';
                }else if(nombreEstado === 'enviada') {
                    return 'badge bg-success';
                }else if(nombreEstado === "cancelada") {
                    return 'badge bg-danger';
                }else{
                    return 'badge bg-secondary';    
                }
            });


            let templateCard = Handlebars.compile(sourceCard);


            result.forEach(function(datos, index) {
                if (index % 3 === 0) {
                    row = $('<div class="row mt-3 mb-3 justify-content-between gap rounded mt-1"></div>'); 
                    div.append(row); 
                }

                let historial = templateCard(datos);
                row.append(historial);
            });
        },
        error: function(xhr, status, error) {
            console.log('Error al cargar los datos del menú dinámico.');
            console.log('Error: ' + error);
        }
    });

});