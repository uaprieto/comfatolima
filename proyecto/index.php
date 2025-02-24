<?php include 'conexion.php';
$id = $_GET['id'];
$cmd = $_GET['cmd'];
if (isset($id) && isset($cmd)) {
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
    header("Location: index.php");
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
        <form action="index.php" name="usuario" method="post">
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

            <label for="activo">Activo:</label>
            <input type="checkbox" id="activo" name="activo" value="1"
                <?php if ($data_form['activo'] == 1) {
                    echo "checked";
                } ?>>
            <br>
            <button class="button" type="submit" name="registro">
                <?php echo $bnt_form; ?></button>
        </form>
    </div>

    <div class="table-container">
        <h2>Tabla de Usuarios</h2>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Correo</th>
                    <th>Activo</th>
                    <th>Fecha creado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <!-- Aquí se agregarán las filas de usuarios dinámicamente -->
                <?php
                $sql = "SELECT * FROM usuarios";
                $resultado = mysqli_query($conexion, $sql);

                while ($fila = mysqli_fetch_array($resultado)) {
                    //$usuario = Usuario::crearDesdeFila($fila);
                    echo "<tr>";
                    echo "<td>" . $fila['id'] . "</td>";
                    echo "<td>" . $fila['nombre'] . "</td>";
                    echo "<td>" . $fila['correo'] . "</td>";
                    echo "<td> " . ($fila['activo'] == 1 ? 'Si' : 'No') . "</td>";
                    echo "<td>" . $fila['creado'] . "</td>";
                    echo "<td class='crud-buttons'><a href='index.php?id=" . $fila['id'] . "&cmd=update' class='update'><img src='img/update.png' width='20px' height='20px'>Editar</a>" .
                        "<a href='index.php?id=" . $fila['id'] . "&cmd=delete' class='delete'><img src='img/delete.png' width='20px' height='20px'>Borrar</a></td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>

</html>