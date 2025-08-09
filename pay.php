<?php
include 'logica/logica__pay.php';
include 'sys.php';
include 'root.php';
$filepath = 'app/tarjetas.json';
$json_string = file_get_contents($filepath);
$json = json_decode($json_string, true);

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <title>Formas de Pago - <?php echo $nombreCorto; ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8">
    <meta property="og:title" content="Formas de Pago - <?php echo $nombreCorto; ?>">
    <meta property="og:image" content="/assets/img/portada.png">
    <meta property="og:site_name" content="<?php echo $nombreCorto; ?>">
    <meta property="og:type" content="website">
    <meta property="og:description" content="Formas de Pago - <?php echo $nombreCorto; ?>" />
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo $urlPartner ?>assets/img/<?php echo $favicon; ?>?v=<?php echo time(); ?>">
    <link rel="icon" type="image/png" sizes="32x32" href="<?php echo $urlPartner ?>assets/img/<?php echo $favicon; ?>?v=<?php echo time(); ?>">
    <link rel="icon" type="image/png" sizes="179x180" href="<?php echo $urlPartner ?>assets/img/<?php echo $favicon; ?>?v=<?php echo time(); ?>">
    <link rel="icon" type="image/png" sizes="191x192" href="<?php echo $urlPartner ?>assets/img/<?php echo $favicon; ?>?v=<?php echo time(); ?>">
    <link rel="icon" type="image/png" sizes="510x512" href="<?php echo $urlPartner ?>assets/img/<?php echo $favicon; ?>?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="assets/css/root.css?v=<?php echo time(); ?>">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js?v=<?php echo time(); ?>"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.10.2/umd/popper.min.js?v=<?php echo time(); ?>"></script>
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.5.0/dist/js/bootstrap.bundle.min.js"></script> -->
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
    <div class="container">
        <div class="col">
            <div class="row">
                <div class="col-md-8 col-xl-6 text-center mx-auto">
                    <h2 class="mt-3"><strong>Formas de Pago</strong></h2>
                    <p class="w-lg-50" style="font-family: Inter, sans-serif;"><strong>Realizar tu pago al momento de comprar tu boleto</strong><br><strong>Sino seran eliminados tus boletos. <span class="px-2" style="background-color:black; color:white;"> Envía la Captura de Pago </span><br>a </strong><a href="https://wa.me/<?php echo $_SESSION['whatsApp']; ?>"><strong>WhatsApp</strong></a><br><strong></span></p>
                    <p class="w-lg-50" style="font-family: Inter, sans-serif;"><span style="color: aliceblue;background: black;padding-left: 10px;padding-right: 10px;padding-top: 3px;padding-bottom: 3px;">Instrucciones:</span><br>1. Escoge la tarjeta.<br>2. Copea la <b class="payDesc">CLABE</b> o <b class="payDesc">Numero de Cuenta</b><br>3. Ve a la aplicacion donde depositaras <br> Pega y Paga tus Boletos.</p>
                </div>
            </div>
        </div>
        <div class="container mb-4">
            <div class="row gy-4 row-cols-1 row-cols-md-2 row-cols-xl-3 justify-content-center" style="margin-top: 0px;">
                <?php

                $filepath = 'app/tarjetas.json';
                $json_string = file_get_contents($filepath);
                $json = json_decode($json_string, true);

                foreach ($json as $banco) {
                    if ($banco['nombreBanco'] != '') { ?>
                        <div class="col-12 col-md-6 col-lg-6 col-xxl-4 pay_kp" style="border: 3px solid #f8f8f8;padding-top: 16px;border-radius: 10px;margin-right: 10px;margin-top: 10px!important;">
                            <p class="text-start" style="width: auto;margin-bottom: 0px!important;">
                                <img class="img__banco" src="assets/img/pay/<?php echo ($banco['logoBanco']); ?>">
                                <span style="color: var(--color-red);">
                                    Banco:
                                </span>
                                <span style="color:#3560eb;">
                                    <?php echo ($banco['nombreBanco']); ?>

                                </span>
                            </p>
                            <span style="color: var(--color-red);">
                                Tipo:
                            </span>
                            <span style="color:#3560eb;">
                                <?php echo ($banco['tipo']); ?>

                            </span>
                            <?php
                            foreach ($banco['info'] as $infoTarjeta) { ?>
                            <br>
                            <span style="color: var(--color-red);">
                                Nombre:
                            </span>
                            <span style="color:#3560eb;">
                            <?php echo ($infoTarjeta['nombrePersona']); ?>

                            </span>
                                <?php
                                if ($infoTarjeta['clave'] == "") {
                                } else { ?>
                                    <div class="input-group mb-3" style="width: 350px;">
                                        <h1 id="p<?php echo $i++; ?>" class="fs-6 paynumber"><span class="me-1" style="color:orange">CLABE: </span> <?php echo ($infoTarjeta['clave']); ?></h1>
                                        <button onclick="copyToClipboard('p<?php echo $o++; ?>')" class="input-group-text comprar" style="padding-left: 11px;padding-right: 13px;border-radius: 0px 10px 10px 0px;" type="button"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" width="1em" height="1em" fill="currentColor" style="margin: 0px!important;">
                                                <path d="M502.6 70.63l-61.25-61.25C435.4 3.371 427.2 0 418.7 0H255.1c-35.35 0-64 28.66-64 64l.0195 256C192 355.4 220.7 384 256 384h192c35.2 0 64-28.8 64-64V93.25C512 84.77 508.6 76.63 502.6 70.63zM464 320c0 8.836-7.164 16-16 16H255.1c-8.838 0-16-7.164-16-16L239.1 64.13c0-8.836 7.164-16 16-16h128L384 96c0 17.67 14.33 32 32 32h47.1V320zM272 448c0 8.836-7.164 16-16 16H63.1c-8.838 0-16-7.164-16-16L47.98 192.1c0-8.836 7.164-16 16-16H160V128H63.99c-35.35 0-64 28.65-64 64l.0098 256C.002 483.3 28.66 512 64 512h192c35.2 0 64-28.8 64-64v-32h-47.1L272 448z"></path>
                                            </svg>
                                        </button>
                                    </div>

                                <?php }

                                if ($infoTarjeta['numero'] == "") {
                                } else { ?>
                                    <div class="input-group mb-3" style="width: 350px;">
                                        <h1 id="p<?php echo $i++; ?>" class="fs-6 paynumber"><span class="me-1" style="color:orange">Numero: </span> <?php echo ($infoTarjeta['numero']); ?></h1>
                                        <button onclick="copyToClipboard('p<?php echo $o++; ?>')" class="input-group-text comprar" style="padding-left: 11px;padding-right: 13px;border-radius: 0px 10px 10px 0px;" type="button"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" width="1em" height="1em" fill="currentColor" style="margin: 0px!important;">
                                                <path d="M502.6 70.63l-61.25-61.25C435.4 3.371 427.2 0 418.7 0H255.1c-35.35 0-64 28.66-64 64l.0195 256C192 355.4 220.7 384 256 384h192c35.2 0 64-28.8 64-64V93.25C512 84.77 508.6 76.63 502.6 70.63zM464 320c0 8.836-7.164 16-16 16H255.1c-8.838 0-16-7.164-16-16L239.1 64.13c0-8.836 7.164-16 16-16h128L384 96c0 17.67 14.33 32 32 32h47.1V320zM272 448c0 8.836-7.164 16-16 16H63.1c-8.838 0-16-7.164-16-16L47.98 192.1c0-8.836 7.164-16 16-16H160V128H63.99c-35.35 0-64 28.65-64 64l.0098 256C.002 483.3 28.66 512 64 512h192c35.2 0 64-28.8 64-64v-32h-47.1L272 448z"></path>
                                            </svg>
                                        </button>
                                    </div>

                            <?php }
                            } ?>
                        </div>
                    <?php }
                    ?>

                <?php }
                ?>
            </div>
        </div>
    </div>
    <?php include 'include/menujs.php'; ?>
    <?php include 'include/footer.php' ?>
    <script src="https://code.jquery.com/jquery-3.6.4.js?v=<?php echo time(); ?>" integrity="sha256-a9jBBRygX1Bh5lt8GZjXDzyOB+bWve9EiO7tROUtj/E=" crossorigin="anonymous"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js?v=<?php echo time(); ?>"></script>
    <script src="assets/js/bold-and-bright.js?v=<?php echo time(); ?>"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/6.4.8/swiper-bundle.min.js"></script>
    <script src="assets/js/theme.js?v=<?php echo time(); ?>"></script>
    <script type="text/javascript">
        function copyToClipboard(elementId) {
            var aux = document.createElement("input");
            aux.setAttribute("value", document.getElementById(elementId).innerHTML);
            document.body.appendChild(aux);
            aux.select();
            document.execCommand("copy");
            document.body.removeChild(aux);
            alert('Se copio el numero de Tarjeta');
        }
        $('.linkbutton').click(function() {
            window.location = '<?php echo $urlPartner . $linkPSorteo ?>';
        });
    </script>
</body>

</html>