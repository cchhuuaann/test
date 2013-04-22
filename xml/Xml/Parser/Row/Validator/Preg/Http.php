<?php

	class Xml_Parser_Row_Validator_Preg_Http extends Xml_Parser_Row_Validator_Preg {
		protected $expression = '~^http\:\/\/[a-zA-Z0-9\.\-\/\,\?\'\\\+&%\$#\=\~\_\-\@]*$~';
		protected $errorMessage = 'Retezec neni adresa http!';

	}