<?php
require_once "config/Conexion.php";
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Otras etiquetas head... -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Otras etiquetas head... -->
</head>
<body>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["Email"];
    $contrasena = $_POST["Contraseña"];

    $conexion = new Conexion();
    $conn = $conexion->ConectarDB();

    // Consulta la base de datos para verificar las credenciales
    $sql = "SELECT * FROM usuario WHERE correoUsuario = '$email' AND passwordUsuario = '$contrasena'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Las credenciales son válidas, establecer la sesión y redirigir al usuario
        $usuario = $result->fetch_assoc();
        $_SESSION['idUsuario'] = $usuario['idUsuario'];

        header("Location: pages/welcome.php");
        exit();
    } else {
        // Las credenciales son incorrectas, muestra un mensaje de error con SweetAlert
        echo "<script>
                document.addEventListener('DOMContentLoaded', function() {
                    Swal.fire({
                        icon: 'error',
                        title: 'Credenciales incorrectas',
                        text: 'Por favor, inténtelo de nuevo',
                    }).then(() => {
                        window.location = 'index.php';
                    });
                });
              </script>";
    }
    $conn->close();
}
?>
</body>
</html>
