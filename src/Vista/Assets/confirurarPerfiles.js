if(typeof menu === 'undefined') {
    menu = localStorage.getItem('menuLocalStorage');
}

Handlebars.registerHelper('usdeshabilitado', function (usdeshabilitado) {
    if (usdeshabilitado == "0000-00-00 00:00:00") {
        return "habilitado";
    } else {
        return "deshabilitado";
    }
});


Handlebars.registerHelper('isSelected', function (optionValue, rodescripcion) {
    return optionValue === rodescripcion ? 'selected' : '';
});

function volverMenu(){
    document.querySelector('.btn-volver-configuracion').addEventListener('click', function() {
        const url = this.getAttribute('data-url');
        if (url) {
            window.location.href = url;
        } 
    });
}

Handlebars.registerHelper('usdeshabilitado', function (usdeshabilitado) {
    if (usdeshabilitado == "0000-00-00 00:00:00") {
        return "habilitado";
    } else {
        return "deshabilitado";
    }
});



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

            var sourceFormulario = document.getElementById('template-formulario').innerHTML;
            var templateFormulario = Handlebars.compile(sourceFormulario);
            var htmlFormularioConTitulo = templateFormulario({ ...result, titulo: 'Configuraciónes' });
            $('#menuDinamico').html(htmlFormularioConTitulo);

            document.querySelector('.btn-volver-configuracion').addEventListener('click', function () {
                const url = this.getAttribute('data-url');
                if (url) {
                    window.location.href = url;
                }
            });

            document.querySelector('.btn-rojo').addEventListener('click', function () {
                const url = this.getAttribute('data-url');
                if (url) {
                    window.location.href = url;
                }
            });

            function toggleVisibility() {
                const element = document.querySelector('.btn-volver-configuracion');
                if (window.innerWidth < 425) {
                    element.style.display = 'none';
                } else {
                    element.style.display = '';
                }
            }

            document.addEventListener('DOMContentLoaded', toggleVisibility);
            window.addEventListener('resize', toggleVisibility);




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
                        required: 'Por favor ingrese su nuevo nombre',
                        minlength: 'El nombre debe tener al menos 2 caracteres',
                    },
                    usmail: {
                        required: 'Por favor ingrese su  nuevo correo electrónico',
                        email: 'Por favor ingrese un correo electrónico válido',
                    },
                    uspass: {
                        required: 'Por favor ingrese su  nueva contraseña',
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
} else if (menu == 5) {
    url = './actionAltaUsuario.php';

    $('.deposito-title').hide('');
    var sourceTitle = document.getElementById("titleModificarProducto-template").innerHTML;
    var templateTitle = Handlebars.compile(sourceTitle);
    $('.container-Tittle-volver').html(templateTitle ({titulo : "Agregar un usuario nuevo"}));

    volverMenu();

    var sourceFormulario = document.getElementById('template-formulario-crear').innerHTML;
    var templateFormulario = Handlebars.compile(sourceFormulario);
    $('#menuDinamico').html(templateFormulario);


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

        submitHandler: function (form) {
            $.ajax({
                url: url,
                type: 'POST',
                data: new FormData(form),
                processData: false,
                contentType: false,
                success: function (texto) {
                    console.log(texto);
                    $('#mensajeOperacion').addClass('alert alert-success alert-dismissible fade show text-center').html('Usuario agregado exitosamente.');
                },
                error: function (xhr, status, error) {
                    console.log('Error: ' + error);
                }
            });
        }
    });
} else if (menu == 6) {
    //BORRAR UN USUARIO 

    console.log("soy el primero 6")

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
        beforeSend: function () {
            $('#mensajeOperacion').addClass('alert alert-warning alert-dismissible fade show text-center').html('Cargando...');
        },
        success: function (result) {
            let grid = $('.grid').html('');
            let row;
            $('#menuDinamico').append(grid);

            // Compilar la plantilla Handlebars
            let source = document.getElementById("usuario-template").innerHTML;
            let template = Handlebars.compile(source);

            result.forEach(function (usuario, index) {
                let usuarioStr = JSON.stringify(usuario);
                usuario.usuarioStr = usuarioStr;

                if (index % 4 === 0) {
                    row = $('<div class="row mt-4 mb-4"></div>');
                    $('.grid').append(row);
                }

                // Generar el HTML usando la plantilla Handlebars
                let usuarioHtml = template(usuario);
                console.log(usuario);
                row.append(usuarioHtml);

                $('#mensajeOperacion').hide();
            });
        },
        error: function (xhr, status, error) {
            console.log('Error al cargar los datos del menú dinámico.');
            console.log('Error: ' + error);
        }
    });



    function borradoLogicaUsuario(objUsuario) {
        $('.grid').html('');

        // Compilar la plantilla Handlebars
        let source = document.getElementById("confirm-delete-template").innerHTML;
        let template = Handlebars.compile(source);

        // Generar el HTML usando la plantilla Handlebars
        let modalHtml = template(objUsuario);
        $('#menuDinamico').html(modalHtml);

        $('#confirmDeleteModal').modal('show');

        $('#confirmDeleteButton').on('click', function () {
            $.ajax({
                url: './actionBajaUsuario.php',
                type: 'POST',
                data: objUsuario,
                success: function (texto) {
                    console.log(texto);
                    $('#mensajeOperacion').addClass('alert alert-success alert-dismissible fade show text-center').html('Usuario eliminado exitosamente.');
                    $('#confirmDeleteModal').modal('hide');
                },
                error: function (xhr, status, error) {
                    console.log('Error: ' + error);
                }
            });
        });
    }



} else if (menu == 7) {
    //Inicio del modificar usuario 
    console.log("soy el primer 7")
    url = './listarUsuarios.php';

    $('.deposito-title').hide('');
    let sourceTitle = document.getElementById('titleModificarProducto-template').innerHTML;
    let templateTitle = Handlebars.compile(sourceTitle);
    $('.container-Tittle-volver').html(templateTitle({ titulo: 'Modificar usuario' }));

    volverMenu();
    
    $.ajax({
        url: url,
        type: 'GET',
        beforeSend: function () {
            $('#mensajeOperacion').addClass('alert alert-warning alert-dismissible fade show text-center').html('Cargando usuarios...');
        },
        success: function (result) {
            $('#menuDinamico').html('');
            let grid = $('.grid').html('');
            let row;
            $('#menuDinamico').append(grid);

            let source = document.getElementById("container-cards-modificar-usuario").innerHTML;
            let template = Handlebars.compile(source);

            result.forEach(function (usuario, index) {
                let usuarioStr = JSON.stringify(usuario);
                usuario.usuarioStr = usuarioStr;
                console.log(usuario)

                if (index % 4 === 0) {
                    row = $('<div class="row mt-4 mb-4 w-100 justify-content-space-between" style="row-gap:20px"></div>');
                    $('.grid').append(row);
                }

                // Generar el HTML usando la plantilla Handlebars
                let usuarioHtml = template(usuario);
                row.append(usuarioHtml);
                $('#mensajeOperacion').hide();
            });
        },
        error: function (xhr, status, error) {
            console.log('Error al cargar los datos del menú dinámico.');
            console.log('Error: ' + error);
        }
    });
    
    function abrirFormModificarUsuario(objUsuario) {
        $('.grid').html('');
    
        // Compilar la plantilla Handlebars
        let source = document.getElementById("formModUsuario-template").innerHTML;
        let template = Handlebars.compile(source);
    
        // Generar el HTML usando la plantilla Handlebars
        let usuarioHtml = template(objUsuario);
        $('#menuDinamico').html(usuarioHtml);
    
        url = './actionModificarUsuario.php';

        $('#formularioUsuario').on('submit', function (e) {
            e.preventDefault();
            console.log('Formulario enviado'); // Verificar que el evento submit se está manejando
        
            let formData = new FormData(this);
            console.log('Datos del formulario:', formData); // Verificar los datos del formulario
        
            $.ajax({
                url: url,
                type: 'POST',
                data: formData,
                processData: false, // Asegurarse de que jQuery no procese los datos
                contentType: false, // Asegurarse de que jQuery no establezca el tipo de contenido
                success: function (texto) {
                    console.log('Respuesta del servidor:', texto); // Verificar la respuesta del servidor
                    $('#mensajeOperacion').addClass('alert alert-success alert-dismissible fade show text-center d-block').html('Usuario modificado exitosamente.');
                },
                error: function (xhr, status, error) {
                    console.log('Error:', error); // Verificar si hay algún error en la solicitud AJAX
                }
            });
        });
    }
} 