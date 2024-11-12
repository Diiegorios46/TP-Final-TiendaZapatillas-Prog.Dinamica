<?php
include '../../../config.php';
 $bd = new BaseDatos();

 $datos = data_submitted();

 if (isset($datos['submit'])) {

    $nose = file_get_contents($datos['image']['tmp_name'][0]);
    $nose = base64_encode($nose);
    echo $nose;
 }
?>