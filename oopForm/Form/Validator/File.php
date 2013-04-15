<?php

	class Form_Validator_File extends Form_Validator {
		private $type = array();
		protected $errorMessage = '';
		protected $message = array(
			1 => 'The uploaded file exceeds the upload_max_filesize directive in php.ini.',
			2 => 'The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form.',
			3 => 'The uploaded file was only partially uploaded.',
			4 => 'No file was uploaded.',
			6 => 'Missing a temporary folder.',
			7 => 'Failed to write file to disk.',
			8 => 'A PHP extension stopped the file upload.'
		);
		
		
		public function __construct() {
			;
		}
		
		public function isValid($value) {
			
			if(array_key_exists($value, $message)) {
				$this->errorMessage = $this->message[$value];
				return false;
			} else {
				return true;
			}
		}
		
	}
