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
            
            data.forEach(element => {
                $('#contenido').append(`
                <div class="card" style="width: 18rem;">
                <div class="card-body">
                <h5 class="card-title">Numero de compra: ${element.idcompra}</h5>
                <h6 class="card-subtitle mb-2 text-muted">id producto: ${element.idproducto}</h6>
                <p class="card-text">Cantidad comprada: ${element.cicantidad}</p>
                </div>
                <div><button onclick="traerHistorico(${element.idcompra})">ver historico</button></div>
                </div>
                `);
            });
            
        }
    })
    function traerHistorico(idcompra){
        $.ajax({
            url: './action.php',
            type: 'POST',
            data: {idcompra: idcompra},
            success: function (data) {
                data = JSON.parse(data);
                console.log(data);
                // $('#contenido').html('');
                // data.forEach(element => {
                //     $('#contenido').append(`
                //     <div class="card" style="width: 18rem;">
                //     <div class="card-body">
                //     <h5 class="card-title">Numero de compra: ${element.idcompra}</h5>
                //     <h6 class="card-subtitle mb-2 text-muted">id producto: ${element.idproducto}</h6>
                //     <p class="card-text">Cantidad comprada: ${element.cicantidad}</p>
                //     </div>
                //     </div>
                //     `);
                // });
            }
        })
    }

</script>