<?php
include '../../../config.php';
// header('Content-Type: application/json');
$abmCompraItem = new abmCompraItem();
$compras = $abmCompraItem->obtenerDatos(null);

echo json_encode($compras);