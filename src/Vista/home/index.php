<?php include '../estructura/cabecera.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <title>Home</title>
</head>

<body>
    <main class="container-fluid">
    <section class="container-sm d-flex gap">
        <div class="w-25 min-vh-100 border border-dark "></div>
    
    <div class="w-75 justify-content-center align-content-start">
        <div class="row mt-4 mb-4">
            
            <div class="col w-25 h-100" id="prueba">

                <button id="btn" onclick="mostrarProductos()">Mostrar Productos</button>
                <script>
                    function mostrarProductos() {
                        $.ajax({
                            url: 'action.php',
                            type: 'GET',
                            dataType: 'json', // Asegúrate de que la respuesta se trate como JSON
                            beforeSend: function () {
                                $('#prueba').html('Cargando...');
                            },
                            success: function (response) {
                                $('#prueba').html('');
                                console.log(response[0]);
                                response.forEach(producto => {
                                    let zapatilla =
                                    `<div class="card d-flex w-100 p-3 shadow-sm ">
                                        <div class="card-img w-100">
                                            <img src="${producto.proimagen1}" alt="" class="w-100 h-100 img-card">
                                        </div>
                                        <div class="card-marca">${producto.promarca}</div>
                                        <div class="card-infoZapatillas data-nombre">${producto.pronombre}</div>
                                        <div class="card-precioMasDescuento">
                                            <span class="data-precio">${producto.proprecio}</span>
                                            <span>10% off</span>
                                        </div>
                                        <div class="card-button text-center pt-3">
                                            <button class="btn btn-dark p-2 agregarCarrito" id="myButton"
                                                onclick="agregarAlCarrito(this)">Agregar al carrito</button>
                                        </div>
                                    </div>`;
                                    $('#prueba').append(zapatilla);
                                });
                                $('#prueba').append('Productos cargados correctamente.');
                            },
                            error: function (xhr, status, error) {
                                console.error('Error en la solicitud AJAX:', status, error);
                                $('#prueba').html('Error al cargar los datos.');
                            }
                        });
                    }
                </script>
            </div>
        </div>
    </div>
</section>
    </main>
</body>

</html>