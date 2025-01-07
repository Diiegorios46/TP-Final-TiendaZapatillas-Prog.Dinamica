$(document).ready(function () {
    mostrarProductos();
});

var carrito = [];
var modales = document.getElementsByClassName('offcanvas-body');

function mostrarProductos() {
    $.ajax({
        url: 'action.php',
        type: 'post',
        data: {
            price: $('input[name="price"]:checked').val(),
            priceMarca: $('input[name="priceMarca"]:checked').val()
        },
        beforeSend: function () {
            console.log('Cargando datos...');
            $('#prueba').html('Cargando...');
        },
        success: function (response) {

            response = JSON.parse(response);
            $('#prueba').html('');
            var sourceCard = document.getElementById('template-card-zapatillas').innerHTML;
            var templateCard = Handlebars.compile(sourceCard);
            let row ;

            if (response.length === 0) {
                $('#prueba').html('<div class="alert alert-warning" role="alert">No hay productos disponibles.</div>');
                return;
            }
            
            response.forEach((producto, index) => {
                if (index % 4 === 0) {
                    row = $('<div class="row mt-4 mb-4"></div>');
                    $('#prueba').append(row);
                }

                let zapatilla = templateCard(producto);
                row.append(zapatilla);
            });

        },

        error: function (xhr, status, error) {
            console.error('Error en la solicitud AJAX:', status, error);
            $('#prueba').html('Error al cargar los datos.');
        }
    });
}

function sacarDelcarrito(button) {
    var card = button.closest('.card');
    var nombre = card.querySelector('.nombre-zapatilla').textContent.trim();
    var id = card.querySelector('.hidden')?.textContent.trim();

    let productEliminar = carrito.findIndex(producto =>
        (id && producto.id === id) || producto.nombre === nombre);

    if (productEliminar !== -1) {
        carrito.splice(productEliminar, 1);

        let modal = modales[0];
        modal.innerHTML = "";

        var sourceCard = document.getElementById('template-carrito').innerHTML;
        var templateCard = Handlebars.compile(sourceCard);

        if (carrito.length > 0) {
            carrito.forEach(item => {
                let rowZapatilla = templateCard(item);
                modal.innerHTML += rowZapatilla;
                
                modal.innerHTML += `
                    <form method='post' action='../buy/inicioCompra.php' class="card-compra d-flex flex-row w-100 justify-content-center mr-5 mb-2 pr-1">
                        ${carrito.map((item, index) => `
                            <input type='hidden' name='productos[${index}][idproducto]' value='${item.id}'>
                            <input type='hidden' name='productos[${index}][nombre]' value='${item.nombre}'>
                            <input type='hidden' name='productos[${index}][precio]' value='${item.precio}'>
                            <input type='hidden' name='productos[${index}][cantidad]' value='${item.cantidad}'>
                            <input type='hidden' name='productos[${index}][img]' value='${item.img}'>`).join('')}
                        <button type='submit' class="btn btn-dark btn-comprar">Pagar</button>
                    </form>`;
            });
        } else {
            modal.innerHTML = "<p>El carrito esta vacio</p>";
        }
    } else {
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
        id: id,
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
                </form>`;
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
            </form>`;
    }
}