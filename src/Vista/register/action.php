<?php

include '../../../config.php';

$datos = data_submitted();
$abmUsuario = new abmUsuario();
$session = new Session();
$datos['accion'] = 'nuevo';

if($abmUsuario->alta($datos)){
    $session->iniciar($datos['usnombre'], $datos['uspass']);
    header('Location: ../login/action.php');
}else{
    header('Location: ./index.php?error=1');
}