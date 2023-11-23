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
        $nombreProducto = $_POST["nombreProducto"];
        $tipoProducto = $_POST["tipoProducto"];
        $unidadMedida = $_POST["unidadMedida"];
        $stockProducto = $_POST["stockProducto"];
        $estadoProducto = $_POST["estadoProducto"];
        $fechaDeVencimiento = $_POST["fechaDeVencimiento"];
        $precioProducto = $_POST["precioProducto"];
        $descripcionProducto = $_POST["descripcionProducto"];
        $imgProducto = $_POST["imgProducto"];
        $productoHabilitado = isset($_POST["productoHabilitado"]) ? 1 : 0;

        $conexion = new Conexion();
        $conn = $conexion->ConectarDB();

        $sql = "INSERT INTO producto (nombreProducto, tipoProducto, unidadMedida, stockProducto, estadoProducto, fechaDeVencimiento, precioProducto, descripcion_Producto, img_Producto, producto_habilitado)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssdssdssi", $nombreProducto, $tipoProducto, $unidadMedida, $stockProducto, $estadoProducto, $fechaDeVencimiento, $precioProducto, $descripcionProducto, $imgProducto, $productoHabilitado);

        if ($stmt->execute()) {
            // SweetAlert para mensaje de éxito
            echo "<script>
        Swal.fire({
            icon: 'success',
            title: 'Éxito',
            text: 'Producto insertado correctamente.',
        }).then(() => {
            window.location.href = 'pages/Productos.php';
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