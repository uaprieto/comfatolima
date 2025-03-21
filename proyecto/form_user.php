<?php include 'conexion.php';
if (isset($_GET['id']) && isset($_GET['cmd'])) {
    $id = $_GET['id'];
    $cmd = $_GET['cmd'];
    switch ($cmd) {
        case 'delete':
            //Confirmar si desea eliminar
            $sql = "DELETE FROM usuarios WHERE id = '$id'";
            $resultado = mysqli_query($conexion, $sql);
            if ($resultado) {
                echo "Registro eliminado";
            }
            header("Location: index.php");
            break;
        case 'update':
            $sql = "SELECT * FROM usuarios WHERE id = '$id'";
            $resultado = mysqli_query($conexion, $sql);
            $data_form = mysqli_fetch_array($resultado);
            $bnt_form = "Actualizar";
            break;
    }
} else {
    $bnt_form = "Registrar";
    $data_form = array('id' => '', 'nombre' => '', 'correo' => '', 'clave' => '', 'activo' => '');
}
if (isset($_POST['registro'])) {
    $id = $_POST['id'];
    $nombre = $_POST['nombre'];
    $correo = $_POST['correo'];
    $clave = $_POST['clave'];
    $activo = isset($_POST['activo']) ? 1 : 0;
    if ($id == "") {
        $sql = "INSERT INTO usuarios (nombre, correo, clave, activo) VALUES ('$nombre', '$correo', '$clave', '$activo')";
    } else {
        $sql = "UPDATE usuarios SET nombre = '$nombre', correo = '$correo', clave = '$clave', activo = '$activo' WHERE id = '$id'";
    }
    print_r($sql);
    mysqli_query($conexion, $sql);
    print_r(mysqli_error($conexion));
    header("Location: table_users.php");
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
        <form action="table_users.php" name="usuario" method="post">
            <input type="hidden" name="id" value="<?php echo $data_form['id']; ?>">
            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" required value="<?php echo $data_form['nombre']; ?>">
            <br>

            <label for="correo">Correo:</label>
            <input type="email" id="correo" name="correo" required value="<?php echo $data_form['correo']; ?>">
            <br>

            <label for="clave">Clave:</label>
            <input type="password" id="clave" name="clave" required value="<?php echo $data_form['clave']; ?>">
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
                <button class="button" type="button" onclick="window.location.href='table_users.php'">Cancelar</button>
            </div>
        </form>
    </div>

</body>

</html>