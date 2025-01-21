

function volverMenu(){
    document.querySelector('.btn-volver-configuracion').addEventListener('click', function() {
        const url = this.getAttribute('data-url');
        if (url) {
            window.location.href = url;
        } 
    });
}

Handlebars.registerHelper('estadocompra', function(idcompraestadotipo) {
    if (idcompraestadotipo === "1") {
        return 'Iniciada';
    } else if (idcompraestadotipo === "2") {
        return 'Aceptada';
    } else if (idcompraestadotipo === "3") {
        return 'Enviada';
    } else if (idcompraestadotipo === "4") {
        return 'Cancelada';
    } else {
        return 'Desconocida';
    }
});

Handlebars.registerHelper('clasecolor', function(idcompraestadotipo) {
    if (idcompraestadotipo === "1") {
        return 'bg-primary';
    } else if (idcompraestadotipo === "2") {
        return 'bg-celeste';
    } else if (idcompraestadotipo === "3") {
        return 'bg-success text-light';
    } else if (idcompraestadotipo === "4") {
        return 'bg-danger';
    } else {
        return 'bg-secondary';
    }
});

$.ajax({
    url: './listarComprasItems.php',
    type: 'GET',
    success: function (data) {
        data = JSON.parse(data);

        let container = $('<div class="container-sm"></div>');

        $('.deposito-menu').html('');
        $('.deposito-title').hide('');

        var sourceTitle = document.getElementById("titleModificarProducto-template").innerHTML;
        var templateTitle = Handlebars.compile(sourceTitle);
        $('.container-Tittle-volver').html(templateTitle ({titulo : "Historico de compras" }));
        
        var sourceCard = document.getElementById("template-card").innerHTML;
        var templateCard = Handlebars.compile(sourceCard);

        let row = $('<div class="row"></div>');  

        if (data.length === 0) {
            // Si no hay elementos, mostrar un mensaje indicando que está vacío
            $("#mensajeOperacion").addClass('alert alert-secondary text-center w-100').html('No hay elementos disponibles.');
        
        } else {
            data.forEach((element, index) => {
                let cardHtml = templateCard(element); 
                row.append(cardHtml);            
                
                if ((index + 1) % 3 === 0) {
                    container.append(row);
                    row = $('<div class="row"></div>'); 
                }
            });

            if (data.length % 3 !== 0) {
                container.append(row);
            }
        }

        volverMenu();        
        $('#contenido').append(container);
    },
    error: function (xhr, status, error) {
        console.log('Error al cargar los datos:', error);
        $('#contenido').append('<div class="alert alert-danger text-center w-100">Error al cargar los datos.</div>');
    }
});


function traerHistorico(idcompra) {
    $.ajax({
        url: './action.php',
        type: 'POST',
        data: { idcompra: idcompra },

        success: function (data) {
            console.log(data)
            data = JSON.parse(data);

            let container = $('<div class="container-sm"></div>');
            container.append('<h1 class="text-center  my-4"></h1>');

            $('.deposito-menu').html('');
            $('.deposito-title').hide('');


            var sourceTitle = document.getElementById("titleModificarProducto-template").innerHTML;
            var templateTitle = Handlebars.compile(sourceTitle);
            $('.container-Tittle-volver').html(templateTitle ({titulo : "Informacion de las compras" }));

            volverMenu();
            
            let row; 

            var sourceCard = document.getElementById("template-CardInformacionCompra").innerHTML
            var templateCard = Handlebars.compile(sourceCard);

            data.forEach((element, index) => {
                // Si el índice es divisible entre 4, crea una nueva fila
                if (index % 4 === 0) {
                    row = $('<div class="row mb-4"></div>');
                    container.append(row); // Añade la nueva fila al contenedor
                }

                console.log(element);
                let cardHtml = templateCard(element);
                row.append(cardHtml);
                
            });

            $('#contenido').html(''); 
            $('#contenido').append(container);
        }
    });
}