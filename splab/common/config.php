<?php

define('URL','http://splab/');
define('JS_VERSION_STRING','0.1');


$frame_number = 1;

$vychozi_model = "uvod";
$nav = "";

$povolene_akce = array(
			"uvod" => array("index"),
			"vyzkum" => array("index","data-mining","interakce_clovek-stroj","neortogonalni_reprezentace_signalu","zpracovani_akustickych_signalu","zpracovani_medicinskych_signalu"),
			"studium" => array("index","predmety","laboratore","zaverecne_prace","vybrane_prace_studentu","tutorialy","dulezite_odkazy"),
			"spoluprace" => array("index"),
			"kontakty" => array("index","clenove_splabu","loga_ke_stazeni"),
			"projekt" => array("index"),
			"nadchazejici_akce" => array("index","detail"),
			"aktualni_informace" => array("index","detail")
		);

$menu = array(
	array(
		"name" => "Úvod",
		"model" => "uvod",
		"action" => "index"
	),
	array(
		"name" => "Výzkum",
		"model" => "vyzkum",
		"action" => "index"	
	),
	array(
		"name" => "Studium",
		"model" => "studium",
		"action" => "index"
	),
	array(
		"name" => "Spolupráce",
		"model" => "spoluprace",
		"action" => "index"
	),
	array(
		"name" => "Kontakty",
		"model" => "kontakty",
		"action" => "index"
	),
	array(
		"name" => "Projekt OPVK",
		"model" => "projekt",
		"action" => "index"
	)
);

$submenu = array(
	"vyzkum" => array(
		"data-mining" => "Data-mining",
		"interakce_clovek-stroj" => "Interakce člověk-stroj",
		"neortogonalni_reprezentace_signalu" => "Neortogonální reprezentace signálů",
		"zpracovani_akustickych_signalu" => "Zpracování akustických signálů",
		"zpracovani_medicinskych_signalu" => "Zpracování medicínských signálů"
	),
	"studium" => array(
		"predmety" => "Předměty",
		"laboratore" => "Laboratoře",
		"zaverecne_prace" => "Závěrečné práce",
		"vybrane_prace_studentu" => "Vybrané práce studentů",
		"tutorialy" => "Tutoriály",
		"dulezite_odkazy" => "Důležité odkazy"
	),
	"kontakty" => array(
		"clenove_splabu" => "členové SPLabu",
		"loga_ke_stazeni" => "Loga ke stažení"
	)
);



































