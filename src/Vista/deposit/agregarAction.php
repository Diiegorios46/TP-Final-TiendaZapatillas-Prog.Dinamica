<?php
ob_start();
include '../estructura/cabecera.php';
$bd = new BaseDatos();

$datos = data_submitted();
$producto = new abmProducto();

if (isset($datos['submit'])) {
    $arrayImagenes = $datos['image'];
    $datos['idproducto'] = null;
    $datos['accion'] = 'nuevo';
    foreach ($arrayImagenes['tmp_name'] as $imagen) {
        $imagenes[] = base64_encode(file_get_contents($imagen));
    }

    $i = 1;
    foreach ($imagenes as $imagen) {
        $datos["proimagen$i"] = $imagen;
        $i++;
    }
    if ($producto->abm($datos)) {
        header('Location: ./index.php');
    } else {
        header('Location: ../../home/index.php');
    }
}
ob_end_flush();
?>