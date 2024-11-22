<?php
include '../../../config.php';
//header('Content-Type: application/json');

$datos = data_submitted();
$datos['accion'] = 'borrar';

$abmUsuario = new abmUsuario();

try {
    if($abmUsuario->abm($datos)){
        echo json_encode('Usuario deshabilitado correctamente');
    } else {
        echo json_encode('Error al editar el usuario');
    }
} catch (Exception $e) {
    echo json_encode('Error al agregar el el usuario');
}
?>
