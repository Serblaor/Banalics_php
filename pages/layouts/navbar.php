<?php
// Inicia la sesión
session_start();

// Verifica si el usuario está autenticado
if (!isset($_SESSION['idUsuario'])) {
  // Si no está autenticado, redirige a la página de inicio de sesión
  header("Location: index.php");
  exit();
}

$imagenUsuario = $_SESSION['imgUsuario'];
$nombreUsuario = $_SESSION['nombresUsuario'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
<nav class="header-navbar navbar navbar-with-menu navbar-fixed-top navbar-semi-dark navbar-shadow">
  <div class="navbar-wrapper">
    <div class="navbar-header">
      <ul class="nav navbar-nav">
        <li class="nav-item mobile-menu hidden-md-up float-xs-left"><a
            class="nav-link nav-menu-main menu-toggle hidden-xs"><i class="icon-menu5 font-large-1"></i></a></li>
        <li class="nav-item"><a href="welcome.php" class="navbar-brand nav-link"><img alt="branding logo"
              src="../app-assets/images/ico/LogoBanalics.png" data-expand="../app-assets/images/ico/LogoBanalics.png"
              data-collapse="../app-assets/images/ico/LogoBanalics.png" class="brand-logo"
              style="height: 20px;width: 40px; "></a></li>
        <li class="nav-item hidden-md-up float-xs-right"><a data-toggle="collapse" data-target="#navbar-mobile"
            class="nav-link open-navbar-container"><i class="icon-ellipsis pe-2x icon-icon-rotate-right-right"></i></a>
        </li>
      </ul>
    </div>
    <div class="navbar-container content container-fluid">
      <div id="navbar-mobile" class="collapse navbar-toggleable-sm">
        <ul class="nav navbar-nav">
          <li class="nav-item hidden-sm-down"><a class="nav-link nav-menu-main menu-toggle hidden-xs"><i
                class="icon-menu5"> </i></a></li>
          <li class="nav-item hidden-sm-down"><a href="#" class="nav-link nav-link-expand"><i
                class="ficon icon-expand2"></i></a></li>
        </ul>
        <ul class="nav navbar-nav float-xs-right">
          <li class="dropdown dropdown-notification nav-item"><a href="#" data-toggle="dropdown"
              class="nav-link nav-link-label"><i class="ficon icon-bell4"></i><span
                class="tag tag-pill tag-default tag-danger tag-default tag-up"></span></a></li>
          <li class="dropdown dropdown-notification nav-item"><a href="#" data-toggle="dropdown"
              class="nav-link nav-link-label"><i class="ficon icon-mail6"></i><span
                class="tag tag-pill tag-default tag-info tag-default tag-up"></span></a></li>
          <li class="dropdown dropdown-user nav-item">
            <a href="#" data-toggle="dropdown" class="dropdown-toggle nav-link dropdown-user-link">
              <span class="avatar avatar-online">
                <img src="<?php echo $imagenUsuario; ?>" alt="avatar">
                <i></i>
              </span>
              <span class="user-name">
                <?php echo $nombreUsuario; ?>
              </span>
            </a>
            <div class="dropdown-menu dropdown-menu-right">
              <div class="dropdown-divider"></div>
              <a href="cerrar_sesion.php" class="dropdown-item">
                <i class="icon-power3"></i>Cerrar sesión
              </a>
            </div>

          </li>
        </ul>
      </div>
    </div>
  </div>
</nav>

</body>

</html>

