<?php
	
	class Form_Item_Select extends Form_Item {

		public function __construct($options = array()) {
			parent::__construct($options);
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
			
			$select = "<select ";
			foreach($this->atributes as $key => $val) {
				$select .= htmlspecialchars($key) . "='" . htmlspecialchars($val) . "' ";
			}
			$select .= ">";
			echo $select;
			
			foreach($this->multioptions as $key => $val) {
				$selected = "";
				if(in_array($key, $value)) {
					$selected = "selected='selected'";
				}
				$option = "<option value='" . htmlspecialchars($key) . "' {$selected} >";
				
				$option .= $val;
				
				$option .= "</option>";
				
				echo $option;		
			}
			
			echo "</select>";
		}
		
	}
