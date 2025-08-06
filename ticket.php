<?php
include $urlPartner . '/plugins/cache.php';
include 'logica/logica__pay.php';
include 'sys.php';
$filepath = 'app/tarjetas.json';
$json_string = file_get_contents($filepath);
$json = json_decode($json_string, true);


include 'app/conn.php';
include 'app/varGlobal.php';
include 'root.php';

if (isset($_GET['b'])) {
    $usuario = $_GET['b'];
} else {
    header('location: /');
}


?>
<!DOCTYPE html>
<html lang="es">

<head>
    <title><?php echo $infoSorteoNombre . ' - ' .  $importanteNombreCorto; ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8">
    <meta property="og:title" content="Formas de Pago - <?php echo $importanteNombreCorto; ?>">
    <meta property="og:image" content="/assets/img/portada.png">
    <meta property="og:site_name" content="<?php echo $importanteNombreCorto; ?>">
    <meta property="og:type" content="website">
    <meta property="og:description" content="Formas de Pago - <?php echo $importanteNombreCorto; ?>" />
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo $urlPartner ?>assets/img/<?php echo $favicon; ?>?v=<?php echo time(); ?>">
    <link rel="icon" type="image/png" sizes="32x32" href="<?php echo $urlPartner ?>assets/img/<?php echo $favicon; ?>?v=<?php echo time(); ?>">
    <link rel="icon" type="image/png" sizes="179x180" href="<?php echo $urlPartner ?>assets/img/<?php echo $favicon; ?>?v=<?php echo time(); ?>">
    <link rel="icon" type="image/png" sizes="191x192" href="<?php echo $urlPartner ?>assets/img/<?php echo $favicon; ?>?v=<?php echo time(); ?>">
    <link rel="icon" type="image/png" sizes="510x512" href="<?php echo $urlPartner ?>assets/img/<?php echo $favicon; ?>?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="assets/css/root.css?v=<?php echo time(); ?>">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js?v=<?php echo time(); ?>"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.10.2/umd/popper.min.js?v=<?php echo time(); ?>"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.5.0/dist/js/bootstrap.bundle.min.js?v=<?php echo time(); ?>"></script>
</head>

<body>
<nav class="navbar navbar-expand-md fixed-top navbar-shrink py-3 navbar-light nav_style themeDarkNav st__nav" id="mainNav">
        <div class="navbr_menu">
            <div>
                <div class="container d-flex align-items-center justify-content-between text-center fw-bold">
                    <a href="<?php echo $linkPPago; ?>" class="navbar-toggler text-white fs-6" style="border: none;">Métodos de Pago</a>
                    <a class="navbar-brand d-flex align-items-center" href="">
                        <img src="assets/img/<?php echo $logo; ?>" class="img-menu__nav mx-2">
                    </a>
                    <a href="<?php echo $linkPSorteo; ?>" class="navbar-toggler text-white fs-6" style="border: none;">Comprar Boletos</a>
                </div>

            </div>
            <div>
                <div class="collapse navbar-collapse" id="navcol-1">
                    <ul class="navbar-nav mx-auto">
                        <li class="nav-item fw-bold fs-5"><a class="nav-link active text-white fs_action" href="/">Inicio</a></li>
                        <li class="nav-item fw-bold fs-5"><a class="nav-link active text-white fs_action" href="<?php echo $linkPSorteo; ?>">Comprar Boletos</a></li>
                        <li class="nav-item fw-bold fs-5"><a class="nav-link active text-white fs_action" href="<?php echo $linkPPago; ?>">Métodos de Pago</a></li>
                        <li class="nav-item fw-bold fs-5"><a class="nav-link active text-white fs_action" href="<?php echo $linkPCheck; ?>">Verificador</a></li>
                    </ul>
                </div>

            </div>
        </div>
    </nav>
    <div class="container-pay"></div>
    <div class="container mb-4">
        <div class="col">
            <div class="row">
                <div class="col-md-8 col-xl-6 text-center mx-auto mb-4">
                    <h2><strong><span>🔥 B O L E T O - D I G I T A L 🔥</span></strong></h2>
                </div>
            </div>
        </div>
        <div class="mb-3" style=" text-align: center;">
            <button class="btn btn-primary" id="btnCapturar" style="background: var(--color-red);border-radius: 0px;border-color: transparent;">Descargar mi boleto digital 🔥</button>
        </div>
        <div class="container imgBoleto" style="content: '';display: table;clear: both;width: 35%;">
            <div class="row gy-4 row-cols-1 row-cols-md-2 row-cols-xl-3 justify-content-center" style="margin-top: 0px;">
                <?php
                $query = "SELECT *
                                FROM sorteomini
                                WHERE folio = '$usuario' 
                                ";
                $result_tasks = mysqli_query($db, $query);
                while ($row = $result_tasks->fetch_array(MYSQLI_BOTH)) {

                ?>
                    <div class="ticket ticket_color" id="ticket">
                        <aside class="aside__boleto" style="width: 549px;font-family: 'Open Sans', sans-serif;">
                            <span>
                                <?php
                                $str = $infoSorteoNombre;
                                echo $str;
                                ?>
                            </span>
                        </aside>
                        <section class="ticket__first-section" style="margin-top: 0px;margin-bottom: 0px;">
                            <div class="container pt-3 text-center" style="margin-bottom: 9px;margin-bottom: 11px;border-top: solid 2.3px;"><strong>Folio:</strong><br><span class="dBolet"><strong><?php echo $row['folio']; ?></strong><br></span></div>
                            <section>
                                <img src="../assets/img/<?php echo $logo; ?>" style="margin-bottom: 11px;border-radius: 100%!important;">
                            </section>
                            <div class="container" style="border-top: 2px dashed #b9b9b9;padding-top: 10px;padding-bottom: 10px;">
                                <strong class="nBol">Boleto Con Oportunidades: </strong>
                                <span class="dBolet">
                                    <?php
                                    $bol = $row['boletoOpp'];
                                    $aster = str_replace("*", "", $bol);
                                    $final = str_replace("%0A", "<br>", $aster);
                                    echo $final;
                                    ?>
                                </span>
                            </div>
                            <section style="height: auto;">
                                <img src="../assets/img/<?php echo $Creativo2; ?>" style="width: 100%!important;border-radius: 10px!important;border-radius: 12px;">
                            </section>
                            <div class="container dCl"><strong class="nBol">Nombre: </strong><span class="dBolet"><?php echo $row['nombre']; ?></span></div>
                            <div class="container"><strong class="nBol">Teléfono: </strong><span class="dBolet">
                                    <?php
                                    $numeroCompleto = $row['numero'];

                                    if (strlen($numeroCompleto) > 4) {
                                        $ocultos = str_repeat('*', strlen($numeroCompleto) - 4);
                                        $ultimosCuatroDigitos = $ocultos . substr($numeroCompleto, -4);
                                    } else {
                                        $ultimosCuatroDigitos = $numeroCompleto;
                                    }

                                    echo $ultimosCuatroDigitos;
                                    ?>
                                </span>
                            </div>
                            <div class="container"><strong class="nBol">Estado: </strong><span class="dBolet"><?php echo $row['estado']; ?></span></div>
                            <div class="container"><strong class="nBol">Pagado: </strong><span class="dBolet"><?php echo $row['pagado']; ?></span></div>
                            <div class="container"><strong class="nBol">Pronto Pago: </strong><span class="dBolet"><?php echo $row['prontoPago']; ?></span></div>
                            <div class="container"><strong class="nBol">Fecha Compra: </strong><span class="dBolet"><?php echo $row['timeCompra']; ?><br></span></div>
                            <div class="container"><strong class="nBol">Fecha Compra: </strong><span class="dBolet"><?php echo $row['timePay']; ?><br></span></div>
                            <div class="container pb-3" style="margin-top: 27px;/*position: absolute;*//*position: absolute;*//*position: fixed;*/bottom: 10px;text-align: center;font-size: 24px;border-bottom: solid 2.3px;"><strong class="nBol">Mucha Suerte 🍀</strong></div>
                        </section>
                        <aside class="aside__boleto" style="width: 549px;font-family: 'Open Sans', sans-serif;">
                            <span>
                            <?php
                            $str = $infoSorteoNombre;
                            echo $str;
                        }
                            ?>
                            </span>
                        </aside>
                    </div>

            </div>
        </div>
        <div class="mt-3" style=" text-align: center;">
            <button class="btn btn-primary" id="btnCapturar2" style="background: var(--color-red);border-radius: 0px;border-color: transparent;">Descargar mi boleto digital 🔥</button>
        </div>
    </div>
    <?php include 'include/menujs.php'; ?>
    <?php include 'include/footer.php' ?>
    <script src="https://code.jquery.com/jquery-3.6.4.js?v=<?php echo time(); ?>" integrity="sha256-a9jBBRygX1Bh5lt8GZjXDzyOB+bWve9EiO7tROUtj/E=" crossorigin="anonymous"></script>
    <script src="<?php echo $urlPartner ?>assets/bootstrap/js/bootstrap.min.js?v=<?php echo time(); ?>"></script>
    <script src="<?php echo $urlPartner ?>assets/js/bold-and-bright.js?v=<?php echo time(); ?>"></script>
    <script src="<?php echo $urlPartner ?>assets/js/refres.js?v=<?php echo time(); ?>"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/html2canvas@1.0.0-rc.1/dist/html2canvas.min.js"></script>
    <script src="assets/js/theme.js?v=<?php echo time(); ?>"></script>
    <script type="text/javascript">
        const $boton = document.querySelector("#btnCapturar");
        const $boton2 = document.querySelector("#btnCapturar2");
        const $objetivo = document.querySelector(".imgBoleto");
        $boton.addEventListener("click", () => {
            html2canvas($objetivo, {
                logging: true,
                letterRendering: 1,
                allowTaint: false,
                useCORS: true
            }).then(canvas => {
                let enlace = document.createElement('a');
                enlace.download = "Boleto-Sorteo.png";
                enlace.href = canvas.toDataURL();
                enlace.click();
            });
        });

        $boton2.addEventListener("click", () => {
            html2canvas($objetivo, {
                logging: true,
                letterRendering: 1,
                allowTaint: false,
                useCORS: true
            }).then(canvas => {
                let enlace = document.createElement('a');
                enlace.download = "Boleto-Sorteo.png";
                enlace.href = canvas.toDataURL();
                enlace.click();
            });
        });
    </script>
</body>

</html>