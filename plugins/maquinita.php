<div class="modal fade" role="dialog" tabindex="-1" id="maquinita__modal" style="z-index: 9999999;">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header text-center" style="border-bottom: none;">
                <h4 class="modal-title"><strong>Maquinita de la Suerte 🚀</strong></h4>
                <button type="button" onclick="document.getElementById('id02').style.display='none'" class="w3-button closeMain btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="formbg-outer">
                    <div class="formbg">
                        <div class="formbg-inner padding-horizontal--48" style="padding-top: 0px!important;">
                            <div id="gif-container"></div>
                            <div class="maquinitaX">
                                <div class="row" style="margin-bottom: 10px;">
                                    <label class="fs-3 fw-bold" style="padding-right: 0;padding-left: 0;">¿Cuántos boletos quieres?</label>
                                    <select name="maqX" id="maqX">
                                        <option value="" selected="true" disabled="disabled">SELECCIONA 🍀</option>
                                        <?php
                                        $query = "SELECT * from maquinita";
                                        $result_tasks = mysqli_query($db, $query);
                                        while ($row = mysqli_fetch_assoc($result_tasks)) { ?>
                                            <option value="<?php echo $row['opp'] ?>">
                                                <?php
                                                $countMaquinita = $row['opp'];
                                                if ($countMaquinita < 2) {
                                                    echo $countMaquinita . ' Boleto';
                                                } else {
                                                    echo $countMaquinita . ' Boletos';
                                                }
                                                ?>
                                            </option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="field padding-bottom--24">
                                    <input id="btn-maquis" value="GENERAR BOLETOS AL AZAR" class="formUno btn btn-primary" type="button">
                                </div>
                                <h3 class="fs-6 noResult fw-bold" style="margin: 0;text-align: center;color: var(--color-red);"></h3>
                            </div>
                            <div class="u-form u-form-1 qam-form">
                                <form method="POST">
                                    <p class="styleResulMaqui fs-5 fw-bold"></p>
                                    <div>
                                        <div>
                                            <div class="box-root padding-top--24 flex-flex flex-direction--column" style="flex-grow: 1; z-index: 9;">
                                                <div class="formbg-outer">
                                                    <div class="formbg">
                                                        <div class="formbg-inner">
                                                            <div class="class__boletos___maq">
                                                            </div>
                                                            <div class="row container" style="margin-bottom: 10px;">
                                                                <input type="text" name="name" class="fw-bold form-control input_form" placeholder="NOMBRE(S)" required>
                                                            </div>
                                                            <div class="row container" style="margin-bottom: 10px;">
                                                                <input type="number" name="phone" class="fw-bold form-control input_form" placeholder="NÚMERO WHATSAPP" required>
                                                            </div>
                                                            <div class="row container" style="margin-bottom: 10px;">
                                                                <?php echo $estados; ?>
                                                            </div>
                                                            <p class="text-center fs-6 pt-3" style="font-weight: 700; color: #00a63f;" ><strong>Para finalizar tu compra<br>te redirigiremos a WhatsApp.</strong></p>
                                                            <div class="" style="text-align: center;">
                                                                <button name="buy" type="submit" class="btn btn-primary maqu___pay_button f_track_maqu mb-2 w-75" style="
                                                background-color: red!important;
                                                font-weight: 700;
                                                border-radius: 0;">APARTAR<br></button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                                <div style="text-align: center;">
                                    <button type="submit" id="selectMaquinita" class="formUno btn btn-primary maqu___other mb-2 w-75" style="background-color: black!important;
                                                font-weight: 700;
                                                border-radius: 0">INTENTAR DE NUEVO<br></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>