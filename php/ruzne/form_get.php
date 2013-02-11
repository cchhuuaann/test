<?php
	header("Content-Type: text/html; Charset=utf-8");
	
	$arr_vek = array(
			"0" => "vše",
			"_26" => "do 26 let",
			"26_35" => "26-34",
			"35_47" => "35-46",
			"47_60" => "47-59",
			"60_" => "60 a více"
		);
	
	$arr_vyplata = array(
			"0" => "vše",
			"_10000" => "do 10.000",
			"10000_20000" => "10.000-19.999",
			"20000_30000" => "20.000-29.999",
			"30000_" => "30.000 a více"
		);
	
	$arr_zazadal = array(
			"0" => "vše",
			"A" => "ano",
			"N" => "ne"
		);

	//zde detekujeme GET parametry
	
	$age = "0";
	if (isset($_GET['vek']) && isset($arr_vek[$_GET['vek']])) {
		$age = $_GET['vek'];
	}
	$money = "0";
	if (isset($_GET['vyplata']) && isset($arr_vyplata[$_GET['vyplata']])) {
		$money = $_GET['vyplata'];
	}
	$zadost = "0";
	if (isset($_GET['zazadal']) && isset($arr_zazadal[$_GET['zazadal']])) {
		$zadost = $_GET['zazadal'];
	}
	
	function vytvor_option($arr,$hodnota=""/*pri nezadani promenne se hodnota nastavi na ""*/) {
		foreach ($arr as $key => $value) {
			$selected = "";
			if ($key == $hodnota) {
				$selected = "selected=\"selected\"";
			}
			echo "<option value=\"{$key}\" {$selected}>{$value}</option>\n";
		}
	}
	
	function hodnota_neplati($zdroj,$podminka) {
		if ($podminka == "0") {
			return false;
		}
		
		$arr = explode("_", $podminka);
		
		$od=(int)$arr[0];
		$do=(int)$arr[1];
		$zdroj=(int)$zdroj;
		
		if (count($arr) == 2) {
			if (is_numeric($arr[0]) && is_numeric($arr[1])) {
				if (!($od <= $zdroj && $do > $zdroj )) {
					return true;
				}
			} else if (is_numeric($arr[0])) {
				if (!($od <= $zdroj)) {
					return true;
				}
			} else if (is_numeric($arr[1])) {
				if (!($do > $zdroj)) {
					return true;
				}
			}
		}
		
		return false;
	}
	
	$lines = file('hodnoty.txt');
	$hodnoty = array();
	
	foreach ($lines as $line) {
		$entries = explode(',', $line);
		if (count($entries) == 4) {
			$temp = array();
			$temp['jmeno'] = trim($entries[0]);
			$temp['vek'] = trim($entries[1]);
			$temp['vyplata'] = trim($entries[2]);
			$temp['zazadal'] = trim($entries[3]);
			$hodnoty[] = $temp;
			unset($temp);
		}
	}
?><!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
	</head>
	<body>
		<form action="form_get.php" method="get">
		<p>
			<label for="vek">věk</label>
			<select id="vek" name="vek" >
				<?= vytvor_option($arr_vek,$age)?>
			</select><br />
			<label for="vyplata">výplata</label>
			<select id="vyplata" name="vyplata" >
				<?= vytvor_option($arr_vyplata,$money)?>
			</select><br />
			<label for="zazadal">zažádal</label>
			<select id="zazadal" name="zazadal" >
				<?= vytvor_option($arr_zazadal,$zadost)?>
			</select><br />
			<input type="hidden" name="ahoj" value="<?= htmlspecialchars($_GET['ahoj']) ?>" />
			<input type="submit" />
		</p>
		</form>
		<table>
			<thead>
				<tr>
					<th>Jméno</th>
					<th>věk</th>
					<th>výplata</th>
					<th>zažádal</th>
				</tr>
			</thead>
			<tbody>
				<?php 
					foreach ($hodnoty as $radek) {
						if (hodnota_neplati($radek['vek'], $age)) {
							continue;
						}
						if (hodnota_neplati($radek['vyplata'], $money)) {
							continue;
						}
						if ($zadost != "0" && $radek['zazadal'] != $zadost) {
							continue;
						}
						echo "<tr>";
						echo "<td>{$radek['jmeno']}</td>";
						echo "<td>{$radek['vek']}</td>";
						echo "<td>{$radek['vyplata']}</td>";
						echo "<td>{$radek['zazadal']}</td>";
						echo "</tr>";
					}
				?>
			</tbody>
		</table>
		<br />
		<a href="form_get.php">Zobrazit bez filtru</a>
		<br />
		<pre>
<?php 
	$array = array();
	parse_str($_SERVER['QUERY_STRING'], $array);
	//var_dump($array);
	if (!isset($array['ahoj'])) {
		$array['ahoj'] = "5";
	}
	$parametry = http_build_query($array);
	//var_dump($parametry);
	
	$string = "http://zpravy.idnes.cz/nove-jednani-soudu-v-praze-5-o-bartovi-a-skarkovi-ftr-/domaci.aspx?c=A130123_080644_domaci_kop";
	echo $string.'<br />';
	var_dump(parse_url($string));
?>
		</pre>
		<br />
		<a href="form_get.php?<?= $parametry?>">Zobrazit s parametrem ahoj</a>
	</body>
</html>