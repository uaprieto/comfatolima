<?php
function generarTablaAmortizacion($monto, $interesAnual, $plazo) {
    $interesMensual = $interesAnual / 12 / 100;
    $cuotaMensual = $monto * $interesMensual / (1 - pow(1 + $interesMensual, -$plazo));
    
    echo "<table border='1'>";
    echo "<tr><th>Mes</th><th>Cuota</th><th>Interés</th><th>Amortización</th><th>Saldo</th></tr>";
    
    $saldo = $monto;
    for ($mes = 1; $mes <= $plazo; $mes++) {
        $interes = $saldo * $interesMensual;
        $amortizacion = $cuotaMensual - $interes;
        $saldo -= $amortizacion;
        
        echo "<tr>";
        echo "<td>$mes</td>";
        echo "<td>" . number_format($cuotaMensual, 2) . "</td>";
        echo "<td>" . number_format($interes, 2) . "</td>";
        echo "<td>" . number_format($amortizacion, 2) . "</td>";
        echo "<td>" . number_format($saldo, 2) . "</td>";
        echo "</tr>";
    }
    
    echo "</table>";
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $monto = $_POST['monto'];
    $interesAnual = $_POST['interesAnual'];
    $plazo = $_POST['plazo'];
    
    generarTablaAmortizacion($monto, $interesAnual, $plazo);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Tabla de Amortización</title>
</head>
<body>
    <form method="post" action="">
        <label for="monto">Monto del Crédito:</label>
        <input type="number" id="monto" name="monto" required><br><br>
        
        <label for="interesAnual">Interés Anual (%):</label>
        <input type="number" id="interesAnual" name="interesAnual" step="0.01" required><br><br>
        
        <label for="plazo">Plazo (meses):</label>
        <input type="number" id="plazo" name="plazo" required><br><br>
        
        <input type="submit" value="Generar Tabla de Amortización">
    </form>
</body>
</html>