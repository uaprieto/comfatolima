<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Formulario</title>
</head>

<body>
    <form action="formulario.php" name="formulario_contacto" method="get">
        <h2>ComfaTolima</h2>
        <input type="text" name="nombre" placeholder="Nombre" id="nombre" required>
        <input type="text" name="edad" placeholder="Edad" id="oedad" required>
        <br>
        <label for="hombre">Hombre</label>
        <input type="radio" name="sexo" value="hombre" id="hombre">
        <br>
        <label for="mujer">Mujer</label>
        <input type="radio" name="sexo" value="mujer" id="mujer">
        <br>
        <select name="year" id="year">
            <option value="2000">2000</option>
            <option value="2001">2001</option>
            <option value="2002">2002</option>
        </select>
        <br>
        <label for="terminos">Acepto los terminos</label>
        <input type="checkbox" name="terminos" id="terminos" value="ok">
        <br>
        <input type="submit" name="btn-enviar" value="Enviar">
</body>

</html>