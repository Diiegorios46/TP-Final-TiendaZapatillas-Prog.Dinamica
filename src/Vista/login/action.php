<?php
include '../../../config.php';
header('Content-Type: application/json');
$datos = data_submitted();

$datos['password'] = md5($datos['password']);
$mensaje = '0';

if($session->iniciar($datos['mail'], $datos['password'])){
    $mensaje = '1';
} 

echo json_encode($mensaje);