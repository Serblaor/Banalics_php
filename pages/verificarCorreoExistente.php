<?php
include "../config/Conexion.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $correo = $_POST["correo"];

    // Verificar si el correo existe en la base de datos
    $sql = "SELECT COUNT(*) AS count FROM usuario WHERE correoUsuario = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $correo);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $count = $row['count'];

    // Devolver 'existe' si el correo ya está registrado
    echo ($count > 0) ? 'existe' : 'no_existe';

    $stmt->close();
    $conn->close();
} else {
    // Si no es una solicitud POST, redirigir o manejar según sea necesario
    header("Location: Usuarios.php");
    exit();
}
?>
