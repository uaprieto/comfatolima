<?php include 'conexion.php';
if (isset($_GET['identifica']) && isset($_GET['cmd'])) {
    $identifica = $_GET['identifica'];
    $cmd = $_GET['cmd'];
    if ($cmd == 'update') {
        $sql = "SELECT c.identifica, c.nombre, c.apellido, c.ciudad_id, cd.nombre as ciudad, cd.dto_id as dto_id, d.nombre as dto, c.genero
                FROM clientes as c 
                JOIN ciudades as cd ON c.ciudad_id = cd.id
                JOIN departamentos as d ON cd.dto_id = d.id
                WHERE c.identifica = '$identifica'";
        $resultado = mysqli_query($conexion, $sql);
        $data_form = mysqli_fetch_array($resultado);
        $data_form['cmd'] = 'update';
        $bnt_form = "Actualizar";
    } else {
        $bnt_form = "Registrar";
        $data_form = array('identifica' => '', 'nombre' => '', 'apellido' => '', 'ciudad_id' => 29, 'ciudad' => '',  'dto_id' => 29, 'dto' => '', 'genero' => 1, 'cmd' => 'new');
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
    <!-- <link rel="stylesheet" href="css/styles.css"> -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <div class="container-fluid row">
        <h2>Formulario de Usuario</h2>
        <form class="col-4" action="table_clientes.php" name="cliente" method="post">
            <input type="hidden" name="cmd" value="<?php echo $data_form['cmd']; ?>">
            <div class="mb-3">
                <label for="identifica" class="form-label">Identificación</label>
                <input type="text" class="form-control" id="identifica" name="identifica" required value="<?php echo $data_form['identifica']; ?>">
            </div>
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre</label>
                <input type="text" class="form-control" id="nombre" name="nombre" required value="<?php echo $data_form['nombre']; ?>">
            </div>
            <div class="mb-3">
                <label for="apellido" class="form-label">Apellido</label>
                <input type="text" class="form-control" id="apellido" name="apellido" required value="<?php echo $data_form['apellido']; ?>">
            </div>
            <div class="mb-3">
                <label for="genero" class="form-label">Genero</label>
                <div class="form-check
                ">
                    <input class="form-check
                    -input" type="radio" id="genero" name="genero" value="1" <?php if ($data_form['genero'] == 1) {
                                                                                    echo 'checked';
                                                                                } ?>>
                    <label class="form-check
                    -label" for="genero">Hombre</label>

                    <input class="form-check
                    -input" type="radio" id="genero" name="genero" value="0" <?php if ($data_form['genero'] == 0) {
                                                                                    echo 'checked';
                                                                                } ?>>
                    <label class="form-check
                    -label" for="genero">Mujer</label>
                </div>
            </div>
            <div class="mb-3">
                <label for="dto" class="form-label">Departamento y Ciudad</label>
            </div>
            <div class="mb-3">
                <select name="dto" id="dto" class="form-select">
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
                <select name="ciudad" id="ciudad" class="form-select">
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
            <div class="mb-3">
                <button class="btn btn-primary" type="submit" name="registro">
                    <?php echo $bnt_form; ?></button>
                <button class="btn btn-secondary" type="button" onclick="window.location.href='table_clientes.php'">Cancelar</button>
            </div>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>