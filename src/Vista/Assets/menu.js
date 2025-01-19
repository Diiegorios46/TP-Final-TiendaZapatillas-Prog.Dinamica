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
                $('.deposito-menu').append(
                    `<div class="opcionesMenu">
                        <div>
                            <a href="${descripcion.descripcion}" class="text-align" >${descripcion.nombre} </a>
                        </div>
                    </div>
                `);
            });

            document.querySelectorAll('.opcionesMenu').forEach(div => {
                div.addEventListener('click', () => {
                    const link = div.querySelector('a');
                    if (link) {
                        window.location.href = link.href;
                    }
                });
            });
            
            $('.deposito-menu').addClass('justify-content-around');
            $('.deposito-menu').addClass('flex-column');
        },
        error: function(xhr, status, error) {
            console.log('Error al c´argar los datos.');
        }
    });
});