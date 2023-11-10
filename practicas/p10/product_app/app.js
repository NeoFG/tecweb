$(document).ready(function () {
    $('#product-result').hide();//Ocultar el product-result
    listarProductos();//Cargar todos los productos existentes
    let edit = false;
    let error = false;//Se inicia el formulario sin errores
    //Funcion para listar los productos existentes
    function listarProductos() {
        $.ajax({
            url: './backend/product-list.php',
            type: 'GET',
            success: function (response) {
                let productos = JSON.parse(response);
                let template = '';
                productos.forEach(producto => {
                    template += `
                <tr productId="${producto.id}">
                    <td>${producto.id}</td>
                    <td><a href="#" class="product-item">${producto.nombre}</a></td>
                    <td>
                    <li>Precio: $${producto.precio}</li>
                    <li>Marca: ${producto.marca}</li>
                    <li>Modelo: ${producto.modelo}</li>
                    <li>Unidades: ${producto.unidades}</li>
                    <li>Detalles: ${producto.detalles}</li>
                    </td>
                    <td>
                    <button class="product-delete btn btn-danger">Eliminar</button>
                    </td>
                </tr>
                `
                });
                $('#products').html(template);
            }
        });
    }

    //Funcion para buscar productos
    $('#search').keyup(function (e) {
        if ($('#search').val()) {
            let search = $('#search').val();

            $.ajax({
                url: './backend/product-search.php',
                type: 'GET',
                data: { search },
                success: function (response) {
                    let productos = JSON.parse(response);
                    let template = '';
                    let template_table = '';

                    productos.forEach(producto => {
                        template += `<li>
                            ${producto.nombre}
                        </li>`
                    });

                    $('#container').html(template);
                    $('#product-result').show();

                    productos.forEach(producto => {
                        template_table += `
                            <tr productId="${producto.id}">
                                <td>${producto.id}</td>
                                <td><a href="#" class="product-item">${producto.nombre}</a></td>
                                <td>
                                    <li>Precio: $${producto.precio}</li>
                                    <li>Marca: ${producto.marca}</li>
                                    <li>Modelo: ${producto.modelo}</li>
                                    <li>Unidades: ${producto.unidades}</li>
                                    <li>Detalles: ${producto.detalles}</li>
                                </td>
                                <td>
                                <button class="product-delete btn btn-danger">Eliminar</button>
                                </td>
                            </tr>
                        `
                    });
                    $('#products').html(template_table);
                }
            });
        }
    });
    // Agregar un controlador de eventos blur para el campo 'nombre'
    $('#name').blur(function () {
        nombre = $(this).val();
        if (nombre == "") {
            $('#msj-nombre').html("<p style='color: black;'>Nombre vacío</p>");
            $(this).css("box-shadow", "0 0 9px red");
            error = true;
        } else {
            $('#msj-nombre').html(""); // Limpia el mensaje de error si el campo no está vacío
            $(this).css("box-shadow", "0 0 9px green");
            error = false;
        }
    });
    // Agregar un controlador de eventos blur para el campo 'precio'
    $('#precio').blur(function () {
        precio = $(this).val();
        if (precio == "" || !/^[0-9]+(\.[0-9]+)?$/.test(precio) || precio < 99.99) {
            $('#msj-precio').html("<p style='color: black;'>El precio debe ser mayor a $99.99</p>");
            $(this).css("box-shadow", "0 0 9px red");
            error = true;
        } else {
            $('#msj-precio').html(""); // Limpia el mensaje de error si el campo no está vacío
            $(this).css("box-shadow", "0 0 9px green");
            error = false;
        }
    });
    // Agregar un controlador de eventos blur para el campo 'marca'
    $('#marca').blur(function () {
        marca = $(this).val();
        if (marca == "") {
            $('#msj-marca').html("<p style='color: black;'>Marca vacía</p>");
            $(this).css("box-shadow", "0 0 9px red");
            error = true;
        } else {
            $('#msj-marca').html(""); // Limpia el mensaje de error si el campo no está vacío
            $(this).css("box-shadow", "0 0 9px green");
            error = false;
        }
    });
    // Agregar un controlador de eventos blur para el campo 'modelo'
    $('#modelo').blur(function () {
        modelo = $(this).val();
        if (modelo == "" || !/^[a-zA-Z0-9\s]*$/.test(modelo) || modelo.length > 25) {
            $('#msj-modelo').html("<p style='color: black;'>Modelo vacío, no es texto alfanumérico o excede los 25 caracteres</p>");
            $(this).css("box-shadow", "0 0 9px red");
            error = true;
        } else {
            $('#msj-modelo').html(""); // Limpia el mensaje de error si el campo no está vacío
            $(this).css("box-shadow", "0 0 9px green");
            error = false;
        }
    });
    // Agregar un controlador de eventos blur para el campo 'unidades'
    $('#unidades').blur(function () {
        unidades = $(this).val();
        if (unidades = "" || parseInt(unidades) < 0 || !Number.isInteger(parseInt(unidades))) {
            $('#msj-unidades').html("<p style='color: black;'>Unidades no válidas.</p>");
            $(this).css("box-shadow", "0 0 9px red");
            error = true;
        } else {
            $('#msj-unidades').html(""); // Limpia el mensaje de error si el campo no está vacío
            $(this).css("box-shadow", "0 0 9px green");
            error = false;
        }
    });
    // Agregar un controlador de eventos blur para el campo 'detalles'
    $('#detalles').blur(function () {
        detalles = $(this).val();
        if (detalles == "") {
            $('#msj-detalles').html("<p style='color: black;'>No has proporcionado detalles.</p>");
            $(this).css("box-shadow", "0 0 5px red");
            error = true;
        } else {
            $('#msj-detalles').html(""); // Limpia el mensaje de error si el campo no está vacío
            $(this).css("box-shadow", "0 0 5px green");
            error = false;
        }
    });

    //Funcion para agregar productos
    $('#product-form').submit(function (e) {
        e.preventDefault();
        if ($('#name').val() === '' || $('#precio').val() === '' || $('#marca').val() === '' || $('#modelo').val() === '' || $('#unidades').val() === '' || $('#detalles').val() === '') {
            alert('El formulario esta vacío, por favor completa la información.');
        } else {
            if (error === false) {
                const postDatos = {
                    nombre: $('#name').val(),
                    precio: $('#precio').val(),
                    unidades: $('#unidades').val(),
                    modelo: $('#modelo').val(),
                    marca: $('#marca').val(),
                    detalles: $('#detalles').val(),
                    imagen: $('#imagen').val(),
                    id: $('#productId').val()
                }
                console.log(postDatos);
                let url = edit === false ? './backend/product-add.php' : './backend/product-edit.php';
                productoJsonString = JSON.stringify(postDatos, null, 2);
                console.log(productoJsonString);
                $.post(url, productoJsonString, function (response) {
                    console.log(response);
                    let respons = JSON.parse(response);
                    let template_bar = `
                                <li>status: ${respons.status}</li>
                                <li>message: ${respons.message}</li>
                            `;
                    let mensaje = respons.message;
                    alert(mensaje);
                    $('#container').html(template_bar);
                    $('#product-result').show();
                    listarProductos();
                });
            }
        }
    });

    //Funcion para eliminar producto
    $(document).on('click', '.product-delete', function () {
        if (confirm('¿Quieres eliminar el producto?')) {
            const element = $(this)[0].parentElement.parentElement;
            const id = $(element).attr('productId');
            $.post('./backend/product-delete.php', { id }, function (response) {
                let respuesta = JSON.parse(response);
                //console.log(respuesta);
                listarProductos();
                let mensaje = respuesta.message;
                alert(mensaje);
            });
        }
    });
    //Funcion para editar un producto
    $(document).on('click', '.product-item', function () {
        let element = $(this)[0].parentElement.parentElement;
        let id = $(element).attr('productId');
        console.log(id);
        $.post('backend/product-single.php', { id }, function (response) {
            const producto = JSON.parse(response);
            console.log(producto);

            //Asigna los valores correspondientes
            $('#name').val(producto.nombre);
            $('#productId').val(producto.id);
            $('#precio').val(producto.precio);
            $('#unidades').val(producto.unidades);
            $('#modelo').val(producto.modelo);
            $('#marca').val(producto.marca);
            $('#detalles').val(producto.detalles);
            $('#imagen').val(producto.imagen);
            edit = true;
            errores = false;
        })
    });
    //Funcion para validación al teclear el nombre de producto
    $('#name').keyup(function () {
        if ($('#name').val()) {
            let search = $('#name').val();
            $.ajax({
                url: './backend/product-search-name.php?search=' + $('#name').val(),
                data: { search },
                type: 'GET',
                success: function (response) {
                    if (!response.error) {
                        // SE OBTIENE EL OBJETO DE DATOS A PARTIR DE UN STRING JSON
                        const productos = JSON.parse(response);

                        // SE VERIFICA SI EL OBJETO JSON TIENE DATOS
                        if (Object.keys(productos).length > 0) {
                            let template_bar =
                                `
                            <li style="list-style: none;">PRODUCTOS CON NOMBRES SIMILARES</li>
                            <li style="list-style: none;"></li>
                        `;

                            productos.forEach(producto => {
                                template_bar += `
                                <li>${producto.nombre}</il>
                            `;
                            });
                            $('#product-result').show();
                            $('#container').html(template_bar);
                        } else {
                            // SE CREA UNA PLANTILLA PARA CREAR LAS FILAS A INSERTAR EN EL DOCUMENTO HTML
                            let template_bar =
                                `
                            <li style="list-style: none;">PRODUCTOS CON NOMBRES SIMILARES</li>
                            <li style="list-style: none;"></li>
                            <li >NINGUNO</li>
                        `;

                            $('#product-result').show();
                            $('#container').html(template_bar);
                        }
                    }
                }
            });
        }
        else {
            $('#product-result').hide();
        }
    });
});