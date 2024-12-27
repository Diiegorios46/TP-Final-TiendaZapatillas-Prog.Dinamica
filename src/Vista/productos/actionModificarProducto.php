<?php
include '../../../config.php';

$datos = data_submitted();
$abmProducto = new abmProducto();
$datos['accion'] = 'editar';

$abmProducto->actualizaDatosProductos($datos);

if ($abmProducto->abm($datos)) {
    echo json_encode("Producto modificado con éxito");
} else {
    echo json_encode("Error al modificar el producto");
}
?>