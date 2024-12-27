<?php

include '../../../config.php';
$session->usuarioNoLogeado();
header('Content-Type: application/json');
$abmCompraEstado = new abmCompraEstado();
echo json_encode($abmCompraEstado->obtenerDatos(['cefechafin' => "0000-00-00 00:00:00" , 'idcompraestadotipo' => '1']));