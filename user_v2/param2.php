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
        // echo '  <script type="text/javascript">
        //                     window.location.href = "param2"; // Reemplaza con la URL a la que deseas redirigir
        //                 </script>';
    }
} else {
    header('location: /');
}

include $urlPartner . '/root.php';

// Libre
$result = mysqli_query($db, "SELECT COUNT(*) AS `count` FROM `info_boletos` WHERE statusBoleto='No'");
$row = mysqli_fetch_array($result);
$countFree = $row['count'];

// Pagados
$result = mysqli_query($db, "SELECT COUNT(*) AS `count` FROM `info_boletos` WHERE statusBoleto='Pagado'");
$row = mysqli_fetch_array($result);
$countPay = $row['count'];

// Apartados
$result = mysqli_query($db, "SELECT COUNT(*) AS `count` FROM `info_boletos` WHERE statusBoleto='Apartado'");
$row = mysqli_fetch_array($result);
$countApar = $row['count'];

// Pronto Pago
$result = mysqli_query($db, "SELECT COUNT(*) AS `count` FROM `info_boletos` WHERE prontoPago='Si'");
$row = mysqli_fetch_array($result);
$countPronto = $row['count'];

// Conteo de los Boletos en General
$result = mysqli_query($db, "SELECT COUNT(*) AS `count` FROM `info_boletos`");
$row = mysqli_fetch_array($result);
$countBoletos = $row['count'];

// Boletos Libre
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
$consultax = ("SELECT SUM(total) as total FROM sorteomini;");
$resulx = mysqli_query($db, $consultax);
$datax = mysqli_fetch_array($resulx);
$caja = $datax['total'];

// Suma de Apartados
$consultaxx = ("SELECT SUM(pagos) as pagos FROM sorteomini WHERE pagos > 0");
$resulxx = mysqli_query($db, $consultaxx);
$dataxx = mysqli_fetch_array($resulxx);
$pagos = $dataxx['pagos'];

// Suma de Apartados + Negativos
$consultaxxx = ("SELECT SUM(pagos) as pagos FROM sorteomini WHERE pagos < 0");
$resulxxx = mysqli_query($db, $consultaxxx);
$dataxxx = mysqli_fetch_array($resulxxx);
$pagosNegativos = $dataxxx['pagos'];
$pagosN = -$pagos + $pagosNegativos;


// Tipos de pago
$queryTypePay = "SELECT typePay, COUNT(*) as total FROM sorteomini GROUP BY typePay";


$jsonData = file_get_contents('../app/team2.json');
$data = json_decode($jsonData, true);

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Obtener los datos del formulario
    $clave = $_POST["clave"];
    $gol1 = $_POST["gol1"];
    $gol2 = $_POST["gol2"];

    // Leer el archivo JSON existente
    $jsonFile = '../app/team2.json';
    $jsonData = json_decode(file_get_contents($jsonFile), true);

    // Actualizar los datos en el archivo JSON
    if (isset($jsonData[$clave])) {
        $compiler = '';
        if ($gol1 === $gol2) {
            echo 'empate';
            $compiler = 'E';
        } else if ($gol1 > $gol2) {
            echo 'Gana Local';
            $compiler = 'L';
        } else if ($gol2 > $gol1) {
            echo 'Gana Visitante';
            $compiler = 'V';
        }


        $jsonData[$clave][0]["gol1"] = $gol1;
        $jsonData[$clave][0]["gol2"] = $gol2;
        $jsonData[$clave][0]["compiler"] = $compiler;


        // Guardar los datos actualizados en el archivo JSON
        $jsonString = json_encode($jsonData, JSON_PRETTY_PRINT);
        // echo $jsonData;
        if (file_put_contents($jsonFile, $jsonString)) {
            $response = ["status" => "success", "message" => "Datos guardados correctamente."];
        } else {
            $response = ["status" => "error", "message" => "Error al guardar los datos en el archivo JSON."];
        }
    } else {
        $response = ["status" => "error", "message" => "Clave no encontrada en el archivo JSON."];
    }

    // Enviar la respuesta JSON de vuelta al cliente
    header('Content-Type: application/json');
    echo json_encode($response);
    exit;
}
?>
<!DOCTYPE html>
<html lang="en" class="dark-style layout-navbar-fixed layout-menu-fixed layout-compact " dir="ltr" data-theme="theme-default" data-assets-path="assets/" data-template="vertical-menu-template-dark">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0">

    <title>Partidos <?php echo $infoSorteoNombre2 . ' - ' . $nombreCorto?></title>


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
    <!-- <link rel="stylesheet" href="assets/vendor/fonts/fontawesome.css"> -->
    <!-- <link rel="stylesheet" href="assets/vendor/fonts/afontawesome.css"> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

    <link rel="stylesheet" href="assets/vendor/fonts/tabler-icons.css">
    <link rel="stylesheet" href="assets/vendor/fonts/flag-icons.css">

    <!-- Core CSS -->
    <link rel="stylesheet" href="assets/vendor/css/rtl/core-dark.css" class="template-customizer-core-css">
    <link rel="stylesheet" href="assets/vendor/css/rtl/theme-default-dark.css" class="template-customizer-theme-css">
    <link rel="stylesheet" href="assets/css/demo.css">



    <link rel="stylesheet" href="assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css">
    <link rel="stylesheet" href="assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css">

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

        .ticket__first-section {}

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
        }


        /*
    Pagina Ticket
*/

        .ticket>aside:first-of-type {
            right: 53px;
            top: 50%;
            transform: translateY(-50%) rotate(-90deg);
        }

        .ticket>aside:last-of-type {
            left: 55px;
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
                            <div data-i18n="Dashboards">Dashboards</div>
                        </a>
                        <ul class="menu-sub">
                            <li class="menu-item">
                                <a href="/user_v2/status" class="menu-link">
                                    <div data-i18n="Status <?php echo $infoSorteoNombre; ?>">Status <?php echo $infoSorteoNombre; ?></div>
                                </a>
                            </li>
                            <li class="menu-item">
                                <a href="/user_v2/status2" class="menu-link">
                                    <div data-i18n="Status <?php echo $infoSorteoNombre2; ?>">Status <?php echo $infoSorteoNombre2; ?></div>
                                </a>
                            </li>
                            <li class="menu-item">
                                <a href="/user_v2/param" class="menu-link">
                                    <div data-i18n="Panel partido <?php echo $infoSorteoNombre; ?>">Status <?php echo $infoSorteoNombre; ?></div>
                                </a>
                            </li>
                            <li class="menu-item active">
                                <a href="/user_v2/param2" class="menu-link">
                                    <div data-i18n="Panel partido <?php echo $infoSorteoNombre2; ?>">Status <?php echo $infoSorteoNombre2; ?></div>
                                </a>
                            </li>
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
                                                <a href="/user_v2/status" class="stretched-link">Status Quinielas</a>
                                                <small class="text-muted mb-0"><?php echo $infoSorteoNombre; ?></small>
                                            </div>
                                            <div class="dropdown-shortcuts-item col">
                                                <span class="dropdown-shortcuts-icon rounded-circle mb-2">
                                                    <i class="ti ti-shirt-sport"></i>
                                                </span>
                                                <a href="/user_v2/param" class="stretched-link">Panel partidos</a>
                                                <small class="text-muted mb-0"><?php echo $infoSorteoNombre; ?></small>
                                            </div>
                                        </div>
                                        <div class="row row-bordered overflow-visible g-0">
                                            <div class="dropdown-shortcuts-item col">
                                                <span class="dropdown-shortcuts-icon rounded-circle mb-2">
                                                    <i class="ti ti-ticket"></i>
                                                </span>
                                                <a href="/user_v2/status2" class="stretched-link">Status Quinielas</a>
                                                <small class="text-muted mb-0"><?php echo $infoSorteoNombre2; ?></small>
                                            </div>
                                            <div class="dropdown-shortcuts-item col">
                                                <span class="dropdown-shortcuts-icon rounded-circle mb-2">
                                                    <i class="ti ti-shirt-sport"></i>
                                                </span>
                                                <a href="/user_v2/param2" class="stretched-link">Panel partidos</a>
                                                <small class="text-muted mb-0"><?php echo $infoSorteoNombre2; ?></small>
                                            </div>
                                        </div>
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

                        <div class="container-fluid">
                            <div class="card">
                                <div class="card-header py-3">
                                    <p class="text-primary m-0 fw-bold">Panel de Partidos <?php echo $infoSorteoNombre ?></p>
                                </div>
                                <div class="card-body">
                                    <div class="text-center">
                                        <button class="btn btn-success buttons__rad quiniela_names_pay" tabindex="0" aria-controls="example" type="button" title="Quiniela (Solo nombres)">
                                            <span><i class="fas" style="font-family: arial;font-weight: 500!important;"> Descargar avance </i> </span>
                                        </button>
                                    </div>
                                    <div class="table-responsive table mt-2" id="dataTable" role="grid" aria-describedby="dataTable_info">
                                        <table id="example" class="table my-0" id="dataTable">
                                            <tbody>
                                                <?php
                                                foreach ($data as $columnNumber => $columnData) :

                                                    $clave = $columnNumber;

                                                ?>
                                                    <tr data-part="<?= $clave ?>" style="border-color: transparent;display: flex;flex-direction: row;flex-wrap: wrap;justify-content: center;">
                                                        <div>
                                                            <td class="alings__team"><img class="img_team" src="../assets/img/team/<?= $columnData[0]['img1'] ?>" alt="Imagen 1" width="60">
                                                                <!-- <h6 class="span__equipos"><?= $columnData[0]['team1'] ?> (L)</h6> -->
                                                            </td>

                                                        </div>
                                                        <td style="width: 6%;text-align: center;vertical-align: middle;padding: 0px!important">
                                                            <div style="display: flex;flex-wrap: wrap;flex-direction: row-reverse;justify-content: center;margin-top: 20px;">
                                                                <input class="form-control" style="width: 50px;text-align: center;" type="text" name="" id="" value="<?php echo $columnData[0]['gol1'] ?>">
                                                            </div>
                                                        </td>
                                                        <td style="margin-top: 27px;width: 6%;text-align: center;vertical-align: middle;padding: 0px!important;"><span>VS</span></td>
                                                        <td style="width: 6%;text-align: center;vertical-align: middle;padding: 0px!important">
                                                            <div style="display: flex;flex-wrap: wrap;flex-direction: row-reverse;justify-content: center;margin-top: 20px;">
                                                                <input class="form-control" style="width: 50px;text-align: center;" type="text" name="" id="" value="<?php echo $columnData[0]['gol2'] ?>">
                                                            </div>
                                                        </td>
                                                        <td class="alings__team"><img class="img_team" src="../assets/img/team/<?= $columnData[0]['img2'] ?>" alt="Imagen 2" width="60">
                                                            <!-- <h6 class="span__equipos"><?= $columnData[0]['team2'] ?> (V)</h6> -->
                                                        </td>
                                                        <td style="width: 12%;text-align: center;vertical-align: middle;padding: 0px!important">
                                                            <button class="btn btn-primary buttons__rad" data-posteam="<?= $clave ?>" data-loca="" data-visitante="" style="margin-top: 21px;">Save</button>
                                                            <button class="btn btn-danger buttons__rad_team" data-noteam="<?= $clave ?>" data-loca="" data-visitante="" style="margin-top: 10px;">No contar</button>
                                                        </td>
                                                        
                                                    </tr>
                                                <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
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
        <script type="text/javascript">
            $(document).ready(function() {

                $(".buttons__rad_team").click(function() {
                    var $tr = $(this).closest("tr");
                    var equipoLocal = $tr.find(".span__equipos").eq(0).text();
                    var equipoVisitante = $tr.find(".span__equipos").eq(1).text();
                    var input1 = '-';
                    var input2 = '-';
                    var clave = $(this).data("noteam");


                    $.ajax({
                        type: "POST",
                        url: "save_team2.php", // Reemplaza con la URL de tu script PHP
                        data: {
                            clave: clave,
                            gol1: input1,
                            gol2: input2
                        },
                        success: function(response) {
                            // Manejar la respuesta del servidor aquí
                            console.log(response);
                            alert('Se registraron los Goles');
                        },
                        error: function(xhr, status, error) {
                            // Manejar errores de AJAX aquí
                            console.error(xhr.responseText);
                            alert('Se registraron los Goles');

                        }
                    });

                });

                $(".buttons__rad").click(function() {
                    var $tr = $(this).closest("tr");
                    var equipoLocal = $tr.find(".span__equipos").eq(0).text();
                    var equipoVisitante = $tr.find(".span__equipos").eq(1).text();
                    var input1 = $tr.find("input").eq(0).val();
                    var input2 = $tr.find("input").eq(1).val();
                    var clave = $(this).data("posteam");


                    $.ajax({
                        type: "POST",
                        url: "save_team2.php", // Reemplaza con la URL de tu script PHP
                        data: {
                            clave: clave,
                            gol1: input1,
                            gol2: input2
                        },
                        success: function(response) {
                            // Manejar la respuesta del servidor aquí
                            console.log(response);
                            alert('Se registraron los Goles');
                        },
                        error: function(xhr, status, error) {
                            // Manejar errores de AJAX aquí
                            console.error(xhr.responseText);
                            alert('Se registraron los Goles');

                        }
                    });

                });

                $(".quiniela_names").click(function() {
                    // URL de la página que deseas abrir
                    var url = "../user.php"; // Reemplaza con tu URL

                    // Abre la página en una nueva ventana o pestaña del navegador
                    window.open(url);
                });

                $('.quiniela_names_pay').click(function() {
                    var urlx = '../user_pay2.php';
                    window.open(urlx);
                });
            });
        </script>
        <script src="edit.js"></script>
        <script src="js/ajax__actions.js"></script>

</body>

</html>

<!-- beautify ignore:end -->