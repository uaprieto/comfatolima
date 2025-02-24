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

// Crear usuario
function crearUsuario($nombre, $email, $password)
{
    global $conn;
    $sql = "INSERT INTO usuarios (nombre, email, password) VALUES ('$nombre', '$email', '$password')";
    if ($conn->query($sql) === TRUE) {
        return "Nuevo usuario creado exitosamente";
    } else {
        return "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Leer usuarios
function leerUsuarios()
{
    global $conn;
    $sql = "SELECT id, nombre, email FROM usuarios";
    $result = $conn->query($sql);
    $usuarios = [];
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $usuarios[] = $row;
        }
    }
    return $usuarios;
}

// Actualizar usuario
function actualizarUsuario($id, $nombre, $email, $password)
{
    global $conn;
    $sql = "UPDATE usuarios SET nombre='$nombre', email='$email', password='$password' WHERE id=$id";
    if ($conn->query($sql) === TRUE) {
        return "Usuario actualizado exitosamente";
    } else {
        return "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Eliminar usuario
function eliminarUsuario($id)
{
    global $conn;
    $sql = "DELETE FROM usuarios WHERE id=$id";
    if ($conn->query($sql) === TRUE) {
        return "Usuario eliminado exitosamente";
    } else {
        return "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Cerrar conexión
$conn->close();
