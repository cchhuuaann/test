<?php
	abstract class Xml_Parser_Row_Validator {
		protected $errorMessage = 'Neznama chyba!';
		
		public function getErrorMessage() {
			return $this->errorMessage;
		}
		
		abstract public function isValid($value);
	}
