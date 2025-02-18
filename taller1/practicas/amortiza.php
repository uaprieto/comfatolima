<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tabla de Amortización</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: center;
        }

        th {
            background-color: #f2f2f2;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        tr:hover {
            background-color: #ddd;
        }
    </style>
</head>

<body>
    <h1>Tabla de Amortización de Crédito</h1>
    <?php
    function calcularAmortizacion($principal, $interesAnual, $numPagos)
    {
        $interesMensual = $interesAnual / 12 / 100;
        $cuotaMensual = $principal * $interesMensual / (1 - pow(1 + $interesMensual, -$numPagos));
        $saldo = $principal;

        echo "<table>";
        echo "<tr><th>Pago #</th><th>Cuota</th><th>Interés</th><th>Principal</th><th>Saldo</th></tr>";

        for ($i = 1; $i <= $numPagos; $i++) {
            $interes = $saldo * $interesMensual;
            $principalPagado = $cuotaMensual - $interes;
            $saldo -= $principalPagado;

            echo "<tr>";
            echo "<td>$i</td>";
            echo "<td>" . number_format($cuotaMensual, 2) . "</td>";
            echo "<td>" . number_format($interes, 2) . "</td>";
            echo "<td>" . number_format($principalPagado, 2) . "</td>";
            echo "<td>" . number_format($saldo, 2) . "</td>";
            echo "</tr>";
        }

        echo "</table>";
    }
    //Recibe los datos del formulario por el metodo POST
    if (isset($_POST['monto']) && isset($_POST['tasa']) && isset($_POST['plazo'])) {
        $principal = $_POST['monto'];
        $interesMes = $_POST['tasa'];
        $interesAnual = $interesMes * 12;
        $numPagos = $_POST['plazo'];
    } else {
        echo "No se han recibido los datos del formulario se utilizarán valores por defecto";
        $principal = 10000; // Monto del préstamo
        $interesAnual = 5; // Tasa de interés anual
        $numPagos = 24; // Número de pagos mensuales
    }

    calcularAmortizacion($principal, $interesAnual, $numPagos);
    ?>
</body>

</html>