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

/**
 * Fce generuje <option> pro html <select> na zaklade vstupnich parametru
 * vstupni parametry:
 * @param asociativni pole: index => option value, value => text
 * @param pri zadani nastavi odpovidajici option na checked pro: hodnota == index pole, hodnota muze byt i pole vybranych hodnot
 * @return zadny
 */
function vytvor_option($arr,$hodnota=""/*pri nezadani promenne se hodnota nastavi na ""*/) {
	
	foreach ($arr as $key => $value) {
		$selected = "";
		if(is_array($hodnota)) {
			$podminka = in_array((string)$key, $hodnota);
		} else {
			$podminka = ((string)$key == $hodnota);
		}
		if ($podminka) {
			$selected = "selected=\"selected\"";
		}
		echo "<option value=\"{$key}\" {$selected}>{$value}</option>\n";
	}
}

/**
 * Fce vytahne z tabulky sloupec a id, vytvori asociativni pole a zavola fci pro vytvoreni <option> v html <select>
 * vstupni parametry:
 * @param nazev tabulky, ze ktere se <option> bude tvorit
 * @param nazev sloupce, ktery se pouzije jako hodnota v asc. poli
 * @param podminka pro vybrani dat ze sloupce ve forme mysql dotazu
 * @param pri zadani nastavi odpovidajici option na checked pro: hodnota == index pole
 * @param false/true jestli ma vytvorit na zacatku <option value="">vše</option>
 * @return zadny
 */
function vytvor_option_db($tabulka,$sloupec,$where="",$hodnota="", $vychozi=false) {
	
	$query = "SELECT id, $sloupec AS nazev FROM $tabulka";
	if($where != '') {
		$query .= " WHERE " . $where;
	}
	
	$result = dotaz_db($query);
	
	while($row = mysql_fetch_assoc($result)) {
		$arr[$row['id']] = $row['nazev'];
	}
	
	if($vychozi) {
		echo "<option value=\"\">vše</option>\n";	
	}
	
	vytvor_option($arr, $hodnota);
	
}

/**
 * 
 * @param string $tabulka - nazev tabulky, ze ktere se cerpa (pobocka)
 * @param string $sloupec - popisek selektu (nazev)
 * @param string $related - navazujici tabulka
 * @param string $related_id - id z navazujici tabulky
 */
function vytvor_option_db_multi($tabulka,$sloupec,$related,$related_id){
	$hodnoty = array();
	$query = "SELECT id, $sloupec AS nazev FROM $tabulka";
	
	$result = dotaz_db($query);
	
	while($row = mysql_fetch_assoc($result)) {
		$arr[$row['id']] = $row['nazev'];
	}
	
	$query = "SELECT {$tabulka}_id1 FROM {$tabulka}_{$related} WHERE {$related}_id1 = '" . mysql_real_escape_string($related_id) . "'";
	
	$result = dotaz_db($query);
	
	while($row = mysql_fetch_assoc($result)) {
		$hodnoty[] =$row["{$tabulka}_id1"]; 
	}
	
	vytvor_option($arr, $hodnoty);
}

/**
 * Fce provede dotaz na databazi v pripade chyby ukonci script s chybovou hlaskou
 * vstupni parametry:
 * @param MySQL dotaz, ktery se ma provest
 * @return vysledek dotazu, pokud nenastala chyba
 */
function dotaz_db($query){
	global $link;
	
	$result = mysql_query($query,$link);
	
	if($result === false) {
		Die("Chyba MySQL dotazu, kod: " . mysql_errno($link) . ", popis chyby: " . htmlspecialchars(mysql_error($link)) . "<br /> Puvodni dotaz: " . htmlspecialchars($query)); 
	}
	
	return $result;
}

/**
 * Fce vytvori link s parametry GET, ktere vezme v druhem parametru
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
	
	return URL . "?" . $get;
}

/**
 * Fce vytvori prvek input dle zadanych parametru
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
 * 
 * @param string $table
 * @param array $arr
 * @param int $id
 * @return string
 */
function make_insert_sp($table,$arr,$id) {
	$tmp = array();
	
	for($i = 0; $i < count($arr); $i++) {
		$tmp[] = "($id,$arr[$i])";
	}
	
	$dotaz = "INSERT INTO $table(zamestnanec_id1,pobocka_id1) VALUES" . implode(", ",$tmp);
	
	return $dotaz;
}

/**
 * Fce vytvori dotaz ze vstupnich parametru pro aktualizaci dat
 * @param nazev tabulky
 * @param asociativni pole, sloupec => hodnota, 
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
	
	
	
	
	
	
	
	
	
	
	
	
