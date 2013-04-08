<?php

	abstract class FormValidator {
		
		/**
		 * 
		 * @param unknown $value
		 * @return true/false
		 */
		abstract public function isValid($value);
		
		abstract public function getErrorMessage();
	}