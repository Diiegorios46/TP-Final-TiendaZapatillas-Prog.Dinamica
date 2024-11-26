<?php include '../estructura/cabeceraSegura.php';

$datos = data_submitted();
?>


<div class="container-sm min-vh-100">  

    <div id='mensajeOperacion'></div>

    <h1 class="deposito-title pt-4">Menu Productos</h1>

    <div class="deposito-menu" id="menuDinamico">
        <!--viene el codigo de jquery-->
    </div>
    <div class="grid"></div>

</div>

<script>
var menu = <?php echo json_encode($datos);?>;
if(menu.m == '3'){
// nuevo PRODUCTO
    $('.deposito-title').html('Agregar Producto');
    
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
                <input type="submit" value="Subir Producto" name="submit" class="btn-verde mt-4">
            </div>
        </form>`
    );

    $('#fm').validate({
        rules: {
            pronombre: {
                required: true,
                minlength: 2,
            },
            proprecio: {
                required: true,
                number: true
            },
            prodetalle: {
                required: true,
                minlength: 5,
            },
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
                url: './actionAgregarProducto.php',
                type: 'POST',
                data: new FormData(form),
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
    });
    
}else if(menu.m == '4'){
$('.deposito-title').html('Modificar Producto');

    $.ajax({
        url: '../pedidos/listarDeposito.php',
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
}

 function modificarProducto(producto) {

        $.ajax({
            url: './actionModificarProducto.php',
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
                        var formData = new FormData();
                        formData.append('idproducto', producto.idproducto);
                        formData.append('pronombre', $('#pronombre').val());
                        formData.append('proprecio', $('#proprecio').val());
                        formData.append('promarca', $('#promarca').val());
                        formData.append('promarca', $('#promarca option:selected').val());
                        formData.append('prodetalle', $('#prodetalle').val());
                        formData.append('procantstock', $('#procantstock').val());

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
                url: './actionModificarProducto.php',
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

</script>