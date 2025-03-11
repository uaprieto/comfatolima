<?php include 'conexion.php';
if (isset($_GET['id']) && isset($_GET['cmd'])) {
    $documento = $_GET['id'];
    $cmd = $_GET['cmd'];
    switch ($cmd) {
        case 'update':
            $sql = "SELECT c.documento, c.nombre, c.apellido, c.ciudad_id, cd.nombre as ciudad
                FROM clientes as c JOIN ciudades as cd ON c.ciudad_id = cd.id
                WHERE c.documento = '$documento'";

            $resultado = mysqli_query($conexion, $sql);
            $data_form = mysqli_fetch_array($resultado);
            $data_form['cmd'] = 'update';
            $bnt_form = "Actualizar";
            break;
    }
} else {
    $bnt_form = "Registrar";
    $data_form = array('documento' => '', 'nombre' => '', 'apellido' => '', 'ciudad_id' => '', 'ciudad' => '', 'cmd' => 'new');
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
            <label for="documento">Documento:</label>
            <input type="text" id="documento" name="documento" required value="<?php echo $data_form['documento']; ?>">
            <br>
            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" required value="<?php echo $data_form['nombre']; ?>">
            <br>
            <label for="apellido">Apellido:</label>
            <input type="text" id="apellido" name="apellido" required value="<?php echo $data_form['apellido']; ?>">
            <br>
            <label for="ciudad">Ciudad:</label>
            <select name="ciudad" id="ciudad">
                <option value="<?php echo $data_form['ciudad_id']; ?>"><?php echo $data_form['ciudad']; ?></option>
                <?php
                $sql = "SELECT * FROM ciudades";
                $resultado = mysqli_query($conexion, $sql);
                while ($data = mysqli_fetch_array($resultado)) {
                    echo '<option value="' . $data['id'] . '">' . $data['nombre'] . '</option>';
                }
                ?>
            </select>
            <br>
            <div class="buttons">
                <?php if ($bnt_form == "Actualizar") {
                    echo '<label for="activo">Activo:</label>';
                    echo '<input type="checkbox" id="activo" name="activo" value=';
                    if ($data_form['activo'] == 1) {
                        echo "checked";
                    } else {
                        echo "0";
                    }
                    echo '>';
                }
                ?>

                <br>
                <button class="button" type="submit" name="registro">
                    <?php echo $bnt_form; ?></button>
                <button class="button" type="button" onclick="window.location.href='table_clientes.php'">Cancelar</button>
            </div>
        </form>
    </div>

</body>

</html>