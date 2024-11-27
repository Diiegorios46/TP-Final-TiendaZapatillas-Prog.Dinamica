<?php

include '../../../config.php';
// header('Content-Type: application/json');
$abmProductos = new abmProducto();
$datos = data_submitted();

echo json_encode($abmProductos->listarDeposito());