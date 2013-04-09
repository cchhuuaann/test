<?php

	class Form {
		
		private $items = array();
		
		
		public function __construct() {
			;
		}
		
		public function __toString() {
			return false;
		}
		
		
		/**
		 * Funkce pro overeni validity odeslaneho formulare
		 * @param $post - pole vsech hodnot na overeni
		 * @return - true/false validni/nevalidni 
		 */
		public function isValid($post) {
			foreach($post as $key => $value) {
				$this->items[$key]->isValid($value);
			}
		}
		
		/**
		 * Funkce pro naplneni formulare hodnotama
		 * @param Array $values - pole hodnot, kterymi se naplni formularove prvky atributy "value" array('jmeno prvku'=>'hodnota value')
		 * @return
		 */
		public function populate($values) {
			foreach($values as $key => $value) {
				$this->items[$key]->populate($value);
			}
		}
		
		/**
		 * Funkce pro vytvoreni noveho formularoveho prvku a pridani do pole prvku v Form 
		 * @param String $name - jmeno noveho formularoveho prvku
		 * @param Object $item - objekt typu formularoveho prvku text/password/select/checkbox/textarea/radio
		 * @return - true/false podle podarilo/nepodarilo
		 */
		public function registerItem($name, $item) {
			
			if(!array_key_exists($name, $this->items)) {
				$this->items[$name] = $item;
				$this->items[$name]->setAtributes(array('name'=>$name));
				$this->items[$name]->setAtributes(array('label'=>$name));
				return true;
			} else {
				return false;
			}
			
		}
		
		
		
		/**
		 * Funkce pro vykresleni celeho formulare
		 * @return
		 */
		public function draw() {
			echo "<form method='post'>";
			foreach($this->items as $value) {
				echo "<div>";
				$value->draw();
				echo "</div>";
			}
			echo "</form>";
		}
		
		
		
	}
