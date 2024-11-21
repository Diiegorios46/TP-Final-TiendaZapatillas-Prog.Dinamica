<?php
include '../../../config.php';
header('Content-Type: application/json');

$datos = data_submitted();
$mensaje = 'Procesando su solicitud...';
$tipoAlerta = 'alert-info';

if (isset($datos['estado']) && in_array($datos['estado'], [0, 1])) {
    if ($datos['estado'] == 1) {
        $compraItem = new abmCompraItem();
        $compraEstado = new abmCompraEstado();
        $compraItemData = $compraItem->obtenerDatos($datos)[0] ?? null;

        if ($compraItemData && isset($compraItemData['idproducto']) && $compraItemData['idproducto'] > 0) {
            $producto = new abmProducto();
            $productData = $producto->obtenerDatos(['idproducto' => $compraItemData['idproducto']])[0] ?? null;

            if ($productData) {
                $compraItemData['cantestock'] = $productData['procantstock'];

                if ($compraItemData['cantestock'] >= $compraItemData['cicantidad']) {
                    $compraEstadoData = $compraEstado->obtenerDatos(['idcompra' => $compraItemData['idcompra']])[0] ?? null;

                    if ($compraEstadoData) {
                        $compraEstadoData['accion'] = 'editar';
                        $compraEstadoData['idcompraestadotipo'] = 2;
                        $compraEstado->abm($compraEstadoData);
                        $productData['accion'] = 'editar';
                        $productData['procantstock'] = $compraItemData['cantestock'] - $compraItemData['cicantidad'];

                        if ($producto->abm($productData)) {
                            $compraEstadoData['idcompraestadotipo'] = 3;
                            $compraEstadoData['cefechafin'] = date('Y-m-d H:i:s');
                            if ($compraEstado->abm($compraEstadoData)) {
                                $tipoAlerta = 'alert-success';
                                $mensaje = 'Compra aprobada';
                            } else {
                                $tipoAlerta = 'alert-danger';
                                $mensaje = 'No se pudo actualizar el estado de la compra';
                            }
                        } else {
                            $tipoAlerta = 'alert-danger';
                            $mensaje = 'No se pudo actualizar el stock del producto';
                        }
                    } else {
                        $tipoAlerta = 'alert-danger';
                        $mensaje = 'No se pudo obtener el estado de la compra';
                    }
                } else {
                    $tipoAlerta = 'alert-danger';
                    $mensaje = 'No hay stock suficiente para realizar la compra, el pedido fue cancelado automaticamente';
                }
            } else {
                $tipoAlerta = 'alert-danger';
                $mensaje = 'No se pudo obtener los datos del producto';
            }
        } else {
            $tipoAlerta = 'alert-danger';
            $mensaje = 'No se pudo obtener el producto';
        }
    } else if ($datos['estado'] == 0) {
        $compraEstado = new abmCompraEstado();
        $compraEstadoData = $compraEstado->obtenerDatos($datos)[0] ?? null;

        if ($compraEstadoData) {
            $compraEstadoData['accion'] = 'editar';
            $compraEstadoData['idcompraestadotipo'] = 4;
            $compraEstadoData['cefechafin'] = date('Y-m-d H:i:s');
            $compraEstado->abm($compraEstadoData);
            $tipoAlerta = 'alert-warning';
            $mensaje = 'El paquete no sera enviado';
        } else {
            $tipoAlerta = 'alert-danger';
            $mensaje = 'No se pudo obtener el estado de la compra';
        }
    }
} else {
    $tipoAlerta = 'alert-danger';
    $mensaje = 'Datos de estado inválidos';
}

$mensaje =`<div class='alert $tipoAlerta alert-dismissible fade show text-center'>$mensaje`;
echo $mensaje;
?>
