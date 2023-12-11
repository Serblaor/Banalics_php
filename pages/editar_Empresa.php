<?php ob_start(); ?>
<?php include "layouts/head.php"; ?>
<?php
// Incluir archivos necesarios
require_once "../config/Conexion.php";

// Verificar si se envió el formulario (POST)
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    $idEmpresa = $_POST["idEmpresa"];
    $documentoEmpresa = $_POST["documentoEmpresa"];
    $razonSocial = $_POST["razonSocial"];
    $telefonoEmpresa = $_POST["telefonoEmpresa"];
    $direccionEmpresa = $_POST["direccionEmpresa"];
    $estadoEmpresa = $_POST["estadoEmpresa"];


    // Validar los datos según sea necesario

    // Actualizar los datos en la base de datos
    $conexion = new Conexion();
    $conn = $conexion->ConectarDB();

    $sql = "UPDATE empresa
    SET  documentoEmpresa = ?, razonSocial = ?, telefonoEmpresa = ?, direccionEmpresa = ?, estadoEmpresa = ?
    -- Agrega aquí la actualización de los demás campos del formulario
    WHERE idEmpresa = ?";


    $stmt = $conn->prepare("UPDATE empresa SET razonSocial=?, telefonoEmpresa=?, direccionEmpresa=?, estadoEmpresa=? WHERE idEmpresa=?");
    $stmt->bind_param("sssss", $razonSocial, $telefonoEmpresa, $direccionEmpresa, $estadoEmpresa, $idEmpresa);



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

        $documentoEmpresa = $Empresa["documentoEmpresa"];
        $razonSocial = $Empresa["razonSocial"];
        $telefonoEmpresa = $Empresa["telefonoEmpresa"];
        $direccionEmpresa = $Empresa["direccionEmpresa"];
        $estadoEmpresa = $Empresa["estadoEmpresa"];
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
 body {
    font-family: 'Arial', sans-serif;
    background-color: #f2f2f2;
    margin: 0;
    height: 100vh;
}

.app-content {
    padding: 20px;
}

.content-wrapper {
    background-color: #fff;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    padding: 20px;
    height: 88vh;
}

form {
    max-width: 600px;
    margin: 0 auto;
}

label {
    display: block;
    margin-top: 10px;
}

input,
select,
textarea {
    width: 100%;
    padding: 10px;
    margin-top: 5px;
    margin-bottom: 15px;
    box-sizing: border-box;
    border: 1px solid #ccc;
    border-radius: 4px;
}

select {
    appearance: none;
}

button {
    background-color: #4caf50;
    color: white;
    padding: 10px 15px;
    border: none;
    border-radius: 4px;
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
        <h2>Editar Empresa</h2>
        <form method="POST" action="">
            <input type="hidden" name="idEmpresa" value="<?php echo $idEmpresa; ?>">
            <label for="documentoEmpresa">Documento:</label>
            <input type="text" name="documentoEmpresa" value="<?php echo $documentoEmpresa; ?>" required>
            <label for="razonSocial">Nombres:</label>
            <input type="text" name="razonSocial" value="<?php echo $razonSocial; ?>" required>
            <label for="telefonoEmpresa">Teléfono:</label>
            <input type="number" name="telefonoEmpresa" value="<?php echo $telefonoEmpresa; ?>" required>
            <label for="direccionEmpresa">Dirección:</label>
            <input type="text" name="direccionEmpresa" value="<?php echo $direccionEmpresa; ?>" required>
            <label for="estadoEmpresa">Estado:</label>
            <select name="estadoEmpresa" required>
                <option value="Activo" <?php echo ($estadoEmpresa == "Activo") ? "selected" : ""; ?>>Activo</option>
                <option value="Inactivo" <?php echo ($estadoEmpresa == "Inactivo") ? "selected" : ""; ?>>Inactivo</option>
            </select>
            <div class="col-6 mx-auto text-center">
                <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                <a href="Empresas.php" class="btn btn-secondary">Volver a la Lista de Empresas</a>
            </div>

        </form>
    </div>
    </div>
</body>

</html>
<?php ob_end_flush(); ?>
<?php include "layouts/main_scripts.php"; ?>
<?php include "layouts/footer.php"; ?>