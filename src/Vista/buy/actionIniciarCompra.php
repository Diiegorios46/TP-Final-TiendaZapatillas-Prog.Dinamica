<?php
include '../../../config.php';

$abmCompraEstado = new abmCompraEstado();
$abmCompra = new abmCompra();
$abmCompraItem = new abmCompraItem();

$datos = data_submitted();

echo json_encode($datos);
// $idUsuario = $session->getUsuario()['idusuario'];

// $datos['accion'] = 'nuevo';
// $datos['idusuario'] = $idUsuario;
// $datos['cofecha'] = date('Y-m-d H:i:s');

// if($abmCompra->abm($datos)){

// }else{
//     echo json_encode("Se lesiono");
// }