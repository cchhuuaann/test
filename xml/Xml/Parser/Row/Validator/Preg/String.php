<?php

	class Xml_Parser_Row_Validator_Preg_String extends Xml_Parser_Row_Validator_Preg {
		protected $expression = '~^[a-zA-Z ]*$~';
		protected $errorMessage = 'Neni to retezec!';

	}