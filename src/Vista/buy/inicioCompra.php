<?php 
include '../estructura/cabeceraSegura.php';
$datos = data_submitted();
?>

<div id='mensajeOperacion'></div>
<main class="container-sm min-height-50">
    <section class="m-5 d-flex flex-row">
        <div class="d-flex flex-column justify-content-between w-80 mr-1">
            <div id="prueba"></div>
        </div>
        <div class="w-25 p-3 bg-light">
            <div class="p-3 shadow-sm">
                <h3>Resumen de Compra</h3>
                <div class="d-flex justify-content-between mt-3">
                    <span class="fs-5">Total:</span>
                    <div id="total" class="fs-5"></div>
                </div>
                <div class="d-flex justify-content-center mt-3">
                    <button class="btn btn-primary" onclick="pago()">Confirmar</button>
                </div>
            </div>
        </div>
    </section>
</main>


<script>
    var datos = <?php echo json_encode($datos['productos']); ?>;
</script>

<script src="../Assets/inicioCompra.js"></script>

