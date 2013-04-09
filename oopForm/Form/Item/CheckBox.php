<?php

	class Form_Item_CheckBox extends Form_Item {

		public function __construct($options = array()) {
			parent::__construct($options);
			$this->atributes['type'] = 'checkbox';
		}
		
		public function populate($value) {
			parent::populate($value);
			$this->atributes['checked'] = 'checked';
			echo $this->value;
		}
		
		public function setError() {
			;
		}
		
		function draw() {
		
			$input = "<input ";
			if(isset($this->value)) {
				$this->atributes['value'] = $this->value;
			}
				
			foreach($this->atributes as $key => $val) {
				$input .= htmlspecialchars($key) . "='". htmlspecialchars($val) . "' ";
			}

			$input .= "<label name=". htmlspecialchars($this->atributes['name']) . ">". htmlspecialchars($this->label) . "</label>";
				
			echo $input;
				
		}
		
	}
