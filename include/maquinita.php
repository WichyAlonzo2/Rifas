<?php
    include '../app/conn.php';
    $numx = trim(($_POST['maqX']));    
    $compiler = intval($_POST['compiler']);
    if($compiler === 1){
        $compilerInt = '';

    }else if($compiler === 2){
        $compilerInt = '_two';
        
    }else if($compiler === 3){
        $compilerInt = '_tree';

    }
        if (isset($_POST['maqX']) && $_POST['maqX'] !="") {
        $query = "SELECT *
                    FROM (
                        SELECT id, boleto, opp, statusBoleto
                        FROM info_boletos$compilerInt
                        WHERE statusBoleto = 'No' 
                        ORDER BY
                            rand()
                        LIMIT $numx
                        ) q
                    ORDER BY id ASC";
                    $result_tasks = mysqli_query($db, $query); 
                        while ($registroBoleto = $result_tasks->fetch_array(MYSQLI_BOTH)){ ?>

                            <div class="" style="width:auto; height: auto; display: inline-block;">
                                <input hidden="" class="maq" name="w7qr[]" value="<?php echo $registroBoleto['boleto']?>" />
                                <input 
                                    class="boletos_maquinita" 
                                    type="button" 
                                    name="w7qr[<?php echo $registroBoleto['boleto']?>]" 
                                    value="<?php echo $registroBoleto['boleto']?>" 
                                    nu="<?php echo $registroBoleto['boleto'];echo ' [';echo $registroBoleto['opp'];echo '];%A0';?>"/>
                                    
                                <input
                                    hidden="" 
                                    name="bltsPay[<?php echo $registroBoleto['id']?>]" 
                                    value="<?php echo $registroBoleto['boleto'];echo ' [';echo $registroBoleto['opp'];echo '];';?>%0A">
                                    
                            </div>

    <?php }}else{ 
        header('location: /');
} ?>