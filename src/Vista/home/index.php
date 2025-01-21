<?php
include '../../../config.php';

if ($session->validar()) {
    $session->cerrar();
    include '../estructura/cabeceraSegura.php';
} else {
    $session->cerrar();
    include '../estructura/cabecera.php';
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
    <main class="container-fluid min-vh-100">
        <section class="container-fill d-flex flex-row shadow" id="homeSection">
            <div class="w-25 min-vh-100 margin-right-2 shadow mr-2porciento" id="listaFiltro">
                <div class="mt-4">
                    <div class="accordion" id="accordionExample">
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                    Precios Zapatillas
                                </button>
                            </h2>

                            <div id="collapseThree" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                                <div class="accordion-body">

                                    <ul class="list-unstyled">
                                        <li class="d-flex align-items-center mb-2">
                                            <input type="radio" name="price" id="price0" value="0" class="me-2" onclick="mostrarProductos()" checked>
                                            <label for="price0" class="mb-0">Todos los productos</label>
                                        </li>
                                        <li class="d-flex align-items-center mb-2">
                                            <input type="radio" name="price" id="price100" value="1" class="me-2" onclick="mostrarProductos()">
                                            <label for="price100" class="mb-0">Menor a $100</label>
                                        </li>
                                        <li class="d-flex align-items-center mb-2">
                                            <input type="radio" name="price" id="price200" value="2" class="me-2" onclick="mostrarProductos()">
                                            <label for="price200" class="mb-0">Entre $100 y $200</label>
                                        </li>
                                        <li class="d-flex align-items-center mb-2">
                                            <input type="radio" name="price" id="price300" value="3" class="me-2" onclick="mostrarProductos()">
                                            <label for="price300" class="mb-0">Mas de $200</label>
                                        </li>
                                    </ul>

                                </div>
                            </div>
                        </div>
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                Marcas Zapatillas
                            </button>
                        </h2>

                        <div id="collapseThree" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                <ul class="list-unstyled">

                                    <li class="d-flex align-items-center mb-2">
                                        <input type="radio" name="priceMarca" id="price0" value="0" class="me-2" onclick="mostrarProductos()" checked>
                                        <label for="price0" class="mb-0">Todos las marcas</label>
                                    </li>
                                    <li class="d-flex align-items-center mb-2">
                                        <input type="radio" name="priceMarca" id="price100" value="vans" class="me-2" onclick="mostrarProductos()">
                                        <label for="price100" class="mb-0">Vans</label>
                                    </li>
                                    <li class="d-flex align-items-center mb-2">
                                        <input type="radio" name="priceMarca" id="price200" value="nike" class="me-2" onclick="mostrarProductos()">
                                        <label for="price200" class="mb-0">Nike</label>
                                    </li>
                                    <li class="d-flex align-items-center mb-2">
                                        <input type="radio" name="priceMarca" id="price300" value="adidas" class="me-2" onclick="mostrarProductos()">
                                        <label for="price300" class="mb-0">Adidas</label>
                                    </li>
                                    <li class="d-flex align-items-center mb-2">
                                        <input type="radio" name="priceMarca" id="price300" value="topper" class="me-2" onclick="mostrarProductos()">
                                        <label for="price300" class="mb-0">Topper</label>
                                    </li>

                                </ul>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="w-75 justify-content-center align-content-start" id="content-all-cards">
                <div class="row mt-4" id="prueba">
                    <!-- Aquí se agregarán las tarjetas dinámicamente con jquery -->
                </div>
            </div>

        </section>
    </main>


    <script id="template-card-zapatillas" type="text/template">

        <div class="col-3 col-6 col-md-3">
                <div class="card d-flex w-100 h-100 sombraCard p-2">
                    <div class="card-img w-100">
                        <img src="{{proimagen1}}" alt="" class="w-100 h-100 img-card">
                    </div>
                    <div class="card-marca">{{promarca}}</div>
                    <div class="card-infoZapatillas data-nombre">{{pronombre}}</div>
                    <div class="card-precioMasDescuento">
                        <strong>$</strong><span class="data-precio">{{proprecio}}</span><strong>USD</strong>
                    </div>
                    <div class="hidden">
                        <span class="data-idproducto">{{idproducto}}</span>
                    </div>
                    <div class="card-button text-center pt-3">
                        <button class="p-2 agregarCarrito btn btn-dark" id="myButton" onclick="agregarAlCarrito(this)">Agregar al carrito</button>
                    </div>
                </div>
            </div>
        </script>

    <script id="template-carrito" type="text/template">
        <div class="border border-dark d-flex flex-row justify-content-around card">
                <div class="w-25">
                    <img src="${item.img}" alt="" class="w-100 h-100">  
                </div>
                <div class="card-infoZapatillas d-flex">
                    <p class="nombre-zapatilla align-self-center mb-0 fs-6">{{nombre}}</p>
                </div>
                <div class="d-flex">
                    <span class="align-self-center fs-6">{{precio}}</span>
                </div>
                <div class="d-flex">
                    <span class="align-self-center fs-6">{{cantidad}} unidades</span>
                </div>
                <div class="align-self-center">
                    <button type="button" class="btn btn-dark" onclick="sacarDelcarrito(this)">
                        <i class="bi bi-x"></i>
                    </button>
                </div>
            </div>
        </script>

        <script id="modal-template" type="text/x-handlebars-template">
            {{#each carrito}}
                <div class="border border-dark d-flex flex-row justify-content-around card h-auto">
                    <div class="w-25">
                        <img src="{{img}}" alt="" class="w-100 h-100">
                    </div>
                    <div class="card-infoZapatillas d-flex">
                        <p class="nombre-zapatilla align-self-center mb-0 fs-6">{{nombre}}</p>
                    </div>
                    <div class="d-flex">
                        <span class="align-self-center fs-6">${{precio}}</span>
                    </div>
                    <div class="d-flex">
                        <span class="align-self-center fs-6">{{cantidad}}</span>
                    </div>
                    <div class="align-self-center">
                        <button type="button" class="btn btn-dark" onclick="sacarDelcarrito(this)">
                            <i class="bi bi-x"></i>
                        </button>
                    </div>
                    <div class="hidden">
                        <span class="align-self-center fs-6">{{id}}</span>
                    </div>
                </div>
            {{/each}}

            <form method='post' action='../buy/inicioCompra.php' class="card-compra d-flex flex-row w-100 justify-content-center mr-5 mb-2 pr-1">
                {{#each carrito}}
                    <input type='hidden' name='productos[{{@index}}][idproducto]' value='{{id}}'>
                    <input type='hidden' name='productos[{{@index}}][nombre]' value='{{nombre}}'>
                    <input type='hidden' name='productos[{{@index}}][precio]' value='{{precio}}'>
                    <input type='hidden' name='productos[{{@index}}][cantidad]' value='{{cantidad}}'>
                    <input type='hidden' name='productos[{{@index}}][img]' value='{{img}}'>
                {{/each}}
                <button type='submit' class="btn btn-dark btn-comprar">Pagar</button>
            </form>
        </script>


    <script src="../Assets/home.js?=<?php echo time() ?>"></script>
</body>

</html>