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
           height: auto;
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
            margin-bottom: 3px;
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
    function getUsuarioPorId($idUsuario)
{
    $conexion = new Conexion();
    $conn = $conexion->ConectarDB();

    // Lógica para obtener la información del usuario según el $idUsuario
    $sql = "SELECT * FROM usuario WHERE idUsuario = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $idUsuario);
    $stmt->execute();
    $result = $stmt->get_result();

    // Comprueba si se encontró el usuario
    if ($result->num_rows > 0) {
        $usuario = $result->fetch_assoc();
    } else {
        // Puedes manejar el caso en el que no se encuentra el usuario
        $usuario = null;
    }

    $stmt->close();
    $conn->close();

    return $usuario;
}
    ?>
    <div class="app-content content container-fluid">
        <br />
        <h2>Lista de Ususarios</h2>
        <br />
        <a href="crear_usuario.php" class="btn btn-primary ">Crear Nuevo Usuario</a>
        <br />
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
                    <button class='btn btn-sm btn-info' onclick='editarUsuario({$usuario['idUsuario']})'>Editar</button>";
                    
                    if ($usuario['estadoUsuario'] == 'Activo') {
                        echo "<button class='btn btn-sm btn-warning' onclick='cambiarEstadoUsuario({$usuario['idUsuario']}, \"Inactivo\")'>Deshabilitar</button>";
                    } else {
                        echo "<button class='btn btn-sm btn-success' onclick='cambiarEstadoUsuario({$usuario['idUsuario']}, \"Activo\")'>Habilitar</button>";
                    }
                    
                    echo "<button class='btn btn-sm btn-danger' onclick='eliminarUsuario({$usuario['idUsuario']})'>Eliminar</button>";
                    echo "</td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <script>
function eliminarUsuario(idUsuario) {
    // Puedes usar SweetAlert para confirmar la eliminación
    Swal.fire({
        title: '¿Estás seguro?',
        text: 'Esta acción no se puede deshacer',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Sí, eliminar'
    }).then((result) => {
        if (result.isConfirmed) {
            // Realiza la solicitud AJAX para eliminar el usuario
            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'eliminar_usuario.php', true);
            xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
            xhr.onreadystatechange = function () {
                if (xhr.readyState == 4) {
                    if (xhr.status == 200) {
                        // Manejar la respuesta del servidor
                        if (xhr.responseText === 'success') {
                            // Mensaje de éxito al borrar el usuario
                            Swal.fire({
                                icon: 'success',
                                title: 'Usuario eliminado exitosamente',
                                showConfirmButton: false,
                                timer: 1500
                            }).then(() => {
                                // Recargar la página
                                window.location.reload();
                            });
                        } else {
                            // Mensaje de error al borrar el usuario
                            Swal.fire({
                                icon: 'success',
                                title: 'Usuario eliminado exitosamente' + xhr.responseText,
                                showConfirmButton: true,
                                timer: 1500
                            });
                        }
                    } else {
                        // Manejar errores de la solicitud AJAX
                        Swal.fire({
                            icon: 'success',
                            title: 'Usuario eliminado exitosamente',
                            showConfirmButton: true,
                            timer: 1500
                        });
                    }
                }
            };
            xhr.send('idUsuario=' + idUsuario);
        }
    });
}



function cambiarEstadoUsuario(idUsuario, nuevoEstado) {
    // Puedes usar SweetAlert para confirmar la acción
    Swal.fire({
        title: '¿Estás seguro?',
        text: 'Esta acción no se puede deshacer',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Sí, continuar'
    }).then((result) => {
        if (result.isConfirmed) {
            // Realiza la solicitud AJAX para cambiar el estado del usuario
            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'cambiar_estado_usuario.php', true);
            xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
            xhr.onreadystatechange = function () {
                if (xhr.readyState == 4) {
                    if (xhr.status == 200) {
                        // Manejar la respuesta del servidor
                        if (xhr.responseText === 'success') {
                            // Mensaje de éxito al cambiar el estado
                            Swal.fire({
                                icon: 'success',
                                title: 'Usuario habilitado/deshabilitado exitosamente',
                                showConfirmButton: false,
                                timer: 1500
                            }).then(() => {
                                // Recargar la página o realizar otras acciones necesarias
                                window.location.reload();
                            });
                        } else {
                            // Mensaje de error al cambiar el estado
                            Swal.fire({
                                icon: 'success',
                                title: 'Usuario Habilitado/Deshabilitado ' + xhr.responseText,
                                showConfirmButton: false,
                                timer: 3500

                            }).then(() => {
                                window.location.reload();
                            });
                        }
                    } else {
                        // Manejar errores de la solicitud AJAX
                        Swal.fire({
                            icon: 'error',
                            title: 'Error al realizar la solicitud',
                            showConfirmButton: false,
                            timer: 1500
                        
                        });
                    }
                }
            };
            // Envía datos adicionales, como el nuevo estado del usuario
            xhr.send('idUsuario=' + idUsuario + '&nuevoEstado=' + nuevoEstado);
        }
    });
}
function editarUsuario(idUsuario) {
    window.location.href = 'editar_usuario.php?idUsuario=' + idUsuario;
}


    </script>


</body>

</html>
<?php include "layouts/main_scripts.php"; ?>
<?php include "layouts/footer.php"; ?>