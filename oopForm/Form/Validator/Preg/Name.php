<?php

	class Form_Validator_Preg_Name extends Form_Validator_Preg {
		private $expression = '~^[a-zA-Z ]*$~';
		protected $errorMessage = 'Retezec neni nazev!';

	}