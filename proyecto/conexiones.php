<?php
$servername = "localhost";
$username = "uaprietoa";
$password = "123";
$dbname = "recaudos";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
echo "Conexión exitosa";
