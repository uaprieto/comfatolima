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
    $correo = $_POST['email'];
    $clave = $_POST['clave'];
    if ($id == "") {
        $sql = "INSERT INTO usuarios (nombre, correo, clave) VALUES ('$nombre', '$correo', '$clave')";
    } else {
        $sql = "UPDATE usuarios SET nombre = '$nombre', correo = '$correo', clave = '$clave' WHERE id = '$id'";
    }
    mysqli_query($conexion, $sql);
    header("Location: index.php");
}

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario y Tabla de Usuarios</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        .form-container,
        .table-container {
            margin-bottom: 20px;
        }

        form {
            display: flex;
            flex-direction: column;
            max-width: 400px;
        }

        label {
            margin-bottom: 5px;
        }

        input[type="text"],
        input[type="email"],
        input[type="password"] {
            margin-bottom: 10px;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        input[type="submit"] {
            padding: 10px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 12px;
            border: 1px solid #ddd;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        .crud-buttons {
            display: flex;
            gap: 5px;
        }

        .crud-buttons button {
            padding: 5px 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .crud-buttons .update {
            background-color: #4CAF50;
            color: white;
        }

        .crud-buttons .delete {
            background-color: #f44336;
            color: white;
        }
    </style>
</head>

<body>
    <div class="form-container">
        <h2>Formulario de Usuario</h2>
        <form action="index.php" method="post">
            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" required>

            <label for="correo">Correo:</label>
            <input type="email" id="correo" name="correo" required>

            <label for="clave">Clave:</label>
            <input type="password" id="clave" name="clave" required>

            <label for="activo">Activo:</label>
            <input type="text" id="activo" name="activo" required>

            <input type="submit" value="Enviar">
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
                    <th>Clave</th>
                    <th>Activo</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <!-- Aquí se agregarán las filas de usuarios dinámicamente -->
                <?php
                $sql = "SELECT * FROM usuarios";
                $resultado = mysqli_query($conexion, $sql);

                while ($fila = mysqli_fetch_array($resultado)) {
                    print_r($fila);
                    //$usuario = Usuario::crearDesdeFila($fila);
                    echo "<tr>";
                    echo "<td>" . $fila['id'] . "</td>";
                    echo "<td>" . $fila['nombre'] . "</td>";
                    echo "<td>" . $fila['correo'] . "</td>";
                    echo "<td><a href='index.php?id=" . $fila['id'] . "&cmd=update' class='btn-update'><img src='img/update.png' width='20px' height='20px'></a>" .
                        "<a href='index.php?id=" . $fila['id'] . "&cmd=delete' class='btn-delete'><img src='img/delete.png' width='20px' height='20px'></a></td>";
                    echo "</tr>";
                }
                ?>

                <tr>
                    <td>1</td>
                    <td>Juan Pérez</td>
                    <td>juan@example.com</td>
                    <td>******</td>
                    <td>Sí</td>
                    <td class="crud-buttons">
                        <button class="update">Actualizar</button>
                        <button class="delete">Eliminar</button>
                    </td>
                </tr>
                <!-- Más filas de ejemplo -->
            </tbody>
        </table>
    </div>
</body>

</html>