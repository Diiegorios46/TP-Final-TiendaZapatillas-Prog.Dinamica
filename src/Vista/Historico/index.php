<?php
include '../estructura/cabeceraSegura.php';
?>

<div id='mensajeOperacion'></div>


<div class="container-sm min-vh-100">
    
<div class="container-Tittle-volver mt-5"></div>
<div id="contenido"></div>

</div>



<script id="titleModificarProducto-template" type="text/x-handlebars-template">
           
           <div class="container-configuracionText mt-5 mb-5" >
               <span>{{titulo}}</span>
               <div class="btn-volver-configuracion" data-url="../menu/index.php">
                   <i class="bi bi-gear w-100 text-dark"></i>
                   <span>Volver</span>
               </div>
           </div>

       </div>
   </script>

<script id="template-card" type="text/x-handlebars-template">
    <div class="col">
        <div class="card shadow-lg rounded border">
            <div class="card-body">
                <h5 class="card-title text-dark font-bold">Numero de compra: {{idcompra}}</h5>
                <h6 class="card-subtitle mb-2 text-muted">ID producto: {{idproducto}}</h6>
                <p class="card-text">Cantidad comprada: {{cicantidad}}</p>
                <div class="text-center">
                    <button class="btn btn-warning mt-2" onclick="traerHistorico({{idcompra}})">Ver Historico</button>
                </div>
            </div>
        </div>
    </div>
</script>


<script id="template-InformacionCompras" type="text/x-handlebars-template">
    <div class="container-sm d-flex w-75">
        <div class="d-flex w-5">   
                <a href="../menu/index.php" class="d-flex align-content-center">
                <div class="w-100"><img src="../Assets/imgs/volver.png" alt="" class="h-100 w-100 p-1 rounded-circle"></div> 
                </a>
        </div>
        <div class="w-100 d-flex justify-content-center">
            <h1>Informacion de las compras</h1>
        </div>
    </div>
</script>


<script id="template-CardInformacionCompra" type="text/x-handlebars-template">
    <div class="col-12 col-md-6 col-lg-3 d-flex justify-content-center">
        <div class="card mb-4 shadow-sm" style="width: 18rem;">
            <div class="card-body">
                <div class="card-title font-bold">Numero de compra: {{idcompra}}</div>
                <div class="card-subtitle mb-2 text-muted">Inicio: {{cefechaini}}</div>
                <p class="card-text">Terminó: {{cefechafin}}</p>
                <p class="card-subtitle mb-2"> Estado de la compra: 
                    <span class="badge rounded px-3 py-2 {{clasecolor idcompraestadotipo}}">
                        {{estadocompra idcompraestadotipo}}
                    </span>
                </p>
            </div>
        </div>
    </div>
</script>

<script src="../Assets/historico.js?v=<?php echo time();?>"></script>