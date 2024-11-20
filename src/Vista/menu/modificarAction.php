<?php
include '../../../config.php';

$nuevosDatosProducto = data_submitted();
$producto = new abmProducto();
$productoViejo = $producto->obtenerDatos(['idproducto' => $nuevosDatosProducto['idproducto']])[0];

// verEstructura($nuevosDatosProducto);
$datos = [];
$datos['accion'] = 'editar';
$i=1;

foreach ($nuevosDatosProducto as $key => $value) {
    // echo $key . ' ' . $value . "///" . $productoViejo[$key] . "\n";
    if (empty($productoViejo[$key]) || $value != $productoViejo[$key]) {
        if($key == 'proimagen1'){
            $datos['proimagen1'] = base64_encode(file_get_contents($nuevosDatosProducto['proimagen1']));
            unset($datos['image']);
            $datos[$key] = $value;
        } else{
            $datos[$key] = $value;
        }
        echo "diferente " . $i++ . '<br>';
    } else {
        $datos[$key] = $productoViejo[$key];
    }
}

// verEstructura($datos);
if ($producto->abm($datos)) {
    echo "Producto modificado con éxito";
} else {
    echo "Error al modificar el producto";
}
?>