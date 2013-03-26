<?php

define('URL','http://splab/');
define('JS_VERSION_STRING','0.1');

$vychozi_model = "uvod";

$povolene_akce = array(
			"uvod" => array("index"),
			"vyzkum" => array("index"),
			"studium" => array("index"),
			"spoluprace" => array("index"),
			"kontakty" => array("index"),
			"projekt" => array("index")
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

$submenu = array(
	"vyzkum" => array(
		"data" => "Data-mining",
		"interakce" => "Interakce člověk-stroj",
		"neortogonalni" => "Neortogonální reprezentace signálů",
		"zpracovani_ak" => "Zpracování akustických signálů",
		"zpracovani_med" => "Zpracování medicínských signálů"
	),
	"studium" => array(
		"predmety" => "Předměty",
		"laboratore" => "Laboratoře",
		"zavercne" => "Závěrečné práce",
		"vybrane" => "Vybrané práce studentů",
		"tutorialy" => "Tutoriály",
		"dulezite" => "Důležité odkazy"
	),
	"kontakty" => array(
		"clenove" => "členové SPLabu",
		"loga" => "Loga ke stažení"
	)
);



































