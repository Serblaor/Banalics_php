<?php
// Incluye el archivo de configuración de la base de datos o cualquier otro archivo necesario
include_once '../config/Conexion.php';

// Inicia la sesión (asegúrate de que la sesión esté iniciada en tus archivos anteriores)
session_start();

// Verifica si el usuario está autenticado
$usuarioAutenticado = isset($_SESSION['idUsuario']);

// Verifica si se recibieron datos del carrito en la sesión
if (isset($_SESSION['carrito']) && !empty($_SESSION['carrito'])) {
    // Recupera la información del carrito desde la sesión
    $productosEnCarrito = $_SESSION['carrito'];

    // Conecta con la base de datos
    $conexion = new Conexion();
    $conn = $conexion->ConectarDB();

    // Obtiene el ID de usuario de la sesión (ajusta según tu lógica de autenticación)
    $idUsuario = isset($_SESSION['idUsuario']) ? $_SESSION['idUsuario'] : null;

    // Obtiene la fecha actual para el campo fechaPedido
    $fechaPedido = date("Y-m-d");

    // Itera sobre los productos en el carrito y realiza la inserción en la tabla de pedidos
    foreach ($productosEnCarrito as $idProducto) {
        // Obtén la cantidad del producto desde la tabla carrito
        $stmt = $conn->prepare("SELECT cantidad FROM carrito WHERE idUsuario = ? AND idProducto = ?");
        $stmt->bind_param("ii", $idUsuario, $idProducto);
        $stmt->execute();
        $stmt->bind_result($cantidadProducto);
        $stmt->fetch();
        $stmt->close();

        // Obtiene la dirección, teléfono y correo del usuario (ajusta según tu lógica de usuario)
        $direccionEntrega = "Dirección de ejemplo";
        $telefonoEntrega = 1234567890;
        $correoEntrega = "correo@example.com";

        // Realiza la inserción en la tabla de pedidos
        $stmt = $conn->prepare("INSERT INTO pedido (beneficiario_idusuario, fechaPedido, producto_idProducto, cantidadPedido, direccionentregaPedido, telefonoentregaPedido, correoentregaPedido) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("isissis", $idUsuario, $fechaPedido, $idProducto, $cantidadProducto, $direccionEntrega, $telefonoEntrega, $correoEntrega);
        $stmt->execute();
        $stmt->close();

        // Elimina el producto del carrito después de procesar la compra
        $stmt = $conn->prepare("DELETE FROM carrito WHERE idUsuario = ? AND idProducto = ?");
        $stmt->bind_param("ii", $idUsuario, $idProducto);
        $stmt->execute();
        $stmt->close();
    }

    // Cierra la conexión
    $conn->close();

    // Limpia la información del carrito en la sesión
    unset($_SESSION['carrito']);

    // Notifica al usuario sobre la finalización de la compra (puedes ajustar según tus necesidades)
    $mensaje = "¡Gracias por tu compra! Tu pedido ha sido procesado.";
    $_SESSION['mensajeCompra'] = $mensaje;

    // Redirige a la página de confirmación de compra
    header("Location: confirmacion_compra.php");
    exit();
} else {
    // Si no hay productos en el carrito, redirige a la página del carrito
    header("Location: carrito.php");
    exit();
}
?>
