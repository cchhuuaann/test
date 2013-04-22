<?php
	class Xml_Parser_Row_Element {
		private $value = '';
		private $validators = array();
		
		private $hasError = false;
		private $errors = array();		
		
		/**
		 * Funkce vracejici hodnotu objektu
		 * @return String
		 */
		public function getValue() {
			return $this->value;
		}
		
		/**
		 * Funkce ulozi promenou $data do prvku
		 * @param String $data
		 */
		public function populate($data) {
			$this->value = $data;
		}
		
		/**
		 * Funkce otestuje validitu
		 * hodnoty prvku na vsech
		 * nahranych validatorech
		 * @return boolean
		 */
		public function isValid() {
			
			foreach($this->validators as $val) {
				if(!$val->isValid($this->value)) {
					$this->hasError = true;
					$this->errors[] = $val->getErrorMessage();
				}
			}
			
			if($this->hasError) {
				return false;
			} else {
				return true;
			}
		}
		
		/**
		 * Funkce vracejici true/false, jestli validace byla v poradku nebo ne
		 * @return: bool
		 */
		public function hasError() {
			if(empty($this->errors)) {
				return false;
			} else {
				return true;
			}
		}
		
		/**
		 * Funkce prida validator na konec pole $validators
		 * @param object $validator
		 */
		public function addValidator($validator) {
			$this->validators[] = $validator;
		}
		
		/**
		 * Funkce prida pole validatoru pole $validators
		 * @param array $arr: pole validatoru
		 */
		public function addValidators($arr) {
			$this->validators = array_merge($this->validators, $arr);
		}
		
		/**
		 * Funkce vykresli element(bunku) tabulky
		 * @return string
		 */
		public function draw() {
			
			$this->hasError()?$class = 'class="error"':$class = '';
			
			return "<td {$class}>{$this->value}</td>";
		}
		
	}