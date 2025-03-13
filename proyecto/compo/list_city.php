<div class="row">
    <div class="col-md-12">
        <form class="form-inline">
            <div class="form-group mb-2">
                <label>Select Ciudad:</label>
            </div>
            <div class="form-group mx-sm-3 mb-2">
                <select name="city" id="lst_city" class="form-control">
                    <?php
                    include 'conexion.php';
                    $sql = "SELECT * FROM ciudades";
                    $resultado = mysqli_query($conexion, $sql);
                    while ($data = mysqli_fetch_array($resultado)) {
                        echo '<option value="' . $data['id'] . '">' . $data['nombre'] . '</option>';
                    }
                    ?>
                </select>
            </div>
    </form>
</div>