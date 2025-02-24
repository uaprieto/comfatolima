<?php include 'conexion.php';
$id = $_GET['id'];
$cmd = $_GET['cmd'];
if (isset($id) && isset($cmd)) {
    switch ($cmd) {
        case 'delete':
            $sql = "SELECT * FROM usuarios WHERE id = '$id'";
            $resultado = mysqli_query($conexion, $sql);
            $data_form = mysqli_fetch_array($resultado);
            $bnt_form = "Eliminar";
            break;
        case 'confirm_delete':
            //Confirmado que si desea eliminar
            $sql = "DELETE FROM usuarios WHERE id = '$id'";
            $resultado = mysqli_query($conexion, $sql);
            if ($resultado) {
                echo "Registro eliminado";
            }
            header("Location: index.php");
            break;
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eliminar Usuario</title>
    <script>
        function confirmarEliminacion() {
            return confirm("¿Está seguro de que desea eliminar este usuario?");
        }
    </script>
</head>

<body>
    <?php
    if (isset($_GET['id'])) {
        $userId = $_GET['id'];
    ?>
        <h2>Eliminar Usuario</h2>
        <form action="eliminar.php" method="post" onsubmit="return confirmarEliminacion();">
            <input type="hidden" name="id" value="<?php echo $userId; ?>">
            <p>¿Está seguro de que desea eliminar a <?php echo $data_form['nombre']; ?></p>
            <button type="submit">Eliminar</button>
            <a href="index.php">Cancelar</a>
        </form>
    <?php
    } else {
        print_r($_GET);
        echo "<p>ID de usuario no proporcionado.</p>";
    }
    ?>
</body>

</html>