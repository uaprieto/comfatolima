<?php include 'conexion.php';
if (isset($_GET["identifica"]) && isset($_GET['cmd'])) {
    $identifica = $_GET['identifica'];
    $cmd = $_GET['cmd'];
    if ($cmd == 'delete') {
        //ya debio estar Confirmado si eliminar
        $sql = "DELETE FROM clientes WHERE identifica = '$identifica'";
        $resultado = mysqli_query($conexion, $sql);
        if ($resultado) {
            echo "Registro eliminado";
        }
        header("Location: table_clientes.php");
    }
} elseif (isset($_GET["search"]) && isset($_GET['btn'])) {
    $search = $_GET['search'];
    $btn = $_GET['btn'];
    if ($btn == "Buscar") {
        $sql = "SELECT c.identifica, c.nombre, c.apellido, cd.nombre as ciudad, d.nombre as dto,c.genero
                FROM clientes as c 
                JOIN ciudades as cd ON c.ciudad_id = cd.id
                JOIN departamentos as d ON cd.dto_id = d.id
                WHERE c.nombre LIKE '%$search%' OR c.apellido LIKE '%$search%'";

        $resultado = mysqli_query($conexion, $sql);
    }
} else {
    $bnt_form = "Registrar";
}
if (isset($_POST['registro'])) {
    // print_r($_POST);
    $cmd = $_POST['cmd'];
    $identifica = (int) $_POST['identifica'];
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $ciudad_id = (int) $_POST['ciudad'];
    $genero = $_POST['genero'];
    if ($cmd == "new") {
        $sql = "INSERT INTO clientes (identifica, nombre, apellido, ciudad_id, genero) VALUES ('$identifica','$nombre', '$apellido', '$ciudad_id', '$genero')";
    } else {
        $sql = "UPDATE clientes SET nombre = '$nombre', apellido = '$apellido', ciudad_id = '$ciudad_id', genero='$genero' WHERE identifica='$identifica'";
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
<script>
    function confirmarEliminacion() {
        var respuesta = confirm("¡ Ultima oportunidad ! - Confirme que desea eliminar?");
        if (respuesta) {
            return true;
        } else {
            return false;
        }
    }
</script>

<body>
    <div class="container">
        <h2>Administrar clientes</h2>
        <div class="search-container">
            <form action="" method="get">
                <input type="text" name="search" placeholder="Buscar cliente...">
                <input type="submit" class="form-buttons" name="btn" value="Buscar">
                <input type="button" class="form-buttons" value="Nuevo" onclick="window.location.href='form_cliente.php'">
            </form>
        </div>
        <div class="table-container">
            <h2>Tabla de clientes</h2>
            <table>
                <thead>
                    <tr>
                        <th>Genero</th>
                        <th>Identidad</th>
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>Ciudad Departamento</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Las filas de clientes dinámicamente -->
                    <?php
                    if (!isset($resultado)) {
                        $sql = "SELECT c.identifica, c.nombre, c.apellido, cd.nombre as ciudad, d.nombre as dto,c.genero
                                FROM clientes as c 
                                JOIN ciudades as cd ON c.ciudad_id = cd.id
                                JOIN departamentos as d ON cd.dto_id = d.id
                                ORDER BY c.creado DESC";
                        $resultado = mysqli_query($conexion, $sql);
                    }
                    while ($fila = mysqli_fetch_array($resultado)) {
                        //$usuario = Usuario::crearDesdeFila($fila);
                        echo "<tr>";
                        echo "<td><img src='img/" . ($fila['genero'] == 0 ? 'fe' : '') . "male.png' width='40px' height='40px'></td>";
                        echo "<td>" . $fila['identifica'] . "</td>";
                        echo "<td>" . $fila['nombre'] . "</td>";
                        echo "<td>" . $fila['apellido'] . "</td>";
                        echo "<td> " . $fila['ciudad'] . ' ' . $fila['dto'] . "</td>";
                        echo "<td class='crud-buttons'>
                            <form action='form_cliente.php' method='get'>
                                <input type='hidden' name='identifica' value='" . $fila['identifica'] . "'>
                                <input type='hidden' name='cmd' value='update'>
                                <button type='submit' class='update'>Editar</button>
                            </form>
                            <form class='delete' action='table_clientes.php' method='get' 
                                onsubmit='return confirmarEliminacion();'>
                                <input type='hidden' name='identifica' value='" . $fila['identifica'] . "'>
                                <input type='hidden' name='cmd' value='delete'>
                                <button type='submit' class='delete'>Borrar</button>
                            </form>                    </td>";
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>