<?php
include '../../../config.php';
$abmCompra = new abmCompra();

$datos = data_submitted();

echo json_encode($abmCompra->obtenerHistorico($datos['idcompra']));