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
        <form id="formularioProducto" action="../procesar_producto.php" method="post" enctype="multipart/form-data">
            <label for="nombreProducto">Nombre del Producto:</label>
            <input type="text" id="nombreProducto" name="nombreProducto" required>

            <label for="tipoProducto">Tipo de Producto:</label>
            <select id="tipoProducto" name="tipoProducto" required>
                <option value="Perecederos">Perecederos</option>
                <option value="No_Perecederos">No Perecederos</option>
                <option value="Electrodomesticos">Electrodomésticos</option>
                <option value="Tecnologia">Tecnología</option>
                <option value="Textil">Textil</option>
            </select>

            <label for="unidadMedida">Unidad de Medida:</label>
            <select id="unidadMedida" name="unidadMedida" required>
                <option value="Libra">Libra</option>
                <option value="Kilo">Kilo</option>
                <option value="Bulto">Bulto</option>
                <option value="Unidad">Unidad</option>
                <option value="Litro">Litro</option>
            </select>

            <label for="stockProducto">Stock del Producto:</label>
            <input type="number" id="stockProducto" name="stockProducto" required>

            <label for="estadoProducto">Estado del Producto:</label>
            <select id="estadoProducto" name="estadoProducto" required>
                <option value="Disponible">Disponible</option>
                <option value="No_Disponible">No_Disponible</option>
            </select>

            <label for="fechaDeVencimiento">Fecha de Vencimiento:</label>
            <input type="date" id="fechaDeVencimiento" name="fechaDeVencimiento" required>

            <label for="precioProducto">Precio del Producto:</label>
            <input type="number" id="precioProducto" name="precioProducto" required>

            <label for="descripcionProducto">Descripción del Producto:</label>
            <textarea id="descripcionProducto" name="descripcionProducto" required></textarea>

            <label for="imgProducto">URL de la Imagen:</label>
            <input type="url" id="imgProducto" name="imgProducto" required>

            <label for="productoHabilitado">Producto Habilitado:</label>
            <input type="checkbox" id="productoHabilitado" name="productoHabilitado" value="1" checked>

            <button type="submit" class="btn btn-sm btn-success">Guardar Producto</button>
        </form>
    </div>
</div>

<?php include "layouts/main_scripts.php"; ?>
<?php include "layouts/footer.php"; ?>


<script>
    document.addEventListener('DOMContentLoaded', function () {
        document.getElementById('formularioProducto').addEventListener('submit', function (event) {
            // Validaciones adicionales aquí
            if (!validarCampos()) {
                event.preventDefault();
            }
        });

        function validarCampos() {
            var nombreProducto = document.getElementById('nombreProducto').value;

            if (nombreProducto.trim() === '') {
                alert('Por favor, ingrese el nombre del producto.');
                return false;
            }

            return true;
        }
    });
</script>

