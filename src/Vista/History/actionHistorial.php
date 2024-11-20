<?php
include '../../../config.php';
// header('Content-Type: application/json');

$session = new Session();
$usuario = $session->getUsuario();

$abmProducto = new abmProducto();
$abmCompra = new abmCompra();
$abmCompraEstado = new abmCompraEstado();
$abmCompraItem = new abmCompraItem();

$historial = [];

foreach($abmCompra->obtenerDatos(['idusuario' => $usuario['idusuario']]) as $compra){
    $compraEstado = $abmCompraEstado->obtenerDatos(['idcompra' => $compra['idcompra']]);
    if($compraEstado[0] != null && $compraEstado['idcompraestadotipo'] == 3){
        $compraDatos['cefechaini'] = $compraEstado['cefechaini'];
        $compraDatos['cefechafin'] = $compraEstado['cefechafin'];
    }


}


verEstructura($compraDatos);
// pronombre, cefechaini, cefechafin, prodetalle, proprecio, cicantidad, idcompra   
