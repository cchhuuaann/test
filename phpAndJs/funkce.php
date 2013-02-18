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
		} else if ($value != "") {
			$array[$key] = $value;
		}
	}
	
	$get = http_build_query($array);
	
	if ($escape == true) {
		$get = htmlspecialchars($get);
	}
	
	return "/?" . $get;
}

/**
 * @param name nazev form. prvku
 * @param type typ prvku, bude: text, hidden, checkbox
 * @param hodnota vychozi hodnota
 * 
 * @return string vysledny vystup do echo
 */
function get_input($name, $type, $hodnota) {
	$out = "<input ";
	$out .= 'name="' . $name . '" ';
	$out .= 'id="' . $name . '" ';
	$out .= 'type="' . $type . '" ';
	$checked = "";
	if ($type == 'checkbox') {
		$value = "1";
		if (isset($_POST[$name])) {
			$checked = ' checked="checked"';
		} else if ((string)$hodnota == $value) {
			$checked = ' checked="checked"';
		}
	} else {
		if (isset($_POST[$name])) {
			$value = $_POST[$name];
		} else {
			$value = $hodnota;
		}
	}
	
	$out .= 'value="' . htmlspecialchars($value) . '"' . $checked . ' />';
	
	return $out;
}

/**
 * @param name jmeno, ktere hledame v $_POST
 * 
 * @return hodnota nebo false
 */
function get_post($name) {
	
	if (isset($_POST[$name])) {
		return trim($_POST[$name]);
	} else {
		return false;
	}
	
}

/**
 * @param nazev tabulky
 * @param asociativni pole, sloupec => hodnota
 * 
 * @return vraci vysledny dotaz
 */
function make_insert($table, $array) {
	if (empty($array)) {
		return "";
	}
	$keys = array_keys($array);
	$values = array_values($array);
	
	foreach ($values as $key => $value) {
		$values[$key] = mysql_real_escape_string($value);
	}
	
	$dotaz = "INSERT INTO $table(`" . implode("`, `", $keys) . "`) VALUES ('" . implode("', '", $values) . "')";
	
	return $dotaz;
}

/**
 * @param nazev tabulky
 * @param asociativni pole, sloupec => hodnota
 * @param kompletni text podminky where
 *
 * @return vraci vysledny dotaz
 */
function make_update($table, $array, $where) {
	if (empty($array)) {
		return "";
	}
	$arr_tmp = array();
	$dotaz = "UPDATE $table SET ";
	
	foreach ($array as $key => $value) {
		$arr_tmp[] = "`{$key}`='" . mysql_real_escape_string($value) . "'";
	}
	
	$dotaz .= implode(", ", $arr_tmp);
	$dotaz .= " {$where}";
	return $dotaz;	
}
	
	
	
	
	
	
	
	
	
	
	
	
