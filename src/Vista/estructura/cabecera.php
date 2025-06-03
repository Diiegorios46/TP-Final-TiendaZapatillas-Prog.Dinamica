<?php
include '../../../config.php';
?>
<!DOCTYPE html>
<html lang="es">
    
<head>
    <title></title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>  
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.21.0/jquery.validate.min.js" integrity="sha512-KFHXdr2oObHKI9w4Hv1XPKc898mE4kgYx58oqsc/JqqdLMDI4YjOLzom+EMlW8HFUd0QfjfAvxSL6sEq/a42fQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.21.0/additional-methods.min.js" integrity="sha512-owaCKNpctt4R4oShUTTraMPFKQWG9UdWTtG6GRzBjFV4VypcFi6+M3yc4Jk85s3ioQmkYWJbUl1b2b2r41RTjA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/handlebars.js/4.7.7/handlebars.min.js"></script>

    <!-- CSS + BOOSTRAP -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.2/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../Assets/style.css?v=<?php echo time();?>">
    <!-- CSS -->

</head>

<header class="container-fluid m-0 p-0">
        <nav class="container-fluid fs-3 bg-naranja p-4">
            <div class="container-full d-flex justify-content-between">
                <div class="w100-h55">
                    <a href="../../../../TP-Final-TiendaZapatillas-Prog.Dinamica/index.php"><img src="../Assets/imgs/th.jpg" alt="" class="h-100 w-100 objet-fit rounded"></a>
                </div>
                <div class="d-flex w-10 gap justify-content-end" id="icono-login-tienda">

                    <div class="dropdown">
                        <i class="bi bi-person-circle dropdown-toggle icono-persona text-light" id="dropdownMenuButton"style="font-size: 2rem;" data-bs-toggle="dropdown" aria-expanded="false"></i>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="../login/index.php">Iniciar Sesion</a></li>
                            <li><a class="dropdown-item" href="../register/index.php">Registrate</a></li>
                        </ul>
                    </div>

                    <div class="w-h">
                        <i class="bi bi-cart text-light" style="font-size: 2rem;" class="w100-h55" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"></i>

                        <div class="w-40 offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
                            <div class="offcanvas-header">
                                <h5 class="offcanvas-title" id="offcanvasRightLabel">Carrito</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="offcanvas"
                                    aria-label="Close"></button>
                            </div>

                            <div class="offcanvas-body">
                                <div class="card-compra d-flex flex-row w-100 justify-content-center mr-5 mb-2 pr-1">
                                    <button class="btn btn-dark btn-comprar">Pagar</button>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </nav>
    </header>