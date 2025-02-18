<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Crédito</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
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
            font-size: 24px;
            text-align: center;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
        }

        .form-group input {
            width: 100%;
            padding: 8px;
            box-sizing: border-box;
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
        <h2>Solicitud de Crédito</h2>
        <form action="amortiza.php" method="post">
            <div class="form-group">
                <label for="cedula">Cédula del Cliente:</label>
                <input type="text" id="cedula" name="cedula" required>
            </div>
            <div class="form-group">
                <label for="nombre">Nombre del Cliente:</label>
                <input type="text" id="nombre" name="nombre" required>
            </div>
            <div class="form-group">
                <label for="monto">Monto del Crédito:</label>
                <input type="number" id="monto" name="monto" required>
            </div>
            <div class="form-group">
                <label for="tasa">Tasa de Interés Mensual (%):</label>
                <input type="number" step="0.01" id="tasa" name="tasa" required>
            </div>
            <div class="form-group">
                <label for="plazo">Plazo en Meses:</label>
                <input type="number" id="plazo" name="plazo" required>
            </div>
            <div class="form-group">
                <button type="submit">Enviar Solicitud</button>
            </div>
        </form>
    </div>
</body>

</html>