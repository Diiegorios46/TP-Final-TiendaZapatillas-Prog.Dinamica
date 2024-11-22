<?php
include '../../../config.php';
//header('Content-Type: application/json');

$abmUsuario = new abmUsuario();
$objUsuario = $session->getUsuario();
$datos = data_submitted();
$datos['idusuario'] = $objUsuario['idusuario'];

$datos['accion'] = 'editar';

if ($abmUsuario->abm($datos)) {
    echo json_encode('Usuario editado correctamente');

} else {
    echo json_encode('Error al editar el usuario');
}

?>