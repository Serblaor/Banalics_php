<!-- carrito.php -->
<?php
// Inicia la sesión
session_start();

// Verifica si el usuario está autenticado
$usuarioAutenticado = isset($_SESSION['idUsuario']);

// Obtén el nombre de usuario y la imagen si está autenticado
$nombreUsuario = $usuarioAutenticado ? $_SESSION['nombresUsuario'] : '';
$imagenUsuario = $usuarioAutenticado ? $_SESSION['imgUsuario'] : '';

// Función para obtener el precio del producto desde la base de datos (ajusta según tu estructura)
function obtenerPrecioProducto($idProducto) {
    // Realiza la consulta para obtener el precio del producto según su ID
    $conexion = new Conexion();
    $conn = $conexion->ConectarDB();

    $stmt = $conn->prepare("SELECT precioProducto FROM producto WHERE idProducto = ?");
    $stmt->bind_param("i", $idProducto);
    $stmt->execute();
    $stmt->bind_result($precioProducto);
    $stmt->fetch();
    $stmt->close();

    $conn->close();

    return $precioProducto;
}

// Verifica si se recibió el ID del producto
if (isset($_POST['idProducto'])) {
    $idProducto = $_POST['idProducto'];
    $cantidad = $_POST['cantidad'];
    $precioTotal = $_POST['precioTotal'];

    // Verifica si el ID del producto no está vacío y es un número entero
    if (is_numeric($idProducto) && $idProducto > 0) {

        if (!isset($_SESSION['carrito'])) {
            $_SESSION['carrito'] = [];
        }

        // Verifica si el producto ya está en el carrito
        if (!in_array($idProducto, $_SESSION['carrito'])) {
            $_SESSION['carrito'][] = $idProducto;
            echo "Producto agregado al carrito con ID: " . $idProducto;
        } else {
            echo "El producto ya está en el carrito.";
        }
    } else {
        echo "Error: ID de producto no válido.";
    }
} else {
    echo "";
}

// Verifica si hay productos en el carrito
if (!empty($_SESSION['carrito'])) {
    // Conecta con la base de datos
    include_once '../config/Conexion.php';
    $conexion = new Conexion();
    $conn = $conexion->ConectarDB();

    // Prepara la consulta SQL para insertar productos en la tabla carrito
    $stmt = $conn->prepare("INSERT INTO carrito (idUsuario, idProducto, cantidad, precioTotal) VALUES (?, ?, ?, ?)");

    // Obtiene el ID de usuario de la sesión (ajusta según tu lógica de autenticación)
    $idUsuario = isset($_SESSION['idUsuario']) ? $_SESSION['idUsuario'] : null;

    // Itera sobre los productos en el carrito y realiza la inserción en la base de datos
    foreach ($_SESSION['carrito'] as $idProducto) {
        // Simplemente, por cada producto, inserta un registro en la tabla carrito con los valores correspondientes
        $cantidad = $_POST['cantidad'];;  // Puedes ajustar esto según tus necesidades
        $precioTotal = $_POST['precioTotal'];  // Implementa tu propia función para obtener el precio del producto

        // Vincula los parámetros y ejecuta la consulta
        $stmt->bind_param("iiid", $idUsuario, $idProducto, $cantidad, $precioTotal);
        $stmt->execute();
    }

    // Cierra la conexión y libera los recursos
    $stmt->close();
    $conn->close();

    // Limpia el carrito después de la inserción en la base de datos (puedes ajustar según tus necesidades)
    unset($_SESSION['carrito']);
}
?>




<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrito de Compras</title>
    <link rel="shortcut icon" type="image/x-icon" href="../../app-assets/images/ico/LogoBanalics.png">
<link rel="shortcut icon" type="image/png" href="../../app-assets/images/ico/LogoBanalics.png">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css"
    integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous" />
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
    integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
    crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <style>
        /* Estilos generales para la barra de navegación */
    .navbar {
        background: linear-gradient(270deg, #052e4c, #020304);
        padding: 10px 0;
        /* Espacio interno */
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    /* Estilos para el logotipo */
    .logo-nav {
        width: 100px;
        height: 60px;
    }

    /* Estilos para el botón de hamburguesa */
    .navbar-toggler {
        background-color: transparent;
        border: none;
        cursor: pointer;
        outline: none;
        padding: 10px;
    }

    .navbar-toggler-icon {
        background: linear-gradient(270deg, #052e4c, #020304);
        width: 30px;
        height: 3px;
        display: block;
        border-radius: 3px;
    }

    /* Estilos para la lista de navegación en pantalla grande */
    .navbar-menu {
        display: flex;
        align-items: center;
    }

    .navbar-menu ul {
        list-style: none;
        margin: 0;
        padding: 0;
        display: flex;
    }

    .navbar-menu ul li {
        margin: 0 15px;
        /* Espacio entre elementos de navegación */
    }

    .navbar-link {
        text-decoration: none;
        color: #fff;
        font-size: 16px;
        transition: color 0.3s ease;
    }

    .navbar-link:hover {
        color: #2a325f;
        /* Cambia de color al pasar el mouse */
    }
    .user-info {
        display: flex;
        align-items: center;
        margin-right: 15px;
    }

    .user-info img {
        width: 30px;
        height: 30px;
        border-radius: 50%;
        margin-right: 10px;
    }
    .user-info span{
        color: #fff;
    }
    
    #productos {
    display: flex;
    flex-wrap: wrap;
    justify-content: space-around;
}
        /* Agrega estilos según tus preferencias */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        @media screen and (max-width: 768px) {
        .navbar-menu {
            display: none;
            flex-direction: column;
            position: absolute;
            top: 70px;
            left: 0;
            background: linear-gradient(270deg, #052e4c, #020304);
            width: 100%;
            text-align: center;
            z-index: 10;
        }

        .navbar-menu.show-menu {
            display: flex;
        }

        .navbar-menu ul li {
            margin: 15px 0;
            /* Espacio entre elementos de navegación */
        }
    }
    </style>
    
</head>

<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="../index.php">
            <img src="../app-assets/images/ico/LogoBanalics.png" alt="Logo" class="logo-nav" width="100">
        </a>
        <button class="navbar-toggler" type="button" aria-label="Toggle navigation" id="btn-menu">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="navbar-menu">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="../index.php"><i class="fas fa-home"></i>Inicio</a>
                </li>
                <?php if ($usuarioAutenticado): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="ProductosUser.php"><i class="fas fa-store"></i>Productos</a>
                    </li>
                    <li class="nav-item">
                        <div class="user-info">
                            <img src="<?php echo $imagenUsuario; ?>" alt="Foto de perfil">
                            <span>
                                <?php echo "Hola, $nombreUsuario!"; ?>
                            </span>
                        </div>
                    </li>
                <?php else: ?>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>

<!-- Mostrar lista de productos en el carrito -->
<h2>Carrito de Compras</h2>


<table>
    <thead>
        <tr>
            <th>ID Producto</th>
            <th>Nombre Producto</th>
            <th>Cantidad</th>
            <th>Precio Total</th>
            <th>Fecha Agregado</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php
        // Realiza la lógica para obtener información del carrito desde la base de datos
        include_once '../config/Conexion.php';
        $conexion = new Conexion();
        $conn = $conexion->ConectarDB();

        // Sustituye 'tu_tabla_carrito' con el nombre real de tu tabla de carrito
        $sql = "SELECT c.idProducto, p.nombreProducto, c.cantidad, c.precioTotal, c.fechaAgregado, c.idCarrito
        FROM carrito c
        INNER JOIN producto p ON c.idProducto = p.idProducto";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['idProducto'] . "</td>";
                echo "<td>" . $row['nombreProducto'] . "</td>";
                echo "<td>" . $row['cantidad'] . "</td>";
                echo "<td>$" . $row['precioTotal'] . "</td>";
                echo "<td>" . $row['fechaAgregado'] . "</td>";
                echo "<td>";
                echo "<button onclick='comprar(" . $row['idProducto'] . ")'>Comprar</button>";
                echo "<button onclick='eliminarDelCarrito(" . $row['idCarrito'] . ")'>Eliminar</button>";
                echo "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='6'>El carrito está vacío</td></tr>";
        }

        // Cierra la conexión
        $conn->close();
        ?>
    </tbody>


<!-- Script para ajuste de cantidad y eliminación de productos -->
<script>
    function ajustarCantidad(idProducto, nuevaCantidad) {
        // Lógica para ajustar la cantidad de productos en el carrito
        console.log("Cantidad de producto ajustada - ID: " + idProducto + ", Nueva Cantidad: " + nuevaCantidad);

        // Puedes realizar más acciones aquí, como actualizar la interfaz de usuario
    }

    function eliminarDelCarrito(idCarrito) {
    // Mostrar SweetAlert para confirmar la eliminación
    Swal.fire({
        title: '¿Estás seguro?',
        text: 'Esta acción eliminará el producto del carrito.',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sí, eliminar',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {
            // Realizar acciones de eliminación aquí
            console.log("Producto eliminado del carrito - ID: " + idCarrito);

            // Puedes realizar una solicitud al servidor para eliminar el producto del carrito
            var xhttp = new XMLHttpRequest();
            xhttp.open("POST", "eliminar_del_carrito.php", true);
            xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhttp.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    // Lógica adicional después de eliminar el producto (si es necesario)
                    var response = JSON.parse(this.responseText);
                    console.log("Respuesta del servidor: " + JSON.stringify(response));

                    // Mostrar SweetAlert con el mensaje del servidor
                    Swal.fire({
                        icon: response.success ? 'success' : 'error',
                        title: response.message,
                        confirmButtonText: 'OK'
                    });

                    // Actualizar la interfaz o realizar acciones adicionales según sea necesario
                    if (response.success) {
                        // Por ejemplo, recargar la página o actualizar la lista de productos en el carrito
                        location.reload();  // Esto recarga la página
                        // Actualizar la interfaz según tu lógica
                    }
                }
            };
            xhttp.send("idCarrito=" + idCarrito);
        }
    });
}



    function finalizarCompra() {
        // Lógica para procesar el pago y finalizar la compra (integramos con PayPal aquí)
        console.log("Compra finalizada");

        // Puedes realizar más acciones aquí, como redirigir a la página de pago
    }
</script>
<script>
    const btnMenu = document.getElementById('btn-menu');
		const navbarMenu = document.querySelector('.navbar-menu');

		btnMenu.addEventListener('click', () => {
			if (navbarMenu) {
				navbarMenu.classList.toggle('show-menu');
			}
		});
</script>

</body>
</html>
