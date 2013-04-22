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
	
	$table = '';
	
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

	
	$valid_elements = array('id','jmeno','plat','telefon','email','www','platova_trida');
	
	$parser = new Xml_Parser('xml.xml', 'PERSONS', array('person'),$valid_elements);
	
	//$parser->process();
	
	//$parser->processDb($config,$table);
	
	echo $parser;
	
	
	
?><!doctype html>
<html>
	<head></head>
	<body>
		<a href="<?= $nazev ?>.xml">Soubor XML</a>
	</body>
</html>

	
	
	