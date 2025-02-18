<?php

print_r($_POST);

$errores = '';

if (isset($_POST['btn-enviar'])) {
    $nombre = $_POST['nombre'];
    $edad = $_POST['edad'];
    $sexo = $_POST['sexo'];
    $year = $_POST['year'];
    $terminos = $_POST['terminos'];

    if (!empty($nombre)) {
        $nombre = trim($nombre);
        $nombre = filter_var($nombre, FILTER_SANITIZE_STRING);
    } else {
        $errores .= 'Por favor ingresa un nombre <br>';
    }

    if (!empty($edad)) {
        $edad = filter_var($edad, FILTER_SANITIZE_NUMBER_INT);
        if (!filter_var($edad, FILTER_VALIDATE_INT)) {
            $errores .= 'Por favor ingresa una edad valida <br>';
        }
    } else {
        $errores .= 'Por favor ingresa una edad <br>';
    }

    if (!empty($sexo)) {
        $sexo = filter_var($sexo, FILTER_SANITIZE_STRING);
    } else {
        $errores .= 'Por favor selecciona un sexo <br>';
    }

    if (!empty($year)) {
        $year = filter_var($year, FILTER_SANITIZE_NUMBER_INT);
        if (!filter_var($year, FILTER_VALIDATE_INT)) {
            $errores .= 'Por favor ingresa un año valido <br>';
        }
    } else {
        $errores .= 'Por favor selecciona un año <br>';
    }

    if (!empty($terminos)) {
        $terminos = filter_var($terminos, FILTER_SANITIZE_STRING);
    } else {
        $errores .= 'Por favor acepta los terminos <br>';
    }

    if (!$errores) {
        echo 'Nombre: ' . $nombre . '<br>';
        echo 'Edad: ' . $edad . '<br>';
        echo 'Sexo: ' . $sexo . '<br>';
        echo 'Año: ' . $year . '<br>';
        echo 'Terminos: ' . $terminos . '<br>';
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <style>
        .error {
            color: red;
        }
    </style>

</head>

<body>
    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" name="formulario_contacto">
        <h2>ComfaTolima</h2>
        <input type="text" name="nombre" placeholder="Nombre" id="nombre" value="<?php if (isset($nombre)) echo $nombre ?>">
        <input type="text" name="edad" placeholder="Edad" id="edad" value="<?php if (isset($edad)) echo $edad ?>">
        <br>
        <label for="hombre">Hombre</label>
        <input type="radio" name="sexo" value="hombre" id="hombre" <?php if (isset($sexo) && $sexo == 'hombre') echo 'checked' ?>>
        <label for="mujer">Mujer</label>
        <input type="radio" name="sexo" value="mujer" id="mujer" <?php if (isset($sexo) && $sexo == 'mujer') echo 'checked' ?>>
        <br>
        <select name="year" id="year">
            <option value="2000">2000</option>
            <option value="2001">2001</option>
            <option value="2002">2002</option>
        </select>
        <br>
        <label for="terminos">Acepto los terminos</label>
        <input type="checkbox" name="terminos" id="terminos" value="ok" <?php if (isset($terminos) && $terminos == 'ok') echo 'checked' ?>>
        <br>
        <input type="submit" name="submit" value="Enviar">
    </form>
</body>

</html>