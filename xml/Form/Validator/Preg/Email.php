<?php

	class Form_Validator_Preg_Email extends Form_Validator_Preg {
		protected $expression = '~^(.+)@([^\(\);:,<>]+\.[a-zA-Z]{2,4})$~';
		protected $errorMessage = 'Retezec neni email!';

	}