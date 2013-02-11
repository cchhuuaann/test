<?php
	header("Content-Type: text/plain; Charset=utf-8");
	
	$array1 = array(
			1 => "1",
			2 => 1,
			3 => "ahoj",
			4 => "ahoj"
	);
	
	var_dump(array_search(1, $array1, true));
	
	//var_dump(array_keys())
	
	
	