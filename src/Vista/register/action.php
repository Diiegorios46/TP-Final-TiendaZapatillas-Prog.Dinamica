<?php

include '../../../config.php';

$session = new Session();
$abmUsuario = new abmUsuario();

$datos = data_submitted();
$datos['accion'] = 'nuevo';
$mail['usmail'] = $datos['usmail'];

verEstructura($datos);

if($abmUsuario->buscar($mail)){
    header('Location: ./index.php?error=1'); // El correo ya esta registrado en la base de datos
} else {
   try {
    $abmUsuario->alta($_POST);
    header('Location: ../login/index.php?registro=1'); // Usuario registrado con exito
   } catch (Exception $e) {
    header('Location: ./index.php?error=2'); // Error al registrar usuario
   }
}