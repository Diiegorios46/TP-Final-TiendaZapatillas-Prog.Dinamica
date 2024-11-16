<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="https://www.jeasyui.com/easyui/themes/default/easyui.css">
    <link rel="stylesheet" type="text/css" href="https://www.jeasyui.com/easyui/themes/icon.css">
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script type="text/javascript" src="https://www.jeasyui.com/easyui/jquery.easyui.min.js"></script>
</head>
<body>
    <?php include '../estructura/cabeceraSegura.php' ?>

    <div class="container-sm">  
        <h1 class="deposito-title">Menu</h1>
        <div class="deposito-menu" id="menuDinamico">
            <!--viene el codigo de jquery-->
        </div>
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
                            var i = 1;
                            response.forEach(menu => {
                                let menuHtml = `<button type="button" class="deposito-btn-subir-producto" onclick="obtenerMenu(${i})">${menu}</button>`;
                                $('.deposito-menu').append(menuHtml);
                                i++;
                            });
                        }
                    },
                    error: function(xhr, status, error) {
                        console.log('Error al cargar los datos.');
                    }
                });
            }

            mostrarMenues();
        });

        window.obtenerMenu = function(indice) {
            var url;
            switch(indice) {
                case 1:
                    url = 'url_1.php';
                    break;
                case 2:
                    url = './agregarAction.php';
                    $('.deposito-menu').html(`
                        <form class="upload-form" id="fm" novalidate method="post">
                            <div class="form-group">
                                <label for="pronombre" class="form-label">Nombre del producto</label>
                                <input type="text" name="pronombre" id="pronombre" class="form-input" required>
                            </div>
                            <div class="form-group">
                                <label for="proprecio" class="form-label">Precio del producto</label>
                                <input type="number" name="proprecio" id="proprecio" class="form-input" required>
                            </div>
                            <div class="form-group">
                                <label for="promarca" class="form-label">Marca del producto</label>
                                <select name="promarca" id="promarca" class="form-select" required>
                                    <option value="nike">Nike</option>
                                    <option value="adidas">Adidas</option>
                                    <option value="vans">Vans</option>
                                    <option value="dc">DC</option>
                                    <option value="topper">Topper</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="prodetalle" class="form-label">Detalle del producto</label>
                                <input type="text" name="prodetalle" id="prodetalle" class="form-input" required>
                            </div>
                            <div class="form-group">
                                <label for="procantstock" class="form-label">Cantidad de stock</label>
                                <input type="number" name="procantstock" id="procantstock" class="form-input" required>
                            </div>
                            <div class="form-group">
                                <label for="image" class="form-label">Choose image(s) to upload:</label>
                                <input type="file" name="image[]" id="image" class="form-file" multiple required>
                            </div>
                            <input type="submit" value="Subir imagen" name="submit" class="form-submit">
                        </form>`);
                    $('#fm').form({
                        url: url,
                        dataType: 'json',
                        onSubmit: function() {
                            console.log('Enviando datos al servidor...');
                            return $(this).form('validate');
                        },
                        success: function(result) {
                            try {
                                var result = JSON.parse(result);
                                if (!result.respuesta) {
                                    $.messager.show({
                                        title: 'Error',
                                        msg: result.errorMsg
                                    });
                                } else {
                                    console.log('PERFECTO');
                                }
                            } catch (e) {
                                console.log('Error al parsear la respuesta del servidor.');
                            }
                        },
                        error: function(xhr, status, error) {
                            console.log('Error al cargar los datos del menú dinámico.');
                        }
                    });
                    break;
                case 3:
                    url = 'url_3.php';
                    break;
                case 4:
                    url = 'url_4.php';
                    break;
                case 5:
                    url = 'url_5.php';
                    break;
                case 6:
                    url = 'url_6.php';
                    break;
                case 7:
                    url = 'url_7.php';
                    break;
                default:
                    console.log('Índice fuera de rango: ' + indice);
                    return;
            }
        }
    </script>
</body>
</html>