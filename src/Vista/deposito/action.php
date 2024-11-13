<?php
include '../estructura/cabecera.php';
$bd = new BaseDatos();

$datos = data_submitted();
$producto = new abmProducto();


if (isset($datos['submit'])) {
    $arrayImagenes = $datos['image'];
    foreach ($arrayImagenes['tmp_name'] as $imagen) {
        $imagenes[] = base64_encode(file_get_contents($imagen));
    }

    $i=1;
    foreach($imagenes as $imagen){
        $datos["proimagen$i"] = $imagen;
        $i++;
    }

    verEstructura($datos);
    
}
?>