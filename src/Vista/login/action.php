<?php
include '../../../config.php';

$session = new Session();

$mail = $_POST['usmail'];
$clave = $_POST['uspass'];

if($session->iniciar($mail, $clave)){
    header('Location: ../home/index.php');
} else {
   header('Location: ../login/index.php?error=1');
}