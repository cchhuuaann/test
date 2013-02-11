<?php
	$a = 5;
	$b = 3;
	$c = 2;
	
	function soucet($a,$b) {
		global $c;
		static $d = 0;
		
		$d += $c;
		
		echo $d;
		
		return $a+$b+$c;
	}
	
	$a = soucet($a,$b);
	echo " >> ".$a."<br />";
	
	$a = soucet($a,$b);
	echo " >> ".$a."<br />";
	
	$a = soucet($a,$b);
	echo " >> ".$a."<br />";
	
	function funkce($a) {
		static $e = 0;
		$e += $a;
		return $e;
	}
	
	funkce(5);
	$c = funkce(6);
	var_dump($c);
	
	echo "<br />";
	
	function recursion($z) {
		if ($z < 20) {
			echo "$z<br />";
			recursion($z + 1);
		}
		
		return;
	}
	
	recursion(1);