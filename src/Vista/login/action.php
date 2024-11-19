<?php
include '../../../config.php';

$datos = data_submitted();

if($session->iniciar($datos['mail'], md5($datos['password']))){
    $mensaje = '1';
} else {
    $mensaje = '0';
}

echo $mensaje;