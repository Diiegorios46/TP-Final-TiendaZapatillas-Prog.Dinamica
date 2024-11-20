<?php 
include_once '../../../config.php';

$datos = data_submitted();
$datos['accion'] = 'compra';
echo json_encode($datos);
?>