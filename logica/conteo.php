<?php 
    $compilerX = intval($compiler);
    $dbInfo_Boletos = 'info_boletos';
    $dbSorteoMini_Boletos = 'sorteomini';
    if ($compilerX === 1) {
        $info_Boletos = $dbInfo_Boletos . '';
        $sorteoMini_Boletos = $dbInfo_Boletos . '';

        // $stringCompiler = '';
        // $stringCompilerRoot = 'sorteoActual';
        // $promosCompiler = '';
        // $compileCheckTick = '';
        // $infoSorteoNombreCompiler = $infoSorteoNombre;
        // $linkPSorteoX = $linkPSorteo;
    } else if ($compilerX === 2) {
        $info_Boletos = $dbInfo_Boletos . '_two';
        $sorteoMini_Boletos = $dbInfo_Boletos . '_two';
        
    } else if ($compilerX === 3) {
        $info_Boletos = $dbInfo_Boletos . '_tree';
        $sorteoMini_Boletos = $dbInfo_Boletos . '_tree';
        
    }



    $result = mysqli_query($db, "SELECT COUNT(statusBoleto) AS `count` FROM `$info_Boletos` WHERE statusBoleto='No'");
    $row = mysqli_fetch_array($result);
    $countFree = $row['count'];
    if ($countFree == 0) {
        $titleSort = 'Sorteo Cerrado - ' . $nombreCorto;
        $descripcionSort = $nombreCorto . " - Cerrado";
        $keySort = 0;
    } else {
        $titleSort = $infoSorteoNombre . " - " . $nombreCorto;
        $descripcionSort = $nombreCorto . " - Disponible AHORA🔥";
        $keySort = 1;
    }
?>