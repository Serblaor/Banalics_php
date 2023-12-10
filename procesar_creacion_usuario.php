<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Usuario</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.5/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.5/dist/sweetalert2.min.js"></script>
</head>
<body>

<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once "config/Conexion.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $tipoDocumento = $_POST["tipoDocumento"];
    $documentoUsuario = $_POST["documentoUsuario"];
    $nombresUsuario = $_POST["nombresUsuario"];
    $apellidosUsuario = $_POST["apellidosUsuario"];
    $telefonoUsuario = $_POST["telefonoUsuario"];
    $correoUsuario = $_POST["correoUsuario"];
    $passwordUsuario = password_hash($_POST["passwordUsuario"], PASSWORD_DEFAULT);
    $estadoUsuario = $_POST["estadoUsuario"];
    $imgUsuario = $_POST["imgUsuario"];
    $idRol = $_POST["idRol"];
    $idEmpresa = $_POST["idEmpresa"];

    $conexion = new Conexion();
    $conn = $conexion->ConectarDB();

    // Verificar si el correo ya existe en la base de datos
    $sqlVerificacion = "SELECT COUNT(*) AS count FROM usuario WHERE correoUsuario = ?";
    $stmtVerificacion = $conn->prepare($sqlVerificacion);

    if (!$stmtVerificacion) {
        // Manejar el error de la preparación de la consulta
        die('Error en la preparación de la consulta: ' . $conn->error);
    }

    $stmtVerificacion->bind_param("s", $correoUsuario);
    $stmtVerificacion->execute();
    $resultVerificacion = $stmtVerificacion->get_result();
    $rowVerificacion = $resultVerificacion->fetch_assoc();
    $countVerificacion = $rowVerificacion['count'];

    if ($countVerificacion > 0) {
        // SweetAlert para mensaje de error si el correo ya existe
        echo "<script>
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'El correo electrónico ya está registrado.',
            }).then(() => {
                window.location.href = 'pages/crear_usuario.php';
            });
        </script>";
        exit(); // Detener la ejecución del script
    }

    // Sentencia SQL para insertar el nuevo usuario
    $sqlInsercion = "INSERT INTO usuario (tipoDocumento, documentoUsuario, nombresUsuario, apellidosUsuario, telefonoUsuario, correoUsuario, passwordUsuario, estadoUsuario, imgUsuario, ROL_idRol, empresa_idEmpresa)
                    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    
    $stmtInsercion = $conn->prepare($sqlInsercion);
    
    if (!$stmtInsercion) {
        // Manejar el error de la preparación de la consulta
        die('Error en la preparación de la consulta: ' . $conn->error);
    }

    $stmtInsercion->bind_param("ssssssssssi", $tipoDocumento, $documentoUsuario, $nombresUsuario, $apellidosUsuario, $telefonoUsuario, $correoUsuario, $passwordUsuario, $estadoUsuario, $imgUsuario, $idRol, $idEmpresa);

    if ($stmtInsercion->execute()) {
        // SweetAlert para mensaje de éxito
        echo "<script>
            Swal.fire({
                icon: 'success',
                title: 'Éxito',
                text: 'Usuario creado correctamente.',
            }).then(() => {
                window.location.href = 'pages/Usuarios.php';
            });
        </script>";
    } else {
        // SweetAlert para mensaje de error al insertar
        echo "<script>
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Error al crear usuario: {$stmtInsercion->error}',
            });
        </script>";
    }

    $stmtVerificacion->close();
    $stmtInsercion->close();
    $conn->close();
}
?>
</body>
</html>
