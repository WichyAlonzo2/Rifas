<?php
    include 'vConn.php';
        $servidor= $local;
        $usuario= $usuario;
        $password = $contra;
        $nombreBD= $dataBase;
        
            $db = new mysqli($servidor, $usuario, $password, $nombreBD);
                if ($db->connect_error) {
                    die("Error con la conexión al servidor " . $db->connect_error);
                }else{
                }

                    if (!$db->set_charset("utf8mb4")) {
                        exit();
                        
                    }else {
                      
                    }     
                    
                    
        // Realiza la consulta SQL
        $sql = "SELECT * FROM prueba_sorteomini";
        $result = mysqli_query($db, $sql);
        
        // Prepara el resultado en formato JSON
        $rows = array();
        while($r = mysqli_fetch_assoc($result)) {
            $rows[] = $r;
        }
        echo json_encode($rows);
        
        // Cierra la conexión a la base de datos
        mysqli_close($db);
                           
?>