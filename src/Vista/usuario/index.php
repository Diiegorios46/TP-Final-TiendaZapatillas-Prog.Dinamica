<?php include '../estructura/cabeceraSegura.php'; $menu = data_submitted();?>


    <div class="container-sm min-vh-100">  

        <div id='mensajeOperacion'></div>

        <h1 class="deposito-title pt-4">Menu</h1>
        
        <div class="deposito-menu" id="menuDinamico">
            <!--viene el codigo de jquery-->
        </div>
        <div class="grid"></div>
        
    </div>

<script>
    let menu = <?php echo json_encode($menu['m']); ?>;
    if(menu == 1){
        url = './actionlistarDatosUsuario.php';
        $.ajax({
            url: url,
            type: 'GET',
            dataType: 'json',
            success: function(result) {
                $('.deposito-menu').html('');
                $('.deposito-title').html('Configuracion Usuario');
                $('.grid').html('');

                let userInfo = `
                    <div class="d-flex flex-row w-77">
                    <div class="d-flex flex-row w-100">
                        <form class="formularioMenuConfig" id="formularioUs" novalidate method="post" action="./actionConfigurarPerfil.php">
                            <div class="form-group mb-4">
                                <label for="usnombre" class="form-label text-light">Nombre del usuario</label>
                                <input type="text" name="usnombre" id="usnombre" class="form-input" value="${result.usnombre}" required>
                            </div>
                            <div class="form-group mb-4">
                                <label for="usmail" class="form-label text-light">Correo del usuario</label>
                                <input type="email" name="usmail" id="usmail" class="form-input" value="${result.usmail}" required>
                            </div>
                            <div class="form-group mb-4">
                                <label for="uspass" class="form-label text-light">Contraseña del usuario</label>
                                <input type="password" name="uspass" id="uspass" class="form-input mb-2" value="${result.uspass}" required>
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
                    `;
                    $('.deposito-menu').append(userInfo);

                    $('#formularioUs').validate({
                        rules: {
                            usnombre: {
                                required: true,
                                minlength: 2,
                                
                            },
                            usmail: {
                                required: true,
                                email: true
                            },
                            uspass: {
                                required: true,
                                minlength: 5
                            }
                        },
                        messages: {
                            usnombre: {
                                required: "Por favor ingrese su nombre",
                                minlength: "El nombre debe tener al menos 2 caracteres",
                                
                            },
                            usmail: {
                                required: "Por favor ingrese su correo electrónico",
                                email: "Por favor ingrese un correo electrónico válido"
                            },
                            uspass: {
                                required: "Por favor ingrese su contraseña",
                                minlength: "La contraseña debe tener al menos 5 caracteres"
                            }
                        },
                        submitHandler: function(form) {
                            $.ajax({
                                url: './actionConfigurarPerfil.php',
                                type: 'POST',
                                data: new FormData(form),
                                processData: false,
                                contentType: false,
                                success: function(texto) {
                                    $('#mensajeOperacion').addClass('alert alert-success alert-dismissible fade show text-center').html('Perfil editado exitosamente.');
                                },
                                error: function(xhr, status, error) {
                                    console.log('Error: ' + error);
                                }
                            });
                        }
                    });
                },
            error: function(xhr, status, error) {
                console.log('Error al cargar los datos del menú dinámico.');
                console.log('Error: ' + error);
            }
        });
    } else if (menu == 5){
        url = './listarUsuarios.php';
        $('.deposito-title').html('Borrar un Usuario');

        $.ajax({ 
            url: url, 
            type: 'GET', 
            dataType: 'json', 
            success: function(result) { 

                $('.deposito-menu').html(''); 
                let grid = $('.grid').html('');
                let row;
                $('.deposito-menu').append(grid);

                result.forEach(function(usuario, index) {
                    let usuarioStr = JSON.stringify(usuario).replace(/"/g, '&quot;');
                    
                    if (index % 4 === 0) {
                        row = $('<div class="row mt-4 mb-4"></div>');
                        $('.grid').append(row);
                    }

                    let usuarioHtml = `
                            <div class="col-3 text-center">
                                <div class="card m-2 p-2 shadow-sm"> 
                                    <div class="card-body"> 
                                    <form class="" id="formularioBorrado" novalidate method="post">
                                        <p class="card-title"><strong>Nombre : </strong>${usuario.usnombre}</p> 
                                        <p class="card-text"><strong>Correo:</strong> ${usuario.usmail}</p> 
                                        <p class="card-text font-bold">${usuario.usdeshabilitado == '0000-00-00 00:00:00' ? 'Habilitado' : 'Deshabilitado'}</p> 
                                        <button class="btn btn-danger"><a onclick="borradoLogicaUsuario(${usuarioStr})">Dar de Baja</a></button> 
                                    </form>    
                                    </div> 
                                </div> 
                            </div> 
                    `;
                    row.append(usuarioHtml);
                });
            }, 
            error: function(xhr, status, error) { 
                console.log('Error al cargar los datos del menú dinámico.'); 
                console.log('Error: ' + error); 
            } 
        });
    }


    
    function borradoLogicaUsuario(objUsuario){
        $('.grid').html('');
        $('.deposito-menu').html(`
            <div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="confirmDeleteModalLabel">Confirmar Baja</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        ¿Estás seguro de que quieres eliminar al usuario <strong>${objUsuario.usnombre}</strong>?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="button" class="btn btn-danger" id="confirmDeleteButton">Confirmar Baja</button>
                    </div>
                </div>
            </div>
        </div>`
    );
    $(document).ready(function() {
        $('#confirmDeleteModal').modal('show');

        $('#confirmDeleteButton').on('click', function() {
            url: '../usuario/actionBajaUsuario.php',
            $.ajax({
                type: 'POST',
                data: {
                    idusuario: objUsuario.idusuario,
                    usdeshabilitado: $('#usdeshabilitado').val()
                },
                success: function(texto) {
                    console.log(texto);
                    $('#mensajeOperacion').addClass('alert alert-success alert-dismissible fade show text-center').html('Usuario eliminado exitosamente.');
                    $('#confirmDeleteModal').modal('hide');
                },
                error: function(xhr, status, error) {
                    console.log('Error: ' + error);
                }
            });
        });
    });
        
        url = '../usuario/actionBajaUsuario.php';
        
        $('#formularioUsuario').validate({
            submitHandler: function(form) {
                $.ajax({
                    url: url,
                    type: 'POST',
                    data: new FormData(form),
                    processData: false,
                    contentType: false,
                    success: function(texto) {
                        console.log(texto);
                        $('#mensajeOperacion').addClass('alert alert-success alert-dismissible fade show text-center').html('Usuario eliminado exitosamente.');
                    },
                    error: function(xhr, status, error) {
                        console.log('Error: ' + error);
                    }
                });
            }
            
        });
    }
</script>