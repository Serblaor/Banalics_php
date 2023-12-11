<?php
include "layouts/head.php";
require_once "../config/Conexion.php";
function getEmpresas()
{
    $conexion = new Conexion();
    $conn = $conexion->ConectarDB();

    $sql = "SELECT * FROM empresa";
    $result = $conn->query($sql);

    $empresas = array();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $empresas[] = $row;
        }
    }

    $conn->close();
    return $empresas;
}

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    


<div class="app-content content container-fluid">
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-xs-12 mb-1">
                <h2 class="content-header-title">Listado de Empresas</h2>
            </div>
        </div>
        <div class="content-body">
            <section id="basic-form-layouts">
                <div class="row match-height">
                    <div class="col-md-12">
                    <h4 class="card-title" id="basic-layout-form">
                                    <a href="nueva_empresa.php" class="btn btn-sm btn-success">Nueva Empresa</a>
                                </h4>
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Listado de Empresas</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-sm">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Documento</th>
                                                <th>Razón Social</th>
                                                <th>Teléfono</th>
                                                <th>Dirección</th>
                                                <th>Estado</th>
                                                <th>Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $empresas = getEmpresas();

                                            foreach ($empresas as $empresa) {
                                                echo "<tr>";
                                                echo "<td>{$empresa['idEmpresa']}</td>";
                                                echo "<td>{$empresa['documentoEmpresa']}</td>";
                                                echo "<td>{$empresa['razonSocial']}</td>";
                                                echo "<td>{$empresa['telefonoEmpresa']}</td>";
                                                echo "<td>{$empresa['direccionEmpresa']}</td>";
                                                echo "<td>{$empresa['estadoEmpresa']}</td>";
                                                echo "<td>
                                                <button class='btn btn-sm btn-info' onclick='editarEmpresa({$empresa['idEmpresa']})'>Editar</button>";
                    
                                                if ($empresa['estadoEmpresa'] == 'Activo') {
                                                    echo "<button class='btn btn-sm btn-warning' onclick='cambiarEstadoEmpresa({$empresa['idEmpresa']}, \"Inactivo\")'>Deshabilitar</button>";
                                                } else {
                                                    echo "<button class='btn btn-sm btn-success' onclick='cambiarEstadoEmpresa({$empresa['idEmpresa']}, \"Activo\")'>Habilitar</button>";
                                                }
                                                
                                                echo "<button class='btn btn-sm btn-danger' onclick='eliminarEmpresa({$empresa['idEmpresa']})'>Eliminar</button>";
                                                echo "</tr>";
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>
<script>
    function eliminarEmpresa(idEmpresa) {
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
            xhr.open('POST', 'eliminar_empresa.php', true);
            xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
            xhr.onreadystatechange = function () {
                if (xhr.readyState == 4) {
                    if (xhr.status == 200) {
                        // Manejar la respuesta del servidor
                        if (xhr.responseText === 'success') {
                            // Mensaje de éxito al borrar el usuario
                            Swal.fire({
                                icon: 'success',
                                title: 'Empresa eliminada exitosamente',
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
                                title: 'Empresa eliminada exitosamente' + xhr.responseText,
                                showConfirmButton: true,
                                timer: 3500
                            });
                        }
                    } else {
                        // Manejar errores de la solicitud AJAX
                        Swal.fire({
                            icon: 'success',
                            title: 'Empresa eliminada exitosamente',
                            showConfirmButton: true,
                            timer: 2500
                        });
                    }
                }
            };
            xhr.send('idEmpresa=' + idEmpresa);
        }
    });
}

function cambiarEstadoEmpresa(idEmpresa, nuevoEstado) {
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
            // Realiza la solicitud AJAX para cambiar el estado del Empresa
            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'cambiar_estado_empresa.php', true);
            xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
            xhr.onreadystatechange = function () {
                if (xhr.readyState == 4) {
                    if (xhr.status == 200) {
                        // Manejar la respuesta del servidor
                        if (xhr.responseText === 'success') {
                            // Mensaje de éxito al cambiar el estado
                            Swal.fire({
                                icon: 'success',
                                title: 'Empresa habilitado/deshabilitado exitosamente',
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
                                title: 'Empresa Habilitado/Deshabilitado ' + xhr.responseText,
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
            xhr.send('idEmpresa=' + idEmpresa + '&nuevoEstado=' + nuevoEstado);
        }
    });
}
function editarEmpresa(idEmpresa) {
    window.location.href = 'editar_Empresa.php?idEmpresa=' + idEmpresa;
}
</script>


</body>
</html>
<?php include "layouts/main_scripts.php"; ?>
<?php include "layouts/footer.php"; ?>