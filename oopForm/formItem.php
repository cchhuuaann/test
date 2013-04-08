<?php

	abstract class FormItem {
		
		private $has_error = false;
		private $value = null;
		private $validators = null;
		
		private $errors = array();
		
		public function isValid();
		
		public function populate();

		public function getErrors();
		
		public function hasError();		
				
		public function addValidators(Array $validators)
		{
			$this->validators = $validators;
		}
		
		public function addValidator($validator)
		{
			$this->validators[] = $validator;
		}		
		
		abstract public function draw();
		abstract public function setError();		
	}
