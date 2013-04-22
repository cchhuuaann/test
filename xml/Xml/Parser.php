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
			
			if(!$this->hasError()) {
				$header .= '<th></th>';
			}
			
			foreach($this->elements as $val) {
				$header .= '<th>' . $val . '</th>';
			}
			$header .= '</tr>';
			
			return $header;
		}
		
		/**
		 * funkce zjistuje existenci chyby
		 * @return boolean
		 */
		public function hasError() {
			foreach($this->rows as $val) {
				if($val->hasError()) {
					return true;
				}
			}
			
			return false;
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
				$this->oneRow->registerItem($val/* , ... */);
			}
				
			$xml = new XMLReader();
			
			if(!$xml->open($file_name)) {
				throw new Exception("Soubor $file_name nelze otevrit.");
			}
			
			$this->data = $this->xmlToAssoc($xml);
		}
		
		/**
		 * Pri zavolani objektu se vypisou data z xml
		 * v nem ulozena
		 * @return string
		 */
		public function __toString() {
			echo "<pre>";
			var_dump($this->data);
			echo "</pre>";
			
			return '';
		}
		
		/**
		 * Funkce naplni radky datama z xml
		 */
		public function process() {
			foreach($this->data as $arr) {
				$tmp = clone $this->oneRow;
				$tmp->populate($arr);
				$tmp->isValid();
				$this->rows[] = $tmp;
				unset($tmp);
			}
		}
		
		/**
		 * Funkce nastavujici validatory pro jednotlive sloupce tabulky
		 * @param array $arr: Assoc klic = nazev sloupce; value = pole validatoru
		 */
		public function addValidators($arr) {
			
			if(empty($this->rows)) {
				$this->oneRow->addValidators($arr);
			} else {
				foreach($this->rows as $row) {
					$row->addValidators($arr);
				}
			}
		}
		
		/**
		 * Funkce vykresli tabulku s daty z xml
		 * @return string
		 */
		public function getOutput() {
			$table = "<table>\n";
			$table .= "\t" . $this->drawHeader() . "\n";
			$table .= '<caption><strong>';
			
			if($this->hasError()) {
				$table .= 'Nelze nahrat, doslo k chybe.';
			} else {
				$table .= 'Data byla zpracovana.'; 
			}
			
			$table .= '</strong></caption>';
			
			foreach($this->rows as $row) {
				$table .= "\t{$row->draw($this->hasError())}\n";
			}
			
			$table .= "</table>\n";			
			return $table;
		}
		
		/**
		 * TODO:
		 * @param unknown $config
		 * @param unknown $table
		 */
		public function processDb($config, $table) {
			
			if($this->hasError()) {
				return false;
			}
			/* 
			transformData()
			 */

			
			$mysql = new Database($config);
		}
		
	}