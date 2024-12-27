    <?php include '../estructura/cabeceraSegura.php';?>


    <script>
        $(document).ready(function() {
            $.ajax({
                url: './action.php',
                type: 'GET',
                dataType: 'json',
                success: function(response) {
                    console.log(response);
                    
                    let menu = response.map(item => ({
                        descripcion: item.medescripcion,
                        nombre: item.menombre
                    }));

                    $('.deposito-menu').html('');
                    
                    menu.forEach(descripcion => {
                        $('.deposito-menu').append(`<a href="${descripcion.descripcion}"><button class="btn btn-outline-primary">${descripcion.nombre}</button></a>`);
                    });
                    $('.deposito-menu').addClass('justify-content-start');
                    $('.deposito-menu').addClass('flex-column');
                },
                error: function(xhr, status, error) {
                    console.log('Error al cargar los datos.');
                }
            });
        });
    </script>

    

    <div class="container-sm min-vh-100">  

        <div id='mensajeOperacion'></div>

        <h1 class="deposito-title pt-4">Menu</h1>
        
        <div class="deposito-menu" id="menuDinamico">
            <!--viene el codigo de jquery-->
        </div>
        <div class="grid"></div>
        
    </div>