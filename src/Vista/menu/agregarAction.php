<?php
include '../../../config.php';
// header('Content-Type: application/json');
$datos = data_submitted();
$datos['accion'] = 'nuevo';
$datos['idproducto'] = null;

if (isset($datos['image']['tmp_name'])) {
    $datos['proimagen1'] = "data:image/jpeg;base64,".base64_encode(file_get_contents($datos['image']['tmp_name'][0]));
}

unset($datos['image']);

$abmProducto = new abmProducto();

try {
    if($abmProducto->abm($datos)){
        echo 'Producto agregado correctamente';
    } else {
        echo json_encode('Error al agregar el producto');
    }
} catch (Exception $e) {
    echo json_encode('Error al agregar el producto');
}

?>