<?php
include_once '../config/Conexion.php';
session_start();

$usuarioAutenticado = isset($_SESSION['idUsuario']);
$nombreUsuario = $usuarioAutenticado ? $_SESSION['nombresUsuario'] : '';
$imagenUsuario = $usuarioAutenticado ? $_SESSION['imgUsuario'] : '';

function obtenerPrecioProducto($idProducto)
{
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

if (isset($_POST['idProducto']) && isset($_POST['cantidad'])) {
    $idProducto = $_POST['idProducto'];
    $cantidad = $_POST['cantidad'];

    if (is_numeric($idProducto) && $idProducto > 0) {
        $precioProducto = obtenerPrecioProducto($idProducto);
        $precioTotal = $cantidad * $precioProducto;

        if (!isset($_SESSION['carrito'])) {
            $_SESSION['carrito'] = [];
        }

        if (!in_array($idProducto, $_SESSION['carrito'])) {
            $_SESSION['carrito'][] = $idProducto;

            include_once '../config/Conexion.php';
            $conexion = new Conexion();
            $conn = $conexion->ConectarDB();

            $stmt = $conn->prepare("INSERT INTO carrito (idUsuario, idProducto, cantidad, precioTotal) VALUES (?, ?, ?, ?)");
            $idUsuario = isset($_SESSION['idUsuario']) ? $_SESSION['idUsuario'] : null;

            foreach ($_SESSION['carrito'] as $idProducto) {
                $stmt->bind_param("iiid", $idUsuario, $idProducto, $cantidad, $precioTotal);
                $stmt->execute();
            }

            $stmt->close();
            $conn->close();
        } else {
            echo "El producto ya está en el carrito.";
        }
    } else {
        echo "Error: ID de producto no válido.";
    }
} else {
    echo "";
}
?>


<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrito de Compras</title>
    <link rel="shortcut icon" type="image/x-icon" href="../app-assets/images/ico/LogoBanalics.png">
    <link rel="shortcut icon" type="image/png" href="../app-assets/images/ico/LogoBanalics.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css"
        integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10">
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

        .user-info span {
            color: #fff;
        }

        #productos {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-around;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        h2 {
            text-align: center;
            color: #052e4c;
            /* Color azul oscuro */
        }

        /* Estilos para la tabla */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            overflow-x: auto;
        }

        th,
        td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
            /* Línea divisoria entre filas */
        }

        th {
            background-color: #052e4c;
            color: #fff;
        }

        /* Estilos para filas impares */
        tbody tr:nth-child(odd) {
            background-color: #f9f9f9;
        }


        button {
            background-color: #052e4c;
            color: #fff;
            border: none;
            padding: 8px 12px;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #020304;
            /* Cambio de color al pasar el mouse */
        }

        /* Estilos responsive */
        @media screen and (max-width: 600px) {
            table {
                overflow-x: auto;
            }

            th,
            td {
                display: block;
                width: 100%;
            }

            th,
            td {
                text-align: left;
                padding: 8px;
                box-sizing: border-box;
            }

            tbody tr {
                display: block;
                margin-bottom: 10px;
                border-bottom: 1px solid #ddd;
                /* Línea divisoria entre filas */
            }

            tbody tr:last-child {
                border-bottom: none;
                /* No hay línea divisoria después de la última fila */
            }

            td:before {
                content: attr(data-label);
                font-weight: bold;
                display: inline-block;
                width: 50%;
                margin-bottom: 5px;
            }
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
        integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
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
            include_once '../config/Conexion.php';
            $conexion = new Conexion();
            $conn = $conexion->ConectarDB();
            $sql = "SELECT c.idProducto, p.nombreProducto, c.cantidad, c.precioTotal, c.fechaAgregado, c.idCarrito
                    FROM carrito c
                    INNER JOIN producto p ON c.idProducto = p.idProducto";
            $result = $conn->query($sql);


            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr data-id-carrito='" . $row['idCarrito'] . "'>";
                    echo "<td class='id-producto'>" . $row['idProducto'] . "</td>";
                    echo "<td class='nombre-producto'>" . $row['nombreProducto'] . "</td>";
                    echo "<td class='cantidad'>" . $row['cantidad'] . "</td>";
                    echo "<td class='precio-total'>$" . $row['precioTotal'] . "</td>";
                    echo "<td class='fecha-agregado'>" . $row['fechaAgregado'] . "</td>";
                    echo "<td>";
                    echo "<button class='eliminar' onclick='eliminarDelCarrito(" . $row['idCarrito'] . ")'>Eliminar</button>";
                    echo "</td>";
                    echo "</tr>";
                }

                // Botón global para realizar la compra
                echo "<tr><td colspan='5'></td>";
                echo "<td><button onclick='finalizarCompra()' class='btn btn-primary'>Comprar</button></td>";
                echo "</tr>";
            } else {
                echo "<tr><td colspan='6'>El carrito está vacío</td></tr>";
            }

            $conn->close();
            ?>


        </tbody>


        <script>
            function ajustarCantidad(idProducto, nuevaCantidad) {
                console.log("Cantidad de producto ajustada - ID: " + idProducto + ", Nueva Cantidad: " + nuevaCantidad);
            }

            function eliminarDelCarrito(idCarrito) {
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
                        var xhttp = new XMLHttpRequest();
                        xhttp.open("POST", "eliminar_del_carrito.php", true);
                        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                        xhttp.onreadystatechange = function () {
                            if (this.readyState == 4 && this.status == 200) {
                                try {
                                    var response = JSON.parse(this.responseText);

                                    Swal.fire({
                                        icon: response.success ? 'success' : 'error',
                                        title: response.message,
                                        showConfirmButton: true,
                                        timer: 4500
                                    });

                                    if (response.success) {
                                        location.reload();
                                    }
                                } catch (e) {
                                    console.log("Respuesta del servidor no es JSON. Contenido: " + this.responseText);

                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Error en la respuesta del servidor',
                                        text: 'Hubo un error al procesar la solicitud. Por favor, inténtalo de nuevo.',
                                        showConfirmButton: true,
                                        timer: 4500
                                    });
                                }
                            }
                        };
                        xhttp.send("idCarrito=" + idCarrito);
                    }
                });
            }
            function finalizarCompra() {
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