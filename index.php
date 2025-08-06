<?php
include $urlPartner . '/plugins/cache.php';
include('app/vConn.php');
if (empty($local)) {
    header('Location: script/index.php');
    exit;
}


include 'logica/logica__index.php';
include 'sys.php';
$data = file_get_contents("app/post.json");
$post = json_decode($data);

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <title><?php echo 'Inicio - ' . $importanteNombreCorto; ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8">
    <meta property="og:title" content="<?php echo $importanteNombreCorto; ?>">
    <meta property="og:image" content="assets/img/portada.png">
    <meta property="og:url" content="">
    <meta property="og:site_name" content="<?php echo $importanteNombreCorto; ?>">
    <meta property="og:type" content="website">
    <meta property="og:description" content="Inicio - <?php echo $importanteNombreCorto; ?>">
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo $urlPartner ?>assets/img/<?php echo $favicon; ?>?v=<?php echo time(); ?>">
    <link rel="icon" type="image/png" sizes="32x32" href="<?php echo $urlPartner ?>assets/img/<?php echo $favicon; ?>?v=<?php echo time(); ?>">
    <link rel="icon" type="image/png" sizes="179x180" href="<?php echo $urlPartner ?>assets/img/<?php echo $favicon; ?>?v=<?php echo time(); ?>">
    <link rel="icon" type="image/png" sizes="191x192" href="<?php echo $urlPartner ?>assets/img/<?php echo $favicon; ?>?v=<?php echo time(); ?>">
    <link rel="icon" type="image/png" sizes="510x512" href="<?php echo $urlPartner ?>assets/img/<?php echo $favicon; ?>?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="assets/css/root.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="assets/css/theme.css?v=<?php echo time(); ?>">
    <?php
    include 'include/meta_head.php';
    ?>


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
    <div class="carousel slide container-index" data-bs-ride="carousel" id="carousel-1" style="height: 500px!important;">
        <div class="carousel-inner h-100">
            <div class="carousel-item active h-100 parallax" style="background-image: url('assets/img/<?php echo $Creativo1; ?>')">
                <div class="container d-flex flex-column justify-content-center h-100">
                    <div class="row">
                        <div class="text-center container">
                            <div class="container">
                                <a href="<?php echo $linkPSorteo; ?>" class="btn btn-danger rounded-0 fs-5" type="button" style="border: solid;">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-caret-right-fill" viewBox="0 0 16 16">
                                        <path d="m12.14 8.753-5.482 4.796c-.646.566-1.658.106-1.658-.753V3.204a1 1 0 0 1 1.659-.753l5.48 4.796a1 1 0 0 1 0 1.506z" />
                                    </svg>
                                    LISTA DE DISPONIBLES
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-caret-left-fill" viewBox="0 0 16 16">
                                        <path d="m3.86 8.753 5.482 4.796c.646.566 1.658.106 1.658-.753V3.204a1 1 0 0 0-1.659-.753l-5.48 4.796a1 1 0 0 0 0 1.506z" />
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="text-center st__nav" style="color: white;">
        <div class="container row">
            <div class="col-md-12 p-3">
                <h1 class="fs-1" style="text-shadow: 1px 3px 5px #000;"><strong>PREGUNTAS FRECUENTES</strong></h1>
            </div>
        </div>
    </div>
    <div class="container mt-4">
        <div class="accordion" id="accordionPanelsStayOpenExample">
            <?php
            $faq1 = $faqJ1;
            $faq2 = $faqJ2;
            $faq3 = $faqJ3;
            $faq4 = $faqJ4;
            $faq5 = $faqJ5;

            $prefixes = [
                $respuestaJ1,
                $respuestaJ2,
                $respuestaJ3,
                $respuestaJ4,
                $respuestaJ5
            ];

            $printedFirst = false;
            for ($i = 0; $i < count($prefixes); $i++) {
                $variable = "faq" . ($i + 1);
                $prefix = $prefixes[$i];
                if (!empty($$variable)) {
                    echo '
                        <div class="">
                            <h2 class="fs-2 container text-primary fw-bolder text-center preguntasFrecuentes">

                                ' . $$variable . '
                            </h2>
                            <div class="fw-bolder respuestasFrecuentes">
                                ' . $prefix . '
                            </div>
                        </div>';
                }
            }
            ?>
        </div>
    </div>
    <div class="text-center st__nav" style="color: white;">
        <div class="container row">
            <div class="col-md-12 p-3">
                <h1 class="fs-1" style="text-shadow: 1px 3px 5px #000;"><strong>CONTACTO</strong></h1>
            </div>
        </div>
    </div>
    <div>
        <div class="mt-4 text-center px-2 d-flex justify-content-center">
            <h6 class="fs-2 fw-bold">WHATSAPP: <a href="https://wa.me/<?php echo $_SESSION['whatsApp']; ?>" class="link-offset-2" style="color: var(--bs-link-hover-color);text-decoration: underline;"><?php echo $_SESSION['whatsApp']; ?></a></h6>
        </div>
        <div class="mt-2 text-center px-2 d-flex justify-content-center">
            <?php
            if ($facebook != '') { ?>
                <div class="d-flex align-items-center p-3 mt-2 text-center px-2 d-flex justify-content-center">
                    <div class="px-2">
                        <p class="mb-0">
                            <a class="links_dark" href="<?php echo $facebook; ?>" target="_blank">
                                <div class="bs-icon-md bs-icon-rounded d-flex flex-shrink-0 justify-content-center align-items-center d-inline-block bs-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="3em" height="3em" fill="currentColor" viewBox="0 0 16 16" class="bi bi-facebook">
                                        <path d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951z"></path>
                                    </svg>
                                </div>
                            </a>
                        </p>
                    </div>
                </div>
            <?php }
            ?>
            <div class="mx-3 d-flex align-items-center p-3 mt-2 text-center px-2 d-flex justify-content-center">
                <div class="px-2">
                    <p class="mb-0">
                        <a class="links_dark" href="https://wa.me/<?php echo $_SESSION['whatsApp']; ?>" target="_blank">
                            <div class="bs-icon-md bs-icon-rounded d-flex flex-shrink-0 justify-content-center align-items-center d-inline-block bs-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="3em" height="3em" fill="currentColor" viewBox="0 0 16 16" class="bi bi-whatsapp">
                                    <path d="M13.601 2.326A7.854 7.854 0 0 0 7.994 0C3.627 0 .068 3.558.064 7.926c0 1.399.366 2.76 1.057 3.965L0 16l4.204-1.102a7.933 7.933 0 0 0 3.79.965h.004c4.368 0 7.926-3.558 7.93-7.93A7.898 7.898 0 0 0 13.6 2.326zM7.994 14.521a6.573 6.573 0 0 1-3.356-.92l-.24-.144-2.494.654.666-2.433-.156-.251a6.56 6.56 0 0 1-1.007-3.505c0-3.626 2.957-6.584 6.591-6.584a6.56 6.56 0 0 1 4.66 1.931 6.557 6.557 0 0 1 1.928 4.66c-.004 3.639-2.961 6.592-6.592 6.592zm3.615-4.934c-.197-.099-1.17-.578-1.353-.646-.182-.065-.315-.099-.445.099-.133.197-.513.646-.627.775-.114.133-.232.148-.43.05-.197-.1-.836-.308-1.592-.985-.59-.525-.985-1.175-1.103-1.372-.114-.198-.011-.304.088-.403.087-.088.197-.232.296-.346.1-.114.133-.198.198-.33.065-.134.034-.248-.015-.347-.05-.099-.445-1.076-.612-1.47-.16-.389-.323-.335-.445-.34-.114-.007-.247-.007-.38-.007a.729.729 0 0 0-.529.247c-.182.198-.691.677-.691 1.654 0 .977.71 1.916.81 2.049.098.133 1.394 2.132 3.383 2.992.47.205.84.326 1.129.418.475.152.904.129 1.246.08.38-.058 1.171-.48 1.338-.943.164-.464.164-.86.114-.943-.049-.084-.182-.133-.38-.232z"></path>
                                </svg>
                            </div>
                        </a>
                    </p>
                </div>
            </div>
            <?php ?>
        </div>
    </div>
    <div class="text-center justify-content-center mb-4">
        <div class="fb-page" data-href="<?php echo $facebook; ?>" data-tabs="" data-width="" data-height="" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true">
            <blockquote cite="https://www.facebook.com/facebook" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/facebook">Facebook</a></blockquote>
        </div>

    </div>
    <?php
    include 'include/footer.php';
    include 'include/meta_script.php';

    ?>
    <div id="fb-root"></div>
    <script async defer crossorigin="anonymous" src="https://connect.facebook.net/es_ES/sdk.js#xfbml=1&version=v16.0" nonce="OpGDPo6d"></script>
    <?php include 'include/menujs.php'; ?>
    <script src="https://code.jquery.com/jquery-3.6.4.js?v=<?php echo time(); ?>" integrity="sha256-a9jBBRygX1Bh5lt8GZjXDzyOB+bWve9EiO7tROUtj/E=" crossorigin="anonymous"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js?v=<?php echo time(); ?>"></script>
    <script src="assets/js/bold-and-bright.js?v=<?php echo time(); ?>"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/6.4.8/swiper-bundle.min.js"></script>
    <script src="assets/js/Simple-Slider.js?v=<?php echo time(); ?>"></script>
    <script src="assets/js/theme.js?v=<?php echo time(); ?>"></script>
</body>

</html>