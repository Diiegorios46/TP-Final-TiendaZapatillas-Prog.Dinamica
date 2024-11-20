<?php
include '../../../config.php';

$datosNuevosUsuario = data_submitted();
$abmUsuario = new abmUsuario();
$abmUsuarioRol = new abmUsuarioRol();
$abmRol = new abmRol();
$usuarioViejo = $abmUsuario->obtenerDatos(['idusuario' => $datosNuevosUsuario['idusuario']])[0];
$datosNuevosUsuario['idrol'] = $abmRol->obtenerDatos(['rodescripcion' => $datosNuevosUsuario['rodescripcion']])[0]['idrol'];

$datos = [];
$datos['accion'] = 'editar';
$datos['uspass'] = $usuarioViejo['uspass'];

foreach ($datosNuevosUsuario as $key => $value) {
    if ($value != $usuarioViejo[$key]) {
        $datos[$key] = $value;
    } else {
        $datos[$key] = $usuarioViejo[$key];
    }
}

if ($abmUsuario->abm($datos)) {
    if($abmUsuarioRol->abm($datos)){
        echo "Usuario modificado correctamente";
    } else {
        echo "Error al modificar el rol del usuario";
    }
} else {
    echo "Error al modificar el usuario";
}
?>