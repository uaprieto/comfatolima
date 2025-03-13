<div id="city-form">
    <div class="container">
        <h2>Administrar ciudades</h2>
        <div class="search-container">
            <form action="" method="get">
                <input type="text" name="search" placeholder="Buscar ciudad...">
                <input type="submit" class="form-buttons" name="btn" value="Buscar">
                <input type="button" class="form-buttons" value="Nuevo" onclick="window.location.href='form_city.php'">
            </form>
        </div>
        <div class="table-container">
            <h2>Tabla de ciudades</h2>
            <table>
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Departamento</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Las filas de ciudades dinámicamente -->
                    <?php
                    if (!isset($resultado)) {
                        $sql = "SELECT cd.nombre as ciudad, d.nombre as dto
                                FROM ciudades as cd 
                                JOIN departamentos as d ON cd.dto_id = d.id";
                        $resultado = mysqli_query($conexion, $sql);
                    }
                    while ($fila = mysqli_fetch_array($resultado)) {
                        echo "<tr>";
                        echo "<td>" . $fila['ciudad'] . "</td>";
                        echo "<td>" . $fila['dto'] . "</td>";
                        echo "<td class='crud-buttons'>
                            <a href='form_city.php?id=" . $fila['ciudad'] . "&cmd=update' class='update'><img src='img/update.png' width='20px' height='20px'>Editar</a>
                            <form class='delete' action='table_ciudades.php' method='get' onsubmit='return confirmarEliminacion();'>
                                <input type='hidden' name='ciudad' value='" . $fila['ciudad'] . "'>
                                <input type='hidden' name='cmd' value='delete'>
                                <button type='submit' class='delete'>Borrar</button>
                            </form> 
                            <a href='?id=" . $fila['ciudad'] . "&cmd=delete' class='delete'><img src='img/delete.png' width='20px' height='20px'>Borrar</a></td>";
                        echo "</tr
    <form action="submit_city.php" method="post">
        <label for="city">Select City:</label>
        <select name="city" id="city">
            <option value="new_york">New York</option>
            <option value="los_angeles">Los Angeles</option>
            <option value="chicago">Chicago</option>
            <option value="houston">Houston</option>
            <option value="phoenix">Phoenix</option>
        </select>
        <button type="submit">Submit</button>
    </form>
</div>