<?php
	header("Content-Type: text/plain; Charset=utf-8");
	
	$a = 1; $b = 2; $c = 3;
	
	var_dump($a == 1 && $b == 1); //false
	var_dump($a == 1 || $b == 1); //true
	var_dump(!($a == 1) || !($c == 3) || ($b > 1)); //true
	
	if ($a == 2) {
		echo 2;
	} else if ($a == 1) {
		echo 1;
	} else {
		echo 'nic';
	}
	
	echo "\n";
	
	$a = true;
	
	switch ($a) {
		case 1:
			echo "je to 1\n";
			//break;
		case 'abc':
			echo "nebo abc\n";
			break;
		case 2:
			echo "je to 2\n";
			break;
		case 3:
			echo "je to 3\n";
			break;
		default:
			echo "je to jina hodnota\n";
	}
	
	echo "\n\n";
	
	for ($i=0; $i<10; $i = $i + 2) {
		echo $i . "\n";
	}
	
	echo "\n";
	
	$arr = array('priklad 1','test 2','exam 3');
	
	for ($i = 0; $i < count($arr); $i++) {
		echo current($arr)."\n";
		$arr[$i] = $arr[$i]."-test";
		next($arr);
	}
	echo "\n";
	
	foreach ($arr as $key => $value) {
		echo "klic = $key, hodnota = $value\n";
		$arr[$key] .= "-test";
	}
	
	foreach ($arr as $key => $value) {
		echo "klic = $key, hodnota = $value\n";
	}
	echo "\n";
	
	$a = 0;  // dulezite: promenna do podminky by mela existovat
	while ($a < 10) {  // samotna podminka
		echo "stále platí pro a=" . $a . "\n";
		$a++;  // pokud zakomentujeme, smyčka bude nekonečná
	}
	echo "\n";
	
	$arr = Array('jedna',2,'tri',false,'5',6,true,'osm',9);
	
	//Priklad
	function vypis_pole(array $array) {
		
		foreach ($array as $value) {
			
			if (is_numeric($value)) {
				continue;
			} else if (is_string($value)) {
				echo "$value\n";
			} else if ($value === true) {
				break;
			}
		}
		return;
	}

	vypis_pole($arr);
	
	$pole = Array(
			'ahoj',
			'zdar',
			Array(
					'A',
					'B',
					'C'
					),
			'cau',
			'zdar'
			);
	
	function vypis_vn_pole(array $array) {
	
		foreach ($array as $key => $value) {

			if (is_array($value)) {
				vypis_vn_pole($value);
			} else {
				echo "$key => $value\n";
			}
		}
		return;
	}
	
	vypis_vn_pole($pole);
	
	$tmp = array_search('zdar', $pole); //vypise index pole kde se nachazi prvni hledany vyraz
	var_dump($tmp);
	
	$tmp = array_keys($pole,'zdar'); //vypise v poli indexy kde vsude se nachazi hledany vyraz
	var_dump($tmp);
	
	$tmp = array_key_exists(5, $pole); //zjisti zda dany klic v poli existuje
	var_dump($tmp);
	
	$tmp = isset($pole); //zjisti zda je promenna nastavena
	var_dump($tmp);
/*	
	vypis_vn_pole($arr);
	$tmp = array_flip($arr); // prohodi klice a hodnoty a vrati nove pole
	vypis_vn_pole($tmp);
*/	
	$arr2 = Array('1a','2a','klic' => '10a');
	
	$tmp = array_merge($arr, $arr2); //slouci pole, pripojuje na konec ($arr2 na konec $arr)
	vypis_vn_pole($tmp);
	
	$tmp = sort($arr2);
	var_dump($tmp);
	vypis_vn_pole($arr2);
	
	$tmp = natsort($arr2);
	var_dump($tmp);
	vypis_vn_pole($arr2);
	
	$tmp = array_pop($arr2);
	var_dump($tmp);
	vypis_vn_pole($arr2);
	
	$tmp = array_push($arr2,'14a','18a','25a');
	var_dump($tmp);
	vypis_vn_pole($arr2);
	
	$tmp = array_shift($arr2);
	var_dump($tmp);
	vypis_vn_pole($arr2);
	
	$tmp = array_unshift($arr2, '3a', '4a');
	var_dump($tmp);
	vypis_vn_pole($arr2);
	
	
	
	
	
	