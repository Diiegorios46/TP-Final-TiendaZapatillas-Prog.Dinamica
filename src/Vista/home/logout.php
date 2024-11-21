<?php
include '../../../config.php';
if($session->getUsuario() == null){
    header('Location: ./index.php');
}
$session->destruir();

header('Location: ../login/index.php');