<?php

	class Form_Validator_Preg_FloatNumber extends Form_Validator_Preg {
		protected $expression = '~^[-\+]?[0-9]*[\,\.]?[0-9]*$~';
		protected $errorMessage = 'Hodnota neni desetine cislo!';

	}