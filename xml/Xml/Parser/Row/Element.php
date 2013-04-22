<?php
	class Xml_Parser_Row_Element {
		private $value = NULL;
		private $validators = array();
		
		private $hasError = false;
		private $errors = array();		
		
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
		
		public function addValidator() {
			;
		}
		
		public function addValidators() {
			;
		}
		
		public function draw() {
			
			$this->hasError()?$class = 'class="error"':$class = '';
			
			return "<td {$class}>{$this->value}</td>";
		}
		
		
		
	}