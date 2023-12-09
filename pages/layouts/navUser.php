<?php

// Inicia la sesión
session_start();

// Verifica si el usuario está autenticado
$usuarioAutenticado = isset($_SESSION['idUsuario']);

// Obtén el nombre de usuario y la imagen si está autenticado
$nombreUsuario = $usuarioAutenticado ? $_SESSION['nombresUsuario'] : '';
$imagenUsuario = $usuarioAutenticado ? $_SESSION['imgUsuario'] : '';
?>

<link rel="shortcut icon" type="image/x-icon" href="../../app-assets/images/ico/LogoBanalics.png">
<link rel="shortcut icon" type="image/png" href="../../app-assets/images/ico/LogoBanalics.png">
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
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="index.php">
            <img src="app-assets/images/ico/LogoBanalics.png" alt="Logo" class="logo-nav" width="100">
        </a>
        <button class="navbar-toggler" type="button" aria-label="Toggle navigation" id="btn-menu">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="navbar-menu">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="index.php"><i class="fas fa-home"></i>Inicio</a>
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
                        <a class="nav-link" href="pages\ProductosUser.php"><i class="fas fa-store"></i>Productos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="pages\carrito.php"><i class="fas fa-shopping-cart"></i></a>
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
                        <a class="nav-link" title="Logout" href="pages/cerrar_sesion.php"><i class="fas fa-sign-out-alt"></i></a>
                    </li>
                <?php else: ?>
                    <li class="nav-item">
                        <a class="nav-link" href="#"><i class="fas fa-handshake"></i>Vinculate</a>
                    </li>
                    <li class="nav-item" runat="server" id="liLogin">
                        <a class="nav-link" href="pages/Login.php"><i class="fas fa-sign-in-alt"></i>Login/Registro</a>
                    </li>

                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>