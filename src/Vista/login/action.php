<?php
include '../../../config.php';

$datos = data_submitted();

$datos['password'] = md5($datos['password']);

if($session->iniciar($datos['mail'], $datos['password'])){
    $mensaje = '1';
} else {
    $mensaje = '0';
}

echo $mensaje;