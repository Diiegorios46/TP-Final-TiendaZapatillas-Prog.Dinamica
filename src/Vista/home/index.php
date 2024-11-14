<?php

include '../estructura/cabecera.php';

$session = new Session();
$usuario = $session->getUsuario();

echo "<h1>ESTAS EN EL HOME</h1>";
if(isset($usuario['usnombre'])){
    echo "<h2>Bienvenido ".$usuario['usnombre']." 🫡</h2>";
}else{
    header("Location: ../public/index.php");
}

echo "<a href='./action.php'>Cerrar sesion</a>";


