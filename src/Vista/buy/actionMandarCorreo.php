<?php
include '../../../config.php';
// header('Content-Type: application/json');
$abmCompra = new abmCompra();

$datos = data_submitted();
$estado = $datos['estado'];
$cliente = $session->getUsuario();

verEstructura($datos);


// if ($cliente != null) {
//     $headers = "From: zapatillasempresaseria@gmail.com\r\n";
//     $headers .= "To: {$cliente['usmail']}\r\n";
//     $headers .= 'X-Mailer: PHP/' . phpversion();
//     if($estado == 'iniciado'){
//         $to = $cliente['usmail'];
//         $pedidos = $datos['productos'];
//         $subject = "Sus pedidos están siendo procesados";
//         $message = "Gracias por tu compra ".$cliente['usnombre']."!. Te informamos que tus pedidos están siendo procesados por separado, 
//         esto quiere decir que evaluamos individualmente para que en caso de no contar con el stock de un solo par, nos aseguramos que te lleguen los demas, 
//         puede ocurrir que los paquetes los recibas en diferido.\n
//         Tienes un total de ".count($pedidos)." pedidos activos.\n
//         -------------------------\n";
//         foreach ($pedidos as $pedido) {
//             $message .= "Producto: " . $pedido['nombre'] . "\n";
//             $message .= "Cantidad: " . $pedido['cantidad'] . "\n";
//             $message .= "Precio Total: $" . $pedido['precio'] * $pedido['cantidad'] . " USD\n";
//             $message .= "-------------------------\n";
//         }
//         mail($to, $subject, $message, $headers);
//     }
    
//     if ($estado == 'aceptado'){
//         // echo 'aceptado';
//         $compra = $datos['compra'];
//         $abmCompraItem = new abmCompraItem();
//         $abmProducto = new abmProducto();
//         $abmUsuario = new abmUsuario();
//         $abmCompra = new abmCompra();
//         $compraItem = $abmCompraItem->obtenerDatos(['idcompra' => $compra])[0];
//         $producto = $abmProducto->obtenerDatos(['idproducto' => $compraItem['idproducto']])[0];
//         $compra = $abmCompra->obtenerDatos(['idcompra' => $compra])[0];
//         $cliente = $abmUsuario->obtenerDatos(['idusuario' => $compra['idusuario']])[0];
//         $to = $cliente['usmail'];


//         $subject = "Su pedido por el producto ".$producto['pronombre']." ha sido aceptado";
//         $message = "Gracias por tu compra ".$cliente['usnombre']."!
//         su pedido se ha aceptado, en breve se le enviará un correo avisando cuando este despachado.
//         debera llegarle ". $compraItem['cicantidad'] ." unidades del producto y el precio abonado fue de $". $compraItem['cicantidad'] * $producto['proprecio'] ." USD\n";
//         mail($to, $subject, $message, $headers);
//         $estado = 'listoParaEnviar';
//     }

//     if($estado == 'rechazado'){
//         $compra = $datos['compra'];
//         $abmCompraItem = new abmCompraItem();
//         $abmProducto = new abmProducto();
//         $abmUsuario = new abmUsuario();
//         $abmCompra = new abmCompra();
//         $compraItem = $abmCompraItem->obtenerDatos(['idcompra' => $compra])[0];
//         $producto = $abmProducto->obtenerDatos(['idproducto' => $compraItem['idproducto']])[0];
//         $compra = $abmCompra->obtenerDatos(['idcompra' => $compra])[0];
//         $cliente = $abmUsuario->obtenerDatos(['idusuario' => $compra['idusuario']])[0];
//         $to = $cliente['usmail'];
//         $subject = "Su pedido por el producto ".$producto['pronombre']." ha sido rechazado";
//         $message = "Gracias por confiar en nosotros ".$cliente['usnombre']."!.
//         Lamentablemente no podemos completar su pedido ya que ha solicitado una cantidad de productos mayor al stock disponible. 
//         Le pedimos disculpas por cualquier inconveniente que esto pueda causar.
//         En un plazo de 72hs habiles se le devolverá el dinero abonado por el pedido.\n";
//         mail($to, $subject, $message, $headers);
//     }
//     if ($estado == 'listoParaEnviar'){
//         $compra = $datos['compra'];
//         $abmCompraItem = new abmCompraItem();
//         $abmProducto = new abmProducto();
//         $abmUsuario = new abmUsuario();
//         $abmCompra = new abmCompra();
//         $compraItem = $abmCompraItem->obtenerDatos(['idcompra' => $compra])[0];
//         $producto = $abmProducto->obtenerDatos(['idproducto' => $compraItem['idproducto']])[0];
//         $compra = $abmCompra->obtenerDatos(['idcompra' => $compra])[0];
//         $cliente = $abmUsuario->obtenerDatos(['idusuario' => $compra['idusuario']])[0];
//         $to = $cliente['usmail'];
//         $subject = "Su pedido por el producto ".$producto['pronombre']." ha sido despachado";
//         $message = "Gracias por tu compra ".$cliente['usnombre']."!
//         su pedido ha sido despachado.
//         debera llegarle ". $compraItem['cicantidad'] ." unidades del producto y el precio abonado fue de $". $compraItem['cicantidad'] * $producto['proprecio'] ." USD\n";
//         mail($to, $subject, $message, $headers);
//     }
//     echo json_encode($estado);
// } else {
//     echo json_encode("Usuario no logueado");
// }
