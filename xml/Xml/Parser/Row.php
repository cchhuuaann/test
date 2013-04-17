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
				$item[$key]->populate($val);
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
		 * TODO
		 */
		public function hasError() {
			
		}
		
		/**
		 * Funkce vykresli radek tabulky
		 * @return string
		 */
		public function draw() {
			$row = '<tr>';
			
			foreach($this->items as $val) {
				$row .= $val->draw();
			}
			
			$row .= '</tr>';
			
			return $row;
		}
		
		
	}