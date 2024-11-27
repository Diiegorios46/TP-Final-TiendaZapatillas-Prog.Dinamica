<?php
include '../../../config.php';
$session->usuarioSinPermiso();

header('Content-Type: application/json');
$compraItem = new abmCompraItem();

echo json_encode($compraItem->verPaquetes());

