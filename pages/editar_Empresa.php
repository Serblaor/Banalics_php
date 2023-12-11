<?php ob_start(); ?>
<?php include "layouts/head.php"; ?>
<?php
// Incluir archivos necesarios
require_once "../config/Conexion.php";

// Verificar si se envió el formulario (POST)
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    $idEmpresa = $_POST["idEmpresa"];
    $tipoDocumento = $_POST["tipoDocumento"];
    $documentoEmpresa = $_POST["documentoEmpresa"];
    $nombresEmpresa = $_POST["nombresEmpresa"];
    $apellidosEmpresa = $_POST["apellidosEmpresa"];
    $telefonoEmpresa = $_POST["telefonoEmpresa"];
    $correoEmpresa = $_POST["correoEmpresa"];
    $estadoEmpresa = $_POST["estadoEmpresa"];
    $imgEmpresa = $_POST["imgEmpresa"];
    $idRol = $_POST["idRol"];
    $idEmpresa = $_POST["idEmpresa"];
    // Agrega aquí los demás campos del formulario

    // Validar los datos según sea necesario

    // Actualizar los datos en la base de datos
    $conexion = new Conexion();
    $conn = $conexion->ConectarDB();

    $sql = "UPDATE empresa
    SET tipoDocumento = ?, documentoEmpresa = ?, nombresEmpresa = ?, apellidosEmpresa = ?, telefonoEmpresa = ?, correoEmpresa = ?, estadoEmpresa = ?, imgEmpresa = ?, ROL_idRol = ?, empresa_idEmpresa = ?
    -- Agrega aquí la actualización de los demás campos del formulario
    WHERE idEmpresa = ?";


    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssssssiii", $tipoDocumento, $documentoEmpresa, $nombresEmpresa, $apellidosEmpresa, $telefonoEmpresa, $correoEmpresa, $estadoEmpresa, $imgEmpresa, $idRol, $idEmpresa, $idEmpresa);


    if ($stmt->execute()) {
        // Si la actualización es exitosa, muestra SweetAlert y redirige después de unos segundos
        echo "<script>
            Swal.fire({
                title: '¡Éxito!',
                text: 'Empresa actualizado correctamente',
                icon: 'success',
                timer: 3000, // 3 segundos
                showConfirmButton: false
            }).then(function() {
                window.location.href = 'Empresas.php'; // Redirige después de cerrar SweetAlert
            });
        </script>";
        exit();
    } else {
        // Si hay un error, muestra SweetAlert de error
        echo "<script>
            Swal.fire({
                title: 'Error',
                text: 'Error al actualizar el Empresa',
                icon: 'error'
            });
        </script>";
    }
    

    $stmt->close();
    $conn->close();
}

// Obtener el ID del Empresa a editar desde la URL
if (isset($_GET["idEmpresa"])) {
    $idEmpresa = $_GET["idEmpresa"];

    // Obtener los datos del Empresa desde la base de datos
    $conexion = new Conexion();
    $conn = $conexion->ConectarDB();

    $sql = "SELECT * FROM empresa WHERE idEmpresa = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $idEmpresa);
    $stmt->execute();
    $result = $stmt->get_result();

    // Verificar si se encontraron datos
    if ($result->num_rows > 0) {
        $Empresa = $result->fetch_assoc();
        // Extraer los datos del Empresa para prellenar el formulario
        $tipoDocumento = $Empresa["tipoDocumento"];
        $documentoEmpresa = $Empresa["documentoEmpresa"];
        $nombresEmpresa = $Empresa["nombresEmpresa"];
        $apellidosEmpresa = $Empresa["apellidosEmpresa"];
        $telefonoEmpresa = $Empresa["telefonoEmpresa"];
        $correoEmpresa = $Empresa["correoEmpresa"];
        $estadoEmpresa = $Empresa["estadoEmpresa"];
        $imgEmpresa = $Empresa["imgEmpresa"];
        $idRol = $Empresa["ROL_idRol"];
        $idEmpresa = $Empresa["empresa_idEmpresa"];
    } else {
        // Manejar el caso en que no se encuentren datos del Empresa
        echo "Empresa no encontrado.";
        exit();
    }

    $stmt->close();
    $conn->close();
} else {
    // Si no se proporcionó el ID del Empresa a editar, redirigir o manejar según sea necesario
    echo "ID de Empresa no proporcionado.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../../css/pages/Empresas.css">
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
        <br />
        <br />
        <h2>Editar Empresa</h2>
        <form method="POST" action="">
            <!-- Agrega campos del formulario según sea necesario -->
            <input type="hidden" name="idEmpresa" value="<?php echo $idEmpresa; ?>">
            <label for="tipoDocumento">Tipo Documento:</label>
            <select name="tipoDocumento" required>
                <option value="CC" <?php echo ($tipoDocumento == "CC") ? "selected" : ""; ?>>Cédula de Ciudadanía</option>
                <option value="CE" <?php echo ($tipoDocumento == "CE") ? "selected" : ""; ?>>Cédula de Extranjería</option>
            </select>
            <br />
            <label for="documentoEmpresa">Documento:</label>
            <input type="text" name="documentoEmpresa" value="<?php echo $documentoEmpresa; ?>" required>
            <br />
            <label for="nombresEmpresa">Nombres:</label>
            <input type="text" name="razonSocial" value="<?php echo $nombresEmpresa; ?>" required>
            <br />
            <label for="telefonoEmpresa">Teléfono:</label>
            <input type="text" name="telefonoEmpresa" value="<?php echo $telefonoEmpresa; ?>" required>
            <br />
            <label for="estadoEmpresa" >Estado:</label>
                    <select name="estadoEmpresa" required>
                        <option value="Activo"<?php echo ($estadoEmpresa == "Activo") ? "selected" : ""; ?>>Activo</option>
                        <option value="Activo"<?php echo ($estadoEmpresa == "Inactivo") ? "selected" : ""; ?>>Inactivo</option>
                    </select>
            <br />
                        <br />
                        <br />
            <button type="submit">Guardar Cambios</button>
        </form>
    </div>
</body>

</html>
<?php ob_end_flush(); ?>
<?php include "layouts/main_scripts.php"; ?>
<?php include "layouts/footer.php"; ?>


