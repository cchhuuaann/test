<?php

	header("Content-Type: text/plain-text; Charset=utf-8");

	function handle_error($errno, $errstr, $errfile, $errline) {
		
		switch($errno) {
			case E_USER_ERROR:
				$errNazev = "ERROR";
				break;
			case E_USER_WARNING:
				$errNazev = "WARNING";
				break;
			case E_USER_NOTICE:
				$errNazev = "NOTICE";
				break;
			default:
				$errNazev = "UNKNOWN";
		}
		echo "PHP " . $errNazev . " [" . $errno . "]: \n";
		echo "file " . $errfile . ": line " . $errline . " Chyba: " . $errstr;
		return true;
	}
	
	function exception_handler($exception) {
		var_dump($exception);
		echo "PHP Exception: \n";
		echo "file " . $exception->getFile() . ": line " . $exception->getLine() . " Chyba: " . $exception->getMessage();
		
	}
	
	set_error_handler('handle_error');
	set_exception_handler('exception_handler');

	echo $pokus;
	//throw new Exception("Pokusny Exception");
	
	
	

