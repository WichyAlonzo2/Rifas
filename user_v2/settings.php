<?php
include $urlPartner . '/app/conn.php';
include $urlPartner . '/app/varGlobal.php';
include $urlPartner . '/tarjetas.php';
include $urlPartner . '/sys.php';
include $urlPartner . '/root.php';
include $urlPartner . '/settings_sort.php';

session_start();
$usuarioingresado = $_SESSION['user'];
$pass = $_SESSION['pass'];
$rol = $_SESSION['rol'];

if (isset($_SESSION['user'])) {

    if ($rol == 1 || $rol == 2 || $rol == 3) {
        // No Code

    } elseif ($rol == 4) {
        echo '  <script type="text/javascript">
                    window.location.href = "param"; // Reemplaza con la URL a la que deseas redirigir
                </script>';
    }
} else {
    header('location: /user_v2/');
}


// PROMOS
// 1
$dataPromos = array();
$archivoJsonPromos = '../app/promotions.json';
if (file_exists($archivoJsonPromos) && ($contenidoJsonPromos = file_get_contents($archivoJsonPromos)) !== false) {
    $dataPromos = json_decode($contenidoJsonPromos, true);
}

// 2
$dataPromos_two = array();
$archivoJsonPromos_two = '../app/promotions2.json';
if (file_exists($archivoJsonPromos_two) && ($contenidoJsonPromos_two = file_get_contents($archivoJsonPromos_two)) !== false) {
    $dataPromos_two = json_decode($contenidoJsonPromos_two, true);
}

// 3
$dataPromos_tree = array();
$archivoJsonPromos_tree = '../app/promotions3.json';
if (file_exists($archivoJsonPromos_tree) && ($contenidoJsonPromos_tree = file_get_contents($archivoJsonPromos_tree)) !== false) {
    $dataPromos_tree = json_decode($contenidoJsonPromos_tree, true);
}

// REFERIDOS
// 1
$dataRef = array();
$archivoJsonRef = '../app/ref.json';
if (file_exists($archivoJsonRef) && ($contenidoJsonRef = file_get_contents($archivoJsonRef)) !== false) {
    $dataRef = json_decode($contenidoJsonRef, true);
}

// 2
$dataRef_two = array();
$archivoJsonRef_two = '../app/ref_two.json';
if (file_exists($archivoJsonRef_two) && ($contenidoJsonRef_two = file_get_contents($archivoJsonRef_two)) !== false) {
    $dataRef_two = json_decode($contenidoJsonRef_two, true);
}

// 3
$dataRef_tree = array();
$archivoJsonRef_tree = '../app/ref_tree.json';
if (file_exists($archivoJsonRef_tree) && ($contenidoJsoRefs_tree = file_get_contents($archivoJsonRef_tree)) !== false) {
    $dataRef_tree = json_decode($contenidoJsoRefs_tree, true);
}




// Subir imagen
$uploadPath = $urlPartner . '/assets/img/';
$status = $statusMsg = '';

if (isset($_POST["sub__img"])) {
    $status = 'error';



    $favicon = $_POST["favicon"];
    $Logo = $_POST["Logo"];
    $Creativo1 = $_POST["Creativo1"];
    $Creativo2 = $_POST["Creativo2"];
    $Portada1 = $_POST["Portada1"];
    $Portada2 = $_POST["Portada2"];

    $data = array(
        "favicon" => $favicon,
        "Logo" => $Logo,
        "portadaprincipal" => $Creativo1,
        "Sorteo1" => $Portada1,
        "Sorteo2" => $Creativo2,
        "Sorteo3" => $Portada2
    );


    // $data = array(
    //     "favicon" => $favicon,
    //     "Logo" => $Logo,
    //     "portadaprincipal" => $Creativo1,
    //     "Sorteo1" => $Creativo2,
    //     "Sorteo2" => $Portada1,
    //     "Sorteo3" => $Portada2
    // );

    $json_data = json_encode($data, JSON_PRETTY_PRINT);
    $file_path = $urlPartner . '/app/sys.json';
    if (file_put_contents($file_path, $json_data)) {
    } else {
        echo "Error al guardar los datos en $file_path.";
    }
}

// Mensajes
if (isset($_POST['mns'])) {
    foreach ($_POST['idalu'] as $ids) {
        $editID = mysqli_real_escape_string($db, $_POST['idalu2'][$ids]);
        $editNom = mysqli_real_escape_string($db, $_POST['paWa'][$ids]);
        $editXD = mysqli_real_escape_string($db, $_POST['free'][$ids]);
        $actualizar = $db->query("UPDATE global SET globalSer='$editNom', descripLibre='$editXD' WHERE id='$ids'");
    }

    if ($actualizar == true) {
        header('Location: settings');
    } else {
        echo "No se subio la informacion correctamente, comunicate con Wichy";
    }
}

// Sociales
if (isset($_POST['social'])) {
    foreach ($_POST['idalu'] as $ids) {
        $editID = mysqli_real_escape_string($db, $_POST['idalu2'][$ids]);
        $editXD = mysqli_real_escape_string($db, $_POST['nom'][$ids]);
        $actualizar = $db->query("UPDATE global SET globalSer='$editXD', descripLibre='$editXD' WHERE id='$ids'");
    }

    if ($actualizar == true) {
        header('Location: settings');
    } else {
        echo "No se subio la informacion correctamente, comunicate con Wichy";
    }
}

?>
<!DOCTYPE html>
<html lang="en" class="dark-style layout-navbar-fixed layout-menu-fixed layout-compact " dir="ltr" data-theme="theme-default" data-assets-path="assets/" data-template="vertical-menu-template-dark">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0">

    <title>Ajustes - <?php echo $importanteNombreCorto ?></title>


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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Trumbowyg/2.27.3/ui/trumbowyg.min.css" integrity="sha512-Fm8kRNVGCBZn0sPmwJbVXlqfJmPC13zRsMElZenX6v721g/H7OukJd8XzDEBRQ2FSATK8xNF9UYvzsCtUpfeJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="assets/vendor/libs/node-waves/node-waves.css">
    <link rel="stylesheet" href="assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css">
    <link rel="stylesheet" href="assets/vendor/libs/typeahead-js/typeahead.css">
    <link rel="stylesheet" href="assets/vendor/libs/apex-charts/apex-charts.css">
    <style>
        .img__Server {
            margin-bottom: 12px !important;
            padding: 2px;
            border-radius: 15px;
            object-fit: cover;
            width: 150px;
            height: 150px;
        }
    </style>

    <!-- Page CSS -->


    <!-- Helpers -->
    <script src="assets/vendor/js/helpers.js"></script>
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="assets/js/config.js"></script>
    <script>
        function handleImageClick(imageUrl) {
            document.getElementById("imgValueInput").value = imageUrl;
            document.getElementById("imgValue").src = imageUrl;
            $('#imageModal4').modal('hide');
        }
    </script>
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
                            <div data-i18n="Dashboard">Dashboard</div>
                        </a>
                        <ul class="menu-sub">
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
                            <li class="menu-item active">
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
            <!-- / Menu -->



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

                    <!-- 1era parte -->
                    <div class="container-xxl flex-grow-1 container-p-y">

                        <div class="row">

                            <!-- Informacion Pagin -->
                            <div class="col-xl-6">
                                <h6 class="text-muted">Informacion de la pagina</h6>
                                <div class="nav-align-top nav-tabs-shadow mb-4">
                                    <ul class="nav nav-tabs nav-fill" role="tablist">
                                        <li class="nav-item" role="presentation">
                                            <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab" data-bs-target="#navs-justified-home" aria-controls="navs-justified-home" aria-selected="true"><i class="tf-icons ti ti-home ti-xs me-1"></i>Nombre de la Pagina</button>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-justified-links" aria-controls="navs-justified-links" aria-selected="false" tabindex="-1"><i class="ti ti-link ti-xs me-1"></i> Links</button>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-justified-faq" aria-controls="navs-justified-faq" aria-selected="false" tabindex="-1"><i class="ti ti-help-hexagon ti-xs me-1"></i> FaQ</button>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-justified-j1" aria-controls="navs-justified-<?php echo $infoSorteoNombre; ?>" aria-selected="false" tabindex="-1"><i class="ti ti-info-circle-filled ti-xs me-1"></i> Acerca de <?php echo $infoSorteoNombre ?></button>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-justified-j2" aria-controls="navs-justified-<?php echo $infoSorteoNombre; ?>" aria-selected="false" tabindex="-1"><i class="ti ti-info-circle-filled ti-xs me-1"></i> Acerca de <?php echo $infoSorteoNombre2 ?></button>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-justified-j3" aria-controls="navs-justified-<?php echo $infoSorteoNombre; ?>" aria-selected="false" tabindex="-1"><i class="ti ti-info-circle-filled ti-xs me-1"></i> Acerca de <?php echo $infoSorteoNombre3 ?></button>
                                        </li>
                                    </ul>

                                    <form class="browser-default-validation" method="post" action="actions__v2/guardar_json.php">
                                        <!-- Nombre de la pagina -->
                                        <div class="tab-content">
                                            <!-- Inicio -->
                                            <div class="tab-pane fade show active" id="navs-justified-home" role="tabpanel">
                                                <div class="card-body">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="basic-default-name">Nombre corto (Ej. Rfs Alonzo)</label>
                                                        <input name="nombreSorteoCorto" type="text" class="form-control" id="basic-default-name" placeholder="Escribe..." required="" value="<?php echo $importanteNombreCorto ?>">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label" for="basic-default-name">Nombre completo (Ej. Rifas Alonzo)</label>
                                                        <input name="nombreSorteos" type="text" class="form-control" id="basic-default-name" placeholder="Escribe..." required="" value="<?php echo $importanteNombreSorteo ?>">
                                                    </div>
                                                    <div class="mb-3 d-none">
                                                        <label class="form-label" for="basic-default-name">Ubicación</label>
                                                        <input name="ubicacion" type="text" class="form-control" id="basic-default-name" placeholder="Escribe..." required="" value="<?php echo $importanteUbicacion ?>">
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Link -->
                                            <div class="tab-pane fade" id="navs-justified-links" role="tabpanel">
                                                <div class="card-body">
                                                    <label class="form-label" for="basic-default-name">Te sugerimos que si quieres cambiar el nombre de la Pagina de tu Verificador o Pagina de Pagos te comuniques con Wichy para Realizar el Cambio. <br><br></label>
                                                    <div class="mb-3">
                                                        <label class="form-label" for="basic-default-name">Pagina principal (1 Sorteo / Rifa)</label>
                                                        <input name="psorteo" type="text" class="form-control" id="basic-default-name" placeholder="Escribe..." required="" value="<?php echo $linkPSorteo ?>">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label" for="basic-default-name">Pagina secundaria (2 Sorteo / Rifa)</label>
                                                        <input name="psorteo2" type="text" class="form-control" id="basic-default-name" placeholder="Escribe..." required="" value="<?php echo $linkPSorteo2 ?>">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label" for="basic-default-name">Pagina secundaria (3 Sorteo / Rifa)</label>
                                                        <input name="psorteo3" type="text" class="form-control" id="basic-default-name" placeholder="Escribe..." required="" value="<?php echo $linkPSorteo3 ?>">
                                                    </div>
                                                    <div class="mb-3 d-none">
                                                        <label class="form-label" for="basic-default-name">Página pago</label>
                                                        <input name="ppago" type="text" class="form-control" id="basic-default-name" placeholder="Escribe..." required="" value="<?php echo $linkPPago ?>">
                                                    </div>
                                                    <div class="mb-3 d-none">
                                                        <label class="form-label" for="basic-default-name">Página Verificador</label>
                                                        <input name="pcheck" type="text" class="form-control" id="basic-default-name" placeholder="Escribe..." required="" value="<?php echo $linkPCheck ?>">
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- FAQ -->
                                            <div class="tab-pane fade" id="navs-justified-faq" role="tabpanel">
                                                <div class="card-body">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="basic-default-name">Pregunta 1 - <b><?php echo $faqJ1 ?></b></label>
                                                        <input name="faq1" type="text" class="form-control" id="basic-default-name" placeholder="Escribe..." required="" value="<?php echo $faqJ1 ?>">
                                                        <textarea name="respuesta1" class="simple-editor form-control mt-3" id="" cols="30" rows="2" placeholder="Escribe tu respuesta"><?php echo $respuestaJ1 ?></textarea>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label" for="basic-default-name">Pregunta 2 - <b><?php echo $faqJ2 ?></b></label>
                                                        <input name="faq2" type="text" class="form-control" id="basic-default-name" placeholder="Escribe..." required="" value="<?php echo $faqJ2 ?>">
                                                        <textarea name="respuesta2" class="simple-editor form-control mt-3" id="" cols="30" rows="2" placeholder="Escribe tu respuesta"><?php echo $respuestaJ2 ?></textarea>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label" for="basic-default-name">Pregunta 3 - <b><?php echo $faqJ3 ?></b></label>
                                                        <input name="faq3" type="text" class="form-control" id="basic-default-name" placeholder="Escribe..." required="" value="<?php echo $faqJ3 ?>">
                                                        <textarea name="respuesta3" class="simple-editor form-control mt-3" id="" cols="30" rows="2" placeholder="Escribe tu respuesta"><?php echo $respuestaJ3 ?></textarea>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label" for="basic-default-name">Pregunta 4 - <b><?php echo $faqJ4 ?></b></label>
                                                        <input name="faq4" type="text" class="form-control" id="basic-default-name" placeholder="Escribe..." required="" value="<?php echo $faqJ4 ?>">
                                                        <textarea name="respuesta4" class="simple-editor form-control mt-3" id="" cols="30" rows="2" placeholder="Escribe tu respuesta"><?php echo $respuestaJ4 ?></textarea>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label" for="basic-default-name">Pregunta 5 - <b><?php echo $faqJ5 ?></b></label>
                                                        <input name="faq5" type="text" class="form-control" id="basic-default-name" placeholder="Escribe..." required="" value="<?php echo $faqJ5 ?>">
                                                        <textarea name="respuesta5" class="simple-editor form-control mt-3" id="" cols="30" rows="2" placeholder="Escribe tu respuesta"><?php echo $respuestaJ5 ?></textarea>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Jornada <?php echo $infoSorteoNombre; ?> -->
                                            <div class="tab-pane fade" id="navs-justified-j1" role="tabpanel">
                                                <div class="card-body">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="basic-default-name">Nombre de la Rifa / Sorteo</label>
                                                        <input name="nombreSorteoActual" type="text" class="form-control" id="basic-default-name" placeholder="Escribe..." required="" value="<?php echo $infoSorteoNombre ?>">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label" for="basic-default-name">Fecha</label>
                                                        <textarea name="tipoQuiniela" class="simple-editor form-control mt-3" id="" cols="30" rows="2" placeholder="Escribe..."><?php echo $infoSorteTipo ?></textarea>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label" for="basic-default-name">Fecha Inicio Rifa / Sorteo</label>
                                                        <input name="fechaSorteoOpen" type="text" class="form-control" id="basic-default-name" placeholder="Escribe..." required="" value="<?php echo $infoSorteoFechaOpen ?>">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label" for="basic-default-name">Fecha Fina Rifa / Sorteo</label>
                                                        <input name="fechaSorteoCierre" type="text" class="form-control" id="basic-default-name" placeholder="Escribe..." required="" value="<?php echo $infoSorteoFechaClose ?>">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label" for="basic-default-name">PREMIOS + PROMOS</label>
                                                        <textarea name="premioBonosSorteoActual" class="simple-editor form-control mt-3" id="" cols="30" rows="2" placeholder="Escribe..."><?php echo $infoSorteoPremios ?></textarea>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label" for="basic-default-name">Detalles Boletos</label>
                                                        <textarea name="detallesBoletoSorteoActual" class="simple-editor form-control mt-3" id="" cols="30" rows="2" placeholder="Escribe..."><?php echo $infoSorteoDetallesBoletosSorteo ?></textarea>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label" for="basic-default-name">Precio</label>
                                                        <input name="precioSorteoActual" type="number" class="form-control" id="basic-default-name" placeholder="Escribe..." required="" value="<?php echo $infoSorteoPrecio ?>">
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Jornada <?php echo $infoSorteoNombre2; ?> -->
                                            <div class="tab-pane fade" id="navs-justified-j2" role="tabpanel">
                                                <div class="card-body">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="basic-default-name">Nombre de la Rifa / Sorteo</label>
                                                        <input name="nombreSorteoActual2" type="text" class="form-control" id="basic-default-name" placeholder="Escribe..." required="" value="<?php echo $infoSorteoNombre2 ?>">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label" for="basic-default-name">Fecha</label>
                                                        <textarea name="tipoQuiniela2" class="simple-editor form-control mt-3" id="" cols="30" rows="2" placeholder="Escribe..."><?php echo $infoSorteoTipo2 ?></textarea>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label" for="basic-default-name">Fecha Inicio Rifa / Sorteo</label>
                                                        <input name="fechaSorteoOpen2" type="text" class="form-control" id="basic-default-name" placeholder="Escribe..." required="" value="<?php echo $infoSorteoFechaOpen2 ?>">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label" for="basic-default-name">Fecha Fina Rifa / Sorteo</label>
                                                        <input name="fechaSorteoCierre2" type="text" class="form-control" id="basic-default-name" placeholder="Escribe..." required="" value="<?php echo $infoSorteoFechaClose2 ?>">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label" for="basic-default-name">PREMIOS + PROMOS</label>
                                                        <textarea name="premioBonosSorteoActual2" class="simple-editor form-control mt-3" id="" cols="30" rows="2" placeholder="Escribe..."><?php echo $infoSorteoPremios2 ?></textarea>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label" for="basic-default-name">Detalles Boletos</label>
                                                        <textarea name="detallesBoletoSorteoActual2" class="simple-editor form-control mt-3" id="" cols="30" rows="2" placeholder="Escribe..."><?php echo $infoSorteoDetallesBoletosSorteo2 ?></textarea>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label" for="basic-default-name">Precio</label>
                                                        <input name="precioSorteoActual2" type="number" class="form-control" id="basic-default-name" placeholder="Escribe..." required="" value="<?php echo $infoSorteoPrecio2 ?>">
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Jornada <?php echo $infoSorteoNombre3; ?> -->
                                            <div class="tab-pane fade" id="navs-justified-j3" role="tabpanel">
                                                <div class="card-body">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="basic-default-name">Nombre de la Rifa / Sorteo</label>
                                                        <input name="nombreSorteoActual3" type="text" class="form-control" id="basic-default-name" placeholder="Escribe..." required="" value="<?php echo $infoSorteoNombre3 ?>">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label" for="basic-default-name">Fecha</label>
                                                        <textarea name="tipoQuiniela3" class="simple-editor form-control mt-3" id="" cols="30" rows="2" placeholder="Escribe..."><?php echo $infoSorteoTipo3 ?></textarea>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label" for="basic-default-name">Fecha Inicio Rifa / Sorteo</label>
                                                        <input name="fechaSorteoOpen3" type="text" class="form-control" id="basic-default-name" placeholder="Escribe..." required="" value="<?php echo $infoSorteoFechaOpen3 ?>">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label" for="basic-default-name">Fecha Fina Rifa / Sorteo</label>
                                                        <input name="fechaSorteoCierre3" type="text" class="form-control" id="basic-default-name" placeholder="Escribe..." required="" value="<?php echo $infoSorteoFechaClose3 ?>">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label" for="basic-default-name">PREMIOS + PROMOS</label>
                                                        <textarea name="premioBonosSorteoActual3" class="simple-editor form-control mt-3" id="" cols="30" rows="2" placeholder="Escribe..."><?php echo $infoSorteoPremios3 ?></textarea>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label" for="basic-default-name">Detalles Boletos</label>
                                                        <textarea name="detallesBoletoSorteoActual3" class="simple-editor form-control mt-3" id="" cols="30" rows="2" placeholder="Escribe..."><?php echo $infoSorteoDetallesBoletosSorteo3 ?></textarea>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label" for="basic-default-name">Precio</label>
                                                        <input name="precioSorteoActual3" type="text" class="form-control" id="basic-default-name" placeholder="Escribe..." required="" value="<?php echo $infoSorteoPrecio3 ?>">
                                                    </div>
                                                </div>
                                            </div>
                                            <button type="submit" class="btn btn-primary waves-effect waves-light">Guardar cambios</button>
                                        </div>
                                    </form>
                                </div>
                            </div>

                            <!-- Personaliacion de la Pagina sorteo -->
                            <div class="col-xl-6">
                                <h6 class="text-muted">Personalizacion de la pagina Sorteos (Funcionando 🟢)</h6>
                                <div class="nav-align-top nav-tabs-shadow mb-4">
                                    <ul class="nav nav-tabs nav-fill" role="tablist">
                                        <li class="nav-item" role="presentation">
                                            <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab" data-bs-target="#navs-justified-home" aria-controls="navs-justified-home" aria-selected="true"><i class="tf-icons ti ti-home ti-xs me-1"></i>Personalizacion</button>
                                        </li>
                                    </ul>

                                    <form class="browser-default-validation" method="post" action="actions__v2/guardar_json_settings.php">
                                        <!-- Nombre de la pagina -->

                                        <div class="tab-content">
                                            <div class="tab-pane fade show active" id="navs-justified-home" role="tabpanel">
                                                <div class="card-body">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="basic-default-name">Barra de proceso</label>
                                                        <select class="form-control" name="barra" id="">
                                                            <?php
                                                            $valorInput;
                                                            if ($progressbar_colors === true) {
                                                                $valorInput = 'Si';
                                                            } else {
                                                                $valorInput = 'No';
                                                            }

                                                            echo '<option class="form-control" value="' . $valorInput . '">' . $valorInput . '</option>';

                                                            ?>
                                                            <option class="form-control" value="Si">Si</option>
                                                            <option class="form-control" value="No">No</option>
                                                        </select>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label" for="basic-default-name">Porcentaje de Boletos</label>
                                                        <select class="form-control" name="porcentaje" id="">
                                                            <?php
                                                            $valorInput;
                                                            if ($numberprocess === true) {
                                                                $valorInput = 'Si';
                                                            } else {
                                                                $valorInput = 'No';
                                                            }

                                                            echo '<option class="form-control" value="' . $valorInput . '">' . $valorInput . '</option>';

                                                            ?>
                                                            <option class="form-control" value="Si">Si</option>
                                                            <option class="form-control" value="No">No</option>
                                                        </select>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label" for="basic-default-name">XXX Boletos Disponibles de XXX</label>
                                                        <select class="form-control" name="textBoletos" id="">
                                                            <?php
                                                            $valorInput;
                                                            if ($textboletos === true) {
                                                                $valorInput = 'Si';
                                                            } else {
                                                                $valorInput = 'No';
                                                            }

                                                            echo '<option class="form-control" value="' . $valorInput . '">' . $valorInput . '</option>';

                                                            ?>
                                                            <option class="form-control" value="Si">Si</option>
                                                            <option class="form-control" value="No">No</option>
                                                        </select>
                                                        <!-- <input name="textBoletos" type="text" class="form-control" id="basic-default-name" placeholder="Escribe..." required="" value="<?php echo $numberprocess; ?>"> -->
                                                    </div>
                                                </div>
                                            </div>
                                            <button type="submit" class="btn btn-primary waves-effect waves-light">Guardar cambios</button>
                                        </div>
                                    </form>
                                </div>
                            </div>

                            <!-- Team / Promos -->
                            <div class="col-xl-6">
                                <h6 class="text-muted">Promos</h6>
                                <div class="nav-align-top nav-tabs-shadow mb-4">
                                    <ul class="nav nav-tabs nav-fill" role="tablist">
                                        <li class="nav-item" role="presentation">
                                            <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab" data-bs-target="#navs-justified-promo1" aria-controls="navs-justified-promo1" aria-selected="true"><i class="ti ti-discount-2 ti-xs me-1"></i> PROMOS 1</button>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-justified-promo2" aria-controls="navs-justified-<?php echo $infoSorteoNombre; ?>" aria-selected="false" tabindex="-1"><i class="ti ti-discount-2 ti-xs me-1"></i> PROMOS 2</button>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-justified-promo3" aria-controls="navs-justified-<?php echo $infoSorteoNombre; ?>" aria-selected="false" tabindex="-1"><i class="ti ti-discount-2 ti-xs me-1"></i> PROMOS 3</button>
                                        </li>
                                    </ul>

                                    <div class="tab-content">

                                        <!-- Promo 1 -->
                                        <div class="tab-pane fade show active" id="navs-justified-promo1" role="tabpanel">
                                            <div class="card-body">
                                                <div class="card-body demo-vertical-spacing demo-only-element">
                                                    <small class="text-light fw-medium d-block">Agrega tus PROMOS 1</small>
                                                    <div class="input-group">
                                                        <form class="mb-3" method="post" action="promotions.php">
                                                            <table class="table" id="promoTable">
                                                                <tr>
                                                                    <th scope="col">Quiniela</th>
                                                                    <th scope="col">Precio</th>
                                                                    <th></th>
                                                                </tr>
                                                                <?php
                                                                $contador = 0;
                                                                foreach ($dataPromos as $numero => $valor) { ?>
                                                                    <tr data-id="<?php echo $contador; ?>">
                                                                        <td scope="col"><input class='form-control buttons__rad' type="number" name="numero[]" placeholder="Número" min="1" step="1" value="<?php echo $numero; ?>"></td>
                                                                        <td scope="col"><input class='form-control buttons__rad' type="number" name="valor[]" placeholder="Valor" min="1" step="1" value="<?php echo $valor; ?>"></td>
                                                                        <td scope="col"><button class='btn btn-danger removeRowButton buttons__rad' type="button">Eliminar</button></td>
                                                                    </tr>
                                                                <?php } ?>
                                                            </table>
                                                            <button class="btn btn-success" type="button" id="addRowButton">Agregar +</button>
                                                            <button class="btn btn-primary" type="submit">Guardar Promos</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Promo 2 -->
                                        <div class="tab-pane fade" id="navs-justified-promo2" role="tabpanel">
                                            <div class="card-body">
                                                <div class="card-body demo-vertical-spacing demo-only-element">
                                                    <small class="text-light fw-medium d-block">Agrega tus PROMOS 2</small>
                                                    <div class="input-group">
                                                        <form class="mb-3" method="post" action="promotions_two.php">
                                                            <table class="table" id="promoTable2">
                                                                <tr>
                                                                    <th scope="col">Quiniela</th>
                                                                    <th scope="col">Precio</th>
                                                                    <th></th>
                                                                </tr>
                                                                <?php
                                                                $contador = 0;
                                                                foreach ($dataPromos_two as $numero => $valor) { ?>
                                                                    <tr data-id="<?php echo $contador; ?>">
                                                                        <td scope="col"><input class='form-control buttons__rad' type="number" name="numero_two[]" placeholder="Número" min="1" step="1" value="<?php echo $numero; ?>"></td>
                                                                        <td scope="col"><input class='form-control buttons__rad' type="number" name="valor_two[]" placeholder="Valor" min="1" step="1" value="<?php echo $valor; ?>"></td>
                                                                        <td scope="col"><button class='btn btn-danger removeRowButton2 buttons__rad' type="button">Eliminar</button></td>
                                                                    </tr>
                                                                <?php } ?>
                                                            </table>
                                                            <button class="btn btn-success buttons__rad" type="button" id="addRowButton2">Agregar +</button>
                                                            <button class="btn btn-primary buttons__rad" type="submit">Guardar</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Promo 3 -->
                                        <div class="tab-pane fade" id="navs-justified-promo3" role="tabpanel">
                                            <div class="card-body">
                                                <div class="card-body demo-vertical-spacing demo-only-element">
                                                    <small class="text-light fw-medium d-block">Agrega tus PROMOS 3</small>
                                                    <div class="input-group">
                                                        <form class="mb-3" method="post" action="promotions_tree.php">
                                                            <table class="table" id="promoTable3">
                                                                <tr>
                                                                    <th scope="col">Quiniela</th>
                                                                    <th scope="col">Precio</th>
                                                                    <th></th>
                                                                </tr>
                                                                <?php
                                                                $contador = 0;
                                                                foreach ($dataPromos_tree as $numero => $valor) { ?>
                                                                    <tr data-id="<?php echo $contador; ?>">
                                                                        <td scope="col"><input class='form-control buttons__rad' type="text" name="numero_tree[]" placeholder="Número" min="1" step="1" value="<?php echo $numero; ?>"></td>
                                                                        <td scope="col"><input class='form-control buttons__rad' type="text" name="valor_tree[]" placeholder="Valor" min="1" step="1" value="<?php echo $valor; ?>"></td>
                                                                        <td scope="col"><button class='btn btn-danger removeRowButton3 buttons__rad' type="button">Eliminar</button></td>
                                                                    </tr>
                                                                <?php } ?>
                                                            </table>
                                                            <button class="btn btn-success buttons__rad" type="button" id="addRowButton3">Agregar +</button>
                                                            <button class="btn btn-primary buttons__rad" type="submit">Guardar</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>






                            <!-- Referidos -->
                            <div class="col-xl-6">
                                <h6 class="text-muted">Programa de Referidos</h6>
                                <div class="nav-align-top nav-tabs-shadow mb-4">
                                    <ul class="nav nav-tabs nav-fill" role="tablist">
                                        <li class="nav-item" role="presentation">
                                            <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab" data-bs-target="#navs-justified-refe1" aria-controls="navs-justified-promo1" aria-selected="true"><i class="ti ti-brand-asana ti-xs me-1"></i> Referidos 1</button>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-justified-refe2" aria-controls="navs-justified-<?php echo $infoSorteoNombre; ?>" aria-selected="false" tabindex="-1"><i class="ti ti-brand-asana ti-xs me-1"></i> Referidos 2</button>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-justified-refe3" aria-controls="navs-justified-<?php echo $infoSorteoNombre; ?>" aria-selected="false" tabindex="-1"><i class="ti ti-brand-asana ti-xs me-1"></i> Referidos 3</button>
                                        </li>
                                    </ul>

                                    <div class="tab-content">

                                    <!-- $urlSorteo = $linkPSorteo;
                                    $urlSorteo2 = $linkPSorteo2;
                                    $urlSorteo3 = $linkPSorteo3; -->
                                        <!-- Referido 1 -->
                                        <div class="tab-pane fade show active" id="navs-justified-refe1" role="tabpanel">
                                            <div class="card-body">
                                                <div class="card-body demo-vertical-spacing demo-only-element">
                                                    <small class="text-light fw-medium d-block">Agrega Referidos 1</small>
                                                    <div class="input-group">
                                                        <form class="mb-3" method="post" action="referidos.php">
                                                            <div style="max-height: 300px; overflow-y: auto;">
                                                                <table class="table" id="refTable">
                                                                    <tr>
                                                                        <th scope="col">Referido</th>
                                                                        <th scope="col">Link</th>
                                                                        <th scope="col">Acciones</th>
                                                                    </tr>
                                                                    <?php
                                                                    $contador = 0;
                                                                    foreach ($dataRef['referidos']['users'] as $nombre => $numero) {
                                                                    ?>
                                                                        <tr data-id="<?php echo $contador; ?>">
                                                                            <td scope="col">
                                                                                <input class='form-control buttons__rad' type="text" name="referidor[]" placeholder="Escribe un nuevo Referido" pattern="[A-Za-z]+" title="Solo se permiten letras" value="<?php echo $nombre; ?>" readonly>
                                                                                <input class='form-control buttons__rad d-none' type="text" name="numero[]" placeholder="Escribe un nuevo Referido" title="Solo se permiten letras" value="<?php echo $numero; ?>">
                                                                            </td>
                                                                            <td scope="col"><?php echo $nombre; ?> <a class="referidoLink" data-titlesort="<?php echo $infoSorteoNombre; ?>" href="<?php echo $urlPartner .  $linkPSorteo . '?r=' .  $nombre ?>"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-link-45deg" viewBox="0 0 16 16">
                                                                    <path d="M4.715 6.542 3.343 7.914a3 3 0 1 0 4.243 4.243l1.828-1.829A3 3 0 0 0 8.586 5.5L8 6.086a1.002 1.002 0 0 0-.154.199 2 2 0 0 1 .861 3.337L6.88 11.45a2 2 0 1 1-2.83-2.83l.793-.792a4.018 4.018 0 0 1-.128-1.287z" />
                                                                    <path d="M6.586 4.672A3 3 0 0 0 7.414 9.5l.775-.776a2 2 0 0 1-.896-3.346L9.12 3.55a2 2 0 1 1 2.83 2.83l-.793.792c.112.42.155.855.128 1.287l1.372-1.372a3 3 0 1 0-4.243-4.243z" />
                                                                </svg> Link</a>
                                                                            </td>
                                                                            <td scope="col">
                                                                                <button class='btn btn-danger removeRowButton4 buttons__rad' type="button">Eliminar</button>
                                                                            </td>
                                                                        </tr>
                                                                    <?php
                                                                        $contador++;
                                                                    }
                                                                    ?>
                                                                </table>
                                                            </div>
                                                            <button class="btn btn-success" type="button" id="addRowButton1">Agregar +</button>
                                                            <button class="btn btn-primary" type="submit">Guardar Referidos</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Referido 2 -->
                                        <div class="tab-pane fade" id="navs-justified-refe2" role="tabpanel">
                                            <div class="card-body">
                                                <div class="card-body demo-vertical-spacing demo-only-element">
                                                    <small class="text-light fw-medium d-block">Agrega Referidos 2</small>
                                                    <div class="input-group">
                                                        <form class="mb-3" method="post" action="referidos.php">
                                                            <div style="max-height: 300px; overflow-y: auto;">
                                                                <table class="table" id="refTable2">
                                                                    <tr>
                                                                        <th scope="col">Referido</th>
                                                                        <th scope="col">Link</th>
                                                                        <th scope="col">Acciones</th>
                                                                    </tr>
                                                                    <?php
                                                                    $contador = 0;
                                                                    foreach ($dataRef_two['referidos']['users'] as $nombre => $numero) { ?>
                                                                        <tr data-id="<?php echo $contador; ?>">
                                                                            <td scope="col">
                                                                                <input class='form-control buttons__rad' type="text" name="referidor_two[]" placeholder="Escribe un nuevo Referido" pattern="[A-Za-z]+" title="Solo se permiten letras" value="<?php echo $nombre; ?>" readonly>
                                                                                <input class='form-control buttons__rad d-none' type="text" name="numero_two[]" placeholder="Escribe un nuevo Referido" title="Solo se permiten letras" value="<?php echo $numero; ?>">
                                                                            </td>
                                                                            <td scope="col"><?php echo $nombre; ?> <a class="referidoLink" data-titlesort="<?php echo $infoSorteoNombre2; ?>" href="<?php echo $urlPartner .  $linkPSorteo . '?r=' .  $nombre ?>"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-link-45deg" viewBox="0 0 16 16">
                                                                    <path d="M4.715 6.542 3.343 7.914a3 3 0 1 0 4.243 4.243l1.828-1.829A3 3 0 0 0 8.586 5.5L8 6.086a1.002 1.002 0 0 0-.154.199 2 2 0 0 1 .861 3.337L6.88 11.45a2 2 0 1 1-2.83-2.83l.793-.792a4.018 4.018 0 0 1-.128-1.287z" />
                                                                    <path d="M6.586 4.672A3 3 0 0 0 7.414 9.5l.775-.776a2 2 0 0 1-.896-3.346L9.12 3.55a2 2 0 1 1 2.83 2.83l-.793.792c.112.42.155.855.128 1.287l1.372-1.372a3 3 0 1 0-4.243-4.243z" />
                                                                </svg> Link</a>
                                                                            </td>
                                                                            <td scope="col">
                                                                                <button class='btn btn-danger removeRowButton5 buttons__rad' type="button">Eliminar</button>
                                                                            </td>
                                                                        </tr>
                                                                    <?php
                                                                        $contador++;
                                                                    }
                                                                    ?>
                                                                </table>
                                                            </div>
                                                            <button class="btn btn-success buttons__rad" type="button" id="addRowButton21">Agregar +</button>
                                                            <button class="btn btn-primary buttons__rad" type="submit">Guardar</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Referido 3 -->
                                        <div class="tab-pane fade" id="navs-justified-refe3" role="tabpanel">
                                            <div class="card-body">
                                                <div class="card-body demo-vertical-spacing demo-only-element">
                                                    <small class="text-light fw-medium d-block">Agrega Referidos 3</small>
                                                    <div class="input-group">
                                                        <form class="mb-3" method="post" action="referidos.php">
                                                            <div style="max-height: 300px; overflow-y: auto;">
                                                                <table class="table" id="refTable3">
                                                                    <tr>
                                                                        <th scope="col">Referido</th>
                                                                        <th scope="col">Link</th>
                                                                        <th scope="col">Acciones</th>
                                                                    </tr>
                                                                    <?php
                                                                    $contador = 0;
                                                                    foreach ($dataRef_tree['referidos']['users'] as $nombre => $numero) { ?>
                                                                        <tr data-id="<?php echo $contador; ?>">
                                                                            <td scope="col">
                                                                                <input class='form-control buttons__rad' type="text" name="referidor_tree[]" placeholder="Escribe un nuevo Referido" pattern="[A-Za-z]+" title="Solo se permiten letras" value="<?php echo $nombre; ?>">
                                                                                <input class='form-control buttons__rad d-none' type="text" name="numero_tree[]" placeholder="Escribe un nuevo Referido" title="Solo se permiten letras" value="<?php echo $numero; ?>">
                                                                            </td>
                                                                            <td scope="col"><?php echo $nombre; ?> <a class="referidoLink" data-titlesort="<?php echo $infoSorteoNombre3; ?>" href="<?php echo $urlPartner .  $linkPSorteo . '?r=' .  $nombre ?>"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-link-45deg" viewBox="0 0 16 16">
                                                                    <path d="M4.715 6.542 3.343 7.914a3 3 0 1 0 4.243 4.243l1.828-1.829A3 3 0 0 0 8.586 5.5L8 6.086a1.002 1.002 0 0 0-.154.199 2 2 0 0 1 .861 3.337L6.88 11.45a2 2 0 1 1-2.83-2.83l.793-.792a4.018 4.018 0 0 1-.128-1.287z" />
                                                                    <path d="M6.586 4.672A3 3 0 0 0 7.414 9.5l.775-.776a2 2 0 0 1-.896-3.346L9.12 3.55a2 2 0 1 1 2.83 2.83l-.793.792c.112.42.155.855.128 1.287l1.372-1.372a3 3 0 1 0-4.243-4.243z" />
                                                                </svg> Link</a>
                                                                            </td>
                                                                            <td scope="col">
                                                                                <button class='btn btn-danger removeRowButton6 buttons__rad' type="button">Eliminar</button>
                                                                            </td>
                                                                        </tr>
                                                                    <?php
                                                                        $contador++;
                                                                    }
                                                                    ?>
                                                                </table>
                                                            </div>
                                                            <button class="btn btn-success buttons__rad" type="button" id="addRowButton31">Agregar +</button>
                                                            <button class="btn btn-primary buttons__rad" type="submit">Guardar</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Tarjetas -->
                            <div class="col-xl-6">
                                <h6 class="text-muted">Agrega tarjetas</h6>
                                <div class="nav-align-top nav-tabs-shadow mb-4">
                                    <ul class="nav nav-tabs nav-fill" role="tablist">
                                        <li class="nav-item" role="presentation">
                                            <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab" data-bs-target="#navs-justified-tarje1" aria-controls="navs-justified-promo1" aria-selected="true">Tarjetas de Crédito y Débito</button>
                                        </li>
                                    </ul>

                                    <div class="tab-content">

                                        <!-- Referido 1 -->
                                        <div class="tab-pane fade show active" id="navs-justified-tarje1" role="tabpanel">
                                            <div class="card-body">
                                                <div class="card-body demo-vertical-spacing demo-only-element">
                                                    <div class="input-group">
                                                        <form class="mb-3" method="post" action="referidos.php">
                                                            <div class="row row-cols-1 row-cols-md-3 g-4 mb-5">
                                                                <?php
                                                                $archivoJson = '../app/tarjetas.json';

                                                                if (file_exists($archivoJson)) {
                                                                    $jsonContent = file_get_contents($archivoJson);
                                                                    $jsonData = json_decode($jsonContent, true);
                                                                    if ($jsonData !== null) {
                                                                        $contador = 0;
                                                                        foreach ($jsonData as $tarjeta) {
                                                                            $tarjetaVerificacion = $tarjeta['nombreBanco'];
                                                                            if ($tarjetaVerificacion != null && $tarjetaVerificacion != '') { ?>
                                                                                <div class="col" id="tarjeta-<?php echo $contador; ?>" idParam="<?php echo $contador; ?>">
                                                                                    <div class="card h-100">
                                                                                        <img class="card-img-top imgBanco" src="../assets/img/pay/<?php echo $tarjeta['logoBanco'] ?>" alt="Card image cap" style="background: white;">
                                                                                        <div class="card-body">
                                                                                            <h5 class="card-title m-0"><?php echo $tarjeta['nombreBanco']; ?></h5>
                                                                                            <h5 class="card-title m-0"><?php echo $tarjeta['tipo']; ?></h5>
                                                                                            <input class="d-none nombreBanco" type="text" value="<?php echo $tarjeta['nombreBanco']; ?>">
                                                                                            <input class="d-none tipo" type="text" value="<?php echo $tarjeta['tipo']; ?>">

                                                                                            <?php
                                                                                            foreach ($tarjeta['info'] as $info) {
                                                                                                echo '<p class="card-text"><span class="text-success">Nombre: </span>' . $info['nombrePersona'] . '</p>
                                                                                            <input class="d-none nombrePersona" type="text" value="' . $info['nombrePersona'] . '">';
                                                                                                if (!empty($info['clave'])) {
                                                                                                    echo '<p class="card-text"><span class="text-success">Clabe: </span>' . $info['clave'] . '</p>
                                                                                                <input class="d-none clave" type="text" value="' . $info['clave'] . '">';
                                                                                                }
                                                                                                if (!empty($info['numero'])) {
                                                                                                    echo '<p class="card-text"><span class="text-success">Número: </span>' . $info['numero'] . '</p>
                                                                                                <input class="d-none numero" type="text" value="' . $info['numero'] . '">';
                                                                                                }

                                                                                            ?>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            <?php }
                                                                                        } else { ?>
                                                                            <div class="col" id="tarjeta-<?php echo $contador; ?>" idParam="<?php echo $contador; ?>">
                                                                                <div class="card h-100">
                                                                                    <img class="card-img-top imgBanco" src="../assets/img/system/no_fun.png" alt="Card image cap" style="background: white;">
                                                                                    <div class="card-body">
                                                                                        <h5 class="card-title m-0">Haz clic para editar</h5>
                                                                                    </div>
                                                                                </div>
                                                                            </div>

                                                                        <?php

                                                                                        }
                                                                        ?>



                                                            <?php
                                                                            $contador++;
                                                                        }
                                                                    } else {
                                                                        echo 'Error al decodificar el contenido JSON.';
                                                                    }
                                                                } else {
                                                                    echo 'El archivo no Existe';
                                                                }
                                                            ?>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                    </div>
                                </div>
                            </div>

                            <!-- Informacion Pagin -->
                            <div class="col-xl-6">
                                <h6 class="text-muted">Redes sociales / Contacto</h6>
                                <div class="nav-align-top nav-tabs-shadow mb-4">
                                    <ul class="nav nav-tabs nav-fill" role="tablist">
                                        <li class="nav-item" role="presentation">
                                            <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab" data-bs-target="#navs-justified-social" aria-controls="navs-justified-social" aria-selected="true"><i class="ti ti-social ti-xs me-1"></i> Redes Sociales</button>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-justified-whatsapp" aria-controls="navs-justified-whatsapp" aria-selected="false" tabindex="-1"><i class="ti ti-brand-whatsapp ti-xs me-1"></i> WhatsApp</button>
                                        </li>
                                    </ul>


                                    <form class="browser-default-validation" method="post">
                                        <!-- Nombre de la pagina -->
                                        <div class="tab-content">
                                            <!-- Inicio -->
                                            <div class="tab-pane fade show active" id="navs-justified-social" role="tabpanel">
                                                <div class="card-body">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="basic-default-name">Facebook</label>
                                                        <input class="form-control" type="text" name="idalu[]" value="7" hidden="">
                                                        <input class="form-control" type="text" name="idalu2[7]" value="7" hidden="">
                                                        <input class="form-control buttons__rad" type="text" placeholder="https://facebook.com/user" name="nom[7]" value="<?php echo $facebook ?>">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label" for="basic-default-name">Instagram</label>
                                                        <input class="form-control" type="text" name="idalu[]" value="8" hidden="">
                                                        <input class="form-control" type="text" name="idalu2[8]" value="8" hidden="">
                                                        <input class="form-control buttons__rad" type="text" placeholder="https://www.instagram.com/user" name="nom[8]" value="<?php echo $instagram ?>">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label" for="basic-default-name">Tiktok</label>
                                                        <input class="form-control" type="text" name="idalu[]" value="9" hidden="">
                                                        <input class="form-control" type="text" name="idalu2[9]" value="9" hidden="">
                                                        <input class="form-control buttons__rad" type="text" placeholder="https://www.tiktok.com/user" name="nom[9]" value="<?php echo $tiktok ?>">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label" for="basic-default-name">Grupo de WhatsApp</label>
                                                        <input class="form-control" type="text" name="idalu[]" value="16" hidden="">
                                                        <input class="form-control" type="text" name="idalu2[16]" value="16" hidden="">
                                                        <input class="form-control buttons__rad" type="text" placeholder="https://chat.whatsapp.com/name" name="nom[16]" value="<?php echo $grupoWhatsApp ?>">
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Link -->
                                            <div class="tab-pane fade" id="navs-justified-whatsapp" role="tabpanel">
                                                <div class="card-body">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="basic-default-name">WhatsApp 1</label>
                                                        <input class="form-control" type="text" name="idalu[]" value="11" hidden="">
                                                        <input class="form-control" type="text" name="idalu2[11]" value="11" hidden="">
                                                        <input class="form-control buttons__rad" type="text" placeholder="Ej. 524451540656" name="nom[11]" value="<?php echo $whatsAppUno; ?>">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label" for="basic-default-name">WhatsApp 2</label>
                                                        <input class="form-control" type="text" name="idalu[]" value="12" hidden="">
                                                        <input class="form-control" type="text" name="idalu2[12]" value="12" hidden="">
                                                        <input class="form-control buttons__rad" type="text" placeholder="Ej. 524451540656" name="nom[12]" value="<?php echo $whatsAppDos; ?>">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label" for="basic-default-name">WhatsApp 3</label>
                                                        <input class="form-control" type="text" name="idalu[]" value="13" hidden="">
                                                        <input class="form-control" type="text" name="idalu2[13]" value="13" hidden="">
                                                        <input class="form-control buttons__rad" type="text" placeholder="Ej. 524451540656" name="nom[13]" value="<?php echo $whatsAppTres; ?>">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label" for="basic-default-name">WhatsApp 4</label>
                                                        <input class="form-control" type="text" name="idalu[]" value="14" hidden="">
                                                        <input class="form-control" type="text" name="idalu2[14]" value="14" hidden="">
                                                        <input class="form-control buttons__rad" type="text" placeholder="Ej. 524451540656" name="nom[14]" value="<?php echo $whatsAppCuatro; ?>">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label" for="basic-default-name">WhatsApp 5</label>
                                                        <input class="form-control" type="text" name="idalu[]" value="15" hidden="">
                                                        <input class="form-control" type="text" name="idalu2[15]" value="15" hidden="">
                                                        <input class="form-control buttons__rad" type="text" placeholder="Ej. 524451540656" name="nom[15]" value="<?php echo $whatsAppCinco; ?>">
                                                    </div>
                                                </div>
                                            </div>

                                            <button type="submit" class="btn btn-primary waves-effect waves-light" name="social">Guardar cambios</button>
                                        </div>
                                    </form>

                                </div>

                            </div>

                            <!-- Personalizar Mensajes -->
                            <div class="col-xl-12">
                                <h6 class="text-muted">Mensajes predeterminados</h6>
                                <div class="nav-align-top nav-tabs-shadow mb-4">
                                    <ul class="nav nav-tabs nav-fill" role="tablist">
                                        <li class="nav-item" role="presentation">
                                            <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab" data-bs-target="#navs-justified-mensajes" aria-controls="navs-justified-mensajes" aria-selected="true"><i class="ti ti-message-2-star ti-xs me-1"></i> Mensajes</button>
                                        </li>
                                    </ul>


                                    <form class="browser-default-validation" method="post">
                                        <!-- Nombre de la pagina -->
                                        <div class="tab-content">
                                            <!-- Inicio -->
                                            <div class="tab-pane fade show active" id="navs-justified-mensajes" role="tabpanel">
                                                <div class="card-body">
                                                    <label class="form-label" for="username" style="display: contents;"><strong>
                                                            Usa las variables para personalizar los mensajes:</strong><br>
                                                        ⭐&nbsp;<strong>$nombre</strong>&nbsp;= Nombre Cliente<br>
                                                        ⭐&nbsp;<strong>$sorteo</strong>&nbsp;= Nombre de tu Sorteo<br>
                                                        ⭐&nbsp;<strong>$page</strong>&nbsp;= Nombre de tu Pagina<br>
                                                        ⭐&nbsp;<strong>$cantidad</strong>&nbsp;= Cantidad de Boletos<br>
                                                        ⭐&nbsp;<strong>$total</strong>&nbsp;= Precio a Pagar<br>
                                                        ⭐&nbsp;<strong>$boletos&nbsp;</strong>= Lista de Boletos (Compra por Cliente)<br>
                                                        ⭐&nbsp;<strong>$folio</strong>&nbsp;= Folio generado<br>
                                                        ⭐&nbsp;<strong>$pay</strong>&nbsp;= Pagina de Pagos<br>
                                                        ⭐&nbsp;<strong>$chec</strong>&nbsp;= Pagina Checar Boletos<br>
                                                        ⭐&nbsp;<strong>$bolDig</strong>&nbsp;= Boleto Digital<br>
                                                        ⭐&nbsp;<strong>$inx&nbsp;</strong>= Pagina Sorteo</label>
                                                    <div class="row">
                                                        <!-- Pago -->
                                                        <div class="col-6">
                                                            <div class="mb-3">
                                                                <label class="form-label" for="username"><strong>Mensaje Compra</strong></label>
                                                                <input class="form-control" type="text" name="idalu[]" value="2" hidden="">
                                                                <input class="form-control" type="text" name="idalu2[2]" value="2" hidden="">
                                                                <textarea class="form-control" id="text7" rows="9" name="nom[11]"><?php
                                                                                                                                    $sinCorIz = str_replace("</br>", "\n", $mnsCompraBr);
                                                                                                                                    echo $sinCorIz; ?></textarea>
                                                            </div>
                                                        </div>
                                                        <div class="col" style="display:none;">
                                                            <div class="mb-3">
                                                                <label class="form-label" for="username"><strong>Mensaje Compra BASE</strong></label>
                                                                <textarea class="form-control" id="descrip7" rows="4" name="paWa[2]"></textarea>
                                                                <textarea class="form-control" id="free7" rows="4" name="free[2]"></textarea>
                                                            </div>
                                                        </div>

                                                        <!-- Advertencia -->
                                                        <div class="col-6">
                                                            <div class="mb-3">
                                                                <label class="form-label" for="username"><strong>Mensaje Advertencia</strong></label>
                                                                <input class="form-control" type="text" name="idalu[]" value="3" hidden="">
                                                                <input class="form-control" type="text" name="idalu2[12]" value="3" hidden="">
                                                                <textarea class="form-control" id="text8" rows="9" name="nom[3]"><?php
                                                                                                                                    $sinCorIz = str_replace("</br>", "\n", $mnsAdvertenciaBr);
                                                                                                                                    echo $sinCorIz; ?></textarea>
                                                            </div>
                                                        </div>
                                                        <div class="col" style="display:none;">
                                                            <div class="mb-3">
                                                                <label class="form-label" for="username"><strong>Mensaje Advertencia BASE</strong></label>
                                                                <textarea class="form-control" id="descrip8" rows="4" name="paWa[3]"></textarea>
                                                                <textarea class="form-control" id="free8" rows="4" name="free[3]"></textarea>
                                                            </div>
                                                        </div>

                                                        <!-- Pago -->
                                                        <div class="col-6">
                                                            <div class="mb-3">
                                                                <label class="form-label" for="username"><strong>Mensaje Pago</strong></label>
                                                                <input class="form-control" type="text" name="idalu[]" value="6" hidden="">
                                                                <input class="form-control" type="text" name="idalu2[14]" value="6" hidden="">
                                                                <textarea class="form-control" id="text9" rows="9" name="nom[6]"><?php
                                                                                                                                    $sinCorIz = str_replace("</br>", "\n", $mnsPagoBr);
                                                                                                                                    echo $sinCorIz; ?></textarea>
                                                            </div>
                                                        </div>
                                                        <div class="col" style="display:none;">
                                                            <div class="mb-3">
                                                                <label class="form-label" for="username"><strong>Mensaje Pago BASE</strong></label>
                                                                <textarea class="form-control" id="descrip9" rows="4" name="paWa[6]"></textarea>
                                                                <textarea class="form-control" id="free9" rows="4" name="free[6]"></textarea>
                                                            </div>
                                                        </div>

                                                        <!-- Eliminar -->
                                                        <div class="col-6">
                                                            <div class="mb-3">
                                                                <label class="form-label" for="username"><strong>Mensaje Eliminar</strong></label>
                                                                <input class="form-control" type="text" name="idalu[]" value="4" hidden="">
                                                                <input class="form-control" type="text" name="idalu2[13]" value="4" hidden="">
                                                                <textarea class="form-control" id="text10" rows="9" name="nom[4]"><?php
                                                                                                                                    $sinCorIz = str_replace("</br>", "\n", $mnsEliminarBr);
                                                                                                                                    echo $sinCorIz; ?></textarea>
                                                            </div>
                                                        </div>
                                                        <div class="col" style="display:none;">
                                                            <div class="mb-3">
                                                                <label class="form-label" for="username"><strong>Mensaje Eliminar BASE</strong></label>
                                                                <textarea class="form-control" id="descrip10" rows="4" name="paWa[4]"></textarea>
                                                                <textarea class="form-control" id="free10" rows="4" name="free[4]"></textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <button type="submit" class="btn btn-primary waves-effect waves-light" name="mns">Guardar cambios</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>

                            <!--    r imagenes -->
                            <div class="col-xl-12   ">
                                <h6 class="text-muted">Personaliza / Imagenes (Funcionando 🟢)</h6>
                                <div class="nav-align-top nav-tabs-shadow mb-4">
                                    <ul class="nav nav-tabs nav-fill" role="tablist">
                                        <li class="nav-item" role="presentation">
                                            <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab" data-bs-target="#navs-justified-team1" aria-controls="navs-justified-home" aria-selected="true"><i class="ti ti-photo-check ti-xs me-1"></i> Imagenes</button>
                                        </li>
                                    </ul>


                                    <form class="browser-default-validation" method="post" enctype="multipart/form-data">
                                        <div class="tab-content">
                                            <div class="tab-pane fade show active" id="navs-justified-team1" role="tabpanel">
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-6">
                                                            <div class="form-check custom-option custom-option-icon">
                                                                <label class="form-check-label custom-option-content" for="customRadioPercentage">
                                                                    <span class="custom-option-body">
                                                                        <p>Logo</p>
                                                                        <input type="text" name="Logo" value="<?php echo $logo; ?>" data-target="Logo" hidden>
                                                                        <img class="img__Server openModal3" src="/assets/img/<?php echo $logo; ?>" alt="" data-field="Logo">
                                                                    </span>
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="col-6">
                                                            <div class="form-check custom-option custom-option-icon">
                                                                <label class="form-check-label custom-option-content" for="customRadioPrime">
                                                                    <span class="custom-option-body">
                                                                        <p>Favicon</p>
                                                                        <input type="text" name="favicon" value="<?php echo $favicon; ?>" data-target="favicon" hidden>
                                                                        <img class="img__Server openModal3" src="/assets/img/<?php echo $favicon; ?>" alt="" data-field="favicon">
                                                                    </span>
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="col-6">
                                                            <div class="form-check custom-option custom-option-icon">
                                                                <label class="form-check-label custom-option-content" for="customRadioPrime">
                                                                    <span class="custom-option-body">
                                                                        <p>Portada principal</p>
                                                                        <input type="text" name="Creativo1" value="<?php echo $Creativo1; ?>" data-target="Creativo1" hidden>
                                                                        <img class="img__Server openModal3" src="/assets/img/<?php echo $Creativo1; ?>" alt="" data-field="Creativo1">
                                                                    </span>
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="col-6">
                                                            <div class="form-check custom-option custom-option-icon">
                                                                <label class="form-check-label custom-option-content" for="customRadioPrime">
                                                                    <span class="custom-option-body">
                                                                        <p>Sorteo 1 (Portada)</p>
                                                                        <input type="text" name="Portada1" value="<?php echo $Portada1; ?>" data-target="Portada1" hidden>
                                                                        <img class="img__Server openModal3" src="/assets/img/<?php echo $Portada1; ?>" alt="" data-field="Portada1">
                                                                    </span>
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="col-6">
                                                            <div class="form-check custom-option custom-option-icon">
                                                                <label class="form-check-label custom-option-content" for="customRadioPrime">
                                                                    <span class="custom-option-body">
                                                                        <p>Sorteo 2 (Portada)</p>
                                                                        <input type="text" name="Creativo2" value="<?php echo $Creativo2; ?>" data-target="Creativo2" hidden>
                                                                        <img class="img__Server openModal3" src="/assets/img/<?php echo $Creativo2; ?>" alt="" data-field="Creativo2">
                                                                    </span>
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="col-6">
                                                            <div class="form-check custom-option custom-option-icon">
                                                                <label class="form-check-label custom-option-content" for="customRadioPrime">
                                                                    <span class="custom-option-body">
                                                                        <p>Sorteo 3 (Portada)</p>
                                                                        <input type="text" name="Portada2" value="<?php echo $Portada2; ?>" data-target="Portada2" hidden>
                                                                        <img class="img__Server openModal3" src="/assets/img/<?php echo $Portada2; ?>" alt="" data-field="Portada2">
                                                                    </span>
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <button type="submit" class="btn btn-primary waves-effect waves-light" name="sub__img">Guardar cambios</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                    </div>

                    <!-- 2nda parte -->
                    <div class="container-xxl flex-grow-1 container-p-y">

                        <div class="row">



                            <!-- Imagenes -->

                        </div>

                    </div>

                    <!-- Modal para mostrar imágenes -->
                    <div class="modal fade" id="imageModal" tabindex="-1" role="dialog" aria-labelledby="imageModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content buttons__rad">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="imageModalLabel">Imágenes</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="img_modal_src">
                                        <?php
                                        // Obtener la lista de imágenes en la carpeta assets/img/team
                                        $imageDirectory = "../assets/img/team/";
                                        $images = glob($imageDirectory . "*.{jpg,png,gif}", GLOB_BRACE);

                                        // Mostrar las imágenes en el modal
                                        foreach ($images as $image) {
                                            echo "<img src='" . $image . "' alt='" . basename($image) . "' class='img-fluid m-2' style='width:100px;height: 100px;object-fit: cover;'>";
                                        }
                                        ?>
                                    </div>
                                    <div class="form-group">
                                        <label for="imagen">Cargar imagen:</label>
                                        <input type="file" class="form-control buttons__rad" name="imagen" id="imagen">
                                        <button type="button" class="btn btn-primary" id="subir-imagen" hidden>Subir Imagen</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal fade" id="imageModal2" tabindex="-1" role="dialog" aria-labelledby="imageModalLabel2" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content buttons__rad">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="imageModalLabel2">Imágenes</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="img_modal_src2">
                                        <?php
                                        // Obtener la lista de imágenes en la carpeta assets/img/team
                                        $imageDirectory = "../assets/img/team/";
                                        $images = glob($imageDirectory . "*.{jpg,png,gif}", GLOB_BRACE);

                                        // Mostrar las imágenes en el modal
                                        foreach ($images as $image) {
                                            echo "<img src='" . $image . "' alt='" . basename($image) . "' class='img-fluid m-2' style='width:100px;height: 100px;object-fit: cover;'>";
                                        }
                                        ?>
                                    </div>
                                    <div class="form-group">
                                        <label for="imagen">Cargar imagen:</label>
                                        <input type="file" class="form-control buttons__rad" name="imagen" id="imagen2">
                                        <button type="button" class="btn btn-primary" id="subir-imagen2" hidden>Subir Imagen</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modal para las imagenes de la pagina -->
                    <div class="modal fade" id="imageModal3" tabindex="-1" role="dialog" aria-labelledby="imageModalLabel3" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content buttons__rad">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="imageModalLabel3">Imágenes</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="img_modal_src3">
                                        <?php
                                        // Obtener la lista de imágenes en la carpeta assets/img/team
                                        $imageDirectory = "../assets/img/";
                                        $images = glob($imageDirectory . "*.{jpg,png,gif}", GLOB_BRACE);

                                        // Mostrar las imágenes en el modal
                                        foreach ($images as $image) {
                                            echo "<img src='" . $image . "' alt='" . basename($image) . "' class='img-fluid m-2' style='width:100px;height: 100px;object-fit: cover;'>";
                                        }
                                        ?>
                                    </div>
                                    <div class="form-group">
                                        <label for="imagen">Cargar imagen:</label>
                                        <input type="file" class="form-control buttons__rad" name="imagen" id="imagen3">
                                        <button type="button" class="btn btn-primary" id="subir-imagen3" hidden>Subir Imagen</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <!-- Modal para Tarjetas -->
                    <div class="modal fade" id="tarjetasModal" tabindex="-1" style="display: none;" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered1 modal-simple modal-add-new-cc">
                            <div class="modal-content p-3 p-md-5">
                                <div class="modal-body">
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    <div class="text-center mb-4">
                                        <h3 class="mb-2">Edita tarjeta</h3>
                                        <p class="text-muted">Completa todos los campos</p>
                                    </div>
                                    <form id="addNewCCForm" class="row g-3 fv-plugins-bootstrap5 fv-plugins-framework" method="post" action="submit_tarjetas.php">
                                        <input type="text" value="" id="parametro" name="parametro" class="d-none">
                                        <div class="col-12 fv-plugins-icon-container">
                                            <label class="form-label w-100" for="modalAddCard">Imagen de la tarjeta</label>
                                            <div class="input-group input-group-merge has-validation">
                                                <img class="img-fluid" id="imgValue" src="" alt="" style="background:white;">
                                                <input type="text" name="imgValueInput" id="imgValueInput" class="d-none">

                                            </div>
                                        </div>
                                        <div class="col-12 fv-plugins-icon-container">
                                            <label class="form-label w-100" for="modalAddCard">Nombre del Banco</label>
                                            <div class="input-group input-group-merge has-validation">
                                                <input id="nombreBanco" name="nombreBanco" class="form-control credit-card-mask" type="text" placeholder="Ej. Banco Azteca" aria-describedby="modalAddCard2">
                                                <span class="input-group-text cursor-pointer p-1" id="modalAddCard2"><span class="card-type"></span></span>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-12">
                                            <label class="form-label" for="modalAddCardName">Tipo</label>
                                            <label class="form-label tipoValue" for="modalAddCardName"></label>
                                            <input id="tipoValue" name="tipoValue2" class="form-control credit-card-mask d-none" type="text" placeholder="Ej. Banco Azteca" aria-describedby="modalAddCard2">
                                            <select class="form-control" name="tipoValue" id="">
                                                <option value="" selected="true" disabled="disabled">Selecciona un Tipo</option>
                                                <option value="Transferencias">Transferencia</option>
                                                <option value="Depósitos">Depósitos</option>
                                                <option value="Depósitos y Transferencias ">Depósitos y Transferencias</option>
                                            </select>
                                        </div>
                                        <div class="col-12 col-md-12">
                                            <label class="form-label" for="modalAddCardCvv">Beneficiario</label>
                                            <div class="input-group input-group-merge">
                                                <input type="text" id="nombreValue" name="nombreValue" class="form-control cvv-code-mask" maxlength="3" placeholder="Ej. Luis Angel Alonzo Calderon">
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6">
                                            <label class="form-label" for="modalAddCardExpiryDate">CLABE</label>
                                            <input type="text" id="clabeValue" name="clabeValue" class="form-control expiry-date-mask" placeholder="XXXXXXXXXXXXXXX">
                                        </div>
                                        <div class="col-12 col-md-6">
                                            <label class="form-label" for="modalAddCardExpiryDate">Numero</label>
                                            <input type="text" id="numeroValue" name="numeroValue" class="form-control expiry-date-mask" placeholder="XXXXXXXXXXXXXXX">
                                        </div>
                                        <div class="col-12 text-center">
                                            <button type="submit" class="btn btn-primary me-sm-3 me-1 waves-effect waves-light">Submit</button>
                                            <button type="reset" class="btn btn-label-secondary btn-reset waves-effect" data-bs-dismiss="modal" aria-label="Close">Cancel</button>
                                        </div>
                                        <input type="hidden">
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal fade" id="newTarjetasModal" tabindex="-1" style="display: none;" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered1 modal-simple modal-add-new-cc">
                            <div class="modal-content p-3 p-md-5">
                                <div class="modal-body">
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    <div class="text-center mb-4">
                                        <h3 class="mb-2">Edita la tarjeta</h3>
                                        <p class="text-muted">Completa todos los campos</p>
                                    </div>
                                    <form id="addNewCCForm" class="row g-3 fv-plugins-bootstrap5 fv-plugins-framework" onsubmit="return false" novalidate="novalidate">
                                        <div class="col-12 fv-plugins-icon-container">
                                            <label class="form-label w-100" for="modalAddCard">Nombre del Banco</label>
                                            <div class="input-group input-group-merge has-validation">
                                                <input id="modalAddCard" name="modalAddCard" class="form-control credit-card-mask" type="text" placeholder="Ej. Banco Azteca" aria-describedby="modalAddCard2">
                                                <span class="input-group-text cursor-pointer p-1" id="modalAddCard2"><span class="card-type"></span></span>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-12">
                                            <label class="form-label" for="modalAddCardName">Tipo</label>
                                            <label class="form-label" for="modalAddCardName"></label>
                                            <select class="form-control" name="" id="">
                                                <option value="Transferencias">Transferencia</option>
                                                <option value="Depósitos">Depósitos</option>
                                                <option value="Depósitos y Transferencias ">Depósitos y Transferencias</option>
                                            </select>
                                        </div>
                                        <div class="col-12 col-md-12">
                                            <label class="form-label" for="modalAddCardCvv">Beneficiario</label>
                                            <div class="input-group input-group-merge">
                                                <input type="text" id="modalAddCardCvv" class="form-control cvv-code-mask" maxlength="3" placeholder="Ej. Luis Angel Alonzo Calderon">
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6">
                                            <label class="form-label" for="modalAddCardExpiryDate">CLABE</label>
                                            <input type="text" id="modalAddCardExpiryDate" class="form-control expiry-date-mask" placeholder="XXXXXXXXXXXXXXX">
                                        </div>
                                        <div class="col-12 col-md-6">
                                            <label class="form-label" for="modalAddCardExpiryDate">Numero</label>
                                            <input type="text" id="modalAddCardExpiryDate" class="form-control expiry-date-mask" placeholder="XXXXXXXXXXXXXXX">
                                        </div>
                                        <div class="col-12 text-center">
                                            <button type="submit" class="btn btn-primary me-sm-3 me-1 waves-effect waves-light">Submit</button>
                                            <button type="reset" class="btn btn-label-secondary btn-reset waves-effect" data-bs-dismiss="modal" aria-label="Close">Cancel</button>
                                        </div>
                                        <input type="hidden">
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal fade" id="imageModal4" tabindex="-1" role="dialog" aria-labelledby="imageModalLabel3" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content buttons__rad">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="imageModalLabel3">Imágenes</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="img_modal_src4" style="display: flex;flex-wrap: wrap;">
                                        <?php
                                        $imageDirectory = "../assets/img/pay/";
                                        $images = glob($imageDirectory . "*.{jpg,png,gif}", GLOB_BRACE);
                                        foreach ($images as $image) {
                                            echo "<img src='" . $image . "' alt='" . basename($image) . "' class='img-fluid m-2 img-thumbnail' style='background:white;height: 100px;object-fit: cover;' onclick='handleImageClick(\"" . $image . "\")'>";
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <script>

                    </script>


                    <!-- / Content -->
                    <div class="content-wrapper">
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
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Trumbowyg/2.27.3/trumbowyg.min.js" integrity="sha512-YJgZG+6o3xSc0k5wv774GS+W1gx0vuSI/kr0E0UylL/Qg/noNspPtYwHPN9q6n59CTR/uhgXfjDXLTRI+uIryg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/Trumbowyg/2.27.3/plugins/cleanpaste/trumbowyg.cleanpaste.min.js" integrity="sha512-UInqT8f+K1tkck6llPo0HDxlT/Zxv8t4OGeCuVfsIlXLrnP1ZKDGb+tBsBPMqDW15OcmV8NDfQe9+EaAG4aXeg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Trumbowyg/2.27.3/plugins/pasteimage/trumbowyg.pasteimage.min.js" integrity="sha512-ixvsqe8yYdC0qzr+u6sjbUZeYq3wWD+D/SJSgQ9pt/wm5qbeZBzUBrfqGKlWnqnqRwvTFoF2kva6OKt39a1Cww==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Trumbowyg/2.27.3/plugins/colors/trumbowyg.colors.min.js" integrity="sha512-SHpxBJFbCaHlqGpH13FqtSA+QQkQfdgwtpmcWedAXFCDxAYMgrqj9wbVfwgp9+HgIT6TdozNh2UlyWaXRkiurw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="js/mns.js"></script>

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
                $('.referidoLink').on('click', function(event) {
                    event.preventDefault();
                    var textoReferido = $(this).attr('href');
                    var titleRifa = $(this).data('titlesort');

                    // Crea un elemento de texto oculto
                    var tempInput = $('<textarea>');
                    tempInput.css('position', 'absolute');
                    tempInput.css('left', '-9999px');
                    tempInput.css('top', '-9999px');
                    tempInput.val(`Participa en *${titleRifa}* usando mi codigo
${textoReferido}`);

                    // Añade el elemento al DOM
                    $('body').append(tempInput);

                    // Selecciona y copia el contenido del elemento
                    tempInput.select();
                    document.execCommand('copy');

                    // Elimina el elemento temporal
                    tempInput.remove();

                    // Puedes mostrar una alerta u otra notificación al usuario
                    alert('Link copiado al portapapeles');

                    // Redirecciona al usuario al enlace original
                    // window.location.href = $(this).attr('href');
                });
                $('.simple-editor').trumbowyg({
                    btns: [
                        ['viewHTML'],
                        ['undo', 'redo'], // Only supported in Blink browsers
                        ['formatting'],
                        ['strong', 'em', 'del'],
                        ['superscript', 'subscript'],
                        ['link'],
                        // ['insertImage'],
                        ['justifyLeft', 'justifyCenter', 'justifyRight', 'justifyFull'],
                        ['unorderedList', 'orderedList'],
                        ['horizontalRule'],
                        ['removeformat'],
                        ['fullscreen'],
                        ['foreColor', 'backColor']
                    ]

                });

                $('.col').click(function() {
                    var id = $(this).attr('id');
                    var idParam = $(this).attr('idParam');
                    var imgValue = $(this).find('.imgBanco').attr('src');
                    var bacoValue = $(this).find('.nombreBanco').val();
                    var tipoValue = $(this).find('.tipo').val();
                    var nombreValue = $(this).find('.nombrePersona').val();
                    var clabeValue = $(this).find('.clave').val();
                    var numeroValue = $(this).find('.numero').val();

                    $("#tarjetasModal").modal("show");
                    $('#nombreBanco').val(bacoValue);
                    $('#parametro').val(idParam);
                    $('#imgValue').attr('src', imgValue);
                    $('#imgValueInput').val(imgValue);
                    $('#tipoValue').val(tipoValue);
                    $('.tipoValue').text('Actualmente: ' + tipoValue);
                    $('#nombreValue').val(nombreValue);
                    $('#clabeValue').val(clabeValue);
                    $('#numeroValue').val(numeroValue);
                });

                $('#imgValue').click(function() {
                    $("#imageModal4").modal("show");

                });

                $('.img_modal_src4 .imagen').click(function() {
                    console.log('Click');
                    var urlImagen = $(this).attr('src');

                });
            });



            let globalData_field = '';

            $(document).ready(function() {
                // Configurar evento de eliminación para las filas
                $("#promoTable").on("click", ".removeRowButton", function() {
                    $(this).closest("tr").remove();
                });

                $("#promoTable2").on("click", ".removeRowButton2", function() {
                    $(this).closest("tr").remove();
                });

                $("#promoTable3").on("click", ".removeRowButton3", function() {
                    $(this).closest("tr").remove();
                });


                // Referidos
                $("#refTable").on("click", ".removeRowButton4", function() {
                    $(this).closest("tr").remove();
                });

                $("#refTable2").on("click", ".removeRowButton5", function() {
                    $(this).closest("tr").remove();
                });

                $("#refTable3").on("click", ".removeRowButton6", function() {
                    $(this).closest("tr").remove();
                });

                // Promos
                $("#addRowButton").click(function() {
                    const newRow = `
                                        <tr>
                                            <td><input class='form-control buttons__rad' type="number" name="numero[]" placeholder="Boleto" min="1" step="1"></td>
                                            <td><input class='form-control buttons__rad' type="number" name="valor[]" placeholder="Precio" min="1" step="1"></td>
                                            <td><button class='btn btn-danger removeRowButton buttons__rad' type="button">Eliminar</button></td>
                                        </tr>
                                    `;
                    $("#promoTable tbody").append(newRow); // Agregar la nueva fila dentro de <tbody>
                });

                $("#addRowButton2").click(function() {
                    const newRow = `
                                        <tr>
                                            <td><input class='form-control buttons__rad' type="number" name="numero_two[]" placeholder="Boleto" min="1" step="1"></td>
                                            <td><input class='form-control buttons__rad' type="number" name="valor_two[]" placeholder="Precio" min="1" step="1"></td>
                                            <td><button class='btn btn-danger removeRowButton2 buttons__rad' type="button">Eliminar</button></td>
                                        </tr>
                                    `;
                    $("#promoTable2 tbody").append(newRow); // Agregar la nueva fila dentro de <tbody>
                });

                $("#addRowButton3").click(function() {
                    console.log('click');
                    const newRow = `
                                        <tr>
                                            <td><input class='form-control buttons__rad' type="number" name="numero_tree[]" placeholder="Boleto" min="1" step="1"></td>
                                            <td><input class='form-control buttons__rad' type="number" name="valor_tree[]" placeholder="Precio" min="1" step="1"></td>
                                            <td><button class='btn btn-danger removeRowButton3 buttons__rad' type="button">Eliminar</button></td>
                                        </tr>
                                    `;
                    $("#promoTable3 tbody").append(newRow); // Agregar la nueva fila dentro de <tbody>
                });

                // Referidos
                $("#addRowButton1").click(function() {
                    console.log('clo');
                    const newRow = `
                                        <tr>
                                            <td><input class='form-control buttons__rad' type="text" name="referidor[]" placeholder="Escribe un nuevo Referido" pattern="[A-Za-z]+" title="Solo se permiten letras" value="">
                                            <input class='form-control buttons__rad d-none' type="text" name="numero[]" placeholder="Escribe un nuevo Referido" title="Solo se permiten letras" value="0"></td>
                                            <td><button class='btn btn-danger removeRowButton4 buttons__rad' type="button">Eliminar</button></td>
                                        </tr>
                                    `;
                    $("#refTable tbody").append(newRow); // Agregar la nueva fila dentro de <tbody>
                });

                $("#addRowButton21").click(function() {
                    console.log('clo');
                    const newRow = `
                                        <tr>
                                            <td><input class='form-control buttons__rad' type="text" name="referidor_two[]" placeholder="Escribe un nuevo Referido" pattern="[A-Za-z]+" title="Solo se permiten letras" value="">
                                            <input class='form-control buttons__rad d-none' type="text" name="numero_two[]" placeholder="Escribe un nuevo Referido" title="Solo se permiten letras" value="0"></td>
                                            <td><button class='btn btn-danger removeRowButton5 buttons__rad' type="button">Eliminar</button></td>
                                        </tr>
                                    `;
                    $("#refTable2 tbody").append(newRow); // Agregar la nueva fila dentro de <tbody>
                });

                $("#addRowButton31").click(function() {
                    console.log('clo');
                    const newRow = `
                                        <tr>
                                            <td><input class='form-control buttons__rad' type="text" name="referidor_tree[]" placeholder="Escribe un nuevo Referido" pattern="[A-Za-z]+" title="Solo se permiten letras" value="">
                                            <input class='form-control buttons__rad d-none' type="text" name="numero_tree[]" placeholder="Escribe un nuevo Referido" title="Solo se permiten letras" value="0"></td>
                                            <td><button class='btn btn-danger removeRowButton6 buttons__rad' type="button">Eliminar</button></td>
                                        </tr>
                                    `;
                    $("#refTable3 tbody").append(newRow); // Agregar la nueva fila dentro de <tbody>
                });


            });


            // Variable para almacenar el índice de fila
            let rowIndex = -1;
            let rowIndex2 = -1;
            let rowIndex3 = -1;


            $(document).ready(function() {
                // Función para adjuntar el manejador de eventos al botón "Local"
                let cam = '';
                let cam2 = '';
                let cam3 = '';


                function attachButtonClickHandler(column) {
                    $(`.openModal[data-column="${column}"]`).on("click", function() {
                        // Encontrar la fila (tr) en la que se hizo clic
                        const clickedRow = $(this).closest("tr");
                        // Obtener el índice de fila y almacenarlo en la variable externa
                        rowIndex = $("#dataTable tr").index(clickedRow);
                        // Mostrar el índice de la fila en la consola
                        console.log(`Se hizo clic en el botón ${column} en la fila #` + rowIndex);
                        cam = column;
                    });
                }

                function attachButtonClickHandler2(column) {
                    $(`.openModal2[data-column="${column}"]`).on("click", function() {
                        // Encontrar la fila (tr) en la que se hizo clic
                        const clickedRow = $(this).closest("tr");
                        // Obtener el índice de fila y almacenarlo en la variable externa
                        rowIndex = $("#dataTable2 tr").index(clickedRow);
                        // Mostrar el índice de la fila en la consola
                        console.log(`2 Se hizo clic en el botón ${column} en la fila #` + rowIndex);
                        cam2 = column;
                    });
                }

                function attachButtonClickHandler3(column) {
                    $(`.openModal3[data-field="${column}"]`).on("click", function() {
                        console.log('click fiels');
                        const clickedRow = $(this);
                        console.log(clickedRow);
                    });
                }

                // Adjuntar un manejador de eventos 'click' en '#imageModal img' una sola vez
                $(document).on("click", "#imageModal img", function() {
                    if (rowIndex !== -1) {
                        // Obtener el nombre de la imagen desde el atributo "alt"
                        const imageName = $(this).attr("alt");
                        // Mostrar el nombre de la imagen en la consola junto con rowIndex
                        console.log("Nombre de la imagen: " + imageName + ' ' + rowIndex + ' ' + cam);
                        // Establecer el valor en el input 'Local' correspondiente en la misma fila
                        const localInputForRow = $("#dataTable tr").eq(rowIndex).find(`input.${cam.toLowerCase()}`);
                        console.log(localInputForRow);
                        localInputForRow.val(imageName);

                        const imageForRow = $("#dataTable tr").eq(rowIndex).find(`img.${cam.toLowerCase()}`);
                        imageForRow.attr("src", '../assets/img/team/' + imageName);

                        $("#imageModal").modal("hide");
                    }
                });

                $(document).on("click", "#imageModal2 img", function() {
                    console.log('click 2');
                    if (rowIndex !== -1) {
                        // Obtener el nombre de la imagen desde el atributo "alt"
                        const imageName = $(this).attr("alt");
                        // Mostrar el nombre de la imagen en la consola junto con rowIndex
                        console.log("2Nombre de la imagen: " + imageName + ' ' + rowIndex + ' ' + cam2);
                        // Establecer el valor en el input 'Local' correspondiente en la misma fila
                        const localInputForRow = $("#dataTable2 tr").eq(rowIndex).find(`input.${cam2.toLowerCase()}`);
                        console.log(localInputForRow);
                        localInputForRow.val(imageName);

                        const imageForRow = $("#dataTable2 tr").eq(rowIndex).find(`img.${cam2.toLowerCase()}`);
                        imageForRow.attr("src", '../assets/img/team/' + imageName);

                        $("#imageModal2").modal("hide");
                    }
                });

                $(document).on("click", "#imageModal3 img", function() {
                    const imageName = $(this).attr("alt");
                    $("img[data-field='" + globalData_field + "']").attr("src", "/assets/img/" + imageName);
                    $("input[data-target='" + globalData_field + "']").val(imageName);
                    $("#imageModal3").modal("hide");

                });



                // Adjuntar un manejador de eventos 'click' en el botón "Agregar"
                $("#addRow").click(function() {
                    const newRow = `
                <tr>
                    <td class=''>
                    <!--<input class='form-control buttons__rad' type='text' name="nombreTeamlLocal[]" value=''> -->
                        <input class="form-control buttons__rad" list="teams" id="team" name='nombreTeamlLocal[]' value=''>
                        <datalist id="teams">
                            <option value="América">
                            <option value="Atlas">
                            <option value="A. San Luis">
                            <option value="Xolos">
                            <option value="Cruz azul">
                            <option value="Bravos">
                            <option value="Chivas">
                            <option value="León">
                            <option value="Mazatlán">
                            <option value="Rayado">
                            <option value="Necaxa">
                            <option value="Pachuca">
                            <option value="Puebla">
                            <option value="Pumas">
                            <option value="G. Blancos">
                            <option value="Santos">
                            <option value="Tigres">
                            <option value="Tocula">
                        </datalist>
                        <input type='text' class='local' name='local[]' value='' hidden>
                        <img class="local mt-2 buttons__rad" src='../assets/img/no-pic.png' alt='' style="width:130px;height: 130px;object-fit: cover;border: solid #00000017;">
                        <button class='btn btn-primary openModal buttons__rad' type="button" data-column='Local' data-image=''>Local</button>
                    </td>
                    <td class=''>
                        <!-- <input class='form-control buttons__rad' type='text' name="nombreTeamVisitante[]" value=''> -->
                        <input class="form-control buttons__rad" list="teams" id="team" name='nombreTeamVisitante[]' value=''>
                        <datalist id="teams">
                            <option value="América">
                            <option value="Atlas">
                            <option value="A. San Luis">
                            <option value="Xolos">
                            <option value="Cruz azul">
                            <option value="Bravos">
                            <option value="Chivas">
                            <option value="León">
                            <option value="Mazatlán">
                            <option value="Rayado">
                            <option value="Necaxa">
                            <option value="Pachuca">
                            <option value="Puebla">
                            <option value="Pumas">
                            <option value="G. Blancos">
                            <option value="Santos">
                            <option value="Tigres">
                            <option value="Tocula">
                        </datalist>
                        <input type='text' class='visitante' name='visitante[]' value='' hidden>
                        <img class="visitante mt-2 buttons__rad" src='../assets/img/no-pic.png' alt='' style="width:130px;height: 130px;object-fit: cover;border: solid #00000017;">
                        <button class='btn btn-success openModal buttons__rad' type="button" data-column='Visitante' data-image=''>Visitante</button>
                    </td>
                    <td>
                        <button class='btn btn-danger deleteRow buttons__rad' type="button">Eliminar</button>
                    </td>
                </tr>
            `;


                    $("#dataTable").append(newRow);
                    // Adjuntar el manejador de eventos al botón "Local" en la fila recién creada
                    // attachLocalButtonClickHandler();
                    attachButtonClickHandler("Local");
                    attachButtonClickHandler("Visitante");


                });

                $("#addRow2").click(function() {
                    const newRow = `
                <tr>
                    <td class=''>
                        <!--<input class='form-control buttons__rad' type='text' name="nombreTeamlLocal[]" value=''> -->
                        <input class="form-control buttons__rad" list="teams" id="team" name='nombreTeamlLocal[]' value=''>
                        <datalist id="teams">
                            <option value="América">
                            <option value="Atlas">
                            <option value="A. San Luis">
                            <option value="Xolos">
                            <option value="Cruz azul">
                            <option value="Bravos">
                            <option value="Chivas">
                            <option value="León">
                            <option value="Mazatlán">
                            <option value="Rayado">
                            <option value="Necaxa">
                            <option value="Pachuca">
                            <option value="Puebla">
                            <option value="Pumas">
                            <option value="G. Blancos">
                            <option value="Santos">
                            <option value="Tigres">
                            <option value="Tocula">
                        </datalist>
                        <input type='text' class='local' name='local[]' value='' hidden>
                        <img class="local mt-2 buttons__rad" src='../assets/img/no-pic.png' alt='' style="width:130px;height: 130px;object-fit: cover;border: solid #00000017;">
                        <button class='btn btn-primary openModal2 buttons__rad' type="button" data-column='Local' data-image=''>Local</button>
                    </td>
                    <td class=''>
                        <!-- <input class='form-control buttons__rad' type='text' name="nombreTeamVisitante[]" value=''> -->
                        <input class="form-control buttons__rad" list="teams" id="team" name='nombreTeamVisitante[]' value=''>
                        <datalist id="teams">
                            <option value="América">
                            <option value="Atlas">
                            <option value="A. San Luis">
                            <option value="Xolos">
                            <option value="Cruz azul">
                            <option value="Bravos">
                            <option value="Chivas">
                            <option value="León">
                            <option value="Mazatlán">
                            <option value="Rayado">
                            <option value="Necaxa">
                            <option value="Pachuca">
                            <option value="Puebla">
                            <option value="Pumas">
                            <option value="G. Blancos">
                            <option value="Santos">
                            <option value="Tigres">
                            <option value="Tocula">
                        </datalist>
                        <input type='text' class='visitante' name='visitante[]' value='' hidden>
                        <img class="visitante mt-2 buttons__rad" src='../assets/img/no-pic.png' alt='' style="width:130px;height: 130px;object-fit: cover;border: solid #00000017;">
                        <button class='btn btn-success openModal2 buttons__rad' type="button" data-column='Visitante' data-image=''>Visitante</button>
                    </td>
                    <td>
                        <button class='btn btn-danger deleteRow buttons__rad' type="button">Eliminar</button>
                    </td>
                </tr>
            `;


                    $("#dataTable2").append(newRow);
                    // Adjuntar el manejador de eventos al botón "Local" en la fila recién creada
                    // attachLocalButtonClickHandler();
                    attachButtonClickHandler2("Local");
                    attachButtonClickHandler2("Visitante");
                });

                // Adjuntar el manejador de eventos al botón "Local" en las filas existentes
                // attachLocalButtonClickHandler();
                attachButtonClickHandler("Local");
                attachButtonClickHandler("Visitante");

                attachButtonClickHandler2("Local");
                attachButtonClickHandler2("Visitante");

                attachButtonClickHandler3("favicon");
                attachButtonClickHandler3("Logo");
                attachButtonClickHandler3("Creativo1");
                attachButtonClickHandler3("Creativo2");
                attachButtonClickHandler3("Portada1");
                attachButtonClickHandler3("Portada2");


                // Eliminar una fila al hacer clic en el botón "Eliminar"
                $(document).on("click", ".deleteRow", function() {
                    $(this).closest("tr").remove();
                });

                // Abrir el modal al hacer clic en los botones "Local" o "Visitante" y mostrar la columna
                $(document).on("click", ".openModal", function() {
                    const imageSrc = $(this).data("image");
                    const column = $(this).data("column");
                    console.log('xxxxxxxxxxxxxxxxxxxxx');
                    $("#modalImage").attr("src", imageSrc);
                    console.log($("#modalImage").attr("src", imageSrc));
                    $("#imageModalLabel").text("1 Imágenes de " + column);
                    $("#imageModal").modal("show");
                });

                $(document).on("click", ".openModal2", function() {
                    const imageSrc = $(this).data("image");
                    const column = $(this).data("column");
                    console.log('yyyyyyyyyyyy');
                    $("#modalImage2").attr("src", imageSrc);
                    console.log($("#modalImage2").attr("src", imageSrc));
                    $("#imageModalLabel2").text("2 Imágenes de " + column);
                    $("#imageModal2").modal("show");
                });

                $(document).on("click", ".openModal3", function() {
                    globalData_field = $(this).data("field");
                    console.log(globalData_field);


                    // globalData_field
                    $("#imageModal3").modal("show");

                });

            });




            // esto es para subir la imagen 
            const inputImagen = document.getElementById("imagen");
            inputImagen.addEventListener("change", function() {
                const formData = new FormData();
                formData.append("imagen", inputImagen.files[0]);

                // Envía la imagen al servidor
                fetch("subir_imagen.php", {
                        method: "POST",
                        body: formData
                    })
                    .then(response => response.json())
                    .then(data => {
                        // Actualiza el modal con las nuevas imágenes
                        const modalBody = document.querySelector(".img_modal_src");
                        modalBody.innerHTML = "";

                        data.imagenes.forEach(imagen => {
                            modalBody.innerHTML += `
                        <img src="../assets/img/team/${imagen}" alt="${imagen}" class="img-fluid imagen-modal m-2" data-nombre="${imagen}" style="width:100px;height: 100px;object-fit: cover;">
                    `;
                        });

                        // Limpia el campo de carga de imágenes
                        inputImagen.value = "";
                    })
                    .catch(error => console.error("Error al cargar la imagen:", error));
            });

            const inputImagen2 = document.getElementById("imagen2");
            inputImagen2.addEventListener("change", function() {
                const formData = new FormData();
                formData.append("imagen", inputImagen2.files[0]);

                // Envía la imagen al servidor
                fetch("subir_imagen.php", {
                        method: "POST",
                        body: formData
                    })
                    .then(response => response.json())
                    .then(data => {
                        // Actualiza el modal con las nuevas imágenes
                        const modalBody = document.querySelector(".img_modal_src2");
                        modalBody.innerHTML = "";

                        data.imagenes.forEach(imagen => {
                            modalBody.innerHTML += `
                        <img src="../assets/img/team/${imagen}" alt="${imagen}" class="img-fluid imagen-modal m-2" data-nombre="${imagen}" style="width:100px;height: 100px;object-fit: cover;">
                    `;
                        });

                        // Limpia el campo de carga de imágenes
                        inputImagen2.value = "";
                    })
                    .catch(error => console.error("Error al cargar la imagen:", error));
            });

            const inputImagen3 = document.getElementById("imagen3");
            inputImagen3.addEventListener("change", function() {
                const formData = new FormData();
                formData.append("imagen", inputImagen3.files[0]);

                // Envía la imagen al servidor
                fetch("subir_imagen_creativos.php", {
                        method: "POST",
                        body: formData
                    })
                    .then(response => response.json())
                    .then(data => {
                        // Actualiza el modal con las nuevas imágenes
                        const modalBody = document.querySelector(".img_modal_src3");
                        modalBody.innerHTML = "";

                        data.imagenes.forEach(imagen => {
                            modalBody.innerHTML += `
                        <img src="../assets/img/${imagen}" alt="${imagen}" class="img-fluid imagen-modal m-2" data-nombre="${imagen}" style="width:100px;height: 100px;object-fit: cover;">
                    `;
                        });

                        // Limpia el campo de carga de imágenes
                        inputImagen3.value = "";
                    })
                    .catch(error => console.error("Error al cargar la imagen:", error));
            });
        </script>
        <script src="edit.js"></script>
        <script src="js/ajax__actions.js"></script>

</body>

</html>