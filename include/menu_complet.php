<nav id="navbar">
        <div class="container">
            <div class="nav-between">
                <ul class="menu-right btn-toggle-menu">
                    <li class="menu-right-icon">
                        <div class="d-flex input-group w-auto">
                            <a class="btn btn-primary" href="<?php echo $urlPartner . $linkPPago ?>" style="padding: 5px;background: transparent;border-color: transparent;border-radius: 32px;margin-right: 12px;">
                                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-credit-card" viewBox="0 0 16 16" style="font-size: 32px;color: rgb(35,35,35);margin-top: 2px;">
                                    <path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V4zm2-1a1 1 0 0 0-1 1v1h14V4a1 1 0 0 0-1-1H2zm13 4H1v5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V7z" />
                                    <path d="M2 10a1 1 0 0 1 1-1h1a1 1 0 0 1 1 1v1a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1v-1z" />
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
                        <li class="nav-item"><a class="nav-link" href="<?php echo $urlPartner ?>"><strong>Inicio</strong></a></li>
                        <li class="nav-item"><a class="nav-link active" href="<?php echo $urlPartner . $linkPSorteo; ?>"><strong>🎟️Comprar Boletos🎟️</strong></a></li>
                        <li class="nav-item"><a class="nav-link" href="<?php echo $urlPartner . $linkPPago; ?>"><strong>Formas de Pago</strong></a></li>
                        <li class="nav-item"><a class="nav-link" href="<?php echo $urlPartner . $linkPCheck; ?>"><strong>Verificador</strong><br></a></li>
                    </ul>
                </div>
                <div class="dropdown-container" id="dropdownContainerD">
                    <ul class="menu-dropdown">
                        <li class="nav-item"><a class="nav-link" href="<?php echo $urlPartner ?>"><strong>Inicio</strong></a></li>
                        <li class="nav-item"><a class="nav-link active" href="<?php echo $urlPartner . $linkPSorteo; ?>"><strong>🎟️Comprar Boletos🎟️</strong></a></li>
                        <li class="nav-item"><a class="nav-link" href="<?php echo $urlPartner . $linkPPago; ?>"><strong>Formas de Pago</strong></a></li>
                        <li class="nav-item"><a class="nav-link" href="<?php echo $urlPartner ?>#about"><strong>Nosotros</strong></a></li>
                        <li class="nav-item"><a class="nav-link" href="<?php echo $urlPartner . $linkPCheck; ?>"><strong>Verificador</strong><br></a></li>
                    </ul>
                </div>
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
            </div>
        </div>
    </nav>