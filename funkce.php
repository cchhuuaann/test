<?php

/**
 * Fce generuje podminky na zaklade vstupnich parametru
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

/**
 * @param akce (string) - jedna z povolených akcí - GET parametr nav s validací (pokud není akce platná, bude
 * @param parametry (pole) - asociativní pole GET parametrů kde key=>název GET parametru,
 *                           value=>jeho hodnota, prázdný value ("") - ruší parametr z GET,
 *                           jinak přepisuje stávající nebo nastavuje ten, co ještě nastavený nebyl
 * @param escape true/false zda escapovat get string, vychozi true                         
 * @return string kompletní URL
 */
function get_link($akce, $parametry=Array(),$escape=true) {
	global $povolene_akce;
	
	$array = array();
	
	parse_str($_SERVER["QUERY_STRING"],$array);
	
	//rozhodovani ohledne akce
	if (in_array($akce, $povolene_akce)) {
		$array['nav'] = $akce;
	} else {
		$array['nav'] = $povolene_akce[0];
	}
	
	foreach ($parametry as $key => $value) {
		if ($value == "" && isset($array[$key])) {
			unset($array[$key]);
		} else {
			$array[$key] = $value;
		}
	}
	
	$get = http_build_query($array);
	
	if ($escape == true) {
		$get = htmlspecialchars($get);
	}
	
	return "/?" . $get;
}