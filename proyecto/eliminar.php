<?php include 'conexion.php';
if (isset($_GET["id"]) && isset($_GET["cmd"]) && $_GET["cmd"] == "delete") {
    $id = $_GET['id'];
    $sql = "SELECT * FROM usuarios WHERE id = '$id'";
    $resultado = mysqli_query($conexion, $sql);
    $data_form = mysqli_fetch_array($resultado);
    $bnt_form = "Eliminar";
} elseif (isset($_POST["id"]) && isset($_POST['cmd']) && $_POST['cmd'] == 'confirm_delete') {
    $id = $_POST['id'];
    //Confirmado que si desea eliminar
    $sql = "DELETE FROM usuarios WHERE id = '$id'";
    $resultado = mysqli_query($conexion, $sql);
    if ($resultado) {
        echo "Registro eliminado";
    }
    header("Location: table_users.php");
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
            return confirm("¿Ultima oportunidad, confirme que desea eliminar este usuario?");
        }
    </script>
</head>

<body>
    <h2>Eliminar Usuario</h2>
    <form action="eliminar.php" method="post" onsubmit="return confirmarEliminacion();">
        <input type="hidden" name="id" value="<?php echo $data_form["id"]; ?>">
        <input type="hidden" name="cmd" value="confirm_delete">
        <p>¿Está seguro de que desea eliminar a <?php echo $data_form['nombre'] . " " . $data_form["correo"]; ?></p>
        <button type="submit">Eliminar</button>
        <a href="table_users.php">Cancelar</a>
    </form>
</body>

</html>