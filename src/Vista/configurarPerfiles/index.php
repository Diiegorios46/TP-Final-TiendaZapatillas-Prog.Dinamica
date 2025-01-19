<?php include '../estructura/cabeceraSegura.php'; 
$menu = data_submitted();

if($session->getRol() != 1){
    $menu['m'] = 1;
}else{
    if (!isset($menu['m'])) {
        $menu['m'] = null;
    }
}
?>

<div id='mensajeOperacion'></div>

<div class="container-sm min-vh-100">  

    <h1 class="deposito-title pt-4">Menu</h1>

    <div class="container-Tittle-volver mt-5 mb-5"></div>

    <div id="menuDinamico"> 

    </div>

    <div class="grid w-100"></div>

</div>






    <!-- Plantilla opcion : Configuraciónes usuario -->
    <script id="template-formulario" type="text/x-handlebars-template">
        <div class="d-flex flex-row w-100 h-100">

            <form class="formularioMenuConfig" id="formularioUs" novalidate method="post" action="./actionConfigurarPerfil.php">

                <div class="container-configuracionText mt-5" >
                    <span>{{titulo}}</span>
                    <div class="btn-volver-configuracion" data-url="../menu/index.php">
                        <i class="bi bi-gear w-100 text-dark"></i>
                        <span>Volver</span>
                    </div>
                </div>

                <fieldset class="form-group mb-4 mt-4">
                    <label for="usnombre" class="form-label text-dark">Nombre del usuario</label>
                    <input type="text" name="usnombre" id="usnombre" class="form-input" placeholder="{{usnombre}}">
                </fieldset>

                <fieldset class="form-group mb-4">
                    <label for="usmail" class="form-label text-dark">Correo del usuario</label>
                    <input type="email" name="usmail" id="usmail" class="form-input" placeholder="{{usmail}}">
                </fieldset>

                <fieldset class="form-group mb-4">
                    <label for="uspass" class="form-label text-dark">Contraseña del usuario</label>
                    <input type="password" name="uspass" id="uspass" class="form-input mb-2" placeholder="********">
                </fieldset>

                <fieldset class="d-flex justify-content-end mr-10Porciento container-buttons-C-A">
                    <button class="mr-1 btn-rojo" data-url="../menu/index.php">Cancelar</button>
                    <button type="submit" value="Actualizar" name="submit" class="btn-subir-producto">Actualizar</button>
                </fieldset>

            </form>
        </div>
    </script>

    <!--plantilla opcion : agregar un usuario nuevo -->
    <script id="template-formulario-crear" type="text/x-handlebars-template">
        <div class="container w-80">
        <form id="formulario" novalidate method="post" class="bg-light p-4 border-button-dark rounded shadow formularioUsuarioNuevo">
            <div class="form-group">
                <label for="nombre" class="form-label">Nombre</label>
                <input type="text" name="usnombre" class="form-input" id="nombre" placeholder="Ingresa tu nombre" required />
            </div>
            <div class="form-group">
                <label for="contraseña" class="form-label">Contraseña</label>
                <input type="password" name="uspass" class="form-input" id="contraseña" placeholder="Ingresa tu contraseña" required />
            </div>
            <div class="form-group">
                <label for="correo" class="form-label">Correo Electrónico</label>
                <input type="email" name="usmail" class="form-input" id="correo" placeholder="Ingresa tu correo electrónico" required />
            </div>
            <div class="d-flex justify-content-center mt-4">
                <button type="submit" class="btn-verde">Enviar</button>
            </div>
        </form>
        </div>
    </script>

    <script id="usuario-template" type="text/x-handlebars-template">
        <div class="column-diego text-center">
            <div class="card m-2 p-2 shadow-sm"> 
                <div class="card-body"> 
                    <form class="" id="formularioBorrado" novalidate method="post">
                        <p class="card-title"><strong>Nombre : </strong>{{usnombre}}</p> 
                        <p class="card-text"><strong>Correo:</strong> {{usmail}}</p> 
                        <p class="card-text font-bold">{{usdeshabilitado usdeshabilitado }}</p> 
                        <button type="button" class="btn btn-danger" onclick="borradoLogicaUsuario({{usuarioStr}})">Dar de Baja</button> 
                    </form>    
                </div> 
            </div> 
        </div>
    </script>

    <script id="confirm-delete-template" type="text/x-handlebars-template">
    <div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmDeleteModalLabel">Confirmar Baja</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    ¿Estás seguro de que quieres eliminar al usuario <strong>{{usnombre}}</strong>?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-danger" id="confirmDeleteButton">Confirmar Baja</button>
                </div>
            </div>
        </div>
    </div>
    </script>

    <script id="container-cards-modificar-usuario" type="text/x-handlebars-template">
    <div class="column-diego text-center">
        <div class="card m-2 p-2 shadow-sm"> 
            <div class="card-body"> 
                <form class="" id="formularioModificacion" novalidate method="post">
                    <p class="card-title"><strong>Nombre : </strong>{{usnombre}}</p> 
                    <p class="card-text"><strong>Correo:</strong> {{usmail}}</p>
                    <p class="card-text font-bold">{{usdeshabilitado usdeshabilitado }}<p>
                    <button type="button" class="btn btn-warning" onclick="abrirFormModificarUsuario({{usuarioStr}})">Modificar</button>
                </form>
            </div>
        </div>
    </div>
    </script>

    <script id="modificar-template" type="text/x-handlebars-template">
    <div class="container-sm w-100 h-50 shadow rounded">
        <form class="p-5 w-100" id="formularioUsuario" novalidate>
            <div class="form-group">
                <label for="usnombre" class="form-label">Nombre del usuario</label>
                <input type="text" name="usnombre" id="usnombre" class="form-input" value="{{usnombre}}" required>
            </div>

            <div class="form-group hidden">
                <label for="usid" class="form-label">ID del usuario</label>
                <input type="text" name="idusuario" id="idusuario" class="form-input" value="{{idusuario}}" required>
            </div>

            <div class="form-group">
                <label for="usmail" class="form-label">Correo del usuario</label>
                <input type="text" name="usmail" id="usmail" class="form-input" value="{{usmail}}" required>
            </div> 

            <div class="form-group">
                <label for="rodescripcion" class="form-label">Rol</label>
                <select class="form-select form-select-lg" aria-label="Large select example" name="rodescripcion" id="">
                    <option value="Cliente" {{rodescripcion rodescripcion}}>Cliente</option>
                    <option value="Deposito" {{rodescripcion rodescripcion}}>Deposito</option>
                    <option value="Administrador" {{rodescripcion rodescripcion}}>Administrador</option>
                </select>
            </div> 
            <div class="text-center mt-4"> 
                <input type="submit" value="Modificar usuario" name="submit" class="form-submit text-center" required>
            </div>
        </form>
    </div>
    </script>

    <script id="usuario-template" type="text/x-handlebars-template">
    <div class="column-diego text-center">
        <div class="card m-2 p-2 shadow-sm"> 
            <div class="card-body"> 
                <form class="" id="formularioModificacion" novalidate method="post">
                    <p class="card-title"><strong>Nombre : </strong>{{usnombre}}</p> 
                    <p class="card-text"><strong>Correo:</strong> {{usmail}}</p>
                    <p class="card-text font-bold">{{usdeshabilitado}}</p>
                    <button type="button" class="btn btn-warning" onclick="modificarUsuario({{usuarioStr}})">Modificar</button>
                </form>
            </div>
        </div>
    </div>
    </script>

    <script id="formModUsuario-template" type="text/x-handlebars-template">
    <div class="d-flex flex-row w-100 h-100 align-content-center justify-content-center align-items-center formularioMenuConfig mt-4">
    <form class="w-100 d-flex flex-column" id="formularioUsuario" novalidate style="gap: 1rem;">
        <fieldset class="form-group">
            <label for="usnombre" class="form-label">Nombre del usuario</label>
            <input type="text" name="usnombre" id="usnombre" class="form-input" value="{{usnombre}}" required>
        </fieldset>

        <fieldset class="form-group hidden">
            <label for="usid" class="form-label">ID del usuario</label>
            <input type="text" name="idusuario" id="idusuario" class="form-input" value="{{idusuario}}" required>
        </fieldset>

        <fieldset class="form-group">
            <label for="usmail" class="form-label">Correo del usuario</label>
            <input type="text" name="usmail" id="usmail" class="form-input" value="{{usmail}}" required>
        </fieldset> 

        <fieldset class="form-group">
            <label for="rodescripcion" class="form-label">Rol</label>
            <select class="form-select form-select-lg" aria-label="Large select example" name="rodescripcion" id="">
                <option value="Cliente" {{isSelected 'Cliente' rodescripcion}}>Cliente</option>
                <option value="Deposito" {{isSelected 'Deposito' rodescripcion}}>Deposito</option>
                <option value="Administrador" {{isSelected 'Administrador' rodescripcion}}>Administrador</option>
            </select>
        </fieldset> 
        
        <fieldset class="text-center mt-4"> 
            <input type="submit" value="Modificar usuario" name="submit" class="form-submit text-center" required>
        </fieldset>

    </form>
    </div>
    </script>


    <script id="titleModificarProducto-template" type="text/x-handlebars-template">
           
           <div class="container-configuracionText mt-5" >
               <span>{{titulo}}</span>
               <div class="btn-volver-configuracion" data-url="../menu/index.php">
                   <i class="bi bi-gear w-100 text-dark"></i>
                   <span>Volver</span>
               </div>
           </div>

       </div>
   </script>




<script>
    var menu = <?php echo json_encode($menu['m'])?>;
    if (menu === null) {
        menu = localStorage.getItem('menuLocalStorage');
    } else {
        localStorage.setItem('menuLocalStorage', menu);
    }

</script>

<script src="../Assets/confirurarPerfiles.js?v=1.7.7"></script>


