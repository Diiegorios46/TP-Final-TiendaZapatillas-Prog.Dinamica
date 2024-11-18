<?php
include '../../../config.php';
// header('apllication/json');
$compraEstado = new abmCompraEstado();

$compras = $compraEstado->obtenerDatos(['idcompraestadotipo' => '1']);

echo json_encode($compras);