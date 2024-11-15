<?php 
include_once '../estructura/cabecera.php';
 new Compra();

$datos = data_submitted();
verEstructura($datos['productos']);
?>