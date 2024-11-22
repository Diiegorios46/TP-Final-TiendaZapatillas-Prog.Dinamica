<?php
include '../../../config.php';

$rol = $session->getRol();
if($rol != 1 && $rol != 2){
    header('Location: ../home/index.php');
}


header('Content-Type: application/json');
$abmProducto = new abmProducto();
$listaProductos = $abmProducto->obtenerDatos(null);


echo json_encode($listaProductos);

?>
