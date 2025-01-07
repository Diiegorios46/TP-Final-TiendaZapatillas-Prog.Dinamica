<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Otras etiquetas meta, título, y enlaces a hojas de estilo -->
    <script src="https://cdn.jsdelivr.net/npm/handlebars@latest/dist/handlebars.min.js"></script>
</head>
<body>
    <?php include '../estructura/cabeceraSegura.php';
    $datos = data_submitted(); 
    ?>

    <div class="container-sm min-vh-100">  
        <div class="container-Tittle-volver mt-5"></div>
        <div id='mensajeOperacion'></div>
        <h1 class="deposito-title pt-4">Menu Productos</h1>
        <div class="deposito-menu" id="menuDinamico">
            <!--viene el codigo de jquery-->
        </div>
        <div class="grid w-100"></div>
    </div>

    <script>
        var menu = <?php echo json_encode($datos);?>;
    </script>

    
<script id="menuDinamico-template" type="text/x-handlebars-template">
        <div class="container-sm d-flex w-75">
            <div class="d-flex w-5">   
                <a href="../menu/index.php" class="d-flex align-content-center">
                    <div class="w-100">
                        <img src="../Assets/imgs/volver.png" alt="" class="h-100 w-100 p-1 rounded-circle"/>
                    </div> 
                </a>
            </div>
            <div class="w-100 d-flex justify-content-center">
                <h1>Agregar un Nuevo Producto</h1>
            </div>
        </div>
    </script>

    
    <script id="formAgregarProducto-template" type="text/x-handlebars-template">
        <form class="formAgregarProducto rounded shadow" id="fm" novalidate method="post">
            <div class="form-group inputForm m-2">
                <label for="pronombre" class="form-label">Nombre del producto</label>
                <input type="text" name="pronombre" id="pronombre" class="form-input inputForm" placeholder="ej: Iforce" required />
            </div>
            <div class="form-group m-2">
                <label for="proprecio" class="form-label">Precio del producto</label>
                <input type="number" name="proprecio" id="proprecio" class="form-input inputForm" placeholder="ej: $1500" required />
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
                <input type="text" name="prodetalle" id="prodetalle" class="form-input inputForm" placeholder="ej: Son un excelente producto para hacer deporte" required />
            </div>
            <div class="form-group m-2">
                <label for="procantstock" class="form-label">Cantidad de stock</label>
                <input type="number" name="procantstock" id="procantstock" class="form-input inputForm" placeholder="ej: 100" required />
            </div>
            <div class="form-group m-2">
                <label for="image" class="form-label">Elegi una imagen para el producto:</label>
                <input type="file" name="image[]" id="image" class="form-file" multiple required />
            </div>
            <div class="text-center">
                <input type="submit" value="Subir Producto" name="submit" class="btn-verde mt-4" />
            </div>
        </form>
    </script>

    
    <script id="titleModificarProducto-template" type="text/x-handlebars-template">
        <div class="container-sm d-flex w-75">
            <div class="d-flex w-5">   
                <a href="../menu/index.php" class="d-flex align-content-center">
                    <div class="w-100"><img src="../Assets/imgs/volver.png" alt="" class="h-100 w-100 p-1 rounded-circle"></div> 
                </a>
            </div>
            <div class="w-100 d-flex justify-content-center">
                <h1>Modificar un Producto</h1>
            </div>
        </div>
    </script>


    <script id="formModificarProducto-template" type="text/x-handlebars-template">
        <div class="col-3">
            <div class="card d-flex w-100 h-100 p-3 shadow">
                <div class="card-img w-100">
                    <img src="{{proimagen1}}" alt="" class="w-100 h-100 img-card"/>
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
                    <button class="btn btn-dark p-2 agregarCarrito" id="myButton" onclick="modificarProducto({{{json this}}})">Modificar Producto</button>
                </div>
            </div>
        </div>
    </script>

    <script id="modificarTargeta-template" type="text/x-handlebars-template">
        <form class="upload-form" id="form" novalidate method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="pronombre" class="form-label">Nombre del producto</label>
                <input type="text" name="pronombre" id="pronombre" class="form-input" value="{{pronombre}}" required>
            </div>
            <div class="form-group">
                <label for="proprecio" class="form-label">Precio del producto</label>
                <input type="number" name="proprecio" id="proprecio" class="form-input" value="{{{parseIntToFixed proprecio}}}" required>
            </div>
            <div class="form-group">
                <label for="promarca" class="form-label">Marca del producto</label>
                <select name="promarca" id="promarca" class="form-select" required>
                    <option value="nike" {{{marca promarca}}}> Nike </option>
                    <option value="adidas" {{{marca promarca}}}> Adidas</option>
                    <option value="vans" {{{marca promarca}}}> Vans </option>
                    <option value="topper" {{{marca promarca}}}>Topper</option>
                </select>
            </div>
            <div class="form-group">
                <label for="prodetalle" class="form-label">Detalle del producto</label>
                <input type="text" name="prodetalle" id="prodetalle" class="form-input" value="{{prodetalle}}" required />
            </div>
            <div class="form-group">
                <label for="procantstock" class="form-label">Cantidad de stock</label>
                <input type="number" name="procantstock" id="procantstock" class="form-input" value="{{{parseInt procantstock}}}" required/>
            </div>
            <div class="form-group">
                <label for="proimagen1" class="form-label">Seleccione la imagen para cambiar:</label>
                <div class="form-group w-50">
                    <img src="{{proimagen1}}" class="w-100 h-100" id="proimagen1-preview"/>
                </div>
                <input type="file" name="proimagen1" id="proimagen1" class="form-file"/>
            </div>
            <input type="submit" value="Cambiar producto" name="submit" class="form-submit" required/>
        </form>
    </script>

    <script src="../Assets/productos.js"></script>
</body>
</html>