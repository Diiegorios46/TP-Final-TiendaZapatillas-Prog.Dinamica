<?php
include '../../../config.php';
header('Content-Type: application/json');
$ambUsuario = new abmUsuario();
$listaUsuarios = $ambUsuario->obtenerDatos(null);
echo json_encode($listaUsuarios);

?>
