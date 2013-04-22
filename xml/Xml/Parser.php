<?php
	class Xml_Parser {
		const ROWCLONE = true;
		private $containerName = NULL;
		private $itemName = NULL;
		private $elements = NULL;
		
		private $data = array();
		private $rows = array();
		private $oneRow = NULL;

		
		/**
		 * Funkce vykresli hlavicku pro tabulku
		 * @return strings
		 */
		private function drawHeader() {
			$header = '<tr>';
			$header .= '<th></th>';
			foreach($this->elements as $val) {
				$header .= '<th>' . $val . '</th>';
			}
			$header .= '</tr>';
			
			return $header;
		}
		
		/**
		 * Funkce prevadejici xml na assoc pole
		 * @param Object $xml
		 * @return Array
		 */
		private function xmlToAssoc($xml) {
			$node = array();
			$i = 0;
			
			while($xml->read()) {
				
				if($xml->name == $this->containerName) {
					continue;
					
				} elseif($xml->nodeType == XMLReader::END_ELEMENT) {
					return $node;
					
				} elseif($xml->nodeType == XMLReader::ELEMENT) {
					if(in_array($xml->name, $this->itemName)) {
						$node[$i] = $this->xmlToAssoc($xml);
						
					} else {
						$node[$xml->name] = $this->xmlToAssoc($xml);
						
					}
					$i++;
				} elseif($xml->nodeType == XMLReader::TEXT) {
					$node = $xml->value;
					
				}
			}
			
			return $node;
		}
		
		/**
		 * Pri vytvorteni objektu z teto tridy dojde
		 * k prevodu z xml do assoc pole a ulozeni do $data 
		 * @param String $file_name
		 * @param String $container_name
		 * @param Array $item_name
		 * @param Array $elements: index = jmeno, hodnota = pole validatoru
		 */
		public function __construct($file_name,$container_name,$item_name,$elements) {
			$this->containerName = $container_name;
			$this->itemName = $item_name;
			$this->elements = $elements;

			$this->oneRow = new Xml_Parser_Row();
			foreach($this->elements as $key => $val) {
				$this->oneRow->registerItem($key,$val);
			}
				
			$xml = new XMLReader();
			
			if(!$xml->open($file_name)) {
				throw new Exception("Soubor $file_name nelze otevrit.");
			}
			
			$this->data = $this->xmlToAssoc($xml);
		}
		
		public function __toString() {
			
			echo "<pre>";
			var_dump($this->data);
			echo "</pre>";
			
			return '';
		}
		
		public function process() {
			foreach($this->data as $arr) {
				$tmp = clone $this->oneRow;
				$tmp->populate($arr);
				$tmp->isValid();
				$rows[] = $tmp;
				unset($tmp);
			}
		}
		
		public function getOutput() {
			$table = '<table>\n';
			
			$table .= "\t" . drawHeader() . "\n";
			
			foreach($this->rows as $row) {
				$table .= "\t{$row->draw()}\n";
			}
			
			$table .= '</table>\n';			
			return $table;
		}
		
		/**
		 * TODO:
		 * @param unknown $config
		 * @param unknown $table
		 */
		public function processDb($config, $table) {
			$mysql = new Database($config);
		}
		
		
	}