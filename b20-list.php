<!-- Nuevo -->
<?php include 'app/conn.php'; ?>
<?php
if ($production != true) {
    error_reporting(0);
}
?>
<?php include 'app/varGlobal.php'; ?>
<?php include 'fetch/root.php'; ?>
<?php include 'settings_sort.php'; ?>
<?php include 'fecth/post.php'; ?>
<?php include 'partnet/cachec.php'; ?>
<?php if (empty($local)) {
    header('Location: script/index.php');
    exit;
} ?>
<?php $compiler = 1; ?>
<?php include 'logica/conteo.php'; ?>
<?php include 'logica/sorteos.php'; ?>
<?php include 'partner/estados.php'; ?>
<?php $precio = $s1_precio; ?>

<!DOCTYPE html>
<html lang="es">

<head>
    <title><?= $s1_titulo . ' - ' . $nombreCorto; ?></title>    
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8">
    <meta property="og:title" content="<?php echo $nombreCorto; ?> - Disponible AHORA🔥"">
    <meta property="og:image" content="<?php echo $urlPartner ?>assets/img/root/<?php echo $portadaprincipal; ?>?v=<?php echo time(); ?>">
    <meta property="og:url" content="">
    <meta property="og:site_name" content="<?php echo $nombreCorto; ?>">
    <meta property="og:type" content="website">
    <meta property="og:description" content="Inicio - <?php echo $nombreCorto; ?> - Disponible AHORA🔥"">
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo $urlPartner ?>assets/img/root/<?php echo $favicon; ?>?v=<?php echo time(); ?>">
    <link rel="icon" type="image/png" sizes="32x32" href="<?php echo $urlPartner ?>assets/img/root/<?php echo $favicon; ?>?v=<?php echo time(); ?>">
    <link rel="icon" type="image/png" sizes="179x180" href="<?php echo $urlPartner ?>assets/img/root/<?php echo $favicon; ?>?v=<?php echo time(); ?>">
    <link rel="icon" type="image/png" sizes="191x192" href="<?php echo $urlPartner ?>assets/img/root/<?php echo $favicon; ?>?v=<?php echo time(); ?>">
    <link rel="icon" type="image/png" sizes="510x512" href="<?php echo $urlPartner ?>assets/img/root/<?php echo $favicon; ?>?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="assets/css/root.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="assets/css/theme.css?v=<?php echo time(); ?>">

    <!-- nuevo -->
    <link rel="stylesheet" href="assets/css/newroot.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="assets/fonts/ionicons.min.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="assets/css/root.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="assets/css/theme.css?v=<?php echo time(); ?>">
    <script src="assets/js/notify.js?v=<?php echo time(); ?>"></script>


    <!-- Checar este codigo, validar que si se agrege el referido -->
    <?php include 'logoica/referidos.php'; ?>
    <script>
        let str__compiler = <?php echo $compiler; ?>;
        let referido = '<?php echo $referido; ?>';
    </script>
</head>
<body>
    <?php include 'partner/menu.php'; ?>
    <?php
    if ($keySort === 1) { ?>

        <!-- Toast Agregar Boleto -->
        <div class="toast-container mt-4 position-fixed justify-content-center align-items-center w-100 text-center">
            <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="toast-header">
                    <img src="assets/img/<?php echo $logo; ?>" width="20px" class="rounded me-2">
                    <strong class="me-auto"><?php echo $importanteNombreSorteo; ?></strong>
                    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
                <div class="toast-body" style="text-align: start!important;">
                    <strong class="me-auto">Se agregó tu Boleto al Carrito ⚡</strong>
                    <div class="mt-2 pt-2 border-top">
                        <button style="background-color: var(--color-red);" class="btn btn-danger btn-sm" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvas-1" aria-controls="offcanvas-1">Ir al carrito</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Toast Notificacion Referido -->
        <div class="toast-container mt-4 position-fixed justify-content-center align-items-center w-100 text-center">
            <div id="liveToastReferido" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="toast-header">
                    <img src="assets/img/root/<?php echo $logo; ?>" width="20px" class="rounded me-2">
                    <strong class="me-auto">Comprando con Referido</span> </strong>
                    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
                <div class="toast-body" style="text-align: start!important;">
                    <strong class="me-auto">Tu amigo <span id="referidoClient"></span> te agradece por comprar con su nombre 🥳</strong>
                </div>
            </div>
        </div>

        <!-- Toast Notificacion -->
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

        <!-- Plugins php -->
        <?php include 'plugins/modalRegister.php'; ?>
        <?php include 'pplugins/maquinita.php'; ?>
        <?php include 'plugins/offcanvas_carrito.php'; ?>

        <!-- </div> -->
        <div class="container__datos">
            <div class="container datos_stl">
                <h1 class="text-center fs-1 text__premio"><strong><?php echo $infoSorteoNombre; ?></strong></h1>
                <h3 class="text-center fs-3 text__premio"><strong><?php echo $infoSorteTipo; ?></strong></h3>
                <div id="chat"></div>
            </div>
        </div>
        <div>
            <h1 class="text-center fs-1 iconListaBoletos">
                <i class="icon ion-arrow-down-b lista__boletos_descripcion"></i>
                    LISTA DE BOLETOS ABAJO
                <i class="icon ion-arrow-down-b lista__boletos_descripcion"></i>
            </h1>
        </div>
        <div id="carouselExampleInterval" class="carousel slide carrucelDiv" data-bs-ride="carousel" data-bs-touch="false">
            <div class="carousel-inner img__premio">
                <div class="carousel-item active" data-bs-interval="2000">
                    <img src="assets/img/<?php echo $Creativo2; ?>" class="img_premioX d-block w-100" alt="...">
                </div>
                <div id="carouselStr1" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        <?php
                        // $imgs debe ser un array con los nombres (filtra vacíos y reindexa)
                        $imgs = array_values(array_filter($imgs ?? [], fn($v) => trim((string)$v) !== ''));

                        if (!empty($imgs)):
                            foreach ($imgs as $i => $nombreImg): ?>
                                <!-- <div class="carousel-item <?= $i === 0 ? 'active' : '' ?>" data-bs-interval="3000">
                                    <img
                                        src="<?= $urlPartner . 'assets/img/str/' . htmlspecialchars($nombreImg, ENT_QUOTES, 'UTF-8') ?>"
                                        class="d-block w-100"
                                        alt="Imagen <?= $i + 1 ?>">
                                </div> -->
                            <?php endforeach;
                        else: ?>
                            <div class="carousel-item active">
                                <!-- <div class="text-muted p-3">Sin imágenes</div> -->
                            </div>
                        <?php endif; ?>
                    </div>

                    <!-- Controles -->
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselStr1" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span><span class="visually-hidden">Anterior</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselStr1" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span><span class="visually-hidden">Siguiente</span>
                    </button>
                </div>



            </div>
        </div>


        <div class="container__datosD mt-5">
            <div class="container datos_stl">
                <section class="py-4 py-xl-5 container" style="padding: 13px!important;background: rgba(0,0,0,0);">
                    <h4 class="fs-4 text-center pt-0 text-white fw-bold"><?= $s1_detalles; ?></h4>
                </section>
            </div>
        </div>
        <section class="spremio__kpl py-2 py-xl-5 pb-4">
            <h3 class="container fs-3 text__premioKprS text-center"><strong><span><?= $s1_premioBonos; ?></span></h3>
        </section>
        <section>
            <div class="container__buscarNumero mb-4">
                <h1 class="text-center fs-1 text-white" style="font-weight: 600;margin-top: -10px!important;display: flex;align-items: center;justify-content: center;margin-bottom: -10px;"><i class="px-2 icon ion-arrow-down-b lista__boletos_descripcion"></i><strong><span>HAZ CLICK ABAJO EN TU <br> NÚMERO DE LA SUERTE</span></strong><br><i class="px-2 icon ion-arrow-down-b lista__boletos_descripcion"></i></h1>
            </div>
            <div class="container">
                <div class="row" id="ancl">
                    <div id="option__boletos" class="col text-center">
                        <div class="input-group" style="width: 400px;text-align: center;height: 40.8px;margin: 0 auto!important;margin-bottom: 8px!important;">
                            <input type="number" id="search" class="form-control fw-bolder search-boletos form-control" placeholder="Escribe un numero" name="maqu" style="border-radius: inherit!important;">
                            <h3 class="d-none fs-3"><span class="count__boletos_Final"><?php echo $total_registro; ?></h3>
                        </div>
                        <button class="box mt-4 mb-2 btnMaquinita" type="button" data-bs-target="#maquinita__modal" data-bs-toggle="modal">
                            <span>🤑🤑 Maquinita de la Suerte 🤑🤑</span></button>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="d-flex justify-content-center">
                    <div class="row mt-3 me-2">
                        <div class="col text-center mb-2 d-flex align-items-center justify-content-center">
                            <button class="list__button btnDisponible"></button>
                            <span class="mx-2">DISPONIBLE</span>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col text-center mb-2 d-flex align-items-center justify-content-center">
                            <button class="list__button btnApartado"></button>
                            <span class="mx-2">APARTADO</span>
                        </div>
                    </div>


                </div>
                <div class="row">
                    <div class="form-check form-switch switchBoletos">
                        <input class="form-check-input visibility_ticks w-18-h-10" type="checkbox" role="switch" id="flexSwitchCheckChecked">
                        <label class="form-check-label mx-3 my-2 fw-bold" for="flexSwitchCheckChecked">Ver todos los boletos</label>
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


        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

        <?php include 'include/menujs.php'; ?>
        <script src="https://code.jquery.com/jquery-3.6.4.js" integrity="sha256-a9jBBRygX1Bh5lt8GZjXDzyOB+bWve9EiO7tROUtj/E=" crossorigin="anonymous"></script>
        <script src="assets/bootstrap/js/bootstrap.min.js?v=<?php echo time(); ?>"></script>
        <script src="assets/js/bold-and-bright.js?v=<?php echo time(); ?>"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/6.4.8/swiper-bundle.min.js?v=<?php echo time(); ?>"></script>
        <script src="assets/js/Simple-Slider.js?v=<?php echo time(); ?>"></script>
        <script src="assets/js/jquery.jscroll.js?v=<?php echo time(); ?>"></script>
        <script>
            precio = <?= $precio; ?>;
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

        <!-- includes -->
        <?php include 'include/menujs.php'; ?>
        <?php include 'include/footer.php' ?>
        <script src="https://code.jquery.com/jquery-3.6.4.js?v=<?php echo time(); ?>" integrity="sha256-a9jBBRygX1Bh5lt8GZjXDzyOB+bWve9EiO7tROUtj/E=" crossorigin="anonymous"></script>
        <script src="<?php echo $urlPartner ?>assets/bootstrap/js/bootstrap.min.js?v=<?php echo time(); ?>"></script>
        <script src="<?php echo $urlPartner ?>assets/js/bold-and-bright.js?v=<?php echo time(); ?>"></script>
        <script src="<?php echo $urlPartner ?>assets/js/refres.js?v=<?php echo time(); ?>"></script>
    <?php  } ?>
</body>

</html>