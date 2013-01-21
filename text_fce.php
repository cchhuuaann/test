<?php
	header("Content-Type: text/plain; Charset=utf-8");
	
	$a = "\t Jak se mas?\n";
	$b = "Ja se mam dobre.\t\n";
	
	echo 'a'.$a;
	echo $b.'b';
	echo "\n\n";

	echo 'a'.ltrim($a);	// ltrim - odstrani bile znaky na zacatku retezce
	
	echo rtrim($b).'b'; //rtrim -odstrani bile znaky z konce retezce
	
	echo "\n";
	echo trim($b).trim($a); //trim - odstrani bile znaky ze zacatku i konce retezce
	
	$tri = 3;
	$slovo = "hello";
	echo "\n";
	printf("%s word, today is %d",$slovo,$tri);
	
	echo "\n";
	print $a;
	
	echo "\n";
	$pmt = sprintf("%s word, today is %d",$slovo,$tri);
	echo $pmt;
	
	echo "\n".strrev($pmt); //strrev - string to reverse
	
	$pmt = strtoupper($pmt);
	echo "\n".$pmt." ".strtolower($pmt);
	
	echo "\n".wordwrap($pmt,6,"\t",true);
	
	echo "\n";
	print_r(get_html_translation_table());
	echo "\n";
	print_r(get_html_translation_table(HTML_SPECIALCHARS,ENT_QUOTES));
	
	$str = "Jane &amp; &#039;Tarzan&#039;";
	echo html_entity_decode($str, ENT_QUOTES);
	echo "\n";
	$str = "Jane & 'Tarzan'";
	echo htmlentities($str,ENT_QUOTES);
	
	$str = "<'&'>";
	$str = htmlspecialchars($str, ENT_QUOTES);
	echo "\n\n".$str;
	$str = htmlspecialchars_decode($str, ENT_QUOTES);
	echo "\n".$str."\n";
	
	echo chunk_split($pmt, 2, "->");
	echo"\n";
	$arr = str_split($pmt,5);
	var_dump($arr);
	
	$arr = explode("O", $pmt);
	var_dump($arr);
	var_dump(implode("A", $arr));
	
	$jedna = "abcijk";
	$dva = "abcxyz";
	var_dump(strcmp($jedna, $dva));
	var_dump(strnatcmp($jedna, $dva));
	var_dump(strncmp($jedna, $dva, 3));
	
	var_dump(substr($jedna, 3));
	var_dump(strlen($jedna));
	
	$retezec = "Mama Mele Maso";
	var_dump(strpos($retezec, "Mel"));
	var_dump(strrpos($retezec, "m"));
	var_dump(strstr($retezec, "mam"));
	
	var_dump(str_word_count($retezec,0));
	
	var_dump(strchr($retezec, "Mele"));
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	