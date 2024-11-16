<?php
include '../../../config.php';
header('Content-Type: application/json');
$datos = data_submitted();
$datos['accion'] = 'nuevo';
$datos['idproducto'] = null;
foreach ($_FILES['image']['tmp_name'] as $key => $tmp_name) {
    $datos['proimagen' . ($key + 1)] = base64_encode(file_get_contents($tmp_name));
}
unset($datos['image']);

$abmProducto = new abmProducto();

try {
    
    if($abmProducto->abm($datos)){
        echo json_encode('Producto agregado correctamente');
    } else {
        //echo json_encode('Error al agregar el producto');
        echo json_encode($datos);
    }
} catch (Exception $e) {
   // echo json_encode('Error al agregar el producto');
}

// echo json_encode($datos);
?>