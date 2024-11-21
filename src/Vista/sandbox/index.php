<?php
// Datos dinámicos
$name = 'valen';
$asunto = 'este es el asunto';
$msg = 'negro manda 3 bitcoins o se filtras tus chats con la';
$email = 'zapatillasempresaseria@gmail.com';

// Cabeceras del correo
$header = 'From: ' . $email . "\r\n";
$header .= 'To: ' . "jgeslowski@gmail.com" . "\r\n";
$header .= 'X-Mailer: PHP/' . phpversion();

// Enviar el correo
$mail = mail($email, $asunto, $msg, $header);

// Verificar si el correo fue enviado
if($mail){
    echo 'enviado';
}else{
    echo 'no enviado';
}
?>