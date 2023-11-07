<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["Email"];
    $contrasena = $_POST["Contraseña"];

    $servername = "localhost:3310";
    $username = "root";
    $password = "";
    $dbname = "alimentos";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Error en la conexión a la base de datos: " . $conn->connect_error);
    }

    // Consulta la base de datos para verificar las credenciales
    $sql = "SELECT * FROM usuario WHERE correoUsuario = '$email' AND passwordUsuario = '$contrasena'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Las credenciales son válidas, redirige al usuario a welcome.php
        header("Location: pages/welcome.php");
        exit();
    } else {
        // Las credenciales son incorrectas, muestra un mensaje de error
        echo "<script>alert('Credenciales incorrectas. Por favor, intente de nuevo.');</script>";
        echo "<script>window.location = 'index.php';</script>";
    }

    $conn->close();
}
?>
