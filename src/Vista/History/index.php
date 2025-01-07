
<?php include '../estructura/cabeceraSegura.php' ?>

<div id="divHistorial" class="container-sm mt-5"></div>


<script id="template-cardHistory" type="text/x-handlebars-template">
    <div class="col-md-3 col-sm-6 mb-3 shadow rounded w-25">
        <div class="d-flex flex-column ">
            <div class="text-left"><strong>Estado de compra: </strong>
                <span class="{{estadoClase nombreEstado}}">{{nombreEstado}}</span>
            </div>
            <div class="text-left">
                <strong>Número de compra: </strong>{{idcompra}}
            </div>
            <div class="text-left">
                <strong>Fecha de inicio: </strong> {{cefechaini}}
            </div>
            <div class="text-left">
                <strong>Fecha de la finalizacion:</strong>{{cefechafin}}
            </div>
        </div>
    </div>
</script>

<script src="../Assets/history.js"></script>

