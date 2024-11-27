<?php
include '../../../config.php';
$session->usuarioSinPermiso();

header('Content-Type: application/json');
$abmProducto = new abmProducto();
$listaProductos = $abmProducto->obtenerDatos(null);

echo json_encode($listaProductos);
?>
