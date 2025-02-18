<?php
function calcularIMC($imc)
{
    if ($imc < 18.5) {
        return 'Bajo Peso';
    } elseif ($imc >= 18.5 && $imc < 24.9) {
        return 'Normal';
    } elseif ($imc >= 25 && $imc < 29.9) {
        return 'Sobrepeso';
    } elseif ($imc >= 30 && $imc < 34.9) {
        return 'Obesidad I';
    } elseif ($imc >= 35 && $imc < 39.9) {
        return 'Obesidad II';
    } elseif ($imc >= 40) {
        return 'Obesidad III';
    }
}
//Capturar y calcular indice de masa corporal
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $peso = $_POST['peso'];
    $estatura = $_POST['estatura'];

    $imc = $peso / ($estatura * $estatura);

    echo "<h1>Reporte de Paciente</h1>";
    echo "<p>Nombre del Paciente: $nombre</p>";
    echo "<p>Peso: $peso kg</p>";
    echo "<p>Estatura: $estatura m</p>";
    echo "<p>Índice de Masa Corporal: $imc</p>";
    echo "<p>Clasificación: " . calcularIMC($imc) . "</p>";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Paciente</title>
    <style>
        body {
            background-color: yellow;
        }

        .form-container {
            margin: 50px auto;
            padding: 20px;
            width: 300px;
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .form-container h2 {
            text-align: center;
        }

        .form-container label {
            display: block;
            margin-bottom: 5px;
        }

        .form-container input {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .form-container button {
            width: 100%;
            padding: 10px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .form-container button:hover {
            background-color: #45a049;
        }
    </style>
</head>

<body>
    <div class="form-container">
        <h2>Formulario de Paciente</h2>
        <form method="post">
            <label for="nombre">Nombre del Paciente:</label>
            <input type="text" id="nombre" name="nombre" required>

            <label for="peso">Peso en Kilogramos:</label>
            <input type="number" id="peso" name="peso" step="0.01" required>

            <label for="estatura">Estatura en Metros:</label>
            <input type="number" id="estatura" name="estatura" step="0.01" required>

            <button type="submit">Enviar</button>
        </form>
    </div>
</body>

</html>