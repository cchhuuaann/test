<?php

	class Form {
		
		private $items = array();
		
		
		public function __construct() {
			;
		}
		
		
		/**
		 * Funkce pro overeni validity odeslaneho formulare
		 * @param $post - pole vsech hodnot na overeni
		 * @return - true/false validni/nevalidni 
		 */
		public function isValid($post) {
			;
		}
		
		/**
		 * Funkce pro naplneni formulare hodnotama
		 * @param Array $values - pole hodnot, kterymi se naplni formularove prvky atributy "value"
		 * @return
		 */
		public function populate($values) {
			;
		}
		
		/**
		 * Funkce pro vytvoreni noveho formularoveho prvku a pridani do pole prvku v Form 
		 * @param String $name - jmeno noveho formularoveho prvku
		 * @param item $item - typ formularoveho prvku text/password/select/checkbox/textarea/radio
		 * @return 
		 */
		public function registerItem($name, $item) {
			
			if(!array_key_exists($name, $this->items)) {
				$this->items[$name] =
			}
			
			
		}
		
		
		
		/**
		 * Funkce pro vykresleni celeho formulare
		 * @return
		 */
		public function draw() {
			;
		}
		
		
		
	}
