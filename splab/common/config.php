<?php

define('URL','http://splab/');
define('JS_VERSION_STRING','0.1');

$vychozi_model = "uvod";

$povolene_akce = array(
			"uvod" => array("show"),
			"vyzkum" => array("show"),
			"studium" => array("show"),
			"spoluprace" => array("show"),
			"kontakty" => array("show"),
			"projekt" => array("show")
		);

$menu = array(
	array(
		"name" => "Úvod",
		"model" => "uvod",
		"action" => "show"
	),
	array(
		"name" => "Výzkum",
		"model" => "vyzkum",
		"action" => "show"	
	),
	array(
			"name" => "Studium",
			"model" => "studium",
			"action" => "show"
	),
	array(
		"name" => "Spolupráce",
		"model" => "spoluprace",
		"action" => "show"
	),
	array(
		"name" => "Kontakty",
		"model" => "kontakty",
		"action" => "show"
	),
	array(
		"name" => "Projekt OPVK",
		"model" => "projekt",
		"action" => "show"
	)
);
