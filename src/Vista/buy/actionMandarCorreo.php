<?php
include '../../../config.php';
$abmCompra = new abmCompra();
$datos = data_submitted();
$estado = $datos['estado'];

if($abmCompra->enviarCorreo($datos)) {
    echo json_encode($estado);
} else {
 echo json_encode("Usuario no logueado");
}
