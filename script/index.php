<!DOCTYPE html>
    <html lang="es">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
        <title>Registra la Conexión - Admin</title>
        <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800&amp;display=swap">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>    
    </head>

    <body>
        <nav class="navbar navbar-light navbar-expand-md sticky-top navbar-shrink py-3" id="mainNav">
            <div class="container"><a class="navbar-brand d-flex align-items-center" href="/"><span class="bs-icon-sm bs-icon-circle bs-icon-primary shadow d-flex justify-content-center align-items-center me-2 bs-icon"><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor" viewBox="0 0 16 16" class="bi bi-code-slash">
                        <path d="M10.478 1.647a.5.5 0 1 0-.956-.294l-4 13a.5.5 0 0 0 .956.294l4-13zM4.854 4.146a.5.5 0 0 1 0 .708L1.707 8l3.147 3.146a.5.5 0 0 1-.708.708l-3.5-3.5a.5.5 0 0 1 0-.708l3.5-3.5a.5.5 0 0 1 .708 0zm6.292 0a.5.5 0 0 0 0 .708L14.293 8l-3.147 3.146a.5.5 0 0 0 .708.708l3.5-3.5a.5.5 0 0 0 0-.708l-3.5-3.5a.5.5 0 0 0-.708 0z"></path>
                    </svg></span><span>WichyDev</span></a></div>
        </nav>
        <section class="py-5">
            <div class="container py-5">
                <div class="row mb-4 mb-lg-5" style="margin-bottom: 0px!important;">
                    <div class="col-md-8 col-xl-6 text-center mx-auto">
                        <h2 class="fw-bold">Registra la Conexión</h2>
                    </div>
                </div>
                <div class="row d-flex justify-content-center" style="margin: 0px!important;">
                    <div class="col-md-6 col-xl-4">
                        <div class="card">
                            <div class="card-body text-center d-flex flex-column align-items-center">
                                <form id="form" action='javascript:void(0);' method='GET'>
                                    <div class="mb-3"><input class="form-control server-form" type="text" placeholder="Servidor" style="width: 332px;"></div>
                                    <div class="mb-3"><input class="form-control user-form" type="text" placeholder="Usuario" style="width: 332px;"></div>
                                    <div class="mb-3"><input class="form-control pass-form" type="text" placeholder="Password" style="width: 332px;"></div>
                                    <div class="mb-3"><input class="form-control db-form" type="text" placeholder="Base de datos" style="width: 332px;"></div>
                                    <div class="mb-3"><input class="form-control url-form" type="text" placeholder="Url Base" style="width: 332px;"></div>
                                    <div class="mb-3">
                                        <input class="btn btn-primary shadow d-block w-100 bs" type='submit' style="width: 135px!important;margin: 0 auto;" class='enviar' value='Listo'>
                                    </div>
                                </form>
                                <div class='datos'>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <script src="../assets/js/action__register.js"></script>
    </body>

    </html>