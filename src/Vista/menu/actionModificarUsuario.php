<?php
include '../../../config.php';

$datos = data_submitted();
$datos['accion'] = 'editar';

$abmUsuario = new abmUsuario();
$abmUsuarioRol = new abmUsuarioRol();

switch ($datos['rodescripcion']) {
    case "Administrador":
        $datos['idrol'] = 1;
        break;

    case "Deposito":
        $datos['idrol'] = 2;
        break;
    case "Cliente":
        $datos['idrol'] = 3;
        break;
}

$usuariorol = $abmUsuarioRol->obtenerDatos($datos['idusuario']);

try {
    if($abmUsuario->abm($datos) && $abmUsuarioRol->abm($datos)){
        echo json_encode('Usuario editado correctamente');
    } else {
        echo json_encode('Error al editar el usuario');
    }
} catch (Exception $e) {
    echo json_encode('Error al agregar el el usuario');
}
?>
