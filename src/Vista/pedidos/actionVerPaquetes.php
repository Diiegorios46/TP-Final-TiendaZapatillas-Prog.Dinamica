<?php
include '../../../config.php';

$rol = $session->getRol();
if($rol == 1 || $rol == 2){
    header('Content-Type: application/json');
    
    $compraItem = new abmCompraItem();
    $comprasEstado = new abmCompraEstado();
    $productos = new abmProducto();
    
    $comprasItemsTotales = $compraItem->obtenerDatos(null);
    $idcompras = [];
    
    foreach ($comprasItemsTotales as $compra) {
        $arrayidCompraItem[] = $compra['idcompra'];
    }
    
    $comprasEstadoTotales = $comprasEstado->obtenerDatos(['idcompraestadotipo' => 1]);
    
    $comprasFiltradas = [];
    
    foreach ($arrayidCompraItem as $idCompraItem) {
        foreach ($comprasEstadoTotales as $compraEstado) {
            if ($compraEstado['idcompra'] == $idCompraItem) {
                $comprasFiltradas[] = $compraEstado['idcompra'];
            }
        }
    }
    
    $comprasItems = [];
    foreach ($comprasFiltradas as $compraFiltrada) {
        $comprasItems[] = $compraItem->obtenerDatos(['idcompra' => $compraFiltrada])[0];
    }
    $compraItem = null;
    
    foreach($comprasItems as $compraItem){
        $producto = $productos->obtenerDatos(['idproducto' => $compraItem['idproducto']])[0];
        $compraItem['cicantstock'] = $producto['procantstock'];
    }
    unset($compraItem); 
    
    echo json_encode($comprasItems);
} else{
    echo json_encode("No tiene permisos");
}


