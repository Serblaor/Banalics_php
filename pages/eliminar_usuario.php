<?php
require_once "../config/Conexion.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $idUsuario = $_POST["idUsuario"];

    $conexion = new Conexion();
    $conn = $conexion->ConectarDB();

    $sql = "DELETE FROM usuario WHERE idUsuario = ?";

    $stmz = $conn->prepare($sql);
    $stmz->bind_param("i", $idUsuario);

    if ($stmz->execute()) {
        // Si la eliminación es exitosa, devuelves un mensaje de éxito
        echo 'success';
    } else {
        // Si hay un error, devuelves un mensaje de error
        echo 'Error al eliminar el usuario: ' . $conn->error;
    }

    $stmz->close();
    $conn->close();
} else {
    // Si no es una solicitud POST, devuelves un mensaje de acceso no permitido
    echo 'Acceso no permitido';
}
?>
