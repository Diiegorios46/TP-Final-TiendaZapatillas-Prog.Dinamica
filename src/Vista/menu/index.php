
    <?php include '../estructura/cabeceraSegura.php' ?>

    <div class="container-sm">  

        <div id='mensajeOperacion'></div>

        <h1 class="deposito-title">Menu</h1>
        
        <div class="deposito-menu" id="menuDinamico">
            <!--viene el codigo de jquery-->
        </div>
        <div class="grid">

        </div>
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
                        response.forEach(menu => {
                            let menuHtml = `<button type="button" class="deposito-btn-subir-producto" onclick="obtenerMenu(${i})">${menu}</button>`;
                            $('.deposito-menu').append(menuHtml);
                            i++;
                        });
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
                url = 'url_1.php';
                break;
            case 2:
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
                    
                    e.preventDefault(); // Evita el envío por defecto del formulario
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
                                    console.log(result);
                                    console.log('todo bien locooo');
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
                                                <button class="btn btn-dark p-2 agregarCarrito" id="myButton" onclick="modificar(${productoStr})">Modificar Producto</button>
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
                url = 'listarUsuarios.php';

                $.ajax({
                url: url,
                type: 'GET',
                dataType: 'json',
                success: function(result) {

                $('.deposito-menu').html(''); 
                $('.grid').html(''); 
                    result.forEach(function(producto ,index) {

                        let usuario = `
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
                                            <button class="btn btn-dark p-2 agregarCarrito" id="myButton" onclick="modificarUsuario(${})">Modificar Producto</button>
                                        </div>
                                    </div>
                                </div>
                        `;
                        $('.grid').append(usuario);
                    });
                },
                error: function(xhr, status, error) {
                    console.log('Error al cargar los datos del menú dinámico.');
                    console.log('Error: ' + error);
                }
              
            })

                break;
            case 5:
                url = 'url_5.php';
                break;
            case 6:
                url = 'url_6.php';
                break;
            case 7:
                url = 'url_7.php';
                break;
            default:
                console.log('Índice fuera de rango: ' + indice);
                return;
        }
    }


    function modificar(producto) {
        $('.grid').html('');
        $('.deposito-menu').html(`
            <form class="upload-form" id="form" novalidate method="post">
                <div class="form-group">
                    <label for="pronombre" class="form-label">Nombre del producto</label>
                    <input type="text" name="pronombre" id="pronombre" class="form-input" value="${producto.pronombre}" required>
                </div>
                
                <div class="form-group">
                    <label for="proprecio" class="form-label">Precio del producto</label>
                    <input type="number" name="proprecio" id="proprecio" class="form-input" value="${producto.proprecio}" required>
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
                    <input type="number" name="procantstock" id="procantstock" class="form-input" value="${producto.procantstock}" required>
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
                        dataType: 'json',

                        success: function(result){
                            try {
                                if (result) {
                                    console.log(result);
                                    $('#mensajeOperacion').addClass('alert alert-success alert-dismissible fade show text-center').html('Producto agregado exitosamente.');    
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
                 
            }
            
</script>



