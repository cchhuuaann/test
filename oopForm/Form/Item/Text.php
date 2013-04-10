<?php

	class Form_Item_Text extends Form_Item {
		
		public function __construct($mandatory = false,$options = array()) {
			parent::__construct($options);
			$this->atributes['type'] = 'text';
		}

		function draw() {
			
			$input = "<label name=" . htmlspecialchars($this->atributes['name']) . ">" . htmlspecialchars($this->label) . "</label>";
			if(isset($this->value)) {
				$this->atributes['value'] = $this->value;
			}
			$input .= "<input ";
			
			foreach($this->atributes as $key => $val) {
				$input .= htmlspecialchars($key) . "='". htmlspecialchars($val) . "' ";
			}
			
			$input .= "/>";
			
			echo $input;
			
		} 
		
	}