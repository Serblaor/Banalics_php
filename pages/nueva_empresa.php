<?php include "layouts/head.php"; ?>
<style>body {
    font-family: 'Arial', sans-serif;
    background-color: #f2f2f2;
    margin: 0;
}

.app-content {
    padding: 20px;
}

.content-wrapper {
    background-color: #fff;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    padding: 20px;
}

form {
    max-width: 600px;
    margin: 0 auto;
}

label {
    display: block;
    margin-top: 10px;
}

input,
select,
textarea {
    width: 100%;
    padding: 10px;
    margin-top: 5px;
    margin-bottom: 15px;
    box-sizing: border-box;
    border: 1px solid #ccc;
    border-radius: 4px;
}

select {
    appearance: none;
}

button {
    background-color: #4caf50;
    color: white;
    padding: 10px 15px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}

button:hover {
    background-color: #45a049;
}</style>
<div class="app-content content container-fluid">
    <div class="content-wrapper">
        <form id="formularioEmpresa" action="../procesar_empresa.php" method="post" enctype="multipart/form-data">
            <label for="documentoEmpresa">Documento Empresa:</label>
            <input type="text" id="documentoEmpresa" name="documentoEmpresa" required>

            <label for="razonSocial">Razón Social:</label>
            <input type="text" id="razonSocial" name="razonSocial" required>

            <label for="telefonoEmpresa">Teléfono Empresa:</label>
            <input type="number" id="telefonoEmpresa" name="telefonoEmpresa" required>

            <label for="direccionEmpresa">Dirección Empresa:</label>
            <input type="text" id="direccionEmpresa" name="direccionEmpresa" required>

            <label for="estadoEmpresa">Estado de la Empresa:</label>
            <select id="estadoEmpresa" name="estadoEmpresa" required>
                <option value="Activo">Activo</option>
                <option value="Inactivo">Inactivo</option>
            </select>

            <button type="submit" class="btn btn-sm btn-success">Guardar Empresa</button>
        </form>
    </div>
</div>

<?php include "layouts/main_scripts.php"; ?>
<?php include "layouts/footer.php"; ?>


<script>
    document.addEventListener('DOMContentLoaded', function () {
        document.getElementById('formularioEmpresa').addEventListener('submit', function (event) {
            // Validaciones adicionales aquí
            if (!validarCampos()) {
                event.preventDefault();
            }
        });

        function validarCampos() {
            var razonSocial = document.getElementById('razonSocial').value;

            if (razonSocial.trim() === '') {
                alert('Por favor, ingrese el nombre.');
                return false;
            }

            return true;
        }
    });
</script>

