<?php
include './estructura/cabecera.php';
include '../../config.php';
echo "<link rel='stylesheet' href='./Assets/style.css'>";


// $session = new Session();
// if($session->validar()){
//     header('Location: ./home/index.php');
// }

?>
<body>
    <main class="container-fluid">
        <section class="container-sm d-flex gap">
            <div class="w-25 min-vh-100 border border-dark ">
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
                <div class="row mt-4 mb-4">
                    <div class="col w-25 h-100">

                        <div class="card d-flex w-100 p-3 shadow-sm ">
                            <div class="card-img w-100">
                                <img src="./Assets/imgs/imgZapatilla-auto.webp" alt="" class="w-100 h-100">
                            </div>
                            <div class="card-marca">Marca</div>
                            <div class="card-infoZapatillas">Nombre zapatilla - Modelo Nombre zapa</div>
                            <div class="card-precioMasDescuento">
                                <span>$999.999,00</span>
                                <span>10% off</span>
                            </div>
                            <div class="card-button text-center pt-3">
                                <button class="btn btn-dark p-2">Agregar al carrito</button>
                            </div>
                        </div>


                    </div>
                    <div class="col w-25 h-100">

                        <div class="card d-flex w-100 p-3 shadow-sm">
                            <div class="card-img w-100">
                                <img src="./Assets/imgs/imgZapatilla-auto.webp" alt="" class="w-100 h-100">
                            </div>
                            <div class="card-marca">Marca</div>
                            <div class="card-infoZapatillas">Nombre zapatilla - Modelo Nombre zapa</div>
                            <div class="card-precioMasDescuento">
                                <span>$999.999,00</span>
                                <span>10% off</span>
                            </div>
                            <div class="card-button text-center pt-3">
                                <button class="btn btn-dark p-2">Agregar al carrito</button>
                            </div>
                        </div>

                    </div>
                    <div class="col w-25 h-100">

                        <div class="card d-flex w-100 p-3 shadow-sm">
                            <div class="card-img w-100">
                                <img src="./Assets/imgs/imgZapatilla-auto.webp" alt="" class="w-100 h-100">
                            </div>
                            <div class="card-marca">Marca</div>
                            <div class="card-infoZapatillas">Nombre zapatilla - Modelo Nombre zapa</div>
                            <div class="card-precioMasDescuento">
                                <span>$999.999,00</span>
                                <span>10% off</span>
                            </div>
                            <div class="card-button text-center pt-3">
                                <button class="btn btn-dark p-2">Agregar al carrito</button>
                            </div>
                        </div>

                    </div>
                    <div class="col w-25 h-100">

                        <div class="card d-flex w-100 p-3 shadow-sm">
                            <div class="card-img w-100">
                                <img src="./Assets/imgs/imgZapatilla-auto.webp" alt="" class="w-100 h-100">
                            </div>
                            <div class="card-marca">Marca</div>
                            <div class="card-infoZapatillas">Nombre zapatilla - Modelo Nombre zapa</div>
                            <div class="card-precioMasDescuento">
                                <span>$999.999,00</span>
                                <span>10% off</span>
                            </div>
                            <div class="card-button text-center pt-3">
                                <button class="btn btn-dark p-2">Agregar al carrito</button>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="row mt-4 mb-4">
                    <div class="col w-25 h-100">

                        <div class="card d-flex w-100 p-3 shadow-sm">
                            <div class="card-img w-100">
                                <img src="./Assets/imgs/imgZapatilla-auto.webp" alt="" class="w-100 h-100">
                            </div>
                            <div class="card-marca">Marca</div>
                            <div class="card-infoZapatillas">Nombre zapatilla - Modelo Nombre zapa</div>
                            <div class="card-precioMasDescuento">
                                <span>$999.999,00</span>
                                <span>10% off</span>
                            </div>
                            <div class="card-button text-center pt-3">
                                <button class="btn btn-dark p-2">Agregar al carrito</button>
                            </div>
                        </div>


                    </div>
                    <div class="col w-25 h-100">

                        <div class="card d-flex w-100 p-3 shadow-sm">
                            <div class="card-img w-100">
                                <img src="./Assets/imgs/imgZapatilla-auto.webp" alt="" class="w-100 h-100">
                            </div>
                            <div class="card-marca">Marca</div>
                            <div class="card-infoZapatillas">Nombre zapatilla - Modelo Nombre zapa</div>
                            <div class="card-precioMasDescuento">
                                <span>$999.999,00</span>
                                <span>10% off</span>
                            </div>
                            <div class="card-button text-center pt-3">
                                <button class="btn btn-dark p-2">Agregar al carrito</button>
                            </div>
                        </div>

                    </div>
                    <div class="col w-25 h-100">

                        <div class="card d-flex w-100 p-3 shadow-sm">
                            <div class="card-img w-100">
                                <img src="./Assets/imgs/imgZapatilla-auto.webp" alt="" class="w-100 h-100">
                            </div>
                            <div class="card-marca">Marca</div>
                            <div class="card-infoZapatillas">Nombre zapatilla - Modelo Nombre zapa</div>
                            <div class="card-precioMasDescuento">
                                <span>$999.999,00</span>
                                <span>10% off</span>
                            </div>
                            <div class="card-button text-center pt-3">
                                <button class="btn btn-dark p-2">Agregar al carrito</button>
                            </div>
                        </div>

                    </div>
                    <div class="col w-25 h-100">

                        <div class="card d-flex w-100 p-3 shadow-sm">
                            <div class="card-img w-100">
                                <img src="./Assets/imgs/imgZapatilla-auto.webp" alt="" class="w-100 h-100">
                            </div>
                            <div class="card-marca">Marca</div>
                            <div class="card-infoZapatillas">Nombre zapatilla - Modelo Nombre zapa</div>
                            <div class="card-precioMasDescuento">
                                <span>$999.999,00</span>
                                <span>10% off</span>
                            </div>
                            <div class="card-button text-center pt-3">
                                <button class="btn btn-dark p-2">Agregar al carrito</button>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="row mt-4 mb-4">
                    <div class="col w-25 h-100">

                        <div class="card d-flex w-100 p-3 shadow-sm">
                            <div class="card-img w-100">
                                <img src="./Assets/imgs/imgZapatilla-auto.webp" alt="" class="w-100 h-100">
                            </div>
                            <div class="card-marca">Marca</div>
                            <div class="card-infoZapatillas">Nombre zapatilla - Modelo Nombre zapa</div>
                            <div class="card-precioMasDescuento">
                                <span>$999.999,00</span>
                                <span>10% off</span>
                            </div>
                            <div class="card-button text-center pt-3">
                                <button class="btn btn-dark p-2">Agregar al carrito</button>
                            </div>
                        </div>


                    </div>
                    <div class="col w-25 h-100">

                        <div class="card d-flex w-100 p-3 shadow-sm">
                            <div class="card-img w-100">
                                <img src="./Assets/imgs/imgZapatilla-auto.webp" alt="" class="w-100 h-100">
                            </div>
                            <div class="card-marca">Marca</div>
                            <div class="card-infoZapatillas">Nombre zapatilla - Modelo Nombre zapa</div>
                            <div class="card-precioMasDescuento">
                                <span>$999.999,00</span>
                                <span>10% off</span>
                            </div>
                            <div class="card-button text-center pt-3">
                                <button class="btn btn-dark p-2">Agregar al carrito</button>
                            </div>
                        </div>

                    </div>
                    <div class="col w-25 h-100">

                        <div class="card d-flex w-100 p-3 shadow-sm">
                            <div class="card-img w-100">
                                <img src="./Assets/imgs/imgZapatilla-auto.webp" alt="" class="w-100 h-100">
                            </div>
                            <div class="card-marca">Marca</div>
                            <div class="card-infoZapatillas">Nombre zapatilla - Modelo Nombre zapa</div>
                            <div class="card-precioMasDescuento">
                                <span>$999.999,00</span>
                                <span>10% off</span>
                            </div>
                            <div class="card-button text-center pt-3">
                                <button class="btn btn-dark p-2">Agregar al carrito</button>
                            </div>
                        </div>

                    </div>
                    <div class="col w-25 h-100">

                        <div class="card d-flex w-100 p-3 shadow-sm">
                            <div class="card-img w-100">
                                <img src="./Assets/imgs/imgZapatilla-auto.webp" alt="" class="w-100 h-100">
                            </div>
                            <div class="card-marca">Marca</div>
                            <div class="card-infoZapatillas">Nombre zapatilla - Modelo Nombre zapa</div>
                            <div class="card-precioMasDescuento">
                                <span>$999.999,00</span>
                                <span>10% off</span>
                            </div>
                            <div class="card-button text-center pt-3">
                                <button class="btn btn-dark p-2">Agregar al carrito</button>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="row mt-4 mb-4">
                    <div class="col w-25 h-100">

                        <div class="card d-flex w-100 p-3 shadow-sm">
                            <div class="card-img w-100">
                                <img src="./Assets/imgs/imgZapatilla-auto.webp" alt="" class="w-100 h-100">
                            </div>
                            <div class="card-marca">Marca</div>
                            <div class="card-infoZapatillas">Nombre zapatilla - Modelo Nombre zapa</div>
                            <div class="card-precioMasDescuento">
                                <span>$999.999,00</span>
                                <span>10% off</span>
                            </div>
                            <div class="card-button text-center pt-3">
                                <button class="btn btn-dark p-2">Agregar al carrito</button>
                            </div>
                        </div>


                    </div>
                    <div class="col w-25 h-100">

                        <div class="card d-flex w-100 p-3 shadow-sm">
                            <div class="card-img w-100">
                                <img src="./Assets/imgs/imgZapatilla-auto.webp" alt="" class="w-100 h-100">
                            </div>
                            <div class="card-marca">Marca</div>
                            <div class="card-infoZapatillas">Nombre zapatilla - Modelo Nombre zapa</div>
                            <div class="card-precioMasDescuento">
                                <span>$999.999,00</span>
                                <span>10% off</span>
                            </div>
                            <div class="card-button text-center pt-3">
                                <button class="btn btn-dark p-2">Agregar al carrito</button>
                            </div>
                        </div>

                    </div>
                    <div class="col w-25 h-100">

                        <div class="card d-flex w-100 p-3 shadow-sm">
                            <div class="card-img w-100">
                                <img src="./Assets/imgs/imgZapatilla-auto.webp" alt="" class="w-100 h-100">
                            </div>
                            <div class="card-marca">Marca</div>
                            <div class="card-infoZapatillas">Nombre zapatilla - Modelo Nombre zapa</div>
                            <div class="card-precioMasDescuento">
                                <span>$999.999,00</span>
                                <span>10% off</span>
                            </div>
                            <div class="card-button text-center pt-3">
                                <button class="btn btn-dark p-2">Agregar al carrito</button>
                            </div>
                        </div>

                    </div>
                    <div class="col w-25 h-100">

                        <div class="card d-flex w-100 p-3 shadow-sm">
                            <div class="card-img w-100">
                                <img src="./Assets/imgs/imgZapatilla-auto.webp" alt="" class="w-100 h-100">
                            </div>
                            <div class="card-marca">Marca</div>
                            <div class="card-infoZapatillas">Nombre zapatilla - Modelo Nombre zapa</div>
                            <div class="card-precioMasDescuento">
                                <span>$999.999,00</span>
                                <span>10% off</span>
                            </div>
                            <div class="card-button text-center pt-3">
                                <button class="btn btn-dark p-2">Agregar al carrito</button>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </section>
    </main>
</body>
</html>
