<?php
include '../../../config.php';
// header('Content-Type: application/json');
$abmMenu = new abmMenu();
$abmUsuarioRol = new abmUsuarioRol();
$usuario = $session->getUsuario();
$idrol = $abmUsuarioRol->obtenerDatos(['idusuario' => $usuario['idusuario']])[0]['idrol'];
$menues = $abmMenu->obtenerDatos(['idpadre' => $idrol]);
echo json_encode($menues);
?>