<?php
include '../../../config.php';
// header('Content-Type: application/json');
if ($session->getUsuario() == null) {
    header('Location: ./inicioCompra.php');
}
$datos = data_submitted();

$usuario = $session->getUsuario();
// echo json_encode($usuario);
$to = $usuario['usmail'];
$subject = "Se inicio el pedido";
$message = "Gracias por tu compra. Tu pedido está siendo procesado.";
$headers = "From: zapatillasempresaseria@gmail.com\r\n";
$headers .= "To: {$usuario['usmail']}\r\n";
$headers .= 'X-Mailer: PHP/' . phpversion();

if (mail($to, $subject, $message, $headers)) {
    echo json_encode("Email enviado");
} else {
    echo json_encode("Email no enviado");
}