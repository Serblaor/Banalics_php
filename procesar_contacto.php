<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Otras etiquetas head... -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Otras etiquetas head... -->
</head>

<body>
    <?php
    require_once('config/Conexion.php');

    // Obtener datos del formulario
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $message = $_POST['message'];

    // Crear una instancia de la clase Conexion
    $conexion = new Conexion();
    $conn = $conexion->ConectarDB();

    // Verificar la conexión
    if ($conn->connect_error) {
        die("Error de conexión: " . $conn->connect_error);
    }

    // Insertar datos en la base de datos
    $sql = "INSERT INTO contacto (nombreContacto, emailContacto, telefonoContacto, mensajeContacto) VALUES ('$name', '$email', '$phone', '$message')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>
            Swal.fire({
                title: '¡Formulario Enviado!',
                text: 'Gracias por contactarnos.',
                icon: 'success',
                confirmButtonText: 'Aceptar'
            }).then((result) => {
                // Redireccionar después de hacer clic en 'Aceptar'
                if (result.isConfirmed || result.isDismissed) {
                    window.location.href = 'index.php';
                }
            });
            </script>";
    } else {
        // Error al enviar el formulario
        echo "<script>
    Swal.fire({
        title: 'Error',
        text: 'Error al enviar el formulario: " . $conn->error . "',
        icon: 'error',
        confirmButtonText: 'Aceptar'
    }).then(() => {
        window.location.href = 'index.php';
    });
    </script>";
    }

    // Cerrar conexión
    $conn->close();
    ?>
</body>

</html>