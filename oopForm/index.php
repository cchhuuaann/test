<?php

	//header("Content-Type: text/Plain-Text; Charset=utf-8");
	header("Content-Type: text/html; Charset=utf-8");

	function __autoload($class) {
		include str_replace("_","/",$class) . ".php";
	}
	
	$hotovo = NULL;
	
	$auto = array(
		'1'=>'Saab',
		'2'=>'Volvo'
	);
	$pohlavi = array(
		'1'=>'Muž',
		'2'=>'Žena'
	);
	$souhlasim = array(
		'1'=>'Souhlasím s podmínkama'
	);
	
	
	$form = new Form;
	
	$prvky = array(
		$form->registerItem('jmeno', new Form_Item_Text(true, array('label'=>'Jméno: ') )),
		$form->registerItem('email', new Form_Item_Text(true, array('label'=>'Email: ') )),
		$form->registerItem('heslo', new Form_Item_Password(true, array('label'=>'Heslo: ') )),
		$form->registerItem('pohlavi', new Form_Item_Select(true, array('label'=>'Pohlaví: ','multioptions'=>$pohlavi,'multiple'=>'multiple') )),
		$form->registerItem('auto', new Form_Item_Select(false, array('label'=>'Auto: ','multioptions'=>$auto,'multiple'=>'multiple') )),
		$form->registerItem('poznamky', new Form_Item_TextArea(false, array('label'=>'Poznámky: ') )),
		$form->registerItem('souhlasim', new Form_Item_Radio(true, array('label'=>'Souhlasím: ','multioptions'=>$souhlasim) )),
		$form->registerItem('miniverze', new Form_Item_CheckBox(false, array('label'=>'Miniverze: ') ))
	);
	
	if(!empty($_GET)) {
		if($form->isValid($_GET)) {
			$hotovo = true;
		} else {
			$form->populate($_GET);
			$hotovo = false;
		}
	}

?><!doctype html>
<html>
	<head>
		<title></title>
	</head>
	<body>
	<?php 
		if(isset($hotovo) && $hotovo) {
			echo "<h2>Formular je odeslan a validni</h2>";
		}
	?>
		<form method="get">
			<fieldset>
				<legend>Vyplnit</legend>
	<?php
	
		foreach($prvky as $value) {
	
			echo "<div>";
				
			if($value->hasError()) {
				foreach($value->getErrors() as $val) {
					echo "<p>" . $val . "</p>";
				}
			}
			$value->draw();
				
			echo "</div>";
		}
	?>
				<input type="submit" value="OK" />
			</fieldset>
		</form>
	</body>
</html>
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	