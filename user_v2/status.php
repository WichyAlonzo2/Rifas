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
} else if ($status === 2) {
    $dbUse = '_two';
    $active = 'active';
    $titleStatus = $infoSorteoNombre2;
} else if ($status === 3) {
    $dbUse = '_tree';
    $active = 'active';
    $titleStatus = $infoSorteoNombre3;
} else {
    echo '  <script type="text/javascript">
                window.location.href = "status?id=1"; // Reemplaza con la URL a la que deseas redirigir
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

    <title>Status <?php echo $titleStatus . ' - ' . $nombreCorto ?></title>


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

                                <li class="menu-item active">
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
                                    <li class="menu-item active">
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
                                    <li class="menu-item active">
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

                    <div class="container-xxl flex-grow-1 container-p-y">

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
                                                    $porcenStados = round($porcentaje, 1);
                                                    $porcentajeCliente = number_format($porcenStados, 1) . '%';

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
                                                <span style="font-size: 12px;">Boletos Pagados
                                                    ( <?php echo $countPay . " | $" . $caja;; ?>)</span>
                                            </h6>
                                            <div class="d-flex">
                                                <p class="mb-0 me-3 text-success">$<?php echo $caja; ?></p>
                                            </div>
                                        </div>
                                        <div class="d-flex justify-content-between mb-3 pb-1">
                                            <h6 class="mb-0">Faltante
                                                <br>
                                                <span style="font-size: 12px;">Boletos No Pagados
                                                    ( <?php echo $countApar . " | $" . $pagos; ?>)</span>
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
                                        <div style="margin-left: 27px;">
                                            <button class="btn btn-primary buttons__rad quiniela_names_pays_json" tabindex="0" aria-controls="example" type="button" title="Quiniela (Solo nombres)">
                                                <span><i class="fas" style="font-family: arial;font-weight: 500!important;"> Rifa / Sorteo (JSON) </i> </span>
                                            </button>
                                            <button class="btn btn-danger buttons__rad delete_quiniela" tabindex="0" aria-controls="example" type="button" title="Eliminar Base">
                                                <span><i class="fas" style="font-family: arial;font-weight: 500!important;"> Eliminar Sorteo </i> </span>
                                            </button>
                                        </div>
                                        <table class="dt-responsive table dataTable dtr-column collapsed" id="DataTables_Table_3" aria-describedby="DataTables_Table_3_info" style="width: 1208px;">
                                            <thead>
                                                <tr>
                                                    <th class="sorting" tabindex="0" aria-controls="DataTables_Table_3" rowspan="1" colspan="1" style="width: 77px;" aria-label="Name: activate to sort column ascending">Folio</th>
                                                    <th class="sorting" tabindex="0" aria-controls="DataTables_Table_3" rowspan="1" colspan="1" style="width: 77px;" aria-label="Name: activate to sort column ascending">Referido</th>
                                                    <th class="sorting" tabindex="0" aria-controls="DataTables_Table_3" rowspan="1" colspan="1" style="width: 30px;" aria-label="Email: activate to sort column ascending">Cant</th>
                                                    <th class="sorting" tabindex="0" aria-controls="DataTables_Table_3" rowspan="1" colspan="1" style="width: 118px;" aria-label="Post: activate to sort column ascending">Quinielas
                                                    </th>
                                                    <th class="sorting" tabindex="0" aria-controls="DataTables_Table_3" rowspan="1" colspan="1" style="width: 98px;" aria-label="City: activate to sort column ascending">Nombre</th>
                                                    <th class="sorting" tabindex="0" aria-controls="DataTables_Table_3" rowspan="1" colspan="1" style="width: 75px;" aria-label="Date: activate to sort column ascending">Numero</th>
                                                    <th class="sorting" tabindex="0" aria-controls="DataTables_Table_3" rowspan="1" colspan="1" style="width: 73px;" aria-label="Salary: activate to sort column ascending">Esado
                                                    </th>
                                                    <th class="sorting" tabindex="0" aria-controls="DataTables_Table_3" rowspan="1" colspan="1" style="width: 30px;" aria-label="Age: activate to sort column ascending">Status</th>
                                                    <th class="sorting" tabindex="0" aria-controls="DataTables_Table_3" rowspan="1" colspan="1" style="width: 92px;" aria-label="Experience: activate to sort column ascending">Tipo
                                                        Pago</th>
                                                    <th class="sorting" tabindex="0" aria-controls="DataTables_Table_3" rowspan="1" colspan="1" style="width: 92px;" aria-label="Experience: activate to sort column ascending">Fecha
                                                        Compra</th>
                                                    <th class="sorting" tabindex="0" aria-controls="DataTables_Table_3" rowspan="1" colspan="1" style="width: 92px;" aria-label="Experience: activate to sort column ascending">Fecha
                                                        Pago</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $query = "SELECT * from sorteomini$dbUse ORDER BY timeCompra DESC";
                                                $result_tasks = mysqli_query($db, $query);
                                                while ($dataCliente = mysqli_fetch_assoc($result_tasks)) {
                                                    if ($dataCliente['statusBoleto'] == 'Apartado') { ?>
                                                        <tr class="<?php echo $dataCliente['statusBoleto']; ?> acciones_usuario " data-nombre="<?php echo $dataCliente['nombre']; ?>" data-folio="<?php echo $dataCliente['folio']; ?>" data-pay="<?php echo $dataCliente['statusBoleto']; ?>">
                                                            <td><?php echo $dataCliente['folio']; ?></td>
                                                            <td><?php echo $dataCliente['refe']; ?></td>
                                                            <td><?php echo $dataCliente['cant']; ?></td>
                                                            <td class="limitado"><?php
                                                                                    $boletosCrudos = $dataCliente['boletoOpp'];
                                                                                    $sinAster = str_replace("*", "", $boletosCrudos);
                                                                                    $sinUrl = str_replace("%0A", "<br>", $sinAster);
                                                                                    $bolLimit = substr($sinUrl, 0, 100) . '...';

                                                                                    echo $bolLimit; ?></td>
                                                            <td><?php echo $dataCliente['nombre']; ?></td>
                                                            <td><?php echo $dataCliente['numero']; ?></td>
                                                            <td><?php echo $dataCliente['estado']; ?></td>
                                                            <td>
                                                                <span class="badge bg-label-warning"><?php echo $dataCliente['statusBoleto']; ?></span>
                                                            </td>
                                                            <td>
                                                                <span class="badge bg-label-info"><?php echo $dataCliente['typePay']; ?></span>
                                                            </td>
                                                            <td><?php
                                                                if ($dataCliente['timeCompra'] != null) {
                                                                    date_default_timezone_set("America/Mexico_City");
                                                                    $fechaCompra = new DateTime($dataCliente['timeCompra']);
                                                                    $fechaActual = new DateTime();
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
                                                                ?></td>
                                                            --
                                                            <td><?php
                                                                date_default_timezone_set("America/Mexico_City");
                                                                if ($dataCliente['timePay'] === null) {
                                                                    echo "-";
                                                                } else {
                                                                    $fechaPago = new DateTime($dataCliente['timePay']);
                                                                    $fechaActual = new DateTime();
                                                                    $intervalo = $fechaActual->diff($fechaPago);
                                                                    if ($intervalo->y > 0) {
                                                                        echo $intervalo->y . "año";
                                                                    } elseif ($intervalo->m > 0) {
                                                                        echo $intervalo->m . "mes";
                                                                    } elseif ($intervalo->d > 0) {
                                                                        echo $intervalo->d . "d";
                                                                    } elseif ($intervalo->h > 0) {
                                                                        echo $intervalo->h . "h";
                                                                    } elseif ($intervalo->i > 0) {
                                                                        echo $intervalo->i . "min";
                                                                    } else {
                                                                        echo $intervalo->s . "seg";
                                                                    }
                                                                }
                                                                ?></td>


                                                        </tr>
                                                    <?php } elseif ($dataCliente['statusBoleto'] == 'Pagado') { ?>
                                                        <tr class="<?php echo $dataCliente['statusBoleto']; ?> acciones_usuario " data-nombre="<?php echo $dataCliente['nombre']; ?>" data-folio="<?php echo $dataCliente['folio']; ?>" data-pay="<?php echo $dataCliente['statusBoleto']; ?>">
                                                            <td><?php echo $dataCliente['folio']; ?></td>
                                                            <td><?php echo $dataCliente['refe']; ?></td>
                                                            <td><?php echo $dataCliente['cant']; ?></td>
                                                            <td class="limitado"><?php
                                                                                    $boletosCrudos = $dataCliente['boletoOpp'];
                                                                                    $sinAster = str_replace("*", "", $boletosCrudos);
                                                                                    $sinUrl = str_replace("%0A", "<br>", $sinAster);
                                                                                    $bolLimit = substr($sinUrl, 0, 100) . '...';

                                                                                    echo $bolLimit; ?></td>
                                                            <td><?php echo $dataCliente['nombre']; ?></td>
                                                            <td><?php echo $dataCliente['numero']; ?></td>
                                                            <td><?php echo $dataCliente['estado']; ?></td>
                                                            <td>
                                                                <span class="badge bg-label-success"><?php echo $dataCliente['statusBoleto']; ?></span>
                                                            </td>
                                                            <td>
                                                                <span class="badge bg-label-info"><?php echo $dataCliente['typePay']; ?></span>
                                                            </td>
                                                            <td><?php
                                                                date_default_timezone_set("America/Mexico_City");
                                                                $fechaCompra = new DateTime($dataCliente['timeCompra']);
                                                                $fechaActual = new DateTime();
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
                                                                ?></td>

                                                            <td><?php
                                                                date_default_timezone_set("America/Mexico_City");
                                                                if ($dataCliente['timePay'] === '') {
                                                                    echo "-";
                                                                } else {
                                                                    $fechaPago = new DateTime($dataCliente['timePay']);
                                                                    $fechaActual = new DateTime();
                                                                    $intervalo = $fechaActual->diff($fechaPago);
                                                                    if ($intervalo->y > 0) {
                                                                        echo $intervalo->y . "año";
                                                                    } elseif ($intervalo->m > 0) {
                                                                        echo $intervalo->m . "mes";
                                                                    } elseif ($intervalo->d > 0) {
                                                                        echo $intervalo->d . "d";
                                                                    } elseif ($intervalo->h > 0) {
                                                                        echo $intervalo->h . "h";
                                                                    } elseif ($intervalo->i > 0) {
                                                                        echo $intervalo->i . "min";
                                                                    } else {
                                                                        echo $intervalo->s . "seg";
                                                                    }
                                                                }
                                                                ?></td>

                                                        </tr>
                                                <?php }
                                                } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal fade" id="twoFactorAuth" tabindex="-1" style="display: none;" aria-hidden="true">
                            <div class="modal-dialog modal-lg modal-dialog-centered modal-simple">
                                <div class="modal-content p-3 p-md-5">
                                    <div class="modal-body">
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        <div class="text-center mb-4">
                                            <h3 class="mb-2">Selecciona una accion para </span></h3>
                                            <p class="text-muted">🟢 <span class="nombre_cliente"></p>
                                            <span class="text-success">Todas las opcione estan funcionando</span>
                                        </div>
                                        <div class="row">
                                            <!-- Boleto  -->
                                            <div class="col-12 mb-3" hidden>
                                                <div class="form-check custom-option custom-option-basic checked">
                                                    <label class="form-check-label custom-option-content ps-3 bsX" viewblt="" for="customRadioTemp1" data-bs-target="#s" data-bs-toggle="modal">
                                                        <input name="customRadioTemp" class="form-check-input d-none" type="radio" value="" id="customRadioTemp1">
                                                        <span class="d-flex align-items-start">
                                                            <i class="ti ti-edit-circle ti-xl me-3"></i>
                                                            <span>
                                                                <span class="custom-option-header">
                                                                    <span class="h4 mb-2">Boleto</span>
                                                                </span>
                                                                <span class="custom-option-body">
                                                                    <span class="mb-0">Edita el registro de tus
                                                                        clientes</span>
                                                                </span>
                                                            </span>
                                                        </span>
                                                    </label>
                                                </div>
                                            </div>

                                            <!-- Boleto Unico -->
                                            <div class="col-12 mb-3">
                                                <div class="form-check custom-option custom-option-basic checked">
                                                    <label class="form-check-label custom-option-content ps-3" viewblt="" for="customRadioTemp1" data-bs-target="#boletoregistro" data-bs-toggle="modal">
                                                        <input name="customRadioTemp" class="form-check-input d-none" type="radio" value="" id="customRadioTemp1">
                                                        <span class="d-flex align-items-start">
                                                            <i class="ti ti-ticket ti-xl me-3"></i>
                                                            <span>
                                                                <span class="custom-option-header">
                                                                    <span class="h4 mb-2">Boleto Digital </span>
                                                                </span>
                                                                <span class="custom-option-body">
                                                                    <span class="mb-0">Descarga el Boleto digital con
                                                                        los registros del cliente</span>
                                                                </span>
                                                            </span>
                                                        </span>
                                                    </label>
                                                </div>
                                            </div>
                                            <!-- Editar -->
                                            <div class="col-12 mb-3">
                                                <div class="form-check custom-option custom-option-basic checked">
                                                    <label class="form-check-label custom-option-content ps-3 bsXEdit" viewblt="" for="customRadioTemp1" data-bs-target="#editarRegistro" data-bs-toggle="modal">
                                                        <input name="customRadioTemp" class="form-check-input d-none" type="radio" value="" id="customRadioTemp1">
                                                        <span class="d-flex align-items-start">
                                                            <i class="ti ti-edit-circle ti-xl me-3"></i>
                                                            <span>
                                                                <span class="custom-option-header">
                                                                    <span class="h4 mb-2">Editar </span>
                                                                </span>
                                                                <span class="custom-option-body">
                                                                    <span class="mb-0">Edita el registro de tus
                                                                        clientes</span>
                                                                </span>
                                                            </span>
                                                        </span>
                                                    </label>
                                                </div>
                                            </div>
                                            <!-- Eliminar -->
                                            <div class="col-12 mb-3">
                                                <div class="form-check custom-option custom-option-basic checked">
                                                    <label class="form-check-label custom-option-content ps-3 bsX" viewblt="" for="customRadioTemp1" data-bs-target="#eliminarRegistro" data-bs-toggle="modal">
                                                        <input name="customRadioTemp" class="form-check-input d-none" type="radio" value="" id="customRadioTemp1">
                                                        <span class="d-flex align-items-start">
                                                            <i class="ti ti-eraser ti-xl me-3"></i>
                                                            <span>
                                                                <span class="custom-option-header">
                                                                    <span class="h4 mb-2">Eliminar Registro </span>
                                                                </span>
                                                                <span class="custom-option-body">
                                                                    <span class="mb-0">Elimina Registro de algun
                                                                        participante</span>
                                                                </span>
                                                            </span>
                                                        </span>
                                                    </label>
                                                </div>
                                            </div>

                                            <!-- Pagar -->
                                            <!-- <div class="col-12 mb-3 pay_action_request">
                                                <div class="form-check custom-option custom-option-basic checked">
                                                    <label class="form-check-label custom-option-content ps-3 bsX" viewblt="" for="customRadioTemp1" data-bs-target="#pagoRegistro" data-bs-toggle="modal">
                                                        <input name="customRadioTemp" class="form-check-input d-none" type="radio" value="" id="customRadioTemp1">
                                                        <span class="d-flex align-items-start">
                                                            <i class="ti ti-currency-dollar ti-xl me-3"></i>
                                                            <span>
                                                                <span class="custom-option-header">
                                                                    <span class="h4 mb-2">Pagar Quinielas</span>
                                                                </span>
                                                                <span class="custom-option-body">
                                                                    <span class="mb-0">Cambia el status de la quiniela a
                                                                        Pagado</span>
                                                                </span>
                                                            </span>
                                                        </span>
                                                    </label>
                                                </div>
                                            </div> -->
                                            <!-- Advertencia -->
                                            <div class="col-12 mb-3">
                                                <div class="form-check custom-option custom-option-basic checked">
                                                    <label class="form-check-label custom-option-content ps-3" for="customRadioTemp1" data-bs-target="#advertenciaRegistro" data-bs-toggle="modal">
                                                        <input name="customRadioTemp" class="form-check-input d-none" type="radio" value="" id="customRadioTemp1">
                                                        <span class="d-flex align-items-start">
                                                            <i class="ti ti-alert-triangle-filled ti-xl me-3"></i>
                                                            <span>
                                                                <span class="custom-option-header">
                                                                    <span class="h4 mb-2">Advertencia </span>
                                                                </span>
                                                                <span class="custom-option-body">
                                                                    <span class="mb-0">Envia una advertencia al cliente
                                                                        para realizar el pago de sus Boletos</span>
                                                                </span>
                                                            </span>
                                                        </span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Boleto -->
                        <!-- Checar estilos -->
                        <div class="modal fade" id="boletoregistro" tabindex="-1" style="display: none;" aria-hidden="true">
                            <div class="modal-dialog modal-lg modal-dialog-centered modal-simple">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content buttons__rad">
                                        <div class="text-center mb-2">
                                            <h3 class="mb-0">Boleto digital de</h3>
                                            <p class="text-muted">🟢 <span class="nombre_cliente">
                                        </div>
                                        <div class="modal-body">
                                            <div class="imgBoleto">
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button class="btn btn-light buttons__rad" type="button" data-bs-dismiss="modal">Cerrar</button>
                                            <button class="btn btn-danger buttons__rad" id="btnCapturar" type="button">Generar Boleto</button>
                                        </div>
                                    </div>
                                </div>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>


                            </div>
                        </div>


                        <!-- Editar -->
                        <!-- Listo visual -->
                        <!-- Listo logica -->
                        <div class="modal fade" id="editarRegistro" tabindex="-1" style="display: none;" aria-hidden="true">
                            <div class="modal-dialog modal-lg modal-dialog-centered modal-simple">
                                <div class="modal-content p-3 p-md-5">
                                    <div class="modal-body">
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        <form action='javascript:void(0);' method='GET'>
                                            <div class="text-center mb-2">
                                                <h3 class="mb-0">Editar Registro de</h3>
                                                <p class="text-muted">🟢 <span class="nombre_cliente">
                                            </div>
                                            <div id="snoAlertBox" class="alert alert-warning" data-alert="alert" style="display:none;">Agrega una forma de pago</div>
                                            <div class="mk"></div>
                                            <div class="info"></div>
                                            <div class="text-end">
                                                <button type="button" class="btn btn-label-secondary me-sm-3 me-1 waves-effect" data-bs-toggle="modal" data-bs-target="#twoFactorAuth"><i class="ti ti-arrow-left ti-xs me-1 scaleX-n1-rtl"></i><span class="align-middle d-none d-sm-inline-block">Back</span></button>
                                                <button type="button" class="btn btn-primary waves-effect waves-light btnEditForm" viewblt=""><span class="align-middle d-none d-sm-inline-block">Guardar</span><i class="ti ti-arrow-right ti-xs ms-1 scaleX-n1-rtl"></i></button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Eliminar -->
                        <!-- Listo visual -->
                        <!-- Listo logica -->
                        <div class="modal fade" id="eliminarRegistro" tabindex="-1" style="display: none;" aria-hidden="true">
                            <div class="modal-dialog modal-lg modal-dialog-centered modal-simple">
                                <div class="modal-content p-3 p-md-5">
                                    <div class="modal-body">
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        <div class="text-center mb-2">
                                            <h3 class="mb-0">Eliminar Registro de</h3>
                                            <p class="text-muted">🟢 <span class="nombre_cliente">
                                        </div>
                                        <div id="del_registro"></div>
                                        <div class="row mb-4 g-4">
                                            <div class="">
                                                <div class="">
                                                    <div class="">
                                                        <h5 class="mb-2">Estas seguro de eliminar este registro?</h5>
                                                        <p class="mb-4">Si aceptas eliminar el registro este ya no se
                                                            podra recuperar de la base de datos.</p>
                                                        <div class="d-flex flex-column flex-sm-row justify-content-between text-center gap-3">
                                                            <div class="d-flex flex-column align-items-center">
                                                                <span><i class="ti ti-rocket text-primary ti-xl p-3 border border-1 border-primary rounded-circle border-dashed mb-0"></i></span>
                                                                <small class="my-2 w-75">Hazlo si no te han
                                                                    pagado</small>
                                                            </div>
                                                            <div class="d-flex flex-column align-items-center">
                                                                <span><i class="ti ti-id text-primary ti-xl p-3 border border-1 border-primary rounded-circle border-dashed mb-0"></i></span>
                                                                <small class="my-2 w-100">Verifica que el registro
                                                                    que<br>quieres eliminar es el correcto</small>
                                                            </div>
                                                            <div class="d-flex flex-column align-items-center">
                                                                <span><i class="ti ti-send text-primary ti-xl p-3 border border-1 border-primary rounded-circle border-dashed mb-0"></i></span>
                                                                <small class="my-2 w-100">Se le enviara mensaje al
                                                                    cliente<br>para que este al tanto de tu
                                                                    decision</small>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="text-end">
                                                <button type="button" class="btn btn-label-secondary me-sm-3 me-1 waves-effect" data-bs-toggle="modal" data-bs-target="#twoFactorAuth"><i class="ti ti-arrow-left ti-xs me-1 scaleX-n1-rtl"></i><span class="align-middle d-none d-sm-inline-block">Back</span></button>
                                                <button type="button" class="btn btn-primary waves-effect waves-light eliminarRegistro" data-bs-dismiss="modal" aria-label="Close" viewblt=""><span class="align-middle d-none d-sm-inline-block">Si, estoy
                                                        seguro</span><i class="ti ti-arrow-right ti-xs ms-1 scaleX-n1-rtl"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Pagar -->
                        <!-- Listo visual -->
                        <div class="modal fade" id="pagoRegistro" tabindex="-1" style="display: none;" aria-hidden="true">
                            <div class="modal-dialog modal-lg modal-dialog-centered modal-simple">
                                <div class="modal-content p-3 p-md-5">
                                    <div class="modal-body">
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        <div class="text-center mb-2">
                                            <h3 class="mb-0">Pagar Boletos de</h3>
                                            <p class="text-muted">🟢 <span class="nombre_cliente">
                                                    <div class="cuadro2pay"></div>
                                                    <div class="">
                                                        <div class="" style="text-align: initial;">
                                                            <div class="">
                                                                <h5 class="mb-2">Estas seguro de pagar estos Boletos?
                                                                </h5>
                                                                <p class="mb-4">Si agregaste por error el pago a 🟢
                                                                    <span class="nombre_cliente"></span> puedes
                                                                    cambiar<br>el Status a Apartado en la opcion
                                                                    <b>EDITAR</b>
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="text-end">
                                                        <button type="button" class="btn btn-label-secondary me-sm-3 me-1 waves-effect" data-bs-toggle="modal" data-bs-target="#twoFactorAuth"><i class="ti ti-arrow-left ti-xs me-1 scaleX-n1-rtl"></i><span class="align-middle d-none d-sm-inline-block">Back</span></button>
                                                        <button type="button" class="btn btn-primary waves-effect waves-light pagarRegistro" data-bs-dismiss="modal" aria-label="Close" viewBlt=""><span class="align-middle d-none d-sm-inline-block">Si, estoy
                                                                seguro</span><i class="ti ti-arrow-right ti-xs ms-1 scaleX-n1-rtl"></i></button>
                                                    </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Advertencia -->
                        <div class="modal fade" id="advertenciaRegistro" tabindex="-1" style="display: none;" aria-hidden="true">
                            <div class="modal-dialog modal-lg modal-dialog-centered modal-simple">
                                <div class="modal-content p-3 p-md-5">
                                    <div class="modal-body">
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        <div class="text-center mb-2">
                                            <h3 class="mb-0">Enviar una Advertencia a</h3>
                                            <p class="text-muted">🟢 <span class="nombre_cliente">
                                        </div>
                                        <div class="">
                                            <div class="" style="text-align: initial;">
                                                <div class="">
                                                    <h5 class="mb-2">Estas seguro de enviar una notificacion al cliente?
                                                    </h5>
                                                    <p class="mb-4">Usa esta opcion cuando el cliente no ha pagado sus
                                                        Boletos</p>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="text-end">
                                            <button type="button" class="btn btn-label-secondary me-sm-3 me-1 waves-effect" data-bs-toggle="modal" data-bs-target="#twoFactorAuth"><i class="ti ti-arrow-left ti-xs me-1 scaleX-n1-rtl"></i><span class="align-middle d-none d-sm-inline-block">Back</span></button>
                                            <button type="button" class="btn btn-primary waves-effect waves-light advertenciaRegistro" viewblt="" data-bs-dismiss="modal" aria-label="Close"><span class="align-middle d-none d-sm-inline-block">Si, estoy
                                                    seguro</span><i class="ti ti-arrow-right ti-xs ms-1 scaleX-n1-rtl"></i></button>
                                        </div>
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
                        alert("Se han eliminado los Boletos de <?php echo $infoSorteoNombre; ?>");

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