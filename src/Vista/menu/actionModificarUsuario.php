<?php
include '../../../config.php';

$datos = data_submitted();
$datos['accion'] = 'editar';

$abmUsuario = new abmUsuario();

try {
    if($abmUsuario->abm($datos)){
        /// modifica perfecto ///
        echo json_encode('Usuario editado correctamente');
    } else {
        echo json_encode('Error al editar el usuario');
    }
} catch (Exception $e) {
    echo json_encode('Error al agregar el el usuario');
}
?>
