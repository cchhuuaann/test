<?php
	session_start();
	
	require('common/config.php');
	require('common/funkce.php');
	
/*
 * prevod z LESS na CSS
 * - funguje pouze pokud style.css neexistuje nebo je starsi nez style.less
 */
	require('common/lessc.inc.php');
	
	$less = new lessc;
	$less->checkedCompile("less/style.less","css/style.css");
/*
 * konec prevodu
 */

	$frame_number = 1;
	
	$error = false;
	
	if(!isset($_GET['model'])) {
		$model = $vychozi_model;
		$nav = $povolene_akce[$model][0];
	} else if(in_array($_GET['model'], array_keys($povolene_akce))) {
		$model = $_GET['model'];
		$nav = $povolene_akce[$model][0];
	} else {
		$model = $_GET['model'];
		$error = true;
	}
	
	if($error) {
		header("HTTP/1.0 404 Not Found");
	} else {
		header("Content-Type: text/html; Charset=utf-8");
	}	
	
	require("frame/frame_{$frame_number}.php");
	