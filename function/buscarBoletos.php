<?php 
	echo '<h1 class="fs-1" style="margin-bottom: 10px;">Tu busqueda de boletos :  ' .$_POST['search'] . '</h1>';
	$bolNumber = $_POST['search'];
	$compiler = $_POST['compiler'];

	if(isset($bolNumber)):
		include "../app/vConnCheck.php";
		$user=new ApptivaDB();	
		$u=$user->buscar("info_boletos$compiler"," boleto like '%".$_POST['search']."%'");


		$html="";
		foreach ($u as $v)
			if($v['statusBoleto'] === 'No'){
				$html.='<div class="divBol" nu="' . $v['boleto'] . ' (' . $v['opp'] . ');" data-bs-target="#offcanvas-1" data-bs-toggle="offcanvas">
				<input class="xd" name="w7qr[]" value="' . $v['id'] . '" />
				<input class="boleto blts" style="background-color: #0026ff!important;color: white!important;font-weight: 700;" type="button" name="bltsPay[' . $v['id'] . ']" value="' . $v['boleto'] . '" nu="' . $v['boleto'] . ' (' . $v['opp'] .');"/>
				<input hidden="" class="btlsOther" name="bltsPay['.$v['id'] .']" value="*' . $v['boleto'] . '* (' . $v['opp'] . ')%0A" />
				<h6 hidden="" class="extras">' . $v['boleto'] . ' (' . $v['opp'] . ');</h6>
			</div>
			
			';
			}

		echo $html;
		echo '<p style="margin-bottom:30px!important;"></p>';
		
	else:
		echo "Error";
	endif;
?>