<?php
	
	class Form_Item_Radio extends Form_Item {
	
		public function __construct($mandatory = false,$options = array()) {
			parent::__construct($options);
			$this->atributes['type'] = 'radio';
		}
		
		/**
		 * @TODO: chyba ve vykreslovani, predelat
		 * (non-PHPdoc)
		 * @see Form_Item::draw()
		 */
		function draw() {
			$hodnota = "";
			if(isset($this->value)) {
				$hodnota = $this->value;
			}
			
			echo "<label name='" . htmlspecialchars($this->atributes['name']) . "'>";
			echo htmlspecialchars($this->label) . "</label><br />";
		
			foreach($this->multioptions as $key => $value) {
				$this->atributes['value'] = $key;
				$input = "<input ";
				foreach($this->atributes as $key => $val) {
					$input .= htmlspecialchars($key) . "='" . htmlspecialchars($val) . "' ";
				}
				
				if($hodnota == $this->atributes['value']) {
					$input .= "checked='checked' ";
				}
				
				$input .= "/><label name=" . htmlspecialchars($this->atributes['name']) . ">" . htmlspecialchars($value) . "</label><br />";
				
				echo $input;
				
			}
		}
		
	}
