<?php

	class logging {
		private static $instance;
		private $zprava;
		
		private function __construct() {
			;
		}
		
		private function __clone() {
			;
		}
		
		function __wakeup() {
			throw new Exception("Serializace neni podporovana");
		}
		
		static function getInstance() {
			if(!isset(self::$instance)) {
				self::$instance = new self;
			}
			
			return self::$instance;
		}
		
		function log($message) {
			$this->zprava = $message;
		}
		
		public function vypisZpravu() {
			echo $this->zprava;
		}
	}
	
	$logging = logging::getInstance();
	$logging->log("Zprava je jen a jen jedna.");
	$logging->vypisZpravu();
	