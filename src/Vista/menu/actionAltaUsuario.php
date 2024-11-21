<?php
include '../../../config.php';
//header('Content-Type: application/json');

$datos = data_submitted();
$datos['accion'] = 'nuevo';
$abmUsuario = new abmUsuario();
//verEstructura($datos);
try {
    if($abmUsuario->abm($datos)){
        echo json_encode('Usuario agregado correctamente');
    } else {
        echo json_encode('Error al agregar el producto');
    }
} catch (Exception $e) {
    echo json_encode('Error al agregar el el usuario');
}
?>

