<?php ob_start(); ?>
<?php include "layouts/head.php"; ?>
<?php
// Incluir archivos necesarios
require_once "../config/Conexion.php";

// Verificar si se envió el formulario (POST)
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    $idUsuario = $_POST["idUsuario"];
    $tipoDocumento = $_POST["tipoDocumento"];
    $documentoUsuario = $_POST["documentoUsuario"];
    $nombresUsuario = $_POST["nombresUsuario"];
    $apellidosUsuario = $_POST["apellidosUsuario"];
    $telefonoUsuario = $_POST["telefonoUsuario"];
    $correoUsuario = $_POST["correoUsuario"];
    $estadoUsuario = $_POST["estadoUsuario"];
    $imgUsuario = $_POST["imgUsuario"];
    $idRol = $_POST["idRol"];
    $idEmpresa = $_POST["idEmpresa"];
    // Agrega aquí los demás campos del formulario

    // Validar los datos según sea necesario

    // Actualizar los datos en la base de datos
    $conexion = new Conexion();
    $conn = $conexion->ConectarDB();

    $sql = "UPDATE usuario
    SET tipoDocumento = ?, documentoUsuario = ?, nombresUsuario = ?, apellidosUsuario = ?, telefonoUsuario = ?, correoUsuario = ?, estadoUsuario = ?, imgUsuario = ?, ROL_idRol = ?, empresa_idEmpresa = ?
    -- Agrega aquí la actualización de los demás campos del formulario
    WHERE idUsuario = ?";


    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssssssiii", $tipoDocumento, $documentoUsuario, $nombresUsuario, $apellidosUsuario, $telefonoUsuario, $correoUsuario, $estadoUsuario, $imgUsuario, $idRol, $idEmpresa, $idUsuario);


    if ($stmt->execute()) {
        // Si la actualización es exitosa, muestra SweetAlert y redirige después de unos segundos
        echo "<script>
            Swal.fire({
                title: '¡Éxito!',
                text: 'Usuario actualizado correctamente',
                icon: 'success',
                timer: 3000, // 3 segundos
                showConfirmButton: false
            }).then(function() {
                window.location.href = 'Usuarios.php'; // Redirige después de cerrar SweetAlert
            });
        </script>";
        exit();
    } else {
        // Si hay un error, muestra SweetAlert de error
        echo "<script>
            Swal.fire({
                title: 'Error',
                text: 'Error al actualizar el usuario',
                icon: 'error'
            });
        </script>";
    }
    

    $stmt->close();
    $conn->close();
}

// Obtener el ID del usuario a editar desde la URL
if (isset($_GET["idUsuario"])) {
    $idUsuario = $_GET["idUsuario"];

    // Obtener los datos del usuario desde la base de datos
    $conexion = new Conexion();
    $conn = $conexion->ConectarDB();

    $sql = "SELECT * FROM usuario WHERE idUsuario = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $idUsuario);
    $stmt->execute();
    $result = $stmt->get_result();

    // Verificar si se encontraron datos
    if ($result->num_rows > 0) {
        $usuario = $result->fetch_assoc();
        // Extraer los datos del usuario para prellenar el formulario
        $tipoDocumento = $usuario["tipoDocumento"];
        $documentoUsuario = $usuario["documentoUsuario"];
        $nombresUsuario = $usuario["nombresUsuario"];
        $apellidosUsuario = $usuario["apellidosUsuario"];
        $telefonoUsuario = $usuario["telefonoUsuario"];
        $correoUsuario = $usuario["correoUsuario"];
        $estadoUsuario = $usuario["estadoUsuario"];
        $imgUsuario = $usuario["imgUsuario"];
        $idRol = $usuario["ROL_idRol"];
        $idEmpresa = $usuario["empresa_idEmpresa"];
    } else {
        // Manejar el caso en que no se encuentren datos del usuario
        echo "Usuario no encontrado.";
        exit();
    }

    $stmt->close();
    $conn->close();
} else {
    // Si no se proporcionó el ID del usuario a editar, redirigir o manejar según sea necesario
    echo "ID de usuario no proporcionado.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../../css/pages/usuarios.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        .app-content {
    max-width: 600px;
    margin: 0 auto;
}

form {
    margin-top: 20px;
}

label {
    display: block;
    margin-bottom: 5px;
}

input,
select {
    width: 100%;
    padding: 8px;
    margin-bottom: 10px;
    box-sizing: border-box;
}

button {
    background-color: #4caf50;
    color: white;
    padding: 10px;
    border: none;
    cursor: pointer;
}

button:hover {
    background-color: #45a049;
}
    </style>
</head>

<body>
    <div class="app-content content container-fluid">
    <div class="content-wrapper">
        <h2>Editar Usuario</h2>
        <form method="POST" action="">
            <!-- Agrega campos del formulario según sea necesario -->
            <input type="hidden" name="idUsuario" value="<?php echo $idUsuario; ?>">
            <label for="tipoDocumento">Tipo Documento:</label>
            <select name="tipoDocumento" required>
                <option value="CC" <?php echo ($tipoDocumento == "CC") ? "selected" : ""; ?>>Cédula de Ciudadanía</option>
                <option value="CE" <?php echo ($tipoDocumento == "CE") ? "selected" : ""; ?>>Cédula de Extranjería</option>
            </select>
            <br />
            <label for="documentoUsuario">Documento:</label>
            <input type="text" name="documentoUsuario" value="<?php echo $documentoUsuario; ?>" required>
            <br />
            <label for="nombresUsuario">Nombres:</label>
            <input type="text" name="nombresUsuario" value="<?php echo $nombresUsuario; ?>" required>
            <br />
            <label for="apellidosUsuario">Apellidos:</label>
            <input type="text" name="apellidosUsuario" value="<?php echo $apellidosUsuario; ?>" required>
            <br />
            <label for="telefonoUsuario">Teléfono:</label>
            <input type="text" name="telefonoUsuario" value="<?php echo $telefonoUsuario; ?>" required>
            <br />
            <label for="correoUsuario">Correo Electrónico:</label>
            <input type="email" name="correoUsuario" value="<?php echo $correoUsuario; ?>" required>
            <br />
            <label for="estadoUsuario" >Estado:</label>
                    <select name="estadoUsuario" required>
                        <option value="Activo"<?php echo ($estadoUsuario == "Activo") ? "selected" : ""; ?>>Activo</option>
                        <option value="Activo"<?php echo ($estadoUsuario == "Inactivo") ? "selected" : ""; ?>>Inactivo</option>
                    </select>
            <br />
            <label for="imgUsuario">URL de la Imagen:</label>
                    <input type="text" id="imgUsuario" name="imgUsuario"
                        value="<?php echo $imgUsuario; ?>"
                        required>
            <br />
            <label for="idRol">Rol:</label>
                    <!-- Agrega opciones de roles según tu base de datos -->
                    <select class="form-select" id="idRol" name="idRol" required>
                        <option value="1"<?php echo ($idRol == "1") ? "selected" : ""; ?>>Empresario</option>
                        <option value="2"<?php echo ($idRol == "2") ? "selected" : ""; ?>>Donante</option>
                        <option value="3"<?php echo ($idRol == "3") ? "selected" : ""; ?>>Beneficiario</option>
                        <option value="4"<?php echo ($idRol == "4") ? "selected" : ""; ?>>Operador</option>
                        <option value="5"<?php echo ($idRol == "5") ? "selected" : ""; ?>>Admin</option>
                        <option value="6"<?php echo ($idRol == "6") ? "selected" : ""; ?>>Comprador</option>
                    </select>
                        <br />
                        <label for="idEmpresa" class="form-label">Empresa:</label>
                    <select id="idEmpresa" name="idEmpresa" required>
                        <option value="1"<?php echo ($idEmpresa == "1") ? "selected" : ""; ?>>ALIMENTOS SAS</option>
                        <option value="2"<?php echo ($idEmpresa == "2") ? "selected" : ""; ?>>ALIMENTOS JORDAN</option>
                        <option value="3"<?php echo ($idEmpresa == "3") ? "selected" : ""; ?>>NO APLICA</option>
                        <option value="4"<?php echo ($idEmpresa == "4") ? "selected" : ""; ?>>ABC Company</option>
                        <option value="5"<?php echo ($idEmpresa == "5") ? "selected" : ""; ?>>AMARA SA</option>
                        <option value="6"<?php echo ($idEmpresa == "6") ? "selected" : ""; ?>>KAYMOC</option>
                        <option value="7"<?php echo ($idEmpresa == "7") ? "selected" : ""; ?>>DUCH</option>
                        <option value="8"<?php echo ($idEmpresa == "8") ? "selected" : ""; ?>>KANGRY</option>
                        <option value="9"<?php echo ($idEmpresa == "9") ? "selected" : ""; ?>>OSTE</option>
                        <option value="10"<?php echo ($idEmpresa == "10") ? "selected" : ""; ?>>BANALICS</option>
                    </select>
                        <br />
            <button type="submit">Guardar Cambios</button>
            <a href="Usuarios.php" class="btn btn-secondary">Volver a la Lista de Usuarios</a>
        </form>
    </div>
    </div>
</body>

</html>
<?php ob_end_flush(); ?>
<?php include "layouts/main_scripts.php"; ?>
<?php include "layouts/footer.php"; ?>


