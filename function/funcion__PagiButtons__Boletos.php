<?php
	function paginate($reload, $page, $tpages, $adjacents) {
		$prevlabel = "&lsaquo; Anterior";
		$nextlabel = "Siguiente &rsaquo;";
		$out = '<ul class="pagination pagination-large">';
		$outX = ''; // No mostrar ningún botón
		
		// Primer Boton 1
		if($page==1) {
			$out.= "<li  class='button__action__pagi' class='disabled' style='padding: 4px 6px 4px 6px;border: 1px solid #ddd; /* Gray */border-radius: 7px 0px 0px 7px;background: #f9f9f9;'><span><a>$prevlabel</a></span></li>";
		} else if($page==2) {
			$out.= "<li  class='button__action__pagi' style='padding: 4px 6px 4px 6px;border: 1px solid #ddd; /* Gray */border-radius: 7px 0px 0px 7px;background: #f9f9f9;'><span><a href='javascript:void(0);' onclick='load(1)'>$prevlabel</a></span></li>";
		}else {
			$out.= "<li class='button__action__pagi' style='padding: 4px 6px 4px 6px;border: 1px solid #ddd; /* Gray */border-radius: 7px 0px 0px 7px;background: #f9f9f9;'><span><a href='javascript:void(0);' onclick='load(".($page-1).")'>$prevlabel</a></span></li>";

		}
		
		// Ultimo Boton 60000
		if($page>($adjacents+1)) {
			$out.= "<li  class='button__action__pagi' style=''><a href='javascript:void(0);' onclick='load(1)'>1</a></li>";
		}
		// Intervalos ...
		if($page>($adjacents+2)) {
			$out.= "<li  class='button__action__pagi' style='cursor: default;'><a>...</a></li>";
		}

		// Paginas
		$pmin = ($page>$adjacents) ? ($page-$adjacents) : 1;
		$pmax = ($page<($tpages-$adjacents)) ? ($page+$adjacents) : $tpages;
		for($i=$pmin; $i<=$pmax; $i++) {
			if($i==$page) {
				$out.= "<li class='active button__action__pagi' style='padding: 4px 6px 4px 6px;border: 1px solid #ddd;background: #ddd;cursor:default;'><a>$i</a></li>";
			}else if($i==1) {
				$out.= "<li class='button__action__pagi' style='padding: 4px 6px 4px 6px;border: 1px solid #ddd;background: #fbfbfb;'><a href='javascript:void(0);' onclick='load(1)'>$i</a></li>";
			}else {
				$out.= "<li class='button__action__pagi' style='padding: 4px 6px 4px 6px;border: 1px solid #ddd;background: #fbfbfb;'><a href='javascript:void(0);' onclick='load(".$i.")'>$i</a></li>";
			}
		}

		// Intervalos ...
		if($page<($tpages-$adjacents-1)) {
			$out.= "<li class='button__action__pagi' style='padding: 4px 6px 4px 6px;border: 1px solid #ddd;background: #fbfbfb;cursor: default;'><a>...</a></li>";
		}

		// Boton < Anterior
		if($page<($tpages-$adjacents)) {
			$out.= "<li class='button__action__pagi' style='padding: 4px 6px 4px 6px;border: 1px solid #ddd;background: #fbfbfb;'><a href='javascript:void(0);' onclick='load($tpages)'>$tpages</a></li>";
		}

		// Boton Siguiente >
		if($page<$tpages) {
			$out.= "<li class='button__action__pagi' style='padding: 4px 6px 4px 6px;border: 1px solid #ddd; /* Gray */border-radius: 0px 7px 7px 0px;background: #f9f9f9;'><span><a href='javascript:void(0);' onclick='load(".($page+1).")'>$nextlabel</a></span></li>";
		}else {
			$out.= "<li class='button__action__pagi' class='disabled' style='padding: 4px 6px 4px 6px;border: 1px solid #ddd; /* Gray */border-radius: 0px 7px 7px 0px;background: #f9f9f9;'><span><a>$nextlabel</a></span></li>";
		}
		
		$out.= "</ul>";
		return $out;
	}
