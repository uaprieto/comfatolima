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
    <!-- <link rel="stylesheet" href="css/styles.css"> -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
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
        <div class="col-6">
            <form action="" method="get">
                <input type="text" name="search" placeholder="Buscar cliente...">
                <input type="submit" class="btn btn-outline-primary" name="btn" value="Buscar">
                <input type="button" class="btn btn-outline-secondary" value="Nuevo" onclick="window.location.href='form_cliente.php'">
            </form>
        </div>
        <div class="col-12">
            <table class="table table-striped">
                <caption>Lista de clientes</caption>
                <thead class="bg-info">
                    <tr>
                        <th scope="col">Genero</th>
                        <th scope="col">Identidad</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Apellido</th>
                        <th scope="col">Ciudad y departamento</th>
                        <th scope="col">Acciones</th>
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
                        echo "<td class='d-flex'>
                            <form action='form_cliente.php' method='get'>
                                <input type='hidden' name='identifica' value='" . $fila['identifica'] . "'>
                                <input type='hidden' name='cmd' value='update'>
                                <button type='submit' class='btn btn-small btn-warning'>Editar</button>
                            </form>
                            <form action='table_clientes.php' method='get' 
                                onsubmit='return confirmarEliminacion();'>
                                <input type='hidden' name='identifica' value='" . $fila['identifica'] . "'>
                                <input type='hidden' name='cmd' value='delete'>
                                <button type='submit' class='btn btn-small btn-danger'>Borrar</button>
                            </form>                    </td>";
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>