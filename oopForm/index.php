<?php
$form = new Form;

$check = new CheckBox;
$check->addValidators(Array(new Form_Validate_String, ))

$form->registerItem($name, $check)

