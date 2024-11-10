<?php

include '../estructura/cabecera.php';
$session = new Session();

echo '<h1>ESTAS EN EL LOGIN</h1>';


echo '<form action="./action.php" method="POST">
        <label for="usuario">Usuario</label> 
        <input type="text" name="usuario" id="usuario"> 
        <label for="clave">Clave</label> 
        <input type="password" name="clave" id="clave"> 
        <input type="submit" value="Ingresar">
    ';

if(isset($_GET['error'])){
    echo '<h2>Usuario o clave incorrectos</h2>';
}