<?php
	include "../app/conn.php";
		$consulta = "SELECT * FROM sorteomini ORDER BY id ASC";
		$ejecutar = $db->query($consulta);
		while($fila = $ejecutar->fetch_array()):
	?>
	
		<div id="datos_chat">
			<span style="color: #1c62c4;"><?php echo $fila['nombre']; ?>: </span>
			<span style="color: #80725F;"><?php echo $fila['cant']; ?></span>
		</div>

<?php 
	endwhile; 
	?>
			