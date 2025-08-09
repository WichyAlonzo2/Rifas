<?php 
    include $urlPartner . '/app/conn.php';
    include $urlPartner . '/app/vConn.php';
    include $urlPartner . '/root.php';
    include $urlPartner . '/app/varGlobal.php';
    include $urlPartner . '/logica/whatsapp.php';
    include $urlPartner . '/sys.php';
    include $urlPartner . '/includes/errr.php';
    if ($mantenimiento === true) {
        header('location: root_man');
    
    }
    if(isset($_GET['nombre'])){
        $usuario = $_GET['nombre'];
    }

    if (isset($_GET['nombre']) && $_GET['nombre'] !="") {  
        $compiler = $_GET['compiler'];
        $compilerX = intval($compiler);
        if($compilerX === 1){
            $compilerdb = '';
            $creativoSource = $Creativo2;

        }else if($compilerX === 2){
            $compilerdb = '_two';
            $creativoSource = $Portada1;

        }else if($compilerX === 3){
            $compilerdb = '_tree';
            $creativoSource = $Portada2;

        }

        $query = "SELECT *
            FROM sorteomini$compilerdb
            WHERE folio = '$usuario' 
            ";      
            $result_tasks = mysqli_query($db, $query); 
                while ($row = $result_tasks->fetch_array(MYSQLI_BOTH)){

?>
                        <div class="ticket ticket_color" id="ticket">
                            
                            <aside  style="width: 549px;font-family: 'Open Sans', sans-serif;">
                                <span>
                                    <?php 
                                        $str = $infoSorteoNombre;
                                        echo $str;
                                    ?>
                                </span>
                            </aside>
                            <section class="ticket__first-section" style="margin-top: 0px;margin-bottom: 0px;">
                            <div class="container pt-3 text-center" style="margin-bottom: 9px;margin-bottom: 11px;border-top: solid 2.3px;"><strong>Folio:</strong><br><span class="dBolet"><strong><?php echo $row['folio'];?></strong><br></span></div>
                                <section>
                                    <img src="../assets/img/<?php echo $logo?>" style="margin-bottom: 11px;border-radius: 100%!important;">
                                </section>
                                <div class="container" style="border-top: 2px dashed #b9b9b9;padding-top: 10px;padding-bottom: 10px;">
                                    <strong class="nBol">Boleto con Oportunidades: </strong><br>
                                        <span class="dBolet">
                                        <?php 
                                            $bol = $row['boletoOpp'];
                                            $aster = str_replace("*","", $bol);
                                            $final = str_replace("%0A","<br>", $aster);
                                            echo $final;
                                        ?>
                                        </span>
                                </div>
                                <section style="height: auto;">
                                    <img src="../assets/img/<?php echo $creativoSource; ?>" style="width: 100%!important;border-radius: 10px!important;border-radius: 12px;border-color: black!important;border: 4px solid;">
                                </section>
                                <div class="container dCl"><strong class="nBol">Nombre: </strong><span class="dBolet"><?php echo $row['nombre'];?></span></div>
                                <div class="container"><strong class="nBol">Teléfono: </strong><span class="dBolet"><?php $numeroCompleto = $row['numero'];
                                                                                                                            $ultimosCuatroDigitos = substr($numeroCompleto, -4);
                                                                                                                            $asteriscos = str_repeat('*', strlen($numeroCompleto) - 4);

                                                                                                                            $numeroEnmascarado = $asteriscos . $ultimosCuatroDigitos;

                                                                                                                            echo $numeroEnmascarado;?></span></div>
                                <div class="container"><strong class="nBol">Estado: </strong><span class="dBolet"><?php echo $row['estado'];?></span></div>
                                <div class="container"><strong class="nBol">Pagado: </strong><span class="dBolet"><?php echo $row['pagado'];?></span></div>
                                <div class="container"><strong class="nBol">Pronto Pago: </strong><span class="dBolet"><?php echo $row['prontoPago'];?></span></div>
                                <div class="container"><strong class="nBol">Fecha Compra: </strong><span class="dBolet"><?php echo $row['timeCompra'];?><br></span></div>
                                <div class="container"><strong class="nBol">Fecha Compra: </strong><span class="dBolet"><?php echo $row['timePay'];?><br></span></div>
                                <div class="container pb-3" style="margin-top: 27px;/*position: absolute;*//*position: absolute;*//*position: fixed;*/bottom: 10px;text-align: center;font-size: 24px;border-bottom: solid 2.3px;"><strong class="nBol">Mucha Suerte 🍀</strong></div>
                            </section>
                            <aside style="width: 549px;font-family: 'Open Sans', sans-serif;">
                                <span>
                                    <?php 
                                        $str = $infoSorteoNombre;
                                        echo $str;
                                            }
                                    ?>
                                </span>
                            </aside>
                        </div>

                        <?php };?>