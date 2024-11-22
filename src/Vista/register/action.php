<?php
include '../../../config.php';
$abmUsuario = new abmUsuario();

$datos = data_submitted();
$datos['accion'] = 'nuevo';
$mail['usmail'] = $datos['usmail'];
$datos['uspass'] = md5($datos['uspass']);


$mensaje = '';
if (!$abmUsuario->buscar($mail)) {
    if ($abmUsuario->alta($datos)) {
        $mensaje = 'success';
    } else {
        $mensaje = 'error';
    }
} else {
    $mensaje = 'email_exists';
}

echo json_encode($mensaje);