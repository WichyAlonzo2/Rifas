<div class="modal fade" role="dialog" tabindex="-1" id="register__modal" style="z-index: 9999999;">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header text-center" style="border-bottom: none;">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST">
                    <div class="box-root padding-top--24 flex-flex flex-direction--column" style="flex-grow: 1; z-index: 9;">
                        <div class="formbg-outer">
                            <div class="formbg">
                                <div class="formbg-inner">
                                    <h2 class="fw-bold text-center">LLENA LOS DATOS Y HAZ<br>CLIC EN APARTAR</h2>
                                    <div id="formBol"></div>
                                    <p class="text-center countBoletoSelect fs-5 pb-3" style="font-weight: 700;"><strong></strong></p>
                                    <div class="form-group" style="margin-bottom:10px;">
                                        <input type="text" name="name" id="name" class="fw-bold form-control input_form" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="NOMBRE(S)" min="7" required>
                                    </div>
                                    <div class="form-group" style="margin-bottom:10px;">
                                        <input type="number" name="phone" id="phone" type="number" required pattern="[0-9]" class="fw-bold form-control input_form" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="NÚMERO WHATSAPP" min="10" required>
                                    </div>
                                    <div class="form-group">
                                        <?php echo $estados; ?>
                                    </div>
                                    <p class="text-center fs-6 pt-3" style="font-weight: 700; color: #00a63f;" ><strong>Para finalizar tu compra<br>te redirigiremos a WhatsApp.</strong></p>
                                    <div class="container mb-auto">
                                        <div class="row">
                                            <div class="col text-center" style="margin-bottom: 8px;">
                                                <input name="buy" type="submit" value="APARTAR" class="formUno btn btn-danger f_track_select" type="button" style="
                                                background-color: red!important;
                                                font-weight: 700;
                                                border-radius: 0;">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>