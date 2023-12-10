
<?php
// Inicia la sesión
session_start();

// Verifica si el usuario está autenticado
$usuarioAutenticado = isset($_SESSION['idUsuario']);

// Obtén el nombre de usuario y la imagen si está autenticado
$nombreUsuario = $usuarioAutenticado ? $_SESSION['nombresUsuario'] : '';
$imagenUsuario = $usuarioAutenticado ? $_SESSION['imgUsuario'] : '';

// Incluir archivo de conexión y otras funciones necesarias
include_once '../config/Conexion.php';

// Lógica para recuperar productos y tipos de productos desde la base de datos
function obtenerProductosYTiposDesdeBaseDeDatos()
{
    $conexion = new Conexion();
    $conn = $conexion->ConectarDB();

    $productos = [];
    $tiposProducto = [];

    // Consulta SQL para obtener productos y tipos de productos
    $sql = "SELECT idProducto, nombreProducto, descripcion_Producto, precioProducto, img_Producto, tipoProducto FROM producto WHERE producto_habilitado = 1";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $productos[] = $row;
            $tiposProducto[] = $row['tipoProducto'];
        }
    }

    // Elimina duplicados de tipos de productos
    $tiposProducto = array_unique($tiposProducto);

    // Cierra la conexión
    $conn->close();

    return ['productos' => $productos, 'tiposProducto' => $tiposProducto];
}

// Obtener productos y tipos de productos
$resultados = obtenerProductosYTiposDesdeBaseDeDatos();
$productos = $resultados['productos'];
$tiposProducto = $resultados['tiposProducto'];

// Obtener parámetros de la URL (página actual y filtro de tipo de producto)
$paginaActual = isset($_GET['pagina']) ? $_GET['pagina'] : 1;
$tipoFiltro = isset($_GET['tipo']) ? $_GET['tipo'] : null;

// Filtrar productos por tipo
$productosFiltrados = ($tipoFiltro) ? array_filter($productos, function ($producto) use ($tipoFiltro) {
    return $producto['tipoProducto'] === $tipoFiltro;
}) : $productos;

// Configurar la paginación
$productosPorPagina = 5;
$totalProductos = count($productosFiltrados);
$totalPaginas = ceil($totalProductos / $productosPorPagina);

// Obtener los productos de la página actual
$inicio = ($paginaActual - 1) * $productosPorPagina;
$productosPagina = array_slice($productosFiltrados, $inicio, $productosPorPagina);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Productos</title>
<link rel="shortcut icon" type="image/x-icon" href="../app-assets/images/ico/LogoBanalics.png">
<link rel="shortcut icon" type="image/png" href="../app-assets/images/ico/LogoBanalics.png">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css"
    integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous" />
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
    integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
    crossorigin="anonymous"></script>
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

.producto {
    width: 250px;
    margin: 10px;
    padding: 15px;
    border: 1px solid #ccc;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    transition: transform 0.3s ease-in-out;
    background-color: #fff; /* Fondo blanco */
}

.producto:hover {
    transform: scale(1.05);
}

.producto img {
    width: 100%;
    height: auto;
    border-radius: 8px;
    margin-bottom: 10px;
}

.producto h3 {
    font-size: 1.5em;
    margin-bottom: 10px;
    color: #052e4c; /* Color azul oscuro */
}

.producto p {
    font-size: 1em;
    color: #555;
    margin-bottom: 15px;
}

.producto label {
    display: block;
    margin-bottom: 5px;
    font-weight: bold;
    color: #052e4c; /* Color azul oscuro */
}

.producto input {
    width: 60px; /* Ancho del campo de cantidad */
    padding: 8px;
    margin-bottom: 15px;
    border: 1px solid #ccc;
    border-radius: 5px;
}

.producto button {
    background-color: #052e4c;
    color: #fff;
    border: none;
    padding: 10px;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.producto button:hover {
    background-color: #020304; /* Cambio de color al pasar el mouse */
}
/* Estilos para el formulario de filtrado */
.filtro form {
    display: flex;
    align-items: center;
    margin-bottom: 20px;
}

.filtro label {
    margin-right: 10px;
}

.filtro select {
    padding: 8px;
}

.filtro button {
    padding: 8px 12px;
    background-color: #052e4c;
    color: #fff;
    border: none;
    cursor: pointer;
}

/* Estilos para la paginación */
.paginacion {
    align-items: center;
    position: relative;
    display: flex;
    margin-top: 20px;
}

.paginacion a {
    display: inline-block;
    padding: 8px 12px;
    margin-right: 5px;
    text-decoration: none;
    background-color: #052e4c;
    color: #fff;
    border-radius: 5px;
    transition: background-color 0.3s ease;
}

.paginacion a:hover {
    background-color: #2980b9;
}

.pagina-actual {
    background-color: #052e4c;
}



    /* Estilos para el menú de hamburguesa en pantallas pequeñas */
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
                <li class="nav-item">
                    <a class="nav-link" href="#"><i class="fas fa-users"></i>Nosotros</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#"><i class="fas fa-calendar-alt"></i>Eventos</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="#"><i class="fas fa-handshake"></i>Alianzas</a>
                </li>
                <?php if ($usuarioAutenticado): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="ProductosUser.php"><i class="fas fa-store"></i>Productos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="carrito.php"><i class="fas fa-shopping-cart"></i></a>
                    </li>
                    <li class="nav-item">
                        <div class="user-info">
                            <img src="<?php echo $imagenUsuario; ?>" alt="Foto de perfil">
                            <span>
                                <?php echo "Hola, $nombreUsuario!"; ?>
                            </span>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" title="Logout" href="cerrar_sesion.php"><i class="fas fa-sign-out-alt"></i></a>
                    </li>
                <?php else: ?>
                    <li class="nav-item">
                        <a class="nav-link" href="#"><i class="fas fa-handshake"></i>Vinculate</a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>
<!--==========================================-->

<!-- Mostrar lista de productos -->
<h2>Productos</h2>

<!-- Filtros por tipo de producto -->
<form class="filtro"method="get" action="ProductosUser.php">
    <label for="tipo">Filtrar por tipo:</label>
    <select name="tipo" id="tipo">
        <option value="">Todos</option>
        <?php foreach ($tiposProducto as $tipo): ?>
            <option value="<?= $tipo ?>"<?= ($tipo == $tipoFiltro) ? ' selected' : ''; ?>><?= $tipo ?></option>
        <?php endforeach; ?>
    </select>
    <button type="submit">Filtrar</button>
</form>

<!-- Modifica el formulario de productos -->
<div id="productos">
    <?php foreach ($productosPagina as $producto): ?>
        <form method="post" action="carrito.php" onsubmit="return confirmarEnvio()">
            <input type="hidden" name="idProducto" value="<?= $producto['idProducto']; ?>">
            <div class="producto">
                <img src="<?= $producto['img_Producto'] ?>" alt="<?= $producto['nombreProducto']; ?>">
                <h3><?= $producto['nombreProducto']; ?></h3>
                <p><?= $producto['descripcion_Producto']; ?></p>
                <p>Precio: $<?= $producto['precioProducto']; ?></p>
                <label for="cantidad">Cantidad:</label>
                <input type="number" name="cantidad" value="1" min="1" required>
                <button type="submit">Agregar al carrito</button>
            </div>
        </form>
    <?php endforeach; ?>
</div>


<!-- Paginación -->
<div class="paginacion">
    <?php for ($i = 1; $i <= $totalPaginas; $i++): ?>
        <a href="?pagina=<?= $i . ($tipoFiltro ? '&tipo=' . $tipoFiltro : ''); ?>"<?= ($i == $paginaActual) ? ' class="pagina-actual"' : ''; ?>>
            <?= $i; ?>
        </a>
    <?php endfor; ?>
</div>

<!-- Script para agregar al carrito -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function confirmarEnvio() {
        // Muestra la alerta de SweetAlert
        Swal.fire({
            title: '¿Estás seguro?',
            text: '¿Quieres agregar el producto al carrito?',
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Sí, agregar al carrito',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            // Devuelve true si el usuario hace clic en "Sí", de lo contrario, devuelve false
            return result.isConfirmed;
        });
    }
function agregarAlCarrito(idProducto) {
    // Obtener la cantidad del producto (puedes ajustar esto según tu lógica)
    var cantidad = prompt("Ingrese la cantidad:", "1");
    if (cantidad === null || cantidad === "") {
        // El usuario canceló o no ingresó una cantidad, no se agrega al carrito
        return;
    }

    // Mostrar SweetAlert de confirmación
    Swal.fire({
        title: '¿Estás seguro?',
        text: '¿Quieres agregar el producto al carrito?',
        icon: 'question',
        showCancelButton: true,
        confirmButtonText: 'Sí, agregar al carrito',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {
            // Crear una instancia de XMLHttpRequest
            var xhttp = new XMLHttpRequest();

            // Configurar la solicitud POST hacia carrito.php (ajusta la URL según tu estructura)
            xhttp.open("POST", "carrito.php", true);

            // Configurar el encabezado para enviar datos de formulario
            xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

            // Manejar el evento de cambio de estado de la solicitud
            xhttp.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    console.log(cantidad);
                    // Mostrar SweetAlert con el mensaje de confirmación
                    Swal.fire({
                        icon: 'success',
                        title: 'Producto agregado al carrito',
                        // text: this.responseText,
                        confirmButtonText: 'OK'
                    });
                }
            };

            // Enviar la solicitud con el ID del producto y la cantidad
            xhttp.send("idProducto=" + idProducto + "&cantidad=" + cantidad);
        }
    });
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
