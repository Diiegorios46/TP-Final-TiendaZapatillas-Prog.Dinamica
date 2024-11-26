<?php
include '../../../config.php';
$abmCompraItem = new abmCompraItem();

$datos = data_submitted();

echo json_encode($datos);