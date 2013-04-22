<?php

	class Xml_Parser_Row_Validator_Preg_Email extends Xml_Parser_Row_Validator_Preg {
		protected $expression = '~^(.+)@([^\(\);:,<>]+\.[a-zA-Z]{2,4})$~';
		protected $errorMessage = 'Retezec neni email!';

	}