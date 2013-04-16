<?php
	class Xml_Writer {
		protected $xml = NULL;
		
		/**
		 * @param String $header: xml hlavicka + korenovy tag
		 */
		public function __construct($header) {
			$this->xml = new SimpleXMLElement($header);
		}
		
		public function __toString() {
			return false;
		}
		
		/**
		 * Funkce ktera prochazi cele pole
		 * @param Array $arr: pole hodnot prevadejicich do xml
		 * @param Object $child: objekt xml
		 */
		protected function docasnyNazev($arr,$child) {
			
			foreach($arr as $key => $val) {
				
				if(is_array($val)) {
					$tag = $child->addChild($key);
					$this->docasnyNazev($val, $tag);
				} else {
					$child->addChild($key,$val);
				}
			}
		}

		/**
		 * Funkce ktera z pole vztvori xml soubor
		 * @param Array $list:	Pole hodnot, nazvy tagu v indexu
		 * @param String $name:	nazev souboru s cestou
		 */
		public function createXml($list,$name,$first_tag) {
				
			if(count($list)) {
				
				foreach($list as $val) {
				
					if(is_array($val)) {
						$tag = $this->xml->addChild($first_tag);
						$this->docasnyNazev($val, $tag);
					} else {
						$this->xml->addChild($first_tag,$val);
					}
				}
				
				if(file_exists("{$name}.xml")) {
					unlink("{$name}.xml");
				}
		
				$this->xml->saveXML("{$name}.xml");
				
				return true;
			} else {
				return false;
			}
				
		}
		
		
		
	}