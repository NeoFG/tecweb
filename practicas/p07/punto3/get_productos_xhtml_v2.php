<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
        integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous" />
    
    <script>
        function show(nombre, marca, modelo, precio, detalles, unidades, img) {
            alert("Nombre: " + nombre +
                "\nMarca: " + marca +
                "\nModelo: " + modelo +
                "\nPrecio: " + precio +
                "\nDetalles: " + detalles +
                "\nUnidades: " + unidades +
                "\nImg: " + img
            );
            send2form(nombre, marca, modelo, precio, detalles, unidades, img);
        }

        function send2form(nombre, marca, modelo, precio, detalles, unidades, img) {
            // Crear un formulario dinámicamente
            var form = document.createElement("form");

            // Configurar el método y la acción del formulario
            form.method = "POST";
            form.action = "formulario_productos_v2.php";

            // Crear campos de entrada para cada dato que deseas enviar
            var nombreInput = document.createElement("input");
            nombreInput.type = "hidden";
            nombreInput.name = "nombre";
            nombreInput.value = nombre;
            form.appendChild(nombreInput);

            var marcaInput = document.createElement("input");
            marcaInput.type = "hidden";
            marcaInput.name = "marca";
            marcaInput.value = marca;
            form.appendChild(marcaInput);

            var modeloInput = document.createElement("input");
            modeloInput.type = "hidden";
            modeloInput.name = "modelo";
            modeloInput.value = modelo;
            form.appendChild(modeloInput);

            var precioInput = document.createElement("input");
            precioInput.type = "hidden";
            precioInput.name = "precio";
            precioInput.value = precio;
            form.appendChild(precioInput);

            var detallesInput = document.createElement("input");
            detallesInput.type = "hidden";
            detallesInput.name = "detalles";
            detallesInput.value = detalles;
            form.appendChild(detallesInput);

            var unidadesInput = document.createElement("input");
            unidadesInput.type = "hidden";
            unidadesInput.name = "unidades";
            unidadesInput.value = unidades;
            form.appendChild(unidadesInput);

            // Agregar un campo de entrada para la imagen
            var imagenInput = document.createElement("input");
            imagenInput.type = "hidden";
            imagenInput.name = "imagen";
            imagenInput.value = img;
            form.appendChild(imagenInput);

            // Enviar el formulario automáticamente
            document.body.appendChild(form);
            form.submit();
        }

    </script>
</head>

<body>

    <table class="table">
        <tbody>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Marca</th>
                <th scope="col">Modelo</th>
                <th scope="col">Precio</th>
                <th scope="col">Detalles</th>
                <th scope="col">Unidades</th>
                <th scope="col">Img</th>
                <th scope="col">Submit</th>
            </tr>

            <?php
            // Realiza tu consulta SQL para obtener los productos desde la base de datos
            // Asegúrate de tener una conexión válida y ejecutar la consulta aquí

            // Ejemplo de cómo mostrar los productos en la tabla
            $productos = obtenerProductosDesdeBaseDeDatos(); // Reemplaza esto con tu consulta real

            foreach ($productos as $producto) {
                echo "<tr>";
                echo "<th scope='row'>" . $producto['id'] . "</th>";
                echo "<td class='row-data'>" . $producto['nombre'] . "</td>";
                echo "<td class='row-data'>" . $producto['marca'] . "</td>";
                echo "<td class='row-data'>" . $producto['modelo'] . "</td>";
                echo "<td class='row-data'>$" . $producto['precio'] . "</td>";
                echo "<td class='row-data'>" . $producto['detalles'] . "</td>";
                echo "<td class='row-data'>" . $producto['unidades'] . "</td>";
                echo "<td class='row-data'><img src='" . $producto['imagen'] . "' width='50px'></td>";
                echo "<td><button class='submit-button' onclick=\"show('" . $producto['nombre'] . "', '" . $producto['marca'] . "', '" . $producto['modelo'] . "', '" . $producto['precio'] . "', '" . $producto['detalles'] . "', '" . $producto['unidades'] . "', '" . $producto['imagen'] . "')\">Submit</button></td>";
                echo "</tr>";
            }


            // Función de ejemplo para obtener productos desde la base de datos (ajusta esto según tu configuración)
            function obtenerProductosDesdeBaseDeDatos() {
                // Conexión a la base de datos (ajusta estos valores según tu configuración)
                $servername = "localhost";
                $username = "root";
                $password = "123456";
                $dbname = "marketzone";

                // Crear una conexión
                $conn = new mysqli($servername, $username, $password, $dbname);

                // Verificar la conexión
                if ($conn->connect_error) {
                    die("Conexión fallida: " . $conn->connect_error);
                }

                // Consulta SQL para obtener los productos
                $sql = "SELECT id, nombre, marca, modelo, precio, detalles, unidades, imagen FROM productos";

                // Ejecutar la consulta y obtener los resultados
                $result = $conn->query($sql);

                // Crear un arreglo para almacenar los productos
                $productos = array();

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $productos[] = $row;
                    }
                }

                // Cerrar la conexión
                $conn->close();

                return $productos;
            }
            ?>
        </tbody>
    </table>

</body>

</html>
