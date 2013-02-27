<?php

define('URL','http://test/phpAndJs/');
define('JS_VERSION_STRING','0.3');

$per_page = 4;

$vychozi_model = "zamestnanec";

$povolene_akce = array(
			"zamestnanec" => array("list","edit","delete","tabulka_jx","get_pobocky_jx"),
			"firma" => array("list","edit","delete","tabulka_jx"),
			"pobocka" => array("list","edit","delete")
		);

$menu = array(
	array(
		"name" => "seznam zaměstnanců",
		"model" => "zamestnanec",
		"action" => "list",
		"params" => array()
	),
	array(
		"name" => "vložení zaměstnance",
		"model" => "zamestnanec",
		"action" => "edit",
		"params" => array()		
	),
	array(
		"name" => "seznam firem",
		"model" => "firma",
		"action" => "list",
		"params" => array()
	),
	array(
		"name" => "vložení firmy",
		"model" => "firma",
		"action" => "edit",
		"params" => array()
	),
	array(
		"name" => "seznam poboček",
		"model" => "pobocka",
		"action" => "list",
		"params" => array()
	),
	array(
		"name" => "vložení pobočky",
		"model" => "pobocka",
		"action" => "edit",
		"params" => array()
	)
);

$arr_zazadal = array(
		"v" => "vše",
		"1" => "ano",
		"0" => "ne"
);

$arr_vek = array(
		"0" => "vše",
		"_26" => "do 26 let",
		"26_35" => "26-34",
		"35_47" => "35-46",
		"47_60" => "47-59",
		"60_" => "60 a více"
);

$arr_vyplata = array(
		"0" => "vše",
		"_10000" => "do 10.000",
		"10000_20000" => "10.000-19.999",
		"20000_30000" => "20.000-29.999",
		"30000_" => "30.000 a více"
);

$arr_razeni = array(
		"id",
		"name",
		"nazev"
);
