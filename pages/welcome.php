<!-- ============== | head | =================-->
<?php  include "layouts/head.php";     ?>
<!--==========================================-->
<?php


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
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .app-content{
            height: auto;
        }
    </style>
</head>
<body>
<div class="app-content content container-fluid">
    <div class="content-wrapper">
        <div class="content-header row">
        </div>
        <div class="content-body">
        <?php echo "<h2>Bienvenido, $nombreUsuario</h2>"; ?>
        <img src="" alt="">
            
            </div>
        </div>
    </div>
</div>
</body>
</html>


<!-- ========= | scripts robust | ============-->
<?php  include "layouts/main_scripts.php"; ?>
<!--==========================================-->

<!-- ============= | footer | ================-->
<?php  include "layouts/footer.php";      ?>
<!--==========================================-->



