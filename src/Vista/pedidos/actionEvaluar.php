<?php
include '../../../config.php';
$session->usuarioSinPermiso();

// header('Content-Type: application/json');
$datos = data_submitted();
$abmCompra = new abmCompra();

$abmCompra->evaluarCompra($datos);
?>

