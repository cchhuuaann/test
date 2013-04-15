<?php

	class Form_Validator_Range extends Form_Validator {
		private $min = NULL;
		private $max = NULL;
		protected $errorMessage = 'Hodnota neni v dannem rozsahu!';
		
		
		public function __construct($min,$max) {
			$this->min = $min;
			$this->max = $max;
		}
		
		public function isValid($value) {
			if($value >= $this->min && $value <= $this->max) {
				return true;
			} else {
				return false;
			}
		}
	}
