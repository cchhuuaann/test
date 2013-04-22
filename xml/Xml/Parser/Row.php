<?php
	class Xml_Parser_Row {
		private $items = NULL;
		
		/**
		 * Funkce zkontroluje validitu vsech prvku v $items
		 * @return boolean
		 */
		public function isValid() {
			$valid = true;
			
			foreach($this->items as $val) {
				if(!$val->isValid()) {
					$valid = false;
				}
			}
			
			return $valid;
		}
		
		/**
		 * Funkce nahraje data do jednotlivych prvku
		 * @param Array $data: Associativni pole, index = sloupec 
		 */
		public function populate($data) {
			
			foreach($data as $key => $val) {
				if(array_key_exists($key, $this->items)) {
					$this->items[$key]->populate($val);
				}
			}
		}
		
		/**
		 * nastaveni objektu pri klonovani
		 */
		public function __clone() {
			foreach($this->items as $key => $val) {
				$this->items[$key] = clone $val;
			}
		}
		
		/**
		 * Funkce vytvori novy objekt Item a prida ho nakonec pole $items
		 * @param String $name
		 * @param Array $validators: pole objektu validatoru
		 */
		public function registerItem($name,$validators = NULL) {
			$this->items[$name] = new Xml_Parser_Row_Element();
			if(!empty($validators)) {
				if(is_array($validators)) {
					$this->items[$name]->addValidators($validators);
				} else {
					$this->items[$name]->addValidator($validators);
				}
			}
		}
		
		/**
		 * Funkce nastavujici validatory jednotlivym prvkum
		 * @param array $arr
		 */
		public function addValidators($arr) {
			foreach($arr as $key => $val) {
				$this->items[$key]->addValidators($val);
			}
		}
		
		/**
		 * Funkce zjistujici existenci chyby na radku 
		 * @return boolean
		 */
		public function hasError() {
			foreach($this->items as $val) {
				if($val->hasError()) {
					return true;
				}
			}
			
			return false;
		}
		
		/**
		 * Funkce vykresli radek tabulky
		 * @param boolean: pokud je false,
		 * vykresli info pred radek
		 * @return string
		 */
		public function draw($error) {
			$row = '<tr>';
			
			if(!$error) {
				$tmp = $this->items['id']->getValue();
				if(empty($tmp)) {
					$info = 'vlozeno';
				} else {
					$info = 'upraveno';
				}
				
				$row .= "<td>{$info}</td>";
			}
			
			foreach($this->items as $val) {
				$row .= $val->draw();
			}
			
			$row .= "</tr>\n";
			
			return $row;
		}
		
	}