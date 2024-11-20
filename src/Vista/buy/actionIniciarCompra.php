<?php
include '../../../config.php';


$abmCompraEstado = new abmCompraEstado();
$abmCompra = new abmCompra();
$abmCompraItem = new abmCompraItem();

$datos = data_submitted();

$productos = $datos['productos'];

$i = 0;

foreach($productos as $producto){
    $datos['accion'] = 'nuevo';
    $datos['idusuario'] = $session->getUsuario()['idusuario'];
    $datos['cofecha'] = date('Y-m-d H:i:s');
    $datos['idproducto'] = $producto['idproducto'];
    $datos['cicantidad'] = $producto['cantidad'];
    if($abmCompra->abm($datos)){
        echo "Se creo la compra" . $i ."\n";
    }else{
        echo "Se lesiono";
    }
    $i++;
}