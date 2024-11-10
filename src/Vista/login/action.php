<?php

include '../../../config.php';

$session = new Session();

verEstructura($_POST);

$usuario = $_POST['usuario'];
$clave = $_POST['clave'];

if($session->iniciar($usuario, $clave)){
    header('Location: ../home/index.php');
} else {
    header('Location: ../login/index.php?error=1');
}
