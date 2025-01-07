<?php
include '../estructura/cabecera.php';

$session = new Session();
$datos = data_submitted();
if(isset($datos['login']) && $datos['login'] == 1){
   echo '<div class="alert alert-success" role="alert">Usuario registrado correctamente.</div>';
}

?>
<main class="container w-32 h-100 mt-5 pt-5 h-100">
    <section class="login-container bg-form rouded-modify shadow">

        <div class="text-center fs-2 pt-4 pb-4">
            <span>Login</span>
        </div>

        <form class="w-100 d-flex flex-column" method="post" id="login">
            <div class="mt-3 ml-2 mb-2 mr-2">
                <input type="mail" name="mail" id="usmail" class="fancy-input rounded-pill" placeholder="Correo Electronico">
            </div>
            <div class="mt-3 ml-2 mb-4 mr-2">
                <input type="password" name="password" id="uspass" class="fancy-input rounded-pill img-input-contraseña" placeholder="Contraseña">
            </div>
            <div class="d-flex w-70 align-self-center mb-2">
                <input type="submit" name="btnenviar" id="btnenviar" class="btn-enviar rounded-pill" value="Enviar">
            </div>
            <div class="d-flex w-100 h-100 align-content-start justify-content-center mb-5">
                <span>¿No tenes cuenta?<a href="../register/index.php"> Registrarte</a></span>
            </div>
        </form>
        
    </section>
</main>

<script src="../Assets/login.js"></script>