<?php
include '../../../config.php';
header('Content-Type: application/json');
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
    echo "Usuario modificado correctamente";
    if($abmUsuarioRol->abm($datos)){
        echo "Rol del usuario modificado correctamente";
    } else {
        echo "Error al modificar el rol del usuario";
    }
} else {
    echo "Error al modificar el usuario";
}
?>