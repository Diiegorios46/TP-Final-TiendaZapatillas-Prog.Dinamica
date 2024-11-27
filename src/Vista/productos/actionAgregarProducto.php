<?php
include '../../../config.php';

$datos = data_submitted();
$abmProducto = new abmProducto();

$datos['accion'] = 'nuevo';

if($abmProducto->abm($datos)){
    echo json_encode("Producto agregado con exito");
} else {
    echo json_encode("Error al agregar el producto");
}
?>