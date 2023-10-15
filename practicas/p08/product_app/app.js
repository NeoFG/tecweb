// JSON BASE A MOSTRAR EN FORMULARIO
var baseJSON = {
    "precio": 0.0,
    "unidades": 1,
    "modelo": "XX-000",
    "marca": "NA",
    "detalles": "NA",
    "imagen": "img/default.png"
};

// FUNCIÓN CALLBACK DE BOTÓN "Buscar"
function buscarID(e) {
    e.preventDefault();

    var searchTerm = document.getElementById('search').value;

    var client = getXMLHttpRequest();
    client.open('POST', './backend/read.php', true);
    client.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    client.onreadystatechange = function () {
        if (client.readyState == 4 && client.status == 200) {
            console.log('[CLIENTE]\n' + client.responseText);

            // Se obtiene el arreglo de productos a partir de la respuesta JSON
            var productos = JSON.parse(client.responseText);

            if (productos.length > 0) {
                var template = '';

                // Se crea una fila en la tabla para cada producto encontrado
                productos.forEach(function (producto) {
                    var descripcion = '<ul>';
                    descripcion += '<li>precio: ' + producto.precio + '</li>';
                    descripcion += '<li>unidades: ' + producto.unidades + '</li>';
                    descripcion += '<li>modelo: ' + producto.modelo + '</li>';
                    descripcion += '<li>marca: ' + producto.marca + '</li>';
                    descripcion += '<li>detalles: ' + producto.detalles + '</li>';
                    descripcion += '</ul>';

                    template += `
            <tr>
                <td>${producto.id}</td>
                <td>${producto.nombre}</td>
                <td>${descripcion}</td>
            </tr>
          `;
                });

                document.getElementById("productos").innerHTML = template;
            }
        }
    };

    // Enviando el término de búsqueda (nombre, marca y detalles) en lugar del ID
    client.send("searchTerm=" + searchTerm);
}

// FUNCIÓN CALLBACK DE BOTÓN "Agregar Producto"
function agregarProducto(e) {
    e.preventDefault();

    // Validaciones de los datos del formulario
    var nombre = document.getElementById('name').value;
    var marca = document.getElementById('marca').value;
    var modelo = document.getElementById('modelo').value;
    var precio = parseFloat(document.getElementById('precio').value);
    var detalles = document.getElementById('detalles').value;
    var unidades = parseInt(document.getElementById('unidades').value);
    var imagen = document.getElementById('imagen').value;

    if (
        !nombre ||
        nombre.length > 100 ||
        !marca ||
        !modelo ||
        modelo.length > 25 ||
        isNaN(precio) ||
        precio <= 99.99 ||
        (detalles && detalles.length > 250) ||
        isNaN(unidades) ||
        unidades < 0
    ) {
        alert("Por favor, complete los campos correctamente.");
        return;
    }

    var producto = {
        nombre: nombre,
        marca: marca,
        modelo: modelo,
        precio: precio,
        detalles: detalles || "NA",
        unidades: unidades,
        imagen: imagen || "img/default.png",
    };

    // SE CONVIERTE EL OBJETO A UN STRING JSON
    var productoJsonString = JSON.stringify(producto);

    // SE CREA EL OBJETO DE CONEXIÓN ASÍNCRONA AL SERVIDOR
    var client = getXMLHttpRequest();
    client.open('POST', './backend/create.php', true);
    client.setRequestHeader('Content-Type', "application/json;charset=UTF-8");
    client.onreadystatechange = function () {
        // SE VERIFICA SI LA RESPUESTA ESTÁ LISTA Y FUE SATISFACTORIA
        if (client.readyState == 4 && client.status == 200) {
            alert(client.responseText);
            // Limpiar el formulario o realizar otras acciones necesarias
        }
    };
    client.send(productoJsonString);
}

// SE CREA EL OBJETO DE CONEXIÓN COMPATIBLE CON EL NAVEGADOR
function getXMLHttpRequest() {
    var objetoAjax;

    try{
        objetoAjax = new XMLHttpRequest();
    }catch(err1){
        /**
         * NOTA: Las siguientes formas de crear el objeto ya son obsoletas
         *       pero se comparten por motivos historico-académicos.
         */
        try{
            // IE7 y IE8
            objetoAjax = new ActiveXObject("Msxml2.XMLHTTP");
        }catch(err2){
            try{
                // IE5 y IE6
                objetoAjax = new ActiveXObject("Microsoft.XMLHTTP");
            }catch(err3){
                objetoAjax = false;
            }
        }
    }
    return objetoAjax;
}

function init() {
    /**
     * Convierte el JSON a string para poder mostrarlo
     * ver: https://developer.mozilla.org/es/docs/Web/JavaScript/Reference/Global_Objects/JSON
     */
    var JsonString = JSON.stringify(baseJSON,null,2);
    document.getElementById("description").value = JsonString;
}