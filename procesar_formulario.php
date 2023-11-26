<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Otras etiquetas head... -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Otras etiquetas head... -->
</head>
<body>

<?php
require_once "config/Conexion.php";
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["Email"];
    $contrasena = $_POST["Contraseña"];

    $conexion = new Conexion();
    $conn = $conexion->ConectarDB();

    // Consulta la base de datos para verificar las credenciales
    $sql = "SELECT idUsuario, passwordUsuario, nombresUsuario, imgUsuario, Rol_idRol FROM usuario WHERE correoUsuario = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $usuario = $result->fetch_assoc();

        // Verifica la contraseña utilizando md5
        if (md5($contrasena) == $usuario['passwordUsuario']) {
            // Las credenciales son válidas, establecer la sesión y redirigir al usuario
            $_SESSION['idUsuario'] = $usuario['idUsuario'];
            $_SESSION['nombresUsuario'] = $usuario['nombresUsuario'];
            $_SESSION['imgUsuario'] = $usuario['imgUsuario'];
            $_SESSION['Rol_idRol'] = $usuario['Rol_idRol'];

            // Redirigir según el rol
            if (in_array($usuario['Rol_idRol'], [1, 2, 3])) {
                header("Location: index.php");
            } elseif (in_array($usuario['Rol_idRol'], [4, 5])) {
                header("Location: pages/welcome.php");
            } else {
                // Si no es ninguno de los roles permitidos, mostrar un mensaje de error
                echo "Error: El usuario no tiene un rol válido.";
            }
            
            exit();
        }
    }

    // Las credenciales son incorrectas, muestra un mensaje de error con SweetAlert
    echo "<script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    icon: 'error',
                    title: 'Credenciales incorrectas',
                    text: 'Por favor, inténtelo de nuevo',
                }).then(() => {
                    window.location = 'pages/Login.php';
                });
            });
          </script>";
    $stmt->close();
    $conn->close();
}
?>


</body>
</html>
