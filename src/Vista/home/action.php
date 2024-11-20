<?php

include '../../../config.php';
$abmProducots = new abmProducto();

if($session->getUsuario() != null){
    $productos = $abmProducots->obtenerDatos(null);
} else {
    $productos = $abmProducots->obtenerDatosSeguros(null);
}

echo json_encode($productos);