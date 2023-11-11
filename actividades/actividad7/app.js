$(document).ready(function () {
  let edit = false;
  console.log("jQuery is working");
  $("#product-result").hide();
  fetchProducts();

  $("#search").keyup(function (e) {
    if ($("#search").val()) {
      let search = $("#search").val();

      $.ajax({
        url: "backend/product-search.php",
        type: "GET",
        data: { search },
        success: function (response) {
          let productos = JSON.parse(response);
          let template = "";
          let template_bus = "";

          productos.forEach((producto) => {
            template += `<li>
                            ${producto.nombre}
                        </li>`;
          });

          $("#container").html(template);
          $("#product-result").show();

          productos.forEach((producto) => {
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
                        `;
          });
          $("#products").html(template_bus);
        },
      });
    }
  });

  // Agrega un evento de focusout o blur a cada campo del formulario
  $("#name").on("focusout", function () {
    validarCampoNombre();
  });

  $("#precio").on("focusout", function () {
    validarCampoPrecio();
  });

  $("#unidades").on("focusout", function () {
    validarCampoUnidades();
  });

  $("#modelo").on("focusout", function () {
    validarCampoModelo();
  });

  $("#marca").on("focusout", function () {
    validarCampoMarca();
  });

  $("#detalles").on("focusout", function () {
    validarCampoDetalles();
  });

  $("#imagen").on("focusout", function () {
    validarCampoImagen();
  });


  // Función para validar el campo de nombre
  function validarCampoNombre() {
    let nombre = $("#name").val();
    let nombreError = $("#nombreError");
    let nombreInput = $("#name");

    if (nombre === "" || nombre.length > 100) {
      nombreError.text("Escriba el nombre con el formato correcto");
      nombreError.show(); // Muestra el mensaje de error
      // Aplicar estilo de campo no válido
      nombreInput.addClass("invalid");
    } else {
      nombreError.text(""); // Borra el mensaje de error
      nombreError.hide(); // Oculta el mensaje de error
      // Aplicar estilo de campo válido
      nombreInput.removeClass("invalid");
      nombreInput.addClass("valid");
    }
  }

  // Función para validar el campo de precio
  function validarCampoPrecio() {
    let precio = parseFloat($("#precio").val());
    let precioError = $("#precioError");
    let precioInput = $("#precio");

    if (isNaN(precio) || precio < 99.99) {
      precioError.text("El precio debe ser mayor a $99.99");
      precioError.show();
      precioInput.addClass("invalid");
    } else {
      precioError.text("");
      precioError.hide();
      precioInput.removeClass("invalid");
      precioInput.addClass("valid");
    }
  }

  // Función para validar el campo de unidades
  function validarCampoUnidades() {
    let unidades = parseInt($("#unidades").val());
    let unidadesError = $("#unidadesError");
    let unidadesInput = $("#unidades");

    if (isNaN(unidades) || unidades < 0) {
      unidadesError.text("Número inválido de unidades");
      unidadesError.show();
      unidadesInput.addClass("invalid");
    } else {
      unidadesError.text("");
      unidadesError.hide();
      unidadesInput.removeClass("invalid");
      unidadesInput.addClass("valid");
    }
  }

  // Función para validar el campo de modelo
  function validarCampoModelo() {
    let modelo = $("#modelo").val();
    let modeloError = $("#modeloError");
    let modeloInput = $("#modelo");

    if (modelo === "" || modelo.length > 25) {
      modeloError.text("Escriba el modelo del producto");
      modeloError.show();
      modeloInput.addClass("invalid");
    } else {
      modeloError.text("");
      modeloError.hide();
      modeloInput.removeClass("invalid");
      modeloInput.addClass("valid");
    }
  }

  // Función para validar el campo de marca
  function validarCampoMarca() {
    let marca = $("#marca").val();
    let marcaError = $("#marcaError");
    let marcaInput = $("#marca");

    if (marca === "") {
      marcaError.text("Escriba la marca del producto");
      marcaError.show();
      marcaInput.addClass("invalid");
    } else {
      marcaError.text("");
      marcaError.hide();
      marcaInput.removeClass("invalid");
      marcaInput.addClass("valid");
    }
  }

  // Función para validar el campo de detalles
  function validarCampoDetalles() {
    let detalles = $("#detalles").val();
    let detallesError = $("#detallesError");
    let detallesInput = $("#detalles");

    if (detalles.length > 250) {
      detallesError.text("El tamaño del atributo detalles ha superado el límite");
      detallesError.show();
      detallesInput.addClass("invalid");
    } else {
      detallesError.text("");
      detallesError.hide();
      detallesInput.removeClass("invalid");
      detallesInput.addClass("valid");
    }
  }

  // Función para validar el campo de imagen
  function validarCampoImagen() {
    let imagen = $("#imagen").val();
    let imagenInput = $("#imagen");
    if (imagen === "") {
      imagen = "img/ejemplo.png";
      imagenInput.addClass("valid");
    }
  }

  $("#product-form").submit(function (e) {
    e.preventDefault(); // Evita que el formulario se envíe automáticamente
    // Obtener valores de los campos del formulario
    let nombre = $("#name").val();
    let precio = $("#precio").val();
    let unidades = $("#unidades").val();
    let modelo = $("#modelo").val();
    let marca = $("#marca").val();
    let detalles = $("#detalles").val();
    let imagen = $("#imagen").val();
    let product_Id = $("#product_Id").val();

    // Validación adicional: Verificar que los campos requeridos no estén vacíos
    if (precio.trim() === "" || unidades.trim() === "") {
      alert("Por favor, complete los campos requeridos.");
      return; // No se envía el formulario si hay campos vacíos
    }

    const postData = {
      nombre: nombre,
      precio: precio,
      unidades: unidades,
      modelo: modelo,
      marca: marca,
      detalles: detalles,
      imagen: imagen,
      id: product_Id,
    };
    console.log(postData);

    let url =
      edit === false ? "backend/product-add.php" : "backend/product-edit.php";

    productoJsonString = JSON.stringify(postData, null, 2);
    console.log(productoJsonString);

    $.post(url, productoJsonString, function (response) {
      console.log(response);
      let res = JSON.parse(response);
      fetchProducts();
      let mensaje = res.message;
      alert(mensaje);
    });
  });

  function fetchProducts() {
    $.ajax({
      url: "backend/product-list.php",
      type: "GET",
      success: function (response) {
        let productos = JSON.parse(response);
        let template = "";

        productos.forEach((producto) => {
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
                    `;
        });
        $("#products").html(template);
      },
    });
  }

  $(document).on("click", ".product-delete", function () {
    if (confirm("¿Quieres eliminar el producto?")) {
      const element = $(this)[0].parentElement.parentElement;
      const id = $(element).attr("productId");
      $.post("backend/product-delete.php", { id }, function (response) {
        let respuesta = JSON.parse(response);
        console.log(respuesta);
        fetchProducts();
        let mensaje = respuesta.message;
        alert(mensaje);
      });
    }
  });

  $(document).on("click", ".product-item", function () {
    let element = $(this)[0].parentElement.parentElement;
    let id = $(element).attr("productId");
    //console.log(id);
    $.post("backend/product-single.php", { id }, function (response) {
      const producto = JSON.parse(response);
      console.log(response);

      $("#name").val(producto.nombre);
      $("#product_Id").val(producto.id);
      $("#precio").val(producto.precio);
      $("#unidades").val(producto.unidades);
      $("#modelo").val(producto.modelo);
      $("#marca").val(producto.marca);
      $("#detalles").val(producto.detalles);
      $("#imagen").val(producto.imagen);

      edit = true;
    });
  });
});
