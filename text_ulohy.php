<?php
	header("Content-Type: text/plain; Charset=utf-8");
	
	//uloha 1
	
	$text = " JAJ,RADAR";
	
	$text = strrev(trim($text));
	
	$arr = str_split(strtolower($text));
	
	$arr[0] = strtoupper($arr[0]);
	
	$text = implode("",$arr);
	
	var_dump($text);
	
	
	//uloha 2
	
	$orig = "Jdu \"si\" lesem a vidím <b>psa</b>";
	
	$orig = htmlspecialchars($orig,ENT_QUOTES,"utf-8");
	
	var_dump($orig);
	
	
	//uloha 3
	
	$id_nums = array(1,6,12,18,24);
	
	var_dump(implode(", ", $id_nums));
	
	
	//uloha 4
	
	$str = "ahoj;mam;fajn;den";
	
	$arr = explode(";", $str);
	
	var_dump($arr[1].$arr[2]);
	
	
	//uloha 5
	
	$a = 'ahoj';
	$b = 'Achojky';
	
	if (strnatcmp($a, $b) > 0) {
		echo "'$a' je vetsi nez '$b'";
	} else if (strnatcmp($a, $b) < 0) {
		echo "'$b' je vetsi nez '$a'";
	} else {
		echo "'$a' a '$b' jsou stejne";
	}
	
	echo "\n\n";
	
	
	//uloha 6
	
	$arr = Array(
			'Tajemník prezidenta Ladislav Jakl se v neděli pro Novinky vyjádřil k informacím, že on, státní zástupce Zdeněk Koudelka a právník Pavel Hasenkopf měli být těmi, kdo pro prezidenta Václava Klause připravili amnestii.',
			'Není pravdou, že amnestii připravovala trojice Jakl, Hasenkopf, Koudelka.',
			'Podíl na přípravě amnestie odmítl podle ministra spravedlnosti Pavla Blažka i Koudelka.',
			'Zhodnoťte své úspory nyní s výhodným úrokem 2,5 % p.a. na prvních 5 měsíců',
	);
	
	foreach ($arr as $retezec) {
		var_dump(str_word_count($retezec,0,'ěščřžýáíéúů.,'));
	}
	
	echo "\n";
	
	$tmp = count($arr);
	for ($i = 0; $i < $tmp; $i++) {
		var_dump(str_word_count($arr[$i],0,'ěščřžýáíéúů.,'));
	}
	
	
	
	
	
	
	
	
	
	
	