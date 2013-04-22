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
	
	$validators = array(
			'id'=>array(new Xml_Parser_Row_Validator_Preg_IntNumber()),
			'jmeno'=>array(new Xml_Parser_Row_Validator_Preg_String()),
			'plat'=>array(new Xml_Parser_Row_Validator_Preg_IntNumber()),
			'telefon'=>array(new Xml_Parser_Row_Validator_Preg_IntNumber()),
			'email'=>array(new Xml_Parser_Row_Validator_Preg_Email()),
			'www'=>array(new Xml_Parser_Row_Validator_Preg_Http()),
			'platova_trida_id'=>array(new Xml_Parser_Row_Validator_Preg_IntNumber())
		);
	
	if(!empty($_FILES)) {
		$name = $_FILES['file']['tmp_name'];
	} else {
		$name = '';
	}
	
	
	/*
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
 	 */
	
	
	if(!empty($name)) {
		$valid_elements = array('id','jmeno','plat','telefon','email','www','platova_trida_id'/* =>array('allowed_values'=>array()) */);
		
		$parser = new Xml_Parser($name, 'PERSONS', array('person'),$valid_elements);
		
		$parser->addValidators($validators);
		
		$parser->process();
		
		//$parser->processDb($config,$table);
		
	}
	
	
?><!doctype html>
<html>
	<head></head>
	<style>
	body {
		width: 800px;
		margin: 0px auto;
		padding: 10px;
	}
	form {
		width: 300px;
	}
	table {
		margin: 10px auto;
		text-align: center;
	}
	td {
		margin: 5px;
		padding: 5px 10px;
	}
	.error {
		border: 1px solid red;
		background-color: #ff9999;
	}
	</style>
	<body>
		
		<form method="post" enctype="multipart/form-data">
			<fieldset>
				<div>
					<input name="file" type="file" />
				</div>
				<div>
					<input type="submit" name="submit" value="Zpracuj">
				</div>
			</fieldset>
		</form>
	
	
		<?= !empty($name)?$parser->getOutput():'' ?>
		<?php
			if(!empty($name)) {
				echo "<a href=" . $name . ">Soubor XML</a>";
			}
		?>	
	</body>
</html>

	
	
	