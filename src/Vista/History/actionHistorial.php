<?php
include '../../../config.php';
$session->usuarioNoLogeado();

header('Content-Type: application/json');
$abmUsuario = new abmUsuario();
echo json_encode($abmUsuario->obtenerHistorial());