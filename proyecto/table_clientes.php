<?php include 'conexion.php';
if (isset($_GET["documento"]) && isset($_GET['cmd'])) {
    $documento = $_GET['documento'];
    $cmd = $_GET['cmd'];
    switch ($cmd) {
        case 'delete':
            //Confirmar si desea eliminar
            $sql = "DELETE FROM usuarios WHERE documento = '$documento'";
            $resultado = mysqli_query($conexion, $sql);
            if ($resultado) {
                echo "Registro eliminado";
            }
            header("Location: index.php");
            break;
        case 'update':
            $sql = "SELECT c.documento, c.nombre, c.apellido, c.ciudad_id, cd.nombre as ciudad
                FROM clientes c JOIN ciudades cd ON c.ciudad_id = cd.id
                WHERE c.documento = '$documento'";
            
            $resultado = mysqli_query($conexion, $sql);
            $data_form = mysqli_fetch_array($resultado);
            $bnt_form = "Actualizar";
            break;
    }
} elseif (isset($_GET["search"]) && isset($_GET['btn'])) {
    $search = $_GET['search'];
    $btn = $_GET['btn'];
    if ($btn == "Buscar") {
        $sql = "SELECT * FROM usuarios WHERE nombre LIKE '%$search%' OR Apellido LIKE '%$search%'";
    } else {
        $sql = "SELECT * FROM usuarios";
    }
    $resultado = mysqli_query($conexion, $sql);
} else {
    $bnt_form = "Registrar";
}
if (isset($_POST['registro'])) {
    $cmd = $_POST['cmd'];
    $documento = $_POST['documento'];
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $ciudad_id = $_POST['ciudad_id'];
    if ($cmd == "new") {
        $sql = "INSERT INTO usuarios (documento, nombre, apellido, ciudad_id) VALUES ('$documento','$nombre', '$apellido', '$ciudad_id')";
    } else {
        $sql = "UPDATE usuarios SET documento=$documento, nombre = '$nombre', apellido = '$apellido', ciudad_id = '$ciudad_id' WHERE id = '$id'";
    }
    mysqli_query($conexion, $sql);
    print_r(mysqli_error($conexion));
    header("Location: table_clientes.php");
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
                <input type="text" name="search" placeholder="Buscar cliente...">
                <input type="submit" class="form-buttons" name="btn" value="Buscar">
                <input type="button" class="form-buttons" value="Nuevo" onclick="window.location.href='form_cliente.php'">
            </form>
        </div>
        <div class="table-container">
            <h2>Tabla de Usuarios</h2>
            <table>
                <thead>
                    <tr>
                        <th>Documento</th>
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>Ciudad</th>
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
                        echo "<td>" . $fila['documento'] . "</td>";
                        echo "<td>" . $fila['nombre'] . "</td>";
                        echo "<td>" . $fila['apellido'] . "</td>";
                        echo "<td> " . $fila['ciudad'] . "</td>";
                        echo "<td class='crud-buttons'><a href='form_cliente.php?id=" . $fila['documento'] . "&cmd=update' class='update'><img src='img/update.png' width='20px' height='20px'>Editar</a>" .
                            "<a href='eliminar.php?id=" . $fila['documento'] . "&cmd=delete' class='delete'><img src='img/delete.png' width='20px' height='20px'>Borrar</a></td>";
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>