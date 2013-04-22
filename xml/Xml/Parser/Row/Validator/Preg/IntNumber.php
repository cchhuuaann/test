<?php

	class Xml_Parser_Row_Validator_Preg_IntNumber extends Xml_Parser_Row_Validator_Preg {
		protected $expression = '~^[0-9]*$~';
		protected $errorMessage = 'Hodnota neni cele cislo!';

	}