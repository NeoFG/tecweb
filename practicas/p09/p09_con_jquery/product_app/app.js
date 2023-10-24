// JSON BASE A MOSTRAR EN FORMULARIO

var baseJSON = {
    "precio": 0.0,
    "unidades": 1,
    "modelo": "XX-000",
    "marca": "NA",
    "detalles": "NA",
    "imagen": "img/imagen.png"
};

function init() {
    /**
     * Convierte el JSON a string para poder mostrarlo
     * ver: https://developer.mozilla.org/es/docs/Web/JavaScript/Reference/Global_Objects/JSON
     */
    var JsonString = JSON.stringify(baseJSON, null, 2);
    document.getElementById("description").value = JsonString;
}

$(document).ready(function () {
    $('#product-result').hide();//Ocultar el product-result con jquery
    listarProductos();//Cargar todos los productos existentes
    let edit = false;
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

    //Funcion para buscar productos con jquery
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

    //Funcion para agregar productos
    $('#product-form').submit(function (e) {
        // e.preventDefault();
        let description = $('#description').val();
        let datos = JSON.parse(description);//convertirla en un objeto JavaScript.
        datos.nombre = $('#name').val();
        datos.id = $('#productId').val();

        const postDatos = {
            nombre: datos.nombre,
            precio: datos.precio,
            unidades: datos.unidades,
            modelo: datos.modelo,
            marca: datos.marca,
            detalles: datos.detalles,
            imagen: datos.imagen,
            id: datos.id
        };
        let errors = validateForm(datos);
        console.log(postDatos);
        if (errors.length > 0) {
            displayErrors(errors);
        } else {
            // Ocultar los errores antes de la solicitud
            $('#mensaje').empty(); // Eliminar los mensajes de error
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
            e.preventDefault();
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
            console.log(response);
            $('#name').val(producto.nombre);
            $('#productId').val(producto.id);

            var atributosobj = {
                "precio": producto.precio,
                "unidades": producto.unidades,
                "modelo": producto.modelo,
                "marca": producto.marca,
                "detalles": producto.detalles,
                "imagen": producto.imagen
            };

            var objstring = JSON.stringify(atributosobj, null, 2);
            $('#description').val(objstring);
            edit = true;
        })
    });

    //Funcion para validar las entradas del formulario
    function validateForm(datos) {
        const errors = [];
        const regex = /^[0-9]+(\.[0-9]+)?$/;

        //a. El nombre debe ser requerido y tener 100 caracteres o menos.
        if (!datos.nombre || datos.nombre.trim().length === 0 || datos.nombre.length > 100) {
            errors.push("Nombre vacío o excede los 100 caracteres.");
        }
        // b. La marca debe ser requerida y seleccionarse de una lista de opciones.
        if (!datos.marca) {
            errors.push("No has proporcionado ninguna marca.");
        }
        //c. El modelo debe ser requerido, texto alfanumérico y tener 25 caracteres o menos.
        if (!datos.modelo || !/^[a-zA-Z0-9\s]*$/.test(datos.modelo) || datos.modelo.length > 25) {
            errors.push("Modelo vacío, no es texto alfanumérico o excede los 25 caracteres.");
        }
        //d. El precio debe ser requerido y debe ser mayor a 99.99
        if (!datos.precio || !regex.test(datos.precio) || datos.precio < 99.99) {
            errors.push("Precio no válido, debe ser mayor a 99.99");
        }
        //e. Los detalles deben ser opcionales y, de usarse, deben tener 250 caracteres o menos.
        if (datos.detalles.length > 250) {
            errors.push("Los detalles exceden los 250 caracteres.");
        }
        //f. Las unidades deben ser requeridas y el número registrado debe ser mayor o igual a 0.
        if (!datos.unidades || parseInt(datos.unidades) < 0 || !Number.isInteger(parseInt(datos.unidades))) {
            errors.push("Unidades no válidas.");
        }
        /*g. La ruta de la imagen debe ser opcional, pero en caso de no registrarse se debe usar la
        ruta de una imagen por defecto (ver ejemplo):*/
        if (!datos.imagen) {
            errors.imagen.value = "img/imagen.png";
        }
        return errors;
    }

    //Funcion para mostrar los errores del formulario
    function displayErrors(errors) {
        $('#mensaje').html("<b>Errores en el formulario:</b><br>" + errors.join("<br>")).show();
    }
    
});