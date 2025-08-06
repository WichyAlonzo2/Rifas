<div class="container" style="text-align: center;">
    <?php
    include '../app/conn.php';
    include '../sys.php';
    if (isset($_GET['nombre'])) {
        $usuario = $_GET['nombre'];
    } else {
        header('Location: status.php');
    }

    if (isset($_GET['nombre']) && $_GET['nombre'] != "") {
        $compiler = $_GET['compiler'];
        $compilerX = intval($compiler);
        if($compilerX === 1){
            $compilerdb = '';
            $creativoSource = $Creativo2;

        }else if($compilerX === 2){
            $compilerdb = '_two';
            $creativoSource = $Portada1;

        }else if($compilerX === 3){
            $compilerdb = '_tree';
            $creativoSource = $Portada2;

        }

        $query = "SELECT * FROM sorteomini$compilerdb WHERE folio = '$usuario'";
        $result_tasks = mysqli_query($db, $query);
        while ($registroBoleto = $result_tasks->fetch_array(MYSQLI_BOTH)) { ?>

            <div class="divBol" style="width:auto; height: auto; display: inline-block;">
                <h4 class="boleto blts buttons__rad" style="background: black;font-weight: 800;border-style: none!important;border-radius: 26px!important;padding-right: 10px!important;padding-left: 10px!important;margin-bottom: 5px!important;margin-right: 5px!important;color: white;text-align: center;padding: 2px;font-size: 14px;"><?php echo $registroBoleto['boletoOpp'] ?></h4>
            </div>


        <?php } ?>
</div>
<?php } else {
        echo "<h2>Estas teniendo problemas con obtener informacion desde la base de datos, comunicate con Wichy</h2>";
    }

    if (isset($_GET['nombre']) && $_GET['nombre'] != "") {
        $query = "SELECT *
                FROM sorteomini$compilerdb
                WHERE folio = '$usuario' 
                ";

        $result_tasks = mysqli_query($db, $query);
        while ($registroBoleto = $result_tasks->fetch_array(MYSQLI_BOTH)) {
?>

    <div class="card-body">
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Folio</label>
            <input type="text" class="form-control" id="folio" placeholder="name@example.com" value="<?php echo $registroBoleto['folio'] ?>" disabled>
        </div>
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Nombre / Apodo</label>
            <input type="text" class="form-control" id="nombre" placeholder="name@example.com" value="<?php echo $registroBoleto['nombre'] ?>">
        </div>
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Numero Phone</label>
            <input type="number" class="form-control" id="telefono" placeholder="name@example.com" value="<?php echo $registroBoleto['numero'] ?>">
        </div>
        <div class="mb-3">
            <label for="exampleFormControlSelect1" class="form-label">Estado / Pais</label>
            <select class="form-control buttons__rad" name="state" id="estado" required>
                <option value="" selected="true" disabled="disabled">Selecciona un estado</option>
                <option disabled="disabled">-----------------</option>
                <option value="Estados unidos">Estados unidos</option>
                <option disabled="disabled">-----------------</option>

                <option value="<?php echo $registroBoleto['estado'] ?>" selected><?php echo $registroBoleto['estado'] ?></option>

                <?php
                $query = "SELECT id, nombre from estados";
                $result_tasks = mysqli_query($db, $query);
                while ($row = mysqli_fetch_assoc($result_tasks)) { ?>
                    <option value="<?php echo $row['nombre'] ?>"><?php echo $row['nombre'] ?> </option>

                <?php } ?>
            </select>
        </div>
        <div class="mb-3">
            <label for="exampleFormControlSelect1" class="form-label">Status Quiniela</label>
            <select class="form-control buttons__rad" name="" id="status">
                <option value="<?php echo $registroBoleto['statusBoleto'] ?>" selected><?php echo $registroBoleto['statusBoleto'] ?></option>
                <option value="Pagado">Pagado</option>
                <option value="No">Liberar</option>
                <option value="Apartado">Apartado</option>
            </select>
        </div>
        <!-- Formas de pago -->
        <div class="mb-3">
            <label for="exampleFormControlSelect1" class="form-label">Tipo de Pago</label>
            <select class="form-control buttons__rad" name="" id="formasPago">
                <option value="<?php echo $registroBoleto['typePay'] ?>" selected><?php echo $registroBoleto['typePay'] ?></option>
                <option value="Efectivo">Efectivo</option>
                <?php
                    $jsonData = file_get_contents($urlPartner . '/app/tarjetas.json');
                    $datos = json_decode($jsonData, true);
                    $nombreBancos = array_column($datos, 'nombreBanco');
                    $options = '';
                    foreach ($nombreBancos as $valor) {
                        $options .= '<option value="' . $valor . '">' . $valor . '</option>';
                    }
                    echo $options;
                ?>
                
            </select>
        </div>
        <div class="col-12 mb-4">
            <label for="flatpickr-human-friendly" class="form-label">Fecha Compra</label>
            <input class="form-control input active" placeholder="Month DD, YYYY" id="compra" tabindex="0" type="datetime-local" value="<?php echo $registroBoleto['timeCompra'] ?>" disabled>
        </div>
        <div class="col-12 mb-4">
            <label for="flatpickr-human-friendly" class="form-label">Fecha Pago</label>
            <input class="form-control input active" placeholder="Month DD, YYYY" id="pay" tabindex="0" type="datetime-local" value="<?php echo $registroBoleto['timePay'] ?>">
        </div>
    </div>

<?php
        }
    } ?>