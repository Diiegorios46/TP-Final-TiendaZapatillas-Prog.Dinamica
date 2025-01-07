if(menu.m == '3'){
    // nuevo PRODUCTO
        
        $('.deposito-menu').html('');
        $('.deposito-title').hide('');
    
        var sourceTitle = document.getElementById('menuDinamico-template').innerHTML;
        var templateTitle = Handlebars.compile(sourceTitle);
        
        $('.container-Tittle-volver').html(templateTitle);
        
        var source = document.getElementById('formAgregarProducto-template').innerHTML;
        var template = Handlebars.compile(source);

        $('.deposito-menu').html(template);
    
        $('#fm').validate({
            rules: {
                pronombre: {    
                    required: true,
                    minlength: 2,
                },
                proprecio: {
                    required: true,
                    number: true
                },
                prodetalle: {
                    required: true,
                    minlength: 5,
                },
                procantstock: {
                    required: true,
                    number: true
                },
                image: {
                    required: true,
                    extension: "jpg|jpeg|png|gif"
                }
            },
            messages: {
                pronombre: {
                    required: "Por favor ingrese el nombre del producto",
                    minlength: "El nombre debe tener al menos 2 caracteres",
                },
                proprecio: {
                    required: "Por favor ingrese el precio del producto",
                    number: "Por favor ingrese un número"
                },
                prodetalle: {
                    required: "Por favor ingrese el detalle del producto",
                    minlength: "El detalle debe tener al menos 5 caracteres"
                },
                procantstock: {
                    required: "Por favor ingrese la cantidad de stock",
                    number: "Por favor ingrese un número"
                },
                image: {
                    required: "Por favor seleccione una imagen",
                    extension: "Por favor seleccione una imagen con extensión jpg, jpeg, png o gif"
                }
            },
            submitHandler: function(form) {
                $.ajax({
                    url: './actionAgregarProducto.php',
                    type: 'POST',
                    data: new FormData(form),
                    processData: false,
                    contentType: false,
                    success: function(result) {
                        console.log(result);
                        try {
                            if (result) {
                                $('#mensajeOperacion').addClass('alert alert-success alert-dismissible fade show text-center').html('Producto agregado exitosamente.');    
                                } else {console.log('Error: ' + result.errorMsg);
                            }
                        } catch (e) {
                            console.log('Error al parsear la respuesta del servidor.');
                        }
                    },
                    error: function(xhr, status, error) {
                        console.log('Error al cargar los datos del menú dinámico.');
                        console.log('Error: ' + error);
                    }
                });
            }
        });
        
    }else if(menu.m == '4'){
        $('.deposito-menu').html('');
        $('.deposito-title').hide('');
    
        var sourceTitle = document.getElementById('titleModificarProducto-template').innerHTML;
        var templateTitle = Handlebars.compile(sourceTitle);
        $('.container-Tittle-volver').html(templateTitle);
    
        Handlebars.registerHelper('json', function(context) {
            return JSON.stringify(context).replace(/"/g, '&quot;');
        });

        $.ajax({
            url: '../pedidos/listarDeposito.php',
            type: 'GET',
            dataType: 'json',
    
            success: function(result) {
            $('.deposito-menu').html(''); 
                console.log(result);
                let grid = $('.grid').html(''); 
                let row;
                var source = document.getElementById('formModificarProducto-template').innerHTML;
                var template = Handlebars.compile(source);

                result.forEach(function(producto ,index) {
                    if (index % 4 === 0) {
                            row = $('<div class="row mt-4 mb-4"></div>');
                            $('.grid').append(row);
                            $('.deposito-menu').html(grid); 
                    }
    
                    let zapatilla = template(producto);
                    row.append(zapatilla);
                });
            },
            error: function(xhr, status, error) {
                console.log('Error al cargar los datos del menú dinámico.');
                console.log('Error: ' + error);
            }
            
        })
    }
    
     function modificarProducto(producto) {
    
            $.ajax({
                url: './actionModificarProducto.php',
                type: 'get',
    
                success: function(response) {
                    $('.grid').html('');

                    Handlebars.registerHelper('marca', function(promarca) {
                        if(promarca === ""){
                            return "";
                        }else{
                            return "selected";
                        }

                    });

                    var source = document.getElementById('modificarTargeta-template').innerHTML;
                    
                    Handlebars.registerHelper('parseInt', function(procantstock) {
                        return parseInt(procantstock , 10);
                    });

                                        
                    Handlebars.registerHelper('parseIntToFixed', function(proprecio) {
                        return parseInt(proprecio, 10).toFixed(2)
                    });


                    var template = Handlebars.compile(source);
                    var InsertarHtml = template(producto);

                    $('.deposito-menu').html(InsertarHtml);
    
                    $('#form').validate({
                        rules: {
                            pronombre: {
                                required: true,
                                minlength: 2,
                            },
                            proprecio: {
                                required: true,
                                number: true,
                                min: 1
                            },
                            prodetalle: {
                                required: true,
                                minlength: 5,
                            },
                            procantstock: {
                                required: true,
                                number: true,
                                min: 1
                            },
                            proimagen1: {
                                extension: "jpg|jpeg|png|gif"
                            }
                        },
                        messages: {
                            pronombre: {
                                required: "Por favor ingrese el nombre del producto",
                                minlength: "El nombre debe tener al menos 2 caracteres",
                            },
                            proprecio: {
                                required: "Por favor ingrese el precio del producto",
                                number: "Por favor ingrese un número",
                                min: "El valor debe ser mayor o igual a 1"
                            },
                            prodetalle: {
                                required: "Por favor ingrese el detalle del producto",
                                minlength: "El detalle debe tener al menos 5 caracteres"
                            },
                            procantstock: {
                                required: "Por favor ingrese la cantidad de stock",
                                number: "Por favor ingrese un número",
                                min: "El valor debe ser mayor o igual a 1"
                            },
                            proimagen1: {
                                extension: "Por favor seleccione una imagen con extensión jpg, jpeg, png o gif"
                            }
                        },
    
                        submitHandler: function(form) {
                            var formData = new FormData();
                            formData.append('idproducto', producto.idproducto);
                            formData.append('pronombre', $('#pronombre').val());
                            formData.append('proprecio', $('#proprecio').val());
                            formData.append('promarca', $('#promarca').val());
                            formData.append('promarca', $('#promarca option:selected').val());
                            formData.append('prodetalle', $('#prodetalle').val());
                            formData.append('procantstock', $('#procantstock').val());
    
                            var fileInput = $('#proimagen1')[0];
                            if (fileInput.files && fileInput.files[0]) {
                                var reader = new FileReader();
                                reader.onload = function(e) {
                                    formData.append('proimagen1', e.target.result);
                                    enviarFormulario(formData);
                                };
                                reader.readAsDataURL(fileInput.files[0]);
                            } else {
                                formData.append('proimagen1', $('#proimagen1-preview').attr('src'));
                                enviarFormulario(formData);
                            }
                        }
                    });
    
    
            function enviarFormulario(formData) {
                $.ajax({
                    url: './actionModificarProducto.php',
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(texto) {
                        console.log(texto);
                    },
                    error: function(xhr, status, error) {
                        console.log('Error: ' + error);
                    }
                });
            }
            },
            error: function(xhr, status, error) {
                console.log('Error: ' + error);
            }
            });
        }
    