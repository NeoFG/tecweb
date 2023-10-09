<?php
// Función para actualizar la base de datos y redirigir
function actualizarBaseDeDatos() {
    // Verifica si se ha enviado el formulario
    if (isset($_POST["actualizar_producto"])) {
        // Recupera los valores del formulario
        $nombre = $_POST["nombre"];
        $marca = $_POST["marca"];
        $modelo = $_POST["modelo"];
        $precio = $_POST["precio"];
        $detalles = $_POST["detalles"];
        $unidades = $_POST["unidades"];
        $imagen = $_POST["imagen"];

        // Ejemplo de actualización en la base de datos (usando MySQLi):
        $servername = "localhost";
        $username = "root";
        $password = "123456";
        $dbname = "marketzone";

        // Crear una conexión a la base de datos
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Verificar la conexión
        if ($conn->connect_error) {
            die("Error de conexión: " . $conn->connect_error);
        }

        // Construir la consulta SQL para actualizar el producto (ajustar esto según tu estructura de base de datos)
        $sql = "UPDATE productos SET precio='$precio', detalles='$detalles', unidades='$unidades', imagen='$imagen' WHERE nombre='$nombre' AND marca='$marca' AND modelo='$modelo'";

        // Ejecutar la consulta
        if ($conn->query($sql) === TRUE) {
            echo "Producto actualizado con éxito.";
            // Redirige a get_productos_xhtml_v2.php
            header("Location: get_productos_xhtml_v2.php");
            exit(); // Asegura que el script se detenga después de redirigir
        } else {
            echo "Error al actualizar el producto: " . $conn->error;
        }

        // Cerrar la conexión a la base de datos
        $conn->close();
    }
}

// Llama a la función para procesar el formulario
actualizarBaseDeDatos();
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
        integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous" />

    <script>
        function validarFormulario() {
            // Obtiene los valores de los campos del formulario
            var nombre = document.getElementById("nombre").value;
            var marca = document.getElementById("marca").value;
            var modelo = document.getElementById("modelo").value;
            var precio = parseFloat(document.getElementById("precio").value);
            var detalles = document.getElementById("detalles").value;
            var unidades = parseInt(document.getElementById("unidades").value);
            var imagen = document.getElementById("imagen").value;

            // Valida el nombre (debe ser requerido y tener 100 caracteres o menos)
            if (nombre === "" || nombre.length > 100) {
                alert("Por favor, ingrese un nombre válido (máximo 100 caracteres).");
                return false;
            }

            // Valida la marca (debe ser requerida y seleccionarse de una lista de opciones)
            if (marca === "") {
                alert("Por favor, seleccione una marca válida.");
                return false;
            }

            // Valida el modelo (debe ser requerido, texto alfanumérico y tener 25 caracteres o menos)
            if (modelo === "" || modelo.length > 25 || !/^[a-zA-Z0-9\s]+$/.test(modelo)) {
                alert("Por favor, ingrese un modelo válido (máximo 25 caracteres, solo letras, números y espacios).");
                return false;
            }


            // Valida el precio (debe ser requerido y mayor a 99.99)
            if (isNaN(precio) || precio <= 99.99) {
                alert("Por favor, ingrese un precio válido (mayor a 99.99).");
                return false;
            }

            // Valida los detalles (opcional, debe tener 250 caracteres o menos si se utiliza)
            if (detalles.length > 250) {
                alert("Los detalles no deben exceder los 250 caracteres.");
                return false;
            }

            // Valida las unidades (deben ser requeridas y un número mayor o igual a 0)
            if (isNaN(unidades) || unidades < 0) {
                alert("Por favor, ingrese un número válido de unidades (mayor o igual a 0).");
                return false;
            }

            if (imagen.trim() === '') {
                // Si no se ha cargado una imagen, asignamos la ruta de la imagen por defecto
                document.getElementById('imagen').value = document.getElementById('../p06/img/imagen.png').value;
            }

            // Restablecer cualquier mensaje de error anterior
            document.getElementById('imagenError').textContent = '';

            // Si todas las validaciones son exitosas, el formulario se enviará
            return true;
        }
    </script>
</head>
<body>
    <h1>Editar Producto</h1>

    <!-- Formulario de edición de producto -->
    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" onsubmit="return validarFormulario()">
        <div class="form-group">
            <label for="nombre">Nombre</label>
            <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo isset($_POST['nombre']) ? $_POST['nombre'] : ''; ?>">
        </div>
        <div class="form-group">
            <label for="marca">Marca</label>
            <input type="text" class="form-control" id="marca" name="marca" value="<?php echo isset($_POST['marca']) ? $_POST['marca'] : ''; ?>">
        </div>
        <div class="form-group">
            <label for="modelo">Modelo</label>
            <input type="text" class="form-control" id="modelo" name="modelo" value="<?php echo isset($_POST['modelo']) ? $_POST['modelo'] : ''; ?>">
        </div>
        <div class="form-group">
            <label for="precio">Precio</label>
            <input type="text" class="form-control" id="precio" name="precio" value="<?php echo isset($_POST['precio']) ? $_POST['precio'] : ''; ?>">
        </div>
        <div class="form-group">
            <label for="detalles">Detalles</label>
            <textarea class="form-control" id="detalles" name="detalles"><?php echo isset($_POST['detalles']) ? $_POST['detalles'] : ''; ?></textarea>
        </div>
        <div class="form-group">
            <label for="unidades">Unidades</label>
            <input type="text" class="form-control" id="unidades" name="unidades" value="<?php echo isset($_POST['unidades']) ? $_POST['unidades'] : ''; ?>">
        </div>
        <div class="form-group">
            <label for="imagen">Imagen</label>
            <input type="text" class="form-control" id="imagen" name="imagen" value="<?php echo isset($_POST['imagen']) ? $_POST['imagen'] : ''; ?>">
        </div>
        <!-- Cambios realizados en el botón -->
        <input type="submit" class="btn btn-primary" name="actualizar_producto" value="Actualizar Producto">
    </form>
</body>
</html>
