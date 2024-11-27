<?php
include '../../../config.php';
$abmUsuario = new abmUsuario();

$datos = data_submitted();
$mensaje = $abmUsuario->RegistroUsuario($datos);
echo json_encode($mensaje);