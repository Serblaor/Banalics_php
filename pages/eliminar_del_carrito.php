<?php
// Inicia la sesión
session_start();

// Verifica si se recibió el ID del carrito a eliminar
if (isset($_POST['idCarrito'])) {
    $idCarrito = $_POST['idCarrito'];

    // Verifica si el ID del carrito no está vacío y es un número entero
    if (is_numeric($idCarrito) && $idCarrito > 0) {
        // Conecta con la base de datos
        include_once '../config/Conexion.php';
        $conexion = new Conexion();
        $conn = $conexion->ConectarDB();

        // Prepara la sentencia SQL para eliminar el producto del carrito
        $stmt = $conn->prepare("DELETE FROM carrito WHERE idCarrito = ?");
        $stmt->bind_param("i", $idCarrito);
        $stmt->execute();

        // Cierra la conexión y libera los recursos
        $stmt->close();
        $conn->close();

        // Muestra un mensaje indicando que el producto fue eliminado con éxito
        echo json_encode(array('success' => true, 'message' => 'Producto eliminado del carrito con ID: ' . $idCarrito));
    } else {
        // Muestra SweetAlert indicando que el ID de carrito no es válido
        echo json_encode(array('success' => false, 'message' => 'Error: ID de carrito no válido.'));
    }
} else {
    // Muestra SweetAlert indicando que no se proporcionó el ID de carrito
    echo json_encode(array('success' => false, 'message' => 'Error: ID de carrito no proporcionado.'));
}
?>