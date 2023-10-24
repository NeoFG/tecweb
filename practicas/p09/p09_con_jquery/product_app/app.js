// JSON BASE A MOSTRAR EN FORMULARIO
var baseJSON = {
    "precio": 0.0,
    "unidades": 1,
    "modelo": "XX-000",
    "marca": "NA",
    "detalles": "NA",
    "imagen": "img/default.png"
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
    let edit = false;
    console.log('jQuery is working');
    $('#product-result').hide();
    fetchProducts();

    $('#search').keyup(function (e) {
        if ($('#search').val()) {
            let search = $('#search').val();

            $.ajax({
                url: 'backend/product-search.php',
                type: 'GET',
                data: { search },
                success: function (response) {
                    let productos = JSON.parse(response);
                    let template = '';
                    let template_bus = '';

                    productos.forEach(producto => {
                        template += `<li>
                            ${producto.nombre}
                        </li>`
                    });

                    $('#container').html(template);
                    $('#product-result').show();

                    productos.forEach(producto => {
                        template_bus += `
                            <tr productId="${producto.id}">
                                <td>${producto.id}</td>
                                <td>
                                <a href="#" class="product-item">${producto.nombre}</a>
                                </td>
                                <td>${producto.marca}</td>
                                <td>${producto.modelo}</td>
                                <td>$${producto.precio}</td>
                                <td>${producto.detalles}</td>
                                <td>${producto.unidades}</td>
                                <td>
                                    <button class="product-delete btn btn-danger">
                                        Eliminar
                                    </button>    
                                </td>
                            </tr>
                        `
                    });
                    $('#products').html(template_bus);
                }
            });
        }
    });

    $('#product-form').submit(function (e) {
        e.preventDefault(); // Evita que el formulario se envíe automáticamente
        // Obtener valores de los campos del formulario
        let nombre = $('#name').val();
        let descripcion = $('#description').val();
        let product_Id = $('#product_Id').val();
        // Parsear la descripción en un objeto
        let datos = JSON.parse(descripcion);

        // Validación del producto con las condiciones que proporcionaste
        var val = 0;
        if (nombre === '' || nombre.length > 100) {
            val = 1;
            alert('Escriba el nombre con el formato correcto');
        }
        if (datos.marca === '') {
            val = 1;
            alert('Escriba la marca del producto');
        }
        if (datos.precio < 99.99) {
            val = 1;
            alert('El precio debe ser mayor a $99.99');
        }
        if (datos.unidades < 0) {
            val = 1;
            alert('Número inválido de unidades');
        }
        if (datos.modelo === '' || datos.modelo.length > 25) {
            val = 1;
            alert('Escriba el modelo del producto');
        }
        if (datos.detalles.length > 250) {
            val = 1;
            alert('El tamaño del atributo detalles ha superado el límite');
        }
        if (datos.imagen === '') {
            datos.imagen = 'img/ejemplo.png';
        }

        if (val !== 0) {
            // Si alguna validación falla, no se envía el formulario
            return;
        }

        const postData = {
            nombre: $('#name').val(),
            precio: datos["precio"],
            unidades: datos["unidades"],
            modelo: datos["modelo"],
            marca: datos["marca"],
            detalles: datos["detalles"],
            imagen: datos["imagen"],
            id: $('#product_Id').val()
        };

        console.log(postData);

        let url = edit === false ? 'backend/product-add.php' : 'backend/product-edit.php';

        productoJsonString = JSON.stringify(postData, null, 2);
        console.log(productoJsonString);

        $.post(url, productoJsonString, function (response) {
            console.log(response);
            let res = JSON.parse(response);
            fetchProducts();
            //$('#product-form').trigger('reset');
            let mensaje = res.message;
            alert(mensaje);
        });

    });

    function fetchProducts() {
        $.ajax({
            url: 'backend/product-list.php',
            type: 'GET',
            success: function (response) {
                let productos = JSON.parse(response);
                let template = '';

                productos.forEach(producto => {
                    template += `
                        <tr productId="${producto.id}">
                            <td>${producto.id}</td>
                            <td>
                                <a href="#" class="product-item">${producto.nombre}</a>
                            </td>
                            <td>${producto.marca}</td>
                            <td>${producto.modelo}</td>
                            <td>$${producto.precio}</td>
                            <td>${producto.detalles}</td>
                            <td>${producto.unidades}</td>
                            <td>
                                <button class="product-delete btn btn-danger">
                                    Eliminar
                                </button>    
                            </td>
                        </tr>
                    `
                });
                $('#products').html(template);
            }
        });
    }

    $(document).on('click', '.product-delete', function () {
        if (confirm('¿Quieres eliminar el producto?')) {
            const element = $(this)[0].parentElement.parentElement;
            const id = $(element).attr('productId');
            $.post('backend/product-delete.php', { id }, function (response) {
                let respuesta = JSON.parse(response);
                console.log(respuesta);
                fetchProducts();
                let mensaje = respuesta.message;
                alert(mensaje);
            });
        }
    });

    $(document).on('click', '.product-item', function () {
        let element = $(this)[0].parentElement.parentElement;
        let id = $(element).attr('productId');
        //console.log(id);
        $.post('backend/product-single.php', { id }, function (response) {
            const producto = JSON.parse(response);
            console.log(response);
            $('#name').val(producto.nombre);
            $('#product_Id').val(producto.id);

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
});