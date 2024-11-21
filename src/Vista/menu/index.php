    <?php include '../estructura/cabeceraSegura.php' ?>

    <div class="container-sm min-vh-100">  

        <div id='mensajeOperacion'></div>

        <h1 class="deposito-title pt-4">Menu</h1>
        
        <div class="deposito-menu" id="menuDinamico">
            <!--viene el codigo de jquery-->
        </div>
        <div class="grid"></div>
        
    </div>


    <script>
    $(document).ready(function() {
        function mostrarMenues() {
            $.ajax({
                url: 'actionMenu.php',
                type: 'GET',
                dataType: 'json',
                success: function(response) {
                    $('.deposito-menu').html('');
                    
                    if (response.error) {
                        $('.deposito-menu').html('Error al cargar los datos.');
                    } else {
                        var i = 1;
                        let menuHtml = "<div class='d-flex flex-column'>"; 
                        
                        response.forEach(menu => {
                            switch(menu) {
                                case 'verpaquete':
                                    menu = "<span class='text-primary'>Ver Paquete(s).</span>";
                                    break;
                                case 'agregarproducto':
                                    menu = "<span class='text-succcess'>Agregar un Producto.</span>";
                                    break;
                                case 'modificarproducto':
                                    menu = "<span class='text-warning'>Modificar un Producto.</span>";
                                    break;
                                case 'altausuario':
                                    menu = "<span class='text-info'>Agregar un Usuario.</span>";
                                    break;
                                case 'bajausuario':
                                    menu = "<span class='text-danger'>Borrar Usuario.</span>";
                                    break;
                                case 'modificarusuario':
                                    menu = "<span class='text-secondary'>Modificar un Usuario.</span>";
                                    break;
                                case 'configuracionusuario': 
                                    menu = "<span class='text-dark'>Configuracion de Usuario.</span>";
                                    break;
                            }
                            menuHtml += `<button type="button" class="deposito-btn-subir-producto mb-2" onclick="obtenerMenu(${i})">${menu}</button>`;
                            i++;
                        });
                        menuHtml += "</div>";
                        $('.deposito-menu').append(menuHtml);
                        $('.deposito-menu').addClass('align-items-stretch');

                    }
                },
                error: function(xhr, status, error) {
                    console.log('Error al cargar los datos.');
                }
            });
        }
        mostrarMenues();
    });

    window.obtenerMenu = function(indice) {
        var url;
        switch(indice) {
            case 1:
                //COFIG USUARIO ADMIN 
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
                                    pattern: "^(?![0-9]*$)[a-zA-Z0-9]+$"
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
                                    pattern: "El nombre no puede contener solo números"
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
                break;
            case 2:
                //VER PAQUETES DEPOSITO

                url = "./actionVerPaquetes.php";

                $('.deposito-title').html('Ver Paquetes');

                $.ajax({
                        url: url,
                        type: 'GET',
                        dataType: 'json', 
                        success: function(result) {
                            if (Array.isArray(result)) {

                                let deposito = $('.deposito-menu').html('');
                                let grid = $('.grid').html('');
                                let row;

                                if ($('.deposito-menu').is(':empty')) {
                                    $('.deposito-menu').html('<div class="alert alert-dark alert-dismissible fade show text-center w-100">No hay nada en el depósito.</div>');
                                    $('.deposito-menu').css('min-height', '0px');
                                }


                                result.forEach(function(datos, index) {
                                   
                                    if (index % 4 === 0) {
                                        row = $('<div class="row mt-3 mb-3"></div>'); 
                                        $('.grid').append(row); 
                                        $('.grid').addClass('w-100')
                                        $('.deposito-menu').html(grid);
                                    }
                                    let pedido = `<div class="col-md-3 col-sm-6 mb-3 evalua w-25 shadow p-3">  
                                                    <div class="d-flex flex-column ">
                                                    <div class="text-center p-1">Pedido numero: ${datos.idcompraitem}</div>
                                                    <div class="text-center p-1">Id de la Compra: ${datos.idcompra}</div>
                                                    <div class="text-center p-1">Id del Producto: ${datos.idproducto}</div>
                                                        <div class="text-center p-1"><strong>Cantidad solicitada: ${datos.cicantidad}</strong></div>
                                                        <div class="text-center p-1"><strong>Stock: ${datos.cicantstock}</strong></div>
                                                        <div class="d-flex flex-row justify-content-center gap">
                                                            <button class="btn btn-success m-1" onclick="evaluar(this, ${datos.idcompra}, 1)">Aceptar</button>
                                                            <button class="btn btn-danger m-1" onclick="evaluar(this, ${datos.idcompra}, 0)">Cancelar</button>
                                                        </div>
                                                    </div>
                                                </div>`;

                                   
                                    row.append(pedido);
                                });
                            } else {
                                console.error('La respuesta no es un array:', result);
                        }
                    },
                        error: function(xhr, status, error) {
                            console.log('Error al cargar los datos del menú dinámico.');
                            console.log('Error: ' + error);
                        }
                    });
                break;
            case 3:
                //AGREGAR PRODUCTO ADMIN 
                $('.deposito-title').html('Agregar Producto');

                url = './agregarAction.php';

                $('.deposito-menu').html(`
                    <form class="formAgregarProducto rounded shadow" id="fm" novalidate method="post">
                        <div class="form-group inputForm m-2">
                            <label for="pronombre" class="form-label">Nombre del producto</label>
                            <input type="text" name="pronombre" id="pronombre" class="form-input inputForm" placeholder="ej: Iforce" required>
                        </div>
                        <div class="form-group m-2">
                            <label for="proprecio" class="form-label">Precio del producto</label>
                            <input type="number" name="proprecio" id="proprecio" class="form-input inputForm" placeholder="ej: $1500" required>
                        </div>
                        <div class="form-group m-2">
                            <label for="promarca" class="form-label">Marca del producto</label>
                            <select name="promarca" id="promarca" class="form-select" required>
                                <option value="nike" selected>Nike</option>
                                <option value="adidas">Adidas</option>
                                <option value="vans">Vans</option>
                                <option value="topper">Topper</option>
                            </select>
                        </div>
                        <div class="form-group m-2">
                            <label for="prodetalle" class="form-label">Detalle del producto</label>
                            <input type="text" name="prodetalle" id="prodetalle" class="form-input inputForm" placeholder="ej: Son un excelente producto para hacer deporte" required>
                        </div>
                        <div class="form-group m-2">
                            <label for="procantstock" class="form-label">Cantidad de stock</label>
                            <input type="number" name="procantstock" id="procantstock" class="form-input inputForm" placeholder="ej: 100" required>
                        </div>
                        <div class="form-group m-2">
                            <label for="image" class="form-label">Elegi una imagen para el producto:</label>
                            <input type="file" name="image[]" id="image" class="form-file" multiple required>
                        </div>
                        <div class="text-center">
                            <input type="submit" value="Subir imagen" name="submit" class="btn-verde mt-4">
                        </div>
                    </form>`);

                    $('#fm').validate({
                        rules: {
                            pronombre: {
                                required: true,
                                minlength: 2,
                                pattern: "^(?![0-9]*$)[a-zA-Z0-9]+$"
                            },
                            proprecio: {
                                required: true,
                                number: true
                            },
                            prodetalle: {
                                required: true,
                                minlength: 5,
                                pattern: "^[a-zA-Z0-9]+$"},
                            procantstock: {
                                required: true,
                                number: true
                            },
                            image: {
                                required: true,
                                extension: "jpg|jpeg|png|gif"
                            }
                        },
                        messages: {
                            pronombre: {
                                required: "Por favor ingrese el nombre del producto",
                                minlength: "El nombre debe tener al menos 2 caracteres",
                                pattern: "El nombre no puede contener solo números"
                            },
                            proprecio: {
                                required: "Por favor ingrese el precio del producto",
                                number: "Por favor ingrese un número"
                            },
                            prodetalle: {
                                required: "Por favor ingrese el detalle del producto",
                                minlength: "El detalle debe tener al menos 5 caracteres"
                            },
                            procantstock: {
                                required: "Por favor ingrese la cantidad de stock",
                                number: "Por favor ingrese un número"
                            },
                            image: {
                                required: "Por favor seleccione una imagen",
                                extension: "Por favor seleccione una imagen con extensión jpg, jpeg, png o gif"
                            }
                        },
                        submitHandler: function(form) {
                            $.ajax({
                                url: url,
                                type: 'POST',
                                data: new FormData(this),
                                processData: false,
                                contentType: false,
                                success: function(result) {
                                    console.log(result);
                                    try {
                                        if (result) {
                                            $('#mensajeOperacion').addClass('alert alert-success alert-dismissible fade show text-center').html('Producto agregado exitosamente.');    
                                            } else {console.log('Error: ' + result.errorMsg);
                                        }
                                    } catch (e) {
                                        console.log('Error al parsear la respuesta del servidor.');
                                    }
                                },
                                error: function(xhr, status, error) {
                                    console.log('Error al cargar los datos del menú dinámico.');
                                    console.log('Error: ' + error);
                                }
                            });
                        }
                    })
                
                break;
            case 4:
                //MODIFICAR PRODUCTO
                url = './listarDeposito.php';

                $('.deposito-title').html('Modificar Producto');

                $.ajax({
                    url: url,
                    type: 'GET',
                    dataType: 'json',
                    success: function(result) {

                    $('.deposito-menu').html(''); 
                    let grid = $('.grid').html(''); 

                    let row;
                        result.forEach(function(producto ,index) {
                            if (index % 4 === 0) {
                                    row = $('<div class="row mt-4 mb-4"></div>');
                                    $('.grid').append(row);
                                    $('.deposito-menu').html(grid); 
                                }
                            let productoStr = JSON.stringify(producto).replace(/"/g, '&quot;');
                            let zapatilla = `
                                    <div class="col-3">
                                        <div class="card d-flex w-100 h-100 p-3 shadow">
                                            <div class="card-img w-100">
                                                <img src="${producto.proimagen1}" alt="" class="w-100 h-100 img-card">
                                            </div>
                                            <div class="card-marca">${producto.promarca}</div>
                                            <div class="card-infoZapatillas data-nombre">${producto.pronombre}</div>
                                            <div class="card-precioMasDescuento">
                                            <strong>$</strong><span class="data-precio">${producto.proprecio}</span><strong>USD</strong>
                                            </div>
                                            <div class="hidden">
                                                <span class="data-idproducto">${producto.idproducto}</span>
                                            </div>
                                            <div class="card-button text-center pt-3">
                                                <button class="btn btn-dark p-2 agregarCarrito" id="myButton" onclick="modificarProducto(${productoStr})">Modificar Producto</button>
                                            </div>
                                        </div>
                                    </div>
                            `;
                            row.append(zapatilla);
                        });
                    },
                    error: function(xhr, status, error) {
                        console.log('Error al cargar los datos del menú dinámico.');
                        console.log('Error: ' + error);
                    }
                  
                })

                break;
            case 5:
                //ALTA USUARIO ADMIN 
                url = './actionAltaUsuario.php';
                $('.deposito-title').html('Agregar un usuario nuevo');

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
                                </div>`);

                        
                $('#formulario').validate({
                    
                    rules: {
                        usnombre: {
                            required: true,
                            minlength: 2,
                            pattern: "^(?![0-9]*$)[a-zA-Z0-9]+$"
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
                            pattern: "El nombre no puede contener solo números"
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

                break;
                case 6:
                //BAJA USUARIO 

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

                            
                    break;   
                     case 7:

                    $('.deposito-title').html('Modificar un Usuario');
                    url = './listarUsuarios.php'; 
                    
                    $.ajax({
                        url: './listarUsuarios.php',
                        type: 'GET',
                        dataType: 'json',
                        beforeSend: function (response){
                            $('#mensajeOperacion').addClass('alert alert-warning alert-dismissible fade show text-center').html('Cargando...');
                        },
                        success: function(result) {

                            $('.deposito-menu').html('');
                            let grid = $('.grid').html('');
                            $('.deposito-menu').append(grid);

                            let row;
                            result.forEach(function(usuario, index ) {
                                    let usuarioStr = JSON.stringify(usuario).replace(/"/g, '&quot;');

                                    if (index % 4 === 0) {
                                        row = $('<div class="row mt-4 mb-4"></div>');
                                        $('.grid').append(row);
                                    }
                                    
                                    let usuarioHtml = `
                                        <div class="col-3">
                                            <div class="card m-2 p-2 shadow">
                                                <div class="card-body">
                                                    <form>
                                                        <p class="card-title">Nombre : ${usuario.usnombre}</p>
                                                        <p class="card-text">Correo: ${usuario.usmail}</p>
                                                        <p class="card-text"><strong>Rol: ${usuario.rodescripcion}</strong></p>

                                                        <div class="text-center">
                                                            <button class="btn btn-warning boton-formuModificar"><a onclick="modificarUsuario(${usuarioStr})">Modificar</a></button>
                                                        <div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    `;
                                    row.append(usuarioHtml);
                                    $('#mensajeOperacion').html('');
                                    $('#mensajeOperacion').addClass('hidden');

                            });
                        },
                        error: function(xhr, status, error) {
                            console.log('Error al cargar los datos del menú dinámico.');
                            console.log('Error: ' + error);
                        }
                    });
            break;
            default:
                console.log('Índice fuera de rango: ' + indice);
                return;
        }
    }

    function modificarProducto(producto) {
        $.ajax({
                    url: './modificarAction.php',
                    type: 'get',
                    success: function(response) {
                            $('.grid').html('');
                            $('.deposito-menu').html(`
                                    <form class="upload-form" id="form" novalidate method="post" enctype="multipart/form-data">
                                            <div class="form-group">
                                                    <label for="pronombre" class="form-label">Nombre del producto</label>
                                                    <input type="text" name="pronombre" id="pronombre" class="form-input" value="${producto.pronombre}" required>
                                            </div>
                                            <div class="form-group">
                                                    <label for="proprecio" class="form-label">Precio del producto</label>
                                                    <input type="number" name="proprecio" id="proprecio" class="form-input" value="${parseInt(producto.proprecio, 10).toFixed(2)}" required>
                                            </div>
                                            <div class="form-group">
                                                    <label for="promarca" class="form-label">Marca del producto</label>
                                                    <select name="promarca" id="promarca" class="form-select" required>
                                                            <option value="nike" ${producto.promarca === 'nike' ? 'selected' : ''}>Nike</option>
                                                            <option value="adidas" ${producto.promarca === 'adidas' ? 'selected' : ''}>Adidas</option>
                                                            <option value="vans" ${producto.promarca === 'vans' ? 'selected' : ''}>Vans</option>
                                                            <option value="topper" ${producto.promarca === 'topper' ? 'selected' : ''}>Topper</option>
                                                    </select>
                                            </div>
                                            <div class="form-group">
                                                    <label for="prodetalle" class="form-label">Detalle del producto</label>
                                                    <input type="text" name="prodetalle" id="prodetalle" class="form-input" value="${producto.prodetalle}" required>
                                            </div>
                                            <div class="form-group">
                                                    <label for="procantstock" class="form-label">Cantidad de stock</label>
                                                    <input type="number" name="procantstock" id="procantstock" class="form-input" value="${parseInt(producto.procantstock, 10)}" required>
                                            </div>
                                            <div class="form-group">
                                                    <label for="proimagen1" class="form-label">Seleccione la imagen para cambiar:</label>
                                                    <div class="form-group w-50">
                                                            <img src="${producto.proimagen1}" class="w-100 h-100" id="proimagen1-preview">
                                                    </div>
                                                    <input type="file" name="proimagen1" id="proimagen1" class="form-file">
                                            </div>
                                            <input type="submit" value="Cambiar producto" name="submit" class="form-submit" required>
                                    </form>
                            `);

                            $('#form').validate({
                                    rules: {
                                            pronombre: {
                                                    required: true,
                                                    minlength: 2,
                                            },
                                            proprecio: {
                                                    required: true,
                                                    number: true,
                                                    min: 1
                                            },
                                            prodetalle: {
                                                    required: true,
                                                    minlength: 5,
                                            },
                                            procantstock: {
                                                    required: true,
                                                    number: true,
                                                    min: 1

                                            },
                                            proimagen1: {
                                                    extension: "jpg|jpeg|png|gif"
                                            }
                                    },
                                    messages: {
                                            pronombre: {
                                                    required: "Por favor ingrese el nombre del producto",
                                                    minlength: "El nombre debe tener al menos 2 caracteres",
                                            },
                                            proprecio: {
                                                    required: "Por favor ingrese el precio del producto",
                                                    number: "Por favor ingrese un número",
                                                    min: "El valor debe ser mayor o igual a 1"
                                            },
                                            prodetalle: {
                                                    required: "Por favor ingrese el detalle del producto",
                                                    minlength: "El detalle debe tener al menos 5 caracteres"
                                            },
                                            procantstock: {
                                                    required: "Por favor ingrese la cantidad de stock",
                                                    number: "Por favor ingrese un número",
                                                    min: "El valor debe ser mayor o igual a 1"
                                            },
                                            proimagen1: {
                                                    extension: "Por favor seleccione una imagen con extensión jpg, jpeg, png o gif"
                                            }
                                    },
                                    submitHandler: function(form) {
                                            var formData = new FormData(form);
                                            formData.append('idproducto', producto.idproducto);

                                            var fileInput = $('#proimagen1')[0];
                                            if (fileInput.files && fileInput.files[0]) {
                                                    var reader = new FileReader();
                                                    reader.onload = function(e) {
                                                            formData.append('proimagen1', e.target.result);
                                                            enviarFormulario(formData);
                                                    };
                                                    reader.readAsDataURL(fileInput.files[0]);
                                            } else {
                                                    formData.append('proimagen1', $('#proimagen1-preview').attr('src'));
                                                    enviarFormulario(formData);
                                            }
                                    }
                            });

                            function enviarFormulario(formData) {
                                    $.ajax({
                                            url: './modificarAction.php',
                                            type: 'POST',
                                            data: formData,
                                            processData: false,
                                            contentType: false,
                                            success: function(texto) {
                                                    console.log(texto);
                                            },
                                            error: function(xhr, status, error) {
                                                    console.log('Error: ' + error);
                                            }
                                    });
                            }
                    },
                    error: function(xhr, status, error) {
                            console.log('Error: ' + error);
                    }
            });
    }

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
        </div>`);

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
        
    function evaluar(boton, idcompra, estado) {
        $.ajax({
            
            url: './actionEvaluar.php',
            type: 'POST',
            data: { idcompra: idcompra, estado: estado },

            success: function(response) {
                $('#mensajeOperacion').html(response);
                $(boton).closest('.evalua').remove();
                $.ajax({
                    url: '../buy/actionMandarCorreo.php',
                    type: 'post',
                    data: {estado: estado == 1 ? 'aceptado' : 'rechazado', compra: idcompra},
                    // beforeSend: function(){
                    //     console.log('enviando correo');
                    // },
                    success: function(response){
                        console.log(response);
                        $.ajax({
                            url: '../buy/actionMandarCorreo.php',
                            type: 'post',
                            data: {estado: response, compra: idcompra},
                            // beforeSend: function(){
                            //     console.log('enviando correo');
                            // },
                            success: function(response){
                                console.log(response);
                            },
                            error: function(xhr, status, error) {
                                console.log('Error: ' + error);
                            }
                        })
                    },
                    error: function(xhr, status, error) {
                        console.log('Error: ' + error);
                    }
                });
            },
            error: function(xhr, status, error) {
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
    

        <script>
            $(document).ready(function() {
                $('#confirmDeleteModal').modal('show');

                $('#confirmDeleteButton').on('click', function() {
                    $.ajax({
                        url: './actionBajaUsuario.php',
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
        </script>
        );
        
        url = './actionBajaUsuario.php';
        
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