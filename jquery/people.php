<?php
	header('Content-Type: application/json; charset=utf-8');
	//header('Content-Type: text/html; charset=utf-8');

	if(isset($_GET['name'])) {
		echo json_encode('jmeno: '.$_GET['name'].', prijmeni: '.$_GET['surname'].', vek: '.$_GET['age']);
	} else {
		echo json_encode('no');
	}
	
	exit;
