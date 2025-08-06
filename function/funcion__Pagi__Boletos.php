<?php

include '../app/conn.php';
$action = (isset($_REQUEST['action']) && $_REQUEST['action'] != NULL) ? $_REQUEST['action'] : '';
$compiler = (isset($_REQUEST['compiler']) && $_REQUEST['compiler'] != NULL) ? $_REQUEST['compiler'] : '';
if ($action == 'ajax') {
    include 'funcion__PagiButtons__Boletos.php';
    $page = (isset($_REQUEST['page']) && !empty($_REQUEST['page'])) ? $_REQUEST['page'] : 1;
    $per_page = 2000; //la cantidad de registros que desea mostrar
    $adjacents = 4; //brecha entre páginas después de varios adyacentes
    
    $offset = ($page - 1) * $per_page; //Cuenta el número total de filas de la tabla
    
    $count_query = mysqli_query($db, "SELECT count(*) AS numrows FROM info_boletos$compiler ");
    if ($row = mysqli_fetch_array($count_query)) {
        $numrows = $row['numrows'];
    }
    
    // Verificar si el número de datos es menor o igual a 2000
    if ($numrows <= 2000) {
        $per_page = $numrows; // Establecer la cantidad de registros para mostrar como el número de datos
        $total_pages = 1; // Establecer el número total de páginas como 1
    } else {
        $total_pages = ceil($numrows / $per_page); // Calcular el número total de páginas
    }
    
    $reload = 'index.php'; //consulta principal para recuperar los datos
    
    $query = mysqli_query($db, "SELECT boleto, opp, statusBoleto FROM info_boletos$compiler  order by id LIMIT $offset,$per_page");
    
    if ($numrows > 0) { ?>
    
    <div class="table-pagination pagi__native">
        <?php
        if ($numrows > 2000) {
            echo paginate($reload, $page, $total_pages, $adjacents);
        }
        ?>
    </div>
    
    <?php
        while ($row = mysqli_fetch_array($query)) {
            $boleto = $row['boleto'];
            $opp = $row['opp'];
            $statusBoleto = $row['statusBoleto'];
    
            if ($statusBoleto === 'No') { ?>
                <input class="text-dark border border-dark boleto blts fw-bold" type="button" name="w7qr[]" value="<?php echo $boleto?>" nu="<?php echo $boleto . " "  . $opp . ';'?>">
    
            <?php } else { ?>
                <input class="payX" type="button" value="<?php echo $boleto?>">
    
            <?php }
        }
        unset($boleto);
        unset($opp);
        unset($statusBoleto);
    ?>
    
    <div class="table-pagination pagi__native">
        <?php
        if ($numrows > 2000) {
            echo paginate($reload, $page, $total_pages, $adjacents);
        }
        ?>
    </div>
    
<?php }} ?>
