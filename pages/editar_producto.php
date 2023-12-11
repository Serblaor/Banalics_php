<?php ob_start(); ?>
<?php include "layouts/head.php"; ?>
<?php
// Incluir archivos necesarios
require_once "../config/Conexion.php";

// Verificar si se envió el formulario (POST)
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    $idProducto = $_POST["idProducto"];
    $nombreProducto = $_POST["nombreProducto"];
    $tipoProducto = $_POST["tipoProducto"];
    $unidadMedida = $_POST["unidadMedida"];
    $stockProducto = $_POST["stockProducto"];
    $estadoProducto = $_POST["estadoProducto"];
    $fechaDeVencimiento = $_POST["fechaDeVencimiento"];
    $precioProducto = $_POST["precioProducto"];
    $descripcion_Producto = $_POST["descripcion_Producto"];
    $img_Producto = $_POST["img_Producto"];
    $producto_habilitado = $_POST["producto_habilitado"];

    // Actualizar los datos en la base de datos
    $conexion = new Conexion();
    $conn = $conexion->ConectarDB();

    $sql = "UPDATE producto
    SET nombreProducto = ?, tipoProducto = ?, unidadMedida = ?, stockProducto = ?, estadoProducto = ?, fechaDeVencimiento = ?, precioProducto = ?, descripcion_Producto = ?, img_Producto = ?, producto_habilitado = ?
    WHERE idProducto = ?";

$stmt = $conn->prepare($sql);
$stmt->bind_param("sssssdssssi", $nombreProducto, $tipoProducto, $unidadMedida, $stockProducto, $estadoProducto, $fechaDeVencimiento, $precioProducto, $descripcion_Producto, $img_Producto, $producto_habilitado, $idProducto);


    if ($stmt->execute()) {
        // Si la actualización es exitosa, muestra SweetAlert y redirige después de unos segundos
        echo "<script>
            Swal.fire({
                title: '¡Éxito!',
                text: 'Producto actualizado correctamente',
                icon: 'success',
                timer: 3000, // 3 segundos
                showConfirmButton: false
            }).then(function() {
                window.location.href = 'Productos.php'; // Redirige después de cerrar SweetAlert
            });
        </script>";
        exit();
    } else {
        // Si hay un error, muestra SweetAlert de error
        echo "<script>
            Swal.fire({
                title: 'Error',
                text: 'Error al actualizar el producto',
                icon: 'error'
            });
        </script>";
    }

    $stmt->close();
    $conn->close();
}

// Obtener el ID del producto a editar desde la URL
if (isset($_GET["idProducto"])) {
    $idProducto = $_GET["idProducto"];

    // Obtener los datos del producto desde la base de datos
    $conexion = new Conexion();
    $conn = $conexion->ConectarDB();

    $sql = "SELECT * FROM producto WHERE idProducto = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $idProducto);
    $stmt->execute();
    $result = $stmt->get_result();

    // Verificar si se encontraron datos
    if ($result->num_rows > 0) {
        $producto = $result->fetch_assoc();
        // Extraer los datos del producto para prellenar el formulario
        $nombreProducto = $producto["nombreProducto"];
        $tipoProducto = $producto["tipoProducto"];
        $unidadMedida = $producto["unidadMedida"];
        $stockProducto = $producto["stockProducto"];
        $estadoProducto = $producto["estadoProducto"];
        $fechaDeVencimiento = $producto["fechaDeVencimiento"];
        $precioProducto = $producto["precioProducto"];
        $descripcion_Producto = $producto["descripcion_Producto"];
        $img_Producto = $producto["img_Producto"];
        $producto_habilitado = $producto["producto_habilitado"];
    } else {
        // Manejar el caso en que no se encuentren datos del producto
        echo "Producto no encontrado.";
        exit();
    }

    $stmt->close();
    $conn->close();
} else {
    // Si no se proporcionó el ID del producto a editar, redirigir o manejar según sea necesario
    echo "ID de producto no proporcionado.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../../css/pages/productos.css">
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
            <h2>Editar Producto</h2>
            <form method="POST" action="">
                <!-- Agrega campos del formulario según sea necesario -->
                <input type="hidden" name="idProducto" value="<?php echo $idProducto; ?>">
                <label for="nombreProducto">Nombre del Producto:</label>
                <input type="text" name="nombreProducto" value="<?php echo $nombreProducto; ?>" required>
                <br />
                <label for="tipoProducto">Tipo de Producto:</label>
                <select name="tipoProducto" required>
                    <option value="Perecederos" <?php echo ($tipoProducto == "Perecederos") ? "selected" : ""; ?>>Perecederos</option>
                    <option value="No_Perecederos" <?php echo ($tipoProducto == "No_Perecederos") ? "selected" : ""; ?>>No Perecederos</option>
                    <option value="Electrodomesticos" <?php echo ($tipoProducto == "Electrodomesticos") ? "selected" : ""; ?>>Electrodomésticos</option>
                    <option value="Tecnologia" <?php echo ($tipoProducto == "Tecnologia") ? "selected" : ""; ?>>Tecnología</option>
                    <option value="Textil" <?php echo ($tipoProducto == "Textil") ? "selected" : ""; ?>>Textil</option>
                </select>
                <br />
                <label for="unidadMedida">Unidad de Medida:</label>
                <select name="unidadMedida" required>
                    <option value="Libra" <?php echo ($unidadMedida == "Libra") ? "selected" : ""; ?>>Libra</option>
                    <option value="Kilo" <?php echo ($unidadMedida == "Kilo") ? "selected" : ""; ?>>Kilo</option>
                    <option value="Bulto" <?php echo ($unidadMedida == "Bulto") ? "selected" : ""; ?>>Bulto</option>
                    <option value="Unidad" <?php echo ($unidadMedida == "Unidad") ? "selected" : ""; ?>>Unidad</option>
                    <option value="Litro" <?php echo ($unidadMedida == "Litro") ? "selected" : ""; ?>>Litro</option>
                </select>
                <br />
                <label for="stockProducto">Stock:</label>
                <input type="number" name="stockProducto" value="<?php echo $stockProducto; ?>" required>
                <br />
                <label for="estadoProducto">Estado:</label>
                <select name="estadoProducto" required>
                    <option value="Activo" <?php echo ($estadoProducto == "Activo") ? "selected" : ""; ?>>Activo</option>
                    <option value="Inactivo" <?php echo ($estadoProducto == "Inactivo") ? "selected" : ""; ?>>Inactivo</option>
                </select>
                <br />
                <label for="fechaDeVencimiento">Fecha de Vencimiento:</label>
<input type="date" name="fechaDeVencimiento" value="<?php echo date('Y-m-d', strtotime($fechaDeVencimiento)); ?>" required>

                <br />
                <label for="precioProducto">Precio:</label>
                <input type="number" name="precioProducto" value="<?php echo $precioProducto; ?>" required>
                <br />
                <label for="descripcion_Producto">Descripción del Producto:</label>
                <textarea name="descripcion_Producto" required><?php echo $descripcion_Producto; ?></textarea>
                <br />
                <label for="img_Producto">URL de la Imagen:</label>
                <input type="text" name="img_Producto" value="<?php echo $img_Producto; ?>" required>
                <br />
                <label for="producto_habilitado">Producto Habilitado:</label>
                <select name="producto_habilitado" required>
                    <option value="1" <?php echo ($producto_habilitado == 1) ? "selected" : ""; ?>>Sí</option>
                    <option value="0" <?php echo ($producto_habilitado == 0) ? "selected" : ""; ?>>No</option>
                </select>
                <br />
                <button type="submit">Guardar Cambios</button>
                <a href="Productos.php" class="btn btn-secondary">Volver a la Lista de Productos</a>
            </form>
        </div>
    </div>
</body>

</html>
<?php ob_end_flush(); ?>
<?php include "layouts/main_scripts.php"; ?>
<?php include "layouts/footer.php"; ?>
