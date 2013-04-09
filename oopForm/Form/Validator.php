<?php

	abstract class Form_Validator {
		
		/**
		 * 
		 * @param unknown $value
		 * @return true/false
		 */
		abstract public function isValid($value);
		
		abstract public function getErrorMessage();
	}