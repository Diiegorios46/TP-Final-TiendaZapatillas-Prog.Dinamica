<?php  include  '../estructura/cabeceraSegura.php' 


/* ---------------------------------------------------------------------*/
/*** AJAX NO ANDA CASI QUEDO viene de -> (actionMenu.php) */
/* ---------------------------------------------------------------------*/
/* ---------------------------------------------------------------------*/
/* ---------------------------------------------------------------------*/
/* ---------------------------------------------------------------------*/

?>


<div class="container-sm">  
        <h1 class="deposito-title">Menu</h1>
        <div class="deposito-menu"><!--viene el codigo de jquery--></div>
</div>


<script>
$(document).ready(function() {
    function mostrarMenues() {
        $.ajax({
            url: 'actionMenu.php',
            type: 'GET',
            dataType: 'json',
            success: function(response) {
                $('.deposito-menu').html('');
                if (response.error) {
                    $('.deposito-menu').html('Error al cargar los datos.');
                } else {
                    response.forEach(menu => {
                        console.log(menu); // Asegúrate de que estás recibiendo los datos correctos
                        let menuHtml = `
                            <a href="#" class="deposito-link-agregar">
                                <button type="button" class="deposito-btn-subir-producto">${menu}</button>
                            </a>`;
                        $('.deposito-menu').append(menuHtml);
                    });
                }
            },
            error: function(xhr, status, error) {
                console.error('Error en la solicitud AJAX:', status, error);
                $('.deposito-menu').html('Error al cargar los datos.');
                console.log(xhr.responseText); // Mostrar el contenido de la respuesta en caso de error
            }
        });
    }
    mostrarMenues();
});
</script>