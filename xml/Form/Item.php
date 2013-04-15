<?php

	abstract class Form_Item {
		
		private $hasError = false;		
		private $errors = array();
		private $validators = array();
		
		protected $value = NULL;
		protected $label = NULL;
		protected $multioptions = array();
		protected $atributes = array();
		
		/**
		 * Funkce testujici samotnou hodnotu na vsech vaidatorech
		 * @param unknown $value
		 */
		protected function testing($value) {
			
			foreach($this->validators as $val) {
				if( !($val->isValid($value)) ) {
					$this->hasError = true;
						
					$this->errors[] = $val->getErrorMessage();
				}
			}
		}
		
		/**
		 * Funkce spoustena pri vytvoreni objeku
		 * @param: bool - Jestli je vyplneni hodnoty prvku povinne
		 * @param Array $options - pole atributu pro prvek, 'label'=>'nastaveni popisu', 'multioptions'=>array(...) pro nastaveni select a radio
		 */
		public function __construct($mandatory = false,$options = array()) {		
			$this->setAtributes($options);
			if($mandatory) {
				$this->addValidator(new Form_Validator_Mandatory($this->atributes['name']));
			}
		}
		
		public function __toString() {
			return false;
		}
		
		/**
		 * Funkce overujici $value na vsech zadanych validatorech
		 * @param $value - hodnota nebo pole hodnot
		 * @return - true/false validni/nevalidni
		 */
		public function isValid($value) {
			if(is_array($value)) {
				foreach($value as $val) {
					$this->testing($val);
				}
			} else {
				$this->testing($value);
			}
			
			if($this->hasError) {
				return false;
			} else {
				return true;
			}
		}
		
		/**
		 * Funkce nastavi hodnotu value na $value,
		 * v pripade select nastavi value na pole hodnot
		 * @param unknown $value
		 */
		public function populate($value) {
			$this->value = $value;
		}
		
		/**
		 * Funkce pro nastaveni atributu u formularoveho prvku vcetne atributu label 
		 * (vlozi se mezi tagy <label>) a value (nastavi se hodnota nebo pole hodnot prvku)
		 * @param Array $arr - pole atributu array('jmeno atributu'=>'hodnota')
		 */
		public function setAtributes($arr) {
			$this->atributes = array_merge($this->atributes, $arr);
						
			if(isset($this->atributes['label'])) {
				$this->label = $this->atributes['label'];
				unset($this->atributes['label']);
			}
			if(isset($this->atributes['multioptions'])) {
				$this->multioptions = $this->atributes['multioptions'];
				unset($this->atributes['multioptions']);
			}
		}
		
		/**
		 * Funkce vraci pole errors, ktere vznikly pri validaci
		 * @return: array
		 */
		public function getErrors() {
			return $this->errors;
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
		 * Funkce prida pole objeku validatoru pro validaci daneho prvku
		 * @param Array $validators
		 */
		public function addValidators($validators) {
			foreach($validators as $val) {
				$this->validators[get_class($val)] = $val;
			}
		}
		
		/**
		 * Funkce prida objekt validatoru do pole pro validaci daneho prvku
		 * @param Object $validator - (objekt validatoru)
		 */
		public function addValidator($validator) {
			$this->validators[get_class($validator)] = $validator;
		}		
		
		/**
		 * Funkce zjistujici jestli ma prvek dany validator nastveny
		 * @param String $name - jmeno validatoru
		 */
		public function hasValidator($name) {
			if(array_key_exists($name, $this->validators)) {
				return true;
			} else {
				return false;
			}
		}
		
		/**
		 * Funkce vracejici hodnotu $label
		 * @return multitype:
		 */
		public function getLabel() {
			return $this->label;
		}
		
		/**
		 * Funkce pro vykresleni formularoveho prvku
		 */
		abstract public function draw();	
	}
