<?php
date_default_timezone_set("America/Mexico_City");
include '../app/conn.php';
if ($_POST['txtbusca'] == '') {
    header('Location: check.php');
}

if (isset($_POST['txtbusca'])) {
    $compilerPost = $_POST['compiler'];
    $compiler = intval($compilerPost);
    if ($compiler === 1) {
        $valorCompiler = '';
        $compilerX = '';
    } else if ($compiler === 2) {
        $valorCompiler = '_two';
        $compilerX = 2;
    } else if ($compiler === 3) {
        $valorCompiler = '_tree';
        $compilerX = 3;
    }
    $aKeyword = explode(" ", $_POST['txtbusca']);
    $query = "SELECT * FROM info_boletos$valorCompiler WHERE 
                    nombre like '%" . $aKeyword[0] . "%' 
                    OR boleto like '%" . $aKeyword[0] . "%'
                    OR opp like '%" . $aKeyword[0] . "%'
                    OR folio like '%" . $aKeyword[0] . "%'
                    OR numero like '%" . $aKeyword[0] . "%'";

    for ($i = 1; $i < count($aKeyword); $i++) {
        if (!empty($aKeyword[$i])) {
            $query .= " OR nombre like '%" . $aKeyword[$i] . "%'";
        }
    }

    $result = $db->query($query);
    echo "<div class='container'>
            <br>Has buscado:<b> " . $_POST['txtbusca'] . "</b><br>
            <b style='color:red'>Haz Clic sobre el Folio para ver tu Boleto Digital</b>
            </div>";

    if (mysqli_num_rows($result) > 0) {
        $row_count = 0;

?>
        <div class="table-responsive" style="padding-left: 21px;padding-right: 21px;padding-top: 13px;">
            <table class="table">
                <thead>
                    <tr class="tr__search">
                        <th>Folio</th>
                        <th>Nombre</th>
                        <th>Boleto</th>
                        <th>Oportunidad</th>
                        <th>Estado</th>
                        <th>Status Boleto</th>
                        <th>Pronto Pago</th>
                        <th>Fecha Compra</th>
                        <th>Fecha Pago</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while ($row = $result->fetch_assoc()) {
                        $row_count++; ?>
                        <tr class="<?php echo $row['statusBoleto'] ?>">
                            <td class="daTab">
                                <?php
                                if ($row['folio'] === null) {
                                    echo "N/A";
                                } else { ?>
                                    <a style="color:red" href="ticket<?php echo $compilerX; ?>?b=<?php echo $row['folio'] ?>"><?php echo $row['folio'] ?></a>
                                <?php } ?>
                            </td>
                            <td class="daTab"><?php
                                                if ($row['nombre'] === null) {
                                                    echo "N/A";
                                                } else { ?>
                                    <?php echo $row['nombre'] ?>
                                <?php } ?>
                            </td>
                            <td class="daTab">
                                <?php
                                if ($row['boleto'] === null) {
                                    echo "N/A";
                                } else { ?>
                                    <?php echo $row['boleto'] ?>
                                <?php } ?>
                            </td>
                            <td class="daTab">
                                <?php
                                if ($row['opp'] === null) {
                                    echo "N/A";
                                } else { ?>
                                    <?php echo $row['opp'] ?>
                                <?php } ?>
                            </td>
                            <td class="daTab">
                                <?php
                                if ($row['estado'] === null) {
                                    echo "N/A";
                                } else { ?>
                                    <?php echo $row['estado'] ?>
                                <?php } ?>
                            </td>
                            <td class="daTab">
                                <?php
                                if ($row['statusBoleto'] === null) {
                                    echo "N/A";
                                } else { ?>
                                    <?php echo $row['statusBoleto'] ?>
                                <?php } ?>
                            </td>
                            <td class="daTab">
                                <?php
                                if ($row['prontoPago'] === null) {
                                    echo "N/A";
                                } else { ?>
                                    <?php echo $row['prontoPago'] ?>
                                <?php } ?>
                            </td>
                            <td class="daTab">
                                <?php
                                // echo $row['timeCompra']
                                if ($row['timeCompra'] === null) {
                                    echo "-";
                                } else {
                                    $timezoneCDMX = new DateTimeZone('America/Mexico_City');
                                    $fechaCompra = new DateTime($row['timeCompra']);
                                    $fechaActual = new DateTime('now', $timezoneCDMX);
                                    $intervalo = $fechaActual->diff($fechaCompra);

                                    if ($intervalo->y > 0) {
                                        echo $intervalo->y . " año";
                                    } elseif ($intervalo->m > 0) {
                                        echo $intervalo->m . " mes";
                                    } elseif ($intervalo->d > 0) {
                                        echo $intervalo->d . " día";
                                    } elseif ($intervalo->h > 0) {
                                        echo $intervalo->h . " hora";
                                    } elseif ($intervalo->i > 0) {
                                        echo $intervalo->i . " minuto";
                                    } else {
                                        echo $intervalo->s . " segundo";
                                    }
                                }

                                ?>
                            </td>
                            <td class="daTab">
                                <?php
                                // echo $row['timeCompra']
                                if ($row['timePay'] === null) {
                                    echo "-";
                                } else {
                                    $timezoneCDMX = new DateTimeZone('America/Mexico_City');
                                    $fechaCompra = new DateTime($row['timePay']);
                                    $fechaActual = new DateTime('now', $timezoneCDMX);
                                    $intervalo = $fechaActual->diff($fechaCompra);

                                    if ($intervalo->y > 0) {
                                        echo $intervalo->y . " año";
                                    } elseif ($intervalo->m > 0) {
                                        echo $intervalo->m . " mes";
                                    } elseif ($intervalo->d > 0) {
                                        echo $intervalo->d . " día";
                                    } elseif ($intervalo->h > 0) {
                                        echo $intervalo->h . " hora";
                                    } elseif ($intervalo->i > 0) {
                                        echo $intervalo->i . " minuto";
                                    } else {
                                        echo $intervalo->s . " segundo";
                                    }
                                }

                                ?>
                            </td>
                        </tr>
            <?php }
                    echo "</table>     ";
                    echo "";
                } else {
                    echo "
                <div class='container'>
                    <h4 class='fs-4'>Resultados encontrados: Ninguno</h4>
                ";
                }
            } ?>
                </tbody>
            </table>
        </div>