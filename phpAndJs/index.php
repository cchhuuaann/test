<?php
	session_start();
	header("Content-Type: text/html; Charset=utf-8");

	require ('config.php');
	require('funkce.php');
	require('db.php');
	
	if (isset($_GET['nav']) && in_array($_GET['nav'], $povolene_akce)) {
		$nav = $_GET['nav'];
	} else {
		$nav = $povolene_akce[0];
	}

	require("{$nav}.php");