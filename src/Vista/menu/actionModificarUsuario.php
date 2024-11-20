<?php
include '../../../config.php';

$datosNuevosUsuario = data_submitted();
$abmUsuario = new abmUsuario();
$abmUsuarioRol = new abmUsuarioRol();

$usuarioViejo = $abmUsuario->obtenerDatos(['idusuario' => $datosNuevosUsuario['idusuario']])[0];
$abmUsuarioRol->obtenerDatos(['idusuario' => $datosNuevosUsuario['idusuario']])['idrol'];

verEstructura($abmUsuarioRol->obtenerDatos(['idusuario' => $datosNuevosUsuario['idusuario']])[0]);
// verEstructura($usuarioViejo);

// $datos = [];
// $datos['accion'] = 'editar';

// foreach ($datosNuevosUsuario as $key => $value) {
//     if ($value != $usuarioViejo[$key]) {
//         $datos[$key] = $value;
//     } else {
//         $datos[$key] = $usuarioViejo[$key];
//     }
// }

// if ($abmUsuarioRol->abm($datos)) {
//     echo "Usuario modificado con éxito";
// } else {
//     echo "Error al modificar el usuario";
// }
// ?>