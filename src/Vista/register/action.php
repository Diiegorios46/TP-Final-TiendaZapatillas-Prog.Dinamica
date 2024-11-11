<?php

include '../../../config.php';

$session = new Session();
$abmUsuario = new abmUsuario();

$datos = data_submitted();
$datos['accion'] = 'nuevo';
$mail['usmail'] = $datos['usmail'];

verEstructura($datos);

if($abmUsuario->buscar($mail)){
    echo '<h1>El correo ya esta registrado en la base de datos</h1>';
} else {
    echo '<h1>El usuario es nuevo asi que lo vamos a registrar</h1>';
   try {
    $abmUsuario->alta($_POST);
    echo '<h1>Usuario registrado con exitoooo</h1>';
   } catch (Exception $e) {
       echo 'Error al registrar usuario';
   }
}