<?php
include '../../../config.php';
// header('Content-Type: application/json');
$abmMenu = new abmMenu();

echo json_encode($abmMenu->obtenerBotones($session->getUsuario()));
?>