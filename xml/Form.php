<?php

	class Form {
		private $items = array();
		private $groups = array();
		
		
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
			$return = true;
			
			foreach($this->items as $key => $value) {
				if(isset($post[$key])) {
					
					if(!$value->isValid($post[$key])) {
						$return = false;
					}
					
				} else {
					
					if(!$value->isValid($post[$key] = '')) {
						$return = false;
					}
					
				}
			}
			
			return $return;
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
		 * @return - object/false podle podarilo/nepodarilo
		 */
		public function registerItem($name, $item) {
			
			if(!array_key_exists($name, $this->items)) {
				$this->items[$name] = $item;
				$this->items[$name]->setAtributes(array('name'=>$name));
				if($item->getLabel() == NULL) {
					$this->items[$name]->setAtributes(array('label'=>$name));
				}
				return $item;
			} else {
				return false;
			}
			
		}
		
		/**
		 * Funkce vraci objekt prvku formulare
		 * @param String $name: nazev prvku
		 * @return Object: prvek formulare
		 */
		public function getItem($name) {
			return $this->items[$name];
		}
		
		/**
		 * Funkce prida novou skupinu prvku formulare
		 * @param String $name - nazev skupiny
		 * @param Array $elements - nazvu prvku
		 */
		public function addGroup($name, $elements) {
			if(isset($this->groups[$name])) {
				$this->groups[$name] = array_merge($elements,$this->groups[$name]);
			} else {
				$this->groups[$name] = $elements;
			}
		}
		
		/**
		 * Funkce vraci pole objektu prvku ktere patri do skupiny
		 * @param String $name - nazev skupiny
		 * @return Array - pole objektu prvku formulare
		 */
		public function getGroup($name) {
			$arr = array();
			foreach($this->groups[$name] as $val) {
				$arr[] = $this->items[$val];
			}
			
			return $arr;
		}
	}
