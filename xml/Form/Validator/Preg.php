<?php

	 abstract class Form_Validator_Preg extends Form_Validator {
		protected $expression = NULL;
	 	
		public function isValid($value) {
			if(preg_match($this->expression, $value) == 1) {
				return true;
			} else {
				return false;
			}
		}
	}