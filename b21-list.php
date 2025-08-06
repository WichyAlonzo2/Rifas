<?php
// sleep(2);
include $urlPartner . '/plugins/cache.php';
$compiler = 2;
include 'logica/logica__sorteos.php';
include 'app/conn.php';
include 'app/varGlobal.php';
include 'root.php';
include 'settings_sort.php';
include 'sys.php';

session_start();
error_reporting(1);

$estados = '<select class="fw-bold" name="state" id="" required="">
<option value="" selected="true" disabled="disabled">SELECCIONA ESTADO</option>
<option value="Estados unidos">Estados unidos</option>
<option value="Aguascaliente">Aguascaliente </option>
<option value="Baja California">Baja California </option>
<option value="Baja California Sur">Baja California Sur </option>
<option value="Campeche">Campeche </option>
<option value="CDMX">CDMX </option>
<option value="Coahuila">Coahuila </option>
<option value="Colima">Colima </option>
<option value="Chiapas">Chiapas </option>
<option value="Chihuahua">Chihuahua </option>
<option value="Durango">Durango </option>
<option value="Guanajuato">Guanajuato </option>
<option value="Guerrero">Guerrero </option>
<option value="Hidalgo">Hidalgo </option>
<option value="Jalisco">Jalisco </option>
<option value="México">México </option>
<option value="Michoacán">Michoacán </option>
<option value="Morelos">Morelos </option>
<option value="Nayarit">Nayarit </option>
<option value="Nuevo León">Nuevo León </option>
<option value="Oaxaca">Oaxaca </option>
<option value="Puebla">Puebla </option>
<option value="Querétaro">Querétaro </option>
<option value="Quintana Roo">Quintana Roo </option>
<option value="San Luis Potosí">San Luis Potosí </option>
<option value="Sinaloa">Sinaloa </option>
<option value="Sonora">Sonora </option>
<option value="Tabasco">Tabasco </option>
<option value="Tamaulipas">Tamaulipas </option>
<option value="Tlaxcal">Tlaxcal </option>
<option value="Veracruz">Veracruz </option>
<option value="Yucatán">Yucatán </option>
<option value="Zacatecas">Zacatecas </option>
</select>';
$production = false;

if (isset($_SESSION['whatsApp'])) {
    // No code

} else {
    $query = "SELECT *
            FROM (
                SELECT *
                FROM $ajustes
                WHERE idWhatsApp = 1 
                ORDER BY
                    rand()
                LIMIT 1
                ) q
            ORDER BY id ASC";

    $result_tasks = mysqli_query($db, $query);
    while ($registroBoleto = $result_tasks->fetch_array(MYSQLI_BOTH)) {
        $whatsAppx = $registroBoleto['globalSer'];
    }

    $_SESSION['whatsApp'] = $whatsAppx;
}

$result = mysqli_query($db, "SELECT COUNT(statusBoleto) AS `count` FROM `$info_bolx` WHERE statusBoleto='No'");
$row = mysqli_fetch_array($result);
$countFree = $row['count'];
if ($countFree == 0) {
    $titleSort = 'Sorteo Cerrado - ' . $importanteNombreCorto;
    $descripcionSort = $importanteNombreCorto . " - Cerrado";
    $keySort = 0;
} else {
    $titleSort = $infoSorteoNombre2 . " - " . $importanteNombreCorto;
    $descripcionSort = $importanteNombreCorto . " - Disponible AHORA🔥";
    $keySort = 1;
}
$precio = $infoSorteoPrecio;
// echo $precio;
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <title><?php echo $titleSort; ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8">
    <meta property="og:description" content="<?php echo $importanteNombreCorto; ?> - Disponible AHORA🔥" />
    <meta property="og:image" content="/assets/img/portada.png">
    <meta property="og:site_name" content="<?php echo $importanteNombreCorto; ?> - Disponible AHORA🔥" />
    <meta property="og:type" content="website">
    <meta property="og:description" content="<?php echo $descripcionSort; ?>" />
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo $urlPartner ?>assets/img/<?php echo $favicon; ?>?v=<?php echo time(); ?>">
    <link rel="icon" type="image/png" sizes="32x32" href="<?php echo $urlPartner ?>assets/img/<?php echo $favicon; ?>?v=<?php echo time(); ?>">
    <link rel="icon" type="image/png" sizes="179x180" href="<?php echo $urlPartner ?>assets/img/<?php echo $favicon; ?>?v=<?php echo time(); ?>">
    <link rel="icon" type="image/png" sizes="191x192" href="<?php echo $urlPartner ?>assets/img/<?php echo $favicon; ?>?v=<?php echo time(); ?>">
    <link rel="icon" type="image/png" sizes="510x512" href="<?php echo $urlPartner ?>assets/img/<?php echo $favicon; ?>?v=<?php echo time(); ?>">
    <script src="assets/js/notify.js?v=<?php echo time(); ?>"></script>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="assets/fonts/ionicons.min.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="assets/css/root.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="assets/css/theme.css?v=<?php echo time(); ?>">
    <?php
    $ref = isset($_GET['r']) ? $_GET['r'] : null;
    $referido = '';
    if ($ref !== null) {
        $referido = $ref;
        $jsonFile = 'app/ref' . $stringCompiler . '.json';
        $jsonContent = file_get_contents($jsonFile);
        $referidos = json_decode($jsonContent, true);
        if (isset($referidos['referidos']['users'][$ref])) {
            $referidos['referidos']['users'][$ref]++;
            file_put_contents($jsonFile, json_encode($referidos, JSON_PRETTY_PRINT));
            $puntos = $referidos['referidos']['users'][$ref];
            // echo "Referido: $ref, Puntos: $puntos";

        } else {
            // echo "El referido '$ref' no fue encontrado";

        }
    } else {
        $referido = '';
    }


    ?>

    <script>
        let str__compiler = 2;
        let referido = '<?php echo $referido; ?>';
    </script>

</head>

<body>
    <nav class="navbar navbar-expand-md fixed-top navbar-shrink py-3 navbar-light nav_style themeDarkNav st__nav" id="mainNav">
        <div class="navbr_menu">
            <div>
                <div class="container d-flex align-items-center justify-content-between text-center fw-bold">
                    <a href="<?php echo $linkPPago; ?>" class="navbar-toggler text-white fs-6" style="border: none;">Métodos<br>de Pago</a>
                    <a class="navbar-brand d-flex align-items-center" href="">
                        <img src="assets/img/<?php echo $logo; ?>" class="img-menu__nav mx-2">
                    </a>
                    <!-- <a href="<?php echo $linkPSorteo; ?>" class="navbar-toggler text-white fs-6" style="border: none;">Comprar Boletos</a> -->
                    <button type="button" class="navbar-toggler position-relative remov_pay payxd__button" style="background: transparent;border: none;" data-bs-target="#offcanvas-1" data-bs-toggle="offcanvas">
                        <svg class="bi bi-cart4" xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor" viewBox="0 0 16 16" style="font-size: 40px;color: rgb(255,255,255);">
                            <path d="M0 2.5A.5.5 0 0 1 .5 2H2a.5.5 0 0 1 .485.379L2.89 4H14.5a.5.5 0 0 1 .485.621l-1.5 6A.5.5 0 0 1 13 11H4a.5.5 0 0 1-.485-.379L1.61 3H.5a.5.5 0 0 1-.5-.5zM3.14 5l.5 2H5V5H3.14zM6 5v2h2V5H6zm3 0v2h2V5H9zm3 0v2h1.36l.5-2H12zm1.11 3H12v2h.61l.5-2zM11 8H9v2h2V8zM8 8H6v2h2V8zM5 8H3.89l.5 2H5V8zm0 5a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0zm9-1a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0z"></path>
                        </svg>
                        <span class="countCart position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                            0<span class="countCart visually-hidden">0</span></span>
                        <span class="visually-hidden">unread messages</span>
                        </span>
                    </button>
                </div>

            </div>
            <div>
                <div class="collapse navbar-collapse" id="navcol-1">
                    <ul class="navbar-nav mx-auto">
                        <li class="nav-item fw-bold fs-5"><a class="nav-link active text-white fs_action" href="/">Inicio</a></li>
                        <li class="nav-item fw-bold fs-5"><a class="nav-link active text-white fs_action" href="<?php echo $linkPSorteo; ?>">Comprar Boletos</a></li>
                        <li class="nav-item fw-bold fs-5"><a class="nav-link active text-white fs_action" href="<?php echo $linkPPago; ?>">Métodos de Pago</a></li>
                        <li class="nav-item fw-bold fs-5"><a class="nav-link active text-white fs_action" href="<?php echo $linkPCheck; ?>">Verificador</a></li>
                        <li class="nav-item fw-bold fs-5 me-5">
                            <button type="button" class="position-relative remov_pay payxd__button" style="background: transparent;border: none;" data-bs-target="#offcanvas-1" data-bs-toggle="offcanvas">
                                <svg class="bi bi-cart4" xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor" viewBox="0 0 16 16" style="font-size: 40px;color: rgb(255,255,255);">
                                    <path d="M0 2.5A.5.5 0 0 1 .5 2H2a.5.5 0 0 1 .485.379L2.89 4H14.5a.5.5 0 0 1 .485.621l-1.5 6A.5.5 0 0 1 13 11H4a.5.5 0 0 1-.485-.379L1.61 3H.5a.5.5 0 0 1-.5-.5zM3.14 5l.5 2H5V5H3.14zM6 5v2h2V5H6zm3 0v2h2V5H9zm3 0v2h1.36l.5-2H12zm1.11 3H12v2h.61l.5-2zM11 8H9v2h2V8zM8 8H6v2h2V8zM5 8H3.89l.5 2H5V8zm0 5a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0zm9-1a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0z"></path>
                                </svg>
                                <span class="countCart position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                    0<span class="countCart visually-hidden">0</span></span>
                                <span class="visually-hidden">unread messages</span>
                                </span>
                            </button>
                        </li>
                    </ul>
                </div>

            </div>
        </div>
    </nav>
    <?php
    if ($keySort === 1) { ?>
        <div class="toast-container mt-4 position-fixed justify-content-center align-items-center w-100" style="text-align: -webkit-center;">
            <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="toast-header">
                    <img src="assets/img/<?php echo $logo; ?>" width="20px" class="rounded me-2">
                    <strong class="me-auto"><?php echo $importanteNombreSorteo; ?></strong>
                    <!-- <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button> -->
                </div>
                <div class="toast-body" style="text-align: start!important;">
                    <strong class="me-auto">Se agregó tu Boleto al Carrito ⚡</strong>
                    <div class="mt-2 pt-2 border-top">
                        <button style="background-color: var(--color-red);" class="btn btn-danger btn-sm" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvas-1" aria-controls="offcanvas-1">Ir al carrito</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="toast-container mt-4 position-fixed justify-content-center align-items-center w-100" style="text-align: -webkit-center;">
            <div id="liveToastReferido" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="toast-header">
                    <img src="assets/img/<?php echo $logo; ?>" width="20px" class="rounded me-2">
                    <strong class="me-auto">Comprando con Referido</span> </strong>
                    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
                <div class="toast-body" style="text-align: start!important;">
                    <strong class="me-auto">Tu amigo <span id="referidoClient"></span> te agradece por comprar con su nombre 🥳</strong>
                </div>
            </div>
        </div>
        <div class="toast-container mt-4 position-fixed justify-content-center align-items-center w-100" style="text-align: -webkit-center; width: 100px;">
            <div id="liveToast" class="toast toast__notifi" role="alert" aria-live="assertive" aria-atomic="true" data-delay="1500">
                <div class="toast-header">
                    <img src="assets/img/<?php echo $logo; ?>" width="20px" class="rounded me-2">
                    <strong class="me-auto">¡Alguien compro Boletos! 😱</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
                <div class="toast-body" style="text-align: start!important;">
                    <strong class="me-auto">
                        <span id="mns__notifi" style="font-weight: 500;"></span>
                    </strong>
                </div>
            </div>
        </div>
        <?php
        include 'plugins/registrar_boletos.php';
        include 'plugins/maquinita.php';
        include 'plugins/offcanvas_carrito.php';
        ?>

        <!-- </div> -->
        <div class="container__datos">
            <div class="container datos_stl">
                <h1 class="text-center fs-1 text__premio"><strong><?php echo $infoSorteoNombre2; ?></strong></h1>
                <h3 class="text-center fs-3 text__premio"><strong><?php echo $infoSorteoTipo2; ?></strong></h3>
                <div id="chat"></div>
            </div>
        </div>
        <div>
            <h1 class="text-center fs-1" style="font-weight: 600;margin-top: -10px!important;display: flex;align-items: center;justify-content: center;margin-bottom: -10px;"><i class="icon ion-arrow-down-b lista__boletos_descripcion"></i>LISTA DE BOLETOS ABAJO<i class="icon ion-arrow-down-b lista__boletos_descripcion"></i></h1>
        </div>
        <div id="carouselExampleInterval" style="width: 80%;margin: auto;" class="carousel slide" data-bs-ride="carousel" data-bs-touch="false">
            <div class="carousel-inner img__premio">
                <div class="carousel-item active" data-bs-interval="2000">
                    <img src="assets/img/<?php echo $Portada1; ?>" class="img_premioX d-block w-100" alt="...">
                </div>
                <?php
                $archivo = 'assets/img/por_premddddddos.png';
                if (file_exists($archivo)) {
                    echo '
                    <div class="carousel-item" data-bs-interval="3000">
                        <img src="xy.php?xy=por_premdos.png" class="img_premioX d-block w-100" alt="...">
                    </div>';
                }
                ?>
            </div>
        </div>
        <div class="container__datosD mt-5">
            <div class="container datos_stl">
                <section class="py-4 py-xl-5 container" style="padding: 13px!important;background: rgba(0,0,0,0);">
                    <h4 class="fs-4 text-center pt-3" style="color: rgb(255,255,255);"><strong><?php echo $infoSorteoDetallesBoletosSorteo2; ?></strong></h4>
                </section>
            </div>
        </div>
        <section class="spremio__kpl py-4 py-xl-5" style="padding-bottom: 20px!important;">
            <h3 class="container fs-3 text__premioKprS text-center"><strong><span><?php echo $infoSorteoPremios2; ?></span></h3>
        </section>
        <section>
            <div class="container__buscarNumero mb-4 p-4">
                <h1 class="text-center fs-1 text-white" style="font-weight: 600;margin-top: -10px!important;display: flex;align-items: center;justify-content: center;margin-bottom: -10px;"><i class="px-2 icon ion-arrow-down-b lista__boletos_descripcion"></i><strong><span>HAZ CLICK ABAJO EN TU <br> NÚMERO DE LA SUERTE</span></strong><br><i class="px-2 icon ion-arrow-down-b lista__boletos_descripcion"></i></h1>
            </div>
            <div class="container">
                <div class="row" id="ancl">
                    <div id="option__boletos" class="col text-center">
                        <div class="input-group" style="width: 400px;text-align: center;height: 40.8px;margin: 0 auto!important;margin-bottom: 8px!important;">
                            <input type="number" id="search" class="form-control fw-bolder search-boletos form-control" placeholder="Escribe un numero" name="maqu" style="border-radius: inherit!important;">
                            <h3 class="d-none fs-3"><span class="count__boletos_Final"><?php echo $total_registro; ?></h3>
                            <!-- <button id="mostrarBoletos__List" class="btn" type="button" style="background: black;color: white;">Buscar</span></button> -->
                        </div>
                        <button class="box mt-4 mb-2" type="button" style="background: #000;border-width: 0px;padding:0;" data-bs-target="#maquinita__modal" data-bs-toggle="modal">
                            <span>🤑🤑 Maquinita de la Suerte 🤑🤑</span></button>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="d-flex justify-content-center">
                <div class="row mt-3 me-2">
                        <div class="col text-center" style="/* margin-top: 30px; */margin-bottom: 9px;display: flex;align-items: center;justify-content: center;">
                            <button class="list__button" style="    /* background: var(--comprar-boletos); */
    border: 1px solid var(--comprar-boletos) !important;
    color: var(--color-text-comprar) !important;
    font-weight: 700;
    margin: 1px;
    width: 46px;
    height: 24px;
    border-radius: 8%;
    font-size: 13px;
    display: inline-flex;
    justify-content: center;
    align-items: center;"></button>
                            <span class="mx-2">DISPONIBLE</span>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col text-center" style="/* margin-top: 30px; */margin-bottom: 9px;display: flex;align-items: center;justify-content: center;">
                            <button class="list__button" style="width: 46px!important;
    height: 24px!important;background: var(--comprar-boletos)!important;
    color: var(--comprar-boletos)!important;border: 1px solid transparent!important;color: #000;padding: 1px;font-weight: 700;margin: 1px;width: 55px;height: 30px;border-radius: 8%;font-size: 17px;display: inline-flex;justify-content: center;align-items: center;border-color: black;font-size: 14px;"></button>
                            <span class="mx-2">APARTADO</span>
                        </div>
                    </div>


                </div>
                <div class="row">
                    <div class="form-check form-switch" style="display: flex;align-items: center;flex-direction: row;justify-content: center">
                        <input class="form-check-input visibility_ticks" type="checkbox" role="switch" id="flexSwitchCheckChecked" style="width: 18px;height: 10px;">
                        <label class="form-check-label mx-3 fw-bold" for="flexSwitchCheckChecked" style="margin-top: 0.6rem;">Ver todos los boletos</label>
                    </div>
                    <?php
                    if ($textboletos != 0) { ?>
                        <div class="col text-center">
                            <h3 class="fs-3"><span class="count__boletos_sq"><?php echo $total_registroX; ?></span> Boletos Disponibles de <span class="count__boletos_sq"><?php echo $total_registro; ?></span></h3>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </section>
        <section class="py-4 py-xl-5" style="padding: 0px!important;">
            <div class="u-container-layout u-valign-top-sm u-valign-top-xs u-container-layout-1">
                <div class="u-align-center u-clearfix u-group-elements u-group-elements-1">
                    <div id="datos"></div>
                    <input type="hidden" name="total_registro" id="total_registro" value="<?php echo $total_registro; ?>" />
                    <div class="card-body" style="margin-bottom: 10px;">
                        <?php
                        $suma = $total_registro - $total_registroX;
                        $porcentajeTotalBoletos = ($suma * 100) / $total_registro;
                        if ($numberprocess != 0) { ?>
                            <h4 class="fs-5 fw-bold count__boletos_por" style="text-align: center;"><?php echo round($porcentajeTotalBoletos, 2) . '%'; ?> Boletos vendidos<span class="float-end"></span></h4>

                            <?php }
                        if ($progressbar_colors != 0) {
                            if ($porcentajeTotalBoletos < 50) { ?>
                                <div class="progress" role="progressbar" aria-label="Danger example" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="height: 8px;width: 50%;margin: 0 auto;">
                                    <div class="progress-bar bg-danger" style="width: <?php echo $porcentajeTotalBoletos . '%'; ?>"></div>
                                </div>
                            <?php } elseif ($porcentajeTotalBoletos < 80) { ?>
                                <div class="progress" role="progressbar" aria-label="Warning example" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="height: 8px;width: 50%;margin: 0 auto;">
                                    <div class="progress-bar bg-warning" style="width: <?php echo $porcentajeTotalBoletos . '%'; ?>"></div>
                                </div>
                            <?php } elseif ($porcentajeTotalBoletos > 80) { ?>
                                <div class="progress" role="progressbar" aria-label="Info example" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="height: 8px;width: 50%;margin: 0 auto;">
                                    <div class="progress-bar bg-info" style="width: <?php echo $porcentajeTotalBoletos . '%'; ?>;background: #0072ffeb!important;"></div>
                                </div>
                        <?php }
                        } ?>
                    </div>
                    <div class="salida" style="text-align: center;padding-right: 10px;padding-left: 10px;"></div>
                    <div id="numeros">
                        <div id="loader"></div>
                    </div>
                </div>
            </div>
            </div>
        </section>
        <div>
            <button class="btn btn-primary ir-arriba" type="button" style="/*display: none;*/cursor: pointer;position: fixed;bottom: 20px;right: 20px;border-radius: 31px!important;padding: 5px;"><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor" viewBox="0 0 16 16" class="bi bi-arrow-up-circle-fill" style="font-size: 31px;">
                    <path d="M16 8A8 8 0 1 0 0 8a8 8 0 0 0 16 0zm-7.5 3.5a.5.5 0 0 1-1 0V5.707L5.354 7.854a.5.5 0 1 1-.708-.708l3-3a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1-.708.708L8.5 5.707V11.5z"></path>
                </svg>
            </button>
        </div>
        <?php include 'include/menujs.php'; ?>
        <script src="https://code.jquery.com/jquery-3.6.4.js" integrity="sha256-a9jBBRygX1Bh5lt8GZjXDzyOB+bWve9EiO7tROUtj/E=" crossorigin="anonymous"></script>
        <script src="assets/bootstrap/js/bootstrap.min.js?v=<?php echo time(); ?>"></script>
        <script src="assets/js/bold-and-bright.js?v=<?php echo time(); ?>"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/6.4.8/swiper-bundle.min.js?v=<?php echo time(); ?>"></script>
        <script src="assets/js/Simple-Slider.js?v=<?php echo time(); ?>"></script>
        <script src="assets/js/jquery.jscroll.js?v=<?php echo time(); ?>"></script>
        <script>
            precio = <?php echo $precio; ?>;
        </script>
        <script src="assets/js/jbl-min.js?v=<?php echo time(); ?>"></script>
        <?php
        include 'include/footer.php';  ?>
    <?php } else if ($keySort === 0) { ?>
        <div class="container-cerrado"></div>
        <div class="container">
            <div class="container py-4 py-xl-5">
                <div class="row gy-4 gy-md-0">
                    <div class="col-md-6">
                        <div class="p-xl-5 m-xl-5">
                            <img class="rounded img-fluid w-100 fit-cover" style="border-radius: 100%!important;height: 300px;border-radius: 100%!important;width: 300px;object-fit: contain;" src="assets/img/<?php echo $logo; ?>">
                        </div>
                    </div>
                    <div class="col-md-6 d-md-flex align-items-md-center">
                        <div style="max-width: 350px;">
                            <h2 class="fw-bold">Ups! No hay boletos para escoger</h2>
                            <p class="my-3">Se vendieron todos los boletos 🥳.<br>Si hay <b>Despreciados</b> aparecerán de nuevo aquí 😊&nbsp;<br></p><a class="btn btn-danger" role="button" href="/" style="border-radius: 40px!important;">Volver a Inicio</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php include 'include/menujs.php'; ?>
        <?php include 'include/footer.php' ?>
        <script src="https://code.jquery.com/jquery-3.6.4.js?v=<?php echo time(); ?>" integrity="sha256-a9jBBRygX1Bh5lt8GZjXDzyOB+bWve9EiO7tROUtj/E=" crossorigin="anonymous"></script>
        <script src="<?php echo $urlPartner ?>assets/bootstrap/js/bootstrap.min.js?v=<?php echo time(); ?>"></script>
        <script src="<?php echo $urlPartner ?>assets/js/bold-and-bright.js?v=<?php echo time(); ?>"></script>
        <script src="<?php echo $urlPartner ?>assets/js/refres.js?v=<?php echo time(); ?>"></script>
    <?php  } ?>
    <script src="assets/js/theme.js?v=<?php echo time(); ?>"></script>
</body>

</html>