<?php
include '../../../config.php';
// header('Content-Type: application/json');

$session = new Session();
$usuario = $session->getUsuario();

$abmProducto = new abmProducto();
$abmCompra = new abmCompra();
$abmCompraEstado = new abmCompraEstado();
$abmCompraEstadoTipo = new abmCompraEstadoTipo();
$abmCompraItem = new abmCompraItem();

$historial = [];

foreach($abmCompra->obtenerDatos(['idusuario' => $usuario['idusuario']]) as $compra){
    $compraEstado = $abmCompraEstado->obtenerDatos(['idcompra' => $compra['idcompra']])[0];
    if($compraEstado != null){
        $compraDatos['estadotipo'] = $abmCompraEstadoTipo->obtenerDatos(['idcompraestadotipo' => $compraEstado['idcompraestadotipo']])[0]['cetdescripcion'];
        $compraDatos['cefechaini'] = $compraEstado['cefechaini'];
        $compraDatos['cefechafin'] = $compraEstado['cefechafin'];
        $compraDatos['idcompra'] = $compra['idcompra'];
        $compraItems = $abmCompraItem->obtenerDatos(['idcompra' => $compra['idcompra']])[0];
        $compraDatos['cicantidad'] = $compraItems['cicantidad'];
        $producto = $abmProducto->obtenerDatos(['idproducto' => $compraItems['idproducto']])[0];
        $compraDatos['prodetalle'] = $producto['prodetalle'];
        $compraDatos['proprecio'] = $producto['proprecio'];
        $compraDatos['pronombre'] = $producto['pronombre'];
        $historial[] = $compraDatos;
    }
}


verEstructura($historial);