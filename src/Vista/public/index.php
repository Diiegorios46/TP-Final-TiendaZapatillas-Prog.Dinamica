<?php
include '../estructura/cabecera.php';
$session = new Session();
if($session->validar()){
    header('Location: ../home/index.php');
}

?>
<body>
<main class="container-fluid">
        <section class="container-sm d-flex flex-row">
            <div class="w-25 min-vh-100 margin-right-2 shadow">
                <div class="mt-4">
                    <div class="accordion" id="accordionExample">
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                    Talles
                                </button>
                            </h2>
                            <div id="collapseOne" class="accordion-collapse collapse show"
                                data-bs-parent="#accordionExample">
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
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                    Categoria
                                </button>
                            </h2>
                            <div id="collapseTwo" class="accordion-collapse collapse"
                                data-bs-parent="#accordionExample">
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
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                    Precio
                                </button>
                            </h2>
                            <div id="collapseThree" class="accordion-collapse collapse"
                                data-bs-parent="#accordionExample">
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
                <div class="row mt-4 mb-4">
                    <div class="col w-25 h-100 p-l-r-5">

                        <div class="card d-flex w-100 p-3 shadow-sm ">
                            <div class="card-img w-100">
                                <img src="../Assets/imgs/imgZapatilla-auto.webp" alt="" class="w-100 h-100 img-card">
                            </div>
                            <div class="card-marca">Marca</div>
                            <div class="card-infoZapatillas data-nombre">jordan 1</div>
                            <div class="card-precioMasDescuento">
                                <span class="data-precio">$100.9,00</span>
                                <span>10% off</span>
                            </div>
                            <div class="card-button text-center pt-3">
                                <button class="btn btn-dark p-2 agregarCarrito" id="myButton"
                                    onclick="agregarAlCarrito(this)">Agregar al carrito</button>
                            </div>
                        </div>

                    </div>
                    <div class="col w-25 h-100 p-l-r-5">

                        <div class="card d-flex w-100 p-3 shadow-sm">
                            <div class="card-img w-100">
                                <img src="../Assets/imgs/imgZapatilla-auto.webp" alt="" class="w-100 h-100">
                            </div>
                            <div class="card-marca">Marca</div>
                            <div class="card-infoZapatillas data-nombre">Barquito</div>
                            <div class="card-precioMasDescuento">
                                <span class="data-precio">$gratis</span>
                                <span>10% off</span>
                            </div>
                            <div class="card-button text-center pt-3">
                                <button class="btn btn-dark p-2 agregarCarrito" id="myButton"
                                    onclick="agregarAlCarrito(this)">Agregar al carrito</button>
                            </div>
                        </div>

                    </div>

                    <div class="col w-25 h-100 p-l-r-5">

                        <div class="card d-flex w-100 p-3 shadow-sm">
                            <div class="card-img w-100">
                                <img src="../Assets/imgs/imgZapatilla-auto.webp" alt="" class="w-100 h-100">
                            </div>
                            <div class="card-marca">Marca</div>
                            <div class="card-infoZapatillas data-nombre">Barquito</div>
                            <div class="card-precioMasDescuento">
                                <span class="data-precio">$gratis</span>
                                <span>10% off</span>
                            </div>
                            <div class="card-button text-center pt-3">
                                <button class="btn btn-dark p-2 agregarCarrito" id="myButton"
                                    onclick="agregarAlCarrito(this)">Agregar al carrito</button>
                            </div>
                        </div>

                    </div>

                    <div class="col w-25 h-100 p-l-r-5">

                        <div class="card d-flex w-100 p-3 shadow-sm">
                            <div class="card-img w-100">
                                <img src="../Assets/imgs/imgZapatilla-auto.webp" alt="" class="w-100 h-100">
                            </div>
                            <div class="card-marca">Marca</div>
                            <div class="card-infoZapatillas data-nombre">Barquito</div>
                            <div class="card-precioMasDescuento">
                                <span class="data-precio">$gratis</span>
                                <span>10% off</span>
                            </div>
                            <div class="card-button text-center pt-3">
                                <button class="btn btn-dark p-2 agregarCarrito" id="myButton"
                                    onclick="agregarAlCarrito(this)">Agregar al carrito</button>
                            </div>
                        </div>

                    </div>
                    
                </div>
            </div>
        </section>
        
    </main>

    <script>
        var carrito = [];
        var modales = document.getElementsByClassName('offcanvas-body');

        function sacarDelcarrito(button) {

        var card = button.closest('.card');
        var nombre = card.querySelector('.card-infoZapatillas').textContent.trim();
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
                            <div class="align-self-center">
                                <button type="button" class="btn btn-dark" onclick="sacarDelcarrito(this)">
                                    <i class="bi bi-x"></i>
                                </button>
                            </div>
                        </div>
                        <form method='post' action='../buy/finalizaCompra.php' class="card-compra d-flex flex-row w-100 justify-content-center mr-5 mb-2 pr-1">
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
            var imgSrc = card.querySelector('.card-img img').src;

            let zapatilla = {
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
                console.log(modal);

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
                                <span class="align-self-center fs-6">${item.precio}</span>
                            </div>
                            <div class="d-flex">
                                <span class="align-self-center fs-6">${item.cantidad}unidades</span>
                            </div>
                            <div class="align-self-center">
                                <button type="button" class="btn btn-dark" onclick="sacarDelcarrito(this)">
                                    <i class="bi bi-x"></i>
                                </button>
                            </div>
                        </div>
                        <form method='post' action='../buy/finalizaCompra.php' class="card-compra d-flex flex-row w-100 justify-content-center mr-5 mb-2 pr-1">
                            <button type='submit' name='idproducto' value='' class="btn btn-dark btn-comprar">Pagar</button>
                        </form>
                    `;
                });
            }
        }

    </script>
</body>
</html>
