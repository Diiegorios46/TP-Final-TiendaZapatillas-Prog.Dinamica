<?php
include '../../../config.php';

$datos = data_submitted();
$datos['accion'] = 'editar';

if (isset($datos['image']) && !empty($datos['image']['tmp_name'])) {
    foreach ($datos['image']['tmp_name'] as $key => $tmp_name) {
        $datos['proimagen' . ($key + 1)] = base64_encode(file_get_contents($tmp_name));
    }
    unset($datos['image']);
}

$abmProducto = new abmProducto();

try {
    if($abmProducto->abm($datos)){
        echo json_encode("Producto modificado con éxito");
     } else {
        echo json_encode("Error al modificar el producto");
    }
 } catch (Exception $e) {
 }
?>