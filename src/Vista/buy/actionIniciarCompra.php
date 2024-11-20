<?php
include '../../../config.php';


$abmCompraEstado = new abmCompraEstado();
$abmCompra = new abmCompra();
$abmCompraItem = new abmCompraItem();

$datos = data_submitted();

$productos = $datos['productos'];

foreach($productos as $producto){
    $datos['accion'] = 'nuevo';
    $datos['idusuario'] = $session->getUsuario()['idusuario'];
    $datos['cofecha'] = date('Y-m-d H:i:s');
    $datos['idproducto'] = $producto['idproducto'];
    $datos['cicantidad'] = $producto['cantidad'];
    if($abmCompra->abm($datos)){
        echo json_encode("Se dio de alta");
    }else{
        echo json_encode("No se pudo dar de alta");
    }

}