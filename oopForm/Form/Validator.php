<?php

	abstract class Form_Validator {
		protected $errorMessage = 'Obsahuje chybu';
		
		abstract public function isValid($value);
		
		public function getErrorMessage() {
			return $this->errorMessage;
		}
	}