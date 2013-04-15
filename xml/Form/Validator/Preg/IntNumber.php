<?php

	class Form_Validator_Preg_IntNumber extends Form_Validator_Preg {
		protected $expression = '~^[0-9]*$~';
		protected $errorMessage = 'Hodnota neni cele cislo!';

	}