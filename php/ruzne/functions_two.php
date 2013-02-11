<?php
header("Content-Type: text/plain; Charset=utf-8");
	
function prvni($a,$b,$c) {
	$tmp = ($a + $b) * $c;
	
	return $tmp;
}

function druhy($arg) {
	static $tmp = 0;
	$tmp++;
	
	echo $tmp." ".$arg."\n";
	
	return;
}

var_dump(prvni(1, 2, 3));
echo "\n";

druhy("oko");
druhy("oko");
druhy("oko");