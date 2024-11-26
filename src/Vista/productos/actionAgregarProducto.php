<?php
include '../../../config.php';

$datos = data_submitted();
$abmProducto = new abmProducto();

$datos['accion'] = 'nuevo';
$datos['idproducto'] = null;

try {
    $imagen = $abmProducto->comprimirImagen($datos);
    $datos['proimagen1'] = $imagen['proimagen1'];

    if($imagen != []){
        if($abmProducto->abm($datos)){
            echo json_encode('Producto agregado correctamente');
        } else {
            echo json_encode('Error al agregar el producto');
        }
    }
} catch (Exception $e) {
    echo json_encode('Error al agregar el producto');
}

?>