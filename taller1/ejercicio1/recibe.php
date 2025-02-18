<?php

// print_r($_POST);
#Obtenemos los datos del formulario
// if (!$_POST) {
//     header('Location: http://localhost/poo2php/taller1/');
// }
// $nombre = $_POST['nombre'];
// $edad = $_POST['edad'];
// $sexo = $_POST['sexo'];
// $year = $_POST['year'];
// $terminos = $_POST['terminos'];

if (!$_GET) {
    header('Location: http://localhost/poo2php/taller1/');
}
$nombre = $_GET['nombre'];
$edad = $_GET['edad'];
$sexo = $_GET['sexo'];
$year = $_GET['year'];
$terminos = $_GET['terminos'];

echo 'Hola ' . $nombre . ' tu edad es ' . $edad . ' años, eres ' . $sexo . ' naciste en ' . $year . ' aceptaste los terminos ' . $terminos;
