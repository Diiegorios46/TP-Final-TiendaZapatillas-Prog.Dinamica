<?php
 include_once '../estructura/cabecera.php';
?>

    <main class="container w-32 h-100 mt-5 pt-5">

        <section class="login-container bg-form rouded-modify shadow">
            <div class="text-center fs-2 pt-4 pb-4">
                <span>Registrar</span>
            </div>

            <form class="w-100 d-flex flex-column" action="./action.php" id="loginForm" method="POST">
                <div class="mt-4 ml-2 mb-2 mr-2">
                    <input type="text" name="usnombre" class="fancy-input rounded-pill img-input-usuario" id="usnombre" placeholder="Nombre de usuario" required>
                </div>
                <div class="mt-4 ml-2 mb-2 mr-2">
                    <input type="password" name="uspass" class="fancy-input rounded-pill img-input-contraseña" id="uspass" placeholder="Contraseña" required>
                </div>
                <div class="mt-4 ml-2 mb-5 mr-2">
                    <input type="email" name="usmail" class="fancy-input rounded-pill" id="usmail" placeholder="Correo" required>
                </div>
                <div class="d-flex w-70 align-self-center mb-2 pb-4">
                     <input type="submit" class="btn-enviar rounded-pill" value="Enviar">
                </div>
                <div class="d-flex w-100 h-100 align-content-start justify-content-center mb-5">
                    <span>¿Ya estas registrado?<a href="../login/index.php"> Login</a></span>
                </div>
            </form>

        </section>

    </main>
</body>
</html>

<?php
if(isset($_GET['error'])){
    echo '<h2>Usuario o clave incorrectos</h2>';
}

?>

<?php
/*
<!-- // CREATE TABLE `usuario` (
//   `idusuario` bigint(20) NOT NULL,
//   `usnombre` varchar(50) NOT NULL,
//   `uspass` varchar(50) NOT NULL,
//   `usmail` varchar(50) NOT NULL,
//   `usdeshabilitado` timestamp NULL DEFAULT NULL
// ) ENGINE=InnoDB DEFAULT CHARSET=latin1; -->

<form action="./action.php" method="POST" id="loginForm" >
    <label for="usnombre">Ingrese su nombre</label>
    <input type="text" name="usnombre" id="usnombre" placeholder="Nombre de usuario" required>
    <label for="uspass">Ingrese la clave</label>
    <input type="password" name="uspass" id="uspass" placeholder="Contraseña" required>
    <label for="usmail">Ingrese su correo</label>
    <input type="email" name="usmail" id="usmail" placeholder="Correo" required>
    <input type="submit" value="Registrarse">
</form>
<!---<script>
        $(document).ready(function() {
            $('#loginForm').on('submit', function(e) {  
            var password = $('#uspass').val();
            var encryptedPassword = hex_md5(password);
        $('#uspass').val(encryptedPassword);
        setTimeout(function() {
        $('#uspass').val(''); // Limpiar el campo de contraseña después de enviar el formulario
                }, 1);

                    });
                });
            </script> --->
*/
?>


