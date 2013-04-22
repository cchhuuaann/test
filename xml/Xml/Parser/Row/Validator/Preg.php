<?php
	class Xml_Parser_Row_Validator_Preg extends Xml_Parser_Row_Validator {
		protected $expression = NULL;
		 
		public function isValid($value) {
			if(preg_match($this->expression, $value) == 1) {
				return true;
			} else {
				return false;
			}
		}
	}