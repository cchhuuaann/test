<?php

	header("Content-type: text/xml; charset=utf-8");

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

	$database = Database::getInstance($config);
	
	$xml = new SimpleXMLElement('<?xml version="1.0" encoding="utf-8"?><TABLE></TABLE>');
	
	$result = $database->query("SELECT * FROM person");
	
	while($row = mysql_fetch_assoc($result)) {
		$list[] = $row;
	}
	
	if(count($list)) {
		foreach($list as $val) {
			$person = $xml->addChild('PERSON');
			$person->addChild('ID',$val['id']);
			$person->addChild('JMENO',$val['jmeno']);
			$person->addChild('PLAT',$val['plat']);
			$person->addChild('TELEFON',$val['telefon']);
			$person->addChild('EMAIL',$val['email']);
			$person->addChild('WWW',$val['www']);
		}
	}
	
	if(file_exists('list.xml')) {
		unlink('list.xml');
	}
	$xml->saveXML('list.xml');
	
	include 'list.xml';
	
	
	