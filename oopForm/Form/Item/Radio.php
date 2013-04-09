<?php
	
	class Form_Item_Radio extends Form_Item {
	
		public function __construct($options = array()) {
			parent::__construct($options);
			$this->atributes['type'] = 'radio';
		}
				
		public function setError() {
			;
		}
		
		function draw() {
			$value = "";
			if(isset($this->value)) {
				$value = $this->value;
			}
			
			echo "<label name='" . htmlspecialchars($this->atributes['name']) . "'>";
			echo htmlspecialchars($this->label) . "</label><br />";
		
			foreach($this->multioptions as $key_a => $val_a) {
				$this->atributes['value'] = $key_a;
				$input = "<input ";
				foreach($this->atributes as $key_b => $val_b) {
					$input .= htmlspecialchars($key_b) . "='" . htmlspecialchars($val_b) . "' ";
				}
				
				if($value == $this->atributes['value']) {
					$input .= "checked='checked' ";
				}
				
				$input .= "/><label name=" . htmlspecialchars($this->atributes['name']) . ">" . htmlspecialchars($val_a) . "</label><br />";
				
				echo $input;
				
			}
		}
		
	}
