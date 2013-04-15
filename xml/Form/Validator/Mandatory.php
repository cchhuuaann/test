<?php
	
	class Form_Validator_Mandatory extends Form_Validator {
		protected $errorMessage = 'Povinna polozka nebyla vyplnena!';
		
		public function isValid($value) {
			if(!empty($value)) {
				return true;
			} else {
				return false;
			}
		}
		
	}
