<?php
	session_start();
		$usuarioingresado = $_SESSION['user'];
		$pass = $_SESSION['pass'];
		$rol = $_SESSION['rol'];
		if(isset($_SESSION['user'])){
			
			if($rol == 1){
				header('location: status');

			}elseif ($rol == 2){
				header('location: status');
				
			}elseif ($rol == 3){
				header('location: status');

			}elseif ($rol == 4){
			header('location: param');
			
		}		

		}else{
			header('location: /user_v2/');

		}
?>