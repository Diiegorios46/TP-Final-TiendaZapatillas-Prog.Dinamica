<?php
include '../../../config.php';
header('Content-Type: application/json');

$abmUsuario = new abmUsuario();
$abmRol = new abmRol();
$abmUsuarioRol = new abmUsuarioRol();

$listaUsuarioRol = $abmUsuarioRol->obtenerDatos(null);
$array = array();

foreach ($listaUsuarioRol as $arrayRelacionRolUsuario) {
    $rol = $abmRol->obtenerDatos(['idrol' => $arrayRelacionRolUsuario['idrol']]);
    $usuario = $abmUsuario->obtenerDatos(['idusuario' => $arrayRelacionRolUsuario['idusuario']]);
    
    if (!empty($rol) && !empty($usuario)) {
        if (isset($rol[0]['rodescripcion'])) {
            $usuario[0]['rodescripcion'] = $rol[0]['rodescripcion'];
        } 
        $array[] = $usuario[0];
    }
}

echo json_encode($array);
?>
