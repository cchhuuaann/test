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
function vytvor_option_db($tabulka,$sloupec,$id='id', $where="",$hodnota="", $vychozi=false) {
	
	$query = "SELECT id, $sloupec AS nazev FROM $tabulka";
	if($where != '') {
		$query .= " WHERE " . $where;
	}
	
	$query .= " GROUP BY {$tabulka}.{$sloupec}";
		
	$result = dotaz_db($query);
	
	while($row = mysql_fetch_assoc($result)) {
		$arr[$row[$id]] = $row['nazev'];
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
 * @param string $right_query - cast mysql dotazu, ktery se pripoji zprava
 */
function vytvor_option_db_multi($tabulka,$sloupec,$related,$related_id,$right_query=""){
	$hodnoty = array();
	$arr = array();
	$query = "SELECT t.id AS tid, t.$sloupec AS nazev FROM $tabulka AS t $right_query";
	
	$result = dotaz_db($query);
	
	while($row = mysql_fetch_assoc($result)) {
		$arr[$row['tid']] = $row["nazev"];
	}
	
	$query = "SELECT t.{$tabulka}_id FROM {$related}_{$tabulka} AS t WHERE t.{$related}_id = '" . mysql_real_escape_string($related_id) . "'";
	
	$result = dotaz_db($query);
	
	while($row = mysql_fetch_assoc($result)) {
		$hodnoty[] =$row["{$tabulka}_id"]; 
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
 * @param model / aby se link generoval pro konkretni model                        
 * @return string kompletní URL
 */
function get_link($novy_model="") {
	global $povolene_akce, $model, $vychozi_model;
	
	//rozhodovani ohledne modelu
	$model_url = "";
	if ($novy_model != ""){
		
		if(in_array( $novy_model, array_keys($povolene_akce) )) {
			$model_url = $novy_model;
		} else {
			$model_url = $vychozi_model;
		}
	} else {
		$model_url = $model;
	}
	
	return URL . $model_url;
}

/**
 * Fce vytvori prvek input dle zadanych parametru
 * @param name nazev form. prvku
 * @param type typ prvku, bude: text, hidden, checkbox
 * @param hodnota vychozi hodnota
 * @param dalsi atributy inputu
 * 
 * @return string vysledny vystup do echo
 */
function get_input($name, $type, $hodnota, $dalsi_atributy="") {
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
	
	$out .= 'value="' . htmlspecialchars($value) . '"' . $checked . $dalsi_atributy . ' />';
	
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
	
	$nazev = explode('_', $table);
	
	
	$dotaz = "INSERT INTO $table({$nazev[0]}_id,{$nazev[1]}_id) VALUES" . implode(", ",$tmp);
	
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
	
	
/**
 * 
 */	
function vykresli_menu(){
	global $povolene_akce,$menu,$submenu,$model,$nav;
	
	echo "<div id=\"nav\"><ul>";
	
	$count = count($menu);
	$i = 0;
	
	foreach($menu as $value) {
		$i += 1;
		
		if($model == $value['model'] && in_array($nav, $povolene_akce[$value['model']]) /*$nav == $value['action']*/) {
			
			if($count == $i) {
				$class = " class=\"active last\"";
			} else {
				$class = " class=\"active\"";
			}
			
		} elseif($count == $i) {
			$class = "class=\"last\"";
		} else {
			$class = "";
		}
		
		echo "<li $class ><a href=\"" . get_link($value['model']) . "\">". htmlspecialchars($value['name']) . "</a></li>\n";
		
	}
	
	echo "</ul></div>";
	
}

/**
 * @param
 */
function vykresli_header($title=""){
?>
		<meta charset="utf-8" />
		<script type="text/javascript">
			var URL = "<?= URL ?>"; 
		</script>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js" type="text/javascript"></script>
		<script src="<?= URL ?>scripts/jq.slides.js" type="text/javascript" charset="utf-8"></script>
		<script type="text/javascript" src="<?= URL ?>scripts/jq.common.js"></script>
		<link rel="stylesheet" type="text/css" href="<?= URL ?>css/style.css" />
		<link rel="stylesheet" href="<?= URL ?>css/prettyPhoto.css" type="text/css" media="screen" title="prettyPhoto main stylesheet" />
		<title><?= htmlspecialchars($title) ?></title>
<?php
}

/**
 *Funkce pro vykresleni slideru 
 */
function vykresli_slider(){
?>
	<div class="slide">
		<img class="front_image first active" alt="" src="../images/intro/intro_1.jpg" />
		<img class="front_image" alt="" src="../images/intro/intro_2.jpg" />
		<img class="front_image" alt="" src="../images/intro/intro_3.jpg" />
		<img class="front_image" alt="" src="../images/intro/intro_4.jpg" />
		<img class="front_image" alt="" src="../images/intro/intro_5.jpg" />
		<img class="front_image" alt="" src="../images/intro/intro_6.jpg" />
		<div id="text">
			<h1>Signal processing laboratory</h1>
			<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent eget lacus vulputate orci cursus semper sit amet Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent eget lacus vulputate orci cursus mi.</p>
		</div>
		<div class="switches">
			<a class="switch active" href="" rel="1"></a>
			<a class="switch" href="" rel="2"></a>
			<a class="switch" href="" rel="3"></a>
			<a class="switch" href="" rel="4"></a>
			<a class="switch" href="" rel="5"></a>
			<a class="switch" href="" rel="6"></a>
		</div>
	</div>
<?php
}

/**
 * funkce pro vykresleni info aktualnich informaci
 */
function vykresli_aktual_info() {

	echo "<div class=\"info clear\" id=\"aktualni\">";

	$query = "SELECT id,nadpis,podnadpis,datum,UNIX_TIMESTAMP(datum) AS datum_timestamp FROM novinky WHERE typ=1 ORDER BY datum ASC LIMIT 0,2";
	$result = dotaz_db($query);

	$class = "class=\"left\"";
	
	while($row = mysql_fetch_assoc($result)) {
		echo "<div {$class}>";
		echo "<h2>" . $row['nadpis'] . "</h2>";
		echo "<p>" . $row['podnadpis'] . "</p>";
		echo "<p>" . date('d.m.Y',$row['datum_timestamp']) . " <a href=\"" . URL . "aktualni_informace?nav=detail&id=" . $row['id'] . "\">zobrazit celou zprávu</a></p>";
		$class="class=\"right\"";
		echo "</div>";
	}
	echo "<div class=\"vice\"><a href=\"" . URL . "aktualni_informace" . "\">více...</a></div>";
	
	/*
	<div class="left">
		<h2>AKTUÁLNÍ INFORMACE</h2>
		<p><span>Uvedení prototypu detektoru emocí</span> Maecenas ullamcorper tellus ut enim dignissim ortis.</p>
		<p>12.7.2011 <a href="">zobrazit celou zprávu</a></p>
	</div>
		
	<div class="right">
		<h2>AKTUÁLNÍ INFORMACE</h2>
		<p><span>Uvedení prototypu detektoru emocí</span> Maecenas ullamcorper tellus ut enim dignissim ortis.</p>
		<p>12.7.2011 <a href="">zobrazit celou zprávu</a></p>
	</div>
	*/
				
	echo "</div>";
}

/**
 *Funkce pro vykresleni submenu v zavislosti na strance 
 *@param - nazev podstranky z menu
 *@param - nazev podstranky z submenu
 */
function vykresli_submenu($model,$nav) {
	global $submenu;
	
	echo "<div class=\"submenu\"><ul>";
	
	foreach($submenu[$model] as $key => $value) {
		$adresa = URL . "{$model}?nav={$key}";
		if ($key == $nav) {
			$class = "class=\"active\"";
		} else {
			$class = "";
		}
		echo "<li><a href=\"{$adresa}\" {$class}>{$value}</a></li>";
		if($class != "") {
			echo "<li>";
			
			echo <<<ABC
				<ul>
 					<li>
 						<a href="">aktuálně</a>
 					</li>
 					<li>
 						<a href="">členové</a>
 					</li>
 					<li>
 						<a href="">laboratoře</a>
 					</li>
 					<li>
 						<a href="">projekty</a>
 					</li>
 				</ul>		
ABC;
			
			
			echo "</li>";
		}
		
	}
	
	echo "</ul></div>";
	
	if($model == 'vyzkum') {
		$adresa = URL . "{$model}?nav=informace_pro_firmy"; 
		echo "<div class=\"submenu\"><ul><li><a href=\"{$adresa}\">Informace pro firmy</a></li></ul></div>";
	}
}

/**
 * funkce pro zobrazeni navigace 
 */
function vykresli_navigaci($model="",$nav="") {
	global $menu,$submenu;	

	$cesta = URL;
	$navigace = "<a href=\"{$cesta}\">Úvod</a>";
	
	if($model != "") {
		$cesta .= $model;
		$count = count($menu);
		for($i = 0; $i < $count; $i++) {
			if($menu[$i]['model'] == $model) {
				$navigace .= " &gt; <a href=\"{$cesta}\">" . $menu[$i]['name'] . "</a>";
				break;
			}
		}
	}
	
	if($nav != "") {
		$cesta .= "?nav=".$nav;
		$navigace .= " &gt; <a href=\"{$cesta}\">" . $submenu[$model][$nav] . "</a>";
	}
	
	echo $navigace; 
}
