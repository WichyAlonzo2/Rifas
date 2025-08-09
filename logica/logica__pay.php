<?php
    include 'app/conn.php';
    include 'app/varGlobal.php';
    include 'root.php';

    session_start();
    error_reporting(0);
        
        if(isset($_SESSION['whatsApp'])){
            // No code
    
        }else{
            $query = "SELECT *
            FROM (
                SELECT *
                FROM $ajustes
                WHERE idWhatsApp = 1 
                ORDER BY
                    rand()
                LIMIT 1
                ) q
            ORDER BY id ASC";      

            $result_tasks = mysqli_query($db, $query); 
                while ($registroBoleto = $result_tasks->fetch_array(MYSQLI_BOTH)){ 
                    $whatsAppx = $registroBoleto['globalSer'];
    
            }
              
            $_SESSION['whatsApp'] = $whatsAppx;      
            
        }
?>