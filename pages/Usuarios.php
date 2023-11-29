<?php include "layouts/head.php"; ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../../css/pages/usuarios.css">
    <style>
        /* Agrega un estilo específico para el contenido de la página */
        .app-content {
            padding: 10px;
            /* Ajusta según sea necesario */
        }

        /* Hace que la tabla sea responsive */
        .table-responsive {
            overflow-x: auto;
        }

        /* Ajusta el estilo de la tabla */
        .table {
            width: 80%;
            max-width: 80%;
            margin-bottom: 1rem;
            background-color: transparent;
            font-size: 10px;
            /* Ajusta según sea necesario */
        }

        /* Estilo para las celdas de encabezado */
        .table thead th {
            vertical-align: bottom;
            border-bottom: 2px solid #dee2e6;
        }

        /* Estilo para las celdas de datos */
        .table tbody td {
            vertical-align: middle;
        }

        /* Ajusta los estilos de los botones de acciones */
        .btn {
            margin-right: 5px;
            /* Ajusta según sea necesario */
        }

        /* Ajusta el estilo de los botones según su tamaño */
        .btn-sm {
            padding: 5px 10px;
            font-size: 12px;
            /* Ajusta según sea necesario */
        }

        /* Estilo para el color de fondo de las filas alternas */
        .table tbody tr:nth-child(even) {
            background-color: #f9f9f9;
            /* Ajusta según sea necesario */
        }
    </style>
</head>
<body>
<?php
    require_once "../config/Conexion.php";
    function getUsuarios()
    {
        $conexion = new Conexion();
        $conn = $conexion->ConectarDB();

        $sql = "SELECT u.*, r.nombreRol, e.razonSocial
            FROM usuario u
            INNER JOIN rol r ON u.ROL_idRol = r.idRol
            INNER JOIN empresa e ON u.empresa_idEmpresa = e.idEmpresa";

        $result = $conn->query($sql);

        $usuarios = array();

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $usuarios[] = $row;
            }
        }
        $conn->close();
        return $usuarios;
    }
    ?>
    <div class="app-content content container-fluid">
        <table class="table table-bordered table-sm">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Tipo Documento</th>
                    <th>Documento</th>
                    <th>Nombres y Apellidos</th>
                    <th>Teléfono</th>
                    <th>Correo Electrónico</th>
                    <th>Rol</th>
                    <th>Empresa</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $usuarios = getUsuarios();
                foreach ($usuarios as $usuario) {
                    echo "<tr>";
                    echo "<td>{$usuario['idUsuario']}</td>";
                    echo "<td>{$usuario['tipoDocumento']}</td>";
                    echo "<td>{$usuario['documentoUsuario']}</td>";
                    echo "<td>{$usuario['nombresUsuario']} {$usuario['apellidosUsuario']}</td>";
                    echo "<td>{$usuario['telefonoUsuario']}</td>";
                    echo "<td>{$usuario['correoUsuario']}</td>";
                    echo "<td>{$usuario['nombreRol']}</td>";
                    echo "<td>{$usuario['razonSocial']}</td>";
                    echo "<td>{$usuario['estadoUsuario']}</td>";
                    echo "<td>
                        <button class='btn btn-sm btn-info' onclick='editarUsuario({$usuario['idUsuario']})'>Editar</button>
                        <button class='btn btn-sm btn-danger' onclick='eliminarUsuario({$usuario['idUsuario']})'>Eliminar</button>
                        <button class='btn btn-sm btn-warning' onclick='deshabilitarUsuario({$usuario['idUsuario']})'>Deshabilitar</button>
                        </td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
<?php include "layouts/main_scripts.php"; ?>
<?php include "layouts/footer.php"; ?>