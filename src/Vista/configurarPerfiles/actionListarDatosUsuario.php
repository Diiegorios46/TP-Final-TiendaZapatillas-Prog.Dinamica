<?php
include '../../../config.php';
header('Content-Type: application/json');
$objUsuario = $session->getUsuario();

echo json_encode($objUsuario);