<?php

	header("Content-type: text/html; charset=utf-8");

	function __autoload($class) {
		include str_replace("_","/",$class) . ".php";
	}

	$config = array(
			"user"=>"honza",
			"db_name"=>"xml",
			"pass"=>"test",
			"server"=>"localhost",
			"encoding"=>"utf-8"
	);
	
	$list = array();
	$nazev = 'xml';

	$database = Database::getInstance($config);
	
	$header = '<?xml version="1.0" encoding="utf-8"?><PERSONS></PERSONS>';
	
	$result = $database->query("SELECT * FROM person");
	
	while($row = mysql_fetch_assoc($result)) {
		$list[] = $row;
	}
	
	$xml = new Xml_Writer($header);
	
	$xml->createXml($list, $nazev,'person');
	
// xml parser
//TODO: vubec nefunguje, doma dodelat!
	$tmp = new XMLReader();
	if(!$tmp->open('xml.xml')) {
		echo 'Error open!<br/>';
	}
	
	$arr = array();
	$root = "PERSONS";
	$part = "person";
	
	
	function getArrTwo(&$tmp,&$arr) {
		
		while($tmp->read()) {
			
			if($tmp->nodeType == XMLReader::END_ELEMENT) {
				return;
			} elseif($tmp->nodeType == XMLReader::ELEMENT) {
				$arr[] = $tmp->name;
				getArrTwo($tmp,$arr[]);
			} elseif($tmp->nodeType == XMLReader::TEXT || $tmp->nodeType == XMLReader::NONE) {
				$arr[] = $tmp->value;
			}
			
			
		}
		
		
	}
	
	
	
	
	function getArr($tmp,&$arr,$key = NULL) {
		global $root,$part;
		$i = 0;
		while($tmp->read()) {
			
			if($tmp->nodeType == XMLReader::END_ELEMENT) {
				return;
				
			} elseif($tmp->nodeType == XMLReader::ELEMENT) {
				if($key == NULL) {
					var_dump($arr);
					getArr($tmp, $arr,$i);
				} elseif($tmp->name == $part || $tmp->name == $root ) {
					getArr($tmp, $arr[$key],$i);
				} else {
					getArr($tmp, $arr[$key],$tmp->name);
				}
				$i++;
			} elseif($tmp->nodeType == XMLReader::TEXT || $tmp->nodeType == XMLReader::NONE) {
				$arr[$key] = $tmp->value;
			}
		}
	}
	
	//getArr($tmp,$arr);
	getArrTwo($tmp,$arr);
	
	echo "<pre>";
	var_dump($arr);
	echo "</pre>";
	
// konec	
	
?><!doctype html>
<html>
	<head></head>
	<body>
		<a href="<?= $nazev ?>.xml">Soubor XML</a>
	</body>
</html>

	
	
	