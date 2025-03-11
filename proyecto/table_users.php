<?php include 'conexion.php';
if (isset($_GET["id"]) && isset($_GET['cmd'])) {
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
} elseif (isset($_GET["search"]) && isset($_GET['btn'])) {
    $search = $_GET['search'];
    $btn = $_GET['btn'];
    if ($btn == "Buscar") {
        $sql = "SELECT * FROM usuarios WHERE nombre LIKE '%$search%' OR correo LIKE '%$search%'";
    } else {
        $sql = "SELECT * FROM usuarios";
    }
    $resultado = mysqli_query($conexion, $sql);
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
        $sql = "INSERT INTO usuarios (nombre, correo, clave, activo) VALUES ('$nombre', '$correo', '$clave', 1)";
    } else {
        $sql = "UPDATE usuarios SET nombre = '$nombre', correo = '$correo', clave = '$clave', activo = '$activo' WHERE id = '$id'";
    }
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
    <div class="container">
        <h2>Administrar Usuarios</h2>
        <div class="search-container">
            <form action="" method="get">
                <input type="text" name="search" placeholder="Buscar usuario...">
                <input type="submit" class="form-buttons" name="btn" value="Buscar">
                <input type="button" class="form-buttons" value="Nuevo" onclick="window.location.href='form_user.php'">
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
                    <!-- Las filas de usuarios dinámicamente -->
                    <?php
                    if (!isset($resultado)) {
                        $sql = "SELECT * FROM usuarios";
                        $resultado = mysqli_query($conexion, $sql);
                    }
                    while ($fila = mysqli_fetch_array($resultado)) {
                        //$usuario = Usuario::crearDesdeFila($fila);
                        echo "<tr>";
                        echo "<td>" . $fila['id'] . "</td>";
                        echo "<td>" . $fila['nombre'] . "</td>";
                        echo "<td>" . $fila['correo'] . "</td>";
                        echo "<td> " . ($fila['activo'] == 1 ? 'Si' : 'No') . "</td>";
                        echo "<td>" . $fila['creado'] . "</td>";
                        echo "<td class='crud-buttons'><a href='form_user.php?id=" . $fila['id'] . "&cmd=update' class='update'><img src='img/update.png' width='20px' height='20px'>Editar</a>" .
                            "<a href='eliminar.php?id=" . $fila['id'] . "&cmd=delete' class='delete'><img src='img/delete.png' width='20px' height='20px'>Borrar</a></td>";
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>