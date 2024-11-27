<?php
include '../estructura/cabeceraSegura.php';
// $rol = $session->getRol();

// if($rol != 1 && $rol != 2){
//     header('Location: ../home/index.php');
// }
?>

<div id="contenido" >

</div>
<script>

    $.ajax({
        url: './listarComprasItems.php',
        type: 'GET',
        success: function (data) {
            data = JSON.parse(data);
            console.log(data);

            let container = $('<div class="container-sm"></div>');
            container.append('<h1 class="text-center  my-4">Histórico de Compra</h1>');
            
            let row = $('<div class="row"></div>');  

            data.forEach((element, index) => {
                let card = `
                    <div class="col-12 col-md-4 col-lg-3 m-4">
                        <div class="card shadow-lg rounded border" style="width: 18rem;">
                            <div class="card-body">
                                <h5 class="card-title text-dark font-bold">Numero de compra: ${element.idcompra}</h5>
                                <h6 class="card-subtitle mb-2 text-muted">ID producto: ${element.idproducto}</h6>
                                <p class="card-text">Cantidad comprada: ${element.cicantidad}</p>
                                <div class="text-center">
                                    <button class="btn btn-warning mt-2" onclick="traerHistorico(${element.idcompra})">Ver Historico</button>
                                </div>
                            </div>
                        </div>
                    </div>
                `;
                
                row.append(card);
                
                if ((index + 1) % 3 === 0) {
                    container.append(row);
                    row = $('<div class="row"></div>'); 
                }
            });

            if (data.length % 4 !== 0) {
                container.append(row);
            }
            $('#contenido').append(container);
        }
    });

        function traerHistorico(idcompra) {
        $.ajax({
            url: './action.php',
            type: 'POST',
            data: { idcompra: idcompra },
            success: function (data) {
                data = JSON.parse(data);

                let container = $('<div class="container-sm"></div>');
                container.append('<h1 class="text-center  my-4">Informacion de las compras</h1>');

                let row; // Contenedor de la fila actual
                data.forEach((element, index) => {
                    // Si el índice es divisible entre 4, crea una nueva fila
                    if (index % 4 === 0) {
                        row = $('<div class="row mb-4"></div>');
                        container.append(row); // Añade la nueva fila al contenedor
                    }

                    // Agrega la tarjeta a la fila actual
                    row.append(`
                        <div class="col-12 col-md-6 col-lg-3 d-flex justify-content-center">
                            <div class="card mb-4 shadow-sm" style="width: 18rem;">
                                <div class="card-body">
                                    <div class="card-title font-bold">Numero de compra: ${element.idcompra}</div>
                                    <div class="card-subtitle mb-2 text-muted">Inicio: ${element.cefechaini}</div>
                                    <p class="card-text">Terminó: ${element.cefechafin}</p>
                                    <p class="card-subtitle mb-2">
                                        Estado de la compra: 
                                        <span class="badge rounded px-3 py-2 
                                            ${element.idcompraestadotipo === 1 ? 'bg-primary' : 
                                            element.idcompraestadotipo === 2 ? 'bg-celeste' : 
                                            element.idcompraestadotipo === 3 ? 'bg-success text-light' : 
                                            element.idcompraestadotipo === 4 ? 'bg-danger' : 
                                            'bg-secondary'}">
                                            ${element.idcompraestadotipo === 1 ? 'Iniciada' :
                                            element.idcompraestadotipo === 2 ? 'Aceptada' :
                                            element.idcompraestadotipo === 3 ? 'Enviada' :
                                            element.idcompraestadotipo === 4 ? 'Cancelada' : 'Desconocida'}
                                        </span>
                                    </p>
                                </div>
                            </div>
                        </div>
                    `);
                });

                $('#contenido').html(''); 
                $('#contenido').append(container);
            }
        });
    }


</script>

