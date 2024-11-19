<?php

include '../../../config.php';

if($session->getUsuario() == null){
    header('Location: ./index.php');
}

$abmProducots = new abmProducto();

$productos = $abmProducots->obtenerDatos(null);
//verEstructura($productos);
echo json_encode($productos);