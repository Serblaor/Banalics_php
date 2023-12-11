<?php
// Cambiar el estado del Empresa en la base de datos
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $idEmpresa = $_POST["idEmpresa"];
    $nuevoEstado = $_POST["nuevoEstado"];

    require_once "../config/Conexion.php";
    
    $conexion = new Conexion();
    $conn = $conexion->ConectarDB();

    // Actualizar el estado del Empresa en la base de datos
    $sql = "UPDATE Empresa SET estadoEmpresa = ? WHERE idEmpresa = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si", $nuevoEstado, $idEmpresa);

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
