<?php

class Conexion
{
    private $servername = "localhost:3310";
    private $username = "root";
    private $password = "";
    private $dbname = "alimentos";

    public function ConectarDB()
    {
        try {
            $conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname);
            if ($conn->connect_error) {
                die("Error en la conexión a la base de datos: " . $conn->connect_error);
            }
            return $conn;
        } catch (Exception $ex) {
            die("Error en la conexión a la base de datos: " . $ex->getMessage());
        }
    }
}

?>

