<?php

	class Form_Validator_Preg_Email extends Form_Validator_Preg {
		private $expression = '~^([*+!.&#$¦\'\\%\/0-9a-z^_`{}=?~:-]+)@(([0-9a-z-]+\.)+[0-9a-z]{2,4})$/i~';
		protected $errorMessage = 'Retezec neni email!';

	}