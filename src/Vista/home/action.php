<?php

include '../../../config.php';

$abmProducots = new abmProducto();

$productos = $abmProducots->obtenerDatos(null);
//verEstructura($productos);
echo json_encode($productos);