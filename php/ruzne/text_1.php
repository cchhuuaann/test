<?php
	header("Content-Type: text/plain; Charset=utf-8");
	
	$a = "hello ";
	$b = $a . "word!\n";
	
	$a = 'hello ';
	$a .= 'word!\n';
	
	var_dump($a, $b);
	
	$a = '12345';
	$b = Array('a', 'b');
	
	// Funguje OK:
	//echo "qwe{$a}rty";
	//echo "qwe{$b[0]}" . $a . "rty";
	
	// Funguje jinak než by se zdálo:
	//echo 'qwe{$a}rty';
 	//echo "qwe$arty";
	
	//$var = "test";
	
 	//echo "$var";
	
	//echo "\$var";
	
 	//echo '$var';
	
	$var = 3;
	
	echo "Result: " . ($var + 3) . "\n";
	
	echo 'a'.
	$c = 'x';
	echo 'b';
	echo 'c';
	
	$obsah = '"<';
	
	echo "<div class=\"test\">$obsah</div>";

	mb_internal_encoding("UTF-8");
	
	var_dump(strlen("ěš"));