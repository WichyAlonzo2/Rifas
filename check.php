<?php
include $urlPartner . '/plugins/cache.php';
include 'logica/logica__check.php';
include 'root.php';
include 'sys.php';
date_default_timezone_set("America/Mexico_City");
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <title>Verificador de <?php echo $infoSorteoNombre . ' - ' . $nombreCorto; ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8">
    <meta property="og:title" content="Verificador de <?php echo $infoSorteoNombre . ' - ' . $nombreCorto; ?>">
    <meta property="og:image" content="assets/img/portada.png">
    <meta property="og:site_name" content="<?php echo $nombreCorto; ?>">
    <meta property="og:type" content="website">
    <meta property="og:description" content="Verificador de <?php echo $nombreCorto; ?>" />
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo $urlPartner ?>assets/img/<?php echo $favicon; ?>?v=<?php echo time(); ?>">
    <link rel="icon" type="image/png" sizes="32x32" href="<?php echo $urlPartner ?>assets/img/<?php echo $favicon; ?>?v=<?php echo time(); ?>">
    <link rel="icon" type="image/png" sizes="179x180" href="<?php echo $urlPartner ?>assets/img/<?php echo $favicon; ?>?v=<?php echo time(); ?>">
    <link rel="icon" type="image/png" sizes="191x192" href="<?php echo $urlPartner ?>assets/img/<?php echo $favicon; ?>?v=<?php echo time(); ?>">
    <link rel="icon" type="image/png" sizes="510x512" href="<?php echo $urlPartner ?>assets/img/<?php echo $favicon; ?>?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="assets/css/root.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="assets/css/theme.css?v=<?php echo time(); ?>">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js?v=<?php echo time(); ?>"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.10.2/umd/popper.min.js?v=<?php echo time(); ?>"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.5.0/dist/js/bootstrap.bundle.min.js?v=<?php echo time(); ?>"></script>
    <script>
        let compiler = 1;
    </script>
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
    <div class="container-checkO"></div>
    <div class="container">
        <div>
            <div class="row">
                <div class="col-xl-12">
                    <h2 class="fs-2" style="font-family: Montserrat, sans-serif;font-weight: bold;">Verificador de Boleto<br> <span style="color:var(--comprar-boletos)">(<?php echo $infoSorteoNombre; ?>)</span></h2>
                </div>
            </div>
        </div>
        <div class="input-group-text container-fluid" style="border: 0px;background: transparent;padding-left: 0px;padding-right: 0px!important;">
            <input type="text" class="form-control" id="txtbusca" placeholder="Escribe Tu Nombre, Folio o Numero de Boleto" style="border-radius: 0px;">
        </div>
    </div>
    <div class="salida">

    </div>
    <?php include 'include/menujs.php'; ?>
    <?php include 'include/footer.php' ?>
    <script src="https://code.jquery.com/jquery-3.6.4.js?v=<?php echo time(); ?>" integrity="sha256-a9jBBRygX1Bh5lt8GZjXDzyOB+bWve9EiO7tROUtj/E=" crossorigin="anonymous"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js?v=<?php echo time(); ?>"></script>
    <script src="assets/js/bold-and-bright.js?v=<?php echo time(); ?>"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/6.4.8/swiper-bundle.min.js"></script>
    <script src="include/sblts.js?v=<?php echo time(); ?>"></script>
    <script src="assets/js/theme.js?v=<?php echo time(); ?>"></script>
</body>

</html>