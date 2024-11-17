    <?php include '../estructura/cabeceraSegura.php' ?>

    <div class="container-sm">  

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
                        let menuHtml = "<div class='d-flex flex-column'>"; // Definir menuHtml
                        
                        response.forEach(menu => {
                            switch(menu) {
                                case 'verpaquete':
                                    menu = "<span>Ver Paquete(s).</span>";
                                    break;
                                case 'agregarproducto':
                                    menu = "<span>Agregar un Producto.</span>";
                                    break;
                                case 'modificarproducto':
                                    menu = "<span>Modificar un Producto.</span>";
                                    break;
                                case 'altausuario':
                                    menu = "<span>Agregar un Usuario.</span>";
                                    break;
                                case 'bajausuario':
                                    menu = "<span>Borrar Usuario.</span>";
                                    break;
                                case 'modificarusuario':
                                    menu = "<span>Modificar un Usuario.</span>";
                                    break;
                                case 'configuracionusuario': 
                                    menu = "<span>Configuracion de Usuario.</span>";
                                    break;
                            }
                            menuHtml += `<button type="button" class="deposito-btn-subir-producto mb-2" onclick="obtenerMenu(${i})">${menu}</button>`;
                            i++;
                        });
                        menuHtml += "</div>";
                        $('.deposito-menu').append(menuHtml);
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


                break;
            case 2:
                //AGREGAR PRODUCTO ADMIN CORREGIR PORQUE SOLO ADMIN TIENE ESE ORDEN , PERO LO DEJO ASI PARA QUE SEPAMOS LOS CODIGOS

                url = './agregarAction.php';
                $('.deposito-menu').html(`
                    <form class="upload-form" id="fm" novalidate method="post">
                        <div class="form-group">
                            <label for="pronombre" class="form-label">Nombre del producto</label>
                            <input type="text" name="pronombre" id="pronombre" class="form-input" required>
                        </div>
                        <div class="form-group">
                            <label for="proprecio" class="form-label">Precio del producto</label>
                            <input type="number" name="proprecio" id="proprecio" class="form-input" required>
                        </div>
                        <div class="form-group">
                            <label for="promarca" class="form-label">Marca del producto</label>
                            <select name="promarca" id="promarca" class="form-select" required>
                                <option value="nike">Nike</option>
                                <option value="adidas">Adidas</option>
                                <option value="vans">Vans</option>
                                <option value="dc">DC</option>
                                <option value="topper">Topper</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="prodetalle" class="form-label">Detalle del producto</label>
                            <input type="text" name="prodetalle" id="prodetalle" class="form-input" required>
                        </div>
                        <div class="form-group">
                            <label for="procantstock" class="form-label">Cantidad de stock</label>
                            <input type="number" name="procantstock" id="procantstock" class="form-input" required>
                        </div>
                        <div class="form-group">
                            <label for="image" class="form-label">Choose image(s) to upload:</label>
                            <input type="file" name="image[]" id="image" class="form-file" multiple required>
                        </div>
                        <input type="submit" value="Subir imagen" name="submit" class="form-submit">
                    </form>`);

                $('#fm').on('submit', function(e) {
                    
                    e.preventDefault(); 
                    $.ajax({
                        url: url,
                        type: 'POST',
                        data: new FormData(this),
                        processData: false,
                        contentType: false,
                        dataType: 'json',
                        success: function(result) {
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
                });
                
                break;
            case 3:
                //MODIFICAR PRODUCTO ADMIN CORREGIR PORQUE SOLO ADMIN TIENE ESE ORDEN , PERO LO DEJO ASI PARA QUE SEPAMOS LOS CODIGOS
                url = './listarDeposito.php';

                $.ajax({
                    url: url,
                    type: 'GET',
                    dataType: 'json',
                    success: function(result) {

                    $('.deposito-menu').html(''); 
                    $('.grid').html(''); 
                    let row;
                        result.forEach(function(producto ,index) {
                            if (index % 4 === 0) {
                                    row = $('<div class="row mt-4 mb-4"></div>');
                                    $('.grid').append(row);
                                }
                                
                            let productoStr = JSON.stringify(producto).replace(/"/g, '&quot;');
                            let zapatilla = `
                                    <div class="col-3">
                                        <div class="card d-flex w-100 h-100 p-3 shadow-sm">
                                            <div class="card-img w-100">
                                                <img src="${producto.proimagen1}" alt="" class="w-100 h-100 img-card">
                                            </div>
                                            <div class="card-marca">${producto.promarca}</div>
                                            <div class="card-infoZapatillas data-nombre">${producto.pronombre}</div>
                                            <div class="card-precioMasDescuento">
                                                <span class="data-precio">${producto.proprecio}</span>
                                                <span>10% off</span>
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
            case 4:
                //ALTA USUARIO ADMIN CORREGIR PORQUE SOLO ADMIN TIENE ESE ORDEN , PERO LO DEJO ASI PARA QUE SEPAMOS LOS CODIGOS
                url = './actionAltaUsuario.php';
                
                $('.deposito-menu').html(`
                    <div class="container mt-5">
                        <h2>Formulario de Registro</h2>
                        <form class="" id="formulario" novalidate method="post">
                            <div class="form-group">
                                <label for="nombre">Nombre</label>
                                <input type="text" name="usnombre" class="form-control" id="nombre" placeholder="Ingresa tu nombre" required>
                            </div>
                            <div class="form-group">
                                <label for="contraseña">Contraseña</label>
                                <input type="password" name="uspass" class="form-control" id="contraseña" placeholder="Ingresa tu contraseña" required>
                            </div>
                            <div class="form-group">
                                <label for="correo">Correo Electrónico</label>
                                <input type="email" name="usmail" class="form-control" id="correo" placeholder="Ingresa tu correo electrónico" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Enviar</button>
                        </form>
                </div>`);

                $('#formulario').on('submit', function(e) {
                    e.preventDefault(); 
                    $.ajax({
                        url: url,
                        type: 'POST',
                        data: new FormData(this),
                        processData: false,
                        contentType: false,
                        dataType: 'json',
                        success: function(result) {
                            try {
                                if (result) {
                                    $('#mensajeOperacion').addClass('alert alert-success alert-dismissible fade show text-center').html('Se agrego un usuario correctamente.');    
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
                });

                break;
            case 5:
                //BAJA USUARIO ADMIN CORREGIR PORQUE SOLO ADMIN TIENE ESE ORDEN , PERO LO DEJO ASI PARA QUE SEPAMOS LOS CODIGOS

                url = './listarUsuarios.php';

                $.ajax({ 
                    url: url, 
                    type: 'GET', 
                    dataType: 'json', 
                    success: function(result) { 

                        $('.deposito-menu').html(''); 
                        $('.grid').html(''); 

                        let row;

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
                                                <h5 class="card-title">Nombre :${usuario.usnombre}</h5> 
                                                <h5 class="card-text">Contraseña: ${usuario.uspass}</h5> 
                                                <h5 class="card-text">Correo: ${usuario.usmail}</h5> 
                                                <p class="card-text">${usuario.usdeshabilitado == '0000-00-00 00:00:00' ? 'Habilitado' : 'Deshabilitado'}</p> 
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
                case 6:
                    //MODIFICAR USUARIO ADMIN CORREGIR PORQUE SOLO ADMIN TIENE ESE ORDEN , PERO LO DEJO ASI PARA QUE SEPAMOS LOS CODIGOS

                    url = './listarUsuarios.php'; 
                    
                    $.ajax({
                        url: './listarUsuarios.php',
                        type: 'GET',
                        dataType: 'json',
                        success: function(result) {
                            $('.deposito-menu').html('');
                            $('.grid').html('');

                            let row;
                            result.forEach(function(usuario, index ) {
                                    let usuarioStr = JSON.stringify(usuario).replace(/"/g, '&quot;');

                                    if (index % 4 === 0) {
                                        row = $('<div class="row mt-4 mb-4"></div>');
                                        $('.grid').append(row);
                                    }
                                    let usuarioHtml = `
                                        <div class="col-3">
                                            <div class="card m-2 p-2 shadow-sm">
                                                <div class="card-body">
                                                    <form>
                                                        <h5 class="card-title">${usuario.usnombre}</h5>
                                                        <p class="card-text">Contraseña: ${usuario.uspass}</p>
                                                        <p class="card-text">Correo: ${usuario.usmail}</p>
                                                        <p class="card-text">Rol: ${usuario.rodescripcion}</p>
                                                        <button class="btn btn-light"><a onclick="modificarUsuario(${usuarioStr})">Modificar</a></button>
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
            //COFIG USUARIO ADMIN CORREGIR PORQUE SOLO ADMIN TIENE ESE ORDEN , PERO LO DEJO ASI PARA QUE SEPAMOS LOS CODIGOS
                url = './actionlistarDatosUsuario.php';

            $.ajax({
                url: url,
                type: 'GET',
                dataType: 'json',
                success: function(result) {
                    $('.deposito-menu').html('');
                    $('.grid').html('');

                    let userInfo = `
                        <form class="upload-form" id="formularioUs" novalidate method="post" action="./actionConfigurarPerfil.php">
                            <div class="form-group">
                                <label for="usnombre" class="form-label">Nombre del usuario</label>
                                <input type="text" name="usnombre" id="usnombre" class="form-input" value="${result.usnombre}" required>
                            </div>
                            <div class="form-group">
                                <label for="usmail" class="form-label">Correo del usuario</label>
                                <input type="email" name="usmail" id="usmail" class="form-input" value="${result.usmail}" required>
                            </div>
                            <div class="form-group">
                                <label for="uspass" class="form-label">Contraseña del usuario</label>
                                <input type="password" name="uspass" id="uspass" class="form-input" value="${result.uspass}" required>
                            </div>
                            <input type="submit" value="Actualizar Perfil" name="submit" class="form-submit">
                        </form>
                    `;
                    $('.deposito-menu').append(userInfo);

                        $('#formularioUs').on('submit', function(e) {
                            e.preventDefault();
                            $.ajax({
                                url: './actionConfigurarPerfil.php',
                                type: 'POST',
                                data: new FormData(this),
                                processData: false,
                                contentType: false,
                                success: function(texto) {
                                    $('#mensajeOperacion').addClass('alert alert-success alert-dismissible fade show text-center').html('Perfil editado exitosamente.');
                                },
                                error: function(xhr, status, error) {
                                    console.log('Error: ' + error);
                                }
                            });
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

    function modificarProducto(producto){
        $('.grid').html('');

        $('.deposito-menu').html(`
            <form class="upload-form" id="form" novalidate method="post">
                <div class="form-group">
                    <label for="pronombre" class="form-label">Nombre del producto</label>
                    <input type="text" name="pronombre" id="pronombre" class="form-input" value="${producto.pronombre}" required>
                </div>
                
                <div class="form-group">
                    <label for="proprecio" class="form-label">Precio del producto</label>
                    <input type="number" name="proprecio" id="proprecio" class="form-input" value="${parseInt(producto.proprecio,10).toFixed(2)}" required>
                </div>
                
                <div class="form-group">
                    <label for="promarca" class="form-label">Marca del producto</label>
                    <select name="promarca" id="promarca" class="form-select" required>
                        <option value="nike" ${producto.promarca === 'nike' ? 'selected' : ''}>Nike</option>
                        <option value="adidas" ${producto.promarca === 'adidas' ? 'selected' : ''}>Adidas</option>
                        <option value="vans" ${producto.promarca === 'vans' ? 'selected' : ''}>Vans</option>
                        <option value="dc" ${producto.promarca === 'dc' ? 'selected' : ''}>DC</option>
                        <option value="topper" ${producto.promarca === 'topper' ? 'selected' : ''}>Topper</option>
                    </select>
                </div>
                
                <div class="form-group">
                    <label for="prodetalle" class="form-label">Detalle del producto</label>
                    <input type="text" name="prodetalle" id="prodetalle" class="form-input" value="${producto.prodetalle}" required>
                </div>
                
                <div class="form-group">
                    <label for="procantstock" class="form-label">Cantidad de stock</label>
                    <input type="number" name="procantstock" id="procantstock" class="form-input" value="${parseInt(producto.procantstock,10)}" required>
                </div>

                <div class="form-group">
                    <label for="image" class="form-label">Seleccione las imagenes para cambiar:</label>
                    <div class="form-group w-50">
                        <img src="${producto.proimagen1}" class="w-100 h-100">
                    </div>
                    <input type="file" name="image[]" id="image" class="form-file" multiple required>
                </div>
                <input type="submit" value="Subir imagen" name="submit" class="form-submit" required>
            </form>`);

            url = './modificarAction.php';
            
            $('#form').on('submit', function(e) {
                e.preventDefault(); 
                $.ajax({
                    url: url,
                    type: 'POST',
                    data: new FormData(this),
                    processData: false,
                    contentType: false,

                    success: function(texto) {
                        console.log(texto);
                        $('#mensajeOperacion').addClass('alert alert-success alert-dismissible fade show text-center').html('Producto modificado exitosamente.');
                    },
                    error: function(xhr, status, error) {
                        console.log('Error: ' + error);
                    }
                });
            });
                 
        }

        function modificarUsuario(objUsuario){
            $('.grid').html('');

            $('.deposito-menu').html(`
                <form class="upload-form" id="formularioUsuario" novalidate method="post">
                    <div class="form-group">
                        <label for="usnombre" class="form-label">Nombre del usuario</label>
                        <input type="text" name="usnombre" id="usnombre" class="form-input" value="${objUsuario.usnombre}" required>
                    </div>
                    <div class="form-group hidden">
                        <label for="usid" class="form-label">ID del usuario</label>
                        <input type="text" name="idusuario" id="idusuario" class="form-input" value="${objUsuario.idusuario}" required>
                    </div>
                    <div class="form-group">
                        <label for="uspass" class="form-label">Contraseña del usuario</label>
                        <input type="text" name="uspass" id="uspass" class="form-input" value="${objUsuario.uspass}" required>
                    </div>
                    <div class="form-group">
                        <label for="usmail" class="form-label">Correo del usuario</label>
                        <input type="text" name="usmail" id="usmail" class="form-input" value="${objUsuario.usmail}" required>
                        
                    </div> 
                      <div class="form-group">
                        <label for="rodescripcion" class="form-label">Rol</label>
                        <input type="text" name="rodescripcion" id="rodescripcion" class="form-input" value="${objUsuario.rodescripcion}" required>
                    </div> 
                    <input type="submit" value="Modificar usuario" name="submit" class="form-submit" required>
                </form>`
            );

            url = './actionModificarUsuario.php';

            $('#formularioUsuario').on('submit', function(e) {
                e.preventDefault(); 
                $.ajax({
                    url: url,
                    type: 'POST',
                    data: new FormData(this),
                    processData: false,
                    contentType: false,

                    success: function(texto) {

                        $('#mensajeOperacion').addClass('alert alert-success alert-dismissible fade show text-center').html('Usuario modificado exitosamente.');

                    },
                    error: function(xhr, status, error) {
                        console.log('Error: ' + error);
                    }
                });
            });

        }

        function borradoLogicaUsuario(objUsuario){

            $('.grid').html('');

            $('.deposito-menu').html(`
                <form class="upload-form" id="formularioUsuario" novalidate method="post">
                    <div class="form-group">
                        <label for="usnombre" class="form-label">Nombre del usuario</label>
                        <input type="text" name="usnombre" id="usnombre" class="form-input" value="${objUsuario.usnombre}" readonly required>
                    </div>
                    <div class="form-group hidden">
                        <label for="usid" class="form-label">ID del usuario</label>
                        <input type="text" name="idusuario" id="idusuario" class="form-input" value="${objUsuario.idusuario}" readonly required>
                    </div>
                    <div class="form-group">
                        <label for="usmail" class="form-label">Correo del usuario</label>
                        <input type="text" name="usmail" id="usmail" class="form-input" value="${objUsuario.usmail}" readonly required>
                    </div>
                    <div class="form-group"> 
                         <label for="usmail" class="form-label">Estado</label>
                        <input type="text" name="usmail" id="usmail" class="form-input" value="${objUsuario.usdeshabilitado == '0000-00-00 00:00:00' ? 'Habilitado' : 'Deshabilitado'}" readonly required>
                        <p>¿Estas seguro de que quieres eliminar ? 😲😒</p>
                        <input type="submit" value="Confirmar Baja" name="submit" class="form-submit" required>
                    </div>                 
                </form>`
            );
            
            url = './actionBajaUsuario.php';
            
            $('#formularioUsuario').on('submit', function(e) {
                e.preventDefault(); 
                $.ajax({
                    url: url,
                    type: 'POST',
                    data: new FormData(this),
                    processData: false,
                    contentType: false,
                    
                    success: function(texto) {

                        $('#mensajeOperacion').addClass('alert alert-success alert-dismissible fade show text-center').html('Usuario deshabilitado exitosamente.');

                    },
                    error: function(xhr, status, error) {
                        console.log('Error: ' + error);
                    }
                });
            });
        }
            
</script>







