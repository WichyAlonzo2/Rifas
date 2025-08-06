<?php
include $urlPartner . '/app/conn.php';
include $urlPartner . '/app/varGlobal.php';
include $urlPartner . '/tarjetas.php';
include $urlPartner . '/root.php';

session_start();
$usuarioingresado = $_SESSION['user'];
$pass = $_SESSION['pass'];
$rol = $_SESSION['rol'];
if (isset($_SESSION['user'])) {

    if ($rol == 1) {
        // No Code

    } elseif ($rol == 4) {
        echo '  <script type="text/javascript">
                            window.location.href = "param"; // Reemplaza con la URL a la que deseas redirigir
                        </script>';
    }
} else {
    header('location: /user_v2/');
}

$status = intval($_GET['id']);
$dbUse = '';
$active = '';
if ($status === 1) {
    $dbUse = '';
    $active = 'active';
    $titleStatus = $infoSorteoNombre;
    $urlSorteo = $linkPSorteo;
} else if ($status === 2) {
    $dbUse = '_two';
    $active = 'active';
    $titleStatus = $infoSorteoNombre2;
    $urlSorteo = $linkPSorteo2;
} else if ($status === 3) {
    $dbUse = '_tree';
    $active = 'active';
    $titleStatus = $infoSorteoNombre3;
    $urlSorteo = $linkPSorteo3;
} else {
    echo '  <script type="text/javascript">
                window.location.href = "ref?id=1"; // Reemplaza con la URL a la que deseas redirigir
            </script>';
}


include $urlPartner . '/root.php';

// Libre
$result = mysqli_query($db, "SELECT COUNT(*) AS `count` FROM `info_boletos$dbUse` WHERE statusBoleto='No'");
$row = mysqli_fetch_array($result);
$countFree = $row['count'];

// Pagados
$result = mysqli_query($db, "SELECT COUNT(*) AS `count` FROM `info_boletos$dbUse` WHERE statusBoleto='Pagado'");
$row = mysqli_fetch_array($result);
$countPay = $row['count'];

// Apartados
$result = mysqli_query($db, "SELECT COUNT(*) AS `count` FROM `info_boletos$dbUse` WHERE statusBoleto='Apartado'");
$row = mysqli_fetch_array($result);
$countApar = $row['count'];

// Pronto Pago
$result = mysqli_query($db, "SELECT COUNT(*) AS `count` FROM `info_boletos$dbUse` WHERE prontoPago='Si'");
$row = mysqli_fetch_array($result);
$countPronto = $row['count'];

// Conteo de los Boletos en General
$result = mysqli_query($db, "SELECT COUNT(*) AS `count` FROM `info_boletos$dbUse`");
$row = mysqli_fetch_array($result);
$countBoletos = $row['count'];

if ($countBoletos != 0) {
    $redoundFree = ($countFree * 100) / $countBoletos;
    $porcenFree = round($redoundFree, 2);

    $redoundApar = ($countApar * 100) / $countBoletos;
    $porcenApar = round($redoundApar, 2);

    $redoundPay = ($countPay * 100) / $countBoletos;
    $porcenPay = round($redoundPay, 2);

    $redoundPronto = ($countPronto * 100) / $countBoletos;
    $porcenPronto = round($redoundPronto, 2);
} else {
    // Manejar el caso de $countBoletos igual a cero
    // echo "No se puede calcular el porcentaje cuando el total de boletos es cero.";
}

// Suma de ganancias
$consultax = ("SELECT SUM(total) as total FROM sorteomini$dbUse;");
$resulx = mysqli_query($db, $consultax);
$datax = mysqli_fetch_array($resulx);
$caja = $datax['total'];

// Suma de Apartados
$consultaxx = ("SELECT SUM(pagos) as pagos FROM sorteomini$dbUse WHERE pagos > 0");
$resulxx = mysqli_query($db, $consultaxx);
$dataxx = mysqli_fetch_array($resulxx);
$pagos = $dataxx['pagos'];

// Suma de Apartados + Negativos
$consultaxxx = ("SELECT SUM(pagos) as pagos FROM sorteomini$dbUse WHERE pagos < 0");
$resulxxx = mysqli_query($db, $consultaxxx);
$dataxxx = mysqli_fetch_array($resulxxx);
$pagosNegativos = $dataxxx['pagos'];
$pagosN = -$pagos + $pagosNegativos;


// Tipos de pago
$queryTypePay = "SELECT typePay, COUNT(*) as total FROM sorteomini$dbUse GROUP BY typePay";


?>
<!DOCTYPE html>
<html lang="en" class="dark-style layout-navbar-fixed layout-menu-fixed layout-compact " dir="ltr" data-theme="theme-default" data-assets-path="assets/" data-template="vertical-menu-template-dark">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0">

    <title>Status <?php echo $titleStatus . ' - ' . $importanteNombreCorto ?></title>

    <meta name="description" content="Start your development with a Dashboard for Bootstrap 5">
    <meta name="keywords" content="dashboard, bootstrap 5 dashboard, bootstrap 5 design, bootstrap 5">
    <!-- Canonical SEO -->
    <link rel="canonical" href="https://1.envato.market/vuexy_admin">


    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="assets/img/favicon/favicon.ico">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin="">
    <link href="css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&ampdisplay=swap" rel="stylesheet">

    <!-- Icons -->
    <link rel="stylesheet" href="assets/vendor/fonts/fontawesome.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

    <link rel="stylesheet" href="assets/vendor/fonts/tabler-icons.css">
    <link rel="stylesheet" href="assets/vendor/fonts/flag-icons.css">

    <!-- Core CSS -->
    <link rel="stylesheet" href="assets/vendor/css/rtl/core-dark.css" class="template-customizer-core-css">
    <link rel="stylesheet" href="assets/vendor/css/rtl/theme-default-dark.css" class="template-customizer-theme-css">
    <link rel="stylesheet" href="assets/css/demo.css">



    <link rel="stylesheet" href="assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css">
    <link rel="stylesheet" href="assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs5/jszip-2.5.0/dt-1.12.1/b-2.2.3/b-colvis-2.2.3/b-html5-2.2.3/b-print-2.2.3/datatables.min.css" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="assets/vendor/libs/node-waves/node-waves.css">
    <link rel="stylesheet" href="assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css">
    <link rel="stylesheet" href="assets/vendor/libs/typeahead-js/typeahead.css">
    <link rel="stylesheet" href="assets/vendor/libs/apex-charts/apex-charts.css">
    <style>
        .paginate_button.current {
            margin: 3px;
            background: var(--bs-link-color);
            padding: 12px;
            border-radius: 10px;
        }

        .paginate_button {
            margin: 3px;
            background: var(--bs-border-color);
            padding: 12px;
            border-radius: 10px;
        }

        /* ===== Scrollbar CSS ===== */
        /* Firefox */
        * {
            scrollbar-width: auto;
            scrollbar-color: #ededed #282e4f;
        }

        /* Chrome, Edge, and Safari */
        *::-webkit-scrollbar {
            width: 8px;
        }

        *::-webkit-scrollbar-track {
            background: #282e4f;
        }

        *::-webkit-scrollbar-thumb {
            background-color: #ededed;
            border-radius: 5px;
            border: 0px dotted #000000;
        }

        /* Codigo Boleto style */


        .ticket_color {
            background-color: black;
            height: auto;
        }


        /* Codigo Boleto style */


        .ticket .ticket__first-section {
            pointer-events: none;
        }

        .ticket_loaderGif {
            width: 50px;
            height: 50px;
        }

        @media (max-width:950px) {
            .ticket_loaderGif {
                width: 50px;
                height: 50px;
            }
        }

        .ticket-complete {
            display: none !important;
        }

        .ticket-verify__table-container {
            display: flex;
            justify-content: center;
            overflow: auto;
        }

        @media (max-width:950px) {
            .ticket-verify__table-container {
                display: flex;
                justify-content: left;
                overflow: auto;
                width: 95%;
                margin-left: auto;
                margin-right: auto;
                padding-left: auto;
                padding-right: auto;
                border: 2px solid #000;
            }
        }

        .ticket-verify__table {
            border-collapse: collapse;
            border: 2px solid #000;
        }

        @media (max-width:950px) {
            .ticket-verify__table {
                border-collapse: collapse;
                border: none;
            }
        }

        .ticket-verify__table thead {
            background-color: #000;
        }

        .ticket-verify__table thead tr th {
            color: #fff;
            padding: 7px;
            text-align: center;
        }

        .ticket-verify__table tbody tr td {
            padding: 15px;
            text-align: center;
        }

        .ticket__form {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            padding: 25px 0;
        }

        .ticket__form input[type=text] {
            padding-left: 10px;
            padding-right: 10px;
            margin-right: 10px;
            margin-left: 10px;
            margin-bottom: 10px;
            border-radius: 3px;
            border: 3px solid #4a4a4a;
            font-family: "POPPINS SEMI BOLD", serif;
            font-size: 18px;
            width: 300px;
            height: 35px;
        }

        .ticket__form p {
            font-size: 22px;
            color: #cf1515;
            font-family: "POPPINS SEMI BOLD", serif;
        }

        .ticket__form button {
            background-color: #093c8a;
            color: #fff;
            border-radius: 3px;
            border: 3px solid #000;
            width: 150px;
            height: 45px;
            font-size: 23px;
            margin-left: 30px;
        }

        .list,
        .ticket__form button {
            text-align: center;
            font-family: "POPPINS SEMI BOLD", serif;
        }

        .list .list__tickets small {
            display: block;
            margin: 5px;
            color: #ff0;
            align-content: center;
            font-size: 14px;
        }

        .list .list__tickets {
            background: #212121;
            padding: 10px;
            color: #fff;
            text-align: center;
            left: 0;
            right: 0;
            justify-content: center;
            font-size: 12px;
        }

        .list .list__tickets.fixed {
            top: 120px;
            position: fixed;
            z-index: 1;
            left: 0;
            right: 0;
        }

        .list .list__tickets .list__button {
            color: #fff;
            background-color: #212121;
        }

        .list .list__tickets .list__tickets-button {
            background-color: transparent;
            border: 2px solid #093c8a;
            border-radius: 3px;
            text-transform: uppercase;
            font-weight: 700;
            font-size: 20px;
            padding: 8px 50px;
            margin-bottom: 10px;
            color: #fff;
            align-content: center;
        }

        .list .list__tickets .list__tickets-reserved-container {
            width: 90%;
            margin: auto;
        }

        @media (max-width:768px) {
            .list__tickets .list__tickets-reserved-container {
                width: 80%;
            }
        }

        @media (max-width:950px) {
            .list .list__tickets.fixed {
                top: 0;
                padding-top: 90px;
            }
        }

        @media (max-width:950px) {
            .ticket__form button {
                background-color: #093c8a;
                color: #fff;
                border-radius: 3px;
                text-align: center;
                border: 3px solid #000;
                width: 150px;
                height: 45px;
                font-family: "POPPINS SEMI BOLD", serif;
                font-size: 23px;
                margin-left: 0;
                margin-top: 0;
            }
        }

        .ticket {
            width: 360px;
            margin: auto;
            position: relative;
            display: flex;
            flex-direction: column;
            border-radius: 15px;
            color: black;
            margin-bottom: 15px;
        }

        .ticket>aside {
            position: absolute;
            -webkit-transform: rotate(-90deg);
            transform: rotate(-90deg);
            width: 571px !important;
            z-index: 1000;
            text-align: center;
            color: #fff;
            font-weight: bolder;
            text-transform: uppercase;
            font-size: 16px;
            letter-spacing: 4px;
            z-index: 0;
            font-family: "arial" !important;
            margin: 0;
            padding: 0;
            white-space: nowrap;
        }

        .ticket__aside-container {
            display: flex;
        }


        /*
    Pagina Ticket
*/

        .ticket>aside:first-of-type {
            right: 57px;
            top: 50%;
            transform: translateY(-50%) rotate(-90deg);
        }

        .ticket>aside:last-of-type {
            left: 58px;
            top: 50%;
            transform: translateY(-50%) rotate(-90deg);
        }


        /*
    Pagina Panel
*/

        .ticket>aside.primary {
            right: 57px;
            top: 50%;
            transform: translateY(-50%) rotate(-90deg);
        }

        .ticket>aside.secundary {
            left: 58px;
            top: 50%;
            transform: translateY(-50%) rotate(-90deg);
        }


        /*

*/

        .ticket>section {
            background-color: #fff;
            font-family: "BAHNSCHRIFT";
        }

        .ticket .ticket__first-section>section:first-of-type>img {
            height: 129px;
            width: auto;
        }

        .ticket .ticket__first-section {
            margin: 3px 32px;
        }

        .ticket .ticket__first-section>section:first-of-type {
            padding: 3px 50px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .ticket .ticket__first-section>section:nth-of-type(2) {
            border-top: 2px dashed #b9b9b9;
            /*border-bottom: 2px dashed #000;*/
            padding: 10px;
            font-size: 17px;
            display: flex;
            height: 45px;
        }

        .ticket .ticket__first-section>section:nth-of-type(2)>div {
            display: flex;
            flex-direction: column;
            color: red;
            font-weight: 700;
            flex-grow: 1;
            align-items: center;
            font-family: "POPPINS SEMI BOLD";
        }

        .ticket .ticket__first-section>section:nth-of-type(2)>div>ul {
            display: flex;
            flex-wrap: wrap;
            list-style-type: none;
            padding: 0;
            margin: 0;
            font-size: 12px;
        }

        .ticket .ticket__first-section>ul {
            list-style-type: none;
            padding: 0 10px;
            margin: 10px 0 0;
            height: 172px;
        }

        .ticket .ticket__first-section>ul>li {
            height: 28px;
            display: flex;
        }

        .ticket .ticket__first-section>ul>li>p {
            margin: 0;
            font-size: 13px;
        }

        .ticket .ticket__first-section>ul>li>p:first-of-type {
            width: 75px;
        }

        .ticket .ticket__first-section>ul>li>p:nth-of-type(2) {
            margin-left: 2px;
            font-size: 12px;
            text-transform: uppercase;
            color: red;
            font-weight: 700;
            display: flex;
            align-items: flex-start;
            flex-wrap: wrap;
            font-family: "POPPINS SEMI BOLD";
        }

        .ticket .ticket__first-section>section:first-of-type h4 {
            font-size: 15px;
            font-weight: bolder;
            text-transform: uppercase;
            margin: 0 0 0 10px;
        }

        .ticket .ticket__second-section {
            height: 178px;
            background-repeat: no-repeat;
            background-size: cover;
            background-position: 50%;
            margin: 0 32px 3px;
        }

        .ticket .ticket__third-section {
            margin: 0 32px 3px;
        }

        .ticket .ticket__third-section>h4 {
            margin: 0;
            padding: 5px 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: red;
            font-size: 17px;
            text-transform: uppercase;
            font-weight: 900;
        }

        .ticket>section {
            background-color: #fff;
            font-family: "BAHNSCHRIFT";
        }

        .imgLogo {
            height: 70px;
            width: auto;
        }

        .ticket .ticket__first-section>section:first-of-type {
            /*padding: 3px 50px;*/
            display: flex;
            align-items: center;
            justify-content: center;
        }
    </style>

    <!-- Page CSS -->


    <!-- Helpers -->
    <script src="assets/vendor/js/helpers.js"></script>
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="assets/js/config.js"></script>
</head>

<body>

    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar  ">
        <div class="layout-container">
            <!-- Menu -->
            <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
                <div class="app-brand demo ">
                    <a href="/user_v2/" class="app-brand-link">
                        <span class="app-brand-logo demo">
                            <svg width="32" height="22" viewbox="0 0 32 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M0.00172773 0V6.85398C0.00172773 6.85398 -0.133178 9.01207 1.98092 10.8388L13.6912 21.9964L19.7809 21.9181L18.8042 9.88248L16.4951 7.17289L9.23799 0H0.00172773Z" fill="#7367F0"></path>
                                <path opacity="0.06" fill-rule="evenodd" clip-rule="evenodd" d="M7.69824 16.4364L12.5199 3.23696L16.5541 7.25596L7.69824 16.4364Z" fill="#161616"></path>
                                <path opacity="0.06" fill-rule="evenodd" clip-rule="evenodd" d="M8.07751 15.9175L13.9419 4.63989L16.5849 7.28475L8.07751 15.9175Z" fill="#161616"></path>
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M7.77295 16.3566L23.6563 0H32V6.88383C32 6.88383 31.8262 9.17836 30.6591 10.4057L19.7824 22H13.6938L7.77295 16.3566Z" fill="#7367F0"></path>
                            </svg>
                        </span>
                        <span class="app-brand-text demo menu-text fw-bold">Panel Admin</span>
                    </a>
                    <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto">
                        <i class="ti menu-toggle-icon d-none d-xl-block ti-sm align-middle"></i>
                        <i class="ti ti-x d-block d-xl-none ti-sm align-middle"></i>
                    </a>
                </div>
                <div class="menu-inner-shadow"></div>
                <ul class="menu-inner py-1">
                    <li class="menu-item active open">
                        <a href="javascript:void(0);" class="menu-link menu-toggle">
                            <i class="menu-icon tf-icons ti ti-smart-home"></i>
                            <div data-i18n="Dashboard">Dashboard</div>
                        </a>
                        <ul class="menu-sub">
                            <?php
                            if ($status === 1) {
                                $dbUse = '';
                                $active = 'active'; ?>

                                <li class="menu-item">
                                    <a href="/user_v2/status?id=1" class="menu-link">
                                        <div data-i18n="Status <?php echo $infoSorteoNombre; ?>">Status <?php echo $infoSorteoNombre; ?></div>
                                    </a>
                                </li>
                                <li class="menu-item active">
                                    <a href="/user_v2/ref?id=1" class="menu-link">
                                        <div data-i18n='
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-gem" viewBox="0 0 16 16">
                                        <path d="M3.1.7a.5.5 0 0 1 .4-.2h9a.5.5 0 0 1 .4.2l2.976 3.974c.149.185.156.45.01.644L8.4 15.3a.5.5 0 0 1-.8 0L.1 5.3a.5.5 0 0 1 0-.6l3-4zm11.386 3.785-1.806-2.41-.776 2.413 2.582-.003zm-3.633.004.961-2.989H4.186l.963 2.995zM5.47 5.495 8 13.366l2.532-7.876-5.062.005zm-1.371-.999-.78-2.422-1.818 2.425zM1.499 5.5l5.113 6.817-2.192-6.82L1.5 5.5zm7.889 6.817 5.123-6.83-2.928.002-2.195 6.828z"/>
                                        </svg>
                                        Referidos <?php echo $infoSorteoNombre; ?>
                                        '>
                                            <span>
                                                Referidos <?php echo $infoSorteoNombre; ?>
                                            </span>
                                        </div>
                                    </a>
                                </li>
                                <?php
                                if ($infoSorteoNombre2 != ' ') { ?>
                                    <li class="menu-item">
                                        <a href="/user_v2/status?id=2" class="menu-link">
                                            <div data-i18n="Status <?php echo $infoSorteoNombre2; ?>">Status <?php echo $infoSorteoNombre2; ?></div>
                                        </a>
                                    </li>
                                    <li class="menu-item">
                                        <a href="/user_v2/ref?id=2" class="menu-link">
                                            <div data-i18n='
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-gem" viewBox="0 0 16 16">
                                        <path d="M3.1.7a.5.5 0 0 1 .4-.2h9a.5.5 0 0 1 .4.2l2.976 3.974c.149.185.156.45.01.644L8.4 15.3a.5.5 0 0 1-.8 0L.1 5.3a.5.5 0 0 1 0-.6l3-4zm11.386 3.785-1.806-2.41-.776 2.413 2.582-.003zm-3.633.004.961-2.989H4.186l.963 2.995zM5.47 5.495 8 13.366l2.532-7.876-5.062.005zm-1.371-.999-.78-2.422-1.818 2.425zM1.499 5.5l5.113 6.817-2.192-6.82L1.5 5.5zm7.889 6.817 5.123-6.83-2.928.002-2.195 6.828z"/>
                                        </svg>
                                        Referidos <?php echo $infoSorteoNombre2; ?>
                                        '>
                                                <span>
                                                    Referidos <?php echo $infoSorteoNombre2; ?>
                                                </span>
                                            </div>
                                        </a>
                                    </li>
                                <?php }
                                if ($infoSorteoNombre3 != ' ') { ?>
                                    <li class="menu-item">
                                        <a href="/user_v2/status?id=3" class="menu-link">
                                            <div data-i18n="Status <?php echo $infoSorteoNombre3; ?>">Status <?php echo $infoSorteoNombre3; ?></div>
                                        </a>
                                    </li>
                                    <li class="menu-item">
                                        <a href="/user_v2/ref?id=3" class="menu-link">
                                            <div data-i18n='
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-gem" viewBox="0 0 16 16">
                                        <path d="M3.1.7a.5.5 0 0 1 .4-.2h9a.5.5 0 0 1 .4.2l2.976 3.974c.149.185.156.45.01.644L8.4 15.3a.5.5 0 0 1-.8 0L.1 5.3a.5.5 0 0 1 0-.6l3-4zm11.386 3.785-1.806-2.41-.776 2.413 2.582-.003zm-3.633.004.961-2.989H4.186l.963 2.995zM5.47 5.495 8 13.366l2.532-7.876-5.062.005zm-1.371-.999-.78-2.422-1.818 2.425zM1.499 5.5l5.113 6.817-2.192-6.82L1.5 5.5zm7.889 6.817 5.123-6.83-2.928.002-2.195 6.828z"/>
                                        </svg>
                                        Referidos <?php echo $infoSorteoNombre3; ?>
                                        '>
                                                <span>
                                                    Referidos <?php echo $infoSorteoNombre3; ?>
                                                </span>
                                            </div>
                                        </a>
                                    </li>
                                <?php } ?>
                            <?php } else if ($status === 2) {
                                $dbUse = '_two';
                                $active = 'active'; ?>

                                <li class="menu-item">
                                    <a href="/user_v2/status?id=1" class="menu-link">
                                        <div data-i18n="Status <?php echo $infoSorteoNombre; ?>">Status <?php echo $infoSorteoNombre; ?></div>
                                    </a>
                                </li>
                                <li class="menu-item">
                                    <a href="/user_v2/ref?id=1" class="menu-link">
                                        <div data-i18n='
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-gem" viewBox="0 0 16 16">
                                        <path d="M3.1.7a.5.5 0 0 1 .4-.2h9a.5.5 0 0 1 .4.2l2.976 3.974c.149.185.156.45.01.644L8.4 15.3a.5.5 0 0 1-.8 0L.1 5.3a.5.5 0 0 1 0-.6l3-4zm11.386 3.785-1.806-2.41-.776 2.413 2.582-.003zm-3.633.004.961-2.989H4.186l.963 2.995zM5.47 5.495 8 13.366l2.532-7.876-5.062.005zm-1.371-.999-.78-2.422-1.818 2.425zM1.499 5.5l5.113 6.817-2.192-6.82L1.5 5.5zm7.889 6.817 5.123-6.83-2.928.002-2.195 6.828z"/>
                                        </svg>
                                        Referidos <?php echo $infoSorteoNombre; ?>
                                        '>
                                            <span>
                                                Referidos <?php echo $infoSorteoNombre; ?>
                                            </span>
                                        </div>
                                    </a>
                                </li>
                                <?php
                                if ($infoSorteoNombre2 != ' ') { ?>
                                    <li class="menu-item">
                                        <a href="/user_v2/status?id=2" class="menu-link">
                                            <div data-i18n="Status <?php echo $infoSorteoNombre2; ?>">Status <?php echo $infoSorteoNombre2; ?></div>
                                        </a>
                                    </li>
                                    <li class="menu-item active">
                                        <a href="/user_v2/ref?id=2" class="menu-link">
                                            <div data-i18n='
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-gem" viewBox="0 0 16 16">
                                        <path d="M3.1.7a.5.5 0 0 1 .4-.2h9a.5.5 0 0 1 .4.2l2.976 3.974c.149.185.156.45.01.644L8.4 15.3a.5.5 0 0 1-.8 0L.1 5.3a.5.5 0 0 1 0-.6l3-4zm11.386 3.785-1.806-2.41-.776 2.413 2.582-.003zm-3.633.004.961-2.989H4.186l.963 2.995zM5.47 5.495 8 13.366l2.532-7.876-5.062.005zm-1.371-.999-.78-2.422-1.818 2.425zM1.499 5.5l5.113 6.817-2.192-6.82L1.5 5.5zm7.889 6.817 5.123-6.83-2.928.002-2.195 6.828z"/>
                                        </svg>
                                        Referidos <?php echo $infoSorteoNombre2; ?>
                                        '>
                                                <span>
                                                    Referidos <?php echo $infoSorteoNombre2; ?>
                                                </span>
                                            </div>
                                        </a>
                                    </li>
                                <?php }
                                if ($infoSorteoNombre3 != ' ') { ?>
                                    <li class="menu-item">
                                        <a href="/user_v2/status?id=3" class="menu-link">
                                            <div data-i18n="Status <?php echo $infoSorteoNombre3; ?>">Status <?php echo $infoSorteoNombre3; ?></div>
                                        </a>
                                    </li>
                                    <li class="menu-item">
                                        <a href="/user_v2/ref?id=3" class="menu-link">
                                            <div data-i18n='
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-gem" viewBox="0 0 16 16">
                                        <path d="M3.1.7a.5.5 0 0 1 .4-.2h9a.5.5 0 0 1 .4.2l2.976 3.974c.149.185.156.45.01.644L8.4 15.3a.5.5 0 0 1-.8 0L.1 5.3a.5.5 0 0 1 0-.6l3-4zm11.386 3.785-1.806-2.41-.776 2.413 2.582-.003zm-3.633.004.961-2.989H4.186l.963 2.995zM5.47 5.495 8 13.366l2.532-7.876-5.062.005zm-1.371-.999-.78-2.422-1.818 2.425zM1.499 5.5l5.113 6.817-2.192-6.82L1.5 5.5zm7.889 6.817 5.123-6.83-2.928.002-2.195 6.828z"/>
                                        </svg>
                                        Referidos <?php echo $infoSorteoNombre3; ?>
                                        '>
                                                <span>
                                                    Referidos <?php echo $infoSorteoNombre3; ?>
                                                </span>
                                            </div>
                                        </a>
                                    </li>
                                <?php } ?>
                                <li class="menu-item">
                                    <a href="/user_v2/settings" class="menu-link">
                                        <div data-i18n="Ajustes">Ajustes</div>
                                    </a>
                                </li>
                            <?php  } else if ($status === 3) {
                                $dbUse = '_tree';
                                $active = 'active'; ?>

                                <li class="menu-item">
                                    <a href="/user_v2/status?id=1" class="menu-link">
                                        <div data-i18n="Status <?php echo $infoSorteoNombre; ?>">Status <?php echo $infoSorteoNombre; ?></div>
                                    </a>
                                </li>
                                <li class="menu-item">
                                    <a href="/user_v2/ref?id=1" class="menu-link">
                                        <div data-i18n='
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-gem" viewBox="0 0 16 16">
                                        <path d="M3.1.7a.5.5 0 0 1 .4-.2h9a.5.5 0 0 1 .4.2l2.976 3.974c.149.185.156.45.01.644L8.4 15.3a.5.5 0 0 1-.8 0L.1 5.3a.5.5 0 0 1 0-.6l3-4zm11.386 3.785-1.806-2.41-.776 2.413 2.582-.003zm-3.633.004.961-2.989H4.186l.963 2.995zM5.47 5.495 8 13.366l2.532-7.876-5.062.005zm-1.371-.999-.78-2.422-1.818 2.425zM1.499 5.5l5.113 6.817-2.192-6.82L1.5 5.5zm7.889 6.817 5.123-6.83-2.928.002-2.195 6.828z"/>
                                        </svg>
                                        Referidos <?php echo $infoSorteoNombre; ?>
                                        '>
                                            <span>
                                                Referidos <?php echo $infoSorteoNombre; ?>
                                            </span>
                                        </div>
                                    </a>
                                </li>
                                <?php
                                if ($infoSorteoNombre2 != ' ') { ?>
                                    <li class="menu-item">
                                        <a href="/user_v2/status?id=2" class="menu-link">
                                            <div data-i18n="Status <?php echo $infoSorteoNombre2; ?>">Status <?php echo $infoSorteoNombre2; ?></div>
                                        </a>
                                    </li>
                                    <li class="menu-item">
                                        <a href="/user_v2/ref?id=2" class="menu-link">
                                            <div data-i18n='
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-gem" viewBox="0 0 16 16">
                                        <path d="M3.1.7a.5.5 0 0 1 .4-.2h9a.5.5 0 0 1 .4.2l2.976 3.974c.149.185.156.45.01.644L8.4 15.3a.5.5 0 0 1-.8 0L.1 5.3a.5.5 0 0 1 0-.6l3-4zm11.386 3.785-1.806-2.41-.776 2.413 2.582-.003zm-3.633.004.961-2.989H4.186l.963 2.995zM5.47 5.495 8 13.366l2.532-7.876-5.062.005zm-1.371-.999-.78-2.422-1.818 2.425zM1.499 5.5l5.113 6.817-2.192-6.82L1.5 5.5zm7.889 6.817 5.123-6.83-2.928.002-2.195 6.828z"/>
                                        </svg>
                                        Referidos <?php echo $infoSorteoNombre2; ?>
                                        '>
                                                <span>
                                                    Referidos <?php echo $infoSorteoNombre2; ?>
                                                </span>
                                            </div>
                                        </a>
                                    </li>
                                <?php }
                                if ($infoSorteoNombre3 != ' ') { ?>
                                    <li class="menu-item">
                                        <a href="/user_v2/status?id=3" class="menu-link">
                                            <div data-i18n="Status <?php echo $infoSorteoNombre3; ?>">Status <?php echo $infoSorteoNombre3; ?></div>
                                        </a>
                                    </li>
                                    <li class="menu-item active">
                                        <a href="/user_v2/ref?id=3" class="menu-link">
                                            <div data-i18n='
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-gem" viewBox="0 0 16 16">
                                        <path d="M3.1.7a.5.5 0 0 1 .4-.2h9a.5.5 0 0 1 .4.2l2.976 3.974c.149.185.156.45.01.644L8.4 15.3a.5.5 0 0 1-.8 0L.1 5.3a.5.5 0 0 1 0-.6l3-4zm11.386 3.785-1.806-2.41-.776 2.413 2.582-.003zm-3.633.004.961-2.989H4.186l.963 2.995zM5.47 5.495 8 13.366l2.532-7.876-5.062.005zm-1.371-.999-.78-2.422-1.818 2.425zM1.499 5.5l5.113 6.817-2.192-6.82L1.5 5.5zm7.889 6.817 5.123-6.83-2.928.002-2.195 6.828z"/>
                                        </svg>
                                        Referidos <?php echo $infoSorteoNombre3; ?>
                                        '>
                                                <span>
                                                    Referidos <?php echo $infoSorteoNombre3; ?>
                                                </span>
                                            </div>
                                        </a>
                                    </li>
                                <?php } ?>
                            <?php } else {
                                echo '  <script type="text/javascript">
                                                window.location.href = "status?id=1"; // Reemplaza con la URL a la que deseas redirigir
                                            </script>';
                            }
                            ?>
                            <li class="menu-item">
                                <a href="/user_v2/settings" class="menu-link">
                                    <div data-i18n="Ajustes">Ajustes</div>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="menu-header small text-uppercase">
                        <span class="menu-header-text">Documentacion (BETA)</span>
                    </li>
                    <li class="menu-item">
                        <a href="" target="_blank" class="menu-link">
                            <i class="menu-icon tf-icons ti ti-lifebuoy"></i>
                            <div data-i18n="Soporte (BETA)">Soporte (BETA)</div>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="" target="_blank" class="menu-link">
                            <i class="menu-icon tf-icons ti ti-file-description"></i>
                            <div data-i18n="Documentacion (BETA)">Documentacion (BETA)</div>
                        </a>
                    </li>
                </ul>
            </aside>
            <!-- Layout container -->
            <div class="layout-page">
                <!-- Navbar -->
                <nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme" id="layout-navbar">
                    <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0   d-xl-none ">
                        <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
                            <i class="ti ti-menu-2 ti-sm"></i>
                        </a>
                    </div>
                    <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
                        <!-- Search -->
                        <div class="navbar-nav align-items-center">
                            <div class="nav-item navbar-search-wrapper mb-0">
                                <h3 class="nav-item nav-link search-toggler d-flex align-items-center px-0 m-0">Hola 👋 Estamos trabajando aqui</h3>
                            </div>
                        </div>

                        <!-- /Search -->
                        <ul class="navbar-nav flex-row align-items-center ms-auto">
                            <!-- Quick links  -->
                            <li class="nav-item dropdown-shortcuts navbar-dropdown dropdown me-2 me-xl-0">
                                <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false">
                                    <i class='ti ti-layout-grid-add ti-md'></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-end py-0">
                                    <div class="dropdown-menu-header border-bottom">
                                        <div class="dropdown-header d-flex align-items-center py-3">
                                            <h5 class="text-body mb-0 me-auto">Accesos directos</h5>
                                        </div>
                                    </div>
                                    <div class="dropdown-shortcuts-list scrollable-container">
                                        <div class="row row-bordered overflow-visible g-0">
                                            <div class="dropdown-shortcuts-item col">
                                                <span class="dropdown-shortcuts-icon rounded-circle mb-2">
                                                    <i class="ti ti-ticket"></i>
                                                </span>
                                                <a href="/user_v2/status?id=1" class="stretched-link">Status Rifa / Sorteo</a>
                                                <small class="text-muted mb-0"><?php echo $infoSorteoNombre; ?></small>
                                            </div>
                                            <?php
                                            if ($infoSorteoNombre2 != ' ') { ?>
                                                <div class="dropdown-shortcuts-item col">
                                                    <span class="dropdown-shortcuts-icon rounded-circle mb-2">
                                                        <i class="ti ti-ticket"></i>
                                                    </span>
                                                    <a href="/user_v2/status?id=2" class="stretched-link">Status Rifa / Sorteo</a>
                                                    <small class="text-muted mb-0"><?php echo $infoSorteoNombre2; ?></small>
                                                </div>

                                            <?php } ?>
                                        </div>
                                        <?php
                                        if ($infoSorteoNombre3 != ' ') { ?>
                                            <div class="row row-bordered overflow-visible g-0">
                                                <div class="dropdown-shortcuts-item col">
                                                    <span class="dropdown-shortcuts-icon rounded-circle mb-2">
                                                        <i class="ti ti-ticket"></i>
                                                    </span>
                                                    <a href="/user_v2/status?id=3" class="stretched-link">Status Rifa / Sorteo</a>
                                                    <small class="text-muted mb-0"><?php echo $infoSorteoNombre3; ?></small>
                                                </div>
                                            </div>
                                        <?php } ?>
                                    </div>
                                </div>
                            </li>
                            <!-- Quick links -->


                            <!-- User -->
                            <li class="nav-item navbar-dropdown dropdown-user dropdown">
                                <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                                    <div class="avatar avatar-online">
                                        <img src="assets/img/avatars/1.png" alt="" class="h-auto rounded-circle">
                                    </div>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li>
                                        <a class="dropdown-item">
                                            <div class="d-flex">
                                                <div class="flex-shrink-0 me-3">
                                                    <div class="avatar avatar-online">
                                                        <img src="assets/img/avatars/1.png" alt="" class="h-auto rounded-circle">
                                                    </div>
                                                </div>
                                                <div class="flex-grow-1">
                                                    <span class="fw-medium d-block"><?php echo $usuarioingresado; ?></span>
                                                    <small class="text-muted">Eres: <?php
                                                                                    if ($rol === '1') {
                                                                                        echo 'Super Admin';
                                                                                    } else if ($rol === '4') {
                                                                                        echo 'Only Manager';
                                                                                    }
                                                                                    ?></small>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <div class="dropdown-divider"></div>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="/user_v2/settings">
                                            <i class="ti ti-settings me-2 ti-sm"></i>
                                            <span class="align-middle">Ajustes</span>
                                        </a>
                                    </li>
                                    <li>
                                        <div class="dropdown-divider"></div>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="/user_v2/logout" target="_blank">
                                            <i class="ti ti-logout me-2 ti-sm"></i>
                                            <span class="align-middle">Cerrar sesión</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <!--/ User -->



                        </ul>
                    </div>


                    <!-- Search Small Screens -->
                    <div class="navbar-search-wrapper search-input-wrapper  d-none">
                        <input type="text" class="form-control search-input container-xxl border-0" placeholder="Search..." aria-label="Search...">
                        <i class="ti ti-x ti-sm search-toggler cursor-pointer"></i>
                    </div>



                </nav>

                <!-- / Navbar -->



                <!-- Content wrapper -->
                <div class="content-wrapper">

                    <!-- Content -->

                    <div class="container-xxl flex-grow-1 container-p-y d-none">

                        <div class="row">

                            <!-- Sales last year -->

                            <!-- Browser States -->
                            <div class="col-xl-4 col-md-6 mb-4">
                                <div class="card h-100">
                                    <div class="card-header d-flex justify-content-between">
                                        <div class="card-title m-0 me-2">
                                            <h5 class="m-0 me-2">Personas que han comprado por estado</h5>
                                            <small class="text-muted">Informes sobre
                                                <?php
                                                if ($status === 1) {
                                                    echo $infoSorteoNombre;
                                                } else if ($status === 2) {
                                                    echo $infoSorteoNombre2;
                                                } else if ($status === 3) {
                                                    echo $infoSorteoNombre3;
                                                } else {
                                                    echo $infoSorteoNombre;
                                                } ?>
                                            </small>
                                        </div>
                                    </div>
                                    <div class="card-body" style="height: 200px;overflow: auto;">
                                        <ul class="p-0 m-0">
                                            <?php
                                            // Muestra el conteo de estados en Boletos
                                            $query = "SELECT * from estados ORDER BY nombre ASC";
                                            $result_tasks = mysqli_query($db, $query);
                                            while ($row = mysqli_fetch_assoc($result_tasks)) {

                                                // Var Nombre
                                                $nombrexxx = $row['nombre'];

                                                $resultStatePrimero = mysqli_query($db, "SELECT COUNT(*) AS `count` FROM `sorteomini$dbUse`");
                                                $rowx2 = mysqli_fetch_array($resultStatePrimero);
                                                $countStatePrimero = $rowx2['count'];

                                                $resultState = mysqli_query($db, "SELECT COUNT(*) AS `count` FROM `sorteomini$dbUse` WHERE estado='$nombrexxx'");
                                                $rowx = mysqli_fetch_array($resultState);
                                                $countState = $rowx['count'];

                                                if ($countStatePrimero > 0) {
                                                    $porcentaje = ($countState / $countStatePrimero) * 100;
                                                } else {
                                                    $porcentaje = 0; // Manejo de caso especial para evitar división por cero
                                                }


                                                if ($countState == 0) {
                                                } else {
                                                    $porcenStados = round($porcentaje, 2);
                                                    $porcentajeCliente = number_format($porcenStados, 2) . '%';

                                            ?>
                                                    <li class="mb-3 pb-1 d-flex">
                                                        <div class="d-flex w-50 align-items-center me-3">
                                                            <div>
                                                                <h6 class="mb-0"><?php echo $nombrexxx; ?> (<span><?php echo $countState; ?></span>)</h6>

                                                            </div>
                                                        </div>
                                                        <div class="d-flex flex-grow-1 align-items-center">
                                                            <div class="progress w-100 me-3" style="height:8px;">
                                                                <div class="progress-bar bg-danger" role="progressbar" style="width: <?php echo $porcentajeCliente; ?>" aria-valuenow="54" aria-valuemin="0" aria-valuemax="100">
                                                                </div>
                                                            </div>
                                                            <span class="text-muted"><?php echo $porcentajeCliente; ?></span>
                                                        </div>
                                                    </li>
                                            <?php }
                                            } ?>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <!-- Project Status -->
                            <div class="col-12 col-xl-4 mb-4 col-md-6">
                                <div class="card">
                                    <div class="card-header d-flex justify-content-between">
                                        <h5 class="mb-0 card-title">Informe de Finanzas</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="d-flex align-items-start">
                                            <div class="badge rounded bg-label-warning p-2 me-3 rounded"><i class="ti ti-currency-dollar ti-sm"></i></div>
                                            <div class="d-flex justify-content-between w-100 gap-2 align-items-center">
                                                <div class="me-2">
                                                    <small class="text-muted">Tus ganancias</small>
                                                    <h6 class="mb-0">$<?php echo $caja; ?></h6>
                                                </div>
                                            </div>
                                        </div>
                                        <div id="projectStatusChart"></div>
                                        <div class="d-flex justify-content-between mb-3 mt-2">
                                            <h6 class="mb-0">Ganancias
                                                <br>
                                                <span style="font-size: 12px;">Quinielas Pagadas
                                                    (<?php echo $countPay . " | $" . $caja;; ?>)</span>
                                            </h6>
                                            <div class="d-flex">
                                                <p class="mb-0 me-3 text-success">$<?php echo $caja; ?></p>
                                            </div>
                                        </div>
                                        <div class="d-flex justify-content-between mb-3 pb-1">
                                            <h6 class="mb-0">Faltante
                                                <br>
                                                <span style="font-size: 12px;">Quinielas No Pagadas
                                                    (<?php echo $countApar . " | $" . $pagos; ?>)</span>
                                            </h6>
                                            <div class="d-flex">
                                                <p class="mb-0 me-3 text-danger">$<?php echo $pagos; ?></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Active Projects -->
                            <div class="col-xl-4 col-md-6 mb-4">
                                <div class="card h-100">
                                    <div class="card-header d-flex justify-content-between">
                                        <div class="card-title mb-0">
                                            <h5 class="mb-0">Formas de pago</h5>
                                            <small class="text-muted">Mira la forma de pago favorita de tus
                                                clientes</small>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <ul class="p-0 m-0">
                                            <?php
                                            $resultadoTypePay = mysqli_query($db, $queryTypePay);
                                            if ($resultadoTypePay) {
                                                // Recorre los resultados y muestra el conteo para cada valor único en "tipoPay"
                                                while ($fila = mysqli_fetch_assoc($resultadoTypePay)) {
                                                    $tipoPay = $fila['typePay'];
                                                    $total = $fila['total'];

                                                    $resultStatePrimero = mysqli_query($db, "SELECT COUNT(*) AS `count` FROM `sorteomini$dbUse`");
                                                    $rowx2 = mysqli_fetch_array($resultStatePrimero);
                                                    $countStatePrimero = $rowx2['count'];

                                                    $resultState = mysqli_query($db, "SELECT COUNT(*) AS `count` FROM `sorteomini$dbUse` WHERE typePay='$tipoPay'");
                                                    $rowx = mysqli_fetch_array($resultState);
                                                    $countState = $rowx['count'];


                                                    $resultTotal = mysqli_query($db, "SELECT SUM(`total`) AS `totalCount` FROM `sorteomini$dbUse` WHERE typePay='$tipoPay'");
                                                    $rowx = mysqli_fetch_array($resultTotal);
                                                    $totalCount = $rowx['totalCount'];


                                                    if ($countStatePrimero > 0) {
                                                        $porcentaje = ($countState / $countStatePrimero) * 100;
                                                    } else {
                                                        $porcentaje = 0; // Manejo de caso especial para evitar división por cero
                                                    }


                                                    if ($countState == 0) {
                                                    } else {
                                                        $porcenStados = round($porcentaje, 2);
                                                        $porcentajeCliente = number_format($porcenStados, 2) . '%';
                                                    }
                                            ?>
                                                    <li class="mb-3 pb-1 d-flex">
                                                        <div class="d-flex w-50 align-items-center me-3">
                                                            <div>
                                                                <h6 class="mb-0"><?php echo $tipoPay ?> (<span>$<?php echo $totalCount; ?></span>)</h6>

                                                            </div>
                                                        </div>
                                                        <div class="d-flex flex-grow-1 align-items-center">
                                                            <div class="progress w-100 me-3" style="height:8px;">
                                                                <div class="progress-bar bg-success" role="progressbar" style="width: <?php echo $porcentajeCliente; ?>" aria-valuenow="<?php echo $porcentajeCliente; ?>" aria-valuemin="0" aria-valuemax="100">
                                                                </div>
                                                            </div>
                                                            <span class="text-muted"><?php echo $porcentajeCliente; ?></span>
                                                        </div>
                                                    </li>
                                            <?php
                                                }
                                            } else {
                                                echo "Error en la consulta: " . mysqli_error($conexion);
                                            }
                                            ?>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <!-- / Content -->
                    <div class="content-wrapper">

                        <!-- Content -->

                        <div class="container-xxl flex-grow-1 container-p-y">

                            <!-- Responsive Datatable -->
                            <div class="card">
                                <h5 class="card-header">Informes sobre
                                    <?php
                                    if ($status === 1) {
                                        echo $infoSorteoNombre;
                                    } else if ($status === 2) {
                                        echo $infoSorteoNombre2;
                                    } else if ($status === 3) {
                                        echo $infoSorteoNombre3;
                                    } else {
                                        echo $infoSorteoNombre;
                                    } ?>
                                </h5>
                                <div class="card-datatable table-responsive">
                                    <div id="DataTables_Table_3_wrapper" class="dataTables_wrapper dt-bootstrap5">
                                        <table class="dt-responsive table dataTable dtr-column collapsed" id="DataTables_Table_3" aria-describedby="DataTables_Table_3_info" style="width: 1208px;">
                                            <thead>
                                                <tr>
                                                    <th class="sorting" tabindex="0" aria-controls="DataTables_Table_3" rowspan="1" colspan="1" style="width: 77px;" aria-label="Name: activate to sort column ascending">Referido</th>
                                                    <th class="sorting" tabindex="0" aria-controls="DataTables_Table_3" rowspan="1" colspan="1" style="width: 30px;" aria-label="Email: activate to sort column ascending">Compras por Referido</th>
                                                    <th class="sorting" tabindex="0" aria-controls="DataTables_Table_3" rowspan="1" colspan="1" style="width: 118px;" aria-label="Post: activate to sort column ascending">Compras Pendientes por Referido</th>
                                                    <th class="sorting" tabindex="0" aria-controls="DataTables_Table_3" rowspan="1" colspan="1" style="width: 98px;" aria-label="City: activate to sort column ascending">Porcentaje de actividad</th>
                                                    <th class="sorting" tabindex="0" aria-controls="DataTables_Table_3" rowspan="1" colspan="1" style="width: 98px;" aria-label="City: activate to sort column ascending">Visitantes por Referido</th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $ocurrenciasPorStatus = array();
                                                $query = "SELECT refe, statusBoleto, COUNT(*) as cantidad FROM info_boletos$dbUse WHERE refe IS NOT NULL AND refe <> '' GROUP BY refe, statusBoleto";
                                                $result = mysqli_query($db, $query);
                                                $ocurrenciasPorStatus = array();
                                                $sumaPagado = 0;
                                                $sumaApartado = 0;

                                                // Leer el contenido del archivo JSON
                                                $jsonContent = file_get_contents('../app/ref' . $dbUse . '.json');
                                                $jsonData = json_decode($jsonContent, true);

                                                while ($row = mysqli_fetch_assoc($result)) {
                                                    $nombre = $row['refe'];
                                                    $statusBoleto = $row['statusBoleto'];
                                                    $cantidad = $row['cantidad'];

                                                    if (!isset($ocurrenciasPorStatus[$nombre])) {
                                                        $ocurrenciasPorStatus[$nombre] = array();
                                                    }
                                                    $ocurrenciasPorStatus[$nombre][$statusBoleto] = $cantidad;
                                                }


                                                foreach ($ocurrenciasPorStatus as $nombre => $ocurrencias) {  ?>
                                                    <tr>
                                                        <td class=""><?php echo $nombre; ?> <a class="referidoLink" href="<?php echo $urlPartner .  $urlSorteo . '?r=' .  $nombre ?>"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-link-45deg" viewBox="0 0 16 16">
                                                                    <path d="M4.715 6.542 3.343 7.914a3 3 0 1 0 4.243 4.243l1.828-1.829A3 3 0 0 0 8.586 5.5L8 6.086a1.002 1.002 0 0 0-.154.199 2 2 0 0 1 .861 3.337L6.88 11.45a2 2 0 1 1-2.83-2.83l.793-.792a4.018 4.018 0 0 1-.128-1.287z" />
                                                                    <path d="M6.586 4.672A3 3 0 0 0 7.414 9.5l.775-.776a2 2 0 0 1-.896-3.346L9.12 3.55a2 2 0 1 1 2.83 2.83l-.793.792c.112.42.155.855.128 1.287l1.372-1.372a3 3 0 1 0-4.243-4.243z" />
                                                                </svg> Link</a></td>
                                                        <td class="text-success"><?php echo $ocurrencias['Pagado'] ?? 0; ?></td>
                                                        <td class="text-warning"><?php echo $ocurrencias['Apartado'] ?? 0; ?></td>
                                                        <td class="">
                                                            <div class="progress" role="progressbar" aria-label="Success example" aria-valuenow="" aria-valuemin="0" aria-valuemax="100">
                                                                <?php
                                                                $pagado = isset($ocurrencias['Pagado']) ? $ocurrencias['Pagado'] : 0;
                                                                $apartado = isset($ocurrencias['Apartado']) ? $ocurrencias['Apartado'] : 0;
                                                                $sumaTotal = $pagado + $apartado;

                                                                if ($sumaTotal != 0) {
                                                                    $porcentajeAvance = round(($pagado / $sumaTotal) * 100, 2); ?>
                                                                    <div class="progress-bar bg-success" style="width: <?php echo "$porcentajeAvance%"; ?>">
                                                                        <?php echo "$porcentajeAvance%"; ?>
                                                                    </div>
                                                                <?php } ?>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <?php
                                                            // Verificar si el nombre existe en el archivo JSON y mostrar el número asociado
                                                            if (isset($jsonData['referidos']['users'][$nombre])) {
                                                                if ($jsonData['referidos']['users'][$nombre] >= 1) {
                                                                    echo "<div style='display: flex;align-items: center;'><svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-eye-fill' viewBox='0 0 16 16'>
                                                                    <path d='M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0'/>
                                                                    <path d='M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8m8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7'/>
                                                                  </svg><span class='px-1'>" . $jsonData['referidos']['users'][$nombre] . "</span></div>";
                                                                } else {
                                                                    echo '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye-slash-fill" viewBox="0 0 16 16">
                                                                    <path d="m10.79 12.912-1.614-1.615a3.5 3.5 0 0 1-4.474-4.474l-2.06-2.06C.938 6.278 0 8 0 8s3 5.5 8 5.5a7.029 7.029 0 0 0 2.79-.588M5.21 3.088A7.028 7.028 0 0 1 8 2.5c5 0 8 5.5 8 5.5s-.939 1.721-2.641 3.238l-2.062-2.062a3.5 3.5 0 0 0-4.474-4.474L5.21 3.089z"/>
                                                                    <path d="M5.525 7.646a2.5 2.5 0 0 0 2.829 2.829l-2.83-2.829zm4.95.708-2.829-2.83a2.5 2.5 0 0 1 2.829 2.829zm3.171 6-12-12 .708-.708 12 12z"/>
                                                                  </svg><span class="px-1">' . $jsonData['referidos']['users'][$nombre] . '</span>';
                                                                }
                                                            } else {
                                                                echo '<span class="text-danger">Error Data</span>';
                                                            }
                                                            ?>
                                                        </td>
                                                    </tr>
                                                    <?php }

                                                // Verificar si hay información de referidos en el JSON
                                                if (isset($jsonData['referidos']['users']) && !empty($jsonData['referidos']['users'])) {
                                                    foreach ($jsonData['referidos']['users'] as $nombre => $cantidad) {
                                                        // Verificar si el nombre está en el array $ocurrenciasPorStatus
                                                        if (!array_key_exists($nombre, $ocurrenciasPorStatus)) { ?>
                                                            <tr>
                                                                <td class=""><?php echo $nombre; ?> <a class="referidoLink" href="<?php echo $urlPartner .  $urlSorteo . '?r=' .  $nombre ?>"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-link-45deg" viewBox="0 0 16 16">
                                                                            <path d="M4.715 6.542 3.343 7.914a3 3 0 1 0 4.243 4.243l1.828-1.829A3 3 0 0 0 8.586 5.5L8 6.086a1.002 1.002 0 0 0-.154.199 2 2 0 0 1 .861 3.337L6.88 11.45a2 2 0 1 1-2.83-2.83l.793-.792a4.018 4.018 0 0 1-.128-1.287z" />
                                                                            <path d="M6.586 4.672A3 3 0 0 0 7.414 9.5l.775-.776a2 2 0 0 1-.896-3.346L9.12 3.55a2 2 0 1 1 2.83 2.83l-.793.792c.112.42.155.855.128 1.287l1.372-1.372a3 3 0 1 0-4.243-4.243z" />
                                                                        </svg> Link</a></td>
                                                                <td class="text-success">0</td>
                                                                <td class="text-warning">0</td>
                                                                <td class="">
                                                                    <div class="progress" role="progressbar" aria-label="Success example" aria-valuenow="" aria-valuemin="0" aria-valuemax="100">
                                                                        <?php
                                                                        // Aquí deberías ajustar la lógica según tus necesidades, ya que $ocurrencias no está definido en este contexto
                                                                        $pagado = 0;
                                                                        $apartado = 0;
                                                                        $sumaTotal = $pagado + $apartado;
                                                
                                                                        if ($sumaTotal != 0) {
                                                                            $porcentajeAvance = round(($pagado / $sumaTotal) * 100, 2); ?>
                                                                            <div class="progress-bar bg-success" style="width: <?php echo "$porcentajeAvance%"; ?>">
                                                                                <?php echo "$porcentajeAvance%"; ?>
                                                                            </div>
                                                                        <?php } ?>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <?php
                                                                    // Verificar si el nombre existe en el archivo JSON y mostrar el número asociado
                                                                    if (isset($jsonData['referidos']['users'][$nombre])) {
                                                                        if ($jsonData['referidos']['users'][$nombre] >= 1) {
                                                                            echo "<div style='display: flex;align-items: center;'><svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-eye-fill' viewBox='0 0 16 16'>
                                                                                    <path d='M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0' />
                                                                                    <path d='M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8m8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7' />
                                                                                </svg><span class='px-1'>" . $jsonData['referidos']['users'][$nombre] . "</span></div>";
                                                                        } else {
                                                                            echo '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye-slash-fill" viewBox="0 0 16 16">
                                                                                    <path d="m10.79 12.912-1.614-1.615a3.5 3.5 0 0 1-4.474-4.474l-2.06-2.06C.938 6.278 0 8 0 8s3 5.5 8 5.5a7.029 7.029 0 0 0 2.79-.588M5.21 3.088A7.028 7.028 0 0 1 8 2.5c5 0 8 5.5 8 5.5s-.939 1.721-2.641 3.238l-2.062-2.062a3.5 3.5 0 0 0-4.474-4.474L5.21 3.089z" />
                                                                                    <path d="M5.525 7.646a2.5 2.5 0 0 0 2.829 2.829l-2.83-2.829zm4.95.708-2.829-2.83a2.5 2.5 0 0 1 2.829 2.829zm3.171 6-12-12 .708-.708 12 12z" />
                                                                                </svg><span class="px-1">' . $jsonData['referidos']['users'][$nombre] . '</span>';
                                                                        }
                                                                    } else {
                                                                        echo '<span class="text-danger">Error Data</span>';
                                                                    }
                                                                    ?>
                                                                </td>
                                                            </tr>
                                                        <?php }
                                                    }
                                                }
                                                ?>
                                                
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php include 'include/footer.php'; ?>
                        <!-- / Footer -->


                        <div class="content-backdrop fade"></div>
                    </div>
                    <!-- Content wrapper -->
                </div>
                <!-- / Layout page -->
            </div>



            <!-- Overlay -->
            <div class="layout-overlay layout-menu-toggle"></div>


            <!-- Drag Target Area To SlideIn Menu On Small Screens -->
            <div class="drag-target"></div>

        </div>
        <!-- / Layout wrapper -->




        <!-- Core JS -->
        <!-- build:js assets/vendor/js/core.js -->

        <script src="assets/vendor/libs/jquery/jquery.js"></script>
        <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.js"></script>

        <script src="assets/vendor/libs/popper/popper.js"></script>
        <script src="assets/vendor/js/bootstrap.js"></script>
        <script src="assets/vendor/libs/node-waves/node-waves.js"></script>
        <script src="assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
        <script src="assets/vendor/libs/hammer/hammer.js"></script>
        <script src="assets/vendor/libs/i18n/i18n.js"></script>
        <script src="assets/vendor/libs/typeahead-js/typeahead.js"></script>
        <script src="assets/vendor/js/menu.js"></script>

        <!-- endbuild -->

        <!-- Vendors JS -->
        <script src="assets/vendor/libs/apex-charts/apexcharts.js"></script>

        <!-- Main JS -->
        <script src="assets/js/main.js"></script>


        <!-- Page JS -->
        <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/html2canvas@1.0.0-rc.1/dist/html2canvas.min.js"></script>
        <script src="assets/js/dashboards-crm.js"></script>
        <script>
            $(document).ready(function() {
                // Boleto digital
                $(".bsX").on('click', function() {
                    var datanu = $(this).attr('viewBlt');
                    console.log(datanu);
                    $.get("boletoServidor.php", {
                        nombre: datanu,
                        compiler: <?php echo $status ?>


                    }, function(dato) {
                        $('.imgBoleto').html(dato);

                    });

                });


                $(".btnEditForm").on('click', function() {
                    // alert('El valor es: ');
                    var datanu = $(this).attr('viewBlt');
                    var nombreX = $('#nombre').val();
                    var numeroX = $('#telefono').val();
                    var estadoX = $('#estado').val();
                    var statusX = $('#status').val();
                    var formasPago = $('#formasPago').val();
                    var compiler = <?php echo $status ?>;

                    if (statusX === 'Pagado') {
                        if (formasPago === '-') {
                            closeSnoAlertBox();

                        } else {
                            var compraX = $('#compra').val();
                            var payX = $('#pay').val();
                            $.get("edit__form__action.php", {
                                folio: datanu,
                                nombre: nombreX,
                                numero: numeroX,
                                estado: estadoX,
                                status: statusX,
                                compra: compraX,
                                pay: payX,
                                formasPago: formasPago,
                                compiler: compiler


                            }, function(dato) {
                                $('.mk').html(dato);
                                console.log(dato);
                            });

                        }

                    } else {
                        var compraX = $('#compra').val();
                        var payX = $('#pay').val();
                        $.get("edit__form__action.php", {
                            folio: datanu,
                            nombre: nombreX,
                            numero: numeroX,
                            estado: estadoX,
                            status: statusX,
                            compra: compraX,
                            pay: payX,
                            formasPago: formasPago,
                            compiler: compiler


                        }, function(dato) {
                            $('.mk').html(dato);
                            console.log(dato);
                        });

                    }

                    function closeSnoAlertBox() {
                        $("#snoAlertBox").css('display', 'block');
                        setTimeout(function() {
                            $("#snoAlertBox").fadeOut(1000, function() {

                            });
                        }, 1000);
                    }



                });

                // Descargar boleto
                const $boton = document.querySelector("#btnCapturar");
                const $objetivo = document.querySelector(".imgBoleto");
                $boton.addEventListener("click", () => {
                    html2canvas($objetivo, {
                        logging: true,
                        letterRendering: 1,
                        allowTaint: false,
                        useCORS: true
                    }).then(canvas => {
                        let enlace = document.createElement('a');
                        enlace.download = "Boleto-Digital.png";
                        enlace.href = canvas.toDataURL();
                        enlace.click();
                    });
                });

                // Editar
                $(".bsXEdit").on('click', function() {
                    var datanu = $(this).attr('viewBlt');
                    console.log('Edit ' + datanu);
                    $.get("edit__form.php", {
                        nombre: datanu,
                        compiler: <?php echo $status ?>

                    }, function(dato) {
                        $('.info').html(dato);

                    });
                });

                // Eliminar
                $(".eliminarRegistro").click(function() {
                    var datanu = $(this).attr('viewBlt');
                    var parametros = {
                        id: datanu,
                        compiler: <?php echo $status ?>

                    };
                    console.log(parametros);
                    $.ajax({
                        data: parametros,
                        url: 'modal/del.php',
                        method: 'POST',
                        success: function(aviso) {
                            $("#del_registro").html(aviso);
                            console.log(aviso);

                        }
                    });
                });

                // Pagar NO FUNCIONA YA EN LA PAGINA
                $(".pagarRegistro").click(function() {
                    var datanu = $(this).attr('viewBlt');
                    var pay_Param = {
                        "id": datanu
                    };
                    $.ajax({
                        data: pay_Param,
                        url: 'modal/pay.php',
                        method: 'POST',
                        success: function(avisoPay) {
                            $(".cuadro2pay").html(avisoPay);
                            console.log(avisoPay);

                        }
                    });
                });

                // Falta acomoda Compiler
                // Pasa los datos
                $('.acciones_usuario').click(function() {
                    var dataFolio = $(this).data('folio');
                    var dataNombre = $(this).data('nombre');
                    var dataPay = $(this).data('pay');
                    $('#twoFactorAuth').modal('show');
                    $('.nombre_cliente').text(dataNombre);
                    $('.bsX').attr('viewBlt', dataFolio);
                    $('.bsXEdit').attr('viewBlt', dataFolio);
                    $('.btnEditForm').attr('viewBlt', dataFolio);
                    $('.eliminarRegistro').attr('viewBlt', dataFolio); // eliminar 
                    $('.advertenciaRegistro').attr('viewBlt', dataFolio); // eliminar 
                    $('.pagarRegistro').attr('viewBlt', dataFolio); // pagar

                    console.log(dataPay);

                    if (dataPay === 'Pagado') {
                        console.log('Pagado');
                        $('.pay_action_request').css('display', 'none');

                    } else {
                        console.log('Apartado');
                    }

                });

                // Falta acomoda Compiler
                $('.delete_quiniela').click(function() {
                    var confirmacion = confirm("¿Estás seguro de que quieres Eliminar <?php echo $infoSorteoNombre; ?> esto?");
                    if (confirmacion) {
                        var urlx = 'reset?table=<?php echo $status; ?>';
                        window.open(urlx, '_blank');
                        alert("Se han eliminado las quinielas de <?php echo $infoSorteoNombre; ?>");

                    } else {
                        alert("Has cancelado la acción.");

                    }

                });

                $(".advertenciaRegistro").on('click', function() {
                    var datanu = $(this).attr('viewBlt');
                    var parametros = {
                        id: datanu,
                        compiler: <?php echo $status ?>

                    };
                    console.log(parametros);
                    $.ajax({
                        data: parametros,
                        url: 'modal/Adver.php',
                        method: 'POST',
                        success: function(aviso) {
                            $("#del_registro").html(aviso);
                            console.log(aviso);

                        }
                    });
                });

                // Falta acomoda Compiler
                $('.quiniela_names_pays').click(function() {
                    var urlx = '../user_pay';
                    window.open(urlx, '_blank');

                });

                // Falta acomoda Compiler
                $('.quiniela_names_pays_json').click(function() {
                    var urlx = '../user_v2/download_json?id=<?php echo $status; ?>';
                    // console.log(urlx);
                    window.open(urlx, '_blank');

                });

                // Falta acomoda Compiler
                $('#DataTables_Table_3').DataTable({
                    "lengthMenu": [
                        [99, 100, 2000, 500, 1000, 1500, 3000, -1],
                        [99, 100, 2000, 500, 1000, 1500, 3000, , "All"]
                    ],
                    language: {
                        "lengthMenu": "<div style='margin-left: 15px!important;'>Mostrar _MENU_ registros</div>",
                        "zeroRecords": "No se encontraron resultados",
                        "info": "<span style='margin: 15px!important;'>Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros</span>",
                        "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
                        "infoFiltered": "(filtrado de un total de _MAX_ registros)",
                        "sSearch": "Buscar:",
                        "oPaginate": {
                            "sFirst": '<span class="bts_table">Primero</span>',
                            "sLast": '<span class="bts_table">Último</span>',
                            "sNext": '<span class="bts_table">Siguiente</span>',
                            "sPrevious": '<span class="bts_table">Anterior</span>'
                        },
                        "sProcessing": "Procesando...",
                    },
                    responsive: "true",
                    dom: 'Bfrtilp',
                    buttons: [{
                        extend: 'excelHtml5',
                        text: '<i class="fas" style="font-family: arial;font-weight: 500!important;"> Exportar todos los registros a Excel </i> ',
                        titleAttr: 'Exportar todos los registros a Excel',
                        className: 'btn btn-primary'
                    }],
                    initComplete: function() {
                        var searchInput = $('input[type="search"]'); // Selecciona la barra de búsqueda
                        searchInput.addClass('form-control'); // Agrega tu clase personalizada

                        $('.dataTables_length select[name="DataTables_Table_3_length"]').addClass(
                            'form-select');



                    },

                });

            });
        </script>
        <script src="edit.js"></script>
        <script src="js/ajax__actions.js"></script>

</body>

</html>

<!-- beautify ignore:end -->