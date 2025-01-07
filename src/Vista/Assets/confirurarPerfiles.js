
    
if (menu == 1) {
    let url = './actionlistarDatosUsuario.php';
    $.ajax({
        url: url,
        type: 'GET',
        dataType: 'json',
        success: function (result) {
            // Limpiar contenido
            $('.deposito-menu').html('');
            $('.deposito-title').hide('');

            // Renderizar el título usando Handlebars
            var sourceTitulo = document.getElementById('template-titulo').innerHTML;
            var templateTitulo = Handlebars.compile(sourceTitulo);
            var htmlTitulo = templateTitulo({ titulo: 'Configuración Usuario' });
            $('.container-Tittle-volver').html(htmlTitulo);

            // Renderizar el formulario usando Handlebars
            var sourceFormulario = document.getElementById('template-formulario').innerHTML;
            var templateFormulario = Handlebars.compile(sourceFormulario);
            var htmlFormulario = templateFormulario(result);
            $('.deposito-menu').append(htmlFormulario);

            // Validar el formulario
            $('#formularioUs').validate({
                rules: {
                    usnombre: {
                        required: true,
                        minlength: 2,
                    },
                    usmail: {
                        required: true,
                        email: true,
                    },
                    uspass: {
                        required: true,
                        minlength: 5,
                    },
                },
                messages: {
                    usnombre: {
                        required: 'Por favor ingrese su nombre',
                        minlength: 'El nombre debe tener al menos 2 caracteres',
                    },
                    usmail: {
                        required: 'Por favor ingrese su correo electrónico',
                        email: 'Por favor ingrese un correo electrónico válido',
                    },
                    uspass: {
                        required: 'Por favor ingrese su contraseña',
                        minlength: 'La contraseña debe tener al menos 5 caracteres',
                    },
                },
                submitHandler: function (form) {
                    $.ajax({
                        url: './actionConfigurarPerfil.php',
                        type: 'POST',
                        data: new FormData(form),
                        processData: false,
                        contentType: false,
                        success: function () {
                            $('#mensajeOperacion')
                                .addClass('alert alert-success alert-dismissible fade show text-center')
                                .html('Perfil editado exitosamente.');
                        },
                        error: function (xhr, status, error) {
                            console.log('Error: ' + error);
                        },
                    });
                },
            });
        },
        error: function (xhr, status, error) {
            console.log('Error al cargar los datos del menú dinámico.');
            console.log('Error: ' + error);
        },
    });
    } else if (menu == 5){
        url = './actionAltaUsuario.php';
            
        $('.deposito-title').hide('');
        $('.container-Tittle-volver').html(`
                <div class="container-sm d-flex w-75">
                    <div class="d-flex w-5">   
                         <a href="../menu/index.php" class="d-flex align-content-center">
                            <div class="w-100"><img src="../Assets/imgs/volver.png" alt="" class="h-100 w-100 p-1 rounded-circle"></div> 
                         </a>
                    </div>
                    <div class="w-100 d-flex justify-content-center">
                        <h1>Agregar un usuario nuevo</h1>
                    </div>
                </div>`);
                
        $('.deposito-menu').html(`
            <div class="container w-50">
            <form id="formulario" novalidate method="post" class="bg-light p-4 border-button-dark rounded min-height-50 shadow">
                <div class="form-group">
                <label for="nombre" class="form-label">Nombre</label>
                <input type="text" name="usnombre" class="form-control" id="nombre" placeholder="Ingresa tu nombre" required>
                </div>
                <div class="form-group">
                <label for="contraseña" class="form-label">Contraseña</label>
                <input type="password" name="uspass" class="form-control" id="contraseña" placeholder="Ingresa tu contraseña" required>
                </div>
                <div class="form-group">
                <label for="correo" class="form-label">Correo Electrónico</label>
                <input type="email" name="usmail" class="form-control" id="correo" placeholder="Ingresa tu correo electrónico" required>
                </div>
                <div class="d-flex justify-content-center mt-4">
                <button type="submit" class="btn-verde">Enviar</button>
                </div>
            </form>
            </div>`
        );

        $('#formulario').validate({
            rules: {
                usnombre: {
                    required: true,
                    minlength: 3,
                },
                uspass: {
                    required: true,
                    minlength: 5
                },
                usmail: {
                    required: true,
                    email: true
                }
            },
            messages: {
                usnombre: {
                    required: "Por favor ingrese su nombre",
                    minlength: "El nombre debe tener al menos 2 caracteres",
                },
                uspass: {
                    required: "Por favor ingrese su contraseña",
                    minlength: "La contraseña debe tener al menos 5 caracteres"
                },
                usmail: {
                    required: "Por favor ingrese su correo electrónico",
                    email: "Por favor ingrese un correo electrónico válido"
                }
            },
            submitHandler: function(form) {
                $.ajax({
                    url: url,
                    type: 'POST',
                    data: new FormData(form),
                    processData: false,
                    contentType: false,
                    success: function(texto) {
                        console.log(texto);
                        $('#mensajeOperacion').addClass('alert alert-success alert-dismissible fade show text-center').html('Usuario agregado exitosamente.');
                    },
                        error: function(xhr, status, error) {
                        console.log('Error: ' + error);
                    }
                });
            }
        });
    } else if (menu == 6){
        //BORRAR UN USUARIO 
        url = './listarUsuarios.php';
        $('.deposito-title').hide('');
        $('.container-Tittle-volver').html(`
                <div class="container-sm d-flex w-75">
                    <div class="d-flex w-5">   
                         <a href="../menu/index.php" class="d-flex align-content-center">
                            <div class="w-100"><img src="../Assets/imgs/volver.png" alt="" class="h-100 w-100 p-1 rounded-circle"></div> 
                         </a>
                    </div>
                    <div class="w-100 d-flex justify-content-center">
                        <h1>Borrar un usuario</h1>
                    </div>
                </div>`);

        $.ajax({ 
            url: url, 
            type: 'GET', 
            dataType: 'json', 
            beforeSend: function (){
                $('#mensajeOperacion').addClass('alert alert-warning alert-dismissible fade show text-center').html('Cargando...');  
            },
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
                            <div class="column-diego text-center">
                                <div class="card m-2 p-2 shadow-sm"> 
                                    <div class="card-body"> 
                                    <form class="" id="formularioBorrado" novalidate method="post">
                                        <p class="card-title"><strong>Nombre : </strong>${usuario.usnombre}</p> 
                                        <p class="card-text"><strong>Correo:</strong> ${usuario.usmail}</p> 
                                        <p class="card-text font-bold">${usuario.usdeshabilitado == '0000-00-00 00:00:00' ? 'Habilitado' : 'Deshabilitado'}</p> 
                                        <button type="button" class="btn btn-danger" onclick="borradoLogicaUsuario(${usuarioStr})">Dar de Baja</button> 
                                    </form>    
                                    </div> 
                                </div> 
                            </div> 
                    `;
                    row.append(usuarioHtml);
                    $('#mensajeOperacion').hide(); 


                });
            }, 
            error: function(xhr, status, error) { 
                console.log('Error al cargar los datos del menú dinámico.'); 
                console.log('Error: ' + error); 
            } 
        });      

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
            $('#confirmDeleteModal').modal('show');

            $('#confirmDeleteButton').on('click', function() {
                $.ajax({
                    url: './actionBajaUsuario.php',
                    type: 'POST',
                    data: objUsuario,
                    success: function(texto){
                        console.log(texto);
                        $('#mensajeOperacion').addClass('alert alert-success alert-dismissible fade show text-center').html('Usuario eliminado exitosamente.');
                        $('#confirmDeleteModal').modal('hide');
                    },
                    error: function(xhr, status, error) {
                        console.log('Error: ' + error);
                    }
                });
            });
        }

    } else if (menu == 7){
        //MODIFICAR UN USUARIO
        url = './listarUsuarios.php';

        $('.deposito-title').hide('');
        $('.container-Tittle-volver').html(`
                <div class="container-sm d-flex w-75">
                    <div class="d-flex w-5">   
                         <a href="../menu/index.php" class="d-flex align-content-center">
                            <div class="w-100"><img src="../Assets/imgs/volver.png" alt="" class="h-100 w-100 p-1 rounded-circle"></div> 
                         </a>
                    </div>
                    <div class="w-100 d-flex justify-content-center">
                        <h1>Modificar un usuario</h1>
                    </div>
                </div>`);

        $.ajax({ 
            url: url, 
            type: 'GET', 
            beforeSend: function (){
                $('#mensajeOperacion').addClass('alert alert-warning alert-dismissible fade show text-center').html('Cargando...');  
            },
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
                            <div class="column-diego text-center">
                                <div class="card m-2 p-2 shadow-sm"> 
                                    <div class="card-body"> 
                                    <form class="" id="formularioModificacion" novalidate method="post">
                                        <p class="card-title"><strong>Nombre : </strong>${usuario.usnombre}</p> 
                                        <p class="card-text"><strong>Correo:</strong> ${usuario.usmail}</p>
                                        <p class="card-text font-bold">${usuario.usdeshabilitado == '0000-00-00 00:00:00' ? 'Habilitado' : 'Deshabilitado'}</p>
                                        <button type="button" class="btn btn-warning" onclick="modificarUsuario(${usuarioStr})">Modificar</button>
                                    </form>
                                    </div>
                                </div>
                            </div>
                    `;
                    row.append(usuarioHtml);
                    $('#mensajeOperacion').hide()
                });
            },
            error: function(xhr, status, error) {
                console.log('Error al cargar los datos del menú dinámico.');
                console.log('Error: ' + error);
            }
        });

        function modificarUsuario(objUsuario){
            $('.grid').html('');

        $('.deposito-menu').html(`
            <div class ="container-sm w-50 h-50 shadow rounded">
                <form class="p-5" id="formularioUsuario" novalidate>
                    <div class="form-group">
                        <label for="usnombre" class="form-label">Nombre del usuario</label>
                        <input type="text" name="usnombre" id="usnombre" class="form-input" value="${objUsuario.usnombre}" required>
                    </div>

                    <div class="form-group hidden">
                        <label for="usid" class="form-label">ID del usuario</label>
                        <input type="text" name="idusuario" id="idusuario" class="form-input" value="${objUsuario.idusuario}" required>
                    </div>

                    <div class="form-group">
                        <label for="usmail" class="form-label">Correo del usuario</label>
                        <input type="text" name="usmail" id="usmail" class="form-input" value="${objUsuario.usmail}" required>
                    </div> 

                    <div class="form-group">
                        <label for="rodescripcion" class="form-label">Rol</label>
                        <select class="form-select form-select-lg" aria-label="Large select example" name="rodescripcion" id="">
                            <option value="Cliente" ${objUsuario.rodescripcion === 'Cliente' ? 'selected' : ''}>Cliente</option>
                            <option value="Deposito" ${objUsuario.rodescripcion === 'Deposito' ? 'selected' : ''}>Deposito</option>
                            <option value="Administrador" ${objUsuario.rodescripcion === 'Administrador' ? 'selected' : ''}>Administrador</option>
                        </select>
                    </div> 
                    <div class="text-center mt-4"> 
                        <input type="submit" value="Modificar usuario" name="submit" class="form-submit text-center" required>
                    </div>
                </form>
            </div>`
        );

        url='./actionModificarUsuario.php';

        $('#formularioUsuario').on('submit', function(e) {
            e.preventDefault();
            $.ajax({
                url: url,
                type: 'POST',
                data: new FormData(this),
                processData: false,
                contentType: false,
                success: function(texto) {
                    console.log(texto);
                    $('#mensajeOperacion').addClass('alert alert-success alert-dismissible fade show text-center').html('Usuario modificado exitosamente.');
                },
                error: function(xhr, status, error) {
                    console.log('Error: ' + error);
                }
            });
        });
        }
    } else if (menu == 5){
        url = './actionAltaUsuario.php';
            
        $('.deposito-title').hide('');
        $('.container-Tittle-volver').html(`
                <div class="container-sm d-flex w-75">
                    <div class="d-flex w-5">   
                         <a href="../menu/index.php" class="d-flex align-content-center">
                            <div class="w-100"><img src="../Assets/imgs/volver.png" alt="" class="h-100 w-100 p-1 rounded-circle"></div> 
                         </a>
                    </div>
                    <div class="w-100 d-flex justify-content-center">
                        <h1>Agregar un usuario nuevo</h1>
                    </div>
                </div>`);
                
        $('.deposito-menu').html(`
            <div class="container w-50">
            <form id="formulario" novalidate method="post" class="bg-light p-4 border-button-dark rounded min-height-50 shadow">
                <div class="form-group">
                <label for="nombre" class="form-label">Nombre</label>
                <input type="text" name="usnombre" class="form-control" id="nombre" placeholder="Ingresa tu nombre" required>
                </div>
                <div class="form-group">
                <label for="contraseña" class="form-label">Contraseña</label>
                <input type="password" name="uspass" class="form-control" id="contraseña" placeholder="Ingresa tu contraseña" required>
                </div>
                <div class="form-group">
                <label for="correo" class="form-label">Correo Electrónico</label>
                <input type="email" name="usmail" class="form-control" id="correo" placeholder="Ingresa tu correo electrónico" required>
                </div>
                <div class="d-flex justify-content-center mt-4">
                <button type="submit" class="btn-verde">Enviar</button>
                </div>
            </form>
            </div>`
        );

        $('#formulario').validate({
            rules: {
                usnombre: {
                    required: true,
                    minlength: 3,
                },
                uspass: {
                    required: true,
                    minlength: 5
                },
                usmail: {
                    required: true,
                    email: true
                }
            },
            messages: {
                usnombre: {
                    required: "Por favor ingrese su nombre",
                    minlength: "El nombre debe tener al menos 2 caracteres",
                },
                uspass: {
                    required: "Por favor ingrese su contraseña",
                    minlength: "La contraseña debe tener al menos 5 caracteres"
                },
                usmail: {
                    required: "Por favor ingrese su correo electrónico",
                    email: "Por favor ingrese un correo electrónico válido"
                }
            },
            submitHandler: function(form) {
                $.ajax({
                    url: url,
                    type: 'POST',
                    data: new FormData(form),
                    processData: false,
                    contentType: false,
                    success: function(texto) {
                        console.log(texto);
                        $('#mensajeOperacion').addClass('alert alert-success alert-dismissible fade show text-center').html('Usuario agregado exitosamente.');
                    },
                        error: function(xhr, status, error) {
                        console.log('Error: ' + error);
                    }
                });
            }
        });
    } else if (menu == 6){
        //BORRAR UN USUARIO 
        url = './listarUsuarios.php';
        $('.deposito-title').hide('');
        $('.container-Tittle-volver').html(`
                <div class="container-sm d-flex w-75">
                    <div class="d-flex w-5">   
                         <a href="../menu/index.php" class="d-flex align-content-center">
                            <div class="w-100"><img src="../Assets/imgs/volver.png" alt="" class="h-100 w-100 p-1 rounded-circle"></div> 
                         </a>
                    </div>
                    <div class="w-100 d-flex justify-content-center">
                        <h1>Borrar un usuario</h1>
                    </div>
                </div>`);

        $.ajax({ 
            url: url, 
            type: 'GET', 
            dataType: 'json', 
            beforeSend: function (){
                $('#mensajeOperacion').addClass('alert alert-warning alert-dismissible fade show text-center').html('Cargando...');  
            },
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
                            <div class="column-diego text-center">
                                <div class="card m-2 p-2 shadow-sm"> 
                                    <div class="card-body"> 
                                    <form class="" id="formularioBorrado" novalidate method="post">
                                        <p class="card-title"><strong>Nombre : </strong>${usuario.usnombre}</p> 
                                        <p class="card-text"><strong>Correo:</strong> ${usuario.usmail}</p> 
                                        <p class="card-text font-bold">${usuario.usdeshabilitado == '0000-00-00 00:00:00' ? 'Habilitado' : 'Deshabilitado'}</p> 
                                        <button type="button" class="btn btn-danger" onclick="borradoLogicaUsuario(${usuarioStr})">Dar de Baja</button> 
                                    </form>    
                                    </div> 
                                </div> 
                            </div> 
                    `;
                    row.append(usuarioHtml);
                    $('#mensajeOperacion').hide(); 


                });
            }, 
            error: function(xhr, status, error) { 
                console.log('Error al cargar los datos del menú dinámico.'); 
                console.log('Error: ' + error); 
            } 
        });      

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
            $('#confirmDeleteModal').modal('show');

            $('#confirmDeleteButton').on('click', function() {
                $.ajax({
                    url: './actionBajaUsuario.php',
                    type: 'POST',
                    data: objUsuario,
                    success: function(texto){
                        console.log(texto);
                        $('#mensajeOperacion').addClass('alert alert-success alert-dismissible fade show text-center').html('Usuario eliminado exitosamente.');
                        $('#confirmDeleteModal').modal('hide');
                    },
                    error: function(xhr, status, error) {
                        console.log('Error: ' + error);
                    }
                });
            });
        }

    } else if (menu == 7){
        //MODIFICAR UN USUARIO
        url = './listarUsuarios.php';

        $('.deposito-title').hide('');
        $('.container-Tittle-volver').html(`
                <div class="container-sm d-flex w-75">
                    <div class="d-flex w-5">   
                         <a href="../menu/index.php" class="d-flex align-content-center">
                            <div class="w-100"><img src="../Assets/imgs/volver.png" alt="" class="h-100 w-100 p-1 rounded-circle"></div> 
                         </a>
                    </div>
                    <div class="w-100 d-flex justify-content-center">
                        <h1>Modificar un usuario</h1>
                    </div>
                </div>`);

        $.ajax({ 
            url: url, 
            type: 'GET', 
            beforeSend: function (){
                $('#mensajeOperacion').addClass('alert alert-warning alert-dismissible fade show text-center').html('Cargando...');  
            },
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
                            <div class="column-diego text-center">
                                <div class="card m-2 p-2 shadow-sm"> 
                                    <div class="card-body"> 
                                    <form class="" id="formularioModificacion" novalidate method="post">
                                        <p class="card-title"><strong>Nombre : </strong>${usuario.usnombre}</p> 
                                        <p class="card-text"><strong>Correo:</strong> ${usuario.usmail}</p>
                                        <p class="card-text font-bold">${usuario.usdeshabilitado == '0000-00-00 00:00:00' ? 'Habilitado' : 'Deshabilitado'}</p>
                                        <button type="button" class="btn btn-warning" onclick="modificarUsuario(${usuarioStr})">Modificar</button>
                                    </form>
                                    </div>
                                </div>
                            </div>
                    `;
                    row.append(usuarioHtml);
                    $('#mensajeOperacion').hide()
                });
            },
            error: function(xhr, status, error) {
                console.log('Error al cargar los datos del menú dinámico.');
                console.log('Error: ' + error);
            }
        });

        function modificarUsuario(objUsuario){
            $('.grid').html('');

        $('.deposito-menu').html(`
            <div class ="container-sm w-50 h-50 shadow rounded">
                <form class="p-5" id="formularioUsuario" novalidate>
                    <div class="form-group">
                        <label for="usnombre" class="form-label">Nombre del usuario</label>
                        <input type="text" name="usnombre" id="usnombre" class="form-input" value="${objUsuario.usnombre}" required>
                    </div>

                    <div class="form-group hidden">
                        <label for="usid" class="form-label">ID del usuario</label>
                        <input type="text" name="idusuario" id="idusuario" class="form-input" value="${objUsuario.idusuario}" required>
                    </div>

                    <div class="form-group">
                        <label for="usmail" class="form-label">Correo del usuario</label>
                        <input type="text" name="usmail" id="usmail" class="form-input" value="${objUsuario.usmail}" required>
                    </div> 

                    <div class="form-group">
                        <label for="rodescripcion" class="form-label">Rol</label>
                        <select class="form-select form-select-lg" aria-label="Large select example" name="rodescripcion" id="">
                            <option value="Cliente" ${objUsuario.rodescripcion === 'Cliente' ? 'selected' : ''}>Cliente</option>
                            <option value="Deposito" ${objUsuario.rodescripcion === 'Deposito' ? 'selected' : ''}>Deposito</option>
                            <option value="Administrador" ${objUsuario.rodescripcion === 'Administrador' ? 'selected' : ''}>Administrador</option>
                        </select>
                    </div> 
                    <div class="text-center mt-4"> 
                        <input type="submit" value="Modificar usuario" name="submit" class="form-submit text-center" required>
                    </div>
                </form>
            </div>`
        );

        url='./actionModificarUsuario.php';

        $('#formularioUsuario').on('submit', function(e) {
            e.preventDefault();
            $.ajax({
                url: url,
                type: 'POST',
                data: new FormData(this),
                processData: false,
                contentType: false,
                success: function(texto) {
                    console.log(texto);
                    $('#mensajeOperacion').addClass('alert alert-success alert-dismissible fade show text-center').html('Usuario modificado exitosamente.');
                },
                error: function(xhr, status, error) {
                    console.log('Error: ' + error);
                }
            });
        });
        }
    }
