<?php
include '../estructura/cabecera.php';

//$datos = data_submitted();
$producto = new abmProducto();
$listaProductos = $producto->obtenerDatos(null);
$datos = data_submitted();

echo "<h1>";
echo $datos['idproducto'];
echo "</h1>";

if (isset($_SESSION['idproducto'])) {
    $idproducto = $_SESSION['idproducto'];  
} else {
    echo "Producto no encontrado."; 
}

foreach ($listaProductos as $i => $producto) {
    if ($producto['idproducto'] == $idproducto) {
        break;
    }
}

?>
<div class="container-sm border border-dark">
    <div>
        <h1 class="deposito-title">Modificar producto</h1>
    </div>

    <form action="modificarAction.php" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="idproducto" value="<?php echo $producto['idproducto']; ?>">

        <div class="mb-3">
            <label for="pronombre" class="form-label">Nombre del Producto</label>
            <label for="pronombre" class="form-label"></label>
            <input type="text" class="form-control" id="pronombre" name="pronombre" value="" placeholder="<?php echo $producto['pronombre']; ?>"required>
        </div>

        <div class="mb-3">
            <label for="proprecio" class="form-label">Precio</label>
            <input type="number" class="form-control" id="proprecio" name="proprecio"  placeholder="<?php echo $producto['proprecio']; ?>" required>
        </div>

        <div class="mb-3">
            <label for="promarca" class="form-label">Marca</label>
            <input type="text" class="form-control" id="promarca" name="promarca"  placeholder="<?php echo $producto['promarca']; ?>" required>
        </div>

        <div class="mb-3">
            <label for="prodetalle" class="form-label">Detalle</label>
            <textarea class="form-control" id="prodetalle" name="prodetalle" rows="3"  placeholder="<?php echo $producto['prodetalle']; ?>" required></textarea>
        </div>

        <div class="mb-3">
            <label for="procantstock" class="form-label">Cantidad en Stock</label>
            <input type="number" class="form-control" id="procantstock" name="procantstock"  placeholder="<?php echo $producto['procantstock']; ?>" required>
        </div>

        <div class="mb-3">
            <label for="proimagen1" class="form-label">Imagen (opcional)</label>
            <input type="file" class="form-control" id="proimagen1" name="proimagen1">
            <small>Deja este campo vacío si no deseas cambiar la imagen.</small>
        </div>

        <button type="submit" class="btn btn-dark">Actualizar Producto</button>
    </form>
</div>