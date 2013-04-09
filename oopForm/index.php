<?php

	//header("Content-Type: text/plain-text; Charset=utf-8");

	function __autoload($class) {
		include str_replace("_","/",$class) . ".php";
	}
	
	$multioptions_arr = array(
		'1'=>'Saab',
		'2'=>'Volvo'
	);
	
	$populate_arr = array(
		'Text1'=>'textove pole 1',
		'Psswd1'=>'Pole pro heslo',
		'Check1'=>'hodnota',
		'Radio1'=>'2',
		'Select1'=>array(
			'2'		
		)
	);
	
	
	$form = new Form;
	
	//$check->addValidators(Array(new Form_Validate_String, ))
	
	$form->registerItem('Text1', new Form_Item_Text());
	$form->registerItem('Psswd1', new Form_Item_Password());
	$form->registerItem('Check1', new Form_Item_CheckBox());
	$form->registerItem('Radio1', new Form_Item_Radio(array('multioptions'=>$multioptions_arr)));
	$form->registerItem('Select1', new Form_Item_Select(array('multioptions'=>$multioptions_arr)));
	$form->registerItem('TextAr1', new Form_Item_TextArea(array('value'=>'ahoj')));
	
	$form->populate($populate_arr);
	
	$form->draw();
	
	
