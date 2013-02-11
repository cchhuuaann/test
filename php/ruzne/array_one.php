<?php
	header("Content-Type: text/plain; Charset=utf-8");

	$array1 = array("one" => "bar","two" => "foo");
	
	$array2 = array(
			1 => "a",
			1.9 => "b",
			"1" => "c",
			true => "Its true"
			);
	
	$array3 = array(
			1 => "1",
			2 => 2,
			"a" => "a",
			"b"
			);
	
	$array4 = array(
			"d",
			"c",
			36 => "b",
			"a"
			);
	
	$array5 = array(
			1 => "a",
			2 => "b",
			3 => "c",
			4 => array(
					"a" => "A",
					"b" => "B",
					"c" => "C"
					)
			);
	
	function getArray() {
		return array(1,2,3);
	}
	
	$tmp = getArray();
	$seconfElement = $tmp[1];
	
	$arr[] = 1;
	$arr[] = 2;
	
	
	var_dump($array1);
	echo "\n";
	var_dump($array2);
	echo "\n";
	var_dump($array3);
	echo "\n";
	var_dump($array4);
	echo "\n";
	var_dump($array5[2]);
	var_dump($array5[4]["a"]);
	var_dump($array5[4]["c"]);
	echo "\n";
	var_dump($seconfElement);
	echo "\n";
	var_dump($arr);
	unset($arr[0]);
	var_dump($arr);
	unset($arr);
	var_dump($arr);
	echo "\n";
	
	
	