<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $cantidad = $_POST['cantidad'];
    $precio = $_POST['precio'];

    $basico = 0737000;
    $comision = $precio * 0.05 + $cantidad * 50000;
    $sueldo = 737000  + $comision;


    echo "<h1>Reporte de Vendedor</h1>";
    echo "<p>Nombre del Vendedor: $nombre</p>";
    echo "<p>Cantidad de Autos Vendidos: $cantidad</p>";
    echo "<p>Precio Total de Autos Vendidos: $precio</p>";
    echo "<p>Comisión: $comision</p>";
    echo "<p>Sueldo Básico: $basico</p>";
    echo "<p>Sueldo Total: $sueldo</p>";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Vendedor</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f3f3f3;
            color: #333;
        }

        .form-container {
            max-width: 500px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .form-container h2 {
            text-align: center;
            color: #6a0dad;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
            color: #6a0dad;
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
            background-color: #6a0dad;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .form-group button:hover {
            background-color: #5a0c9d;
        }
    </style>
</head>

<body>
    <div class="form-container">
        <h2>Formulario de Vendedor</h2>
        <form method="post">
            <div class="form-group">
                <label for="nombre">Nombre del Vendedor:</label>
                <input type="text" id="nombre" name="nombre" required>
            </div>
            <div class="form-group">
                <label for="cantidad">Cantidad de Autos Vendidos:</label>
                <input type="number" id="cantidad" name="cantidad" required>
            </div>
            <div class="form-group">
                <label for="precio">Precio Total de Autos Vendidos:</label>
                <input type="number" id="precio" name="precio" required>
            </div>
            <div class="form-group">
                <button type="submit">Enviar</button>
            </div>
        </form>
    </div>
</body>

</html>