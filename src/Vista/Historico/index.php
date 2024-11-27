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
            
            let row = $('<div class="row"></div>');  

            data.forEach((element, index) => {
                let card = `
                    <div class="col-12 col-md-4 col-lg-3 m-4">
                        <div class="card shadow-lg rounded border" style="width: 18rem;">
                            <div class="card-body">
                                <h5 class="card-title text-primary">Numero de compra: ${element.idcompra}</h5>
                                <h6 class="card-subtitle mb-2 text-muted">ID producto: ${element.idproducto}</h6>
                                <p class="card-text">Cantidad comprada: ${element.cicantidad}</p>
                                <button class="btn btn-success mt-2" onclick="traerHistorico(${element.idcompra})">Ver Historico</button>
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
            data: {idcompra: idcompra},
            success: function (data) {
                data = JSON.parse(data);
                console.log(data);
                
                let container = $('<div class="container-sm"></div>');
                
                container.append('<h1 class="text-center text-success my-4">Histórico de Compra</h1>');

                data.forEach(element => {
                    container.append(`
                        <div class="card mb-4 shadow-sm border-success" style="width: 18rem;">
                            <div class="card-body">
                                <div class="card-title text-primary">Numero de compra: ${element.idcompra}</div>
                                <div class="card-subtitle mb-2 text-muted">Inicio: ${element.cefechaini}</div>
                                <p class="card-text">Terminó: ${element.cefechafin}</p>
                                <p class="card-subtitle mb-2 text-muted">Estado de la compra: ${element.idcompraestado}</p>
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