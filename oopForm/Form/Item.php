<?php

	abstract class Form_Item {
		
		private $hasError = false;		
		private $errors = array();

		protected $validators = NULL;
		protected $value = NULL;
		protected $label = NULL;
		protected $multioptions = NULL;
		protected $atributes = array();
		
		/**
		 * 
		 * @param Array $options - pole atributu pro prvek, 'label'=>'nastaveni popisu', 'multioptions'=>array(...) pro nastaveni select a radio
		 */
		public function __construct($options = array()) {			
			$this->setAtributes($options);
		}
		
		public function __toString() {
			return false;
		}
		
		/**
		 * 
		 * @return - true/false validni/nevalidni
		 */
		public function isValid() {
			; //TODO
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
		
		public function getErrors() {
			; //TODO
		}
		
		public function hasError() {
			; //TODO
		}
		
		/**
		 * Funkce prida pole objeku validatoru pro validaci daneho prvku
		 * @param unknown $validators
		 */
		public function addValidators($validators)
		{
			$this->validators = $validators; //TODO
		}
		
		/**
		 * Funkce prida objek validatoru do pole pro validaci daneho prvku
		 * @param unknown $validator
		 */
		public function addValidator($validator)
		{
			$this->validators[] = $validator; //TODO
		}		
		
		/**
		 * Funkce pro vykresleni formularoveho prvku
		 */
		abstract public function draw();
		abstract public function setError();		
	}
