<?php
include '../estructura/cabecera.php';

$abmProducto = new abmProducto();
$listaProductos = $abmProducto->obtenerDatos(null);

?>

<div class="container-sm border border-dark">

    <div>
        <h1 class="deposito-title">Modificar productos</h1>
    </div>

    <section class="container-sm d-flex gap">
        <div class="w-75 justify-content-center align-content-start">
            <div class="row mt-4 mb-4">
        <?php
        foreach ($listaProductos as $i => $producto) {
            if ($i % 8 == 0 && $i != 0) {
                echo '</div><div class="row mt-4 mb-4">'; 
            }
        ?>
            <div class="col w-25 h-100">
                <div class="card d-flex w-100 h-100 p-3 shadow-sm">
                    <div class="card-img w-100">
                        <img src="data:image/jpg;base64,<?php echo $producto['proimagen1']; ?>" alt="Producto" class="img-fluid w-100 h-100">
                    </div>
                    <div class="card-marca">Marca: <?php echo $producto['promarca']; ?></div>
                    <div class="card-infoZapatillas data-nombre">Producto: <?php echo $producto['pronombre']; ?></div>
                    <div class="card-precioMasDescuento">
                        <span class="data-precio">$<?php echo $producto['proprecio']; ?></span>
                        <span>10% off</span>
                    </div>
                    <div class="card-button text-center pt-3">
                        <button class="btn btn-dark p-2 agregarCarrito" id="myButton" onclick="">Modificar</button>
                    </div>
                </div>
            </div>
        <?php } ?>
            </div>
        </div>

    </section>

    </div>
</div>