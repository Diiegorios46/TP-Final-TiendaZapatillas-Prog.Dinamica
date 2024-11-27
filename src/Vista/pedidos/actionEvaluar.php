<?php
include '../../../config.php';
$rol = $session->getRol();
// header('Content-Type: application/json');

$datos = data_submitted();
$mensaje = 'Procesando su solicitud...';
$tipoAlerta = 'alert-info';

$abmCompra = new abmCompra();

$abmCompra->evaluarCompra($datos);

// if ($datos['estado'] == 1) {
//     $compraItem = new abmCompraItem();
//     $compraEstado = new abmCompraEstado();
//     $compraItemData = $compraItem->obtenerDatos($datos)[0] ?? null;

//     $producto = new abmProducto();
//     $productData = $producto->obtenerDatos(['idproducto' => $compraItemData['idproducto']])[0] ?? null;

//     $compraItemData['cantestock'] = $productData['procantstock'];

//     $compraEstadoData = $compraEstado->obtenerDatos(['idcompra' => $compraItemData['idcompra']])[0] ?? null;

//     $compraEstadoData['accion'] = 'editar';
//     $compraEstadoData['idcompraestadotipo'] = 2;
//     $compraEstado->abm($compraEstadoData);
//     $productData['accion'] = 'editar';
//     $productData['procantstock'] = $compraItemData['cantestock'] - $compraItemData['cicantidad'];

//     if ($producto->abm($productData)) {
//         $compraEstadoData['idcompraestadotipo'] = 3;
//         $compraEstadoData['cefechafin'] = date('Y-m-d H:i:s');
//         if ($compraEstado->abm($compraEstadoData)) {
//             $tipoAlerta = 'alert-success';
//             $mensaje = 'Compra aprobada';
//         } else {
//             $tipoAlerta = 'alert-danger';
//             $mensaje = 'No se pudo actualizar el estado de la compra';
//         }
//     } else {
//         $tipoAlerta = 'alert-danger';
//         $mensaje = 'No se pudo actualizar el stock del producto';
//     }
// } else if ($datos['estado'] == 0) {
//     $compraEstado = new abmCompraEstado();
//     $compraEstadoData = $compraEstado->obtenerDatos($datos)[0] ?? null;

//     $compraEstadoData['accion'] = 'editar';
//     $compraEstadoData['idcompraestadotipo'] = 4;
//     $compraEstadoData['cefechafin'] = date('Y-m-d H:i:s');
//     $compraEstado->abm($compraEstadoData);
//     $tipoAlerta = 'alert-warning';
//     $mensaje = 'El paquete no sera enviado';
// }

// $mensaje = `<div class='alert $tipoAlerta alert-dismissible fade show text-center'>$mensaje`;
// echo json_encode($mensaje);
?>
