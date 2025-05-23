<?php
include_once '../estructura/cabecera.php';
$datos = data_submitted();
?>

<main class="container w-32 h-100 mt-4">
    <section class="login-container bg-form rounded-modify shadow">
        <?php if(isset($datos['error'])) { ?>
            <div class="alert alert-danger" role="alert">
            <?php echo 'El correo electrónico ya está registrado.';?>
            </div>
        <?php }?>
        <div class="text-center fs-2 pt-4 pb-4">
            <span>Registrar</span>
        </div>
        <form class="w-100 d-flex flex-column" action="./action.php" id="loginForm" method="POST">
            <div class="mt-4 ml-2 mb-2 mr-2">
                <input type="text" name="usnombre" class="fancy-input rounded-pill img-input-usuario" id="usnombre" placeholder="Nombre de usuario" required>
            </div>
            <div class="d-flex w-70 align-self-center mb-2 mt-3">
                <input type="email" name="usmail" class="fancy-input rounded-pill" id="usmail" placeholder="Correo Electrónico" required>
            </div>
            <div class="mt-3 ml-2 mb-2 mr-2">
                <input type="password" name="uspass" class="fancy-input rounded-pill img-input-contraseña" id="uspass" placeholder="Contraseña" required>
            </div>
            <div class="d-flex w-70 align-self-center mb-2 pb-4">
                <input type="submit" class="btn-enviar rounded-pill" value="Enviar">
            </div>
            <div class="d-flex w-100 h-100 align-content-start justify-content-center mb-5">
                <span>¿Ya estás registrado? <a href="../login/index.php">Login</a></span>
            </div>
        </form>
    </section>
</main>

    <script src="../Assets/register.js"></script>

</body>
</html>

