<!-- <nav id="navbar">
    <div class="container">
        <div class="nav-between">
            <ul class="menu-right btn-toggle-menu">
                <li class="menu-right-icon">
                    <div class="d-flex input-group w-auto">
                        <a class="btn btn-primary remov_pay payxd__button" href="<?php echo $urlPartner . $linkPPago ?>" style="padding: 5px;background: transparent;border-color: transparent;border-radius: 32px;margin-right: 45px;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-credit-card" viewBox="0 0 16 16" style="font-size: 32px;color: rgb(35,35,35);margin-top: 2px;">
                                <path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V4zm2-1a1 1 0 0 0-1 1v1h14V4a1 1 0 0 0-1-1H2zm13 4H1v5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V7z"/>
                                <path d="M2 10a1 1 0 0 1 1-1h1a1 1 0 0 1 1 1v1a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1v-1z"/>
                            </svg>
                        </a>
                    </div>
                    
                </li>
            </ul>
            <a href="/">
                <img src="xy.php?xy=logo.png" class="img-menu__nav">
            </a>
            <div class="dropdown-container" id="dropdownContainer">
                <ul class="menu-dropdown">
                    <li class="nav-item"><a class="nav-link" href="/"><strong>Inicio</strong></a></li>
                    <li class="nav-item"><a class="nav-link active" href="<?php echo $urlPartner . $linkPSorteo; ?>"><strong>🎟️Comprar Boletos🎟️</strong></a></li>
                    <li class="nav-item"><a class="nav-link" href="<?php echo $linkPPago; ?>"><strong>Formas de Pago</strong></a></li>
                    <li class="nav-item"><a class="nav-link" href="<?php echo $linkPCheck; ?>"><strong>Verificador</strong><br></a></li>
                </ul>
            </div>
            <ul class="menu-right btn-toggle-menu">
                <li class="menu-right-icon">
                    <div class="d-flex input-group w-auto">
                        <a class="btn btn-primary remov_pay payxd__button" href="<?php echo $urlPartner . $linkPSorteo ?>" style="padding: 5px;background: transparent;border-color: transparent;border-radius: 32px;margin-left: 45px;">
                            <svg class="bi bi-cart4" xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor" viewBox="0 0 16 16" style="font-size: 40px;color: rgb(35,35,35);">
                                <path d="M0 2.5A.5.5 0 0 1 .5 2H2a.5.5 0 0 1 .485.379L2.89 4H14.5a.5.5 0 0 1 .485.621l-1.5 6A.5.5 0 0 1 13 11H4a.5.5 0 0 1-.485-.379L1.61 3H.5a.5.5 0 0 1-.5-.5zM3.14 5l.5 2H5V5H3.14zM6 5v2h2V5H6zm3 0v2h2V5H9zm3 0v2h1.36l.5-2H12zm1.11 3H12v2h.61l.5-2zM11 8H9v2h2V8zM8 8H6v2h2V8zM5 8H3.89l.5 2H5V8zm0 5a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0zm9-1a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0z"></path>
                            </svg>
                        </a>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</nav> -->
<?php
include 'sys.php';
?>
<!-- <nav class="navbar navbar-expand-md fixed-top navbar-shrink py-3 navbar-light" id="mainNav" style="background:white;">
    <div class="container">
        <a class="navbar-brand d-flex align-items-center" href="/">
            <img src="assets/img/<?php echo $logo; ?>" class="img-menu__nav mx-2">
            <span class="letras_logo"><?php echo $importanteNombreSorteo; ?>
                <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor" viewBox="0 0 16 16" class="bi bi-patch-check-fill" style="font-size: 15px;color: rgb(16 156 255);margin-top: -9px!important;">
                    <path d="M10.067.87a2.89 2.89 0 0 0-4.134 0l-.622.638-.89-.011a2.89 2.89 0 0 0-2.924 2.924l.01.89-.636.622a2.89 2.89 0 0 0 0 4.134l.637.622-.011.89a2.89 2.89 0 0 0 2.924 2.924l.89-.01.622.636a2.89 2.89 0 0 0 4.134 0l.622-.637.89.011a2.89 2.89 0 0 0 2.924-2.924l-.01-.89.636-.622a2.89 2.89 0 0 0 0-4.134l-.637-.622.011-.89a2.89 2.89 0 0 0-2.924-2.924l-.89.01-.622-.636zm.287 5.984-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7 8.793l2.646-2.647a.5.5 0 0 1 .708.708z"></path>
                </svg>
            </span>
        </a>
        <button data-bs-toggle="collapse" class="navbar-toggler" data-bs-target="#navcol-1"><span class="visually-hidden">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>

        <div class="flex-shrink-0 dropdown mx-2 d-md-none">

            <div class="d-flex input-group w-auto">
                <a class="btn btn-primary remov_pay payxd__button" href="<?php echo $urlPartner . $linkPSorteo ?>" style="padding: 5px;background: transparent;border-color: transparent;border-radius: 32px;margin-left: 45px;">
                    <svg class="bi bi-cart4" xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor" viewBox="0 0 16 16" style="font-size: 40px;color: rgb(35,35,35);">
                        <path d="M0 2.5A.5.5 0 0 1 .5 2H2a.5.5 0 0 1 .485.379L2.89 4H14.5a.5.5 0 0 1 .485.621l-1.5 6A.5.5 0 0 1 13 11H4a.5.5 0 0 1-.485-.379L1.61 3H.5a.5.5 0 0 1-.5-.5zM3.14 5l.5 2H5V5H3.14zM6 5v2h2V5H6zm3 0v2h2V5H9zm3 0v2h1.36l.5-2H12zm1.11 3H12v2h.61l.5-2zM11 8H9v2h2V8zM8 8H6v2h2V8zM5 8H3.89l.5 2H5V8zm0 5a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0zm9-1a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0z"></path>
                    </svg>
                </a>
            </div>
        </div>
        <div class="collapse navbar-collapse" id="navcol-1">
            <div class="dropdown-container" id="dropdownContainer">
                <ul class="menu-dropdown">
                    <li class="nav-item"><a class="nav-link" href="/"><strong>Inicio</strong></a></li>
                    <li class="nav-item"><a class="nav-link active" href="<?php echo $urlPartner . $linkPSorteo; ?>"><strong>🎟️Comprar Boletos🎟️</strong></a></li>
                    <li class="nav-item"><a class="nav-link" href="<?php echo $linkPPago; ?>"><strong>Formas de Pago</strong></a></li>
                    <li class="nav-item"><a class="nav-link" href="<?php echo $linkPCheck; ?>"><strong>Verificador</strong><br></a></li>
                </ul>
            </div>
            <div class="d-flex input-group w-auto">
                <a class="btn btn-primary remov_pay payxd__button" href="<?php echo $urlPartner . $linkPSorteo ?>" style="padding: 5px;background: transparent;border-color: transparent;border-radius: 32px;margin-left: 45px;">
                    <svg class="bi bi-cart4" xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor" viewBox="0 0 16 16" style="font-size: 40px;color: rgb(35,35,35);">
                        <path d="M0 2.5A.5.5 0 0 1 .5 2H2a.5.5 0 0 1 .485.379L2.89 4H14.5a.5.5 0 0 1 .485.621l-1.5 6A.5.5 0 0 1 13 11H4a.5.5 0 0 1-.485-.379L1.61 3H.5a.5.5 0 0 1-.5-.5zM3.14 5l.5 2H5V5H3.14zM6 5v2h2V5H6zm3 0v2h2V5H9zm3 0v2h1.36l.5-2H12zm1.11 3H12v2h.61l.5-2zM11 8H9v2h2V8zM8 8H6v2h2V8zM5 8H3.89l.5 2H5V8zm0 5a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0zm9-1a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0z"></path>
                    </svg>
                </a>
            </div>
        </div>
    </div>
</nav> -->

<nav class="navbar navbar-expand-md fixed-top navbar-shrink py-3 navbar-light" id="mainNav" style="background:white;">
    <div class="container">
        <a class="navbar-brand d-flex align-items-center" href="/">
            <img src="assets/img/<?php echo $logo; ?>" class="img-menu__nav mx-2">
            <span class="letras_logo"><?php echo $importanteNombreSorteo; ?>
                <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor" viewBox="0 0 16 16" class="bi bi-patch-check-fill" style="font-size: 15px;color: rgb(16 156 255);margin-top: -9px!important;">
                    <path d="M10.067.87a2.89 2.89 0 0 0-4.134 0l-.622.638-.89-.011a2.89 2.89 0 0 0-2.924 2.924l.01.89-.636.622a2.89 2.89 0 0 0 0 4.134l.637.622-.011.89a2.89 2.89 0 0 0 2.924 2.924l.89-.01.622.636a2.89 2.89 0 0 0 4.134 0l.622-.637.89.011a2.89 2.89 0 0 0 2.924-2.924l-.01-.89.636-.622a2.89 2.89 0 0 0 0-4.134l-.637-.622.011-.89a2.89 2.89 0 0 0-2.924-2.924l-.89.01-.622-.636zm.287 5.984-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7 8.793l2.646-2.647a.5.5 0 0 1 .708.708z"></path>
                </svg>
            </span>
        </a>
        <button data-bs-toggle="collapse" class="navbar-toggler" data-bs-target="#navcol-1"><span class="visually-hidden">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>

        <div class="flex-shrink-0 dropdown mx-2 d-md-none">
            <ul class="navbar-nav mx-auto">
                <li class="menu-right-icon">
                    <div class="d-flex input-group w-auto">
                        <button class="btn btn-primary remov_pay payxd__button" type="button" style="padding: 5px;background: transparent;border-color: transparent;border-radius: 32px;margin-right: 12px;" data-bs-target="#offcanvas-1" data-bs-toggle="offcanvas">
                            <span class="countCart position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" style="padding-top: 5.2px;margin: 10px 0px 0px -7px;display: block;display: none;">0<span class="countCart visually-hidden">0</span></span>
                            <svg class="bi bi-cart4" xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor" viewBox="0 0 16 16" style="font-size: 40px;color: rgb(35,35,35);">
                                <path d="M0 2.5A.5.5 0 0 1 .5 2H2a.5.5 0 0 1 .485.379L2.89 4H14.5a.5.5 0 0 1 .485.621l-1.5 6A.5.5 0 0 1 13 11H4a.5.5 0 0 1-.485-.379L1.61 3H.5a.5.5 0 0 1-.5-.5zM3.14 5l.5 2H5V5H3.14zM6 5v2h2V5H6zm3 0v2h2V5H9zm3 0v2h1.36l.5-2H12zm1.11 3H12v2h.61l.5-2zM11 8H9v2h2V8zM8 8H6v2h2V8zM5 8H3.89l.5 2H5V8zm0 5a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0zm9-1a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0z"></path>
                            </svg>
                        </button>
                    </div>
                </li>
            </ul>
            <ul class="dropdown-menu text-small shadow">
                <li><a class="dropdown-item" href="#">Perfil</a></li>
                <li><a class="dropdown-item" href="download?vqui=1"><?php echo $infoSorteoNombre; ?></a></li>
                <li><a class="dropdown-item" href="download?vqui=2"><?php echo $infoSorteoNombre2; ?></a></li>
            </ul>
        </div>


        <div class="collapse navbar-collapse" id="navcol-1">
            <ul class="navbar-nav mx-auto">
                <li class="nav-item fw-bold"><a class="nav-link" href="<?php echo $linkPPago; ?>">Inicio</a></li>
                <li class="nav-item fw-bold dropdown">
                    <a class="dropdown-toggle nav-link active" aria-expanded="false" data-bs-toggle="dropdown" href="#">🎟️Comprar boletos🎟️</a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item active" href="<?php echo $linkPSorteo; ?>"><?php echo $infoSorteoNombre; ?></a>
                        <a class="dropdown-item" href="jornada-<?php echo $linkPSorteo2; ?>"><?php echo $infoSorteoNombre2; ?></a>
                        <a class="dropdown-item" href="jornada-<?php echo $linkPSorteo3; ?>"><?php echo $infoSorteoNombre3; ?></a>
                    </div>
                </li>
                <li class="nav-item fw-bold"><a class="nav-link" href="<?php echo $linkPPago; ?>">Formas de Pago</a></li>
                <li class="nav-item fw-bold dropdown">
                    <a class="dropdown-toggle nav-link" aria-expanded="false" data-bs-toggle="dropdown" href="#">Verificador</a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="<?php echo $linkPCheck; ?>"><?php echo $infoSorteoNombre; ?></a>
                        <a class="dropdown-item" href="<?php echo $linkPCheck; ?>2"><?php echo $infoSorteoNombre2; ?></a>
                        <a class="dropdown-item" href="<?php echo $linkPCheck; ?>3"><?php echo $infoSorteoNombre3; ?></a>
                    </div>
                </li>
                <ul class="menu-right">
                    <li class="menu-right-icon">
                        <div class="d-flex input-group w-auto">
                            <button class="btn btn-primary remov_pay payxd__button" type="button" style="padding: 5px;background: transparent;border-color: transparent;border-radius: 32px;margin-right: 12px;" data-bs-target="#offcanvas-1" data-bs-toggle="offcanvas">
                                <span class="countCart position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" style="padding-top: 5.2px;margin: 10px 0px 0px -7px;display: block;display: none;">0<span class="countCart visually-hidden">0</span></span>
                                <svg class="bi bi-cart4" xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor" viewBox="0 0 16 16" style="font-size: 40px;color: rgb(35,35,35);">
                                    <path d="M0 2.5A.5.5 0 0 1 .5 2H2a.5.5 0 0 1 .485.379L2.89 4H14.5a.5.5 0 0 1 .485.621l-1.5 6A.5.5 0 0 1 13 11H4a.5.5 0 0 1-.485-.379L1.61 3H.5a.5.5 0 0 1-.5-.5zM3.14 5l.5 2H5V5H3.14zM6 5v2h2V5H6zm3 0v2h2V5H9zm3 0v2h1.36l.5-2H12zm1.11 3H12v2h.61l.5-2zM11 8H9v2h2V8zM8 8H6v2h2V8zM5 8H3.89l.5 2H5V8zm0 5a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0zm9-1a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0z"></path>
                                </svg>
                            </button>
                        </div>
                    </li>
                </ul>
            </ul>
        </div>
    </div>
</nav>