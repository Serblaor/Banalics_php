<!-- ============== | head | =================-->
<?php include "layouts/head.php"; ?>
<!--==========================================-->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
 <!-- =========== | contenido | ===============-->

<div class="app-content content container-fluid">
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-xs-12 mb-1">
                <h2 class="content-header-title">Productos</h2>
            </div>
            <div class="content-header-right breadcrumbs-right breadcrumbs-top col-md-6 col-xs-12">
                <div class="breadcrumb-wrapper col-xs-12">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="../welcome.php">Dashboard</a></li>
                        <li class="breadcrumb-item"><a>Productos</a></li>
                    </ol>
                </div>
            </div>
        </div>
        <div class="content-body">
            <section id="basic-form-layouts">
                <div class="row match-height">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title" id="basic-layout-form">
                                    <a href="nuevo_producto.php" class="btn btn-sm btn-success">Nuevo producto</a>
                                </h4>
                                <a class="heading-elements-toggle"><i class="icon-ellipsis font-medium-3"></i></a>
                                <div class="heading-elements">
                                    <ul class="list-inline mb-0">
                                        <li><a data-action="collapse"><i class="icon-minus4"></i></a></li>
                                        <li><a data-action="expand"><i class="icon-expand2"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="card-body collapse in">
                                <div class="card-block">
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-sm">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Nombre</th>
                                                    <th>Tipo</th>
                                                    <th>Unidad Medida</th>
                                                    <th>Stock</th>
                                                    <th>Estado</th>
                                                    <th>Fecha de Vencimiento</th>
                                                    <th>Precio</th>
                                                    <th>Descripción</th>
                                                    <th>Imagen</th>
                                                    <th>Habilitado</th>
                                                    <th>Acciones</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $productos = obtenerProductosDesdeLaBaseDeDatos();

                                                foreach ($productos as $producto) {
                                                    echo "<tr>";
                                                    echo "<td>{$producto['idProducto']}</td>";
                                                    echo "<td>{$producto['nombreProducto']}</td>";
                                                    echo "<td>{$producto['tipoProducto']}</td>";
                                                    echo "<td>{$producto['unidadMedida']}</td>";
                                                    echo "<td>{$producto['stockProducto']}</td>";
                                                    echo "<td>{$producto['estadoProducto']}</td>";
                                                    echo "<td>{$producto['fechaDeVencimiento']}</td>";
                                                    echo "<td>{$producto['precioProducto']}</td>";
                                                    echo "<td>{$producto['descripcion_Producto']}</td>";
                                                    echo "<td><img src='{$producto['img_Producto']}' alt='Imagen del Producto' style='max-width: 100px; max-height: 100px;'></td>";
                                                    echo "<td>{$producto['producto_habilitado']}</td>";
                                                    echo "<td>
                                                            <button class='btn btn-sm btn-info' onclick='editarProducto({$producto['idProducto']})'>Editar</button>
                                                            <button class='btn btn-sm btn-danger' onclick='eliminarProducto({$producto['idProducto']})'>Eliminar</button>
                                                            <button class='btn btn-sm btn-warning' onclick='deshabilitarProducto({$producto['idProducto']})'>Deshabilitar</button>
                                                        </td>";
                                                    echo "</tr>";
                                                }
                                                ?>
                                            </tbody>
                                            <tfoot>

                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>
<!--==========================================-->


<script>
    function editarProducto(idProducto) {
    window.location.href = 'editar_producto.php?idProducto=' + idProducto;
}
</script>
</body>
</html>


<!--==========================================-->

<!-- ========= | scripts robust | ============-->
<?php include "layouts/main_scripts.php"; ?>
<!--==========================================-->

<!-- ============= | footer | ================-->
<?php include "layouts/footer.php"; ?>
<!--==========================================-->

<?php
function obtenerProductosDesdeLaBaseDeDatos()
{
    require_once "../config/Conexion.php";

    $conexion = new Conexion();
    $conn = $conexion->ConectarDB();

    $productos = array();

    $query = "SELECT * FROM producto";
    $result = $conn->query($query);

    while ($row = $result->fetch_assoc()) {
        $productos[] = $row;
    }

    $conn->close();

    return $productos;
}
?>