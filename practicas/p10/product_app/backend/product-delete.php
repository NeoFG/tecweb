<?php
   use API\Eliminar\Eliminar;
   require_once __DIR__.'/API/start.php';
   //$productos = new Productos('marketzone');
   $productos = new Eliminar('marketzone');
   
   // Verifica si se ha enviado un parámetro ID
   if (isset($_POST['id'])) {
       $id = $_POST['id'];
       // Llama a la función para eliminar el producto y pasa el ID
       $resultadoEliminacion = $productos->eliminarProducto($id);
       // Devuelve el resultado de la eliminación en formato JSON
       echo json_encode($resultadoEliminacion, JSON_PRETTY_PRINT);
   } else {
       $response = array('status' => 'error', 'message' => 'No se proporcionó un ID');
       echo json_encode($response, JSON_PRETTY_PRINT);
   }
?>