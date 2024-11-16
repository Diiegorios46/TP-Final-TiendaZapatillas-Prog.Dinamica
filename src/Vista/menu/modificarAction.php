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
    if($abmProducto->buscar($datos)) {
        $datos['idproducto'] = $abmProducto->obtenerDatos($datos)[0]['idproducto'];
        $abmProducto->abm($datos);
        echo json_encode('Producto modificado con exito');
    } else {
        echo json_encode('No se encontro el producto');
    }
} catch (Exception $e) {
    echo json_encode('Error al agregar el producto');
}

echo json_encode($datos);
?>