<?php
include '../../../config.php';

$datosNuevosUsuario = data_submitted();
$abmUsuario = new abmUsuario();
$abmUsuarioRol = new abmUsuarioRol();
$abmRol = new abmRol();

$idUsuarioAux = $datosNuevosUsuario['idusuario'];
$roDescripcionAux = $datosNuevosUsuario['rodescripcion'];

$usuarioViejo = $abmUsuario->obtenerDatos(['idusuario' => $idUsuarioAux])[0];
$datosNuevosUsuario['idrol'] = $abmRol->obtenerDatos(['rodescripcion' => $roDescripcionAux])[0]['idrol'];

$datos = [];
$datos['accion'] = 'editar';
$datos['uspass'] = $usuarioViejo['uspass'];

unset($datosNuevosUsuario['rodescripcion']);

foreach ($datosNuevosUsuario as $key => $value) {
    if ($key != 'idrol' && $key != 'usdeshabilitado') {
        if ($value != $usuarioViejo[$key]) {
            $datos[$key] = $value;
        } else {
            $datos[$key] = $usuarioViejo[$key];
        }
    }
}
$datos['usdeshabilitado'] = $usuarioViejo['usdeshabilitado'];
$datos['idrol'] = $datosNuevosUsuario['idrol'];
if ($abmUsuario->abm($datos)) {
    echo json_encode("Usuario modificado correctamente");
    if($abmUsuarioRol->abm($datos)){
        echo json_encode("Rol del usuario modificado correctamente");
    } else {
        echo json_encode("Error al modificar el rol del usuario");
    }
} else {
    echo "Error al modificar el usuario";
}
?>