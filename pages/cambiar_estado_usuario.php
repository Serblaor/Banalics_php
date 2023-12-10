<?php
// Cambiar el estado del usuario en la base de datos
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $idUsuario = $_POST["idUsuario"];
    $nuevoEstado = $_POST["nuevoEstado"];

    require_once "../config/Conexion.php";
    
    $conexion = new Conexion();
    $conn = $conexion->ConectarDB();

    // Actualizar el estado del usuario en la base de datos
    $sql = "UPDATE usuario SET estadoUsuario = ? WHERE idUsuario = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si", $nuevoEstado, $idUsuario);

    if ($stmt->execute()) {
        // Éxito al cambiar el estado
        echo "success";
    } else {
        // Error al cambiar el estado
        echo "error";
    }

    $stmt->close();
    $conn->close();
} else {
    // Si no es una solicitud POST, redirigir o manejar según sea necesario
    header("Location: error.php");
    exit();
}
?>
