<?php
include '../../../config.php';
$session->usuarioSinPermiso();

$abmCompra = new abmCompra();
$datos = data_submitted();

// verEstructura($datos);
if($abmCompra->iniciarCompra($datos)){
    echo json_encode('Compra iniciada correctamente');
} else {
    echo json_encode('Error al iniciar la compra');
}