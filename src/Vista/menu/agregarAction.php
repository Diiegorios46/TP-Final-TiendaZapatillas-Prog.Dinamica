<?php
include '../../../config.php';
header('Content-Type: application/json');
$datos = data_submitted();
echo json_encode($datos);
?>