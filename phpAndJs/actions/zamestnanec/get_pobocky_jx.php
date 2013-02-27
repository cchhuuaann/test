<?php

$firma = "";

if (isset($_GET['firma_id']) && is_numeric($_GET['firma_id'])) {
	$firma = $_GET['firma_id'];	
}
	
if($firma != "") {
	vytvor_option_db_multi('pobocka','nazev','zamestnanec',"", "WHERE t.firma_id = '{$firma}'");
}