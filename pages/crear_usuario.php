<?php include "layouts/head.php"; ?>
<!DOCTYPE html>
<html lang="es">

<head>
    <!-- ... (código del head) ... -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script>
        // Función para mostrar mensajes de SweetAlert
        function mostrarMensaje(tipo, mensaje) {
            Swal.fire({
                icon: tipo,
                title: mensaje,
                showConfirmButton: true,
                timer: 2500
            });
        }
        // Función para validar el formulario antes de enviar
        function validarFormulario() {
            // Agrega aquí tus propias validaciones según tus requisitos
            var documento = document.getElementById('documentoUsuario').value;
            var nombres = document.getElementById('nombresUsuario').value;
            var apellidos = document.getElementById('apellidosUsuario').value;
            var telefono = document.getElementById('telefonoUsuario').value;
            var correo = document.getElementById('correoUsuario').value;
            var password = document.getElementById('passwordUsuario').value;

            if (documento === '' || nombres === '' || apellidos === '' || telefono === '' || correo === '' || password === '') {
                mostrarMensaje('error', 'Todos los campos son obligatorios');
                return false;
            }

            // Validación: documentoUsuario y telefonoUsuario deben ser números y no deben contener letras
            if (isNaN(documento) || isNaN(telefono)) {
                mostrarMensaje('error', 'Documento y teléfono deben ser números');
                return false;
            }

            // Validación: nombresUsuario y apellidosUsuario deben contener texto (no números)
            if (!isNaN(nombres) || !isNaN(apellidos)) {
                mostrarMensaje('error', 'Nombres y apellidos deben contener texto');
                return false;
            }
return true;
}

        
    </script>
    <style>
        .container-fluid {
            margin-top: 20px;
        }

        h2 {
            color: #333;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            font-weight: bold;
            color: #555;
            display: block;
            width: 100%;
            margin-bottom: 5px;
        }

        .form-control {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            margin-top: 5px;
        }

        select.form-select {
            width: 100%;
            height: 40px;
        }

        button.btn-primary,
        button.btn-secondary {
            margin-top: 10px;
            margin-right: 10px;
        }

        /* Responsive design */
        @media (max-width: 768px) {
            label {
                width: 100%;
                display: inline-block;
            }

            .form-group {
                width: 100%;
                margin-right: 0;
            }

            button {
                width: 100%;
                margin-top: 10px;
                margin-right: 0;
            }
        }

        .footer {
            margin-top: 20px;
        }
    </style>
</head>

<body>
    <?php include "../config/Conexion.php"; ?>
        
    <div class="app-content content container-fluid">
        <h2>Crear Nuevo Usuario</h2>

        <!-- Formulario para la creación de un nuevo usuario -->
        <form class="row g-2" action="../procesar_creacion_usuario.php" method="post"
            onsubmit="return validarFormulario()">
            <div class="col-md-5">
                <div class="mb-3">
                    <label for="tipoDocumento" class="form-label">Tipo Documento:</label>
                    <select class="form-select" id="tipoDocumento" name="tipoDocumento" required>
                        <option value="CC">Cédula de Ciudadanía</option>
                        <option value="CE">Cédula de Extranjería</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="documentoUsuario" class="form-label">Documento:</label>
                    <input type="text" class="form-control" id="documentoUsuario" name="documentoUsuario" required>
                </div>
                <div class="mb-3">
                    <label for="nombresUsuario" class="form-label">Nombres:</label>
                    <input type="text" class="form-control" id="nombresUsuario" name="nombresUsuario" required>
                </div>
                <div class="mb-3">
                    <label for="apellidosUsuario" class="form-label">Apellidos:</label>
                    <input type="text" class="form-control" id="apellidosUsuario" name="apellidosUsuario" required>
                </div>
                <div class="mb-3">
                    <label for="telefonoUsuario" class="form-label">Teléfono:</label>
                    <input type="text" class="form-control" id="telefonoUsuario" name="telefonoUsuario" required>
                </div>
            </div>

            <div class="col-md-5">
                <div class="mb-3">
                    <label for="correoUsuario" class="form-label">Correo Electrónico:</label>
                    <input type="email" class="form-control" id="correoUsuario" name="correoUsuario" required>
                </div>
                <div class="mb-3">
                    <label for="passwordUsuario" class="form-label">Contraseña:</label>
                    <input type="password" class="form-control" id="passwordUsuario" name="passwordUsuario" required>
                </div>
                <div class="mb-3">
                    <label for="estadoUsuario" class="form-label">Estado:</label>
                    <select class="form-select" id="estadoUsuario" name="estadoUsuario" required>
                        <option value="Activo">Activo</option>
                        <option value="Inactivo">Inactivo</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="imgUsuario" class="form-label">URL de la Imagen:</label>
                    <input type="text" class="form-control" id="imgUsuario" name="imgUsuario"
                        value="https://th.bing.com/th/id/R.6b0022312d41080436c52da571d5c697?rik=ejx13G9ZroRrcg&riu=http%3a%2f%2fpluspng.com%2fimg-png%2fuser-png-icon-young-user-icon-2400.png&ehk=NNF6zZUBr0n5i%2fx0Bh3AMRDRDrzslPXB0ANabkkPyv0%3d&risl=&pid=ImgRaw&r=0"
                        required>
                </div>
                <div class="mb-3">
                    <label for="idRol" class="form-label">Rol:</label>
                    <!-- Agrega opciones de roles según tu base de datos -->
                    <select class="form-select" id="idRol" name="idRol" required>
                        <option value="1">Empresario</option>
                        <option value="2">Donante</option>
                        <option value="3">Beneficiario</option>
                        <option value="4">Operador</option>
                        <option value="5">Admin</option>
                        <option value="6">Comprador</option>

                    </select>
                </div>
                <div class="mb-3">
                    <label for="idEmpresa" class="form-label">Empresa:</label>
                    <select class="form-select" id="idEmpresa" name="idEmpresa" required>
                        <option value="1">ALIMENTOS SAS</option>
                        <option value="2">ALIMENTOS JORDAN</option>
                        <option value="3">NO APLICA</option>
                        <option value="4">ABC Company</option>
                        <option value="5">AMARA SA</option>
                        <option value="6">KAYMOC</option>
                        <option value="7">DUCH</option>
                        <option value="8">KANGRY</option>
                        <option value="9">OSTE</option>
                        <option value="10">BANALICS</option>
                    </select>
                </div>
            </div>
            <div class="col-6">
                <button type="submit" class="btn btn-primary">Crear Usuario</button>
                <a href="Usuarios.php" class="btn btn-secondary">Volver a la Lista de Usuarios</a>
            </div>
        </form>
    </div>


    <?php include "layouts/main_scripts.php"; ?>
    <?php include "layouts/footer.php"; ?>

</body>

</html>