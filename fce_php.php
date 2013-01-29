<?php

/*Fce generuje podminky na zaklade vstupnich parametru
 * vstupni parametry:
 * @param dosavadni pole se seznamem podminek, ktere predavame referenci tzn. po skonceni fce si bude stale pamatovat pridane hodnoty
 * @param hodnota s oddelovacem podtrzitka prijata z filtru
 * @param nazev sloupce v databazi
 * @return zadny
 */
function vygeneruj_podminky(&$arr,$podminka,$sloupec) {
	if ($podminka == "0") {
		return;
	}

	$array = explode("_", $podminka);

	$od=(int)$array[0];
	$do=(int)$array[1];
	

	if (count($array) == 2) {
		if (is_numeric($array[0])) {
			$arr[] = "$sloupec >= $od";
		}
		if (is_numeric($array[1])) {
			$arr[] = "$sloupec < $do";
		}
	}

	return;
}



function vytvor_option($arr,$hodnota=""/*pri nezadani promenne se hodnota nastavi na ""*/) {
	foreach ($arr as $key => $value) {
		$selected = "";
		if ((string)$key == $hodnota) {
			$selected = "selected=\"selected\"";
		}
		echo "<option value=\"{$key}\" {$selected}>{$value}</option>\n";
	}
}