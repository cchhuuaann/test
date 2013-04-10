<?php

	class Form_Validator_Preg_Http extends Form_Validator_Preg {
		private $expression = '~^http\:\/\/[a-zA-Z0-9\.\-\/\,\?\'\\\+&%\$#\=\~\_\-\@]*$~';
		protected $errorMessage = 'Retezec neni adresa http!';

	}