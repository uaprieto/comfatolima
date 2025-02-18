<?php
function calcular_nota_final($nota1, $nota2, $nota3, $examen_final, $trabajo_final)
{
    $nota_final = ($nota1 + $nota2 + $nota3) / 3 * 0.35 + $examen_final * 0.35 + $trabajo_final * 0.30;
    return $nota_final;
}
function obtener_calificacion($nota_final)
{
    if ($nota_final >= 3.0) {
        return "Aprobado";
    } else {
        return "Reprobado";
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nota1 = $_POST['nota1'];
    $nota2 = $_POST['nota2'];
    $nota3 = $_POST['nota3'];
    $examen_final = $_POST['nota4'];
    $trabajo_final = $_POST['trabajo_final'];

    $nota_final = calcular_nota_final($nota1, $nota2, $nota3, $examen_final, $trabajo_final);
    $calificacion = obtener_calificacion($nota_final);
    echo "<h1>Nota Final: $nota_final</h1>";
    echo "<br>";
    echo "<h2>Calificación: $calificacion</h2>";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Notas</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .form-container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 300px;
        }

        .form-container h2 {
            margin-bottom: 20px;
            color: #333;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
            color: #555;
        }

        .form-group input {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .form-group button {
            width: 100%;
            padding: 10px;
            background-color: #28a745;
            border: none;
            border-radius: 4px;
            color: #fff;
            font-size: 16px;
            cursor: pointer;
        }

        .form-group button:hover {
            background-color: #218838;
        }
    </style>
</head>

<body>
    <div class="form-container">
        <h2>Formulario de Notas</h2>
        <form method="post">
            <div class="form-group">
                <label for="nota1">Nota 1:</label>
                <input type="number" id="nota1" name="nota1" step="0.01" required>
            </div>
            <div class="form-group">
                <label for="nota2">Nota 2:</label>
                <input type="number" id="nota2" name="nota2" step="0.01" required>
            </div>
            <div class="form-group">
                <label for="nota3">Nota 3:</label>
                <input type="number" id="nota3" name="nota3" step="0.01" required>
            </div>
            <div class="form-group">
                <label for="nota4">Examen Final:</label>
                <input type="number" id="nota4" name="nota4" step="0.01" required>
                <div class="form-group">
                    <label for="trabajo_final">Trabajo Final:</label>
                    <input type="number" id="trabajo_final" name="trabajo_final" step="0.01" required>
                </div>
                <div class="form-group">
                    <button type="submit">Enviar</button>
                </div>
        </form>
    </div>
</body>

</html>