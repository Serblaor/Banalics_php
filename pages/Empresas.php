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

<div class="app-content content container-fluid">
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-xs-12 mb-1">
                <h2 class="content-header-title">Listado de Empresas</h2>
            </div>
            <div class="content-header-right breadcrumbs-right breadcrumbs-top col-md-6 col-xs-12">
                <div class="breadcrumb-wrapper col-xs-12">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="../welcome.php">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="#">Empresas</a></li>
                        <li class="breadcrumb-item active"><a href="#">Listado</a></li>
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

<?php include "layouts/main_scripts.php"; ?>
<?php include "layouts/footer.php"; ?>
