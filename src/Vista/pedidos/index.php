<?php 
    include '../estructura/cabeceraSegura.php';
?>

<div id='mensajeOperacion'></div>

<div class="container-sm min-vh-100">  
    <h1 class="deposito-title pt-4">Menu</h1>
    <div class="container-Tittle-volver mt-5 mb-5"></div>

    <div class="deposito-menu" id="menuDinamico">
        <!--viene el codigo de jquery-->
    </div>
    <div class="grid">
        <!-- codigo jquery -->
    </div>

</div>

<script id="templateMenu" type="text/template">           
    <div class="container-configuracionText mt-3" >
        <span>{{titulo}}</span>
        <div class="btn-volver-configuracion" data-url="../menu/index.php">
            <i class="bi bi-gear w-100 text-dark"></i>
            <span>Volver</span>
        </div>
    </div>
</script>

<script id="templatePedido" type="text/template">
    <div class="col-md-3 col-sm-6 mb-3 evalua w-25 p-3" id="card-Pedidos">  
        <div class="d-flex flex-column ">
        <div class="text-center p-1">Pedido numero: {{idcompraitem}}</div>
        <div class="text-center p-1">Id de la Compra: {{idcompra}}</div>
        <div class="text-center p-1">Id del Producto: {{idproducto}}</div>
    </div>

    <div class="d-flex flex-row justify-content-center gap">
        <button class="btn btn-success m-1" onclick="verCompra({{idcompra}})">Ver Compra</button>
    </div>
        
    </div>
</script>

<script id="templateCompra" type="text/template">
    <div class="card mb-3 shadow-lg">
        <div class="card-body">
            <h5 class="card-title text-center">Detalles de la Compra</h5>
            <div id="contenido-compra">
                <!-- Aquí se insertarán los detalles de los pedidos -->
            </div>
            <div class="d-flex justify-content-center gap-2 mt-3">
                <button class="btn btn-success" onclick="evaluar({{idcompraParm}}, 1)">Aceptar</button>
                <button class="btn btn-danger" onclick="evaluar({{idcompraParm}}, 0)">Cancelar</button>
            </div>
        </div>
    </div>
</script>

<script id="templateDetalleCompra" type="text/template">
    <div class="mb-2">
        <p class="mb-1"><strong>Pedido número:</strong> {{idcompraitem}}</p>
        <p class="mb-1"><strong>Id de la Compra:</strong> {{idcompra}}</p>
        <p class="mb-1"><strong>Id del Producto:</strong> {{idproducto}}</p>
        <hr>
    </div>
</script>


<script src="../Assets/pedidos.js?v=<?php echo time();?>"></script>