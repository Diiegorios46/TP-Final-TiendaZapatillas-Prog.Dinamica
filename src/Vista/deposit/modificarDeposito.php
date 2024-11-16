<?php
include '../../../config.php';
header('Content-Type: application/json');
$abmProducto = new abmProducto();
$listaProductos = $abmProducto->obtenerDatos(null);


echo json_encode($listaProductos);
// $card = ""; // Inicializar la variable

// // Añadir contenedor de fila
// $card .= "<div class='row mt-4 mb-4'>";

// foreach ($listaProductos as $i => $producto) {
//     // Comienza una nueva fila si el índice es múltiplo de 4 y no es el primer elemento
//     if ($i % 4 == 0 && $i != 0) {
//         $card .= "</div><div class='row mt-4 mb-4'>";
//     }
    
//     $id = $_SESSION["idproducto"] = $producto["idproducto"];
//     $card .= "<div class='col-3'>
//                 <div class='card d-flex w-100 h-100 p-3 shadow-sm'>
//                     <div class='card-img w-100'>
//                         <img src='{$producto['proimagen1']}' alt='Producto' class='img-fluid w-100 h-100'>
//                     </div>
//                     <div class='card-marca'>Marca: {$producto['promarca']}</div>
//                     <div class='card-infoZapatillas data-nombre'>Producto: {$producto['pronombre']}</div>
//                     <div class='card-precioMasDescuento'>
//                         <span class='data-precio'>\${$producto['proprecio']}</span>
//                         <span>10% off</span>
//                     </div>
//                     <div class='card-button text-center pt-3'>
//                         <form method='post' action='./modificarAction.php'>
//                             <button type='submit' name='idproducto' value='{$id}'>Modificar</button>
//                         </form>
//                     </div>
//                 </div>
//               </div>";
// }

// // Cerrar cualquier fila abierta
// if ($i % 4 != 0) {
//     $card .= "</div>";
// }
// ?>
