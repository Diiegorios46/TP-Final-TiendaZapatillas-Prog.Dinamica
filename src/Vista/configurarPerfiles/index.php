<?php include '../estructura/cabeceraSegura.php'; 
$menu = data_submitted();

if($session->getRol() != 1){
    $menu['m'] = 1;
}
?>

<div class="container-sm min-vh-100">  

    <div id='mensajeOperacion'></div>
    
    <h1 class="deposito-title pt-4">Menu</h1>

    <div class="container-Tittle-volver mt-5"></div>

    <div class="deposito-menu align-items-stretch" id="menuDinamico"> </div>

    <div class="grid"></div>

</div>

    <!-- Plantilla para el título -->
    <script id="template-titulo" type="text/x-handlebars-template">
        <div class="container-sm d-flex w-75">
            <div class="d-flex w-5">   
                <a href="../menu/index.php" class="d-flex align-content-center">
                    <div class="w-100"><img src="../Assets/imgs/volver.png" alt="" class="h-100 w-100 p-1 rounded-circle"></div> 
                </a>
            </div>
            <div class="w-100 d-flex justify-content-center">
                <h1>{{titulo}}</h1>
            </div>
        </div>
    </script>

    <!-- Plantilla para el formulario del usuario -->
    <script id="template-formulario" type="text/x-handlebars-template">
        <div class="d-flex flex-row w-77">
            <div class="d-flex flex-row w-100">
                <form class="formularioMenuConfig" id="formularioUs" novalidate method="post" action="./actionConfigurarPerfil.php">
                    <div class="form-group mb-4">
                        <label for="usnombre" class="form-label text-light">Nombre del usuario</label>
                        <input type="text" name="usnombre" id="usnombre" class="form-input" value="{{usnombre}}" required>
                    </div>
                    <div class="form-group mb-4">
                        <label for="usmail" class="form-label text-light">Correo del usuario</label>
                        <input type="email" name="usmail" id="usmail" class="form-input" value="{{usmail}}" required>
                    </div>
                    <div class="form-group mb-4">
                        <label for="uspass" class="form-label text-light">Contraseña del usuario</label>
                        <input type="password" name="uspass" id="uspass" class="form-input mb-2" value="{{uspass}}" required>
                    </div>
                    <div class="d-flex justify-content-center">
                        <input type="submit" value="Actualizar Perfil" name="submit" class="btn-actualizarPerfil mt-4">
                    </div>
                </form>
            </div>
            <div class="d-flex flex-row w-100 justify-content-center bg-ee9f40">
                <div class="w-70 h-100 rounded-end">
                    <img src="../Assets/imgs/imagen-formulario.jpg" alt="" class="w-100 h-100 rounded-end">
                </div>    
            </div>
        </div>
    </script>


<script>
    let menu = <?php echo json_encode($menu['m']); ?>;
</script>

<script src="../Assets/confirurarPerfiles.js"></script>


