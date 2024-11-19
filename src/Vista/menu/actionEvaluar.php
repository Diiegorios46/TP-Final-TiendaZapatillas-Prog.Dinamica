<?php
include '../../../config.php';

$datos = data_submitted();
$compraItem = new abmCompraItem();
$compraItemData = $compraItem->obtenerDatos($datos)[0];

$producto = new abmProducto();
$productData = $producto->obtenerDatos(['idproducto' => $compraItemData['idproducto']])[0];
$compraItemData['cantestock'] = $productData['procantstock'];

if ($compraItemData['cantestock'] >= $compraItemData['cicantidad'] && $datos['estado'] == 1) {
    $compraEstado = new abmCompraEstado();
    $compraEstadoData = $compraEstado->obtenerDatos(['idcompra' => $compraItemData['idcompra']])[0];
    $compraEstadoData['accion'] = 'editar';
    $compraEstadoData['idcompraestadotipo'] = 2;
    $compraEstado->abm($compraEstadoData);
    $productData['accion'] = 'editar';
    $productData['procantstock'] = $compraItemData['cantestock'] - $compraItemData['cicantidad'];
    $producto->abm($productData);
} else {
    $compraItemData['mensaje'] = 'OK';
}

verEstructura($productData);