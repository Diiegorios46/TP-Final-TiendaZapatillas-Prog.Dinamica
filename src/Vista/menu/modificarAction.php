<?php
include '../../../config.php';
header('Content-Type: application/json');

$datos = data_submitted();
$datos['accion'] = 'editar';

foreach ($datos['image']['tmp_name'] as $key => $tmp_name) {
    $datos['proimagen' . ($key + 1)] = base64_encode(file_get_contents($tmp_name));
}

unset($datos['image']);

$abmProducto = new abmProducto();

try {
    
    $datos['idproducto'] = $abmProducto->obtenerDatos($datos)[0]['idproducto'];
    $abmProducto->abm($datos);
    echo json_encode('Producto modificado con éxito');
} catch (Exception $e) {
    //echo json_encode('Error al agregar el producto');
}   
