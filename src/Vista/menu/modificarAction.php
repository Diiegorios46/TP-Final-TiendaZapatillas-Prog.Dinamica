<?php
include '../../../config.php';
// header('Content-Type: application/json');

$nuevosDatosProducto = data_submitted();

$producto = new abmProducto();
$productoViejo = $producto->obtenerDatos(['idproducto' => $nuevosDatosProducto['idproducto']])[0];

$datos = [];
$datos['accion'] = 'editar';
echo json_encode($productoViejo);

foreach ($nuevosDatosProducto as $key => $value) {
    
    if (empty($productoViejo[$key]) || $value != $productoViejo[$key]) {
        if($key == 'proimagen1'){
            $datos['proimagen1'] = base64_encode(file_get_contents($nuevosDatosProducto['proimagen1']));
            unset($datos['image']);
            $datos[$key] = $value;
        } else{
            $datos[$key] = $value;
        }
    } else {
        $datos[$key] = $productoViejo[$key];
    }
}

if ($producto->abm($datos)) {
    echo json_encode("Producto modificado con éxito");
} else {
    echo json_encode("Error al modificar el producto");
}
?>