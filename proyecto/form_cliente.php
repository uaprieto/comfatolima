<?php include 'conexion.php';
if (isset($_GET['id']) && isset($_GET['cmd'])) {
    $identifica = $_GET['id'];
    $cmd = $_GET['cmd'];
    switch ($cmd) {
        case 'update':
            $sql = "SELECT c.identifica, c.nombre, c.apellido, c.ciudad_id, cd.nombre as ciudad, cd.dto_id as dto_id, d.nombre as dto, c.genero
                FROM clientes as c 
                JOIN ciudades as cd ON c.ciudad_id = cd.id
                JOIN departamentos as d ON cd.dto_id = d.id
                WHERE c.identifica = '$identifica'";

            $resultado = mysqli_query($conexion, $sql);
            $data_form = mysqli_fetch_array($resultado);
            $data_form['cmd'] = 'update';
            $bnt_form = "Actualizar";
            break;
    }
} else {
    $bnt_form = "Registrar";
    $data_form = array('identifica' => '', 'nombre' => '', 'apellido' => '', 'ciudad_id' => 29, 'ciudad' => '',  'dto_id' => 29, 'dto' => '', 'genero' => 1, 'cmd' => 'new');
}

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recaudos UP</title>
    <link rel="stylesheet" href="css/styles.css">
</head>

<body>
    <div class="form-container">
        <h2>Formulario de Usuario</h2>
        <form action="table_clientes.php" name="cliente" method="post">
            <input type="hidden" name="cmd" value="<?php echo $data_form['cmd']; ?>">
            <label for="identifica">identifica:</label>
            <input type="text" id="identifica" name="identifica" required value="<?php echo $data_form['identifica']; ?>">
            <br>
            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" required value="<?php echo $data_form['nombre']; ?>">
            <br>
            <label for="apellido">Apellido:</label>
            <input type="text" id="apellido" name="apellido" required value="<?php echo $data_form['apellido']; ?>">
            <br>
            <label for="genero">Genero:</label>
            <div class="genero">
                <input type="radio" id="genero" name="genero" value="1" <?php if ($data_form['genero'] == 1) {
                                                                            echo 'checked';
                                                                        } ?>>Hombre
                <input type="radio" id="genero" name="genero" value="0" <?php if ($data_form['genero'] == 0) {
                                                                            echo 'checked';
                                                                        } ?>>Mujer
            </div>
            <br>
            <div class="form-group">
                <label for="dto">Departamento:</label>
                <label for="ciudad">Ciudad:</label>
            </div>
            <div class="form-group">
                <select name="dto" id="dto">
                    <?php
                    $sql = "SELECT * FROM departamentos ORDER BY nombre ASC";
                    $resultado = mysqli_query($conexion, $sql);
                    while ($data = mysqli_fetch_array($resultado)) {
                        if ($data_form['dto_id'] != $data['id']) {
                            echo '<option value="' . $data['id'] . '">' . $data['nombre'] . '</option>';
                        } else {
                            echo '<option value="' . $data['id'] . '" selected>' . $data['nombre'] . '</option>';
                        }
                    }
                    ?>
                </select>
                <select name="ciudad" id="ciudad">
                    <?php
                    $sql = "SELECT * FROM ciudades ORDER BY nombre ASC";
                    $resultado = mysqli_query($conexion, $sql);
                    while ($data = mysqli_fetch_array($resultado)) {
                        if ($data_form['ciudad_id'] != $data['id']) {
                            echo '<option value="' . $data['id'] . '">' . $data['nombre'] . '</option>';
                        } else {
                            echo '<option value="' . $data['id'] . '" selected>' . $data['nombre'] . '</option>';
                        }
                    }
                    ?>
                </select>
            </div>
            <br>
            <div class="buttons">
                <button class="button" type="submit" name="registro">
                    <?php echo $bnt_form; ?></button>
                <button class="button" type="button" onclick="window.location.href='table_clientes.php'">Cancelar</button>
            </div>
        </form>
    </div>

</body>

</html>