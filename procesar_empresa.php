<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>

<body>
    <?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    require_once "config/Conexion.php";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $documentoEmpresa = $_POST["documentoEmpresa"];
        $razonSocial = $_POST["razonSocial"];
        $telefonoEmpresa = $_POST["telefonoEmpresa"];
        $direccionEmpresa = $_POST["direccionEmpresa"];
        $estadoEmpresa = $_POST["estadoEmpresa"];

        $conexion = new Conexion();
        $conn = $conexion->ConectarDB();

        $sql = "INSERT INTO empresa (documentoEmpresa, razonSocial, telefonoEmpresa, direccionEmpresa, estadoEmpresa)
            VALUES (?, ?, ?, ?, ?)";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssss", $documentoEmpresa, $razonSocial, $telefonoEmpresa, $direccionEmpresa, $estadoEmpresa);

        if ($stmt->execute()) {
            // SweetAlert para mensaje de éxito
            echo "<script>
        Swal.fire({
            icon: 'success',
            title: 'Éxito',
            text: 'EMpresa insertado correctamente.',
        }).then(() => {
            window.location.href = 'pages/Empresas.php';
        });
    </script>";
        } else {
            // SweetAlert para mensaje de error
            echo "<script>
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Error al insertar el producto: {$stmt->error}',
                });
            </script>";
        }

        $stmt->close();
        $conn->close();
    }
    ?>

</body>

</html>