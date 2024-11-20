<?php

include '../../../config.php';
header('Content-Type: application/json');
$abmProducots = new abmProducto();
$datos = data_submitted();

if($session->getUsuario() != null){
    $productos = $abmProducots->obtenerDatos(null);

    $productosFiltros = [];

    if(isset($datos['price'])) {
        if($datos['price'] == 1){
            foreach ($productos as $producto) {
                if($producto['proprecio'] <= 100){
                    $productosFiltros[] = $producto;
                } 
            }
        } else if($datos['price'] == 2){
            foreach ($productos as $producto) {
                if($producto['proprecio'] > 100 && $producto['proprecio'] <= 200){
                    $productosFiltros[] = $producto;
                } 
            }
        } else if($datos['price'] == 3){
            foreach ($productos as $producto) {
                if($producto['proprecio'] > 200){
                    $productosFiltros[] = $producto;
                } 
            }
        } else {
            $productosFiltros = $productos;
        }
    } else {
        $productosFiltros = $productos;
    }

    if(isset($datos['priceMarca'])){
        $productosFiltros2 = [];
        if($datos['priceMarca'] == 'vans'){
            foreach ($productosFiltros as $producto) {
                if($producto['promarca'] == 'vans'){
                    $productosFiltros2[] = $producto;
                } 
            }
        } else if($datos['priceMarca'] == 'topper'){
            foreach ($productosFiltros as $producto) {
                if($producto['promarca'] == 'topper'){
                    $productosFiltros2[] = $producto;
                } 
            }
        } else if($datos['priceMarca'] == 'nike'){
            foreach ($productosFiltros as $producto) {
                if($producto['promarca'] == 'nike'){
                    $productosFiltros2[] = $producto;
                } 
            }
        } else if($datos['priceMarca'] == 'adidas'){
            foreach ($productosFiltros as $producto) {
                if($producto['promarca'] == 'adidas'){
                    $productosFiltros2[] = $producto;
                } 
            }
        } else {
            $productosFiltros2 = $productosFiltros;
        }
    }

    // verEstructura($productosFiltros);    
    echo json_encode($productosFiltros2);
} else {
    $productos = $abmProducots->obtenerDatosSeguros(null);
    echo json_encode($productos);
}