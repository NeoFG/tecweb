<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style type="text/css">
      ol, ul {
        list-style-type: none;
      }
    </style>
    <title>Formulario</title>
</head>
<body>
    <h1>Datos Personales</h1>

    <form id="miFormulario" onsubmit="return validarFormulario();" method="post">
        <fieldset>
            <legend>Actualiza los datos personales de esta persona:</legend>
            <ul>
                <li>
                    <label>Nombre:</label> 
                    <input type="text" name="nombre" id="nombre" value="<?= !empty($_POST['nombre'])?$_POST['nombre']:$_GET['nombre'] ?>">
                    <span id="nombreError" style="color: red;"></span>
                </li>
                
                <li>
                    <label for="marca">Marca:</label>
                    <input type="text" name="marca" id="marca" value="<?= !empty($_POST['marca'])?$_POST['marca']:$_GET['marca'] ?>">
                    <span id="marcaError" style="color: red;"></span>
                </li>

                <li>
                    <label for="modelo">Modelo:</label>
                    <input type="text" name="modelo" id="modelo" value="<?= !empty($_POST['modelo'])?$_POST['modelo']:$_GET['modelo'] ?>">
                    <span id="modeloError" style="color: red;"></span>
                </li>

                <li>
                    <label for="precio">Precio:</label>
                    <input type="text" name="precio" id="precio" pattern="\d+(\.\d{2})?" value="<?= !empty($_POST['precio'])?$_POST['precio']:$_GET['precio'] ?>">
                    <span id="precioError" style="color: red;"></span>
                </li>

                <li>
                    <label for="detalles">Detalles:</label>
                    <textarea name="detalles" id="detalles"><?= !empty($_POST['detalles'])?$_POST['detalles']:$_GET['detalles'] ?></textarea>
                    <span id="detallesError" style="color: red;"></span>
                </li>

                <li>
                    <label for="unidades">Unidades:</label>
                    <input type="number" name="unidades" id="unidades" value="<?= !empty($_POST['unidades'])?$_POST['unidades']:$_GET['unidades'] ?>">
                    <span id="unidadesError" style="color: red;"></span>
                </li>

                
                <li>
                    <label for="imagen">Imagen:</label>
                    <input type="file" name="imagen" id="imagen" accept="image/*">
                    <span id="imagenError" style="color: red;"></span>
                </li>

                <!-- Campo oculto para la ruta de la imagen por defecto -->
                <input type="hidden" name="imagen_defecto" value="../p06/img/imagen.png">
        	    

            </ul>
        </fieldset>
        <p>
            <input type="submit" value="ENVIAR">
        </p>
    </form>

    <script>
        function validarFormulario() {
            var nombre = document.getElementById('nombre').value;
            var marca = document.getElementById('marca').value;
            var modelo = document.getElementById('modelo').value;
            var precio = document.getElementById('precio').value;
            var detalles = document.getElementById('detalles').value;
            var unidades = document.getElementById('unidades').value;
            // Obtiene el valor del campo de imagen
            var imagen = document.getElementById('imagen').value;

            // Validación del nombre (requerido y longitud máxima 100)
            if (nombre.trim() === '' || nombre.length > 100) {
                document.getElementById('nombreError').textContent = 'El nombre es requerido y debe tener 100 caracteres o menos.';
                return false;
            } else {
                document.getElementById('nombreError').textContent = '';
            }

            // Validación de la marca (requerida)
            if (marca.trim() === '') {
                document.getElementById('marcaError').textContent = 'La marca es requerida.';
                return false;
            } else {
                document.getElementById('marcaError').textContent = '';
            }

            // Validación del modelo (requerido y longitud máxima 25)
            if (modelo.trim() === '' || modelo.length > 25) {
                document.getElementById('modeloError').textContent = 'El modelo es requerido y debe tener 25 caracteres o menos.';
                return false;
            } else {
                document.getElementById('modeloError').textContent = '';
            }

            // Validación del precio (requerido y mayor a 99.99)
            if (precio.trim() === '' || parseFloat(precio) <= 99.99) {
                document.getElementById('precioError').textContent = 'El precio es requerido y debe ser mayor a 99.99.';
                return false;
            } else {
                document.getElementById('precioError').textContent = '';
            }

            // Validación de las unidades (requeridas y mayor o igual a 0)
            if (unidades.trim() === '' || parseInt(unidades) < 0) {
                document.getElementById('unidadesError').textContent = 'Las unidades son requeridas y deben ser 0 o más.';
                return false;
            } else {
                document.getElementById('unidadesError').textContent = '';
            }

            if (imagen.trim() === '') {
                // Si no se ha cargado una imagen, asignamos la ruta de la imagen por defecto
                document.getElementById('imagen').value = document.getElementById('../p06/img/imagen.png').value;
            }

            // Restablecer cualquier mensaje de error anterior
            document.getElementById('imagenError').textContent = '';
            
            // El formulario se enviará si todas las validaciones pasan
            return true; 
        }
    </script>
</body>
</html>
