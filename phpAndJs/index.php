<?php
	session_start();
	header("Content-Type: text/html; Charset=utf-8");	
	
	require('common/config.php');
	require('common/db.php');
	require('common/funkce.php');
	
	if (isset($_GET['model']) && in_array($_GET['model'], array_keys($povolene_akce) ) ) {
		$model = $_GET['model'];
	} else {
		$model = $vychozi_model;
	}
	
	if (isset($_GET['nav']) && in_array($_GET['nav'], $povolene_akce[$model])) {
		$nav = $_GET['nav'];
	} else {
		$nav = $povolene_akce[$model][0];
	}
	
	require("actions/{$model}/{$nav}.php");