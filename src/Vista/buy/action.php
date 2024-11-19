<?php 
include_once '../../../config.php';
if(!isset($_SESSION['usuario'])){
    header('Location: ./inicioCompra.php');
}
$datos = data_submitted();
$datos['accion'] = 'compra';
echo json_encode($datos);
?>