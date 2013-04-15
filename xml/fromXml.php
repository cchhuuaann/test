<?php

	header("Content-type: text/html; charset=utf-8");

	function __autoload($class) {
		include str_replace("_","/",$class) . ".php";
	}
	
	$xml= simplexml_load_file('list.xml');
	
	echo $xml->getName() . "<br />";
	
	foreach($xml->children() as $person) {
		echo "<br />" . $person->getName() . "<br />";
		foreach($person->children() as $val) {
			echo $val->getName() . ": " . $val . "<br />";
		}
	}
	
	