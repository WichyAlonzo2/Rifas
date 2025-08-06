<?php
include '../app/conn.php';
session_start();
if (isset($_SESSION['user'])) {
    header('location: login.php');
}

if (isset($_POST['logg'])) {
    if (!$db) {
        die("No hay conexión: " . mysqli_connect_error());
    
    }

    // variables de Form
    $nombrex = $_POST['user'];
    $passx = $_POST['pass'];
    $nombre = mysqli_real_escape_string($db, $nombrex);
    $pass = mysqli_real_escape_string($db, $passx);
    $query = mysqli_query($db, "SELECT * FROM users WHERE user = '" . $nombre . "' AND pass = '" . $pass . "'");
    $filas = mysqli_num_rows($query);

    while ($registroBoleto = $query->fetch_array(MYSQLI_BOTH)) {
        $rol = $registroBoleto['rol'];

    }

    if (!isset($_SESSION['user'])) {
        if ($filas == 1) {
            $_SESSION['rol'] = $rol;
            $_SESSION['user'] = $nombre;
            $_SESSION['pass'] = $pass;
            header("location: login.php");
            
        } else if ($filas == 0) {
            echo "<script>alert('Usuario No existe');window.location= '/panel/' </script>";
            
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en" class="dark-style layout-wide  customizer-hide" dir="ltr" data-theme="theme-default" data-assets-path="assets/" data-template="vertical-menu-template-dark">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0">
    <title>Inicia sesion</title>
    <meta name="description" content="Start your development with a Dashboard for Bootstrap 5">
    <meta name="keywords" content="dashboard, bootstrap 5 dashboard, bootstrap 5 design, bootstrap 5">
    <link rel="canonical" href="https://1.envato.market/vuexy_admin">
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="assets/img/favicon/favicon.ico">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin="">
    <link href="css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&ampdisplay=swap" rel="stylesheet">

    <!-- Icons -->
    <link rel="stylesheet" href="assets/vendor/fonts/fontawesome.css">
    <link rel="stylesheet" href="assets/vendor/fonts/tabler-icons.css">
    <link rel="stylesheet" href="assets/vendor/fonts/flag-icons.css">

    <!-- Core CSS -->
    <link rel="stylesheet" href="assets/vendor/css/rtl/core-dark.css" class="template-customizer-core-css">
    <link rel="stylesheet" href="assets/vendor/css/rtl/theme-default-dark.css" class="template-customizer-theme-css">
    <link rel="stylesheet" href="assets/css/demo.css">

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="assets/vendor/libs/node-waves/node-waves.css">
    <link rel="stylesheet" href="assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css">
    <link rel="stylesheet" href="assets/vendor/libs/typeahead-js/typeahead.css">
    <!-- Vendor -->
    <link rel="stylesheet" href="assets/vendor/libs/%40form-validation/umd/styles/index.min.css">

    <!-- Page CSS -->
    <!-- Page -->
    <link rel="stylesheet" href="assets/vendor/css/pages/page-auth.css">

    <!-- Helpers -->
    <script src="assets/vendor/js/helpers.js"></script>
    <script src="assets/vendor/js/template-customizer.js"></script>
    <script src="assets/js/config.js"></script>
</head>
<body>
    <div class="container-xxl">
        <div class="authentication-wrapper authentication-basic container-p-y">
            <div class="authentication-inner py-4">
                <div class="card">
                    <div class="card-body">
                        <div class="app-brand justify-content-center mb-4 mt-2">
                            <a href="/" class="app-brand-link gap-2">
                                <span class="app-brand-logo demo">
                                    <svg width="32" height="22" viewbox="0 0 32 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M0.00172773 0V6.85398C0.00172773 6.85398 -0.133178 9.01207 1.98092 10.8388L13.6912 21.9964L19.7809 21.9181L18.8042 9.88248L16.4951 7.17289L9.23799 0H0.00172773Z" fill="#7367F0"></path>
                                        <path opacity="0.06" fill-rule="evenodd" clip-rule="evenodd" d="M7.69824 16.4364L12.5199 3.23696L16.5541 7.25596L7.69824 16.4364Z" fill="#161616"></path>
                                        <path opacity="0.06" fill-rule="evenodd" clip-rule="evenodd" d="M8.07751 15.9175L13.9419 4.63989L16.5849 7.28475L8.07751 15.9175Z" fill="#161616"></path>
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M7.77295 16.3566L23.6563 0H32V6.88383C32 6.88383 31.8262 9.17836 30.6591 10.4057L19.7824 22H13.6938L7.77295 16.3566Z" fill="#7367F0"></path>
                                    </svg>
                                </span>
                                <span class="app-brand-text demo text-body fw-bold ms-1">SoyAdmin</span>
                            </a>
                        </div>
                        <h4 class="mb-1 pt-2">Bienvenido Admin! 👋</h4>
                        <p class="mb-4">Por favor ingresa para administrar la pagina</p>
                        <form class="mb-3" method="post">
                            <div class="mb-3">
                                <label for="email" class="form-label">Usuario</label>
                                <input class="form-control buttons__rad" type="text" name="user" placeholder="Typea user">
                            </div>
                            <div class="mb-3 form-password-toggle">
                                <div class="d-flex justify-content-between">
                                    <label class="form-label" for="pass">Password</label>
                                    <a href="https://wa.link/ai6v8y">
                                        <small>Olivide mi contraseña?</small>
                                    </a>
                                </div>
                                <div class="input-group input-group-merge">
                                    <input class="form-control buttons__rad" type="password" name="pass" placeholder="Password">
                                    <span class="input-group-text cursor-pointer"><i class="ti ti-eye-off"></i></span>
                                </div>
                            </div>
                            <div class="mb-3">
                                <button class="btn btn-primary shadow buttons__rad" name="logg" type="submit">Iniciar sesión</button>
                            </div>
                        </form>
                        <p class="text-center">
                            <span>Quieres un sistema como este?</span>
                            <a href="https://wa.link/rq6gyw">
                                <span>Escribenos</span>
                            </a>
                        </p>
                    </div>
                </div>
                <div class="buy-now">
                    <a href="https://wa.link/rq6gyw" target="_blank" class="btn btn-danger btn-buy-now">Obtener sistema</a>
                </div>
            </div>
        </div>
    </div>
    <script src="assets/vendor/libs/jquery/jquery.js"></script>
    <script src="assets/vendor/libs/popper/popper.js"></script>
    <script src="assets/vendor/js/bootstrap.js"></script>
    <script src="assets/vendor/libs/node-waves/node-waves.js"></script>
    <script src="assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
    <script src="assets/vendor/libs/hammer/hammer.js"></script>
    <script src="assets/vendor/libs/i18n/i18n.js"></script>
    <script src="assets/vendor/libs/typeahead-js/typeahead.js"></script>
    <script src="assets/vendor/js/menu.js"></script>

    <!-- Vendors JS -->
    <script src="assets/vendor/libs/%40form-validation/umd/bundle/popular.min.js"></script>
    <script src="assets/vendor/libs/%40form-validation/umd/plugin-bootstrap5/index.min.js"></script>
    <script src="assets/vendor/libs/%40form-validation/umd/plugin-auto-focus/index.min.js"></script>

    <!-- Main JS -->
    <script src="assets/js/main.js"></script>

    <!-- Page JS -->
    <script src="assets/js/pages-auth.js"></script>

</body>

</html>