<?php
    include '../../../config.php';
    if($session->validar()){
        $session->cerrar();
        include '../estructura/cabeceraSegura.php';
    } else {
        $session->cerrar();
        include '../estructura/cabecera.php';
    }
    if (isset($_GET['seccion']) && $_GET['seccion'] == 'iniciarCompra'){
        echo 'inicioCompra';
    }
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Home</title>
    </head>
    <body>
        <nav class="container-fluid bg-negro p-4">
            <div class="container-sm d-flex gap">
                <div class="w-25"><img src="../Assets/imgs/adidas.png" alt="" class="w-100 h-100 bg-light imagen"></div>
                <div class="w-25"><img src="../Assets/imgs/nike.jpg" alt="" class="w-100 h-100 imagen"></div>
                <div class="w-25"><img src="../Assets/imgs/vans.jpg" alt="" class="w-100 h-100 imagen"></div>
                <div class="w-25"><img src="../Assets/imgs/tooper.jpg" alt="" class="w-100 h-100 imagen"></div>
            </div>
        </nav>
        <main class="container-fluid">
            <section class="container-fill d-flex flex-row shadow">
                <div class="w-25 min-vh-100 margin-right-2 shadow mr-2porciento">
                    <div class="mt-4">
                        <div class="accordion" id="accordionExample">
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                        Talles
                                    </button>
                                </h2>
                                <div id="collapseOne" class="accordion-collapse collapse show" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <ul>
                                            <li><input type="checkbox" name="" id="">30</li>
                                            <li><input type="checkbox" name="" id="">32</li>
                                            <li><input type="checkbox" name="" id="">33</li>
                                            <li><input type="checkbox" name="" id="">34</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                        Categoria
                                    </button>
                                </h2>
                                <div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <ul>
                                            <li><input type="checkbox" name="" id="">Hombre</li>
                                            <li><input type="checkbox" name="" id="">Mujer</li>
                                            <li><input type="checkbox" name="" id="">Niños</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                        Precio
                                    </button>
                                </h2>
                                <div id="collapseThree" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <ul>
                                            <li><input type="checkbox">$100</li>
                                            <li><input type="checkbox">$200</li>
                                            <li><input type="checkbox">$300</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="w-75 justify-content-center align-content-start">
                    <div class="row mt-4 mb-4" id="prueba">
                        <!-- Aquí se agregarán las tarjetas dinámicamente -->
                    </div>
                </div>
            </section>
        </main>
    
        <script>
            $(document).ready(function() {
                function mostrarProductos() {
                    $.ajax({
                        url: 'action.php',
                        type: 'GET',
                        dataType: 'json',
                        beforeSend: function () {
                            $('#prueba').html('Cargando...');
                        },
                        success: function (response) {
                            $('#prueba').html('');
                            let row;
                            response.forEach((producto, index) => {
                                if (index % 4 === 0) {
                                    row = $('<div class="row mt-4 mb-4"></div>');
                                    $('#prueba').append(row);
                                }
                                let zapatilla = `
                                    <div class="col-3">
                                        <div class="card d-flex w-100 h-100 p-3 shadow-sm">
                                            <div class="card-img w-100">
                                                <img src="${producto.proimagen1}" alt="" class="w-100 h-100 img-card">
                                            </div>
                                            <div class="card-marca">${producto.promarca}</div>
                                            <div class="card-infoZapatillas data-nombre">${producto.pronombre}</div>
                                            <div class="card-precioMasDescuento">
                                                <strong>$</strong><span class="data-precio">${producto.proprecio} </span><strong>USD</strong>
                                            </div>
                                            <div class="hidden">
                                                <span class="data-idproducto">${producto.idproducto}</span>
                                            </div>
                                            <div class="card-button text-center pt-3">
                                                <button class="btn btn-dark p-2 agregarCarrito" id="myButton" onclick="agregarAlCarrito(this)">Agregar al carrito</button>
                                            </div>
                                        </div>
                                    </div>`;
                                row.append(zapatilla);
                            });
                        },
                        error: function (xhr, status, error) {
                            console.error('Error en la solicitud AJAX:', status, error);
                            $('#prueba').html('Error al cargar los datos.');
                        }
                    });
                }
                mostrarProductos();
            });
        </script>

        <script>

        var carrito = [];
        var modales = document.getElementsByClassName('offcanvas-body');

        function sacarDelcarrito(button) {

        var card = button.closest('.card');
        var nombre = card.querySelector('.card-infoZapatillas').textContent.trim();
        var id = card.querySelector('.hidden').textContent.trim();

        console.log(id);
        let productEliminar = carrito.findIndex(producto => producto.nombre === nombre);

        if (productEliminar !== -1) {

            carrito.splice(productEliminar, 1);
            let modal = modales[0]; 
            modal.innerHTML = "";

                if (carrito.length > 0) { 
                    carrito.forEach(item => { 
                    modal.innerHTML += `
                        <div class="border border-dark d-flex flex-row justify-content-around card">
                            <div class="w-25">
                                <img src="${item.img}" alt="" class="w-100 h-100">  
                            </div>
                            <div class="card-infoZapatillas d-flex">
                                <p class="nombre-zapatilla align-self-center mb-0 fs-6">${item.nombre}</p>
                            </div>
                            <div class="d-flex">
                                <span class="align-self-center fs-6">${item.precio}</span>
                            </div>
                            <div class="d-flex">
                                <span class="align-self-center fs-6">${item.cantidad}unidades</span>
                            </div>
                            <div class="d-flex">
                                <span class="align-self-center fs-6">${item.id}unidades</span>
                            </div>
                            <div class="align-self-center">
                                <button type="button" class="btn btn-dark" onclick="sacarDelcarrito(this)">
                                    <i class="bi bi-x"></i>
                                </button>
                            </div>
                        </div>
                        <form method='post' action='../buy/inicioCompra.php' class="card-compra d-flex flex-row w-100 justify-content-center mr-5 mb-2 pr-1">
                            <button type='submit' name='idproducto' value='' class="btn btn-dark btn-comprar">Pagar</button>
                        </form>
                    `; 
                }); 
                }else{ 
                    modal.innerHTML = "<p>El carrito esta vacio</p>"; 
                } 
            }else { 
                    console.log(`Producto no encontrado: ${nombre}`); 
            } 
        }

        function agregarAlCarrito(button) {
            var card = button.closest('.card');
            var nombreZapatilla = card.querySelector('.card-infoZapatillas').textContent;
            var precioZapatilla = card.querySelector('.data-precio').textContent;
            var id = card.querySelector('.hidden').textContent.trim();
            var imgSrc = card.querySelector('.card-img img').src;

            let zapatilla = {
                id : id,
                nombre: nombreZapatilla,
                precio: precioZapatilla,
                cantidad: 1,
                img: imgSrc
            };

            verificarMasZapatillas(zapatilla);
            mandarAlmodal();
        }

        function verificarMasZapatillas(zapatilla) {

            let productoEnCarrito = carrito.find(producto => producto.nombre === zapatilla.nombre);
            if (productoEnCarrito) {
                productoEnCarrito.cantidad++;
            } else {
                carrito.push(zapatilla);
            }
        }

        function mandarAlmodal() {
            let modales = document.getElementsByClassName('offcanvas-body');
            if (modales.length > 0) {
                let modal = modales[0];  
                modal.innerHTML = '';

                carrito.forEach(item => {
                    modal.innerHTML += `
                        <div class="border border-dark d-flex flex-row justify-content-around card">
                            <div class="w-25">
                                <img src="${item.img}" alt="" class="w-100 h-100">
                            </div>
                            <div class="card-infoZapatillas d-flex">
                                <p class="nombre-zapatilla align-self-center mb-0 fs-6">${item.nombre}</p>
                            </div>
                            <div class="d-flex">
                                <span class="align-self-center fs-6">$${item.precio}</span>
                            </div>
                            <div class="d-flex">
                                <span class="align-self-center fs-6">${item.cantidad}</span>
                            </div>
                            <div class="align-self-center">
                                <button type="button" class="btn btn-dark" onclick="sacarDelcarrito(this)">
                                    <i class="bi bi-x"></i>
                                </button>
                            </div>
                            <div class="hidden">
                                <span class="align-self-center fs-6">${item.id}</span>
                            </div>
                        </div>
                        <form method='post' action='../buy/inicioCompra.php' class="card-compra d-flex flex-row w-100 justify-content-center mr-5 mb-2 pr-1">
                            <button type='submit' name='idproducto' value='' class="btn btn-dark btn-comprar">Pagar</button>
                        </form>
                    `;
                });

                modal.innerHTML += `
                <form method='post' action='../buy/inicioCompra.php' class="card-compra d-flex flex-row w-100 justify-content-center mr-5 mb-2 pr-1">
                    ${carrito.map((item, index) => `
                        <input type='hidden' name='productos[${index}][idproducto]' value='${item.id}'>
                        <input type='hidden' name='productos[${index}][nombre]' value='${item.nombre}'>
                        <input type='hidden' name='productos[${index}][precio]' value='${item.precio}'>
                        <input type='hidden' name='productos[${index}][cantidad]' value='${item.cantidad}'>
                        <input type='hidden' name='productos[${index}][img]' value='${item.img}'>
                    `).join('')}
                    <button type='submit' class="btn btn-dark btn-comprar">Pagar</button>
                </form>
            `;
            }
        }

        </script>
        
</body>
</html>
    