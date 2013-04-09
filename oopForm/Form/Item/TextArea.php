<?php

	class Form_Item_TextArea extends Form_Item {

		public function __construct($options = array()) {
			parent::__construct($options);
		}
		
		public function setError() {
			;
		}
		
		function draw() {
			
			if(isset($this->value)) {
				$value = $this->value;
			} else if(isset($this->atributes['value'])) {
				$value = $this->atributes['value'];
			} else {
				$value = "";
			}
			
			if(isset($this->atributes['value'])) {
				unset($this->atributes['value']);
			}

			echo "<label name='" . htmlspecialchars($this->atributes['name']) . "'>";
			echo htmlspecialchars($this->label) . "</label><br />";
			
			$textarea = "<textarea ";
			
			foreach($this->atributes as $key => $val) {
				$textarea .= htmlspecialchars($key) . "='" . htmlspecialchars($val) . "' ";
			}
			
			$textarea .= ">" . htmlspecialchars($value) . "</textarea>";
			
			echo $textarea;
		}
	}
