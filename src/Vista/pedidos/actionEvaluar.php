<?php
include '../../../config.php';
$rol = $session->getRol();
header('Content-Type: application/json');

$datos = data_submitted();
$mensaje = 'Procesando su solicitud...';
$tipoAlerta = 'alert-info';

verEstructura($datos);





















































//$mensaje = `<div class='alert $tipoAlerta alert-dismissible fade show text-center'>$mensaje`;
//echo json_encode($mensaje);
?>
