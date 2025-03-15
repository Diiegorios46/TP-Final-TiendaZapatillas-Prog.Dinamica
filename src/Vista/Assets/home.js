$(document).ready(function () {
    mostrarProductos();
});


// Agregar sacar del carrito que lo contabilice

var carrito = [];
var modales = document.getElementsByClassName('offcanvas-body');
var contadorProductos = 0;

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
            console.log("Respuesta en bruto de PHP:", response);
        
            try {
                response = JSON.parse(response);
                console.log("JSON Parseado:", response);
            } catch (e) {
                console.error("Error al parsear JSON:", e, "Respuesta recibida:", response);
                return;
            }
        
            console.log("Esto viene de la base de datos:", response);
        
            $('#prueba').html('');
            var sourceCard = document.getElementById('template-card-zapatillas').innerHTML;
            var templateCard = Handlebars.compile(sourceCard);
            let row;
        
            if (response.length === 0) {
                $('#prueba').html('<div class="alert alert-warning" role="alert">No hay productos disponibles.</div>');
                return;
            }
        
            response.forEach((producto, index) => {
                if (index % 4 === 0) {
                    row = $('<div class="row mt-4"></div>');
                    $('#prueba').append(row);
                }
        
                let zapatilla = templateCard(producto);
                row.append(zapatilla);
            });
        }
        
    });
}




function sacarDelcarrito(button) {
    var card = button.closest('.card');
    var nombre = card.querySelector('.nombre-zapatilla').textContent.trim();
    var id = card.querySelector('.hidden')?.textContent.trim();
    let modal = modales[0];
    modal.innerHTML = "";

    let IndiceProductoEliminar = carrito.findIndex(producto =>
        (id && producto.id === id) || producto.nombre === nombre);

    if (IndiceProductoEliminar !== -1) {
        carrito.splice(IndiceProductoEliminar, 1);

        borrarContadorProductos();

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


function sumarUnProductoAlContador(){
    contadorProductos++;
    $('.numItems').removeClass('d-none');
    $('.numItems').addClass('d-block');
    $('.numItems').html(contadorProductos);
}


function borrarContadorProductos(){
    if(carrito.length > 0){
        $('.numItems').html(contadorProductos--);
    }else{
        $('.numItems').addClass('d-none');
        contadorProductos = carrito.length;
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
    sumarUnProductoAlContador();
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
        modal.innerHTML = ''; // Limpiar contenido actual

        // Obtén la plantilla del modal
        let source = document.getElementById('modal-template').innerHTML;

        let template = Handlebars.compile(source);

        // Llena la plantilla con los datos del carrito
        let context = { carrito: carrito };
        let html = template(context);

        // Inserta el HTML generado en el modal
        modal.innerHTML = html;
    }
}
