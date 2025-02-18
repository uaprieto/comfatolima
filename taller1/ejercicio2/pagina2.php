<?php
session_start();

if ($_SESSION) {
    $nombre = $_SESSION['nombre'];
    echo "<h1> Hola $nombre</h1>";
} else {
    echo 'No has iniciado sesión';
}

